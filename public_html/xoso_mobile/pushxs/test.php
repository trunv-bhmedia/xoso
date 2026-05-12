<?php
//$deviceToken = 'f2e4a79b30651b5ebe9c1d5c6dda2db1f0b71261f433ff7136719cdffd8c1307'; 
//$deviceToken = 'a9b8c40dfb1313053139a605a3e4c6c0a10f0b821dc8f15ba950dadc2ecf462d';
$deviceToken = 'cea11a0b3692bc34a04c883b2be647466095edfed992902dacbe75694483b6ca';
//$deviceToken = "bc215dccaee96c2059ab5266888fc12fcb2406f43256186b4479bff9caece678"; // Tuyen

$message = "Test ung dung Xoso cua CR7";

_push09($deviceToken,$message);

echo "Push ok"; 
function _push($deviceToken, $message) {

       
        $root_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/';       
        $passphrase = 'bhmedia08';      
        $filePem	=	'/home/xoso/public_html/xoso_mobile/pushxs/data/ssl/dev_xoso.pem';			
		
		$ctx = stream_context_create();	
		stream_context_set_option($ctx, 'ssl', 'local_cert', $filePem);
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		$fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
        if (!$fp) {
            echo ("Failed to connect: $err $errstr" . PHP_EOL);
            return FALSE;
        }
		
		
		
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

	
function push($deviceToken,$message)
	{
		
		$root_dir	=	dirname($_SERVER['SCRIPT_FILENAME']).'/';
		//echo $deviceToken."<br>".$root_dir;
		
			$passphrase = 'bhmedia08';
			// Put your alert message here:
			//$message = 'Ket qua giai dac biet XSMB: 45644!';
				
			////////////////////////////////////////////////////////////////////////////////
				
			$ctx = stream_context_create();
			//stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_developer.pem');
			stream_context_set_option($ctx, 'ssl', 'local_cert', $root_dir."data/ssl/".'dev_xoso.pem');
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
		
function _push09($deviceToken, $message) {

        //die('asasasa');
		//echo $deviceToken;
        $root_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/';       
        $passphrase = 'bhmedia08';      
        $ctx = stream_context_create();
        //stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_developer.pem');
		//echo "ddddddd";
        stream_context_set_option($ctx, 'ssl', 'local_cert', $root_dir . "data/ssl/" . 'xoso_distribution.pem');
		//echo base_url();
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
		//$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);	
        if (!$fp) {
            echo ("Failed to connect: $err $errstr" . PHP_EOL);
            return FALSE;
        }
		//echo "dddddddrrrrrrrrrr";
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

?>