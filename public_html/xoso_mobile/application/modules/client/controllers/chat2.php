<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class chat2 extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('xs_loto_chat_model', 'xs_loto_online_model', 'xs_loto_onlinetk_model', 'xs_loto_chot_model', 'xs_loto_chottk_model'));
        header("Cache-Control: max-age=0");
    }

    public function thongke() {
        $this->load->model(array('xs_northern_model', 'xs_result_model'));
        $time_turn = 40;
        $this->data['itemsImportant'] = $this->xs_northern_model->getitemsImportant(1, $time_turn);
        $this->data['items_30'] = $this->xs_northern_model->getitemsImportant(1, 30);

        $this->data["tmpl"] = "chat/thongke";
        $this->load->view('layout/chat', $this->data);
    }

    public function chotso() {
        $date_chot = date('Y-m-d');
        $maxDate = date('Y, m, d', strtotime('-1 month'));
        $minDate = '2014, 10, 10';
        $hour = date('H');

        if ($hour >= 18) {
            $date_chot = date('Y-m-d', strtotime('+1 days'));
        }

        $this->data["date_chot"] = $date_chot;

        $this->data["tmpl"] = "chat/chotso";
        $this->load->view('layout/chat', $this->data);
    }

    public function index() {
        $date_chot = date('Y-m-d');
        $maxDate = date('Y, m, d', strtotime('-1 month'));
        $minDate = '2014, 10, 10';
        $hour = date('H');
        
//        $date_loto = $date_chot;
//        $nextday_loto = $date_chot;
        
        if ($hour >= 18){
            $date_chot = date('Y-m-d', strtotime('+1 days'));
//            $nextday_loto = $date_chot;
        }

        $trendday = array();
        $tong_nguoichoi = 0;
        $loto_onlinetk = $this->db->select("b.lo")
                        ->from("xs_loto_online AS a")
                        ->join("xs_loto_onlinetk AS b", "a.id=b.lo_id")
                        ->where("a.ngay", $date_chot)
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
            array_slice($trendday, 0, 20);
        }

        $this->data["minDate"] = $minDate;
        $this->data["maxDate"] = $maxDate;
        $this->data["date_chot"] = $date_chot;
        $this->data["hour"] = $hour;
        $this->data["trendday"] = $trendday;
        $this->data["tong_nguoichoi"] = $tong_nguoichoi;
        $this->data["tmpl"] = "chat2/index";
        $this->load->view("layout/chat3", $this->data);
    }
    
    public function scan() {
        if (isset($_POST['num'])) {
            $num = (isset($_POST['num']) ? $_POST['num'] : '');
            $mode = (isset($_POST['mode']) ? $_POST['mode'] : 0);
            $from = (isset($_POST['from']) ? date('Y-m-d', strtotime(str_replace('/', '-', $_POST['from']))) : date('Y-m-d', strtotime('-2 years')));
            $to = (isset($_POST['to']) ? date('Y-m-d', strtotime(str_replace('/', '-', $_POST['to']))) : date('Y-m-d'));
            $min = (isset($_POST['min']) ? $_POST['min'] : 10);
        } else {
            $num = (isset($_GET['num']) ? $_GET['num'] : '');
            $mode = 0;
            $from = (isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime('-2 years')));
            $to = (isset($_GET['to']) ? $_GET['to'] : date('Y-m-d'));
            $min = 10;
        }

        $result = array();
        $max_khoangcach = 0;
        $date_end = date('Y-m-d');

        if (trim($num) != '' && $min > 0) {
            $v = trim($num);

            if ($mode == 0)
                $where = ' AND CONCAT_WS(\',\',b0,b1,b2,b3,b4,b5,b6,b7,b9) LIKE \'%' . $v . ',%\'';
            else
                $where = ' AND b0=' . $v;

            $query = 'SELECT `date`
                    FROM `xs_result`
                    WHERE `lid`=1'
                    . $where
                    . ' AND `date`>=' . Quote($from)
                    . ' AND `date`<=' . Quote($to)
                    . ' ORDER BY `date` DESC';

            $data = $this->db->query($query)->result();
//            echo $this->db->last_query();

            if ($data) {
                foreach ($data as $i => $item) {
                    if ($i == 0) {
//                        $date_end = $data[0]->date;

                        $khoangcach = ((strtotime($date_end) - strtotime($item->date)) / 86400) - 1;
                        if ($khoangcach >= $min) {
                            if ($khoangcach > $max_khoangcach)
                                $max_khoangcach = $khoangcach;
                            $result[-1]->khoangcach = $khoangcach;
                            $result[-1]->from_date = date('Y-m-d', strtotime($item->date . ' +1 days'));
                            $result[-1]->to_date = date('Y-m-d', strtotime($date_end . ' -1 days'));
                        }
                    }
                    if (isset($data[$i + 1])) {
                        $khoangcach = ((strtotime($item->date) - strtotime($data[$i + 1]->date)) / 86400) - 1;
                        if ($khoangcach >= $min) {
                            if ($khoangcach > $max_khoangcach)
                                $max_khoangcach = $khoangcach;
                            $result[$i]->khoangcach = $khoangcach;
                            $result[$i]->from_date = date('Y-m-d', strtotime($data[$i + 1]->date . ' +1 days'));
                            $result[$i]->to_date = date('Y-m-d', strtotime($item->date . ' -1 days'));
                        }
                    }
                }
            }
        }

        if ($to > $date_end)
            $to = $date_end;

        $this->data["date_end"] = $date_end;
        $this->data["result"] = $result;
        $this->data["max_khoangcach"] = $max_khoangcach;
        $this->data["num"] = $num;
        $this->data["mode"] = $mode;
        $this->data["from"] = $from;
        $this->data["to"] = $to;
        $this->data["min"] = $min;
        $this->load->view("chat/scan", $this->data);
    }

    public function trend() {
        $ngay = (isset($_GET['day']) ? $_GET['day'] : '');

        $class = '';
        if ($ngay < date('Y-m-d'))
            $class = ' trend_old';

        $trendday = array();
        $nhays = array();
        $tong_nguoichoi = 0;
        $loto_onlinetk = $this->db->select("b.lo,b.nhay")
                        ->from("xs_loto_online AS a")
                        ->join("xs_loto_onlinetk AS b", "a.id=b.lo_id")
                        ->where("a.ngay", $ngay)
                        ->get()->result();
        if ($loto_onlinetk) {
            foreach ($loto_onlinetk as $value) {
                $tong_nguoichoi++;
//                $nhays[$value->lo] = $value->nhay;
                if (isset($trendday[$value->lo]))
                    $trendday[$value->lo] = $trendday[$value->lo] + 1;
                else
                    $trendday[$value->lo] = 1;
            }
            arsort($trendday);
            array_slice($trendday, 0, 20);

            $query = "SELECT CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7) AS arr_loto
                    FROM xs_result
                    WHERE lid=1
                    AND date='" . $ngay . "'
                    "
            ;
            $data = $this->db->query($query)->row();
            if ($data) {
                $arr_loto = explode(',', $data->arr_loto);
                foreach ($trendday as $value => $nguoichoi) {
                    $dem = 0;
                    foreach ($arr_loto as $so) {
                        if ($value == $so) {
                            $dem++;
                        }
                    }
                    $nhays[$value] = $dem;
                }
            }
        }

        $str = '';
        if ($trendday) {
            $dem = 0;
            $fontsize = 27;
            $tmp = 0;
            foreach ($trendday as $so => $nguoichoi) {
                $dem++;
                if($dem>20)
                    break;
                
                if ($dem == 1) {
                    $tmp = $nguoichoi;
                } else {
                    if ($nguoichoi < $tmp && $fontsize > 12) {
                        $fontsize = $fontsize - 3;
                    }
                    $tmp = $nguoichoi;
                }
                
                $nhay = '';
                if (isset($nhays[$so]) && $nhays[$so] > 0)
                    $nhay = '<span>' . $nhays[$so] . '</span>';
                $str .= "<a class='trend_number" . $class . "' href='javascript:;' style='font-family:arial; font-size:" . $fontsize . "px' title='" . $nguoichoi . " người chơi'>" . $so . $nhay . "</a>";
            }
        }

        echo "<div class=contentbox>
                <div class=contentbox_header><div style='color:#b43939;font-size:14px'>Lotto được chơi nhiều ngày " . date('d/m/Y', strtotime($ngay)) . "</div></div>
                    <div class=contentbox_body>
                        <div><div class='trendholder'>" . $str . "</div></div>
                    <div style='clear:both'></div>
                </div>
            </div>";
        die;
    }

    public function chot() {
        $ngay = (isset($_GET['ngay']) ? $_GET['ngay'] : '');

        $date_chot = date('Y-m-d');
        $hour = date('H');
        if ($hour >= 18)
            $date_chot = date('Y-m-d', strtotime('+1 days'));

        if (isset($_GET['del'])) {
            if (!isset($_SESSION['user']['id']) || $hour >= 18) {
                echo '{"error":"1"}';
                die;
            }

            $this->xs_loto_chot_model->delete_by(array('id' => $_GET['del'], 'userid' => $_SESSION['user']['id'], 'ngay <=' => $date_chot));
            echo '{"deleted":"' . $_GET['del'] . '"}';
            die;
        }

        if (isset($_GET['chotsubmit'])) {
            $lo = (isset($_GET['lo']) ? $_GET['lo'] : '');
            $lodau = (isset($_GET['lodau']) ? $_GET['lodau'] : '');
            $lodit = (isset($_GET['lodit']) ? $_GET['lodit'] : '');
            $lobt = (isset($_GET['lobt']) ? $_GET['lobt'] : '');
            $de = (isset($_GET['de']) ? $_GET['de'] : '');
            $dedau = (isset($_GET['dedau']) ? $_GET['dedau'] : '');
            $dedit = (isset($_GET['dedit']) ? $_GET['dedit'] : '');
            $debt = (isset($_GET['debt']) ? $_GET['debt'] : '');

            $arr_out = array(
                'error' => 1,
                'msg' => 'Bạn phải đăng nhập để chốt số',
            );

            if (!isset($_SESSION['user']['id']) || $ngay == '' || $ngay < $date_chot) {
                echo json_encode($arr_out);
                die;
            }

            $arr_out = array(
                'error' => 1,
                'msg' => 'Dữ liệu bạn nhập không chính xác',
            );

            if ($lo != '' || $lodau != '' || $lodit != '' || $lobt != '' || $de != '' || $dedau != '' || $dedit != '' || $debt != '') {
                if (strlen($lobt) != 2)
                    $lobt = '';
                if (strlen($debt) != 2)
                    $debt = '';

                $arr_lo = explode(',', str_replace(' ', '', $lo));
                $arr_lodau = explode(',', str_replace(' ', '', $lodau));
                $arr_lodit = explode(',', str_replace(' ', '', $lodit));
                $arr_de = explode(',', str_replace(' ', '', $de));
                $arr_dedau = explode(',', str_replace(' ', '', $dedau));
                $arr_dedit = explode(',', str_replace(' ', '', $dedit));
                foreach ($arr_lo as $i => $value) {
                    if (strlen($value) != 2)
                        unset($arr_lo[$i]);
                }
                foreach ($arr_de as $i => $value) {
                    if (strlen($value) != 2)
                        unset($arr_de[$i]);
                }
                foreach ($arr_lodau as $i => $value) {
                    if (strlen($value) != 1)
                        unset($arr_lodau[$i]);
                }
                foreach ($arr_lodit as $i => $value) {
                    if (strlen($value) != 1)
                        unset($arr_lodit[$i]);
                }
                foreach ($arr_dedau as $i => $value) {
                    if (strlen($value) != 1)
                        unset($arr_dedau[$i]);
                }
                foreach ($arr_dedit as $i => $value) {
                    if (strlen($value) != 1)
                        unset($arr_dedit[$i]);
                }
                $arr_lo = array_splice(array_unique($arr_lo), 0, 10);
                $arr_lodau = array_splice(array_unique($arr_lodau), 0, 3);
                $arr_lodit = array_splice(array_unique($arr_lodit), 0, 3);
                $arr_de = array_splice(array_unique($arr_de), 0, 20);
                $arr_dedau = array_splice(array_unique($arr_dedau), 0, 6);
                $arr_dedit = array_splice(array_unique($arr_dedit), 0, 6);

                if ($lobt != '' || $debt != '' || $arr_lo || $arr_lodau || $arr_lodit || $arr_de || $arr_dedau || $arr_dedit) {
                    $data = array(
                        'ngay' => $ngay,
                        'userid' => $_SESSION['user']['id'],
                        'lo' => implode(',', $arr_lo),
                        'lodau' => implode(',', $arr_lodau),
                        'lodit' => implode(',', $arr_lodit),
                        'lobt' => $lobt,
                        'de' => implode(',', $arr_de),
                        'dedau' => implode(',', $arr_dedau),
                        'dedit' => implode(',', $arr_dedit),
                        'debt' => $debt,
                    );

                    $arr_out = array(
                        'error' => 0,
                        'msg' => 'Bạn đã chốt số thành công',
                        'data' => array(
                            'lo' => $arr_lo,
                            'lodau' => $arr_lodau,
                            'lodit' => $arr_lodit,
                            'lobt' => $lobt,
                            'de' => $arr_de,
                            'dedau' => $arr_dedau,
                            'dedit' => $arr_dedit,
                            'debt' => $debt,
                            'ct' => time(),
                            'ut' => time(),
                        ),
                    );

                    $xs_loto_chot = $this->xs_loto_chot_model->get_by(array('ngay' => $ngay, 'userid' => $_SESSION['user']['id']));
                    if ($xs_loto_chot) {
                        $arr_out['msg'] = 'Bạn đã cập nhật chốt số thành công';

                        $data['update'] = time();
                        $this->xs_loto_chot_model->update($xs_loto_chot->id, $data);
                    } else {
                        $data['created'] = time();
                        $this->xs_loto_chot_model->insert($data);
                    }
                }
            }

            echo json_encode($arr_out);
            die;
        }

        $arr_all = array();
        $query = "SELECT CONCAT_WS(',',a0,a1,a2,a3,a4,a5,a6,a7) AS arr_all, CONCAT_WS(',',b0,b1,b2,b3,b4,b5,b6,b7) AS arr_loto
                    FROM xs_result
                    WHERE date='" . $ngay . "'
                    AND lid=1"
        ;
        $data = $this->db->query($query)->row();
        if ($data) {
            $arr_all = explode(',', str_replace('-', ',', $data->arr_all));
        }

        $lastid = (isset($_GET['lastid']) ? $_GET['lastid'] : 0);
        $lastupdate = (isset($_GET['lastupdate']) ? $_GET['lastupdate'] : 0);

        if ($lastid > 0 && $lastupdate > 0)
            $this->db->where('(a.id > ' . $lastid . ' OR a.update > ' . $lastupdate . ')');

        $rows = $this->db->select("a.*,b.fullname,b.email
            ,c.tong_lo,c.tong_trunglo,c.tong_lobt,c.trung_lobt
            ,c.tong_de,c.tong_trungde,c.tong_debt,c.trung_debt")
                        ->from("xs_loto_chot AS a")
                        ->join("users AS b", "a.userid=b.id")
                        ->join("xs_loto_chottk AS c", "a.userid=c.userid", 'left')
                        ->where('a.ngay', $ngay)
                        ->order_by('a.created', 'ASC')
                        ->get()->result();

        $arr_out = array();
        if ($rows) {
            foreach ($rows as $item) {
                if (isset($data->arr_loto) && $item->quay == 0) {
                    $arr_loto = array();
                    if ($data->arr_loto != '')
                        $arr_loto = explode(',', $data->arr_loto);

                    $arr_lo = array();
                    $tong_lo = 0;
                    if ($item->lo != '') {
                        $arr_lo = explode(',', $item->lo);
                        $tong_lo = count($arr_lo);
                    }

                    $arr_de = array();
                    $tong_de = 0;
                    if ($item->de != '') {
                        $arr_de = explode(',', $item->de);
                        $tong_de = count($arr_de);
                    }

                    $tong_lobt = 0;
                    $tong_debt = 0;
                    $tong_trunglo = 0;
                    $trung_lobt = 0;
                    $tong_trungde = 0;
                    $trung_debt = 0;

                    if (isset($arr_lo[0])) {
                        if ($item->debt != '') {
                            $tong_debt = 1;
                            if ($arr_lo[0] == $item->debt)
                                $trung_debt = 1;
                        }

                        if ($arr_de) {
                            foreach ($arr_de as $de) {
                                if ($de == $arr_lo[0])
                                    $tong_trungde = 1;
                            }
                        }
                    }

                    foreach ($arr_loto as $so) {
                        if ($item->lobt != '') {
                            $tong_lobt = 1;
                            if ($item->lobt == $so)
                                $trung_lobt++;
                        }
                        if ($arr_lo) {
                            foreach ($arr_lo as $lo) {
                                if ($lo == $so)
                                    $tong_trunglo++;
                            }
                        }
                    }

                    if (isset($item->tong_trunglo)) {
                        $item->tong_lo = $item->tong_lo + $tong_lo;
                        $item->tong_lobt = $item->tong_lobt + $tong_lobt;
                        $item->tong_de = $item->tong_de + $tong_de;
                        $item->tong_debt = $item->tong_debt + $tong_debt;
                        $item->tong_trunglo = $item->tong_trunglo + $tong_trunglo;
                        $item->trung_lobt = $item->trung_lobt + $trung_lobt;
                        $item->tong_trungde = $item->tong_trungde + $tong_trungde;
                        $item->trung_debt = $item->trung_debt + $trung_debt;

                        $data_ = array(
                            'tong_lo' => $item->tong_lo,
                            'tong_lobt' => $item->tong_lobt,
                            'tong_de' => $item->tong_de,
                            'tong_debt' => $item->tong_debt,
                            'tong_trunglo' => $item->tong_trunglo,
                            'trung_lobt' => $item->trung_lobt,
                            'tong_trungde' => $item->tong_trungde,
                            'trung_debt' => $item->trung_debt,
                            'created' => time()
                        );
                        if ($this->xs_loto_chottk_model->update_by(array("userid" => $item->userid), $data_))
                            $this->xs_loto_chot_model->update($item->id, array("quay" => 1));
                    }else {
                        $item->tong_lo = $tong_lo;
                        $item->tong_lobt = $tong_lobt;
                        $item->tong_de = $tong_de;
                        $item->tong_debt = $tong_debt;
                        $item->tong_trunglo = $tong_trunglo;
                        $item->trung_lobt = $trung_lobt;
                        $item->tong_trungde = $tong_trungde;
                        $item->trung_debt = $trung_debt;

                        $data_ = array(
                            'userid' => $item->userid,
                            'tong_lo' => $item->tong_lo,
                            'tong_lobt' => $item->tong_lobt,
                            'tong_de' => $item->tong_de,
                            'tong_debt' => $item->tong_debt,
                            'tong_trunglo' => $item->tong_trunglo,
                            'trung_lobt' => $item->trung_lobt,
                            'tong_trungde' => $item->tong_trungde,
                            'trung_debt' => $item->trung_debt,
                            'created' => time()
                        );
                        if ($this->xs_loto_chottk_model->insert($data_))
                            $this->xs_loto_chot_model->update($item->id, array("quay" => 1));
                    }
                }

                if ($lastupdate < $item->created)
                    $lastupdate = $item->created;
                if ($lastupdate < $item->update)
                    $lastupdate = $item->update;

                $lastid = $item->id;
                $ratio = array();
                $rank = '';
                if (isset($item->tong_trunglo)) {
                    if ($item->tong_lo > 0)
                        $ratio['lo'] = array($item->tong_trunglo, $item->tong_lo);

                    if ($item->tong_lobt > 0)
                        $ratio['lobt'] = array($item->trung_lobt, $item->tong_lobt);

                    if ($item->tong_de > 0)
                        $ratio['de'] = array($item->tong_trungde, $item->tong_de);

                    if ($item->tong_debt > 0)
                        $ratio['debt'] = array($item->trung_debt, $item->tong_debt);

                    if ($item->tong_trunglo > 0 || $item->trung_lobt > 0)
                        $rank = round(($item->tong_trunglo + $item->trung_lobt) / ($item->tong_lo + $item->tong_lobt) * 100, 2);
                }

                $arr_out[] = array(
                    'lo' => $item->lo != '' ? explode(',', $item->lo) : '',
                    'lodau' => $item->lodau != '' ? explode(',', $item->lodau) : '',
                    'lodit' => $item->lodit != '' ? explode(',', $item->lodit) : '',
                    'lobt' => $item->lobt,
                    'de' => $item->de != '' ? explode(',', $item->de) : '',
                    'dedau' => $item->dedau != '' ? explode(',', $item->dedau) : '',
                    'dedit' => $item->dedit != '' ? explode(',', $item->dedit) : '',
                    'debt' => $item->debt,
                    'email' => $item->fullname,
                    'name' => $item->fullname,
                    'uid' => $item->userid,
                    'id' => $item->id,
                    'ct' => $item->created,
                    'ut' => $item->update,
                    'ratio' => $ratio,
                    'rank' => $rank,
                );
            }
        }

        if ($arr_all) {
            echo '{"list":' . json_encode($arr_out) . ',"lastid":"' . $lastid . '","lastupdate":"' . $lastupdate . '","nums":' . json_encode($arr_all) . '}';
        } else {
            echo '{"list":' . json_encode($arr_out) . ',"lastid":"' . $lastid . '","lastupdate":"' . $lastupdate . '"}';
        }
        die;
    }

    public function vote() {
        die;
    }

    public function chatac() {
        $day = (isset($_GET['d']) ? $_GET['d'] : date('d'));
        $month = (isset($_GET['m']) ? $_GET['m'] : date('m'));
        $year = (isset($_GET['y']) ? $_GET['y'] : date('Y'));
        $page = (isset($_GET['p']) ? $_GET['p'] : 0);
        $userids = (isset($_GET['uf']) ? $_GET['uf'] : '');

        if (isset($_GET['delete'])) {
            $ids = explode(',', $_GET['delete']);
            if ($ids && isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1) {
                $this->xs_loto_chat_model->delete_many($ids);
                echo 'ok';
            }
            die;
        }

        $this->db->start_cache();
        $this->db->where("a.date", $year . '-' . $month . '-' . $day);
        if ($userids != '') {
            $arr_user = explode(',', $userids);
            $this->db->where_in("a.userid", $arr_user);
        }
        $this->db->stop_cache();

        $total_rows = $this->db->select("count(id) as cnt")->from("xs_loto_chat AS a")->get()->row()->cnt;
//        echo $this->db->last_query();

        $total_page = 0;
        if ($total_rows > 0) {
            $total_page = floor($total_rows / 40);
            if ($total_rows % 40 != 0)
                $total_page = $total_page + 1;
        }

        if ($page <= 0)
            $page = $total_page;

        $msgs = null;
        if ($page > 0) {
            $limit = 40;
            $offset = ($page - 1) * $limit;

            $this->db->where('a.receiver_id', 0);
            $msgs = $this->db->select("a.*,b.username,b.fullname")
                            ->from("xs_loto_chat AS a")
                            ->join("users AS b", "a.userid=b.id")
                            ->where('b.active', 'yes')
                            ->order_by('a.created', 'ASC')
                            ->limit($limit, $offset)
                            ->get()->result();
//        echo $this->db->last_query();
        }
        $this->db->flush_cache();

        $this->data["total_rows"] = $total_rows;
        $this->data["total_page"] = $total_page;
        $this->data["day"] = $day;
        $this->data["month"] = $month;
        $this->data["year"] = $year;
        $this->data["page"] = $page;
        $this->data["userids"] = $userids;
        $this->data["msgs"] = $msgs;
        $this->load->view("chat/chatac", $this->data);
    }

    public function chatm() {
        $this->load->view("chat/chatm", $this->data);
    }

    public function timesrv() {
        die();
    }

    public function chatlist() {
        $uid = (isset($_GET['uid']) ? $_GET['uid'] : 0);
        $start = (isset($_GET['start']) ? $_GET['start'] : 0);
        $limit = (isset($_GET['limit']) ? $_GET['limit'] : 15);

        if ($uid <= 0)
            die;

        $query = "SELECT DISTINCT userid
                    FROM xs_loto_chat
                    WHERE receiver_id=" . $uid . "
                    ORDER BY id DESC
                    LIMIT " . $start . ',' . $limit
        ;
        $userids = $this->db->query($query)->result();
//        echo $this->db->last_query();
        $arr_out = array();
        if ($userids) {
            foreach ($userids as $remoteid) {
                $msgs = $this->db->select("*")
                                ->from("xs_loto_chat")
                                ->where('(userid=' . $remoteid->userid . ' AND receiver_id=' . $uid . ') OR (userid=' . $uid . ' AND receiver_id=' . $remoteid->userid . ')')
                                ->order_by('id', 'DESC')
                                ->get()->row();
//                echo $this->db->last_query();
                if (!$msgs)
                    continue;

                $out = 0;
                $remoteid = $msgs->userid;
                if ($msgs->userid == $uid) {
                    $out = 1;
                    $remoteid = $msgs->receiver_id;
                }

                $remotename = $this->db->select("fullname")
                                ->from("users")
                                ->where('id', $remoteid)
                                ->get()->row()->fullname;

                $arr_out[] = array(
                    'remoteid' => $remoteid,
                    'remotename' => $remotename,
                    'msgid' => $msgs->id,
                    'msg' => $msgs->sms,
                    'time' => $msgs->created,
                    'out' => $out,
                );
            }
        }

        echo json_encode($arr_out);
        die;
    }

    public function chatsrv() {
        $uid = (isset($_GET['uid']) ? $_GET['uid'] : 0);

        if (isset($_GET['ppinfo'])) {
            $arr_out = array();
            $arr_out['isfriend'] = 0;
            $arr_out['requested'] = 0;
            $arr_out['ignored'] = 0;
            $arr_out['banned'] = 0;
            $arr_out['online'] = 0;
            $arr_out['haschat'] = null;

            $remoteid = (isset($_GET['remoteid']) ? $_GET['remoteid'] : 0);
            if ($uid > 0 && $remoteid > 0) {
                $session = $this->session_model->get_by(array('userid' => $remoteid));
                if ($session) {
                    $arr_out['online'] = 1;
                }
                $user = $this->user_model->get($remoteid);
                if ($user->active != 'yes')
                    $arr_out['banned'] = 1;

                $loto_chat = $this->db->select("id")
                                ->from("xs_loto_chat")
                                ->where('(userid=' . $uid . ' AND receiver_id=' . $remoteid . ') OR (userid=' . $remoteid . ' AND receiver_id=' . $uid . ')')
                                ->order_by('created', 'DESC')
                                ->get()->row();
                if ($loto_chat)
                    $arr_out['haschat'] = $loto_chat->id;
            }

            echo json_encode($arr_out);
            die;
        }
        if (isset($_SESSION['user']['id'])) {
            if (isset($_GET['send'])) {
                $receiver = (isset($_GET['receiver']) ? $_GET['receiver'] : 0);
                $msg = (isset($_GET['msg']) ? $_GET['msg'] : '');
                $data = array(
                    'userid' => $uid,
                    'receiver_id' => $receiver,
                    'date' => date('Y-m-d'),
                    'sms' => $msg,
                    'created' => time(),
                );

                $this->xs_loto_chat_model->insert($data);
                die;
            }
        }

        if (isset($_GET['pparchive'])) {
            $remoteid = (isset($_GET['remoteid']) ? $_GET['remoteid'] : 0);
            $firstid = (isset($_GET['firstid']) ? $_GET['firstid'] : 0);

            if ($uid > 0 && $remoteid > 0) {
                if ($firstid > 0)
                    $this->db->where('a.id <', $firstid);
                $this->db->where('((a.userid=' . $uid . ' AND a.receiver_id=' . $remoteid . ') OR (a.userid=' . $remoteid . ' AND a.receiver_id=' . $uid . '))');
                $msgs = $this->db->select("a.*,b.username,b.fullname")
                                ->from("xs_loto_chat AS a")
                                ->join("users AS b", "a.userid=b.id")
                                ->where('b.active', 'yes')
                                ->order_by('a.created', 'DESC')
                                ->limit(10)
                                ->get()->result();
//                echo $this->db->last_query();

                $arr_out = array();
                if ($msgs) {
                    asort($msgs);
                    foreach ($msgs as $item) {
                        $arr_out[] = array(
                            'id' => $item->id,
                            'sid' => $item->userid,
                            'sname' => $item->fullname,
                            'utype' => '',
                            'content' => $item->sms,
                            'time' => $item->created,
                        );
                    }
                }

                if ($arr_out)
                    echo json_encode($arr_out);
            }
            die;
        }

        if (isset($_GET['lastid'])) {
            if (isset($_GET['firstid'])) {
                $this->db->where('a.id <', $_GET['firstid']);
            } else {
                $this->db->where('a.id >', $_GET['lastid']);
                if (isset($_SESSION['user']['id']))
                    $this->db->where('a.userid <>', $_SESSION['user']['id']);
            }
        }

        if ($uid > 0)
            $this->db->where('(a.receiver_id=0 OR (a.receiver_id=' . $uid . ' AND a.read=0))');
        else
            $this->db->where('a.receiver_id', 0);
        $msgs = $this->db->select("a.*,b.username,b.fullname")
                        ->from("xs_loto_chat AS a")
                        ->join("users AS b", "a.userid=b.id")
                        ->where('b.active', 'yes')
                        ->order_by('a.created', 'DESC')
                        ->limit(30)
                        ->get()->result();
//        echo $this->db->last_query();die;

        $arr_out = array();
        if ($msgs) {
            asort($msgs);
            foreach ($msgs as $item) {
                if ($item->receiver_id > 0) {
                    $this->xs_loto_chat_model->update($item->id, array('read' => 1));
                }
                $arr_out[] = array(
                    'id' => $item->id,
                    'sname' => $item->fullname,
                    'rid' => $item->receiver_id,
                    'content' => $item->sms,
                    'time' => $item->created,
                    'type' => 0,
                    'sid' => $item->userid,
                    'utype' => '',
                );
            }
        }

        if ($arr_out)
            echo '{"msgs":' . json_encode($arr_out) . ',"states":null,"friendrequests":null,"friendconfirms":null}';

        die;
    }

    public function userinfo() {
        $uid = (isset($_GET['uid']) ? $_GET['uid'] : 0);
        $user_out = array();
        if ($uid) {
            $user = $this->db->select("fullname,email,created_date")->from("users")->where("id", $uid)->get()->row();

            if ($user) {
                $bets = 0;
                $wins = 0;
                $ratio = 0;
                $taikhoan = 0;

                $loto_online = $this->db->select("COUNT(b.id) AS bets,SUM(b.nhay) AS wins")
                                ->from("xs_loto_online AS a")
                                ->join("xs_loto_onlinetk AS b", "a.id=b.lo_id")
                                ->where('a.quay', 1)
                                ->where("a.userid", $uid)
                                ->order_by('a.ngay', 'ASC')
                                ->get()->row();
                if ($loto_online) {
                    $bets = $loto_online->bets;
                    if ($loto_online->wins > 0)
                        $wins = $loto_online->wins;
                    $ratio = round($wins / $bets * 100, 2);
                }

                $loto_online = $this->db->select("taikhoan")
                                ->from("xs_loto_online")
                                ->where('quay', 1)
                                ->where("userid", $uid)
                                ->order_by('ngay', 'DESC')
                                ->get()->row();

                if ($loto_online)
                    $taikhoan = $loto_online->taikhoan;

                $query = "SELECT CONCAT_WS(',',a.b0,a.b1,a.b2,a.b3,a.b4,a.b5,a.b6,a.b7) AS arr_loto,b.id AS lo_id,b.taikhoan
                    FROM xs_result as a
                    LEFT JOIN xs_loto_online AS b ON a.date=b.ngay
                    WHERE a.lid=1
                    AND b.quay=0
                    AND b.userid=" . $uid . "
                    ORDER BY b.ngay ASC"
                ;
                $data = $this->db->query($query)->row();

                if ($data) {
                    $arr_loto = explode(',', $data->arr_loto);

                    $loto_onlinetk = $this->db->select("*")
                                    ->from("xs_loto_onlinetk")
                                    ->where('lo_id', $data->lo_id)
                                    ->get()->result();
                    if ($loto_onlinetk) {
                        $chi = 0;
                        $thu = 0;
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
                        $taikhoan = $taikhoan + ($thu - $chi);
                        $this->xs_loto_online_model->update($data->lo_id, array('taikhoan' => $taikhoan, 'quay' => 1));
                    }
                }

                $user_out = array(
                    'email' => $user->fullname,
                    'createdate' => date('d/m/Y', strtotime($user->created_date)),
                    'bets' => $bets,
                    'wins' => $wins,
                    'ratio' => $ratio . '%',
                    'balance' => $taikhoan,
                );
            }
        }
        echo json_encode($user_out);
        die;
    }

    public function friend() {
        die;
    }

    public function chatstateupdate() {
        die;
    }

    public function ajaxsearch() {
        $q = (isset($_GET['q']) ? $_GET['q'] : '');
        $arr_out = array();
        if ($q != '') {
            $rows = $this->db->select("id,fullname,email")->from("users")
                    ->like('fullname', $q)
//                    ->or_like('email', $q)
                    ->order_by("created_date", "DESC")
                    ->get()
                    ->result();
//            echo $this->db->last_query();

            if ($rows) {
                foreach ($rows as $item) {
                    $arr_out[] = array(
                        'uid' => $item->id,
                        'name' => $item->fullname,
                        'email' => ''//$item->email,
                    );
                }
            }
        }

        echo json_encode($arr_out);
        die;
    }

    public function onlinestatdata() {
        $this->db->distinct();
        $rows = $this->db->select("b.id,b.fullname")->from("sessions AS a")
                ->join('users AS b', 'a.userid=b.id')
                ->order_by("b.created_date", "DESC")
                ->get()
                ->result();

        $newuser = $this->db->select("id AS uid,fullname AS name")->from("users")
                ->order_by("created_date", "DESC")
                ->get()
                ->row();

        $arr_out = array();
        $total = 0;
        if ($rows) {
            $total = count($rows);
            foreach ($rows as $item) {
                $arr_out[] = array(
                    'uid' => $item->id,
                    'name' => $item->fullname,
                    'banned' => 0,
                );
            }
        }

        echo '{"total":' . $total . ',"onlines":' . json_encode($arr_out) . ',"newuser":' . json_encode($newuser) . ',"guest":"0"}';
        die;
    }

}
