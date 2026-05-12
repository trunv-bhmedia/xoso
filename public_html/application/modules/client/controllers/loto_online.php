<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class loto_online extends Client {

    function __construct() {
        parent::__construct();
        error_reporting(-1);
        $this->load->model(array('xs_result_model', 'xs_loto_online_model', 'xs_loto_onlinetk_model'));
        header("Cache-Control: max-age=0");
    }

    public function index() {
        $date = date('Y-m-d');
        $nextday = $date;
        $hour = date('H');
        if ($hour > 18)
            $nextday = date('Y-m-d', strtotime('+1 days'));

//        if (isset($_SESSION['user']['id'])) {
//            $taikhoan = 0;
//            $loto_online = $this->db->select("taikhoan")
//                            ->from("xs_loto_online")
//                            ->where('quay', 1)
//                            ->where("userid", $_SESSION['user']['id'])
//                            ->order_by('ngay', 'DESC')
//                            ->get()->row();
//
//            if ($loto_online)
//                $taikhoan = $loto_online->taikhoan;
//
//            $query = "SELECT CONCAT_WS(',',a.b0,a.b1,a.b2,a.b3,a.b4,a.b5,a.b6,a.b7) AS arr_loto,b.id AS lo_id,b.taikhoan
//                    FROM xs_result as a
//                    LEFT JOIN xs_loto_online AS b ON a.date=b.ngay
//                    WHERE a.lid=1
//                    AND b.quay=0
//                    AND b.userid=" . $_SESSION['user']['id'] . "
//                    ORDER BY b.ngay ASC"
//            ;
//            $data = $this->db->query($query)->row();
//            
//            if ($data) {
//                $arr_loto = explode(',', $data->arr_loto);
//
//                $loto_onlinetk = $this->db->select("*")
//                                ->from("xs_loto_onlinetk")
//                                ->where('lo_id', $data->lo_id)
//                                ->get()->result();
//                if ($loto_onlinetk) {
//                    $chi = 0;
//                    $thu = 0;
//                    foreach ($loto_onlinetk as $item) {
//                        $chi = $chi + ($item->diem * 23);
//                        $dem = 0;
//                        foreach ($arr_loto as $so) {
//                            if ($item->lo == $so) {
//                                $dem++;
//                            }
//                        }
//                        if ($dem > 0) {
//                            $this->xs_loto_onlinetk_model->update($item->id, array('nhay' => $dem));
//                            $thu = $thu + ($item->diem * 80 * $dem);
//                        }
//                    }
//                    $taikhoan = $taikhoan + ($thu - $chi);
//                    $this->xs_loto_online_model->update($data->lo_id, array('taikhoan' => $taikhoan, 'quay' => 1));
//                }
//            }
//
//            $this->data["taikhoan"] = $taikhoan;
//        }

		$this->data['_meta']['title'] = "Dự đoán kết quả loto online hôm nay, ngày mai";
		$this->data['_meta']['description'] = "Dự đoán kết quả loto xổ số online hôm nay, ngày mai miễn phí không cần nạp tiền chỉ có tại xoso.com";
		$this->data['_meta']['keywords'] = "dự đoán kết quả loto, du doan ket qua loto, dự đoán loto online, dự đoán kết quả xổ số online";

        $this->data["nextday"] = $nextday;
        $this->data["date"] = $date;
        $this->data["tmpl"] = "loto_online/index";
        $this->load->view("layout/content", $this->data);
    }

    public function betlist() {
        $ngay = (isset($_GET['ngay']) ? $_GET['ngay'] : '');

        if (!isset($_SESSION['user']['id']) || $ngay == '')
            die;

        $hour = date('H');
        if ($hour > 18)
            $ngay = date('Y-m-d', strtotime('+1 days'));
        
        $loto_online = $this->db->select("id,ngay,taikhoan")
                        ->from("xs_loto_online")
                        ->where('ngay <', $ngay)
                        ->where('quay', 1)
                        ->where("userid", $_SESSION['user']['id'])
                        ->order_by('ngay', 'DESC')
                        ->limit(7)
                        ->get()->result();

        $out_str = '';
        if ($loto_online) {
            foreach ($loto_online as $item) {
                $loto_onlinetk = $this->db->select("lo,diem,nhay")
                                ->from("xs_loto_onlinetk")
                                ->where('lo_id', $item->id)
                                ->order_by('created', 'ASC')
                                ->get()->result();

                if ($loto_onlinetk) {
                    $out_str .= $item->ngay . '~';
                    foreach ($loto_onlinetk as $value) {
                        $out_str .= $value->lo . ':' . $value->diem . ':' . $value->nhay . ',';
                    }
                    $out_str = substr($out_str, 0, -1);
                    $out_str .= '~' . $item->taikhoan . '|';
                }
            }
        }
        if ($out_str != '') {
            $out_str = substr($out_str, 0, -1);
            echo $out_str;
        }
        die;
    }

    public function betupdate() {
        $so = (isset($_GET['range']) ? trim($_GET['range']) : '');
        $diem = (isset($_GET['bet']) ? $_GET['bet'] : 0);
        $ngay = (isset($_GET['ngay']) ? $_GET['ngay'] : '');

        if (!isset($_SESSION['user']['id']) || $diem > 2000 || $ngay == '')
            die;

        $today = date('Y-m-d');
        $hour = date('H');
        if ($ngay == $today && $hour > 18) {
            $loto_onlinetk = $this->db->select("a.id,b.lo,b.diem")
                            ->from("xs_loto_online AS a")
                            ->join("xs_loto_onlinetk AS b", "a.id=b.lo_id")
                            ->where("a.ngay", $ngay)
                            ->where("a.userid", $_SESSION['user']['id'])
                            ->get()->result();
            $out_str = '';
            if ($loto_onlinetk) {
                foreach ($loto_onlinetk as $value) {
                    $out_str.=$value->lo . ':' . $value->diem . '|';
                }
            }
            if ($out_str != '') {
                $out_str = substr($out_str, 0, -1);
                echo $out_str;
            }

            die;
        }

        if ($so != '' && $diem > 0 && $ngay >= $today) {
            $arr_so = explode(',', $so);
            $arr_so = array_unique($arr_so);

            foreach ($arr_so as $i => $value) {
                if (strlen($value) > 2)
                    unset($arr_so[$i]);
                elseif (!is_numeric($value))
                    unset($arr_so[$i]);
            }
//            $ngay = date('Y-m-d', strtotime($ngay));

            $taikhoan = 0;
            $loto_online = $this->db->select("taikhoan")
                            ->from("xs_loto_online")
                            ->where('quay', 1)
                            ->where("userid", $_SESSION['user']['id'])
                            ->order_by('ngay', 'DESC')
                            ->get()->row();

            if ($loto_online)
                $taikhoan = $loto_online->taikhoan;

            $loto_online = $this->db->select("id")
                            ->from("xs_loto_online")
                            ->where('quay', 0)
                            ->where('ngay', $ngay)
                            ->where("userid", $_SESSION['user']['id'])
                            ->get()->row();

            if ($loto_online) {
                foreach ($arr_so as $value) {
                    $loto_onlinetk = $this->db->select("id")
                                    ->from("xs_loto_onlinetk")
                                    ->where("lo_id", $loto_online->id)
                                    ->where("lo", $value)
                                    ->get()->row();
//                    echo $this->db->last_query();
                    if ($loto_onlinetk) {
                        $this->xs_loto_onlinetk_model->update($loto_onlinetk->id, array('diem' => $diem));
                    } else {
                        $data = array(
                            'lo_id' => $loto_online->id,
                            'lo' => $value,
                            'diem' => $diem,
                            'created' => time(),
                        );
                        $this->xs_loto_onlinetk_model->insert($data);
                    }
                }
            } else {
                $data = array(
                    'ngay' => $ngay,
                    'userid' => $_SESSION['user']['id'],
                    'taikhoan' => $taikhoan,
                    'created' => time(),
                );
                $this->xs_loto_online_model->insert($data);
                $lo_id = $this->db->insert_id();
                foreach ($arr_so as $value) {
                    $data = array(
                        'lo_id' => $lo_id,
                        'lo' => $value,
                        'diem' => $diem,
                        'created' => time(),
                    );
                    $this->xs_loto_onlinetk_model->insert($data);
                }
            }
        } elseif ($so != '' && $diem == 0 && $ngay >= $today) {
            $arr_so = explode(',', $so);
            $arr_so = array_unique($arr_so);

            $id_list = '';
            $out_str = '';
            foreach ($arr_so as $i => $value) {
                if (strlen($value) > 2)
                    unset($arr_so[$i]);
                elseif (!is_numeric($value))
                    unset($arr_so[$i]);
                else {
                    $id_list.='\'' . $value . '\',';
                    $out_str.=$value . ':0|';
                }
            }
            if ($id_list != '') {
                $id_list = substr($id_list, 0, -1);
                $loto_online = $this->db->select("id")
                                ->from("xs_loto_online")
                                ->where('quay', 0)
                                ->where("ngay", $ngay)
                                ->where("userid", $_SESSION['user']['id'])
                                ->get()->row();

                if ($loto_online) {
                    $query = "DELETE FROM `xs_loto_onlinetk` WHERE lo_id=" . $loto_online->id . " AND lo IN(" . $id_list . ")";
                    $this->db->query($query);
//                    echo $this->db->last_query();
                }
            }

            if ($out_str != '') {
                $out_str = substr($out_str, 0, -1);
                echo $out_str;
            }

            die;
        }

        $loto_onlinetk = $this->db->select("a.id,b.lo,b.diem")
                        ->from("xs_loto_online AS a")
                        ->join("xs_loto_onlinetk AS b", "a.id=b.lo_id")
                        ->where("a.ngay", $ngay)
                        ->where("a.userid", $_SESSION['user']['id'])
                        ->get()->result();
        $out_str = '';
        if ($loto_onlinetk) {
            foreach ($loto_onlinetk as $value) {
                $out_str.=$value->lo . ':' . $value->diem . '|';
            }
        }
        if ($out_str != '') {
            $out_str = substr($out_str, 0, -1);
            echo $out_str;
        }

        die;
    }

    public function betkq() {
        $ngay = (isset($_GET['ngay']) ? $_GET['ngay'] : '');

        if (!isset($_SESSION['user']['id']) || $ngay == '')
            die;

        $str = '';
        $loto_online = $this->db->select("id")
                        ->from("xs_loto_online")
                        ->where("ngay", $ngay)
                        ->where("quay", 1)
                        ->where("userid", $_SESSION['user']['id'])
                        ->get()->row();
        if ($loto_online) {
            $loto_onlinetk = $this->db->select("*")
                            ->from("xs_loto_onlinetk")
                            ->where('lo_id', $loto_online->id)
                            ->where('nhay >', 0)
                            ->get()->result();
            if ($loto_onlinetk) {
                $str = '';
                foreach ($loto_onlinetk as $item) {
                    $str .=$item->lo . ':' . $item->nhay . '|';
                }
            }
            echo $str . 'finish';
        }

        die;
    }

}