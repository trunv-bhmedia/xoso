<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  Nguyen Viet Manh
 * @email   manhnv@binhhoang.com
 * @date    17.04.2012
 */
 
class Iphone_dv_register_receive_ms_model extends MY_Model {
    
    function __construct()
    {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_iphone_dv_register_receive_ms');
        $this->_table = $_table;
    }
    
    function get_result($area)
    {
    	$date = date('Y-m-d');
		$rows	=	$this->db->select('device_token,area_receive,r.id as id_dv_register,r.date_receive,r.nexttime')->from('xs_iphone_device_token d')->join($this->_table.' r','r.id_device_token=d.id')->where(array('r.status' => 1,'d.status' => 1,'area_receive' => $area))->where("r.nexttime != '".$date."'")->limit(10)->order_by('r.nexttime','DESC')->get()->result();		
    	//echo "r.date_receive != '".$date."'";
		return $rows;
    }
     function get_result_token_id($str,$area)
    {
    	$date = date('Y-m-d');
		$rows	=	$this->db->select('device_token,area_receive,r.id as id_dv_register,r.date_receive,r.nexttime')->from('xs_iphone_device_token d')->join($this->_table.' r','r.id_device_token=d.id')->where(array('r.status' => 1,'d.status' => 1,'area_receive' => $area))->where("r.id in(".$str.")")->get()->result();		
    	//echo "r.date_receive != '".$date."'";
		return $rows;
    }
	 function get_result_android($area)
    {
    	$date = date('Y-m-d');
		$rows	=	$this->db->select('device_token,area_receive,r.id as id_dv_register,r.date_receive,r.nexttime')->from('xs_iphone_device_token d')->join($this->_table.' r','r.id_device_token=d.id')->where(array('r.status' => 1,'d.status' => 1,'area_receive' => $area,'d.android' => 1,))->where("r.nexttime != '".$date."'")->limit(10)->order_by('r.nexttime','DESC')->get()->result();		
    	//echo "r.date_receive != '".$date."'";
		return $rows;
    }
}