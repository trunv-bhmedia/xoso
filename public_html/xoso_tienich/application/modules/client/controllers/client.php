<?php

class Client extends CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model(array('meta_model', 'xs_location_model'));
        $this->load->library('simple_cache');
//        $this->load->library(array('message', 'Mobile_Detect'));
//        $this->lang->load('form_validation', 'vi');
//        $detect = new Mobile_Detect;
//        if (!$detect->isMobile()) {
//            redirect('http://xoso.com/');
//        }
        $this->data['c_module'] = $this->router->class;
        $this->data['c_func'] = $this->router->method;
        $this->data['uri_string'] = $this->router->uri->uri_string;

        $client_data = array();
//        $this->simple_cache->delete_item('client_data');
        if (!$this->simple_cache->is_cached('client_data')) {
            // not cached, do our things that need caching
            $client_data['uri_root'] = site_url();

            $client_data['_meta'] = $this->meta_model->show_title();
            $client_data['xs_location_menu'] = $this->xs_location_model->getLocation();

            $client_data['url_mienbac'] = config_item('url_mienbac');
            $client_data['url_mientrung'] = config_item('url_mientrung');
            $client_data['url_miennam'] = config_item('url_miennam');

//            // store in cache
            $this->simple_cache->cache_item('client_data', $client_data);
        } else {
            $client_data = $this->simple_cache->get_item('client_data');
        }

        if ($this->data['c_func'] != 'xstt') {
            $date = strval(date('w') + 1);
            $client_data['location_menu'] = array();
            $client_data['location_today'] = array();
            foreach ($client_data['xs_location_menu'] as $value) {
                $client_data['location_menu'][$value->area][] = $value;
                if (strpos($value->lich, strval($date)) !== false)
                    $client_data['location_today'][$value->area][] = $value;
            }

            if (!isset($_SESSION['ck'])) {
                if ($cookie = get_cookie('__ck')) {
                    $_SESSION['ck'] = $cookie;
                } else {
                    $_SESSION['ck'] = 1;
                }
            }
            if (isset($_GET['ck'])) {
                $_SESSION['ck'] = (int) $_GET['ck'];
                set_cookie('__ck', $_SESSION['ck'], time() + (60 * 60 * 24 * 30)); //60*60*24*30=30 ngay
            }

            $this->data['tttt_mb'] = false;
            $this->data['tttt_mt'] = false;
            $this->data['tttt_mn'] = false;

            $time = date('H:i');
            if ($time >= '16:00' && $time < '17:00') {
                $this->data['tttt_mn'] = true;
            } elseif ($time >= '17:00' && $time < '18:00') {
                $this->data['tttt_mt'] = true;
            } elseif ($time >= '18:00' && $time < '19:00') {
                $this->data['tttt_mb'] = true;
            }

            $this->data['check_sms_mb'] = 'hôm nay';
            $this->data['check_sms_mt'] = 'hôm nay';
            $this->data['check_sms_mn'] = 'hôm nay';
            if ($time >= '18:00')
                $this->data['check_sms_mb'] = 'lần kế tiếp';
            if ($time >= '17:00')
                $this->data['check_sms_mt'] = 'lần kế tiếp';
            if ($time >= '16:00')
                $this->data['check_sms_mn'] = 'lần kế tiếp';
        }
        $client_data['_meta']['title'] = 'Xổ số ket qua xo so truc tiep KQXS nhanh nhat cho mobile';
        $this->data = array_merge($this->data, $client_data);

        header("Cache-Control: max-age=30");
        header_remove("Pragma");
        header_remove("Expires");
    }

}