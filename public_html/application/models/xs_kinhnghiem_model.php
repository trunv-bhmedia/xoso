<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_kinhnghiem_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_kinhnghiem');
        $this->_table = $_table;
    }

}