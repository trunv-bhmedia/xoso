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

    //Thong ke quan trong
    function getitemsImportant($lid, $time_turn, $date = '', $type = 0) {
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

        if ($type == 0) {
            $where = '';
            if ($date != '') {
                $date = date('Y-m-d', strtotime($date));
                $where = ' AND `date` <=\'' . $date . '\'';
            }
            $query = 'SELECT CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS `data`,`date`
                    FROM `xs_result`
                    WHERE `lid`=' . Quote($lid)
                    . $where
                    . ' ORDER BY `date` DESC'
                    . ' LIMIT 0,' . $time_turn
            ;
        } else {
            $where = '';
            if ($lid == $this->data['url_mientrung'])
                $where = ' AND l.area=\'MT\' ';
            elseif ($lid == $this->data['url_miennam'])
                $where = ' AND l.area=\'MN\' ';
            if ($date != '') {
                $date = date('Y-m-d', strtotime($date));
                $where .= ' AND r.date <=\'' . $date . '\'';
            }
            $query = 'SELECT CONCAT_WS(\',\',r.b0,r.b1,r.b2,r.b3,r.b4,r.b5,r.b6,r.b7,r.b8) AS `data`,r.date
                    FROM `xs_result` AS r
                    LEFT JOIN xs_location AS l ON r.lid = l.id
                    WHERE l.status=1
                    ' . $where . '
                    ORDER BY r.date DESC
                    LIMIT 0,' . $time_turn
            ;
        }

        $list = $this->db->query($query)->result();
//        echo $this->db->last_query();

        $result = array();
        if ($list) {
            foreach ($mang_so as $v) {
                $count = 0;
                $tmp = array();
                $tmp['date'] = '';
                $bo_lien_tiep = 0;
                $check_bo_lien_tiep = true;
                foreach ($list as $v1) {
                    $arr = explode(',', $v1->data);
                    $check = false;
                    foreach ($arr as $v2) {
                        if ($v == $v2) {
                            $check = true;
                            $count++;
                            if ($tmp['date'] == '') {
                                $tmp['date'] = $v1->date;
                            }
                        }
                    }
                    if ($check_bo_lien_tiep && $check)
                        $bo_lien_tiep++;
                    if (!$check)
                        $check_bo_lien_tiep = false;
                }//Ket thuc duyet qua cac ket qua

                if ($tmp['date'] != '') {
                    if ($type == 0) {
                        $where = '';
                        if ($date != '') {
                            $date = date('Y-m-d', strtotime($date));
                            $where = ' AND `date` <=\'' . $date . '\'';
                        }
                        $query = 'SELECT COUNT(id) AS total
                        FROM `xs_result`
                        WHERE `lid`=' . Quote($lid) . ' AND `date`>' . Quote($tmp['date']) . $where
                        ;
                    } else {
                        $where = '';
                        if ($lid == $this->data['url_mientrung'])
                            $where = ' AND l.area=\'MT\' ';
                        elseif ($lid == $this->data['url_miennam'])
                            $where = ' AND l.area=\'MN\' ';
                        if ($date != '') {
                            $date = date('Y-m-d', strtotime($date));
                            $where .= ' AND r.date <=\'' . $date . '\'';
                        }
                        $query = 'SELECT COUNT(r.id) AS total
                        FROM `xs_result` AS r
                        LEFT JOIN xs_location AS l ON r.lid = l.id
                        WHERE l.status=1 AND r.date>' . Quote($tmp['date']) . $where
                        ;
                    }

                    $tmp['not_count'] = $this->db->query($query)->row()->total;
                    $tmp['count'] = $count;
                    $tmp['number'] = $v;
                    $tmp['bo_lien_tiep'] = $bo_lien_tiep;

                    $result['it_nhat'][] = $tmp;

                    if ($tmp['bo_lien_tiep'] >= 2)
                        $result['bo_lien_tiep'][] = $tmp;

                    if ($tmp['count'] >= 10)
                        $result['nhieu_nhat'][] = $tmp;

                    if ($tmp['count'] >= 1 && $tmp['not_count'] >= 5)
                        $result['cautious'][] = $tmp;
                }
            }
        }

        $result['bo_lien_tiep'] = $this->sortByOneKey($result['bo_lien_tiep'], 'bo_lien_tiep', false);

        $result['it_nhat'] = $this->sortByOneKey($result['it_nhat'], 'count');
        $result['it_nhat'] = array_splice($result['it_nhat'], 0, 12);

        if ($result['nhieu_nhat'])
            $result['nhieu_nhat'] = $this->sortByOneKey($result['nhieu_nhat'], 'count', false);

        if ($result['cautious'])
            $result['cautious'] = $this->sortByOneKey($result['cautious'], 'not_count', false);

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

}