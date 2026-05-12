<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  Nguyen Viet Manh
 * @email   manhnv@binhhoang.com
 * @date    17.04.2012
 */
 
class Live_model extends MY_Model {
    
    function __construct()
    {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_mobile_live');
        $this->_table = $_table;
    }
    
    function read_xml($area, $date, $state)
    {
    	$file	=	$this->get_file_name($area);
    	$data	=	file_get_contents($file);
    	//print_r($data);die();
    	$data	=	json_decode($data);
    	//print_r($data);die;
    
    	if($state == 1 || $state == 0)
    	{
    		if($data)
    		{
    			if($data->date == $date && $data->area == $area && $data->state == $state)
    			{
    				return $data;
    			}
    		}
    	}
    	else
    	{
    		if($data)
    		{
    			if($data->date == $date && $data->area == $area)
    			{
    				return $data;
    			}
    		}
    	}
    
    	//print_r($data);
    	return NULL;
    }
    
    function create_dir($name = 'xstt')
    {
    	if(!is_dir($name))
    	{
    		mkdir($name,'0777');
    	}
    }
    
    function get_file_name($area = NULL)
    {
    	switch($area)
    	{
    		case 0:
    			$file	=	'mb.txt';
    			break;
    		case 1:
    			$file	=	'mt.txt';
    			break;
    		default :
    			$file	=	'mn.txt';
    			break;
    	}
    	//self::create_dir('xstt');
    	$file	=	'http://www.xoso.com/xstt/'.$file;
    	//die($file);
    	return $file;
    }
    #########################################################################################
    
    //
    function getResultLoto()
    {
    	$time	=	date('H:i');
    	if($time >= '16:13' && $time < '17:15')
    	{
    		$a	=	2;
    	}
    	else if($time >= '17:15' && $time < '17:45')
    		$a = 1;
    	else if($time >= '19:15' && $time < '19:45')
    		$a = 0;
    	switch($a)
    	{
    	case '0':
    	$area = 'MB';
    	break;
    	case '1':
    	$area = 'MT';break;
    	case '2':
    	$area = 'MN';break;
    	 
    	}
    	return ($this->read_xml($a,date('Y-m-d'),-1));
    }
    
}