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
        $this->data['date'] = $date;
        $this->data['tmpl'] = 'xoso/home';
        $this->load->view('layout/content', $this->data);
    }

    public function index($alias) {
        $this->load->model('xs_result_model');

        if ($alias == $this->data['url_mientrung'] || $alias == $this->data['url_miennam'])
            $this->data['items'] = $this->xs_result_model->getItemsMTMN($alias);
        else
            $this->data['items'] = $this->xs_result_model->getItems($alias);

//var_dump($this->data['items']); die;


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

    public function filter_th($alias, $th, $date = '') {
        $this->load->model('xs_result_model');

        $this->data['items'] = $this->xs_result_model->getItemsFilterTH($alias, $th, $date);

        if (!$this->data['items'])
            redirect($this->data['uri_root'] . '404_override');

        $thu = '';
        switch ($th) {
            case 'thu-hai':
                $thu = 'Thứ Hai';
                break;
            case 'thu-ba':
                $thu = 'Thứ Ba';
                break;
            case 'thu-tu':
                $thu = 'Thứ Tư';
                break;
            case 'thu-nam':
                $thu = 'Thứ Năm';
                break;
            case 'thu-sau':
                $thu = 'Thứ Sáu';
                break;
            case 'thu-bay':
                $thu = 'Thứ Bảy';
                break;
            case 'chu-nhat':
                $thu = 'Chủ Nhật';
                break;

            default:
                break;
        }

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array('', '');
        if ($alias == $this->data['url_mienbac'])
            $replace = array('Miền Bắc - ' . $thu, 'mien bac - ' . $th);
        elseif ($alias == $this->data['url_mientrung'])
            $replace = array('Miền Trung - ' . $thu, 'mien trung - ' . $th);
        elseif ($alias == $this->data['url_miennam'])
            $replace = array('Miền Nam - ' . $thu, 'mien nam - ' . $th);
        $this->data['_meta'] = $this->meta_model->show_title('ket_qua_xo_so', $search, $replace);

        $this->data['alias'] = $alias;
        $this->data['thu'] = $thu;
        $this->data['th'] = $th;
        $this->data['tmpl'] = 'xoso/index_mtmn';
        $this->load->view('layout/content', $this->data);
    }

    public function filter_date($alias, $date) {
        $this->load->model('xs_result_model');

        if ($alias == $this->data['url_mientrung'] || $alias == $this->data['url_miennam'])
            $this->data['items'] = $this->xs_result_model->getItemsMTMN($alias, $date);
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
        if ($area == 'all')
            $this->data['items'] = $this->xs_result_model->loadKQXS($area, $date);
        else
            $this->data['items'] = $this->xs_result_model->loadKQXS($area, date('Y-m-d', $date));
        $this->data['area'] = $area;
        $this->load->view('xoso/loadkqxs', $this->data);
    }

    public function xstt($area = 'MB') {
        $time = date('H:i');
        if ($time > '16:00' && $time < '19:00')
            header("Cache-Control: max-age=3");
		header('Access-Control-Allow-Origin: *');
        $this->load->model('xs_result_model');
        $result = $this->xs_result_model->getResultLoto($area);

        $this->data['timer'] = (isset($_GET['t']) ? $_GET['t'] : '');
        $this->data['data'] = $result->cache->data;
        $this->data['area'] = $area;

        if ($area == 'MB') {
            $this->data['khtt'] = file_get_contents('/home/xoso/public_html/xstt/khtt.txt');
        }
        
        $this->load->view('xoso/xstt', $this->data);
    }

    public function xstt_2($area = 'MB')
    {
        $time = date('H:i');
        if ($time > '16:00' && $time < '19:00')
            header("Cache-Control: max-age=3");
        header('Access-Control-Allow-Origin: *');
        $this->load->model('xs_result_model');
        $result = $this->xs_result_model->getResultLotoYesterday($area);

        // echo "<pre>";
        // print_r($result->cache->data);
        // die;

        $this->data['timer'] = (isset($_GET['t']) ? $_GET['t'] : '');
        $this->data['data'] = $result->cache->data;
        $this->data['area'] = $area;
        $this->data['xstt_2'] = 1;

        if ($area == 'MB') {
            $this->data['khtt'] = file_get_contents('/home/xoso/public_html/xstt/khtt.txt');
        }
        
        $this->load->view('xoso/xstt_1', $this->data);
    }

    public function xstt_1($area = 'MB')
    {
        $time = date('H:i');
        if ($time > '16:00' && $time < '19:00')
            header("Cache-Control: max-age=3");
        header('Access-Control-Allow-Origin: *');
        $this->load->model('xs_result_model');
        $result = $this->xs_result_model->getResultLoto($area);
        $this->data['timer'] = (isset($_GET['t']) ? $_GET['t'] : '');
        $data = $result->cache->data;

        $empty_data = array(
            '*',
            '*****',
            '*****',
            '*****-*****',
            '*****-*****-*****-*****-*****-*****-*****',
            '****',
            '****-****-****',
            '***',
            '**',
        );

        if ($area == 'MB') {
            if (empty($data->MB->data)) {
                $data_new = array(
                    '*****',
                    '*****',
                    '*****-*****',
                    '*****-*****-*****-*****-*****-*****',
                    '****-****-****-****',
                    '****-****-****-****-****-****',
                    '***-***-***',
                    '**-**-**-**'
                );

                $data->MB->data = $data_new;
            } else {
                for ($j = 0; $j < 8; $j++) {
                    $key = $j;

                    if ($key == 0) {
                        if ($data->MB->data[0] == '') {
                            $data->MB->data[0] = '*****';
                        }
                    }

                    if ($key == 1) {
                        if ($data->MB->data[1] == '') {
                            $data->MB->data[1] = '*****';
                        }
                    }

                    if ($key == 2) {
                        if ($data->MB->data[2] == '') {
                            $data->MB->data[2] = '*****-*****';
                        } else {
                            $g2 = explode('-', $data->MB->data[2]);

                            if (!isset($g2[0]) || $g2[0] == '') {
                                $g2[0] = '*****';
                            }

                            if (!isset($g2[1]) || $g2[1] == '') {
                                $g2[1] = '*****';
                            }

                            $data->MB->data[2] = implode($g2, '-');
                        }
                    }

                    if ($key == 3) {
                        if ($data->MB->data[3] == '') {
                            $data->MB->data[3] = '*****-*****-*****-*****-*****-*****';
                        } else {
                            $g3 = explode('-', $data->MB->data[3]);

                            for ($i = 0; $i < 6 ; $i++) { 
                                if (!isset($g3[$i]) || $g3[$i] == '') {
                                    $g3[$i] = '*****';
                                }
                            }

                            $data->MB->data[3] = implode($g3, '-');
                        }
                    }

                    if ($key == 4) {
                        if ($data->MB->data[4] == '') {
                            $data->MB->data[4] = '****-****-****-****';
                        } else {
                            $g4 = explode('-', $data->MB->data[4]);

                            for ($i = 0; $i < 4 ; $i++) { 
                                if (!isset($g4[$i]) || $g4[$i] == '') {
                                    $g4[$i] = '****';
                                }
                            }

                            $data->MB->data[4] = implode($g4, '-');
                        }
                    }

                    if ($key == 5) {
                        if ($data->MB->data[5] == '') {
                            $data->MB->data[4] = '****-****-****-****-****-****';
                        } else {
                            $g5 = explode('-', $data->MB->data[5]);

                            for ($i = 0; $i < 6 ; $i++) { 
                                if (!isset($g5[$i]) || $g5[$i] == '') {
                                    $g5[$i] = '****';
                                }
                            }

                            $data->MB->data[5] = implode($g5, '-');
                        }
                    }

                    if ($key == 6) {
                        if ($data->MB->data[6] == '') {
                            $data->MB->data[6] = '***-***-***';
                        } else {
                            $g6 = explode('-', $data->MB->data[6]);

                            for ($i = 0; $i < 3 ; $i++) { 
                                if (!isset($g6[$i]) || $g6[$i] == '') {
                                    $g6[$i] = '***';
                                }
                            }

                            $data->MB->data[6] = implode($g6, '-');
                        }
                    }

                    if ($key == 7) {
                        if ($data->MB->data[7] == '') {
                            $data->MB->data[7] = '**-**-**';
                        } else {
                            $g7 = explode('-', $data->MB->data[7]);

                            for ($i = 0; $i < 4 ; $i++) { 
                                if (!isset($g7[$i]) || $g7[$i] == '') {
                                    $g7[$i] = '**';
                                }
                            }

                            $data->MB->data[7] = implode($g7, '-');
                        }
                    }
                };
            }

            

            if ($time < '15:30') {
                $this->data['data'] = $result->cache->data;
            } else {
                $this->data['data'] = $data;
            }
        } elseif ($area == 'MN' || $area == 'MT') {
            if ($time < '15:30') {
                $this->data['data'] = $result->cache->data;
            } else {
                $location_today = $this->data['location_today'][$area];
                $location_lastday = $this->data['location_lastday'][$area];

                foreach ($location_today as $locations) {
                    $local = $locations->code;
                    //$data->BD->data[8] = '++';
                    // $data->$local->data[7] = 172;

                    if (!isset($data->$local) || empty($data->$local) || empty($data->$local->data)) {
                        $data->$local->id = $locations->id;
                        $data->$local->name = $locations->name;
                        $data->$local->alias = $locations->alias;
                        $data->$local->area = $locations->area;
                        $data->$local->code = $locations->code;
                        $data->$local->data = $empty_data;
                    } else {
                        for ($j = 0; $j < 9; $j++) {
                            $key_mn = $j;

                            if ($key_mn == 0 && $data->$local->data[0] == '') {
                                $data->$local->data[0] = '*';
                            }

                            if ($key_mn == 1 && $data->$local->data[1] == '') {
                                $data->$local->data[1] = '*****';
                            }

                            if ($key_mn == 2 && $data->$local->data[2] == '') {
                                $data->$local->data[2] = '*****';
                            }

                            if ($key_mn == 3) {
                                if ($data->$local->data[3] == '') {
                                    $data->$local->data[3] = '*****-*****';
                                }

                                $g3 = explode('-', $data->$local->data[3]);

                                for ($i = 0; $i < 2 ; $i++) {
                                    if (!isset($g3[$i]) || $g3[$i] == '') {
                                        $g3[$i] = '*****';
                                    }
                                }

                                $data->$local->data[3] = implode($g3, '-');
                            }

                            if ($key_mn == 4) {
                                if ($data->$local->data[4] == '') {
                                    $data->$local->data[4] = '*****-*****-*****-*****-*****-*****-*****';
                                }

                                $g4 = explode('-', $data->$local->data[4]);

                                for ($i = 0; $i < 7 ; $i++) {
                                    if (!isset($g4[$i]) || $g4[$i] == '') {
                                        $g4[$i] = '*****';
                                    }
                                }

                                $data->$local->data[4] = implode($g4, '-');
                            }

                            if ($key_mn == 5 && $data->$local->data[5] == '') {
                                $data->$local->data[5] = '****';
                            }

                            if ($key_mn == 6) {
                                if ($data->$local->data[6] == '') {
                                    $data->$local->data[6] = '****-****-****';
                                }

                                $g6 = explode('-', $data->$local->data[6]);

                                for ($i = 0; $i < 3 ; $i++) {
                                    if (!isset($g6[$i]) || $g6[$i] == '') {
                                        $g6[$i] = '****';
                                    }
                                }

                                $data->$local->data[6] = implode($g6, '-');
                            }

                            if ($key_mn == 7 && $data->$local->data[7] == '') {
                                $data->$local->data[7] = '***';
                            }

                            if ($key_mn == 8 && $data->$local->data[8] == '') {
                                $data->$local->data[8] = '**';
                            }
                        }
                    }
                }

                foreach ($location_lastday as $key => $locations_l) {
                    $local_l = $locations_l->code;

                    if (isset($data->$local_l)) {
                        unset($data->$local_l);
                    }
                }

                $this->data['data'] =  $data;
            }
        } else {
            $this->data['data'] = $result->cache->data;
        }

        $this->data['area'] = $area;

        if ($area == 'MB') {
            $this->data['khtt'] = file_get_contents('/home/xoso/public_html/xstt/khtt.txt');
        }
        
        $this->load->view('xoso/xstt_1', $this->data);
    }
}