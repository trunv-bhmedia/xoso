<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class demo_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('demo');
        $this->_table = $_table;
        $this->primary_key = 'id';
    }

}