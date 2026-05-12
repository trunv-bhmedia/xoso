<?php 
require_once('connect/connect.php');
require_once('connect/db.php');
require_once('libraries/href.php');
require_once('libraries/parse.php');
require_once('libraries/phpWebHacks.php');
require_once('function.php');
require_once('libraries/autocuttext.php');

$task	=	$_REQUEST['task'];
switch ($task)
{
	
	case 'tv':{
			require_once('tv.php');
			get_data();
			break;
		}	
}
