<?php

$deviceToken = '68b0444d209cc78bc29bd2127fab4ce952c780b58e9ffbc586c72e3da2e4cde1'; 
$message = "Test ung dung Ngay hoang dao";

push($deviceToken,$message);
echo "test xong";
function push($deviceToken,$message)
	{
		

		$root_dir	=	dirname($_SERVER['SCRIPT_FILENAME']).'/';
		echo $root_dir;
		//$rows	=	$this->iphone_device_token_model->get_all();
		//foreach($rows as $k => $v){
			//$deviceToken = $v->device_token;//'d9146b0f0f1313761725c10d9184f64a2e0e19436165f161212d7f8a60e929d7';
			//die($root_dir);
			//die($root_dir);
			// Put your device token here (without spaces):
			//$deviceToken = 'd9146b0f0f1313761725c10d9184f64a2e0e19436165f161212d7f8a60e929d7';
				
			// Put your private key's passphrase here:
			$passphrase = 'son09798';
			//$passphrase	=	'';
				
			// Put your alert message here:
			//$message = 'Ket qua giai dac biet XSMB: 45644!';
				
			////////////////////////////////////////////////////////////////////////////////
				
			$ctx = stream_context_create();
			//stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_developer.pem');
			stream_context_set_option($ctx, 'ssl', 'local_cert', $root_dir."data/ssl/".'lich2014_distribution.pem');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
				
			// Open a connection to the APNS server
			$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);				
			//if (!$fp)
				//exit("Failed to connect: $err $errstr" . PHP_EOL);
				
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
			if (!$result){
				//die('asasa');
				//echo 'Message not delivered' . PHP_EOL;
				return false;//echo 'Message not delivered' . PHP_EOL;
			}
			else{
				//die('asasasasa');
				return true;//echo 'Message successfully delivered' . PHP_EOL;
			}
				
			// Close the connection to the server
		
		}

?>