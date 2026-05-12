<?php

class Client extends CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model(array('user_model', 'session_model', 'meta_model', 'xs_location_model', 'banner_model', 'xs_keyword_model', 'xs_loto_online_model', 'xs_loto_onlinetk_model', 'xs_loto_top_model'));
        $this->load->library('simple_cache');
//        $this->load->library(array('message', 'simple_cache', 'Mobile_Detect'));
//        $this->lang->load('form_validation', 'vi');
//        $detect = new Mobile_Detect;
//
//        $REFERER = $_SERVER["HTTP_REFERER"];
//        if ($REFERER != '') {
//            $parse_url = parse_url($REFERER);
//            if (isset($parse_url['host']) && $parse_url['host'] == 'm.xoso.com') {
//                if (!isset($_SESSION["origURL"]))
//                    $_SESSION["origURL"] = $parse_url['host'];
//            }
//        }
//        
//        if ($detect->isMobile() && !isset($_SESSION["origURL"])) {
//            redirect('http://m.xoso.com/');
//        }
        $this->data['c_module'] = $this->router->class;
        $this->data['c_func'] = $this->router->method;

        $hour = date('H');
        $date_loto = date('Y-m-d');
        $nextday_loto = $date_loto;

        if ($hour >= 18) {
            $nextday_loto = date('Y-m-d', strtotime('+1 days'));
        }

        $this->data["nextday_loto"] = $nextday_loto;
        $this->data["date_loto"] = $date_loto;
        $this->data["date_chot"] = $nextday_loto;

        $arr_func_ajax = array(
            'xstt',
            'loadkqxs',
            'loadtinh',
            'getkqxs',
            'getkqxsdemo',
            'getkqxsj',
            'getkqxsj2',
            'getkqxswp',
            'loadKq',
            'loadtkhome',
            'betlist',
            'betupdate',
            'betkq',
            'sendhtml',
            'chatlist',
            'chatsrv',
            'userinfo',
            'friend',
            'chatstateupdate',
            'ajaxsearch',
            'onlinestatdata',
            'chot',
            'trend',
            'timesrv',
            'openid',
            'scan',
            'loadst',
            'lototop'
        );

        $time_end = time();

        $query = "SELECT id,userid,created FROM `sessions`";
        $sessions = $this->db->query($query)->result();
        $arr_user = array();
        if ($sessions) {
            foreach ($sessions as $item) {
                $time = $time_end - $item->created;
                if ($time > (60 * 60)) {
                    $this->session_model->delete($item->id);
                } else {
                    $arr_user[] = $item->userid;
                }
            }
        }

        if (!$_SESSION['user']) {
            if ($mid = get_cookie('__user')) {
                if ($user = $this->user_model->get_by_id_to_array($mid)) {
                    $_SESSION['user'] = $user;

                    if (!in_array($_SESSION['user']['id'], $arr_user)) {
                        $query = "DELETE FROM `sessions` WHERE userid=" . $_SESSION['user']['id'];
                        $this->db->query($query);
                        unset($_SESSION['user']);
                        delete_cookie('__user');
                    }
                }
            } else {
                if ($sessions = $this->session_model->get_by(array('sessid' => session_id()))) {
                    $user = $this->user_model->get_by_id_to_array($sessions->userid);
                    $_SESSION['user'] = $user;

                    if (!in_array($_SESSION['user']['id'], $arr_user)) {
                        $query = "DELETE FROM `sessions` WHERE userid=" . $_SESSION['user']['id'];
                        $this->db->query($query);
                        unset($_SESSION['user']);
                        delete_cookie('__user');
                    }
                }
            }
        } else {
            if (!$sessions = $this->session_model->get_by(array('sessid' => session_id()))) {
                $query = "DELETE FROM `sessions` WHERE userid=" . $_SESSION['user']['id'];
                $this->db->query($query);
                unset($_SESSION['user']);
                delete_cookie('__user');
            }
        }

        if (isset($_SESSION['user']) && !in_array($this->data['c_func'], $arr_func_ajax)) {
            $query = "UPDATE `sessions` SET created=" . time() . " WHERE userid=" . $_SESSION['user']['id'];
            $this->db->query($query);
        }

        if (isset($_SESSION['redirect_login']) && $this->data['c_module'] != 'home' && $this->data['c_module'] != 'user' && $this->data['c_module'] != base_url() . 'favicon.ico' && strpos(current_url(), 'public/client') === false//ko tim thay
                && strpos(current_url(), 'uploads') === false//ko tim thay
                && !in_array($this->data['c_func'], $arr_func_ajax)) {
            $_SESSION['redirect_login'] = current_url();
        }

        if (!isset($_SESSION['redirect_login']) || $_SESSION['redirect_login'] == base_url() . 'favicon.ico' || strpos($_SESSION['redirect_login'], 'public/client') !== false//tim thay
                || strpos($_SESSION['redirect_login'], 'uploads') !== false)//tim thay
            $_SESSION['redirect_login'] = base_url();

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

            $client_data['banner'] = $this->banner_model->order_by("order", "ASC")->get_many_by(array('active' => 'yes'));
            $client_data['xs_keyword'] = $this->xs_keyword_model->order_by("order", "ASC")->get_many_by(array('published' => 1));

            $client_data['news_category'] = $this->db->select()->from("c_news_categories")
                    ->where('active', 'yes')
                    ->order_by("order", "ASC")
                    ->order_by("id", "DESC")
                    ->get()
                    ->result();

            $client_data['lastnews'] = $this->db->select("id,title,title_link")->from("c_news")
                    ->where('active', 1)
                    ->order_by("order", "ASC")
                    ->order_by("id", "DESC")
                    ->limit(10, 0)
                    ->get()
                    ->result();
			$client_data['layout_headerlive'] = 'layout/headerlive';
            $client_data['layout_header'] = 'layout/header';  
            $client_data['layout_footer'] = 'layout/footer';
            $client_data['layout_col_left'] = 'layout/col_left';
            $client_data['layout_sms'] = 'layout/sms';
            $client_data['thongke_block'] = 'layout/thongke_block';

            // store in cache
            $this->simple_cache->cache_item('client_data', $client_data);
        } else {
            $client_data = $this->simple_cache->get_item('client_data');
        }
        
        $arr_func_chat = array(
            'xstt',
            'chatlist',
            'chatsrv',
            'userinfo',
            'friend',
            'chatstateupdate',
            'ajaxsearch',
            'onlinestatdata',
            'chot',
            'trend',
            'timesrv',
            'openid',
            'scan',
            'loadst',
            'lototop'
        );
        if (!in_array($this->data['c_func'], $arr_func_chat)) {
            $quayxong = false;
            $query = "SELECT CONCAT_WS(',',a.b0,a.b1,a.b2,a.b3,a.b4,a.b5,a.b6,a.b7) AS arr_loto,b.id AS lo_id,b.taikhoan,b.userid
                    FROM xs_result as a
                    LEFT JOIN xs_loto_online AS b ON a.date=b.ngay
                    WHERE a.lid=1
                    AND b.quay=0
                    ORDER BY b.ngay ASC LIMIT 100"
            ;
            $xs_result = $this->db->query($query)->result();

            if ($xs_result) {
                $quayxong = true;
                foreach ($xs_result as $i => $data) {
                    $arr_loto = explode(',', $data->arr_loto);

                    $loto_onlinetk = $this->db->select("*")
                                    ->from("xs_loto_onlinetk")
                                    ->where('lo_id', $data->lo_id)
                                    ->get()->result();

                    $chi = 0;
                    $thu = 0;
                    if ($loto_onlinetk) {
                        foreach ($loto_onlinetk as $item) {
                            $chi = $chi + ($item->diem * 23);
                            $dem = 0;
                            foreach ($arr_loto as $so) {
                                if ($item->lo == $so) {
                                    $dem++;
                                }
                            }
                            if ($dem > 0) {
                                $this->xs_loto_onlinetk_model->update($item->id, array('nhay' => $dem));
                                $thu = $thu + ($item->diem * 80 * $dem);
                            }
                        }
                        $taikhoan = $data->taikhoan + ($thu - $chi);
                        $this->xs_loto_online_model->update($data->lo_id, array('taikhoan' => $taikhoan, 'quay' => 1));
                        $this->user_model->update($data->userid, array('taikhoan' => $taikhoan));
                    } else {
                        $this->xs_loto_online_model->update($data->lo_id, array('quay' => 1));
                    }
                }
            }

            $today_int = date('N') + 1;
            $start_day = date('Y-m-d');
            $day_now = date('d');
            $month = date('Y-m');
            if ($today_int == 4) {
                $start_day = date('Y-m-d', strtotime('-1 days'));
            } elseif ($today_int == 5) {
                $start_day = date('Y-m-d', strtotime('-2 days'));
            } elseif ($today_int == 6) {
                $start_day = date('Y-m-d', strtotime('-3 days'));
            } elseif ($today_int == 7) {
                $start_day = date('Y-m-d', strtotime('-4 days'));
            } elseif ($today_int == 8) {
                $start_day = date('Y-m-d', strtotime('-5 days'));
            } elseif ($today_int == 2) {
                $start_day = date('Y-m-d', strtotime('-6 days'));
            }

            $query = "SELECT CONCAT_WS(',',a.b0,a.b1,a.b2,a.b3,a.b4,a.b5,a.b6,a.b7) AS arr_loto,b.id AS lo_id,b.taikhoan,b.userid,b.ngay
                    FROM xs_result as a
                    LEFT JOIN xs_loto_online AS b ON a.date=b.ngay
                    WHERE a.lid=1
                    AND b.quay=1
                    AND b.update_top=0
                    ORDER BY b.ngay ASC LIMIT 1"
            ;
            $xs_result = $this->db->query($query)->result();
            if ($xs_result) {
                foreach ($xs_result as $value) {
                    $today_int = date('N', strtotime($value->ngay)) + 1;
                    $start_day = date('Y-m-d', strtotime($value->ngay));
                    $day_now = date('d', strtotime($value->ngay));
                    $month = date('Y-m', strtotime($value->ngay));
                    if ($today_int == 4) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -1 days'));
                    } elseif ($today_int == 5) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -2 days'));
                    } elseif ($today_int == 6) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -3 days'));
                    } elseif ($today_int == 7) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -4 days'));
                    } elseif ($today_int == 8) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -5 days'));
                    } elseif ($today_int == 2) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -6 days'));
                    }

                    $arr_loto = explode(',', $value->arr_loto);
                    $loto_onlinetk = $this->db->select("*")
                                    ->from("xs_loto_onlinetk")
                                    ->where('lo_id', $value->lo_id)
                                    ->get()->result();
                    $chi = 0;
                    $thu = 0;
                    if ($loto_onlinetk) {
                        foreach ($loto_onlinetk as $item) {
                            $chi = $chi + ($item->diem * 23);
                            $dem = 0;
                            foreach ($arr_loto as $so) {
                                if ($item->lo == $so) {
                                    $dem++;
                                }
                            }
                            if ($dem > 0) {
                                $thu = $thu + ($item->diem * 80 * $dem);
                            }
                        }
                    }
                    
                    if ($xs_loto_top = $this->xs_loto_top_model->get_by(array('tuan' => $start_day, 'userid' => $value->userid))) {
                        $this->xs_loto_top_model->update($xs_loto_top->id, array('taikhoan' => $xs_loto_top->taikhoan + ($thu - $chi), 'created' => time()));
                    } else {
                        $this->xs_loto_top_model->insert(array('tuan' => $start_day, 'thang' => time(), 'userid' => $value->userid, 'taikhoan' => ($thu - $chi), 'created' => time()));
                    }

                    if ($xs_loto_top = $this->xs_loto_top_model->get_by(array('thang' => $month, 'userid' => $value->userid))) {
                        $this->xs_loto_top_model->update($xs_loto_top->id, array('taikhoan' => $xs_loto_top->taikhoan + ($thu - $chi), 'created' => time()));
                    } else {
                        $this->xs_loto_top_model->insert(array('tuan' => time(), 'thang' => $month, 'userid' => $value->userid, 'taikhoan' => ($thu - $chi), 'created' => time()));
                    }

                    $this->xs_loto_online_model->update($value->lo_id, array('update_top' => 1));
                }
            }

            $query = "SELECT CONCAT_WS(',',a.b0,a.b1,a.b2,a.b3,a.b4,a.b5,a.b6,a.b7) AS arr_loto,b.id AS lo_id,b.taikhoan,b.userid,b.ngay,b.created
                    FROM xs_result as a
                    LEFT JOIN xs_loto_online AS b ON a.date=b.ngay
                    WHERE a.lid=1
                    AND b.quay=2
                    ORDER BY b.ngay ASC LIMIT 1"
            ;
            $xs_result = $this->db->query($query)->result();
            if ($xs_result) {
                foreach ($xs_result as $value) {
                    if($value->created>time() || $quayxong == false){
                        continue;
                    }
                    $today_int = date('N', strtotime($value->ngay)) + 1;
                    $start_day = date('Y-m-d', strtotime($value->ngay));
                    $day_now = date('d', strtotime($value->ngay));
                    $month = date('Y-m', strtotime($value->ngay));
                    if ($today_int == 4) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -1 days'));
                    } elseif ($today_int == 5) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -2 days'));
                    } elseif ($today_int == 6) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -3 days'));
                    } elseif ($today_int == 7) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -4 days'));
                    } elseif ($today_int == 8) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -5 days'));
                    } elseif ($today_int == 2) {
                        $start_day = date('Y-m-d', strtotime($value->ngay . ' -6 days'));
                    }

                    $arr_loto = explode(',', $value->arr_loto);
                    $loto_onlinetk = $this->db->select("*")
                                    ->from("xs_loto_onlinetk")
                                    ->where('lo_id', $value->lo_id)
                                    ->get()->result();
                    $chi = 0;
                    $thu = 0;
                    if ($loto_onlinetk) {
                        foreach ($loto_onlinetk as $item) {
                            $chi = $chi + ($item->diem * 23);
                            $dem = 0;
                            foreach ($arr_loto as $so) {
                                if ($item->lo == $so) {
                                    $dem++;
                                }
                            }
                            if ($dem > 0) {
                                $thu = $thu + ($item->diem * 80 * $dem);
                            }
                        }
                    }
                    
                    if ($xs_loto_top = $this->xs_loto_top_model->get_by(array('tuan' => $start_day, 'userid' => $value->userid))) {
                        $this->xs_loto_top_model->update($xs_loto_top->id, array('taikhoan' => $xs_loto_top->taikhoan + ($thu - $chi), 'created' => time()));
                    } else {
                        $this->xs_loto_top_model->insert(array('tuan' => $start_day, 'thang' => time(), 'userid' => $value->userid, 'taikhoan' => ($thu - $chi), 'created' => time()));
                    }

                    if ($xs_loto_top = $this->xs_loto_top_model->get_by(array('thang' => $month, 'userid' => $value->userid))) {
                        $this->xs_loto_top_model->update($xs_loto_top->id, array('taikhoan' => $xs_loto_top->taikhoan + ($thu - $chi), 'created' => time()));
                    } else {
                        $this->xs_loto_top_model->insert(array('tuan' => time(), 'thang' => $month, 'userid' => $value->userid, 'taikhoan' => ($thu - $chi), 'created' => time()));
                    }

                    $this->xs_loto_online_model->update($value->lo_id, array('quay' => 3));
                }
            }
            
            $tuan_nay = $start_day;
            if ($today_int == 3)
                $tuan_nay = date('Y-m-d', strtotime($start_day . ' -7 days'));
            $this->data["loto_top_tuan"] = $this->db->select("a.userid,a.taikhoan,b.fullname")
                    ->from("xs_loto_top AS a")
                    ->join("users AS b", "a.userid=b.id")
                    ->where("a.tuan", $tuan_nay)
//                ->where("a.taikhoan >", 0)
                    ->where("b.active", 'yes')
                    ->order_by("a.taikhoan", "DESC")
                    ->limit(50)
                    ->get()
                    ->result_array();

            $this->data["tuan_nay"] = $tuan_nay;
            $this->data["tuan_truoc"] = date('Y-m-d', strtotime($tuan_nay . ' -7 days'));

            $thang_nay = $month;
            if ($day_now == 1)
                $thang_nay = date('Y-m', strtotime($month . ' -1 months'));
            $this->data["loto_top_thang"] = $this->db->select("a.userid,a.taikhoan,b.fullname")
                    ->from("xs_loto_top AS a")
                    ->join("users AS b", "a.userid=b.id")
                    ->where("a.thang", $month)
//                ->where("a.taikhoan >", 0)
                    ->where("b.active", 'yes')
                    ->order_by("a.taikhoan", "DESC")
                    ->limit(50)
                    ->get()
                    ->result_array();

            $this->data["thang_nay"] = $thang_nay;
            $this->data["thang_truoc"] = date('Y-m', strtotime($thang_nay . ' -1 months'));

            $this->data["topdaigia"] = $this->db->select("id,fullname,email,taikhoan")->from("users")
                    ->where("taikhoan >", 0)
                    ->where("active", 'yes')
                    ->order_by("taikhoan", "DESC")
                    ->limit(50)
                    ->get()
                    ->result_array();

            $trendday = array();
            $tong_nguoichoi = 0;
            $loto_onlinetk = $this->db->select("b.lo")
                            ->from("xs_loto_online AS a")
                            ->join("xs_loto_onlinetk AS b", "a.id=b.lo_id")
                            ->where("a.ngay", $nextday_loto)
                            ->get()->result();
            if ($loto_onlinetk) {
                foreach ($loto_onlinetk as $value) {
                    $tong_nguoichoi++;
                    if (isset($trendday[$value->lo]))
                        $trendday[$value->lo] = $trendday[$value->lo] + 1;
                    else
                        $trendday[$value->lo] = 1;
                }
                arsort($trendday);
            }

            $this->data["trendday"] = $trendday;
            $this->data["tong_nguoichoi"] = $tong_nguoichoi;

            $date = strval(date('w') + 1);
            $client_data['location_menu'] = array();
            $client_data['location_today'] = array();
            $client_data['location_lastday'] = array();
            foreach ($client_data['xs_location_menu'] as $value) {
							
                $client_data['location_menu'][$value->area][] = $value;
                if (strpos($value->lich, strval($date)) !== false)
                    $client_data['location_today'][$value->area][] = $value;
                if (strpos($value->lich, strval($date - 1)) !== false)
                    $client_data['location_lastday'][$value->area][] = $value;
            }

            $this->data['fromdate_right'] = (isset($_GET['ngay']) ? $_GET['ngay'] : date('d-m-Y'));
            $this->data['so_right'] = (isset($_GET['so']) ? trim($_GET['so']) : '');
            $this->data['lid_right'] = (isset($_GET['tinh']) ? $_GET['tinh'] : 'xo-so-mien-bac');

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

            $this->data['meta_refresh_mb'] = true;
            $this->data['meta_refresh_mt'] = true;
            $this->data['meta_refresh_mn'] = true;
        }
        $this->data = array_merge($this->data, $client_data);

        header("Cache-Control: max-age=30");
        header_remove("Pragma");
        header_remove("Expires");
    }

}
