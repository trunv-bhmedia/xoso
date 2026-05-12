<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class xs_statistics_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $_table = $this->db->dbprefix('xs_statistics');
        $this->_table = $_table;
    }

    function updateStatistics($area) {
        $num_statistics = 40; //thong ke trong 40 ngay
        $start_date = '2008-01-01'; //bat dau tu ngay
        $end_date = date('Y-m-d'); //ket thuc ngay

        $rs_date = $this->db->select('date')->from('xs_result')->order_by("date", "DESC")->get()->row()->date;
//        echo $this->db->last_query();

        $lich = date('w', strtotime($rs_date)) + 1;

        // Truy van de lay ra cac tinh theo khu vuc
        $this->db->where('status', 1);
        $this->db->where('area', $area);
        $this->db->like('lich', $lich);
        $list = $this->db->select('id,alias')->from('xs_location')->get()->result();
//        echo $this->db->last_query();

        if ($list) {
            $arr_num = array();
            for ($i = 0; $i <= 9; $i++) {
                $tmp = array();
                for ($j = 0; $j <= 9; $j++) {
                    $tmp[$j] = $i . '' . $j;
                }
                $arr_num[$i] = $tmp;
            }

            $data = array();
            $th_cache = getAliasByDate();
            $date_cache = date('d-m-Y');
            foreach ($list as $v) {
                $tmp = array();
                //Thong ke theo gian dac biet
                $tmp['special'] = $this->getDataSpecial($start_date, $end_date, $v->id, $arr_num);
                //Thong ke theo giai bat ky
                $tmp['all'] = $this->getData($arr_num, $v->id, $num_statistics);
                $data[] = $tmp;

                //delete cache
//                if ($area == 'MB')
//                    $this->simple_cache->delete_item('xoso_data_' . $this->data['url_mienbac']);
//                elseif ($area == 'MT')
//                    $this->simple_cache->delete_item('xoso_data_' . $this->data['url_mientrung']);
//                else
//                    $this->simple_cache->delete_item('xoso_data_' . $this->data['url_miennam']);
//                $this->simple_cache->delete_item('xoso_data_' . $v->alias);
//                $this->simple_cache->delete_item('xoso_data_' . $v->alias . '_' . $th_cache);
//                $this->simple_cache->delete_item('xoso_data_' . $v->alias . '_' . $date_cache);
            }//End foreach

            $this->db->where('area', $area);
            $statistics_id = $this->db->select('id')->from('xs_statistics')->get()->row()->id;

            $data = json_encode($data);
            $data = array(
                "num_statistics" => $num_statistics,
                "result" => $data,
                "update_date" => time(),
                "start_date" => $start_date,
                "end_date" => $end_date
            );

            if ($statistics_id) {
                $this->update($statistics_id, $data);
                echo('update success!');
            } else {
                $data["area"] = $area;
                $this->insert($data);
                echo('insert success!');
            }
        } else {
            die('Location no existed!');
        }

        //delete cache
        $this->simple_cache->delete_item('home_data');
    }

    function getDataSpecial($start_date, $end_date, $lid, $arr_num) {
        $arr_total = array(
            0 => array('00', '19', '28', '37', '46', '55', '64', '73', '82', '91'),
            1 => array('01', '10', '29', '38', '47', '56', '65', '74', '83', '92'),
            2 => array('02', '11', '20', '39', '48', '57', '66', '75', '84', '93'),
            3 => array('03', '12', '21', '30', '49', '58', '67', '76', '85', '94'),
            4 => array('04', '13', '22', '31', '40', '59', '68', '77', '86', '95'),
            5 => array('05', '14', '23', '32', '41', '50', '69', '78', '87', '96'),
            6 => array('06', '15', '24', '33', '42', '51', '60', '79', '88', '97'),
            7 => array('07', '16', '25', '34', '43', '52', '61', '70', '89', '98'),
            8 => array('08', '17', '26', '35', '44', '53', '62', '71', '80', '99'),
            9 => array('09', '18', '27', '36', '45', '54', '63', '72', '81', '90')
        );

        $data = array();
        //Dau va duoi
        foreach ($arr_num as $k_n => $v_n) {
            $this->db->where('lid', $lid);
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
            $this->db->where("b0 LIKE", $k_n . "%");
            $data['dau'][] = $this->db->select('count(id)as total')->from('xs_result')->get()->row()->total;

            $this->db->where('lid', $lid);
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
            $this->db->where("b0 LIKE", "%" . $k_n);
            $data['duoi'][] = $this->db->select('count(id)as total')->from('xs_result')->get()->row()->total;
        }

        //Thong ke theo tong
        foreach ($arr_total as $k => $v) {
            $this->db->where('lid', $lid);
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
            $this->db->where_in("b0", $v);
            $data['total'][$k] = $this->db->select('count(id)as total')->from('xs_result')->get()->row()->total;
//            echo $this->db->last_query();
        }

        //Thong ke ve nhieu it
        $this->db->where('lid', $lid);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $this->db->where_in("b0", $v);
        $result = $this->db->select('b0')->from('xs_result')->get()->result();
        foreach ($arr_num as $k => $v) {
            foreach ($v as $k_v => $vv) {
                $tmp = 0;
                foreach ($result as $v_r) {
                    if ($v_r->b0 == $vv) {
                        $tmp++;
                    }
                }
                $data['max_min'][] = array($k . $k_v, $tmp);
            }
        }
        foreach ($data['max_min'] as $k => $v) {
            for ($j = $k + 1; $j < count($data['max_min']); $j++) {
                if ($data['max_min'][$k][1] < $data['max_min'][$j][1]) {
                    $t = $data['max_min'][$k];
                    $data['max_min'][$k] = $data['max_min'][$j];
                    $data['max_min'][$j] = $t;
                }
            }
        }

        $data['show']['max'] = array_slice($data['max_min'], 0, 9);
        $data['show']['min'] = array_slice($data['max_min'], 80, 99);

        unset($data['max_min']);

        return $data;
    }

    function getData($arr_num, $lid, $num_statistics) {
        $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date` 
                FROM `xs_result`
                WHERE `lid`=" . Quote($lid) . "
                ORDER BY `date` DESC
                LIMIT 0," . $num_statistics . "
                ";
        $result = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $num = array();

        //Tinh so ngay tru
        $this->db->where('id', $lid);
        $r = $this->db->select('time')->from('xs_location')->get()->row();
//        echo $this->db->last_query();

        $time = explode('-', $r->time);
        if (date('H') > $time[0] || (date('H') == $time[0] && date('i') > $time[1])) {
            $sub_day = 2;
        } else {
            $sub_day = 1;
        }
        foreach ($arr_num as $k_n => $v_n) {
            $num['dau'][$k_n] = 0;
            $num['duoi'][$k_n] = 0;
            foreach ($v_n as $k_vn => $v_vn) {
                $num['tong'][$k_n . $k_vn] = 0;
                foreach ($result as $k_r => $v_r) {
                    $arr = explode(',', $v_r->data);
                    foreach ($arr as $k_a => $v_a) {
                        if ($v_a != '' && $v_a == $v_vn) {
                            $num['dau'][$k_n]++;
                            $num['tong'][$k_n . $k_vn]++;
                        }

                        if ($v_a != '' && strrev($v_a) == $v_vn) {
                            $num['duoi'][$k_n]++;
                        }
                    }
                }
            }
        }
        $_tmp = array();
        foreach ($num['tong'] as $k_tong => $v_tong) {
            $_tmp[] = array($k_tong, $v_tong);
        }

        foreach ($_tmp as $k_t => $v_t) {
            for ($j = $k_t + 1; $j <= count($_tmp); $j++) {
                if ($_tmp[$k_t][1] < $_tmp[$j][1]) {
                    $tam = $_tmp[$k_t];
                    $_tmp[$k_t] = $_tmp[$j];
                    $_tmp[$j] = $tam;
                }
            }
        }
        $num['total']['max'] = array_slice($_tmp, 0, 10);
        $num['total']['min'] = array_slice($_tmp, 90, 99);
        unset($num['tong']);

        //Thong ke lo lau ve nhat
        $arr = array();
        foreach ($arr_num as $k_num => $v_num) {
            foreach ($v_num as $k_v => $v_v) {
                $query = "SELECT max(date) AS date 
                        FROM `xs_result`
                        WHERE `lid`=" . Quote($lid) . "
                        AND CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) LIKE '%" . $v_v . "%'
                        ORDER BY `date` DESC
                        ";
                $result1 = $this->db->query($query)->row();
//                echo $this->db->last_query();

                $tmp = explode('-', $result1->date);
                $d1 = mktime(0, 0, 0, $tmp[1], $tmp[2], $tmp[0]);
                $d2 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $d = round(($d2 - $d1) / (86400));

                if ($lid == 2) {
                    $s = 0;
                    $_date = $tmp[1] . '/' . $tmp[2] . '/' . $tmp[0];
                    for ($i = 0; $i <= $d; $i++) {
                        $_maxx = date('N', strtotime("$_date +$i days"));
                        if ($_maxx == 1 || $_maxx == 6) {
                            $s++;
                        }
                    }
                    $d = $s;
                } elseif ($lid == 15) {
                    $s = 0;
                    $_date = $tmp[1] . '/' . $tmp[2] . '/' . $tmp[0];
                    for ($i = 0; $i <= $d; $i++) {
                        $_maxx = date('N', strtotime("$_date +$i days"));
                        if ($_maxx == 3 || $_maxx == 6) {
                            $s++;
                        }
                    }
                    $d = $s;
                } elseif ($lid == 16) {
                    $s = 0;
                    $_date = $tmp[1] . '/' . $tmp[2] . '/' . $tmp[0];
                    for ($i = 0; $i <= $d; $i++) {
                        $_maxx = date('N', strtotime("$_date +$i days"));
                        if ($_maxx == 3 || $_maxx == 7) {
                            $s++;
                        }
                    }
                    $d = $s;
                } elseif ($lid != 1) {
                    $d = round(($d2 - $d1) / (604800));
                }
                $d = $d - $sub_day;
                $arr['less'][$k_num . $k_v] = $d;
            }
        }

        foreach ($arr['less'] as $k_less => $v_less) {
            if ($arr['less'][$k_less] >= 10) {
                $num['less'][$k_less] = $v_less;
            }
        }

        //Thong ke lo ve lien tuc
        foreach ($arr_num as $k => $v) {
            foreach ($v as $k_v => $vv) {
                $_num = 0;
                foreach ($result as $k_r => $v_r) {
                    $y = false;
                    $arr_tmp = explode(',', $v_r->data);
                    foreach ($arr_tmp as $k_a => $v_a) {
                        if ($v_a == $vv) {

                            $y = true;
                            break;
                        } else {
                            $y = false;
                        }
                    }
                    if ($y) {
                        $_num++;
                    } else {
                        break;
                    }
                }
                if ($_num >= 2) {
                    $num['great'][] = array($k . $k_v, $_num);
                }
            }
        }

        return $num;
    }

    function getNowLocations() {
        $lich = date('w') + 1;

        $this->db->where('status', 1);
        $this->db->like('lich', $lich);
        $list = $this->db->select('*')->from('xs_location')->get()->result();

        $arr = array();
        foreach ($list as $v) {
            if ($v->area == 'MB')
                $arr['MB'][] = $v;
            elseif ($v->area == 'MT')
                $arr['MT'][] = $v;
            elseif ($v->area == 'MN')
                $arr['MN'][] = $v;
        }

        return $arr;
    }

    function getItemsStatistics($area = 'MB') {
        $area = strtoupper($area);

        $rs_date = $this->db->select('date')->from('xs_result')->order_by("date", "DESC")->get()->row()->date;
//        echo $this->db->last_query();

        $lich = date('w', strtotime($rs_date)) + 1;

        $this->db->where('area', $area);
        $result = $this->db->select('result')->from('xs_statistics')->get()->row()->result;
        if ($result) {
            $result = json_decode($result);

            // Truy van de lay ra cac tinh theo khu vuc
            $this->db->where('status', 1);
            $this->db->where('area', $area);
            $this->db->like('lich', $lich);
            $list = $this->db->select('*')->from('xs_location')->get()->result();
//            echo $this->db->last_query();
            foreach ($result as $k => $v) {
                $result[$k]->location = $list[$k];

                $query = "SELECT date AS m_date,a0,a1,a2,a3,a4,a5,a6,a7,a8,CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,extension 
                        FROM `xs_result`
                        WHERE `lid`=" . Quote($list[$k]->id) . "
                        ORDER BY `date` DESC
                        ";
                $_listx = $this->db->query($query)->row();
//                echo $this->db->last_query();
                $_listx->vndate = $this->getVNDate($_listx->m_date);
                if ($_listx) {
                    $result[$k]->result = $_listx;
                }
            }
            return $result;
        }
    }

    function getVNDate($date) {
        $n_thu = date('N', strtotime($date));
        $arr_thu = array(
            '1' => 'Thứ Hai',
            '2' => 'Thứ Ba',
            '3' => 'Thứ Tư',
            '4' => 'Thứ Năm',
            '5' => 'Thứ Sáu',
            '6' => 'Thứ Bảy',
            '7' => 'Chủ Nhật'
        );
        return $arr_thu[$n_thu] . ',&nbsp;' . date('d/m/Y', strtotime($date));
    }

    function getDateOfWeekKT($date = null) {
        $date = empty($date) ? date("Y-m-d") : $date;
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

    /**
     * @function: getItemsDetectLotto: soi cau lo
     * @author: manhnv
     * @email: manhnv@binhhoang.com
     * @date: 27.03.2012
     * @param: from_date: date, amplitude: int
     * @return: array
     */
    function getItemsDetectLotto($amplitude, $lid) {
        $area = 'MB';
        foreach ($this->data['xs_location_menu'] as $value) {
            if ($lid == $value->id) {
                $area = $value->area;
                break;
            }
        }

        if ($area == 'MB') {
            $query = "SELECT r.date,REPLACE(REPLACE(CONCAT_WS(',',a0,a1,a2,a3,a4,a5,a6,a7),'-',''),',','') AS str,CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data
                    FROM xs_result as r
                    WHERE r.lid=" . Quote($lid)
                    . " ORDER BY r.date DESC"
                    . " LIMIT 0," . $amplitude
            ;
        } else {
            $query = "SELECT r.date,REPLACE(REPLACE(CONCAT_WS(',',a8,a7,a6,a5,a4,a3,a2,a1,a0),'-',''),',','') AS str,CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data
                    FROM xs_result as r
                    WHERE r.lid=" . Quote($lid)
                    . " ORDER BY r.date DESC"
                    . " LIMIT 0," . $amplitude
            ;
        }

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $xoso_arr = array();
        foreach ($list as $k => $v) {
            $xoso_arr[$k]['value'] = $v->str;
            $xoso_arr[$k]['date'] = date('d-m-Y', strtotime($v->date));
            for ($i = $k + 1; $i < count($list); $i++) {
                if ($list[$i]->date < $list[$k]->date) {
                    $tmp = $list[$k];
                    $list[$k] = $list[$i];
                    $list[$i] = $tmp;
                }
            }
        }

        //echo count($list);
        //Tao mang so
        $mang_so = array();
        for ($i = 0; $i <= 99; $i++) {
            $tmp = '0' . $i;
            if (strlen($tmp) == 3) {
                $tmp = substr($tmp, 1, 2);
            }
            $mang_so[] = $tmp;
        }

        //Ket thuc tao mang so
        $str_len = 107;
        $data = array();
        $count_list = count($list);
        foreach ($list as $k_list => $v_list) {
            if ($k_list < $count_list - 1) {
                //Lay ra cac ket qua cua ngay hom sau
                $arr = explode(',', $list[$k_list + 1]->data);
                //Lap cac vi tri tu 0 den 5671 array_key_exists
                $str = $v_list->str;
//                echo $v_list->str.'|'.$str_len.'<br/><br/>';
                $re = array();
                for ($j = 0; $j <= $str_len - 1; $j++) {
                    for ($k = $j + 1; $k <= $str_len - 1; $k++) {
                        if ($j != $k) {
                            $tmp = substr($str, $j, 1) . substr($str, $k, 1);
                            $suc = false;
                            foreach ($arr as $k_arr => $v_arr) {
                                //Xet kq = ab||ba
                                if (($tmp == $v_arr || $tmp == strrev($v_arr)) && $v_arr != '') {
                                    $suc = true;
                                    break;
                                }
                            }//End foreach($arr)

                            if ($suc) {
                                $re[$j][$k] = 1;
                            } else {
                                $re[$j][$k] = 2;
                            }
                        }
                    }//End for k =0
                }//End for j=0
                $data['mang'][] = $re;
            }//End if $k_list < $count_list -1
            else {
                //Lay ra cac ket qua cua ngay hom sau
                //Lap cac vi tri tu 0 den 5671 array_key_exists
                $str = $list[$count_list - 1]->str;
                $re = array();
                for ($j = 0; $j <= $str_len - 1; $j++) {
                    for ($k = $j + 1; $k <= $str_len - 1; $k++) {
                        if ($j != $k) {
                            $tmp = substr($str, $j, 1) . substr($str, $k, 1);
                            $suc = false;
                            for ($i = 0; $i <= $count_list - 2; $i++) {
                                if ($data['mang'][$i][$j][$k] == 1) {
                                    $suc = true;
                                } else {
                                    $suc = false;
                                    break;
                                }
                            }

                            if ($suc) {
                                $re[$j][$k] = $tmp;
                            }
                        }
                    }//End for k =0
                }//End for j=0   
                $data['result'] = $re;
            }//End else
        }//Ket thuc viec duyet qua cac ket qua trong cac ngay
        //Duyet ket qua lay duoc de sap xep lai va so sanh voi mang so
        $result = array();
        foreach ($mang_so as $k => $v) {
            $tmp = array();
            foreach ($data['result'] as $k_v => $vv) {
                foreach ($vv as $k_vv => $vvv) {
                    if ($v == $vvv) {
                        $tmp[] = array($k_v + 1, $k_vv + 1);
                    }
                }
            }
            if ($tmp) {
                $result[$v] = $tmp;
            }
        }

        $rs = array();
        $rs['xoso_arr'] = $xoso_arr;
        $rs['result'] = $result;

        return $rs;
    }

    /**
     * @function: getItemsDetectLotto: soi cau lo
     * @author: manhnv
     * @email: manhnv@binhhoang.com
     * @date: 27.03.2012
     * @param: from_date: date, amplitude: int
     * @return: array
     */
    function getItemsDetectOnlyLotto($amplitude, $lid) {
        $query = "SELECT r.date,REPLACE(REPLACE(CONCAT_WS(',',a0,a1,a2,a3,a4,a5,a6,a7),'-',''),',','') AS str,CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data
                    FROM xs_result as r
                    WHERE r.lid=" . Quote($lid)
                . " ORDER BY r.date DESC"
                . " LIMIT 0," . $amplitude
        ;
        $list = $this->db->query($query)->result();

        $xoso_arr = array();
        foreach ($list as $k => $v) {
            $xoso_arr[$k]['value'] = $v->str;
            $xoso_arr[$k]['date'] = date('d-m-Y', strtotime($v->date));
            for ($i = $k + 1; $i < count($list); $i++) {
                if ($list[$i]->date < $list[$k]->date) {
                    $tmp = $list[$k];
                    $list[$k] = $list[$i];
                    $list[$i] = $tmp;
                }
            }
        }
        //echo count($list);
        //Tao mang so
        $mang_so = array();
        for ($i = 0; $i <= 99; $i++) {
            $tmp = '0' . $i;
            if (strlen($tmp) == 3) {
                $tmp = substr($tmp, 1, 2);
            }
            $mang_so[] = $tmp;
        }
        //print_r($mang_so);
        //Ket thuc tao mang so
        $str_len = 107;
        $data = array();
        $count_list = count($list);
        foreach ($list as $k_list => $v_list) {
            if ($k_list < $count_list - 1) {
                //Lay ra cac ket qua cua ngay hom sau
                $arr = explode(',', $list[$k_list + 1]->data);
                //Lap cac vi tri tu 0 den 5671 array_key_exists
                $str = $v_list->str;
                //echo $v_list->str.'|'.$str_len;
                $re = array();
                for ($j = 0; $j <= $str_len - 1; $j++) {
                    for ($k = $j + 1; $k <= $str_len - 1; $k++) {
                        if ($j != $k) {
                            $tmp = substr($str, $j, 1) . substr($str, $k, 1);
                            $suc = false;
                            foreach ($arr as $k_arr => $v_arr) {
                                if (($tmp == $v_arr) && $v_arr != '') {
                                    $suc = true;
                                    break;
                                }
                            }//End foreach($arr)

                            if ($suc) {
                                $re[$j][$k] = 1;
                            } else {
                                $re[$j][$k] = 2;
                            }
                        }
                    }//End for k =0
                }//End for j=0
                $data['mang'][] = $re;
            }//End if $k_list < $count_list -1
            else {
                //Lay ra cac ket qua cua ngay hom sau
                //Lap cac vi tri tu 0 den 5671 array_key_exists
                $str = $list[$count_list - 1]->str;
                $re = array();
                for ($j = 0; $j <= $str_len - 1; $j++) {
                    for ($k = $j + 1; $k <= $str_len - 1; $k++) {
                        if ($j != $k) {
                            $tmp = substr($str, $j, 1) . substr($str, $k, 1);
                            $suc = false;
                            for ($i = 0; $i <= $count_list - 2; $i++) {
                                if ($data['mang'][$i][$j][$k] == 1) {
                                    $suc = true;
                                } else {
                                    $suc = false;
                                    break;
                                }
                            }

                            if ($suc) {
                                $re[$j][$k] = $tmp;
                            }
                        }
                    }//End for k =0
                }//End for j=0   
                $data['result'] = $re;
            }//End else
        }//Ket thuc viec duyet qua cac ket qua trong cac ngay
        //Duyet ket qua lay duoc de sap xep lai va so sanh voi mang so
        $result = array();

        foreach ($mang_so as $k => $v) {
            $tmp = array();
            foreach ($data['result'] as $k_v => $vv) {
                foreach ($vv as $k_vv => $vvv) {
                    if ($v == $vvv) {
                        $tmp[] = array($k_v + 1, $k_vv + 1);
                    }
                }
            }
            if ($tmp) {
                $result[$v] = $tmp;
            }
        }

        $rs = array();
        $rs['xoso_arr'] = $xoso_arr;
        $rs['result'] = $result;

        return $rs;
    }

//End getItemsOnlyLotto

    /**
     * @function: getItemsDetectSpecialLotto: Soi cau giai dac biet
     * @author: manhnv
     * @email: manhnv@binhhoang.com
     * @date: 27.03.2012
     * @param: from_date: date, amplitude: int
     * @return: array
     */
//    function getItemsDetectSpecialLotto() {
//        $lid = JRequest::getInt('lid', 1);
//        $query = $db->getQuery(true);
//        $query->select("r.date,REPLACE(REPLACE(CONCAT_WS(',',a0,a1,a2,a3,a4,a5,a6,a7,a8),'-',''),',','') AS str,CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data,b0");
//        $query->from('#__xs_result as r');
//        $query->where('r.lid=' . $lid);
//        $query->order('r.date DESC');
//        $db->setQuery($query, 0, $amplitude);
//        $list = $db->loadObjectList();
//
//        foreach ($list as $k => $v) {
//            for ($i = $k + 1; $i < count($list); $i++) {
//                if ($list[$i]->date < $list[$k]->date) {
//                    $tmp = $list[$k];
//                    $list[$k] = $list[$i];
//                    $list[$i] = $tmp;
//                }
//            }
//        }
//        //echo count($list);
//        //Tao mang so
//        $mang_so = array();
//        for ($i = 0; $i <= 99; $i++) {
//            $tmp = '0' . $i;
//            if (strlen($tmp) == 3) {
//                $tmp = substr($tmp, 1, 2);
//            }
//            $mang_so[] = $tmp;
//        }
//        //print_r($mang_so);
//        //Ket thuc tao mang so
//        $str_len = 107;
//        $data = array();
//        $count_list = count($list);
//        foreach ($list as $k_list => $v_list) {
//            if ($k_list < $count_list - 1) {
//                //Lay ra cac ket qua cua ngay hom sau
//                $arr = explode(',', $list[$k_list + 1]->data);
//                //Lap cac vi tri tu 0 den 5671 array_key_exists
//                $str = $v_list->str;
//                //echo $v_list->str.'|'.$str_len;
//                //Tach ket qua dac biet
//                $re_spe = $v_list->b0;
//                $h_re_spe = substr($re_spe, 0, 1);
//                $l_re_spe = substr($re_spe, 1, 1);
//                $re = array();
//                for ($j = 0; $j <= $str_len - 1; $j++) {
//                    for ($k = $j + 1; $k <= $str_len - 1; $k++) {
//                        if ($j != $k) {
//                            //Kiem tra xem so nay co chua dau hoac duoi cua lo giai dac biet hay khong?
//                            $_dau = substr($str, $j, 1);
//                            $_duoi = substr($str, $k, 1);
//                            if ($_dau == $h_re_spe || $_dau == $l_re_spe || $_duoi == $h_re_spe || $_duoi == $l_re_spe) {
//                                $tmp = $_dau . $_duoi;
//                                $suc = false;
//                                foreach ($arr as $k_arr => $v_arr) {
//                                    if (($tmp == $v_arr || $tmp == strrev($v_arr)) && $v_arr != '') {
//                                        $suc = true;
//                                        break;
//                                    }
//                                }//End foreach($arr)
//
//                                if ($suc) {
//                                    $re[$j][$k] = 1;
//                                } else {
//                                    $re[$j][$k] = 2;
//                                }
//                            }//Ket thuc kiem tra xem dau hoac duoi cua 1 so co chua dau hoc duoi cua lo giai dac biet hay khong
//                        }//End if $j != $k
//                    }//End for k =0
//                }//End for j=0
//                $data['mang'][] = $re;
//                $data['re_spe'][] = $re_spe;
//            }//End if $k_list < $count_list -1
//            else {
//                //Lay ra cac ket qua cua ngay hom sau
//                //Lap cac vi tri tu 0 den 5671 array_key_exists
//                $str = $list[$count_list - 1]->str;
//                $re = array();
//                for ($j = 0; $j <= $str_len - 1; $j++) {
//                    for ($k = $j + 1; $k <= $str_len - 1; $k++) {
//                        if ($j != $k) {
//                            $tmp = substr($str, $j, 1) . substr($str, $k, 1);
//                            $suc = false;
//                            for ($i = 0; $i <= $count_list - 2; $i++) {
//                                if ($data['mang'][$i][$j][$k] == 1) {
//                                    $suc = true;
//                                } else {
//                                    $suc = false;
//                                    break;
//                                }
//                            }
//
//                            if ($suc) {
//                                $re[$j][$k] = $tmp;
//                            }
//                        }
//                    }//End for k =0
//                }//End for j=0   
//                $data['result'] = $re;
//            }//End else
//        }//Ket thuc viec duyet qua cac ket qua trong cac ngay
//        //Duyet ket qua lay duoc de sap xep lai va so sanh voi mang so
//        $result = array();
//
//        //echo '<pre>';
//        //print_r($data);
//        //echo '</pre>';
//
//        foreach ($mang_so as $k => $v) {
//            $tmp = array();
//            foreach ($data['result'] as $k_v => $vv) {
//                foreach ($vv as $k_vv => $vvv) {
//                    if ($v == $vvv) {
//                        $tmp[] = array($k_v + 1, $k_vv + 1);
//                    }
//                }
//            }
//            if ($tmp) {
//                $result[$v] = $tmp;
//            }
//        }
//
//        return $result;
//    }
}