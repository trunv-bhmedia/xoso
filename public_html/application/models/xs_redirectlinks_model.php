<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_redirectlinks_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_redirectlinks');
        $this->_table = $_table;
        $this->primary_key = 'id';
    }

}