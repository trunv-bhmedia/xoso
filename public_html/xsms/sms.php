<?php
die;
error_reporting(-1);

// Pull in the NuSOAP code
require_once('libs/nusoap.php');

$client = new nusoap_client('http://112.78.7.141:1500/MVASCONTENT/MTSend.asmx?WSDL', true);
$err = $client->getError();

if ($err) {

    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';

    exit;
} else {

    echo "<h2>Successfully connected</h2>";
}

$client->soap_defencoding = 'UTF-8';
$dienThoai = "84914812898";
$sendfrom = "8017";
$keyword = "KQ MB";
$outcontent = "test dich vu";

$flag = "0";
$SeqNo = "0";
$Total = "1";
$type = "0";
$secu = "xT12#@";//secretcode là xT12#@

$param = array(
    "Destination" => $dienThoai,//so dien thoai
    "SendFrom" => $sendfrom,//dau so 8x17
    "KeywordName" => $keyword,//ma dich vu
    "OutContent" => $outcontent,//noi dung tin nhan
    "ChargingFlag" => $flag,//tinh tien =1, ko tinh =0
    "MOSeqNo" => $SeqNo,//ma tin nhan
    "TotalMessage" => $Total,//tong MT
    "ContentType" => $type,//text =0
    "SecretCode" => $secu,//ma so bi mat VNPAY cung cap
);
$result = $client->call('SendMT', $param);

echo '<p>' . print_r($result, true) . '</p>';
echo $result['SendMTResult'];
?>