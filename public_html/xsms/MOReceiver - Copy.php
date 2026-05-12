<?php

define('THIS_PATH', dirname(__FILE__));
require_once(THIS_PATH . '/nusoap.php');
require(THIS_PATH . '/database.php');
require(THIS_PATH . '/query.php');

$host = "localhost";
$user = "nusinhsonghong";
$pass = "nusinhsonghong";
$db = "xoso_sms";
$_db = new database($host, $user, $pass, $db);

$namespace = "http://tempuri.org";
$server = new soap_server();
//Khai bao thong tin cho web service
$server->configureWSDL('MOReceiver', 'uri:MOReceiver');

$server->wsdl->schemaTargetNamespace = $namespace;

$server->register('DeliverMO', array(
    'Destination' => 'xsd:string', //so dien thoai
    'SendFrom' => 'xsd:string', //dau so 8x17
    'KeywordName' => 'xsd:string', //ma dich vu
    'InContent' => 'xsd:string', //noi dung tin nhan
    'Seqno' => 'xsd:string', //ma tin nhan
    'CommMethod' => 'xsd:string', //ten nha mang: viettel, mobile, ...
        )
        , array(//output
    'MOReceiverResult' => 'xsd:string')
        , $namespace, //namespace
        $namespace . "/" . "MOReceiver", //soapAction
        'rpc', //Style Services
        'encoded', 'Web services, nhan va xu ly tin nhan'    //Description
);

function DeliverMO($Destination, $SendFrom, $KeywordName, $InContent, $Seqno, $CommMethod) {
    saveSMS($Destination, $SendFrom, $KeywordName, $InContent, $Seqno, $CommMethod);

//    $str = $Destination."\n";
//    $str .= $SendFrom."\n";
//    $str .= $KeywordName."\n";
//    $str .= $InContent."\n";
//    $str .= $Seqno."\n";
//    $str .= $CommMethod."\n";
//    
//    $fp = fopen(THIS_PATH . '/log_sms.txt', 'w');
//    // define script name
//    $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
//    // define current time and suppress E_WARNING if using the system TZ settings
//    // (don't forget to set the INI setting date.timezone)
//    $time = @date('[d/M/Y:H:i:s]');
//    // write current time, script name and message to the log file
//    fwrite($fp, "$time\n($script_name)\n$str" . PHP_EOL);
//    fclose($fp);

    $response = 'Cu phap tin nhan ko dung.';
    $procresult = '0';

    if (preg_match('/BHX\s+(KQ|TT|TK).*/ism', $InContent, $m)) {
        $item_id = '';
        $time = 0;
        $so = '';

        if (preg_match('/BHX\s+([\w]+)\s+(.*)/ism', $InContent, $matchs)) {
            $item_id = $matchs[1];
            $item_id = strtoupper($item_id);

            $tmp = $matchs[2];
            if (substr($item_id, 0, 2) == 'TK') {
                $so = $tmp;
            } else {
                if (strlen($tmp) == 8) {
                    $d = substr($tmp, 0, 2);
                    $m = substr($tmp, 2, 2);
                    $y = substr($tmp, 4, 4);

                    $time = strtotime($d . '-' . $m . '-' . $y);
                } else {
                    $item_id = '';
                }
            }
        } elseif (preg_match('/BHX\s+([\w]+)/ism', $InContent, $matchs)) {
            $item_id = $matchs[1];
            $item_id = strtoupper($item_id);
        }

        if ($item_id != '') {
            $rs = updateXOSO($Destination, $item_id, $SendFrom, $InContent, $time, $so);
//            return $rs->content;
            if ($rs->status == 1) {
                updateSMS($Seqno);
                if (strlen($rs->content) > 160) {
                    if (preg_match('/(^.{1,160})\n(.*)/ism', $rs->content, $match)) {
                        $procresult = '1';
                        $procresult = '0'; //test

                        $response = $match[1]; //nội dung trả về

                        SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 2);

                        $procresult = '0';
                        $response = $match[2];

                        if (trim($response) != '') {
                            SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, 0, 2);
                        }
                        return 1;
                    }
                } else {
                    $response = $rs->content;
                }
                $procresult = '1';
                $procresult = '0'; //test

                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                return 1;
            }
        }
    }

    SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);

    return -1;
}

function SendMT($dienThoai, $sendfrom, $keyword, $outcontent, $flag, $SeqNo, $Total) {
    $client = new nusoap_client('http://112.78.7.141:1500/MVASCONTENT/MTSend.asmx?WSDL', true);
    $err = $client->getError();

    if ($err) {
//        echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        exit;
    } else {
//        echo "<h2>Successfully connected</h2>";
    }

    $client->soap_defencoding = 'UTF-8';
    $type = "0";
    $secu = "xT12#@"; //secretcode là xT12#@

    $param = array(
        "Destination" => $dienThoai, //so dien thoai
        "SendFrom" => $sendfrom, //dau so 8x17
        "KeywordName" => $keyword, //ma dich vu
        "OutContent" => $outcontent, //noi dung tin nhan
        "ChargingFlag" => $flag, //tinh tien =1, ko tinh =0
        "MOSeqNo" => $SeqNo, //ma tin nhan
        "TotalMessage" => $Total, //tong MT
        "ContentType" => $type, //text =0
        "SecretCode" => $secu, //ma so bi mat VNPAY cung cap
    );
    $result = $client->call('SendMT', $param);
//    $result['SendMTResult']   thành công =0; thất bại =-1
}

function updateXOSO($mobile, $item_id, $dau_so_nhan_tin, $msgbody, $time, $so) {
    global $_db;

    $rs->content = '';
    $rs->status = 0;

    $day30 = 0;
    if ($dau_so_nhan_tin == '8717' && substr($item_id, 0, 2) == 'KQ')
        $day30 = 1;

    if ($day30 == 1) {
        $query = "SELECT id FROM xs_sms WHERE mobile='$mobile' AND item_id='$item_id' AND dau_so_nhan_tin='8717'";
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($item);
        if (!$item) {
            $_db->setQuery("INSERT INTO xs_sms SET
                mobile='" . $mobile . "'
                ,item_id='" . $item_id . "'
                ,dau_so_nhan_tin='" . $dau_so_nhan_tin . "'
                ,msgbody='" . $msgbody . "'
                ,time=0
                ,created=" . time() . "
                ,day30=30
                ,status=1
            ");
            $_db->query();
        } else {
            $_db->setQuery("UPDATE xs_sms SET day30=30,time=0 WHERE id=" . $item->id);
            $_db->query();
        }
        $rs->content = 'Ban da dang ky nhan KQXS trong 30 ngay lien tiep, chung toi se gui ket qua cho ban ngay sau khi thoi gian quay so ket thuc';
        $rs->status = 1;

        return $rs;
    } elseif (substr($item_id, 0, 2) == 'TT' && $dau_so_nhan_tin == '8517') {
        $query = "SELECT id FROM xs_sms WHERE mobile='$mobile' AND item_id='$item_id' AND day30=999 AND dau_so_nhan_tin='8517'";
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($item);

        if (!$item) {
            $_db->setQuery("INSERT INTO xs_sms SET
                mobile='" . $mobile . "'
                ,item_id='" . $item_id . "'
                ,dau_so_nhan_tin='" . $dau_so_nhan_tin . "'
                ,msgbody='" . $msgbody . "'
                ,time=0
                ,created=" . time() . "
                ,day30=999
                ,status=0
            ");
            $_db->query();
        } else {
            $_db->setQuery("UPDATE xs_sms SET a_all='',status=0 WHERE id=" . $item->id);
            $_db->query();
        }
    } else {
        $_db->setQuery("INSERT INTO xs_sms SET
                mobile='" . $mobile . "'
                ,item_id='" . $item_id . "'
                ,dau_so_nhan_tin='" . $dau_so_nhan_tin . "'
                ,msgbody='" . $msgbody . "'
                ,time=" . $time . "
                ,created=" . time() . "
                ,day30=0
                ,status=0
            ");
        $_db->query();
    }

    $rs->status = 1;
    if (substr($item_id, 0, 2) == 'KQ' && $dau_so_nhan_tin == '8117') {
        $rs->content = KQXS($_db, $item_id, $time);
    } elseif (substr($item_id, 0, 2) == 'TK' && $dau_so_nhan_tin == '8517') {
        $rs->content = TKXS($_db, $item_id, $so);
    } elseif (substr($item_id, 0, 2) == 'TT' && $dau_so_nhan_tin == '8517') {
        $rs->content = TTXS($_db, $item_id, $mobile);
    } else {
        $rs->status = 0;
    }

    return $rs;
}

function KQXS($_db, $item_id, $time) {
    $code = substr($item_id, 2, strlen($item_id));

    if ($time == 0) {
        $query = "SELECT r.* FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code='" . $code . "' 
                    ORDER BY r.date DESC 
                    LIMIT 1"
        ;
    } else {
        $date = date('Y-m-d', $time);
        $query = "SELECT r.* FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code='" . $code . "' AND r.date='" . $date . "'
                    LIMIT 1"
        ;
    }

    $row = $_db->setQuery($query);
    $row = $_db->loadObject($item);
    if (!$item) {
        return 'Tinh ban chon khong ton tai hoac chua den gio quay';
    }

    $content = $code . ' ' . date('d/m', strtotime($item->date)) . ":\n";
    if ($item->a0 != '')
        $content .= "DB:" . $item->a0 . "\n";
    if ($item->a1 != '')
        $content .= "1:" . $item->a1 . "\n";
    if ($item->a2 != '')
        $content .= "2:" . $item->a2 . "\n";
    if ($item->a3 != '')
        $content .= "3:" . $item->a3 . "\n";
    if ($item->a4 != '')
        $content .= "4:" . $item->a4 . "\n";
    if ($item->a5 != '')
        $content .= "5:" . $item->a5 . "\n";
    if ($item->a6 != '')
        $content .= "6:" . $item->a6 . "\n";
    if ($item->a7 != '')
        $content .= "7:" . $item->a7 . "\n";
    if ($code != 'MB' && $item->a8 != '')
        $content .= "8:" . $item->a8 . "\n";

    return $content;
}

function TKXS($_db, $item_id, $so) {
    $code = substr($item_id, 2, strlen($item_id));
    $so = trim($so);
    $content = '';

    $query = "SELECT CONCAT_WS(',',r.a0,r.a1,r.a2,r.a3,r.a4,r.a5,r.a6,r.a7,r.a8) AS data,r.date
                    FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code='" . $code
            . " ORDER BY r.date DESC"
            . " LIMIT 0,30"
    ;

    $row = $_db->setQuery($query);
    $row = $_db->loadObjectList($list);

    if ($list) {
        $count = 0;
        $date = '';
        foreach ($list as $v1) {
            $arr = explode(',', $v1->data);
            foreach ($arr as $v2) {
                if (strpos($v2 . '-', $so . '-') !== false) {
                    $count++;
                    if ($date == '') {
                        $date = $v1->date;
                    }
                }
            }
        }

        if ($date != '') {
            $content = 'Day so ' . $so . ' xuat hien ' . $count . ' lan trong 30 ngay gan nhat, ngay ve gan nhat la ' . date('d/m/Y', strtotime($date));
        } else {
            $content = 'Day so ' . $so . ' khong xuat hien trong 30 ngay gan nhat';
        }
    } else {
        $content = 'Day so ' . $so . ' khong xuat hien trong 30 ngay gan nhat';
    }

    return $content;
}

function TTXS($_db, $item_id, $mobile) {
    $content = 'Ban da dang ky nhan KQXS tuong thuat truc tiep trong ngay hom nay ' . date('d/m/Y', time());

    if ($item_id == 'TT')
        $code = 'MB';
    else
        $code = substr($item_id, 2, strlen($item_id));

    $date = date('Y-m-d', time());
    $query = "SELECT r.* FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code='" . $code . "' AND r.date='" . $date . "'
                    LIMIT 1"
    ;
    $row = $_db->setQuery($query);
    $row = $_db->loadObject($item);
    if ($item) {
        if ($item->a0 == '')
            return $content;

        $content = $code . ' ' . date('d/m', time()) . ":\n";
        $content .= "DB:" . $item->a0 . "\n";
        $content .= "1:" . $item->a1 . "\n";
        $content .= "2:" . $item->a2 . "\n";
        $content .= "3:" . $item->a3 . "\n";
        $content .= "4:" . $item->a4 . "\n";
        $content .= "5:" . $item->a5 . "\n";
        $content .= "6:" . $item->a6 . "\n";
        $content .= "7:" . $item->a7 . "\n";
        if ($code != 'MB')
            $content .= "8:" . $item->a8 . "\n";

        $_db->setQuery("UPDATE xs_sms SET status='1' WHERE mobile='$mobile' AND item_id='$item_id' AND day30=999");
        $_db->query();
    }

    return $content;
}

function saveSMS($Destination, $SendFrom, $KeywordName, $InContent, $Seqno, $CommMethod) {
    global $_db;

    $_db->setQuery("INSERT INTO xs_mo_receiver SET
        Destination=" . Quote($Destination) . "
        ,SendFrom=" . Quote($SendFrom) . "
        ,KeywordName=" . Quote($KeywordName) . "
        ,InContent=" . Quote($InContent) . "
        ,Seqno=" . $Seqno . "
        ,CommMethod=" . Quote($CommMethod) . "
        ,created=" . time() . "
        ,status=0
        ");
    $_db->query();
}

function updateSMS($Seqno) {
    global $_db;
    $_db->setQuery("UPDATE xs_mo_receiver SET status=1 WHERE Seqno=" . $Seqno . "");
    $_db->query();
}

function Quote($text, $escaped = true) {
    return '\'' . ($escaped ? getEscaped($text) : $text) . '\'';
}

function getEscaped($text, $extra = false) {
    $result = mysql_real_escape_string($text);
    if ($extra) {
        $result = addcslashes($result, '%_');
    }
    return $result;
}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
