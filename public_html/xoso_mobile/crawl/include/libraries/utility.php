<?php


function print_debug($level, $message){
	for ($i = 0; $i < $level; $i++){
		echo '==';
	}
	echo '>';
	echo date('Y-m-d H:i:s').' <b>'.$message."</b>\n<br/>";
}