<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class mua_online extends Client {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['_meta'] = $this->meta_model->show_title('mua_online');
        $this->data["tmpl"] = "mua_online/index";
        $this->load->view("layout/content", $this->data);
    }

}