<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_loto_online_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_loto_online');
        $this->_table = $_table;
    }

}