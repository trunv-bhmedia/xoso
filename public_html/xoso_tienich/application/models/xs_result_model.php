<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_result_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_result');
        $this->_table = $_table;

//        $timer = $this->getTimer();
        $this->_timeMB = '18:05'; //$timer['MB'];
        $this->_timeMT = '17:14'; //$timer['MT'];
        $this->_timeMN = '16:12'; //$timer['MN'];

        $this->_timeMB_end = '18:55';
        $this->_timeMT_end = '17:55';
        $this->_timeMN_end = '16:55';
    }

    function read_xml($area, $date, $state) {
//        error_reporting(-1);
        
        $file = $this->get_file_name($area);
        $data = file_get_contents($file);
        $data = json_decode($data);

        if ($state == 1 || $state == 0) {
            if ($data) {
                if ($data->date == $date && $data->area == $area && $data->state == $state) {
                    return $data;
                }
            }
        } else {
            if ($data) {
                if ($data->date == $date && $data->area == $area) {
                    return $data;
                }
            }
        }

        return NULL;
    }

    function get_file_name($area = NULL) {
        switch ($area) {
            case 0:
                $file = 'mb.txt';
                break;
            case 1:
                $file = 'mt.txt';
                break;
            default :
                $file = 'mn.txt';
                break;
        }
//        $file = 'http://data.xoso.com/xstt/' . $file;//213
//        $file = 'http://www.xoso.com/xstt/' . $file;//114
        $file = '../xstt/' . $file;//114
//        if (!file_exists($file)) {
//            $fl = fopen($file, 'w');
//            fclose($fl);
//        }
        return $file;
    }

    function getItems($alias = null) {
        if ($alias == "") {
            return;
        }

        // Lấy kết quả 8 lần mở thưởng gần nhất
        $url_mientrung = $this->data['url_mientrung'];
        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung || $alias == $url_miennam) {
            if ($alias == $url_mientrung)
                $this->db->where("l.area", 'MT');
            else
                $this->db->where("l.area", 'MN');
        }else {
            $this->db->where("l.alias", $alias);
        }
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(1, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = "";
                if ($cd == "HCM" && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == "HCM" && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == "DNG" && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == "DNG" && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }
            } else {
                $numday = $numday2 = 1;
            }

            $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
            if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
            } else {
                $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
            }
//            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function getLastItems() {
        // Lấy kết quả lần mở thưởng gần nhất
        $date = date('Y-m-d', strtotime('-1 day'));
//        $date = '2013-07-08';
        $this->db->where('r.date', $date);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('l.ordering', 'ASC')
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];

            $items[$item->area][] = $data[$i];
        }

        return $items;
    }

    function getItemsMTMN($alias, $date = '') {
        if ($alias == "") {
            return;
        }

        // Lấy kết quả 8 lần mở thưởng gần nhất
        $url_mientrung = $this->data['url_mientrung'];
//        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung)
            $this->db->where("l.area", 'MT');
        else
            $this->db->where("l.area", 'MN');
        // Lấy kết quả lần mở thưởng gần nhất
//        if ($date != '') {
//            $date_from = date('Y-m-d', strtotime($date . ' -7 day'));
//            $date_to = date('Y-m-d', strtotime($date));
//            $this->db->where('r.date >=', $date_from);
//            $this->db->where('r.date <=', $date_to);
//        } else {
//            $date = date('Y-m-d', strtotime('-7 day'));
//            $date = '2013-07-01';
//            $this->db->where('r.date >=', $date);
//        }

        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(1, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];

            $items[$data[$i]->date][] = $data[$i];
        }

        return $items;
    }

    function getItemsFilterTH($alias = null, $th = null) {
        if ($alias == "" || $th == '') {
            return;
        }

        $day = 9999;
        switch ($th) {
            case 'thu-hai':
                $day = 0;
                break;
            case 'thu-ba':
                $day = 1;
                break;
            case 'thu-tu':
                $day = 2;
                break;
            case 'thu-nam':
                $day = 3;
                break;
            case 'thu-sau':
                $day = 4;
                break;
            case 'thu-bay':
                $day = 5;
                break;
            case 'chu-nhat':
                $day = 6;
                break;

            default:
                break;
        }

        if ($day == 9999)
            return;

        // Lấy kết quả 8 lần mở thưởng gần nhất        
        $this->db->where("WEEKDAY(r.date)", $day);
        $url_mientrung = $this->data['url_mientrung'];
        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung || $alias == $url_miennam) {
            if ($alias == $url_mientrung)
                $this->db->where("l.area", 'MT');
            else
                $this->db->where("l.area", 'MN');
        }else {
            $this->db->where("l.alias", $alias);
        }
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->limit(8, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = "";
                if ($cd == "HCM" && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == "HCM" && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == "DNG" && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == "DNG" && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }

                $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
                if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                } else {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                }
            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function getItemsFilterDate($alias = null, $date = null) {
        if ($alias == "" || $date == "") {
            return;
        }

        $date = date('Y-m-d', strtotime($date));

        // Lấy kết quả 8 lần mở thưởng gần nhất
//        $this->db->where("r.date", $date);
        $this->db->where("r.date <=", $date);
        $url_mientrung = $this->data['url_mientrung'];
        $url_miennam = $this->data['url_miennam'];
        if ($alias == $url_mientrung || $alias == $url_miennam) {
            if ($alias == $url_mientrung)
                $this->db->where("l.area", 'MT');
            else
                $this->db->where("l.area", 'MN');
        }else {
            $this->db->where("l.alias", $alias);
        }
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->limit(1, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = "";
                if ($cd == "HCM" && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == "HCM" && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == "DNG" && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == "DNG" && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }
            } else {
                $numday = $numday2 = 1;
            }

            $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
            if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
            } else {
                $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
            }
//            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function getItemsHome($date = null) {
        if ($date != "") {
            $date = date('Y-m-d', strtotime($date));
        } else {
            $date = date('Y-m-d');
        }

        $this->db->where("r.date <=", $date);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(8, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = "";
                if ($cd == "HCM" && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == "HCM" && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == "DNG" && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == "DNG" && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }

                $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
                if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                } else {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                }
            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function Doveso($lid = 0, $date = null) {
        if ($lid == '' || $date == "") {
            return;
        }

        $date = date('Y-m-d', strtotime($date));

        // Lấy kết quả 8 lần mở thưởng gần nhất
//        $this->db->where("r.date", $date);
        $this->db->where("r.date", $date);
        $this->db->where("l.alias", $lid);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->get()
                ->row();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        $data->dateOfWeek = $this->getDateOfWeek($data->date);
        $data->date = date('d/m/Y', strtotime("{$data->date}"));
        $data->area_name = $areaList[$data->area];

        return $data;
    }

    function loadKQXS($alias = null, $date = null) {
        if ($alias == "" || $date == "") {
            return;
        }

        if ($alias == 'mb') {
            $this->db->where("r.lid", 1);
        }

        // Lấy kết quả 8 lần mở thưởng gần nhất
//        $this->db->where("r.date", $date);
        $this->db->where("r.date <", $date);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.alias, l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(5, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            if ($item->area == 'MT' || $item->area == 'MN') {
                $d = $this->getDateOfWeekKT($item->date);
                $cd = $item->code;
                $numday = "";
                if ($cd == "HCM" && $d == 'T2') {
                    $numday = 5;
                    $numday2 = 2;
                } elseif ($cd == "HCM" && $d != 'T2') {
                    $numday = 2;
                    $numday2 = 5;
                } elseif ($cd == "DNG" && $d == 'T4') {
                    $numday = 3;
                    $numday2 = 4;
                } elseif ($cd == "DNG" && $d == 'T7') {
                    $numday = 4;
                    $numday2 = 3;
                } else {
                    $numday = $numday2 = 7;
                }

                $data[$i]->linkday1 = date('d-m-Y', strtotime("{$item->date} -$numday2 day"));
                if ($item->date <= date('Y-m-d', strtotime("{$item->date} +$numday day"))) {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                } else {
                    $data[$i]->linkday2 = date('d-m-Y', strtotime("{$item->date} +$numday day"));
                }
            }

            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function getDateOfWeek($date = null) {
        $date = empty($date) ? date("Y-m-d") : $date;
        $date = date('D', strtotime("$date "));
        $list = array(
            'Mon' => 'Thứ 2',
            'Tue' => 'Thứ 3',
            'Wed' => 'Thứ 4',
            'Thu' => 'Thứ 5',
            'Fri' => 'Thứ 6',
            'Sat' => 'Thứ 7',
            'Sun' => 'Chủ nhật',
        );
        return $list[$date];
    }

    function getDateOfWeekKT($date = null) {
        $date = empty($date) ? $this->getDate() : $date;
        $date = date('D', strtotime("$date "));
        $list = array(
            'Mon' => 'T2',
            'Tue' => 'T3',
            'Wed' => 'T4',
            'Thu' => 'T5',
            'Fri' => 'T6',
            'Sat' => 'T7',
            'Sun' => 'CN',
        );
        return $list[$date];
    }

    function getTimer($area = '') {
        if ($area != '') {
            $this->db->where('status', 1);
            $this->db->where('area', $area);
            $time = $this->db->select('time')->from('xs_location')->get()->row()->time;
            return $time;
        }

        $this->db->where('status', 1);
        $data = $this->db->select('time,area')
                ->from('xs_location')
                ->order_by('ordering', 'ASC')
                ->group_by("area")
                ->get()
                ->result();
        $items = array();
        foreach ($data as $value) {
            $items[$value->area] = $value->time;
        }
        return $items;
    }

    function getResultLoto($area) {
        switch ($area) {
            case 'MB':
                $area = 0;
                $time_end = '18:00';
                break;
            case 'MT':
                $area = 1;
                $time_end = '17:00';
                break;
            case 'MN':
                $area = 2;
                $time_end = '16:00';
                break;
        }
        $time = date('H:i');
        if ($time < $time_end)
            $date = date('Y-m-d', strtotime('-1 day'));
        else
            $date = date('Y-m-d');
        $result = $this->read_xml($area, $date, -1);
        return $result;
    }

    //Thong ke quan trong
    function getitemsImportant($lid, $time_turn) {
        $mang_so = array(
            '00', '01', '02', '03', '04', '05', '06', '07', '08', '09',
            '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
            '20', '21', '22', '23', '24', '25', '26', '27', '28', '29',
            '30', '31', '32', '33', '34', '35', '36', '37', '38', '39',
            '40', '41', '42', '43', '44', '45', '46', '47', '48', '49',
            '50', '51', '52', '53', '54', '55', '56', '57', '58', '59',
            '60', '61', '62', '63', '64', '65', '66', '67', '68', '69',
            '70', '71', '72', '73', '74', '75', '76', '77', '78', '79',
            '80', '81', '82', '83', '84', '85', '86', '87', '88', '89',
            '90', '91', '92', '93', '94', '95', '96', '97', '98', '99'
        );

        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
//                . " AND CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) LIKE '%" . $v . "%'"
//                . " AND `date`>=" . Quote($from_date)
//                . " AND `date`<=" . Quote($to_date)
                . " ORDER BY `date` DESC"
                . " LIMIT 0," . $time_turn
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $result = array();
        if ($list) {
            foreach ($mang_so as $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }//Ket thuc duyet qua cac ket qua

                if ($tmp['date'] != '') {
                    $query = "SELECT COUNT(id) AS total
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                            . " AND `date`>" . Quote($tmp['date'])
                    ;
                    $tmp['not_count'] = $this->db->query($query)->row()->total;
                    $tmp['count'] = $count;
                    $tmp['number'] = $v;

                    if ($tmp['count'] >= 10 && $tmp['not_count'] >= 0 && $tmp['not_count'] <= 3) {
                        $result['high'][] = $tmp;
                    }

                    if ($tmp['count'] >= 10 && $tmp['not_count'] >= 4 && $tmp['not_count'] <= 10) {
                        $result['priority'][] = $tmp;
                    }

                    //plots fall
                    if ($tmp['count'] >= 10 && $tmp['not_count'] == 0) {
                        $result['plots_fall'][] = $tmp;
                    }

                    //cautious
                    if ($tmp['count'] >= 1 && $tmp['not_count'] >= 10) {
                        $result['cautious'][] = $tmp;
                    }
                }
            }
        }
        if ($result['high']) {
            $result['high'] = $this->sortByOneKey($result['high'], 'count', false);
            $result['high'] = array_splice($result['high'], 0, 5);
        }

        if ($result['priority']) {
            $result['priority'] = $this->sortByOneKey($result['priority'], 'count', false);
            $result['priority'] = array_slice($result['priority'], 0, 5);
        }

        if ($result['plots_fall']) {
            $result['plots_fall'] = $this->sortByOneKey($result['plots_fall'], 'count', false);
            $result['plots_fall'] = array_slice($result['plots_fall'], 0, 10);
        }

        if ($result['cautious']) {
            $result['cautious'] = $this->sortByOneKey($result['cautious'], 'count', false);
            $result['cautious'] = array_slice($result['cautious'], 0, 10);
        }

        return $result;
    }

    function sortByOneKey(array $array, $key, $asc = true) {
        $result = array();
        $values = array();
        foreach ($array as $id => $value) {
            $values[$id] = isset($value[$key]) ? $value[$key] : '';
        }

        if ($asc) {
            asort($values);
        } else {
            arsort($values);
        }

        foreach ($values as $key => $value) {
            $result[$key] = $array[$key];
        }

        return $result;
    }

    //Thong ke tong hop
    function getItemsSynthesis($fromdate, $todate, $lid, $type) {
        // Khởi tạo biến
        $result = array();
        // Ngày lấy dữ liệu
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));

        $mang_so = array();

        switch ($type) {
//            case 't1' ://Tong chan
//                //
//                $mang_so = array(
//                    '00', '02', '04', '06', '08',
//                    '11', '13', '15', '17', '19',
//                    '20', '22', '24', '26', '28',
//                    '31', '33', '35', '37', '39',
//                    '40', '42', '44', '46', '48',
//                    '51', '53', '55', '57', '59',
//                    '60', '62', '64', '66', '68',
//                    '71', '73', '75', '77', '79',
//                    '80', '82', '84', '86', '88',
//                    '91', '93', '95', '97', '99'
//                );
//                break; //
//            case 't2' ://Tong le
//                $mang_so = array(
//                    '01', '03', '05', '07', '09',
//                    '10', '12', '14', '16', '18',
//                    '21', '23', '25', '27', '29',
//                    '30', '32', '34', '36', '38',
//                    '41', '43', '45', '47', '49',
//                    '50', '52', '54', '56', '58',
//                    '61', '63', '65', '67', '69',
//                    '70', '72', '74', '76', '78',
//                    '81', '83', '85', '87', '89',
//                    '90', '92', '94', '96', '98'
//                );
//                break;
            case 't3' ://Bo le le
                $mang_so = array(
                    '11', '13', '15', '17', '19',
                    '31', '33', '35', '37', '39',
                    '51', '53', '55', '57', '59',
                    '71', '73', '75', '77', '79',
                    '91', '93', '95', '97', '99'
                );
                break;
            case 't4' ://Bo chan le
                $mang_so = array(
                    '01', '03', '05', '07', '09',
                    '21', '23', '25', '27', '29',
                    '41', '43', '45', '47', '49',
                    '61', '63', '65', '67', '69',
                    '81', '83', '85', '87', '89'
                );
                break;
            case 't5' ://Bo le chan
                $mang_so = array(
                    '10', '12', '14', '16', '18',
                    '30', '32', '34', '36', '38',
                    '50', '52', '54', '56', '58',
                    '70', '72', '74', '76', '78',
                    '90', '92', '94', '96', '98'
                );
                break;
            case 't6' ://Bo chan chan
                $mang_so = array(
                    '00', '02', '04', '06', '08',
                    '20', '22', '24', '26', '28',
                    '40', '42', '44', '46', '48',
                    '60', '62', '64', '66', '68',
                    '80', '82', '84', '86', '88'
                );
                break;
            case 't7' ://Bo kep
                $mang_so = array(
                    '00', '11', '22', '33', '44',
                    '55', '66', '77', '88', '99'
                );
                break;
            case 't8' ://Bo sat kep
                $mang_so = array(
                    '01', '10', '12', '21', '23',
                    '32', '34', '43', '45', '54',
                    '56', '65', '67', '76', '78',
                    '87', '89', '98'
                );
                break;
//            case ('t9' || 't10') ://Bo sat kep
//                /*   $mang_so = array(
//                  '00','01','02','03','04','05','06','07','08','09',
//                  '10','11','12','13','14','15','16','17','18','19',
//                  '20','21','22','23','24','25','26','27','28','29',
//                  '30','31','32','33','34','35','36','37','38','39',
//                  '40','41','42','43','44','45','46','47','48','49',
//                  '50','51','52','53','54','55','56','57','58','59',
//                  '60','61','62','63','64','65','66','67','68','69',
//                  '70','71','72','73','74','75','76','77','78','79',
//                  '80','81','82','83','84','85','86','87','88','89',
//                  '90','91','92','93','94','95','96','97','98','99'
//                  ); */
//                $str = "";
//                for ($i = 0; $i < 100; $i++) {
//                    if ($i < 10)
//                        $str .= ',' . '0' . $i;
//                    else
//                        $str .= ',' . $i;
//                }
//                $str = substr($str, 1);
//                $mang_so = explode(",", $str);
//                break;
        }//End switch

        if ($mang_so) {
            $result['total_count'] = 0;
            $result['total_notcount'] = 0;
            foreach ($mang_so as $k => $v) {
                // Build query
                $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                        . " AND CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) LIKE '%" . $v . "%'"
                        . " AND `date`>=" . Quote($from_date)
                        . " AND `date`<=" . Quote($to_date)
                        . " ORDER BY `date` DESC";

                $list = $this->db->query($query)->result();
//                echo $this->db->last_query();

                if (count($list) <= 0)
                    continue;

                $count = 0;
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                        }
                    }
                }

                $tmp = array();
                $tmp['date'] = $list[0]->date;

                $query = "SELECT COUNT(id) AS total
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                        . " AND `date`>" . Quote($tmp['date'])
                ;
                $tmp['not_count'] = $this->db->query($query)->row()->total;
                $tmp['count'] = $count;
                $tmp['number'] = $v;


                $result['value'][] = $tmp;
                $result['total_count'] = $result['total_count'] + $count;
                $result['total_notcount'] = $result['total_notcount'] + $tmp['not_count'];
            }//Duyet qua cac phan tu
        }

        //Truong hop thong ke 15 so ve nhieu nhat
//        if ($type == 't9') {
//            foreach ($result as $k => $v) {
//                for ($i = $k + 1; $i <= 100; $i++) {
//                    if ($result[$i]['count'] > $result[$k]['count']) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ke thuc sap xep ket qua tang dan
//                    elseif (($result[$i]['count'] == $result[$k]['count']) && ($result[$i]['number'] < $result[$k]['number'])) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ket thuc sap xep so theo thu tu tang dan
//                }
//            }
//            //Lay ra 15 so dau tien
//            $result = array_slice($result, 0, 15);
//        } elseif ($type == 't10') {//Truong hop sap xep so lan ve it nhat
//            foreach ($result as $k => $v) {
//                for ($i = $k + 1; $i <= 99; $i++) {
//                    if ($result[$i]['count'] < $result[$k]['count']) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ket thuc sap xep so ket qua giam dan
//                    elseif (($result[$i]['count'] == $result[$k]['count']) && ($result[$i]['number'] > $result[$k]['number'])) {
//                        $tmp = $result[$k];
//                        $result[$k] = $result[$i];
//                        $result[$i] = $tmp;
//                    }//Ket thuc sap xep theo so tang dan
//                }
//            }
//            //Lay ra 15 ket qua dau tien
//            $result = array_slice($result, 0, 15);
//        }
        return $result;
    }

    //Thong ke lo to tinh
    function getItemsLoto($fromdate, $todate, $number, $lid) {
        // Ngày lấy dữ liệu
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));

        $result = array();
        if ($number == '')
            return $result;

        $arr_number = explode(',', $number);
        foreach ($arr_number as $value) {
            $value = trim($value);
            if ($value <= 0)
                continue;

            $query = "SELECT CONCAT_WS(',',a0,a1,a2,a3,a4,a5,a6,a7,a8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                    . " AND CONCAT_WS('-',a0,a1,a2,a3,a4,a5,a6,a7,a8,b9) LIKE '%" . $value . "-%'"
                    . " AND `date`>=" . Quote($from_date)
                    . " AND `date`<=" . Quote($to_date)
                    . " ORDER BY `date` DESC";

            $list = $this->db->query($query)->result();
//            echo $this->db->last_query();
//            if (count($list) <= 0)
//                continue;

            $count = 0;
            $result[$value][$count]->date = '';
            $result[$value][$count]->giai = '';
            $result[$value][$count]->data = '';
            if ($list) {
                foreach ($list as $j => $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $k => $v2) {
                        if (strpos($v2 . '-', $value . '-') !== false) {
                            $result[$value][$count]->date = $v1->date;
                            $result[$value][$count]->giai = $k;
                            $result[$value][$count]->data = $v2;
                            $count++;
                        }
                    }
                }
            }
        }

        return $result;
    }

    //Thong ke lo gan
    function getItemsNumberLiver($fromdate, $todate, $number, $lid, $amplitude, $type) {
        // Ngày lấy dữ liệu
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        $mang_so = explode(",", $number);

        $data = array();
        foreach ($mang_so as $v) {
            $v = trim($v);

            if ($type == 1) {
                $where = " AND CONCAT_WS('-',a0,a1,a2,a3,a4,a5,a6,a7,a8,b9) LIKE '%" . $v . "-%'";
            } elseif ($type == 2) {
                if ($lid == 1) {
                    $where = " AND CONCAT_WS(',',a0,b7,b9) LIKE '%" . $v . ",%'";
                } else {
                    $where = " AND CONCAT_WS(',',a0,b8,b9) LIKE '%" . $v . ",%'";
                }
            } else {
                $where = " AND CONCAT_WS(',',a0,b9) LIKE '%" . $v . ",%'";
            }

            $query = "SELECT `date`
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                    . $where
                    . " AND `date`>=" . Quote($from_date)
                    . " AND `date`<=" . Quote($to_date)
                    . " ORDER BY `date` DESC";

            $data[$v] = $this->db->query($query)->result();
//            echo $this->db->last_query();
        }

        $result = array();
        foreach ($data as $key => $value) {
            if (!$value[0]->date) {
                $result[$key] = null;
                continue;
            }

            $khoangcach = 0;
            $result[$key]->end_date = $value[0]->date;
            foreach ($value as $i => $item) {
                if (isset($value[$i + 1])) {
                    $tmp = strtotime($item->date) - strtotime($value[$i + 1]->date);
                    if ($tmp > $khoangcach) {
                        $khoangcach = $tmp;
                        $result[$key]->from_date = $value[$i + 1]->date;
                        $result[$key]->to_date = $item->date;
                    }
                }
            }
        }

        foreach ($result as $key => $value) {
            if (!$value->end_date)
                continue;

            $query = "SELECT COUNT(id) AS total
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                    . " AND `date`>" . Quote($value->from_date)
                    . " AND `date`<" . Quote($value->to_date)
            ;

            $total = $this->db->query($query)->row()->total;

            if ($total == 0 || $total < $amplitude) {
                $result[$key] = null;
                continue;
            }

            $result[$key]->total = $total;

            $query = "SELECT id,date
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                    . " AND `date`>=" . Quote($value->end_date)
                    . " ORDER BY date DESC"
            ;

            $rs = $this->db->query($query)->result();

            $result[$key]->end_total = 1;
            if ($rs) {
                if (count($rs) > 1) {
                    $result[$key]->end_total = count($rs) - 1;
                }
                $result[$key]->final_date = $rs[0]->date;
            }
        }

        return $result;
    }

    //Thong ke cap so tu 00-99
    function getItemsChuKy($fromdate, $todate, $lid) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));

        // Build query
        $query = "SELECT date,CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data
                    FROM xs_result
                    WHERE lid=" . Quote($lid)
                . " AND date>=" . Quote($from_date)
                . " AND date<=" . Quote($to_date)
                . " ORDER BY date ASC";

        $list = $this->db->query($query)->result();

        $result = array();
        $count = array();
        foreach ($list as $item) {
            // ngày mở thưởng
            $date = $item->date;
            // cắt ký tự - ở cuối dòng
            $tmp = rtrim($item->data, ',');
            // tách riêng các số
            $arr = explode(',', $tmp);
            // duyệt qua danh sách các số
            foreach ($arr as $v) {
                if (trim($v) == '') {
                    continue;
                }
                $v = intval($v);
                // kiểm tra xem đã có trong mảng kết quả
                if (isset($result[$date][$v])) {
                    // thiết đặt dữ liệu cho cặp số ở ngày mở thưởng
                    $result[$date][$v] = $result[$date][$v] + 1;
                } else {
                    $result[$date][$v] = 1;
                }

                if (isset($count[$v])) {
                    $count[$v] = $count[$v] + 1;
                } else {
                    $count[$v] = 1;
                }
            }
        }

        return array($result, $count);
    }

    function getItemsTwo($time_turn, $lid, $type) {
        $result = array();

        $str = "";
        for ($i = 0; $i < 100; $i++) {
            if ($i < 10)
                $str .= ',' . '0' . $i;
            else
                $str .= ',' . $i;
        }
        $str = substr($str, 1);
        $mang_so = explode(",", $str);

        if ($type == 0)
            $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                            FROM `xs_result`
                            WHERE `lid`=" . Quote($lid)
//                . " AND CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) LIKE '%" . $v . "%'"
                    . " ORDER BY `date` DESC"
                    . " LIMIT 0," . $time_turn
            ;
        else
            $query = "SELECT b0 AS `data`,`date`
                            FROM `xs_result`
                            WHERE `lid`=" . Quote($lid)
                    . " ORDER BY `date` DESC"
                    . " LIMIT 0," . $time_turn
            ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        if ($list) {
            $result['total'] = 0;
            $result['phantram_count'] = 0;
            foreach ($mang_so as $k => $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }

                if ($tmp['date'] != '') {
//                    $query = "SELECT COUNT(id) AS total
//                            FROM `xs_result`
//                            WHERE `lid`=" . Quote($lid)
//                            . " AND `date`>" . Quote($tmp['date'])
//                    ;
//                    $tmp['not_count'] = $this->db->query($query)->row()->total;
                    $tmp['count'] = $count;
                    $tmp['number'] = $v;

                    $result['value'][] = $tmp;
                    $result['total'] = $result['total'] + $count;

                    if ($count > $result['phantram_count'])
                        $result['phantram_count'] = $count;
                }
            }//Duyet qua cac phan tu
        }

        return $result;
    }

    //Lay thong ke theo tuan
    function getItemsWeek($fromdate, $todate, $lid, $type) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        // Build query
        if ($type > 0)
            $query = "SELECT date,RIGHT(a0,2) AS data
                    FROM xs_result
                    WHERE lid=" . Quote($lid)
                    . " AND date>=" . Quote($from_date)
                    . " AND date<=" . Quote($to_date)
                    . " ORDER BY date ASC";
        else
            $query = "SELECT date,a0 AS data
                    FROM xs_result
                    WHERE lid=" . Quote($lid)
                    . " AND date>=" . Quote($from_date)
                    . " AND date<=" . Quote($to_date)
                    . " ORDER BY date ASC";

        $list = $this->db->query($query)->result();

        $result = array();
        // Tổng hợp lại dữ liệu theo cấu trúc có thể hiển thị ra
        foreach ($list as $item) {
            $a = $this->getWeek($item->date);    // Tuần trong năm
            $b = date('w', strtotime($item->date)); // Ngày trong tuần
            $item->extra = date('d/m/Y', strtotime($item->date));
            if ($b == 0) {
                $b = 8;
            } else {
                $b++;
            }
            $result[$a][$b] = $item;
        }

        return $result;
    }

    // Tính ngày trong tuần
    // Tuần bắt đầu từ thứ 2-CN
    // Helper function cho Week
    function getWeek($date) {
        $week = date('W', strtotime("$date"));
        $week = intval($week) + 1;

        if ($week > 53) {
            $week = 1;
        }

        return $week;
    }

    /**
     * @function: Thống kê giải đặc biệt theo tháng 
     */
    function getItemsMonth($fromdate, $todate, $lid) {
        // Ngày lấy dữ liệu
        $fm = 1;
        $tm = 12;
        $from_date = "$fromdate-$fm-01";
        $to_date = "$todate-$tm-31";
        // Build query
        $query = "SELECT r.date,CONCAT_WS(',',a0) AS data
                    FROM xs_result AS r
                    LEFT JOIN xs_location AS l ON l.id=r.lid
                    WHERE r.lid=" . Quote($lid)
                . " AND r.date>=" . Quote($from_date)
                . " AND r.date<=" . Quote($to_date)
                . " ORDER BY r.date ASC";

        $list = $this->db->query($query)->result();

        return $list;
    }

    function StatisticsAtMost($limit, $alias) {
        if ($alias != '')
            $this->db->where('alias', $alias);
        else
            $this->db->order_by('ordering', 'ASC');
        $lid = $this->db->select('id')->from('xs_location')->get()->row()->id;
//        echo $this->db->last_query();

        $mang_so = array(
            '00', '01', '02', '03', '04', '05', '06', '07', '08', '09',
            '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
            '20', '21', '22', '23', '24', '25', '26', '27', '28', '29',
            '30', '31', '32', '33', '34', '35', '36', '37', '38', '39',
            '40', '41', '42', '43', '44', '45', '46', '47', '48', '49',
            '50', '51', '52', '53', '54', '55', '56', '57', '58', '59',
            '60', '61', '62', '63', '64', '65', '66', '67', '68', '69',
            '70', '71', '72', '73', '74', '75', '76', '77', '78', '79',
            '80', '81', '82', '83', '84', '85', '86', '87', '88', '89',
            '90', '91', '92', '93', '94', '95', '96', '97', '98', '99'
        );

        // Build query
        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                . " ORDER BY `date` DESC"
                . " LIMIT 0," . $limit
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();
        // Build query
        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                . " ORDER BY `date` DESC"
                . " LIMIT 1," . $limit
        ;

        $list_last = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $result = array();
        foreach ($mang_so as $v) {
            $count = 0;
            foreach ($list as $v1) {
                $arr = explode(',', $v1->data);
                foreach ($arr as $v2) {
                    if ($v == $v2) {
                        $count++;
                    }
                }
//                $pos = strpos($v1->data, $v);
//                if ($pos === false) {
//                    
//                } else {
//                    $count++;
//                }
            }//Ket thuc duyet qua cac ket qua


            $count_last = 0;
            foreach ($list_last as $v1) {
                $arr = explode(',', $v1->data);
                foreach ($arr as $v2) {
                    if ($v == $v2) {
                        $count_last++;
                    }
                }
//                $pos = strpos($v1->data, $v);
//                if ($pos === false) {
//                    
//                } else {
//                    $count_last++;
//                }
            }//Ket thuc duyet qua cac ket qua

            $tmp = array();
            $tmp['count'] = $count;
            $tmp['count_last'] = $count_last;
            $tmp['number'] = $v;
            $result[] = $tmp;
        }
        if ($result) {
            $result = $this->sortByOneKey($result, 'count', false);
            $result = array_splice($result, 0, 20);
        }

        return $result;
    }

    /**
     * @function: Thống kê đầu đuôi
     */
    function getItemsFirstLast($time_turn, $lid) {
        // Build query
        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,b0 AS dacbiet
                    FROM xs_result
                    WHERE lid=" . Quote($lid)
                . " ORDER BY date DESC"
                . " LIMIT 0," . $time_turn
        ;

        $list = $this->db->query($query)->result();

        $dau_so = array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9
        );

        $result = array();
        $result['total_loto_dau'] = 0;
        $result['total_loto_duoi'] = 0;
        $result['total_dacbiet_dau'] = 0;
        $result['total_dacbiet_duoi'] = 0;

        $result['phantram_loto_dau'] = 0;
        $result['phantram_loto_duoi'] = 0;
        $result['phantram_dacbiet_dau'] = 0;
        $result['phantram_dacbiet_duoi'] = 0;
        foreach ($dau_so as $k => $v) {
            $result['dau'][$k] = 0;
            $result['duoi'][$k] = 0;
            $result['dau_dacbiet'][$k] = 0;
            $result['duoi_dacbiet'][$k] = 0;

            //Lap tat ca cac ket qua theo thoi gian chon
            foreach ($list as $item) {
                $arr = explode(',', $item->data);

                //Lap cac ket qua trong 1 ngay              
                foreach ($arr as $r) {
                    if ($r != '') {
                        //Tach dau va duoi
                        $num = str_split($r, 1);
                        $dau = $num[0];
                        $duoi = $num[1];

                        //Dem so lan xuat hien cua cac dau so                  
                        if ($dau != '' && $dau == $dau_so[$k]) {
                            $result['dau'][$k]++;
                            $result['total_loto_dau']++;
                            if ($result['dau'][$k] > $result['phantram_loto_dau'])
                                $result['phantram_loto_dau'] = $result['dau'][$k];
                        }

                        //Dem so lan xuat hien cua duoi so
                        if ($duoi != '' && $duoi == $dau_so[$k]) {
                            $result['duoi'][$k]++;
                            $result['total_loto_duoi']++;
                            if ($result['duoi'][$k] > $result['phantram_loto_duoi'])
                                $result['phantram_loto_duoi'] = $result['duoi'][$k];
                        }
                    }
                }//loop result

                $num = str_split($item->dacbiet, 1);
                $dau = $num[0];
                $duoi = $num[1];
                //Dem so lan xuat hien cua cac dau so                  
                if ($dau != '' && $dau == $dau_so[$k]) {
                    $result['dau_dacbiet'][$k]++;
                    $result['total_dacbiet_dau']++;
                    if ($result['dau_dacbiet'][$k] > $result['phantram_dacbiet_dau'])
                        $result['phantram_dacbiet_dau'] = $result['dau_dacbiet'][$k];
                }

                //Dem so lan xuat hien cua duoi so
                if ($duoi != '' && $duoi == $dau_so[$k]) {
                    $result['duoi_dacbiet'][$k]++;
                    $result['total_dacbiet_duoi']++;
                    if ($result['duoi_dacbiet'][$k] > $result['phantram_dacbiet_duoi'])
                        $result['phantram_dacbiet_duoi'] = $result['duoi_dacbiet'][$k];
                }
            }//end loop all items
        }//end loop all au

        return $result;
    }

    /**
     * Thống kê theo tổng từ 0-9
     */
    function getItemsSum($time_turn, $lid, $type) {
        $result = array();
        $mang_so = array();

        switch ($type) {
            case 't1' ://Tong 0
                //
                $mang_so = array(
                    '00', '19', '28', '37', '46',
                    '55', '54', '73', '82', '91'
                );
                break; //
            case 't2' ://Tong 1
                $mang_so = array(
                    '01', '10', '29', '38', '47',
                    '56', '65', '74', '83', '92'
                );
                break;
            case 't3' ://Tong 2
                $mang_so = array(
                    '02', '11', '20', '39', '48',
                    '57', '66', '75', '84', '93'
                );
                break;
            case 't4' ://Tong 3
                $mang_so = array(
                    '03', '12', '21', '30', '49',
                    '58', '67', '76', '85', '94'
                );
                break;
            case 't5' ://Tong 4
                $mang_so = array(
                    '04', '13', '22', '31', '40',
                    '59', '68', '77', '86', '95'
                );
                break;
            case 't6' ://Tong 5
                $mang_so = array(
                    '05', '14', '23', '32', '41',
                    '50', '69', '78', '87', '96'
                );
                break;
            case 't7' ://Tong 6
                $mang_so = array(
                    '06', '15', '24', '33', '42',
                    '51', '60', '79', '88', '97'
                );
                break;
            case 't8' ://Tong 7
                $mang_so = array(
                    '07', '16', '25', '34', '43',
                    '52', '61', '70', '89', '98'
                );
                break;
            case 't9' ://Tong 8
                $mang_so = array(
                    '08', '17', '26', '35', '44',
                    '53', '62', '71', '80', '99'
                );
                break;
            case 't10' ://Tong 9
                $mang_so = array(
                    '09', '18', '27', '36', '45',
                    '54', '63', '72', '81', '90'
                );
                break;
        }//End switch

        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                            FROM `xs_result`
                            WHERE `lid`=" . Quote($lid)
//                . " AND CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) LIKE '%" . $v . "%'"
                . " ORDER BY `date` DESC"
                . " LIMIT 0," . $time_turn
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        if ($list) {
            $result['total'] = 0;
            $result['phantram_count'] = 0;
            foreach ($mang_so as $k => $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }

//                if ($tmp['date'] != '') {
//                    $query = "SELECT COUNT(id) AS total
//                            FROM `xs_result`
//                            WHERE `lid`=" . Quote($lid)
//                            . " AND `date`>" . Quote($tmp['date'])
//                    ;
//                    $tmp['not_count'] = $this->db->query($query)->row()->total;
                $tmp['count'] = $count;
                $tmp['number'] = $v;

                $result['value'][] = $tmp;
                $result['total'] = $result['total'] + $count;

                if ($count > $result['phantram_count'])
                    $result['phantram_count'] = $count;
//                }
            }//Duyet qua cac phan tu
        }

        return $result;
    }

    function getItemsSumEvenOdd($time_turn, $lid, $type) {
        if ($type == 0)
            $mang_so = array(
                '00', '02', '04', '06', '08',
                '11', '13', '15', '17', '19',
                '20', '22', '24', '26', '28',
                '31', '33', '35', '37', '39',
                '40', '42', '44', '46', '48',
                '51', '53', '55', '57', '59',
                '60', '62', '64', '66', '68',
                '71', '73', '75', '77', '79',
                '80', '82', '84', '86', '88',
                '91', '93', '95', '97', '99'
            );
        else
            $mang_so = array(
                '01', '03', '05', '07', '09',
                '10', '12', '14', '16', '18',
                '21', '23', '25', '27', '29',
                '30', '32', '34', '36', '38',
                '41', '43', '45', '47', '49',
                '50', '52', '54', '56', '58',
                '61', '63', '65', '67', '69',
                '70', '72', '74', '76', '78',
                '81', '83', '85', '87', '89',
                '90', '92', '94', '96', '98'
            );

        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
//                . " AND CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) LIKE '%" . $v . "%'"
                . " ORDER BY `date` DESC"
                . " LIMIT 0," . $time_turn
        ;

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $result = array();
        if ($list) {
            $result['total_count'] = 0;
            $result['total_notcount'] = 0;
            $result['phantram_count'] = 0;
            $result['phantram_notcount'] = 0;
            foreach ($mang_so as $k => $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                }

                if ($tmp['date'] != '') {
                    $query = "SELECT COUNT(id) AS total
                    FROM `xs_result`
                    WHERE `lid`=" . Quote($lid)
                            . " AND `date`>" . Quote($tmp['date'])
                    ;
                    $tmp['not_count'] = $this->db->query($query)->row()->total;
                    $tmp['count'] = $count;
                    $tmp['number'] = $v;


                    $result['value'][] = $tmp;

                    $result['total_count'] = $result['total_count'] + $count;
                    $result['total_notcount'] = $result['total_notcount'] + $tmp['not_count'];

                    if ($count > $result['phantram_count'])
                        $result['phantram_count'] = $count;
                    if ($tmp['not_count'] > $result['phantram_notcount'])
                        $result['phantram_notcount'] = $tmp['not_count'];
                }
            }//Duyet qua cac phan tu
        }

        return $result;
    }

    function getItemsDauDuoi($fromdate, $todate, $lid, $type) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        // Build query
        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,date
                    FROM xs_result
                    WHERE lid=" . Quote($lid)
                . " AND date>=" . Quote($from_date)
                . " AND date<=" . Quote($to_date)
                . " ORDER BY date DESC"
        ;

        $list = $this->db->query($query)->result();

        $dau_so = array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9
        );

        $result = array();
        foreach ($dau_so as $k => $v) {
            $result['total'][$k] = 0;
            //Lap tat ca cac ket qua theo thoi gian chon
            foreach ($list as $item) {
                $arr = explode(',', $item->data);

                $result['value'][$item->date][$k] = 0;
                //Lap cac ket qua trong 1 ngay                
                foreach ($arr as $r) {
                    if ($r != '') {
                        //Tach dau va duoi
                        $num = str_split($r, 1);
                        if ($type == 0) {
                            $dau = $num[0];
                            //Dem so lan xuat hien cua cac dau so                  
                            if ($dau != '' && $dau == $dau_so[$k]) {
                                $result['value'][$item->date][$k]++;
                                $result['total'][$k]++;
                            }
                        } else {
                            $duoi = $num[1];
                            //Dem so lan xuat hien cua duoi so
                            if ($duoi != '' && $duoi == $dau_so[$k]) {
                                $result['value'][$item->date][$k]++;
                                $result['total'][$k]++;
                            }
                        }
                    }
                }//loop result
            }//end loop all items
        }//end loop all au
        return $result;
    }

    function getItemsLotoSum($fromdate, $todate, $lid) {
        $from_date = date('Y-m-d', strtotime($fromdate));
        $to_date = date('Y-m-d', strtotime($todate));
        // Build query
        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,date
                    FROM xs_result
                    WHERE lid=" . Quote($lid)
                . " AND date>=" . Quote($from_date)
                . " AND date<=" . Quote($to_date)
                . " ORDER BY date DESC"
        ;

        $list = $this->db->query($query)->result();

        $dau_so = array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9
        );

        $result = array();
        foreach ($dau_so as $k => $v) {
            $result['total'][$k] = 0;
            //Lap tat ca cac ket qua theo thoi gian chon
            foreach ($list as $item) {
                $arr = explode(',', $item->data);

                $result['value'][$item->date][$k]->total = 0;
                $result['value'][$item->date][$k]->so = '';
                //Lap cac ket qua trong 1 ngay                
                foreach ($arr as $r) {
                    if ($r != '') {
                        //Tach dau va duoi
                        $num = str_split($r, 1);
                        $dau = $num[0];
                        $duoi = $num[1];
                        $sum = $dau + $duoi;
                        if ($sum < 10)
                            $sum = '0' . $sum;
                        $num = str_split($sum, 1);
                        $duoi = $num[1];

                        //Dem so lan xuat hien cua duoi so
                        if ($duoi != '' && $duoi == $dau_so[$k]) {
                            $result['value'][$item->date][$k]->total++;
                            if ($result['value'][$item->date][$k]->so == '')
                                $result['value'][$item->date][$k]->so = $r;
                            else
                                $result['value'][$item->date][$k]->so.=',' . $r;
                            $result['total'][$k]++;
                        }
                    }
                }//loop result
            }//end loop all items
        }//end loop all au
        return $result;
    }

    function InVeDo($date, $lid) {
        $date = date('Y-m-d', strtotime($date));

        $this->db->where("r.date", $date);

        if ($lid == 1)
            $this->db->where("l.area", 'MB');
        elseif ($lid == 2)
            $this->db->where("l.area", 'MT');
        else
            $this->db->where("l.area", 'MN');

        $this->db->where('l.status', 1);
        $data = $this->db->select('r.*, l.id AS lid, l.name, l.code, l.area, l.time')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            return;

        $areaList = array(
            'MB' => 'Miền Bắc',
            'MT' => 'Miền Trung',
            'MN' => 'Miền Nam',
        );

        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));
            $data[$i]->area_name = $areaList[$item->area];
        }

        return $data;
    }

    function getDemoDate($lid) {
        $this->db->where('lid', $lid);
        $data = $this->db->select('date')
                ->from('xs_result')
                ->order_by('date', 'DESC')
                ->limit(30, 0)
                ->get()
                ->result();
//        echo $this->db->last_query();
        return $data;
    }

    function getDemoItem($lid, $date) {
        $this->db->where('r.lid', $lid);
        $this->db->where('r.date', $date);
        $data = $this->db->select('r.*, l.area, l.alias')->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->get()
                ->row();
        return $data;
    }

}