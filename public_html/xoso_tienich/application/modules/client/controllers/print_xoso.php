<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class print_xoso extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model('xs_result_model');
    }

    public function index() {
        $search = array();
        $replace = array();
        $this->data['_meta'] = $this->meta_model->show_title('home', $search, $replace);

        $this->data['tmpl'] = 'print_xoso/index';
        $this->load->view('layout/content', $this->data);
    }

    public function vedo() {
        $date = (isset($_GET['d']) ? $_GET['d'] : date('d-m-Y'));
        $lid = (isset($_GET['l']) ? $_GET['l'] : 0);
        $type = (isset($_GET['t']) ? $_GET['t'] : 0);

        $search = array();
        $replace = array();
        $this->data['_meta'] = $this->meta_model->show_title('home', $search, $replace);

        $this->data['items'] = array();
        if ($lid > 0 && $type > 0)
            $this->data['items'] = $this->xs_result_model->InVeDo($date, $lid);

        $this->data['date'] = $date;
        $this->data['lid'] = $lid;
        $this->data['type'] = $type;
        if ($lid == 1)
            $this->load->view('print_xoso/vedo_mb', $this->data);
        else
            $this->load->view('print_xoso/vedo', $this->data);
    }

}