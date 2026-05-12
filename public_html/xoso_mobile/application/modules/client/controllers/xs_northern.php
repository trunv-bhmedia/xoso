<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class xs_northern extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model('xs_northern_model');
    }

    function index() {
        $from_date = date('Y-m-d', strtotime('-7 days'));

        $rows = $this->db->select("id,data,date,type")->from("xs_northern")
                ->where("date >=", $from_date)
                ->order_by("date", "DESC")
                ->order_by("id", "DESC")
                ->get()
                ->result();
//        echo $this->db->last_query();

        if (!$rows)
            redirect($this->data['uri_root'] . '404_override');

        $items = array();
        foreach ($rows as $k => $row) {
            $items[$row->date][$row->type] = $row;
        }

        $this->data['rows'] = $items;
        $this->data['date'] = date('d-m-Y');
        $this->data['alias'] = 'xo-so-dien-toan';

        $this->data['_meta'] = $this->meta_model->show_title('dien_toan');
        $this->data["tmpl"] = "xs_northern/index";
        $this->load->view("layout/content", $this->data);
    }

    function byday($date) {
        $to_date = date('Y-m-d', strtotime($date));
        $from_date = date('Y-m-d', strtotime($date . '-7 days'));

        $rows = $this->db->select("id,data,date,type")->from("xs_northern")
                ->where("date >=", $from_date)
                ->where("date <=", $to_date)
                ->order_by("date", "DESC")
                ->order_by("id", "DESC")
                ->get()
                ->result();
//        echo $this->db->last_query();

        if (!$rows)
            redirect($this->data['uri_root'] . '404_override');

        $items = array();
        foreach ($rows as $k => $row) {
            $items[$row->date][$row->type] = $row;
        }

        $this->data['rows'] = $items;
        $this->data['date'] = $date;
        $this->data['alias'] = 'xo-so-dien-toan';

        $this->data['_meta'] = $this->meta_model->show_title('dien_toan');
        $this->data["tmpl"] = "xs_northern/index";
        $this->load->view("layout/content", $this->data);
    }

    function bytype($type, $date) {
        $to_date = date('Y-m-d', strtotime($date));

        if ($type == '6X36') {
            $this->db->where("type", 'DT6x36');
            $this->db->limit(8, 0);
        } elseif ($type == '1*2*3') {
            $this->db->where("type", 'DT123');
            $this->db->limit(8, 0);
        } elseif ($type == 'than-tai') {
            $this->db->where("type", 'TT');
            $this->db->limit(8, 0);
        } else {
            $from_date = date('Y-m-d', strtotime($date . '-7 days'));
            $this->db->where("date >=", $from_date);
        }

        $rows = $this->db->select("id,data,date,type")->from("xs_northern")
                ->where("date <=", $to_date)
                ->order_by("date", "DESC")
                ->order_by("id", "DESC")
                ->get()
                ->result();
//        echo $this->db->last_query();

        if (!$rows)
            redirect($this->data['uri_root'] . '404_override');

        $items = array();
        foreach ($rows as $k => $row) {
            $items[$row->date][$row->type] = $row;
        }

        $this->data['rows'] = $items;
        $this->data['date'] = $date;
        $this->data['alias'] = 'xo-so-dien-toan/' . $type;

        $this->data['_meta'] = $this->meta_model->show_title('dien_toan');
        $this->data["tmpl"] = "xs_northern/index";
        $this->load->view("layout/content", $this->data);
    }

}