<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * @author: Manh Nguyen
 * @email: manhnv@binhhoang.com
 * @date: 14.04.2012
 */

class Live extends CI_Controller {

    private $_data = array();
    private $_link = array();

    function __construct() {
        parent::__construct();
        $this->load->model(array('location_model', 'mobile_detect_loto_model', 'live_model'));
        $this->load->library('simple_html_dom');
        $this->_data['locations'] = $this->location_model->get_all();
        $this->_link = array(
            site_url() . 'ttttmb.php',
            site_url() . 'ttttmt.php',
            site_url() . 'ttttmn.php'
        );
    }

    public function index() {
        $this->load->view("layout/error404", $this->data);
    }

    function iphone() {
        $time = date('H:i');
        $area = 0;
        $idLocation = ($this->input->get('idLocation') ? $this->input->get('idLocation') : '');
        $send = ($this->input->get('send') ? $this->input->get('send') : '');
        $idLocation = strtoupper($idLocation);
        $_send = TRUE; //$this->input->get('send');
        $result = array();

        switch ($idLocation) {
            case 'MB':
                $area = 0;
                break;
            case 'MT':
                $area = 1;
                break;
            case 'MN':
                $area = 2;
                break;
            default:
                $area = 2;
        }
        //echo $idLocation; die;
        if ($idLocation != '') {
            //echo $this->_link[$area].$_send;
            $result = $this->craw($this->_link[$area], $area, $_send, $send);
            //die('adsads');
        } else {
            //echo "vaodss"; die;
            if ($time >= "16:13" && $time < "17:13") {
                $area = 2;
                //$row	=	$this->live_model->get_by(array('area' => $area,'date' => date('Y-m-d')));
                $result = $this->craw($this->_link[2], 2, $_send, $send);
            } elseif ($time >= "17:13" && $time < "17:45") {
                $result = $this->craw($this->_link[1], 1, $_send, $send);
                $area = 1;
            } elseif ($time >= "18:13" && $time < "18:45") {
                $result = $this->craw($this->_link[0], 0, $_send, $send);
                $area = 0;
            }
        }
        //echo "vaodssss"; die;
        //print_r($result);

        $this->_data['param'] = $result;
        if ($send != "ok") {
            $this->load->view('client/live/iphone', $this->_data);
        }
    }

    function craw($link, $area, $_send = false, $send_push = "") {

        //global $db;
        $row_qx = $this->live_model->get_by(array('code' => $area, 'date' => date('Y-m-d'), 'done' => 1));

        if ($row_qx) {
            return $row_qx->cache;
        } else {
            $result = array();
            $cache = array();
            $result = $this->get_xstt($area); // push to notification		
            if (!$result) {
                //print_r("vao day roi");
                //	$link = $link.'?mdate='.date('d/m/Y');
                //echo $link;
                $xml = @simplexml_load_file($link, 'SimpleXMLElement', LIBXML_NOCDATA);

                $titleList = array(
                    'giaidacbietsauso' => 0,
                    'giaidacbiet' => 0,
                    'giainhat' => 1,
                    'giainhi' => 2,
                    'giaiba' => 3,
                    'giaitu' => 4,
                    'giainam' => 5,
                    'giaisau' => 6,
                    'giaibay' => 7,
                    'giaitam' => 8,
                );
                $done = 0;
                $items = $this->getNames();

                //die('asasa');
                $matche = array();
                //echo "<pre>";
                //print_r($items);
                //die;	
                //echo $area;
                //die;
                // Nếu là giải xổ số không phải Miền Bắc
                if ($xml) {
                    if ($area > 0) {
                        // Duyệt qua danh sách các giải

                        $xong = true;
                        $i = 0;
                        foreach (get_object_vars($xml) as $code => $item) {
                            $lid = isset($items[$code]) ? $items[$code]->id : 25;
                            $result[$code]['lid'] = $lid;
                            $result[$code]['area'] = $area;
                            $result[$code]['code'] = $code;
                            // Duyệt qua danh sách các trường dữ liệu trong giải

                            foreach (get_object_vars($item) as $k => $v) {
                                $v = trim($v);
                                if (isset($titleList[$k])) {
                                    $k = $titleList[$k];
                                    // Nếu chưa có dữ liệu, xs miền nam có 2 giải đặc biệt
                                    // Loại bỏ giải ĐB 5 số
                                    if (empty($result[$code]['data'][$k])) {
                                        $result[$code]['data'][$k] = str_replace('<br />', ',', $v);
                                    }
                                } else if (preg_match('/dau(\d)/ism', $k, $matche)) {
                                    $k = $matche[1];
                                    $result[$code]['extra'][$k] = $v;
                                } else {
                                    $result[$code][$k] = $v;
                                }
                            }

                            if ($result[$code]['status'] != 'quayxong') {
                                $xong = false;
                                //$result[$code]['status']=0;
                                //die();
                            } else {
                                //$result[$code]['status']=1;
                            }
                            $i++;
                        }
                        if ($xong == true && $i > 0) {
                            $done = 1;
                            //$result[$code]['status']=1;
                        }
                    } else {
                        //print_r("vao day roi");
                        // Nếu là giải xổ số miền bắc
                        $code = 'MB';
                        $lid = isset($items[$code]) ? $items[$code]->id : null;
                        $result[$code]['lid'] = $lid;
                        $result[$code]['area'] = $area;
                        $result[$code]['code'] = $code;
                        // Duyệt qua danh sách các trường dữ liệu trong giải
                        foreach (get_object_vars($xml) as $k => $v) {
                            if (strpos($k, '@') === 0) {
                                continue;
                            }
                            $k = trim($k);
                            $v = trim($v);
                            if (isset($titleList[$k])) {
                                $k = $titleList[$k];
                                // Nếu chưa có dữ liệu, xs miền nam có 2 giải đặc biệt
                                // Loại bỏ giải ĐB 5 số
                                if (empty($result[$code]['data'][$k])) {
                                    $result[$code]['data'][$k] = str_replace('<br />', ',', $v);
                                }
                            } else if (preg_match('/dau(\d)/ism', $k, $matche)) {
                                $k = $matche[1];
                                $result[$code]['extra'][$k] = $v;
                            } else {
                                $result[$code][$k] = $v;
                            }
                        }
                        if ($result[$code]['status'] == 'quayxong') {
                            $done = 1;
                            //$result[$code]['status']=1;
                        }
                    }
                } else {
                    $row = $this->live_model->get_by(array('code' => $area, 'date' => date('Y-m-d')));
                    if ($row) {
                        return $row->cache;
                    } else {
                        return NULL;
                    }
                }
            }

            if ($result) {

                $cache['cache'] = $result;
                $cache['code'] = $area;
                $cache = json_encode($cache);

                //Send result to iphone
                //echo $_SERVER['QUERY_STRING'];
                if ($send_push == "ok") {

                    $this->push_result($result, $area, $_send);
                } else {
                    
                }

                //die();
                //
				$data = array(
                    'cache' => $cache,
                    'time' => date('Y-m-d H:i:s')
                );
                if ($row) {
                    if ($row->done == 0) {
                        if ($area == 1) {
                            if (date('H:i') <= '17:20') {
                                $done = 0;
                            }
                        }
                        $data['done'] = $done;
                        $this->live_model->update($row->id, $data);
                    }
                } else {
                    $data['date'] = date('Y-m-d');
                    $data['code'] = $area;
                    $data['done'] = 0;
                    $this->live_model->insert($data);
                }
            }

            if ($row) {
                return $row->cache;
            } else {
                return $cache;
            }
            //Update and Return Result
        }//End Case dang quay
    }

    //craw 

    function get_xstt($area = 2) {
        $link = array(
            site_url() . 'ttttmb.php',
            site_url() . 'ttttmt.php',
            site_url() . 'ttttmn.php'
        );

        $result = array();
        $xml = simplexml_load_file($link[$area], 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($area > 0) {
            foreach (get_object_vars($xml) as $code => $item) {
                $lid = isset($items[$code]) ? $items[$code]->id : null;

                $data = array();
                $result[$code]['area'] = $area;
                $result[$code]['code'] = $code;

                $this->db->where("status", 1);
                $this->db->where("code", $code);
                $_list = $this->db->select('*')->from('xs_location')->get()->row();
//                echo $this->db->last_query();

                if ($_list) {
                    $result[$code]['lid'] = $_list->id;
                    $result[$code]['name'] = $_list->name;
                } else {
                    return null;
                }
                foreach (get_object_vars($item) as $k => $v) {
                    $v = trim($v);
                    if (isset($titleList[$k])) {
                        $k = $titleList[$k];
                    } else if (preg_match('/dau(\d)/ism', $k, $matche)) {
                        $k = $matche[1];
                        $result[$code]['extra'][$k] = $v;
                    } else if (preg_match('/giai([\w]+)/ism', $k, $matche)) {
                        if ($matche[1] != 'dacbiet') {
                            $data[] = str_replace(array('<br />', '<br/>', '<br \/>'), '-', $v);
                        }
                    } else if (preg_match('/status/ism', $k, $matche)) {
                        $result[$code]['status'] = $v;
                    }
                }

                $result[$code]['data'] = $data;
            }
        } else {
            $code = 'MB';
            $lid = isset($items[$code]) ? $items[$code]->id : null;
            $result[$code]['lid'] = 1;
            $result[$code]['area'] = $area;
            $result[$code]['code'] = $code;
            $result[$code]['name'] = 'Miền Bắc';
            $data = array();
            foreach (get_object_vars($xml) as $k => $v) {
                if (strpos($k, '@') === 0) {
                    continue;
                }
                $k = trim($k);
                $v = trim($v);
                if (isset($titleList[$k])) {
                    $k = $titleList[$k];
                    $data[] = str_replace('<br />', ',', $v);
                } else if (preg_match('/dau(\d)/ism', $k, $matche)) {
                    $k = $matche[1];
                    $result[$code]['extra'][$k] = $v;
                } else if (preg_match('/giai([\w]+)/ism', $k, $matche)) {
                    $data[] = str_replace(array('<br />', '<br/>', '<br \/>'), '-', $v);
                } else if (preg_match('/status/ism', $k, $matche)) {
                    $result[$code]['status'] = $v;
                }
            }

            $result[$code]['data'] = $data;
        }
        return $result;
    }

    function push_result($result = array(), $area = NULL, $_send = false) {
        error_reporting(-1);

        @set_time_limit(60, 30);
        //die('asasasa');
        if ($_send) {
            switch ($area) {
                case '0':
                    $area = 'MB';
                    break;
                case '1':
                    $area = 'MT';
                    break;
                case '2':
                    $area = 'MN';
                    break;
            }

            //echo $area;
            //echo '<pre>';
            //print_r($result);

            $this->load->model('iphone_send_result_model');
            $this->load->model('iphone_dv_register_receive_ms_model');
            $rows = $this->iphone_dv_register_receive_ms_model->get_result($area);
//            var_dump($rows);die;
//            $str = "263,274,276,281,282";
            //$rows2	=	$this->iphone_dv_register_receive_ms_model->get_result_token_id($str,$area);
            //$this->_push("bd0f451e0ef2e81ee950e698fe3b9b1c454261ae299411eca1fe430eb981351a", "test push Perm moi");
            //$this->_push("766889ff5a98a2adef33610464974d428c99c442603d26ad1f1fbf262d1ff09b", "test push Perm moi"); echo "pushed";
            //echo "<pre>"; print_r($rows);
            //echo "Pushed"; die;
            //Duyet qua cac tinh
            foreach ($result as $k_r => $v_r) {
//                $location = $k_r;
                $data = $v_r['data'];
                //die($location.'asasasaa');
                //echo "<pre>"; print_r($v_r);
                //Duyet qua cac giai
                $data = array_reverse($data, true);

//                $this->_push("68b0444d209cc78bc29bd2127fab4ce952c780b58e9ffbc586c72e3da2e4cde1", "Test push");
//                echo "da gui";
//                die;
                if ($v_r['status'] == "chuaquay") {
                    echo "chua quay <br>";
                } elseif ($v_r['status'] == "dangquay") {
                    echo "Dang quay<br>";
                } elseif ($v_r['status'] == "quayxong") {
                    echo "quay xong<br>";
                }

                if ($v_r['status'] == "quayxong") {
//                    $deviceToken = 'de9f3144fb5dfdbe73acaa21e6b0ade6f98f1c4d303382e6c9cb4b1e3e9c6a94'; // cuong
                    //dcbab2a5af8b24c9f6c4f18a0c187b2f336d27d2063c7b5403627e2fba3ce548 - Tuyen
                    //a72afcb29b4f4db35b9d5a3e38394d4711446ac85a32223904f2c77ce0c2b589 ipod 5
//                    $message . $v_r['code'] = "KQXS " . $v_r['name'] . ": ";
                    $message = "KQXS " . $v_r['name'] . ": ";
                    //print_r($data);
                    $giai = "";
                    foreach ($data as $k_data => $v_data) {
                        if ($v_data != '') {
                            $message .= ($k_data == 0 ? ' G:DB' : ' G:' . $k_data) . ': ' . $v_data;
                        }
                        $giai .= $v_data . ";";
                    }
                    $date = date('Y-m-d');
                    //print_r($rows) 
                    foreach ($rows as $k => $v) {
                        $device_token = $v->device_token;
//                        $area_recieve = $v->area_recieve;
                        $id_dv_register = $v->id_dv_register;
                        //$this->_push($deviceToken, $message.$v_r['code']);	
                        //if($device_token =="bd0f451e0ef2e81ee950e698fe3b9b1c454261ae299411eca1fe430eb981351a")// || $device_token =="dcbab2a5af8b24c9f6c4f18a0c187b2f336d27d2063c7b5403627e2fba3ce548" || $device_token =="a72afcb29b4f4db35b9d5a3e38394d4711446ac85a32223904f2c77ce0c2b589")
                        if ($device_token != "") {
                            //$this->_push($deviceToken, $message.$v_r['code']);
                            //die;
                            // Cap nhat nhung thang nao hom nay da duoc gui, neu gui toi thi thoi (theo ngay).
                            $data_u = array('nexttime' => $date);
                            //print_r($data_u);
                            echo $device_token . "<br>";
                            if ($this->_push($device_token, $message)) {
                                if ($this->iphone_dv_register_receive_ms_model->update($id_dv_register, $data_u)) {
                                    //	echo $device_token."<br>";
                                    echo 'Update success!<br />';
                                    //$a = 1;
                                    $bb = 1;
                                } else {
                                    echo 'Update error!<br />';
                                }
                            } else {
                                echo 'Push error!<br />';
                            }



                            //if($device_token !=="")
                            //die;

                            /*

                              $a	=	'a'.$k_data;
                              $check	=	$this->iphone_send_result_model->get_by(array('id_dv_register' => $id_dv_register, 'location' => $location, 's_'.$a => 1,'date' => $date));
                              {
                              $_row	=	$this->iphone_send_result_model->get_by(array('id_dv_register' => $id_dv_register, 'location' => $location, 'date' => $date));
                              //print_r($_row);die;
                              $data_u	=	array(
                              $a			=>	$v_data,
                              'd_'.$a		=>	date('Y-m-d H:i:s'),
                              's_'.$a		=>	$status,
                              'status'    => 1
                              );

                              echo time()."<br>";
                              if(!$check) // neu chua kiem tra thiet bi
                              {
                              if($_row)
                              {//Update
                              if(isset($_row->status) && $_row->status ==0){
                              if($this->_push($device_token, $message.$v_r['code']))
                              {
                              if($this->iphone_send_result_model->update($_row->id,$data_u))
                              {
                              echo 'Update success!<br />';
                              //$a = 1;
                              $bb = 1;
                              }
                              }
                              }
                              }
                              else//Insert
                              {
                              $data_u['date']	=	$date;
                              $data_u['location']	=	$location;
                              $data_u['id_dv_register']	=	$id_dv_register;
                              $data_u['status']	=	1;
                              if($this->_push($device_token, $message.$v_r['code']))
                              {
                              if($this->iphone_send_result_model->insert($data_u))
                              {
                              echo 'Insert success!<br />';
                              //$a = 1;
                              $bb = 1;
                              }
                              }

                              }
                              }

                              }
                             */
                            //$this->_push($deviceToken, $message.$v_r['code']);
                            //die;
                            /*
                              $a	=	'a'.$k_data;
                              $check	=	$this->iphone_send_result_model->get_by(array('id_dv_register' => $id_dv_register, 'location' => $location, 's_'.$a => 1,'date' => $date));
                              echo "SSSSSSSSSSSSs";
                              if($check) // neu chua kiem tra thiet bi
                              {
                              echo "SSSSSSSSSSSS";
                              //Send and update status
                              $status	=	$this->check_du_giai($location,$k_data,$v_data);

                              $_row	=	$this->iphone_send_result_model->get_by(array('id_dv_register' => $id_dv_register, 'location' => $location, 'date' => $date));
                              $array_giai = explode(";",$giai);
                              for($i=0;$i<count($array_giai)-1;$i++)
                              {
                              $data_us	=	array(
                              $a			=>	$array_giai[$i],
                              'd_'.$a		=>	date('Y-m-d H:i:s'),
                              's_'.$a		=>	$status
                              );
                              echo "<pre>";
                              print_r($data_us);
                              }

                              if($_row)
                              {//Update
                              if(!$this->_push($device_token, $message))
                              {
                              if($this->iphone_send_result_model->update($_row->id,$data_u))
                              {
                              echo 'Update success!<br />';
                              //$a = 1;
                              $bb = 1;
                              }
                              }

                              }
                              else//Insert
                              {
                              $data_u['date']	=	$date;
                              $data_u['location']	=	$location;
                              $data_u['id_dv_register']	=	$id_dv_register;

                              if($this->_push($deviceToken, $message))
                              {
                              if($this->iphone_send_result_model->insert($data_u))
                              {
                              echo 'Insert success!<br />';
                              //$a = 1;
                              $bb = 1;
                              }
                              }

                              }

                              }	//end check
                             */
                        }
                    }//end for rows		
                }
            }//KT Duyet qua cac tinh
            //echo "aaaa";
        }
    }

    function &getNames() {
        $result = $this->location_model->get_all();
        return $result;
    }

    function push($fp, $deviceToken, $message) {

        //die('asasasasasasasa');	
        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        //$result	=	true;
        //fclose($fp);

        if (!$result) {
            //echo 'Message not delivered' . PHP_EOL;
            return false;
        } else {
            //echo 'Message successfully delivered' . PHP_EOL;
            return true;
        }

        // Close the connection to the server
    }

    function _push($deviceToken, $message) {

        //die('asasasa');
//        $root_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/';
        //echo $root_dir;
        //$rows	=	$this->iphone_device_token_model->get_all();
        //foreach($rows as $k => $v){
        //$deviceToken = $v->device_token;//'d9146b0f0f1313761725c10d9184f64a2e0e19436165f161212d7f8a60e929d7';
        //die($root_dir);
        //die($root_dir);
        // Put your device token here (without spaces):
        //$deviceToken = 'd9146b0f0f1313761725c10d9184f64a2e0e19436165f161212d7f8a60e929d7';
        // Put your private key's passphrase here:
        $passphrase = 'son09798';
        //$passphrase	=	'';
        // Put your alert message here:
        //$message = 'Ket qua giai dac biet XSMB: 45644!';
        ////////////////////////////////////////////////////////////////////////////////

        $ctx = stream_context_create();
        //stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_developer.pem');
        stream_context_set_option($ctx, 'ssl', 'local_cert', base_url() . "data/ssl/" . 'xoso_distribution.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp) {
            echo ("Failed to connect: $err $errstr" . PHP_EOL);
            return FALSE;
        }
        //echo 'Connected to APNS' . PHP_EOL;
        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        //	echo $msg;	
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        fclose($fp);
        if (!$result) {
            //die('asasa');
            //echo 'Message not delivered' . PHP_EOL;
            return false; //echo 'Message not delivered' . PHP_EOL;
        } else {
            //die('asasasasa');
            return true; //echo 'Message successfully delivered' . PHP_EOL;
        }

        // Close the connection to the server
    }

}