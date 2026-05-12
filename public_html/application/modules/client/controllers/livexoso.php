<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class livexoso extends Client {

    function __construct() {
        parent::__construct();
        // $time = date('H:i');
        // if ($time > '16:00' && $time < '19:00')
        //     header("Cache-Control: max-age=3");
    }

    public function index($alias) {
        $this->load->model('xs_result_model');
        
        $timeMB_end = '18:55';
        $timeMT_end = '17:55';
        $timeMN_end = '16:55';

        $time = date('H:i');        
		
        if ($alias == 'home') {
            if ($time < '17:00') {
                $alias = 'mien-nam';
            } elseif ($time >= '17:00' && $time <= '18:00') {
                $alias = 'mien-trung';
            }
        }

        $areamb = 'MB';        
        $this->data['timermb'] = $this->data['location_menu']['MB'][0]->time;
        
        $areamt = 'MT';
        $this->data['timermt'] = $this->data['location_menu']['MT'][0]->time;

        $areamn = 'MN';
		//echo $this->data['location_menu']['MN'][0]->time;
        $this->data['timermn'] = $this->data['location_menu']['MN'][1]->time;
        
        $this->data['areamb'] = $areamb;
        $this->data['areamt'] = $areamt;
        $this->data['areamn'] = $areamn;
        
        $this->data['tmplmb'] = 'livexoso/ttttmb';
        $this->data['tmplmt'] = 'livexoso/ttttmt';
        $this->data['tmplmn'] = 'livexoso/ttttmn';
        $this->load->view('layout/livexoso', $this->data);
    }

    public function livemb($alias)
    {
        $this->load->model('xs_result_model');
        $timeMB_end = '18:55';
        $timeMT_end = '17:55';
        $timeMN_end = '16:55';
        $time = date('H:i');        
        
        if ($alias == 'home') {
            if ($time < '17:00') {
                $alias = 'mien-nam';
            } elseif ($time >= '17:00' && $time <= '18:00') {
                $alias = 'mien-trung';
            }
        }

        $result = $this->xs_result_model->getResultLotoYesterday($areamt);
        $this->data['last_mb'] = $result->cache->data;
        $this->data['date_mb'] = $result->cache->date;

        $areamb = 'MB';        
        $this->data['timermb'] = $this->data['location_menu']['MB'][0]->time;
        $this->data['areamb'] = $areamb;
        $this->data['tmplmb'] = 'livexoso/ttttmb_1';
        $this->load->view('layout/livemb', $this->data);
    }

    public function livemt($alias)
    {
        $this->load->model('xs_result_model');
        $timeMB_end = '18:55';
        $timeMT_end = '17:55';
        $timeMN_end = '16:55';
        $time = date('H:i');        
        
        if ($alias == 'home') {
            if ($time < '17:00') {
                $alias = 'mien-nam';
            } elseif ($time >= '17:00' && $time <= '18:00') {
                $alias = 'mien-trung';
            }
        }

        $areamt = 'MT';
        $this->data['timermt'] = $this->data['location_menu']['MT'][0]->time;
        $this->data['areamt'] = $areamt;
        $this->data['tmplmt'] = 'livexoso/ttttmt_1';
        $this->load->view('layout/livemt', $this->data);
    }

    public function livemn($alias)
    {
        $this->load->model('xs_result_model');
        $timeMB_end = '18:55';
        $timeMT_end = '17:55';
        $timeMN_end = '16:55';
        $time = date('H:i');        
        
        if ($alias == 'home') {
            if ($time < '17:00') {
                $alias = 'mien-nam';
            } elseif ($time >= '17:00' && $time <= '18:00') {
                $alias = 'mien-trung';
            }
        }

        $areamn = 'MN';
        $this->data['timermn'] = $this->data['location_menu']['MN'][1]->time;
        $this->data['areamn'] = $areamn;
        $this->data['tmplmn'] = 'livexoso/ttttmn_1';
        $this->load->view('layout/livemn', $this->data);
    }
}