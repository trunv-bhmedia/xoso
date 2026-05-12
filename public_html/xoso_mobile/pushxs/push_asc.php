<?php
include "connect.php";
@set_time_limit(60 * 180);

//_push('7e45a99aba59e3ef88e23d268c1ef47479f102efc6c95452591ceaea204af0bb', 'push live nhe');die;



function get_dv($id){
	$db = new MyDBO();
	$sql = "SELECT *
	FROM `xs_iphone_device_token` WHERE id=$id and `status` = 1 ORDER BY time_create DESC LIMIT 1";
	//echo $sql;
	$rows = $db->get_rows($sql);	
	return $rows;
}


function get_register_receive_ms($area)
{
	$db = new MyDBO();
	$today = date('Y-m-d');
	$sql = "select * from xs_iphone_dv_register_receive_ms where area_receive='".$area."' and status=1 and nexttime!='$today' order by id_device_token desc limit 100";
	//echo $sql;die;
	$rows = $db->get_rows($sql);	
	return $rows;
}


$site = "http://m.xoso.com:81/";
$link = array(
	$site . 'ttttmb.php',
	$site . 'ttttmt.php',
	$site . 'ttttmn.php'
);



$area = $_REQUEST['area'];

switch ($area) 
{
	case '0':
		$locationID = 'MB';
		break;
	case '1':
		$locationID = 'MT';
		break;
	case '2':
		$locationID = 'MN';
		break;
}
//var_dump($link[$area]); die;
$xml = simplexml_load_file($link[$area], 'SimpleXMLElement', LIBXML_NOCDATA);
$url_run = "http://m.xoso.com:81/pushxs/push.php?area=".$area;
//var_dump($url_run); die;
if($area !=0){
	 foreach (get_object_vars($xml) as $code => $item) {
			$arrayReg = get_register_receive_ms($locationID);	
			//var_dump($arrayReg); die;
			if(count($arrayReg)==0) $area = "";
			$countk = intval(count($arrayReg)/25);
			$message = "KQXS ".$item->name.": G:DB:" . $item->giaidacbietsauso. ", G:Nhat: ". $item->giainhat. ", G:Nhi: ". $item->giainhi. ", G:Ba: ". $item->giaiba. ", G:Tu: ". $item->giaitu. ", G:Nam: ". $item->giainam. ", G:Sau: ". $item->giaisau. ", G:Bay: ". $item->giaibay;
			
			if($item->status =='quayxong'){					
				foreach($arrayReg as $k=>$item2)
				{
					//print_r($item2);
					$arrayDev = get_dv($item2->id_device_token);
					$device_token = $arrayDev[0]->device_token;
					if($arrayDev[0]->android == 0){
						//for ($k=0; $k<$countk; $k++){ //lay ra 25 devices de gui push
						//var_dump($device_token.'<hr>'.$message); die;
							if(_push($device_token, $message))
							{
								update_nexttime($item2->id);			
							}
						//}					
					}else{
					 $arrDeviceID = array($device_token);
					//echo $device_token . "<br>";
					 $arrMassage = array("price" => $message);
					if (send_notification($arrDeviceID, $arrMassage)) {
						update_nexttime($item2->id);			
						}
					}
				}
				
			}	
			//echo $message;
	 }
	// push_again($url_run);
}else{ //Mien bac
	$arrayReg = get_register_receive_ms($locationID);
	if(count($arrayReg)==0) $area = "";
	$message = "KQXS Mien Bac: G:DB:" . $xml->giaidacbiet. ", G:Nhat: ". $xml->giainhat. ", G:Nhi: ". $xml->giainhi. ", G:Ba: ". $xml->giaiba. ", G:Tu: ". $xml->giaitu. ", G:Nam: ". $xml->giainam. ", G:Sau: ". $xml->giaisau. ", G:bay: ". $xml->giaibay;
	//echo $message;
	//_push("cea11a0b3692bc34a04c883b2be647466095edfed992902dacbe75694483b6ca", $message);
	if($xml->status =='quayxong'){		
		foreach($arrayReg as $k=>$item2)
		{
			$arrayDev = get_dv($item2->id_device_token);				
			$device_token = $arrayDev[0]->device_token; //"cea11a0b3692bc34a04c883b2be647466095edfed992902dacbe75694483b6ca";//
			if($arrayDev[0]->android == 0){
				//for ($k=0; $k<$countk; $k++){ //lay ra 25 devices de gui push
					if(_push($device_token, $message))
					{
						update_nexttime($item2->id);			
					}
			//	}								
			}else{
			 $arrDeviceID = array($device_token);
			//echo $device_token . "<br>";
			 $arrMassage = array("price" => $message);
			if (send_notification($arrDeviceID, $arrMassage)) {
				update_nexttime($item2->id);			
				}
			}
		}
		
	}
	//push_again($url_run);
}

$param['area']		=	$area;
if ($area !="") echo refresh($param,4000);

//print_r(get_register_receive_ms('MB')); die;

function update_nexttime($id)
{
	$db = new MyDBO();$today = date('Y-m-d');
	$sql = "update xs_iphone_dv_register_receive_ms set nexttime= '$today' where id=".$id;
	echo $sql;
	$db->run_query($sql);
	return;
}
function _push($deviceToken, $message) {

        //die('asasasa');
        $root_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/';       
        $passphrase = 'bhmedia08';      
        $ctx = stream_context_create();
        //stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_developer.pem');
		//var_dump($root_dir . "data/ssl/" . 'xoso_dis.pem'); die;
        stream_context_set_option($ctx, 'ssl', 'local_cert', $root_dir . "data/ssl/" . 'xoso_dis_1.pem');
		//echo base_url();
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
		//$fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp) {
            echo ("Failed to connect: $err $errstr" . PHP_EOL);
            return FALSE;
        }
        //echo 'Connected to APNS' . PHP_EOL;
        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        //	echo $msg;	
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        fclose($fp);
        if (!$result) {           
            return false; //echo 'Message not delivered' . PHP_EOL;
        } else {
            //die('asasasasa');
            return true; //echo 'Message successfully delivered' . PHP_EOL;
        }

        // Close the connection to the server
    }


//push android
	function send_notification($registatoin_ids, $message) {
        // include config
       // require_once('config.php');

        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        echo $result;
		return true;
    }

function push_again($link,&$content = ''){ 

	 $curl_options_html = array(
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => true,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11", // who am i
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	); 
	$ch = curl_init($link);
	 curl_setopt_array( $ch, $curl_options_html );
	$content = curl_exec ($ch);
	$header_items=curl_getinfo($ch);
	curl_close ($ch);

	return $header_items;
 }
 
function refresh($param, $time = 4000 )
	{
		ob_start();
		?>
		<html>
			<script type="text/javascript">
			function submit()
			{
				setTimeout("document.form_refresh_getcontent.submit();", <?php echo $time; ?>);
			}				
			</script>
			<body onLoad="submit();">
			<center>
				<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333">
					<h3 name="title">
						
					</h3>
				
					<h4><?php  // e cho $_REQUEST['task']; ?></h4>
					<h4>(<i><?php echo date('Y-m-d H:i:s') ?></i>)</h4>
					</font>
				</center>
				<form name="form_refresh_getcontent" action="push_asc.php" method="GET">
					<?php
						foreach ($param as $k=>$value)
						{
							?>
								<input type="hidden" name="<?php echo $k; ?>" value="<?php echo $value; ?>" />
							<?php
						}
					?>
				</form>
			</body>
		</html>
		<?php		
		$str	=	ob_get_contents();
		ob_clean();	
		return $str;
	}
		
?>