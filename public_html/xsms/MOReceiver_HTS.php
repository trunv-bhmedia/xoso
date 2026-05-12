<?php

error_reporting(-1);

define('THIS_PATH', dirname(__FILE__));

define('_8788', '8588');
define('_8588', '8588');
define('_8388', '8288');
define('_8188', '8188');
define('_8088', '8188');

// define('_8717', '8717');
// define('_8517', '8517');
// define('_8317', '8317');
// define('_8117', '8117');
// define('_8017', '8017');



require_once(THIS_PATH . '/nusoap.php');
require(THIS_PATH . '/database.php'); 
require(THIS_PATH . '/query.php');

$host = 'localhost';
$user = 'xoso';
$pass = 'jGsCpNTfdjpBzwnj';
$db = 'xosov2';

$_db = new database($host, $user, $pass, $db);

$namespace = 'http://tempuri.org';
$server = new soap_server();
//Khai bao thong tin cho web service
$server->configureWSDL('ReceiveMO', 'uri:ReceiveMO');

$server->wsdl->schemaTargetNamespace = $namespace;

$server->register(
        'ReceiveMO', //hàm xử lý, sẽ được VDC gọi
        array(//config thông tin input
    'moid' => 'xsd:string', // Unique ID from GW. Trong trường hợp nhận được nhiều MO có cùng moid thì chỉ được xử lý 1 lần duy nhất.
    'moseq' => 'xsd:string', // Unique ID from GW
    'src' => 'xsd:string', // số điện thoại của người nhắn tin
    'dest' => 'xsd:string', // đầu số soạn tin (ex: 8x55)
    'cmdcode' => 'xsd:string', // keyword (REG)
    'msgbody' => 'xsd:string', // Nội dung tin nhắn (REG 123)
    'opid' => 'xsd:string', // id telecom gpc8x88,vms8x88,gpc6x65
    'username' => 'xsd:string', // user do mình tự chỉnh (secure)
    'password' => 'xsd:string', // pass do mình tự chỉnh (secure)
        ), array(//output
    'ReceiveMOResult' => 'xsd:string'
        ), $namespace, //namespace
        $namespace . "/" . "ReceiveMO", //soapAction
        'rpc', //Style Services
        'encoded', 'Web services, nhan va xu ly tin nhan tu VDC'    //Description
);

/*
 *  $InContent = $msgbody
 *  $Destination = $src
 *  $SendFrom = $dest
 *  $KeywordName = $cmdcode
 *  $Seqno = $opid
 */


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
		$namespace . '/' . 'MOReceiver', //soapAction
		'rpc', //Style Services
		'encoded', 'Web services, nhan va xu ly tin nhan'    //Description
);

function ReceiveMO($moid, $moseq, $src, $dest, $cmdcode, $msgbody, $opid, $username, $password){}
function DeliverMO($Destination, $SendFrom, $KeywordName, $InContent, $Seqno, $CommMethod) {
    global $_db;

    if (strtoupper($InContent) != 'DV BHCHUYEN')
        saveSMS($Destination, $SendFrom, $KeywordName, $InContent, $Seqno, $CommMethod);
	    $response = 'Sai cu phap tin nhan';
   		$procresult = '0';

    if ($InContent != '' && strtoupper($InContent) == 'DV') {
        if ($SendFrom == _8088 || $SendFrom == _8788) {
            $namelength = mt_rand(3, 12);
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $r_username = '';
            for ($i = 0; $i < $namelength; $i++)
                $r_username .= $chars[mt_rand(0, strlen($chars))];
            $query = 'SELECT id FROM users WHERE username=\'' . $r_username . '\' LIMIT 1';
            $row = $_db->setQuery($query);
            $row = $_db->loadObject($user);
            while (isset($user->id) && $user->id > 0) {
                $r_username = '';
                for ($i = 0; $i < $namelength; $i++)
                    $r_username .= $chars[mt_rand(0, strlen($chars))];
                $query = 'SELECT id FROM users WHERE username=\'' . $r_username . '\' LIMIT 1';
                $row = $_db->setQuery($query);
                $row = $_db->loadObject($user);
            }
            $r_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);

            if ($SendFrom == _8788) {
                $_db->setQuery('INSERT INTO users SET
                    username=\'' . $r_username . '\'
                    ,password=\'' . md5($r_password) . '\'
                    ,fullname=\'' . $r_username . '\'          
                    ,gender=1
                    ,mobile=\'' . $Destination . '\'
                    ,created_date=\'' . date('Y-m-d H:i:s') . '\'
                    ,active=\'yes\'
                    ,time_active=' . time() . '
                    ,group_id=4
                ');
                $_db->query();

                $response = 'Ban da dang ky thanh cong tai khoan VIP tren Xoso.com voi ten dang nhap: ' . $r_username . ', mat khau: ' . $r_password;
            } else {
                $_db->setQuery('INSERT INTO users SET
                    username=\'' . $r_username . '\'
                    ,password=\'' . md5($r_password) . '\'
                    ,fullname=\'' . $r_username . '\'          
                    ,gender=0
                    ,mobile=\'' . $Destination . '\'
                    ,created_date=\'' . date('Y-m-d H:i:s') . '\'
                    ,active=\'yes\'
                    ,group_id=4
                ');
                $_db->query();

                $response = 'Ban da dang ky thanh cong tren Xoso.com voi ten dang nhap: ' . $r_username . ', mat khau: ' . $r_password;
            }
            updateSMS($Seqno);
            $procresult = '1';
//            $procresult = '0'; //test
            SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
            return 1;
        } else {
            SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
            return -1;
        }
    } elseif (preg_match('/DV\s+([\w]+)/ism', $InContent, $matchs)) {
        if ($matchs[1] == 'TKB' || $matchs[1] == 'TKT' || $matchs[1] == 'TKN') {
            $item_id = 'DV_' . $matchs[1];
            $time = 0;
            $so = '';

            $rs = updateXOSO($Destination, $item_id, $SendFrom, $InContent, $time, $so);
//            return $rs->content;
            if ($rs->status == 1) {
                updateSMS($Seqno);
                if (strlen($rs->content) > 160) {
                    if (preg_match('/(^.{1,160})\n(.*)/ism', $rs->content, $match)) {
                        $procresult = '1';
//                        $procresult = '0'; //test
                        $total = count($match);

                        for ($ii = 1; $ii <= $total; $ii++) {
                            if (!isset($match[$ii]))
                                break;

                            if ($ii == 1) {
                                $response = $match[$ii]; //nội dung trả về
                                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, $total);
                            } else {
                                $procresult = '0';
                                $response = $match[$ii];

                                if (trim($response) != '') {
                                    SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, 0, $total);
                                }
                            }
                        }
                        return 1;
                    }
                } else {
                    $response = $rs->content;
                }
                $procresult = '1';
//                $procresult = '0'; //test

                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                return 1;
            } else {
                $response = $rs->content;
                $procresult = '0';
                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                return -1;
            }
        }

        $username = $matchs[1];
        $query = 'SELECT id FROM users WHERE username=\'' . $username . '\' LIMIT 1';
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($user);
        if (isset($user->id) && $user->id > 0) {
            if ($SendFrom == _8088 || $SendFrom == _8788) {
                if ($SendFrom == _8088) {
                    $r_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);
                    $_db->setQuery('UPDATE users SET password=\'' . md5($r_password) . '\' WHERE id=' . $user->id);
                    $_db->query();
                    $response = 'Mat khau moi cua ban la: ' . $r_password;
                } else {
                    $_db->setQuery('UPDATE users SET gender=1 AND time_active=' . time() . ' WHERE id=' . $user->id);
                    $_db->query();
                    $response = 'Chuc mung ban, tai khoan ' . $username . ' cua ban da duoc nang cap thanh tai khoan VIP';
                }
                updateSMS($Seqno);
                $procresult = '1';
//                $procresult = '0'; //test
                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                return 1;
            } else {
                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                return -1;
            }
        } else {
            $response = 'Username khong ton tai!';
            $procresult = '0';
            SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
            return -1;
        }
    } elseif (preg_match('/(KQ|TT).*/ism', $InContent, $m)) {
        $item_id = '';
        $time = 0;
        $so = '';

        if ($InContent != '' && strtoupper($InContent) == 'KQ') {
            $item_id = 'KQ_MB';
        } elseif ($InContent != '' && strtoupper($InContent) == 'KQ MM') {
            $item_id = 'KQ MM_MB';
        } elseif (preg_match('/KQ MM\s+([\w]+)/ism', $InContent, $matchs)) {
            $item_id = 'KQ MM_' . $matchs[1];
            $item_id = strtoupper($item_id);
        } elseif (preg_match('/KQ\s+([\w]+)\s+([\d]+)/ism', $InContent, $matchs)) {
            $tmp = $matchs[2];
            if (strlen($tmp) == 8) {
                $item_id = 'KQ_' . $matchs[1];
                $item_id = strtoupper($item_id);

                $d = substr($tmp, 0, 2);
                $m = substr($tmp, 2, 2);
                $y = substr($tmp, 4, 4);

                $time = strtotime($d . '-' . $m . '-' . $y);
            } elseif (strlen($tmp) == 2) {
                $item_id = 'TT TK_' . $matchs[1];
                $item_id = strtoupper($item_id);

                $so = $tmp;
            } else {
                $item_id = '';
            }
        } elseif (preg_match('/(.*?)\s+([\w]+)/ism', $InContent, $matchs)) {
            $item_id = $matchs[1] . '_' . $matchs[2];
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
//                        $procresult = '0'; //test
                        $total = count($match);

                        for ($ii = 1; $ii <= $total; $ii++) {
                            if (!isset($match[$ii]))
                                break;

                            if ($ii == 1) {
                                $response = $match[$ii]; //nội dung trả về
                                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, $total);
                            } else {
                                $procresult = '0';
                                $response = $match[$ii];

                                if (trim($response) != '') {
                                    SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, 0, $total);
                                }
                            }
                        }
                        return 1;
                    }
                } else {
                    $response = $rs->content;
                }
                $procresult = '1';
//                $procresult = '0'; //test

                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                return 1;
            } else {
                $response = $rs->content;
                $procresult = '0';
                SendMT($Destination, $SendFrom, $KeywordName, $response, $procresult, $Seqno, 1);
                return -1;
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
        exit;
    } else {
    }
    $client->soap_defencoding = 'UTF-8';
    $type = '0';
    $secu = 'xT12#@'; //secretcode là xT12#@

    $param = array(
        'Destination' => $dienThoai, //so dien thoai
        'SendFrom' => $sendfrom, //dau so 8x17
        'KeywordName' => $keyword, //ma dich vu
        'OutContent' => $outcontent, //noi dung tin nhan
        'ChargingFlag' => $flag, //tinh tien =1, ko tinh =0
        'MOSeqNo' => $SeqNo, //ma tin nhan
        'TotalMessage' => $Total, //tong MT
        'ContentType' => $type, //text =0
        'SecretCode' => $secu, //ma so bi mat VNPAY cung cap
    );
    $result = $client->call('SendMT', $param);

}

function SendMT2($mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password) {
	$time = date("d/m/Y H:i:s");
	$str = "$mtseq, $moid, $moseq, $src, $dest, $cmdcode, $msgbody, $msgtype, $msgtitle, $mttotalseg, $mtseqref, $cpid, $reqtime, $procresult, $opid, $username, $password, $time";
	write_log($str);
	$WSDL = "http://103.24.244.227:8081/SendMT.asmx?wsdl"; //chuyen ngay 5/4/2015
	$client = new nusoap_client($WSDL, true);
	$client->soap_defencoding = 'UTF-8';
	$status = $client->call('SendMT', array(
			'mtseq' => $mtseq,
			'moid' => $moid,
			'moseq' => $moseq,
			'src' => $dest, // ngược lại với receiveMO
			'dest' => $src,
			'cmdcode' => $cmdcode,
			'msgbody' => $msgbody,
			'msgtype' => $msgtype,
			'msgtitle' => $msgtitle,
			'mttotalseg' => $mttotalseg,
			'mtseqref' => $mtseqref,
			'cpid' => $cpid,
			'reqtime' => $reqtime,
			'procersult' => $procresult,
			'opid' => $opid,
			'username' => $username,
			'password' => $password
	)
	);
}



function updateXOSO($mobile, $item_id, $dau_so_nhan_tin, $msgbody, $time, $so) {
    global $_db;

    $rs->content = 'Khong ton tai MA TINH, de xem MA TINH, xin moi vao xoso.com';
    $rs->status = 0;

    $code = explode('_', $item_id);

    if ($dau_so_nhan_tin == _8588 || $dau_so_nhan_tin == _8788) {
        if (isset($code[1]) && (trim($code[1]) == 'MB' || trim($code[1]) == 'MT' || trim($code[1]) == 'MN'
                || trim($code[1]) == 'MMB' || trim($code[1]) == 'MMT' || trim($code[1]) == 'MMN'
                || trim($code[1]) == 'TKB' || trim($code[1]) == 'TKT' || trim($code[1]) == 'TKN'
                )) {
            if ($code[0] == 'KQ') {
                if (trim($code[1]) == 'MB' || trim($code[1]) == 'MT' || trim($code[1]) == 'MN') {
                    $query = 'SELECT id FROM xs_sms WHERE mobile=\'' . $mobile . '\' AND item_id=\'' . $item_id . '\' AND (dau_so_nhan_tin=\'' . _8788 . '\' OR dau_so_nhan_tin=\'' . _8588 . '\')';
                    $row = $_db->setQuery($query);
                    $row = $_db->loadObject($item);
                    if (!$item) {
                        $_db->setQuery('INSERT INTO xs_sms SET
                        mobile=\'' . $mobile . '\'
                        ,item_id=\'' . $item_id . '\'
                        ,dau_so_nhan_tin=\'' . $dau_so_nhan_tin . '\'
                        ,msgbody=\'' . $msgbody . '\'
                        ,time=0
                        ,created=' . time() . '
                        ,day30=5
                        ,status=1
                    ');
                        $_db->query();
                    } else {
                        $_db->setQuery('UPDATE xs_sms SET day30=5,time=0 WHERE id=' . $item->id);
                        $_db->query();
                    }
                    $rs->content = 'Ban da dang ky thanh cong nhan ket qua xo so Mien Bac cho 5 ngay';
                    if (trim($code[1]) == 'MT')
                        $rs->content = 'Ban da dang ky thanh cong nhan ket qua xo so Mien Trung cho 5 ngay';
                    elseif (trim($code[1]) == 'MN')
                        $rs->content = 'Ban da dang ky thanh cong nhan ket qua xo so Mien Nam cho 5 ngay';
                    $rs->status = 1;
                    return $rs;
                } else {
                    $serviceCode = 'XLMB';
                    if (trim($code[1]) == 'MMT')
                        $serviceCode = 'XLMT';
                    elseif (trim($code[1]) == 'MMN')
                        $serviceCode = 'XLMN';
                    $data = file_get_contents('http://xoso.com:81/client/getcontent?serviceCode=' . $serviceCode . '&Type=2');
                    $data = json_decode($data);
                    $rs->content = '';
                    foreach ($data->List as $val) {
                        $rs->content .= $val->Content . '.';
                    }
                    $rs->status = 1;
                    return $rs;
                }
            } elseif ($code[0] == 'DV') {
                $data = file_get_contents('http://xoso.com:81/client/getcontent?serviceCode=' . trim($code[1]) . '&Type=2');
                $data = json_decode($data);
                $rs->content = '';
                foreach ($data->List as $val) {
                    $rs->content .= $val->Content . '.';
                }
                $rs->status = 1;
                return $rs;
            }
        }
    }

    if (isset($code[1]) && trim($code[1]) != '') {
        $query = 'SELECT id,name FROM xs_location WHERE code=\'' . trim($code[1]) . '\'';
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($xs_location);
        if (!$xs_location) {
            return $rs;
        }
    } else {
        return $rs;
    }

    $KeywordName = $code[0];
    $xs_location_code = trim($code[1]);
    $xs_location->name = RemoveSign($xs_location->name);

    $day30 = 0;
    if ($dau_so_nhan_tin == _8788 && $KeywordName == 'KQ')
        $day30 = 10;
    elseif ($dau_so_nhan_tin == _8588 && $KeywordName == 'KQ')
        $day30 = 5;

    if ($day30 > 0) {
        $query = 'SELECT id FROM xs_sms WHERE mobile=\'' . $mobile . '\' AND item_id=\'' . $item_id . '\' AND (dau_so_nhan_tin=\'' . _8788 . '\' OR dau_so_nhan_tin=\'' . _8588 . '\')';
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($item);
        if (!$item) {
            $_db->setQuery('INSERT INTO xs_sms SET
                mobile=\'' . $mobile . '\'
                ,item_id=\'' . $item_id . '\'
                ,dau_so_nhan_tin=\'' . $dau_so_nhan_tin . '\'
                ,msgbody=\'' . $msgbody . '\'
                ,time=0
                ,created=' . time() . '
                ,day30=' . $day30 . '
                ,status=1
            ');
            $_db->query();
        } else {
            $_db->setQuery('UPDATE xs_sms SET day30=' . $day30 . ',time=0 WHERE id=' . $item->id);
            $_db->query();
        }

//        $rs->content = 'Ban da dang ky nhan ket qua ' . $xs_location->name . ' trong ' . $day30 . ' ngay thanh cong';
//        $rs->status = 1;

        $rs = getKQXS($xs_location_code);

        return $rs;
    } elseif ($KeywordName == 'TT' && $dau_so_nhan_tin == _8588) {
        $query = 'SELECT id FROM xs_sms WHERE mobile=\'' . $mobile . '\' AND item_id=\'' . $item_id . '\' AND day30=999 AND dau_so_nhan_tin=\'' . _8588 . '\'';
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($item);

        if (!$item) {
            $_db->setQuery('INSERT INTO xs_sms SET
                mobile=\'' . $mobile . '\'
                ,item_id=\'' . $item_id . '\'
                ,dau_so_nhan_tin=\'' . $dau_so_nhan_tin . '\'
                ,msgbody=\'' . $msgbody . '\'
                ,time=0
                ,created=' . time() . '
                ,day30=999
                ,status=0
            ');
            $_db->query();
        } else {
            $_db->setQuery('UPDATE xs_sms SET a_all=\'\',status=0 WHERE id=' . $item->id);
            $_db->query();
        }
    } elseif ($KeywordName == 'KQ MM' && ($dau_so_nhan_tin == _8388 || $dau_so_nhan_tin == _8588)) {
        $date = strval(date('w') + 1);

        $query = 'SELECT id FROM xs_location WHERE code=\'' . $xs_location_code . '\' AND lich LIKE \'%' . $date . '%\'';
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($item);
        if (!$item) {
            $rs->content = $xs_location->name . ' khong mo thuong ngay hom nay';
            $rs->status = 0;
            return $rs;
        }

        $time_start = strtotime(date('d-m-Y', time()) . ' 00:00:00');
        $time_end = strtotime(date('d-m-Y', time()) . ' 23:59:59');

        $query = 'SELECT id,a_all FROM xs_sms WHERE 
                    mobile=\'' . $mobile . '\'
                    AND item_id=\'' . $item_id . '\'
                    AND (dau_so_nhan_tin=\'' . _8388 . '\' OR dau_so_nhan_tin=\'' . _8588 . '\')
                    AND created>=' . $time_start . '
                    AND created<=' . $time_end . '
                    '
        ;
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($xs_sms);

        $kqmm = '';

        if (!$xs_sms || $xs_sms == null) {
            $so1 = rand(0, 99);
            $so2 = rand(0, 99);
            while ($so2 == $so1)
                $so2 = rand(0, 99);
            $so3 = rand(0, 99);
            while ($so3 == $so1 || $so3 == $so2)
                $so3 = rand(0, 99);

            if ($so1 < 10)
                $so1 = '0' . $so1;
            if ($so2 < 10)
                $so2 = '0' . $so2;
            if ($so3 < 10)
                $so3 = '0' . $so3;

            $kqmm = $so1 . '-' . $so2 . '-' . $so3;

            $_db->setQuery('INSERT INTO xs_sms SET
                mobile=\'' . $mobile . '\'
                ,item_id=\'' . $item_id . '\'
                ,dau_so_nhan_tin=\'' . $dau_so_nhan_tin . '\'
                ,msgbody=\'' . $msgbody . '\'
                ,time=0
                ,a_all=\'' . $kqmm . '\'
                ,created=' . time() . '
                ,day30=0
                ,status=0
            ');
            $_db->query();
        }else {
            $kqmm = $xs_sms->a_all;
            if ($kqmm == '') {
                $so1 = rand(0, 99);
                $so2 = rand(0, 99);
                while ($so2 == $so1)
                    $so2 = rand(0, 99);
                $so3 = rand(0, 99);
                while ($so3 == $so1 || $so3 == $so2)
                    $so3 = rand(0, 99);

                if ($so1 < 10)
                    $so1 = '0' . $so1;
                if ($so2 < 10)
                    $so2 = '0' . $so2;
                if ($so3 < 10)
                    $so3 = '0' . $so3;

                $kqmm = $so1 . '-' . $so2 . '-' . $so3;

                $_db->setQuery('UPDATE xs_sms SET a_all=\'' . $kqmm . '\' WHERE id=' . $xs_sms->id);
                $_db->query();
            }
        }

        if ($kqmm != '') {
            $rs->content = $xs_location->name . ': so may man trong ngay hom nay la ' . $kqmm;
            $rs->status = 1;
        } else {
            $rs->content = 'Loi he thong: ' . $time_start . ' - ' . $time_end;
            $rs->status = 0;
        }

        return $rs;
    } else {
        $_db->setQuery('INSERT INTO xs_sms SET
                mobile=\'' . $mobile . '\'
                ,item_id=\'' . $item_id . '\'
                ,dau_so_nhan_tin=\'' . $dau_so_nhan_tin . '\'
                ,msgbody=\'' . $msgbody . '\'
                ,time=' . $time . '
                ,created=' . time() . '
                ,day30=0
                ,status=0
            ');
        $_db->query();
    }

    if ($KeywordName == 'KQ' && $dau_so_nhan_tin == _8088) {
        $rs = KQXS($xs_location_code, $xs_location->name, $time);
        return $rs;
    } elseif ($KeywordName == 'TT TK' && $dau_so_nhan_tin == _8588) {
        $rs->content = TKXS($xs_location_code, $xs_location->name, $so);
        $rs->status = 1;
    } elseif ($KeywordName == 'TT' && $dau_so_nhan_tin == _8588) {
        $rs->content = TTXS($item_id, $xs_location_code, $xs_location->name, $mobile);
        $rs->status = 1;
    } else {
        $rs->content = 'Sai cu phap tin nhan';
        $rs->status = 0;
    }

    return $rs;
}

function KQXS($xs_location_code, $xs_location_name, $time) {
    global $_db;

    if ($time == 0) {
        $query = 'SELECT r.* FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code=\'' . $xs_location_code . '\'
                    ORDER BY r.date DESC 
                    LIMIT 1'
        ;
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($item);
        if (!$item) {
            $rs->content = 'Sai cu phap tin nhan, hoac ko ton tai MA TINH, de xem MA TINH, xin moi vao xoso.com';
            $rs->status = 0;
            return $rs;
        }
    } else {
        $date = date('Y-m-d', $time);
        $query = 'SELECT r.* FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code=\'' . $xs_location_code . '\' AND r.date=\'' . $date . '\'
                    LIMIT 1'
        ;
        $row = $_db->setQuery($query);
        $row = $_db->loadObject($item);
        if (!$item) {
            $rs->content = 'Sai cu phap tin nhan, hoac ko co ket qua ' . $xs_location_name . ' quay ngay ' . date('d/m/Y', $time);
            $rs->status = 0;
            return $rs;
        }
    }

    $content = $xs_location_code . ' ' . date('d/m', strtotime($item->date)) . ":\n";
    $content .= 'DB:' . $item->a0 . "\n";
    $content .= '1:' . $item->a1 . "\n";
    $content .= '2:' . $item->a2 . "\n";
    $content .= '3:' . $item->a3 . "\n";
    $content .= '4:' . $item->a4 . "\n";
    $content .= '5:' . $item->a5 . "\n";
    $content .= '6:' . $item->a6 . "\n";
    $content .= '7:' . $item->a7 . "\n";
    if ($xs_location_code != 'MB' && $item->a8 != '')
        $content .= '8:' . $item->a8 . "\n";

    $rs->content = $content;
    $rs->status = 1;
    return $rs;
}

function getKQXS($xs_location_code) {
    global $_db;

    $query = 'SELECT r.* FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code=\'' . $xs_location_code . '\'
                    ORDER BY r.date DESC 
                    LIMIT 1'
    ;
    $row = $_db->setQuery($query);
    $row = $_db->loadObject($item);
    if (!$item) {
        $rs->content = 'Sai cu phap tin nhan, hoac ko ton tai MA TINH, de xem MA TINH, xin moi vao xoso.com';
        $rs->status = 0;
        return $rs;
    }

    $content = $xs_location_code . ' ' . date('d/m', strtotime($item->date)) . ":\n";
    $content .= 'DB:' . $item->a0 . "\n";
    $content .= '1:' . $item->a1 . "\n";
    $content .= '2:' . $item->a2 . "\n";
    $content .= '3:' . $item->a3 . "\n";
    $content .= '4:' . $item->a4 . "\n";
    $content .= '5:' . $item->a5 . "\n";
    $content .= '6:' . $item->a6 . "\n";
    $content .= '7:' . $item->a7 . "\n";
    if ($xs_location_code != 'MB' && $item->a8 != '')
        $content .= '8:' . $item->a8 . "\n";

    $rs->content = $content;
    $rs->status = 1;
    return $rs;
}

function TKXS($xs_location_code, $xs_location_name, $so) {
    global $_db;

    $so = trim($so);
    $content = '';

    $query = 'SELECT CONCAT_WS(\',\',r.b0,r.b1,r.b2,r.b3,r.b4,r.b5,r.b6,r.b7,r.b8) AS data,r.date
                    FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code=\'' . $xs_location_code . '\''
            . ' ORDER BY r.date DESC'
            . ' LIMIT 0,30'
    ;

    $_db->setQuery($query);
    $list = $_db->loadObjectList();

    if ($list) {
        $count = 0;
        $date = '';
        foreach ($list as $v1) {
            $v2 = $v1->data;
            if (strpos($v2 . ',', $so . ',') !== false) {
                $count++;
                if ($date == '') {
                    $date = $v1->date;
                }
            }
        }

        if ($date != '') {
            $content = $xs_location_name . ': Cap so ' . $so . ' xuat hien ' . $count . ' lan trong 30 ngay gan nhat. Ngay cuoi cung xuat hien la ' . date('d/m/Y', strtotime($date));
        } else {
            $content = $xs_location_name . ': Cap so ' . $so . ' khong xuat hien trong 30 ngay gan nhat';
        }
    } else {
        $content = $xs_location_name . ': Cap so ' . $so . ' khong xuat hien trong 30 ngay gan nhat';
    }

    return $content;
}

function TTXS($item_id, $xs_location_code, $xs_location_name, $mobile) {
    global $_db;

    $content = 'Ban da dang ky thanh cong TTTT ket qua xo so ' . $xs_location_name . ' ngay ' . date('d/m/Y', time());

    $date = date('Y-m-d', time());
    $query = 'SELECT r.* FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.code=\'' . $xs_location_code . '\' AND r.date=\'' . $date . '\'
                    LIMIT 1'
    ;
    $row = $_db->setQuery($query);
    $row = $_db->loadObject($item);
    if ($item) {
        if ($item->a0 == '')
            return $content;

        $content = $xs_location_code . ' ' . date('d/m', time()) . ":\n";
        $content .= 'DB:' . $item->a0 . "\n";
        $content .= '1:' . $item->a1 . "\n";
        $content .= '2:' . $item->a2 . "\n";
        $content .= '3:' . $item->a3 . "\n";
        $content .= '4:' . $item->a4 . "\n";
        $content .= '5:' . $item->a5 . "\n";
        $content .= '6:' . $item->a6 . "\n";
        $content .= '7:' . $item->a7 . "\n";
        if ($xs_location_code != 'MB')
            $content .= '8:' . $item->a8 . "\n";

        $_db->setQuery('UPDATE xs_sms SET status=1 WHERE mobile=\'' . $mobile . '\' AND item_id=\'' . $item_id . '\' AND day30=999');
        $_db->query();
    }

    return $content;
}

function saveSMS($Destination, $SendFrom, $KeywordName, $InContent, $Seqno, $CommMethod) {
    global $_db;

    $_db->setQuery('INSERT INTO xs_mo_receiver SET
        Destination=\'' . $Destination . '\'
        ,SendFrom=\'' . $SendFrom . '\'
        ,KeywordName=\'' . $KeywordName . '\'
        ,InContent=\'' . $InContent . '\'
        ,Seqno=' . $Seqno . '
        ,CommMethod=\'' . $CommMethod . '\'
        ,created=' . time() . '
        ,status=0
        ');
    $_db->query();
}

function updateSMS($Seqno) {
    global $_db;
    $_db->setQuery('UPDATE xs_mo_receiver SET status=1 WHERE Seqno=' . $Seqno);
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

function RemoveSign($str) {
    $coDau = array(
        'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ',
        'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ',
        'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ',
        'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ',
        'ì', 'í', 'ị', 'ỉ', 'ĩ',
        'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ',
        'đ',
        'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ',
        'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ',
        'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ',
        'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ',
        'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ',
        'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ',
        'Đ');

    $khongDau = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
        'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
        'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
        'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
        'i', 'i', 'i', 'i', 'i',
        'y', 'y', 'y', 'y', 'y',
        'd',
        'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A',
        'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O',
        'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E',
        'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U',
        'I', 'I', 'I', 'I', 'I',
        'Y', 'Y', 'Y', 'Y', 'Y',
        'D');

    $str = str_replace($coDau, $khongDau, $str);
    $str = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $str); // a-zA-Z0-9 - = space
    $str = preg_replace("/\s{2,}/i", ' ', $str); // Replace 2 or more space = 1 space

    return $str;
}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
