<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_statistics_site_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_statistics_site');
        $this->_table = $_table;
    }

}