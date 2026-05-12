<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
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
$task = $_REQUEST['task'];
switch ($task) {

    case 'mega': {
            require_once('listapp/vietlott/get_mega.php');
            get_data();
            break;
        }
    case 'max': {
            require_once('listapp/vietlott/get_max.php');
            get_data();
            break;
        }
    case 'max4ddongay': {
            require_once('ajax/max4ddongay.php');
            $datedove = isset($_REQUEST['datedove']) ? $_REQUEST['datedove'] : '';
            $number_soi = isset($_REQUEST['number_soi']) ? $_REQUEST['number_soi'] : '';

            get_data($datedove, $number_soi);
            break;
        }
    case 'max4ddongay2': {
            require_once('ajax/max4ddongay2.php');
            $datedove = isset($_REQUEST['datedove']) ? $_REQUEST['datedove'] : '';
            get_data($datedove);
            break;
        }
    case 'mega6': {
            require_once('ajax/mega6.php');
            $drawid = isset($_REQUEST['drawId']) ? $_REQUEST['drawId'] : '';
            $gameId = isset($_REQUEST['gameId']) ? $_REQUEST['gameId'] : '';

            get_data($drawid);
            break;
        }
    case 'power6': {
            require_once('ajax/power6.php');
            $drawid = isset($_REQUEST['drawId']) ? $_REQUEST['drawId'] : '';
            $gameId = isset($_REQUEST['gameId']) ? $_REQUEST['gameId'] : '';

            get_data($drawid);
            break;
        }
    case 'mega6new': {
            require_once('ajax/mega6new.php');
            $drawid = isset($_REQUEST['drawId']) ? $_REQUEST['drawId'] : '';
            $gameId = isset($_REQUEST['gameId']) ? $_REQUEST['gameId'] : '';

            get_data($drawid);
            break;
        }
    case 'power6new': {
            require_once('ajax/power6new.php');
            $drawid = isset($_REQUEST['drawId']) ? $_REQUEST['drawId'] : '';
            $gameId = isset($_REQUEST['gameId']) ? $_REQUEST['gameId'] : '';

            get_data($drawid);
            break;
        }
    case 'mega6thang': {
            require_once('ajax/mega6thang.php');
            $nam = isset($_REQUEST['datedovenam']) ? $_REQUEST['datedovenam'] : '';
            $thang = isset($_REQUEST['datedovethang']) ? $_REQUEST['datedovethang'] : '';

            get_data($thang, $nam);
            break;
        }
    case 'power6thang': {
            require_once('ajax/power6thang.php');
            $nam = isset($_REQUEST['datedovenam']) ? $_REQUEST['datedovenam'] : '';
            $thang = isset($_REQUEST['datedovethang']) ? $_REQUEST['datedovethang'] : '';

            get_data($thang, $nam);
            break;
        }
    case 'mega6gt': {
            require_once('ajax/mega6gt.php');
            get_data();
            break;
        }
    case 'mega6dongay': {
            require_once('ajax/mega6dongay.php');
            $dsSoDo = isset($_REQUEST['dsSoDo']) ? $_REQUEST['dsSoDo'] : '';
            $datedove = isset($_REQUEST['datedove']) ? $_REQUEST['datedove'] : '';
            get_data($datedove, $dsSoDo);
            break;
        }
    case 'power6dongay': {
            require_once('ajax/power6dongay.php');
            $dsSoDo = isset($_REQUEST['dsSoDo']) ? $_REQUEST['dsSoDo'] : '';
            $datedove = isset($_REQUEST['datedove']) ? $_REQUEST['datedove'] : '';
            get_data($datedove, $dsSoDo);
            break;
        }
    case 'max4d': {
            require_once('ajax/max4d.php');
            $drawid = isset($_REQUEST['drawId']) ? $_REQUEST['drawId'] : '';
            get_data($drawid);
            break;
        }
    case 'mega6newSelecBoSo': {
            require_once('ajax/mega6newSelecBoSo.php');
            $typeNumber = isset($_REQUEST['typeNumber']) ? $_REQUEST['typeNumber'] : '';
            $baoSo = isset($_REQUEST['baoSo']) ? $_REQUEST['baoSo'] : '';
            get_data($typeNumber,$baoSo);
            break;
        }
    case 'mapdata': {
            require_once('mapdata.php');
            get_data();
            break;
        }
    case 'mientrung': {
            require_once('mientrung.php');
            get_data();
            break;
        }
}
// http://choigame.com/hainh/index.php?option=&task=getcategory&host=gamek
// http://choigame.com/hainh/index.php?option=&task=getnews&host=game24h

// http://choigame.com/hainh/index.php?option=&task=getfile&host=file_24h
// http://choigame.com/hainh/index.php?option=&task=getnews&host=game24h
