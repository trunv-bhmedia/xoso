<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_location_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_location');
        $this->_table = $_table;
    }

    function getTotalLocation($area) {
        $time = date('H:i');
        if ($time < "12:00") {
//            $date = strval(date('w', strtotime('-1 day')) + 1);
            $date = strval(date('w'));
        } else {
            $date = strval(date('w') + 1);
        }

        $this->db->where("status", 1);
        $this->db->where("area", $area);
        $this->db->like("lich", $date);
        $total = $this->db->select('count(id) AS total')->from('xs_location')->get()->row()->total;
//        echo $this->db->last_query();
        return $total;
    }

    function getLocation($area) {
        if ($area == '') {
            $this->db->where('status', 1);
//            $this->db->where('area <>', 'MB');
            $data = $this->db->select('id,name,alias,area,lich,code,time,description')
                    ->from('xs_location')
                    ->order_by('ordering', 'ASC')
                    ->get()
                    ->result();

            return $data;
//            $items = array();
//            foreach ($data as $value) {
//                $items[$value->area][] = $value;
//            }
//            return $items;
        }

        $date = strval(date('w') + 1);

        $this->db->where('status', 1);
        $this->db->where('area', $area);
        $this->db->like("lich", $date);
        $data = $this->db->select('name')
                ->from('xs_location')
                ->order_by('ordering', 'ASC')
                ->get()
                ->result();
        return $data;
    }

//    function getLocationToday() {
//        $date = strval(date('w') + 1);
//
//        $this->db->where('status', 1);
//        $this->db->like("lich", $date);
//        $data = $this->db->select('name,alias,area,code,time')
//                ->from('xs_location')
//                ->order_by('ordering', 'ASC')
//                ->get()
//                ->result();
//        $items = array();
//        foreach ($data as $value) {
//            $items[$value->area][] = $value;
//        }
//        return $items;
//    }
//    function getLocationLastday() {
//        $date = strval(date('w'));
//
//        $this->db->where('status', 1);
//        $this->db->like("lich", $date);
//        $data = $this->db->select('name,alias,area')
//                ->from('xs_location')
//                ->order_by('ordering', 'ASC')
//                ->get()
//                ->result();
//        $items = array();
//        foreach ($data as $value) {
//            $items[$value->area][] = $value;
//        }
//        return $items;
//    }
}