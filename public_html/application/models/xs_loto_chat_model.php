<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_loto_chat_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_loto_chat');
        $this->_table = $_table;
    }

}