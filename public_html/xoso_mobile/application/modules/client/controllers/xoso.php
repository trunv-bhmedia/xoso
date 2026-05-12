<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class XoSo extends Client {

    function __construct() {
        parent::__construct();
    }

    public function home($date) {
        $this->load->model('xs_result_model');

        $this->data['items'] = $this->xs_result_model->getItemsHome($date);

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array($date, $date);
        $this->data['_meta'] = $this->meta_model->show_title('ket_qua_xo_so', $search, $replace);

        $this->data['alias'] = $alias;
        $this->data['tmpl'] = 'xoso/home';
        $this->load->view('layout/content', $this->data);
    }

    public function index($alias) {
        $this->load->model('xs_result_model');

        if ($alias == $this->data['url_mientrung'] || $alias == $this->data['url_miennam'])
            $this->data['items'] = true;
        else
            $this->data['items'] = $this->xs_result_model->getItems($alias);

        if (!$this->data['items'])
            redirect($this->data['uri_root'] . '404_override');

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array('', '');
        if (isset($this->data['items'][0]))
            $replace = array($this->data['items'][0]->name, strtolower(RemoveSign($this->data['items'][0]->name)));
        elseif ($alias == $this->data['url_mienbac'])
            $replace = array('Miền Bắc', 'mien bac');
        elseif ($alias == $this->data['url_mientrung'])
            $replace = array('Miền Trung', 'mien trung');
        elseif ($alias == $this->data['url_miennam'])
            $replace = array('Miền Nam', 'mien nam');
        $this->data['_meta'] = $this->meta_model->show_title('ket_qua_xo_so', $search, $replace);

        $this->data['alias'] = $alias;
        if ($alias == $this->data['url_mientrung'] || $alias == $this->data['url_miennam'])
            $this->data['tmpl'] = 'xoso/index_mtmn';
        else
            $this->data['tmpl'] = 'xoso/index';

        $this->load->view('layout/content', $this->data);
    }

    public function filter_th($alias, $th) {
        $this->load->model('xs_result_model');

        $this->data['items'] = $this->xs_result_model->getItemsFilterTH($alias, $th);

        if (!$this->data['items'])
            redirect($this->data['uri_root'] . '404_override');

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array('', '');
        if ($alias == $this->data['url_mienbac'])
            $replace = array('Miền Bắc', 'mien bac');
        elseif ($alias == $this->data['url_mientrung'])
            $replace = array('Miền Trung', 'mien trung');
        elseif ($alias == $this->data['url_miennam'])
            $replace = array('Miền Nam', 'mien nam');
        $this->data['_meta'] = $this->meta_model->show_title('ket_qua_xo_so', $search, $replace);

        $this->data['alias'] = $alias;
        $this->data['tmpl'] = 'xoso/index';
        $this->load->view('layout/content', $this->data);
    }

    public function filter_date($alias, $date) {
        $this->load->model('xs_result_model');

        if ($alias == $this->data['url_mientrung'] || $alias == $this->data['url_miennam'])
            $this->data['items'] = true;
        else
            $this->data['items'] = $this->xs_result_model->getItemsFilterDate($alias, $date);

        if (!$this->data['items'])
            redirect($this->data['uri_root'] . '404_override');

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array($date, $date);
        if (isset($this->data['items'][0]))
            $replace = array($this->data['items'][0]->name . ' ngày ' . $date, strtolower(RemoveSign($this->data['items'][0]->name)) . ' ngay ' . $date);
        elseif ($alias == $this->data['url_mienbac'])
            $replace = array('Miền Bắc ngày ' . $date, 'mien bac ngay ' . $date);
        elseif ($alias == $this->data['url_mientrung'])
            $replace = array('Miền Trung ngày ' . $date, 'mien trung ngay ' . $date);
        elseif ($alias == $this->data['url_miennam'])
            $replace = array('Miền Nam ngày ' . $date, 'mien nam ngay ' . $date);
        $this->data['_meta'] = $this->meta_model->show_title('ket_qua_xo_so', $search, $replace);

        $this->data['alias'] = $alias;
        $this->data['date'] = $date;

        if ($alias == $this->data['url_mientrung'] || $alias == $this->data['url_miennam'])
            $this->data['tmpl'] = 'xoso/index_mtmn';
        else
            $this->data['tmpl'] = 'xoso/index';

        $this->load->view('layout/content', $this->data);
    }

    public function loadkqxs($area, $date) {
        $this->load->model('xs_result_model');
        $this->data['items'] = $this->xs_result_model->loadKQXS($area, date('Y-m-d', $date));
        $this->load->view('xoso/loadkqxs', $this->data);
    }

    public function xstt($area = 'MB') {
        $time = date('H:i');
        if ($time > '16:00' && $time < '19:00')
            header("Cache-Control: max-age=3");

        $this->load->model('xs_result_model');
        $result = $this->xs_result_model->getResultLoto($area);
        
        $this->data['timer'] = (isset($_GET['t']) ? $_GET['t'] : '');
        $this->data['data'] = $result->cache->data;
        $this->data['area'] = $area;
        $this->load->view('xoso/xstt', $this->data);
    }

}