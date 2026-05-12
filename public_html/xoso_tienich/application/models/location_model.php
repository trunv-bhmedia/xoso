<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  Nguyen Viet Manh
 * @email   manhnv@binhhoang.com
 * @date    17.04.2012
 */
 
class Location_model extends MY_Model {
    
    function __construct()
    {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_location');
        $this->_table = $_table;
    }
    
    function get_locations_by_area($area = '')
    {
    	$cur_date = date('Y-m-d');
    	//$date	=	date('y-m-d',strtotime("$cur_date -1 days"));
    	$date		= strval(date('w') + 1);
    	$q	=	$this->db->select('l.*')->from($this->_table.' l')->where("lich LIKE '%".$date."%'")->where('area',$area)->order_by('area ASC,ordering ASC')->get();
    	$rows	=	 $q->result();
    	$str = '';
    	foreach($rows as $k => $v)
    	{
    		$str .= ($str == '' ? '' : ',').$v->id;
    		$rows[$k]->now = 1;
    	}
    	//echo $str;
    	$q	=	$this->db->select('l.*')->from($this->_table.' l')->where('id NOT IN('.$str.')')->where('area',$area)->order_by('area ASC,ordering ASC')->get()->result();
    	foreach($q as $k => $v)
    	{
    		$v->now = 0;
    		$rows[]= $v;
    	}
    	//echo "<pre>";
    	//print_r($rows);
    	return $rows;
    }
    
}