<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  Nguyen Viet Manh
 * @email   manhnv@binhhoang.com
 * @date    17.04.2012
 */
 
class Mobile_detect_loto_model extends MY_Model {
    
    function __construct()
    {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_mobile_detect_loto');
        $this->_table = $_table;
    }
    
}