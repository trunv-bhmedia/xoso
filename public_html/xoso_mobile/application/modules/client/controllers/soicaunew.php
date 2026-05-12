<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class soicaunew extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('xs_result_model', 'xs_statistics_model'));
    }

    public function index() {
        $this->data['limit'] = (isset($_GET['limit']) ? $_GET['limit'] : 5);
        $this->data['exactlimit'] = (isset($_GET['exactlimit']) ? $_GET['exactlimit'] : 0);
        $this->data['ngay'] = (isset($_GET['ngay']) ? $_GET['ngay'] : date('d-m-Y', strtotime('+1 days')));
        $this->data['setmode'] = (isset($_GET['setmode']) ? $_GET['setmode'] : 'full');
        $this->data['nhay'] = (isset($_GET['nhay']) ? $_GET['nhay'] : 1);
        $this->data['db'] = (isset($_GET['db']) ? $_GET['db'] : 0);
        $this->data['lon'] = (isset($_GET['lon']) ? $_GET['lon'] : 1);

        $mang_so = array();
        if ($this->data['setmode'] == 'num') {
            $this->data['limit'] = (isset($_GET['limit']) ? $_GET['limit'] : 3);
            $this->data['timcau'] = (isset($_GET['timcau']) ? $_GET['timcau'] : '');
            if ($this->data['timcau'] != '') {
                $mang_so = explode(',', $this->data['timcau']);
            }
        }

        $lid = 1;
        $arr_rs = $this->xs_statistics_model->soiCauNew($lid, $this->data['ngay'], $this->data['db'], $this->data['lon'], $this->data['nhay'], $this->data['limit']);
        $this->data['ngay'] = $arr_rs['ngay'];
        $this->data['max_cau'] = $arr_rs['max_cau'];
        $data = $arr_rs['data'];
        $this->data['data_limit'] = $arr_rs['data_limit'];
        $this->data['data_nextlimit'] = $arr_rs['data_nextlimit'];
        $this->data['matrancau'] = $arr_rs['matrancau'];

        $query = "SELECT `date`,a0,a1,a2,a3,a4,a5,a6,a7,extension
                    FROM xs_result
                    WHERE lid=" . Quote($lid)
                . " AND date=" . Quote(date('Y-m-d', strtotime($this->data['ngay'])))
        ;
        $result_cau = $this->db->query($query)->row();

        if ($result_cau) {
            $result_cau->dateOfWeek = $this->xs_result_model->getDateOfWeek($result_cau->date);
            $result_cau->extra = json_decode($result_cau->extension);
        }

        $this->data['result_cau'] = $result_cau;

        if ($this->data['setmode'] == 'num') {
            $ds_cau = array();
            if ($this->data['timcau'] != '') {
                foreach ($mang_so as $so) {
                    $data_so = '';
                    if ($this->data['lon'] == 1) {
                        $arr = str_split($so);
                        if ($arr[0] != $arr[1]) {
                            if ($arr[0] > $arr[1])
                                $data_so = $arr[1] . $arr[0] . ',' . $arr[0] . $arr[1];
                            else
                                $data_so = $arr[0] . $arr[1] . ',' . $arr[1] . $arr[0];
                        }else {
                            $data_so = $so;
                        }
                    } else {
                        $data_so = $so;
                    }
                    foreach ($data as $vitri => $value) {
                        if ($value['so'] == $so && $value['cau'] >= $this->data['limit']) {
                            $ds_cau[$data_so][$vitri] = $value['cau'];
                        }
                        if ($this->data['lon'] == 1) {
                            if ($value['so'] == ($arr[1] . $arr[0]) && $value['cau'] >= $this->data['limit']) {
                                $ds_cau[$data_so][$vitri] = $value['cau'];
                            }
                        }
                    }
                    if (isset($ds_cau[$data_so]))
                        arsort($ds_cau[$data_so]);
                }
            }

            $this->data['ds_cau'] = $ds_cau;
            $this->data['tmpl'] = 'soicaunew/num';
            $this->load->view('layout/chat', $this->data);
        } else {
            if ($this->data['limit'] > $this->data['max_cau']) {
                $this->data['limit'] = $this->data['max_cau'];
                foreach ($data as $vitri => $value) {
                    if ($value['cau'] == $this->data['limit'])
                        $this->data['data_limit'][$vitri] = $value['so'];
                }
            }

            asort($this->data['data_limit']);
            if ($this->data['data_nextlimit'] && $this->data['exactlimit'] == 1) {
                foreach ($this->data['data_nextlimit'] as $vitri => $value) {
                    unset($this->data['data_limit'][$vitri]);
                }
            } elseif ($this->data['data_nextlimit']) {
                asort($this->data['data_nextlimit']);
            }

            $this->data['tmpl'] = 'soicaunew/index';
            $this->load->view('layout/chat', $this->data);
        }
    }

    public function sendhtml() {
        $this->data['limit'] = (isset($_GET['limit']) ? $_GET['limit'] : 0);
        $this->data['ngay'] = (isset($_GET['ngay']) ? $_GET['ngay'] : '');
        $this->data['vt'] = (isset($_GET['vt']) ? $_GET['vt'] : '');
        $this->data['lon'] = (isset($_GET['lon']) ? $_GET['lon'] : 1);
        $this->data['db'] = (isset($_GET['db']) ? $_GET['db'] : 0);

        if ($this->data['limit'] == 0 || $this->data['ngay'] == '' || $this->data['vt'] == '')
            die;

        if ($this->data['limit'] > 16)
            $this->data['limit'] = 5;

        $lid = 1;
        $query = "SELECT r.date,REPLACE(REPLACE(CONCAT_WS(',',a0,a1,a2,a3,a4,a5,a6,a7),'-',''),',','') AS str
                    FROM xs_result as r
                    WHERE r.lid=" . Quote($lid)
                . " AND r.date <" . Quote(date('Y-m-d', strtotime($this->data['ngay'])))
                . " ORDER BY r.date DESC"
                . " LIMIT 0," . ($this->data['limit'] + 1)
        ;
        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $arr_vitri = explode('x', $this->data['vt']);

        if (!isset($arr_vitri[0]) || !isset($arr_vitri[1]))
            die;

        if ($this->data['lon'] == 0) {
            $this->data['so'] = substr($list[0]->str, $arr_vitri[0], 1) . substr($list[0]->str, $arr_vitri[1], 1);
        } else {
            $so_vitri1 = substr($list[0]->str, $arr_vitri[0], 1);
            $so_vitri2 = substr($list[0]->str, $arr_vitri[1], 1);
            if ($so_vitri1 != $so_vitri2) {
                if ($so_vitri1 > $so_vitri2)
                    $this->data['so'] = $so_vitri2 . $so_vitri1 . ',' . $so_vitri1 . $so_vitri2;
                else
                    $this->data['so'] = $so_vitri1 . $so_vitri2 . ',' . $so_vitri2 . $so_vitri1;
            } else {
                $this->data['so'] = $so_vitri1 . $so_vitri2;
            }
        }

        $this->data['list'] = $list;
        $this->data['arr_vitri'] = $arr_vitri;
        $this->load->view('soicaunew/sendhtml', $this->data);
    }

}