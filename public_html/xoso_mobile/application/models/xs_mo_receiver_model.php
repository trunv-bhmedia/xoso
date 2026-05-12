<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_mo_receiver_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_mo_receiver');
        $this->_table = $_table;
    }

}