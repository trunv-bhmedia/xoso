<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class xs_veso extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('xs_veso_model'));
    }

    function index($title_link = '') {
        $catid = 1;
        if ($title_link == 'mien-trung')
            $catid = 2;
        elseif ($title_link == 'mien-nam')
            $catid = 3;
        $row_news = $this->xs_veso_model->get_by(array('catid' => $catid, 'active' => 'yes'));

        if ($row_news) {
            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);
            $this->data['row_news'] = $row_news;

            $search = array('[TITLE]');
            $replace = array($row_news->title);
            $this->data['_meta'] = $this->meta_model->show_title('ve_so', $search, $replace);
        } else {
            redirect($this->data['uri_root'] . '404_override');
        }
        $this->data['xs_veso_catid'] = $catid;
        $this->data['tmpl'] = 'xs_veso/index';
        $this->load->view('layout/content', $this->data);
    }

}