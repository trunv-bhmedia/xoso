<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_lotonuoi_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_lotonuoi');
        $this->_table = $_table;
    }

}