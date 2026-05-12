<?php
$deviceToken = 'f2e4a79b30651b5ebe9c1d5c6dda2db1f0b71261f433ff7136719cdffd8c1307'; 
$deviceToken = 'a9b8c40dfb1313053139a605a3e4c6c0a10f0b821dc8f15ba950dadc2ecf462d';
$deviceToken = '99ee1f1eac402207be71c594ee42f9d46aa7dce30331774eb0b4a6f73484c9f9';

$message = "Test ung dung Lich Van Nien";
push($deviceToken,$message);
function push($deviceToken,$message)
	{
		
		$root_dir	=	dirname($_SERVER['SCRIPT_FILENAME']).'/';
		//echo $deviceToken."<br>".$root_dir;
		
			$passphrase = 'son09798';
			// Put your alert message here:
			//$message = 'Ket qua giai dac biet XSMB: 45644!';
				
			////////////////////////////////////////////////////////////////////////////////
				
			$ctx = stream_context_create();
			//stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_developer.pem');
			stream_context_set_option($ctx, 'ssl', 'local_cert', $root_dir."data/".'lichvannien_developer.pem');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
				
			// Open a connection to the APNS server
			$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,
					$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);				
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
			echo $msg;	
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