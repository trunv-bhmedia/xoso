<?php 
require_once('include/connect/connect.php');
require_once('include/connect/connect2.php');
require_once('include/connect/db.php');
require_once('include/libraries/href.php');
require_once('include/libraries/parse.php');
require_once('include/libraries/phpWebHacks.php');
require_once('include/function.php');
require_once('include/libraries/autocuttext.php');
require_once('include/libraries/tidy_clean.php');
require_once('include/libraries/class.convert.utf8.php');
// header('Content-Type: text/html; charset=gb2312');
header('Content-Type: text/html; charset=utf-8');
$task	=	$_REQUEST['task'];
switch ($task)
{	
    case 'mega':{
    	require_once('listapp/vietlott/get_mega.php');
    	get_data();
    	break;
    }
    case 'max':{
    	require_once('listapp/vietlott/get_max.php');
    	get_data();
    	break;
    }
	case 'mega6':{
    	require_once('ajax/mega6.php');
		$drawid	=	isset($_REQUEST['drawId']) ? $_REQUEST['drawId'] : '';
		$gameId	=	isset($_REQUEST['gameId']) ? $_REQUEST['gameId'] : '';
		
		get_data($drawid);
    	break;
    }
	case 'max4d':{
    	require_once('ajax/max4d.php');
		$drawid	=	isset($_REQUEST['drawId']) ? $_REQUEST['drawId'] : '';			
		get_data($drawid);
    	break;
    }
	case 'mapdata':{	
    	require_once('mapdata.php');
    	get_data();
    	break;
    }
    
}
// http://choigame.com/hainh/index.php?option=&task=getcategory&host=gamek
// http://choigame.com/hainh/index.php?option=&task=getnews&host=game24h

// http://choigame.com/hainh/index.php?option=&task=getfile&host=file_24h
// http://choigame.com/hainh/index.php?option=&task=getnews&host=game24h
