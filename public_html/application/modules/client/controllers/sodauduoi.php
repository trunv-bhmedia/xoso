<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class sodauduoi extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model('xs_result_model');
    }

    public function index($alias, $date = '') {
        if ($alias == 'mien-nam')
            $alias = $this->data['url_miennam'];
        else
            $alias = $this->data['url_mientrung'];

        if ($alias == "") {
            redirect($this->data['uri_root'] . '404_override');
        }

        if ($alias == $this->data['url_miennam'])
            $this->db->where("l.area", 'MN');
        else
            $this->db->where("l.area", 'MT');

        if ($date != '') {
            $date_to = date('Y-m-d', strtotime($date));
            $this->db->where('r.date <=', $date_to);
        }

        $this->db->where('l.status', 1);
        $data = $this->db->select('r.a8,r.a0,r.date,l.name')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(120)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            redirect($this->data['uri_root'] . '404_override');

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->xs_result_model->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));

            $items[$data[$i]->date][] = $data[$i];
        }

        $this->data['items'] = $items;

        $search = array('[TITLE]', '[TITLE_NONE]');
        if ($alias == $this->data['url_miennam'])
            $replace = array('Miền Nam', 'mien nam');
        else
            $replace = array('Miền Trung', 'mien trung');
        if ($date != '') {
            if ($alias == $this->data['url_miennam'])
                $replace = array('Miền Nam ngày ' . $date, 'mien nam ngay ' . $date);
            else
                $replace = array('Miền Trung ngày ' . $date, 'mien trung ngay ' . $date);
        }
        $this->data['_meta'] = $this->meta_model->show_title('so_dau_duoi', $search, $replace);

        $this->data['alias'] = $alias;
        $this->data['date'] = $date;
        $this->data['tmpl'] = 'sodauduoi/index';
        $this->load->view('layout/content', $this->data);
    }

    public function mienbac($date = '') {
        if ($date != '') {
            $date_to = date('Y-m-d', strtotime($date));
            $this->db->where('r.date <=', $date_to);
        }

        $this->db->where("l.alias", $this->data['url_mienbac']);
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.a7,r.a0,r.date,l.name')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->limit(30)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            redirect($this->data['uri_root'] . '404_override');

        foreach ($data as $item) {
            $item->dateOfWeek = $this->xs_result_model->getDateOfWeek($item->date);
            $item->date = date('d/m/Y', strtotime("{$item->date}"));
        }

        $this->data['items'] = $data;

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array('Miền Bắc', 'mien bac');
        if ($date != '') {
            $replace = array('Miền Bắc ngày ' . $date, 'mien bac ngay ' . $date);
        }
        $this->data['_meta'] = $this->meta_model->show_title('so_dau_duoi', $search, $replace);

        $this->data['date'] = $date;
        $this->data['alias'] = $this->data['url_mienbac'];
        $this->data['tmpl'] = 'sodauduoi/mienbac';
        $this->load->view('layout/content', $this->data);
    }

    public function filter_th($alias, $th, $date = '') {
        if ($alias == 'mien-nam')
            $alias = $this->data['url_miennam'];
        elseif ($alias == 'mien-trung')
            $alias = $this->data['url_mientrung'];
        else
            $alias = $this->data['url_mienbac'];

        if ($alias == "") {
            redirect($this->data['uri_root'] . '404_override');
        }

        $day = 9999;
        $thu = '';
        switch ($th) {
            case 'thu-hai':
                $day = 0;
                $thu = 'Thứ Hai';
                break;
            case 'thu-ba':
                $day = 1;
                $thu = 'Thứ Ba';
                break;
            case 'thu-tu':
                $day = 2;
                $thu = 'Thứ Tư';
                break;
            case 'thu-nam':
                $day = 3;
                $thu = 'Thứ Năm';
                break;
            case 'thu-sau':
                $day = 4;
                $thu = 'Thứ Sáu';
                break;
            case 'thu-bay':
                $day = 5;
                $thu = 'Thứ Bảy';
                break;
            case 'chu-nhat':
                $day = 6;
                $thu = 'Chủ Nhật';
                break;

            default:
                break;
        }

        if ($day == 9999)
            redirect($this->data['uri_root'] . '404_override');

        if ($date != '') {
            $date_to = date('Y-m-d', strtotime($date));
            $this->db->where('r.date <=', $date_to);
        }

        $this->db->where("WEEKDAY(r.date)", $day);
        if ($alias == $this->data['url_mientrung'] || $alias == $this->data['url_miennam']) {
            if ($alias == $this->data['url_miennam'])
                $this->db->where("l.area", 'MN');
            else
                $this->db->where("l.area", 'MT');
            $this->db->select('r.a8,r.a0,r.date,l.name');
            $this->db->limit(120);
        }else {
            $this->db->where("l.alias", $alias);
            $this->db->select('r.a7,r.a0,r.date,l.name');
            $this->db->limit(30);
        }
        $this->db->where('l.status', 1);
        $data = $this->db->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (empty($data))
            redirect($this->data['uri_root'] . '404_override');

        $items = null;
        foreach ($data as $i => $item) {
            $data[$i]->dateOfWeek = $this->xs_result_model->getDateOfWeek($item->date);
            $data[$i]->date = date('d/m/Y', strtotime("{$item->date}"));

            if ($alias != $this->data['url_mienbac'])
                $items[$data[$i]->date][] = $data[$i];
        }

        if ($alias != $this->data['url_mienbac'])
            $this->data['items'] = $items;
        else
            $this->data['items'] = $data;

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array('', '');
        if ($alias == $this->data['url_miennam'])
            $replace = array('Miền Nam - ' . $thu, 'mien nam - ' . $th);
        elseif ($alias == $this->data['url_mientrung'])
            $replace = array('Miền Trung - ' . $thu, 'mien trung - ' . $th);
        else
            $replace = array('Miền Bắc - ' . $thu, 'mien bac - ' . $th);
        $this->data['_meta'] = $this->meta_model->show_title('so_dau_duoi', $search, $replace);

        $this->data['alias'] = $alias;
        $this->data['thu'] = $thu;
        $this->data['th'] = $th;
        if ($alias == $this->data['url_mienbac'])
            $this->data['tmpl'] = 'sodauduoi/filter_th_mb';
        else
            $this->data['tmpl'] = 'sodauduoi/filter_th';
        $this->load->view('layout/content', $this->data);
    }

}