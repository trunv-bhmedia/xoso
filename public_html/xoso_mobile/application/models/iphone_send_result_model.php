<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  Nguyen Viet Manh
 * @email   manhnv@binhhoang.com
 * @date    17.04.2012
 */
 
class Iphone_send_result_model extends MY_Model {
    
    function __construct()
    {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_iphone_send_result');
        $this->_table = $_table;
    }
    
}