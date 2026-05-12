<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_northern_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_northern');
        $this->_table = $_table;
        $this->primary_key = 'id';
    }

    function getResult() {
        $row = $this->db->select('data,date')
                ->from('xs_northern')
                ->where("status", 1)
                ->where("type", 'DT6x36')
                ->order_by('date', 'DESC')
                ->get()
                ->row();

        $result['DT6x36'] = $row;

        $row = $this->db->select('data,date')
                ->from('xs_northern')
                ->where("status", 1)
                ->where("type", 'DT123')
                ->order_by('date', 'DESC')
                ->get()
                ->row();

        $result['DT123'] = $row;

        $row = $this->db->select('data,date')
                ->from('xs_northern')
                ->where("status", 1)
                ->where("type", 'TT')
                ->order_by('date', 'DESC')
                ->get()
                ->row();

        $result['TT'] = $row;

        return $result;
    }

    function getResultTT() {
        $time = date('H:i');
        if ($time < "12:00")
            $date = date('Y-m-d', strtotime('-1 day'));
        else
            $date = date('Y-m-d');

        $row = $this->db->select('data,date')
                ->from('xs_northern')
                ->where("date", $date)
                ->where("type", 'DT6x36')
                ->order_by('date', 'DESC')
                ->get()
                ->row();

        $result['DT6x36'] = $row;

        $row = $this->db->select('data,date')
                ->from('xs_northern')
                ->where("date", $date)
                ->where("type", 'DT123')
                ->order_by('date', 'DESC')
                ->get()
                ->row();

        $result['DT123'] = $row;

        $row = $this->db->select('data,date')
                ->from('xs_northern')
                ->where("date", $date)
                ->where("type", 'TT')
                ->order_by('date', 'DESC')
                ->get()
                ->row();

        $result['TT'] = $row;

        return $result;
    }

}