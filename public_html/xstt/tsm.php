<?php




function reportError($title, $content)
{
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: ducdm87 <ducdm87@gmail.com> '."\r\n".
    //			'CC: hainh <hainh@binhhoang.com>, cuongph <cuongph@binhhoang.com>'."\r\n".
            'BCC: '."\r\n";
    $send = mail("ducdm@binhhoang.com",$title, $content,$headers);	
}


reportError("test 114","noi dung mail");