<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class thongke extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('xs_result_model', 'xs_northern_model'));
    }

    public function index($alias = '', $date = '') {
        $area = '';
        $lid = 0;
		
		if($alias == 'mien-bac'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ miền bắc hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số miền bắc hôm nay, thống kê xổ số miền bắc cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số miền bắc hôm nay, thong ke xo so mien bac hom nay, thống kê kết quả xổ số miền bắc hôm nay, thong ke ket qua xo so mien bac hom nay, thống kê xổ số miền bắc, thong ke xo so 3 mien";
		}elseif($alias == 'mien-trung'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ miền trung hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số miền trung hôm nay, thống kê xổ số miền trung cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số miền trung hôm nay, thong ke xo so mien trung hom nay, thống kê kết quả xổ số miền trung hôm nay, thong ke ket qua xo so mien trung hom nay, thống kê xổ số miền trung, thong ke xo so 3 mien";
		}elseif($alias == 'xo-so-gia-lai'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ Gia Lai hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số Gia Lai hôm nay, thống kê xổ số Gia Lai cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số Gia Lai hôm nay, thong ke xo so gia lai hom nay, thống kê kết quả xổ số gia lai hôm nay, thong ke ket qua xo so gia lai hom nay, thống kê xổ số gia lai, thong ke xo so 3 mien";
		}elseif($alias == 'xo-so-ninh-thuan'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ Ninh Thuận hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số Ninh Thuận hôm nay, thống kê xổ số Ninh Thuận cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số Ninh Thuận hôm nay, thong ke xo so ninh thuan hom nay, thống kê kết quả xổ số Ninh Thuận hôm nay, thong ke ket qua xo so ninh thuan hom nay, thống kê xổ số ninh thuận, thong ke xo so 3 mien";
		}elseif($alias == 'xo-so-binh-duong'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ Bình Dương hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số Bình Dương hôm nay, thống kê xổ số Bình Dương cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số Bình Dương hôm nay, thong ke xo so binh duong hom nay, thống kê kết quả xổ số Bình Dương hôm nay, thong ke ket qua xo so binh duong hom nay, thống kê xổ số bình duong, thong ke xo so 3 mien";
		}elseif($alias == 'xo-so-vinh-long'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ Vĩnh Long hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số Vĩnh Long hôm nay, thống kê xổ số Vĩnh Long cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số Vĩnh Long hôm nay, thong ke xo so vinh long hom nay, thống kê kết quả xổ số Vĩnh Long hôm nay, thong ke ket qua xo so vinh long hom nay, thống kê xổ số vĩnh long, thong ke xo so 3 mien";
		}elseif($alias == 'xo-so-tra-vinh'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ Trà Vinh hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số Trà Vinh hôm nay, thống kê xổ số Trà Vinh cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số Trà Vinh hôm nay, thong ke xo so tra vinh hom nay, thống kê kết quả xổ số Trà Vinh hôm nay, thong ke ket qua xo so tra vinh hom nay, thống kê xổ số tra vinh, thong ke xo so 3 mien";
		}elseif($alias == 'mien-nam'){
			$this->data['_meta']['title'] = "Thống kê xổ xổ miền nam hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số miền nam hôm nay, thống kê xổ số miền nam cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số miền nam hôm nay, thong ke xo so mien nam hom nay, thống kê kết quả xổ số miền nam hôm nay, thong ke ket qua xo so mien nam hom nay, thống kê xổ số miền nam, thong ke xo so 3 mien";
		}else{
			$this->data['_meta']['title'] = "Thống kê xổ xổ hôm nay";
			$this->data['_meta']['description'] = "Thống kê xổ số hôm nay, thống kê xổ số 3 miền cập nhật nhanh nhất, liên tục và chính xác nhất trên xoso.com";
			$this->data['_meta']['keywords'] = "thống kế xổ số hôm nay, thong ke xo so hom nay, thống kê kết quả xổ số hôm nay, thong ke ket qua xo so hom nay, thống kê xổ số 3 miền, thong ke xo so 3 mien";
		}
		
		
        if ($alias == 'mien-bac' || $alias == $this->data['url_mienbac']) {
            $alias = $this->data['url_mienbac'];
            $area = 'MB';
            $lid = 1;
        } elseif ($alias == 'mien-trung' || $alias == $this->data['url_mientrung']) {
            $alias = $this->data['url_mientrung'];
            $area = 'MT';
        } elseif ($alias == 'mien-nam' || $alias == $this->data['url_miennam']) {
            $alias = $this->data['url_miennam'];
            $area = 'MN';
        }

        if ($date == '')
            $date = date('d-m-Y');

        $description = '';
        if ($alias != $this->data['url_mientrung'] && $alias != $this->data['url_miennam']) {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->alias == $alias) {
                    $lid = $value->id;
                    $area = $value->area;
                    $description = $value->thongke;
                    break;
                }
            }
        }

        if ($lid == 0)
            $this->data['items_30'] = $this->xs_northern_model->getitemsImportant($alias, 30, $date, $type = 1);
        else
            $this->data['items_30'] = $this->xs_northern_model->getitemsImportant($lid, 30, $date);

        $this->data['xs_lotonuoi'] = $this->db->select("title,title_link")->from("xs_lotonuoi")
                ->order_by("order", "ASC")
                ->order_by("id", "DESC")
                ->get()
                ->result();
        $this->data['xs_kinhnghiem'] = $this->db->select("title,title_link")->from("xs_kinhnghiem")
                ->order_by("order", "ASC")
                ->order_by("id", "DESC")
                ->get()
                ->result();
		
        $this->data['description'] = $description;
        $this->data['area'] = $area;
        $this->data['date'] = $date;
        $this->data['alias'] = $alias;
        $this->data['layout_col_left'] = 'layout/col_left_thongke';
        $this->data['tmpl'] = 'thongke/index';
        $this->load->view('layout/thongke', $this->data);
    }

    public function vip($date = '') {
        if ($date == '')
            $date = date('d-m-Y');

        $this->db->where('date', date('Y-m-d', strtotime($date)));
        $this->db->where('status', 1);
        $rows = $this->db->select("*")->from("xs_statistics_vip")->get()->result();

        $this->data['vip'] = array();
        if ($rows) {
            foreach ($rows as $value) {
                $this->data['vip'][$value->lid] = $value;
            }
        }

        $this->data['xs_lotonuoi'] = $this->db->select("title,title_link")->from("xs_lotonuoi")
                ->order_by("order", "ASC")
                ->order_by("id", "DESC")
                ->get()
                ->result();
        $this->data['xs_kinhnghiem'] = $this->db->select("title,title_link")->from("xs_kinhnghiem")
                ->order_by("order", "ASC")
                ->order_by("id", "DESC")
                ->get()
                ->result();

        $this->data['date'] = $date;
        $this->data['layout_col_left'] = 'layout/col_left_thongke';
        $this->data['tmpl'] = 'thongke/vip';
        $this->load->view('layout/thongke', $this->data);
    }

    public function site($alias = 'xo-so-mien-bac', $date = '') {
        if ($date == '')
            $date = date('d-m-Y');

        $lid = 1;
        if ($alias != 'xo-so-mien-bac') {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->alias == $alias) {
                    $lid = $value->id;
                    break;
                }
            }
        }

        $this->data['xs_vip'] = $this->db->select("*")->from("xs_statistics_site")
                ->where("lid", $lid)
                ->where("active", "yes")
                ->where('date', date('Y-m-d', strtotime($date)))
                ->get()
                ->row();

        $this->data['xs_lotonuoi'] = $this->db->select("title,title_link")->from("xs_lotonuoi")
                ->order_by("order", "ASC")
                ->order_by("id", "DESC")
                ->get()
                ->result();
        $this->data['xs_kinhnghiem'] = $this->db->select("title,title_link")->from("xs_kinhnghiem")
                ->order_by("order", "ASC")
                ->order_by("id", "DESC")
                ->get()
                ->result();

        $this->data['date'] = $date;
        $this->data['alias'] = $alias;
        $this->data['layout_col_left'] = 'layout/col_left_thongke';
        $this->data['tmpl'] = 'thongke/site';
        $this->load->view('layout/thongke', $this->data);
    }

    public function tansuat() {
        $this->data['end_date'] = (isset($_POST['end_date']) ? $_POST['end_date'] : date('d-m-Y'));
        $this->data['txtNumber'] = (isset($_POST['txtNumber']) ? trim($_POST['txtNumber']) : 99);
        if ($this->data['txtNumber'] > 999) {
            $this->data['txtNumber'] = 99;
        }
        $this->data['lid'] = (isset($_POST['slcTinh']) ? trim($_POST['slcTinh']) : 1);
        $this->data['typeView'] = (isset($_POST['typeView']) ? trim($_POST['typeView']) : 'doc');
        $this->data['check'] = (isset($_POST['check']) ? $_POST['check'] : '');

        // Build query
        $query = 'SELECT date,CONCAT_WS(\', \',b0,b1,b2,b3,b4,b5,b6,b7,b8) AS data
                    FROM xs_result
                    WHERE lid=' . Quote($this->data['lid'])
                . ' AND date<=' . Quote(date('Y-m-d', strtotime($this->data['end_date'])))
                . ' ORDER BY date DESC LIMIT ' . $this->data['txtNumber'];

        $list = $this->db->query($query)->result();
        
        $result = array();
        $count = array();
        $db = array();
        foreach ($list as $item) {
            // ngày mở thưởng
            $date = $item->date;
            // cắt ký tự - ở cuối dòng
            $tmp = rtrim($item->data, ',');
            // tách riêng các số
            $arr = explode(',', $tmp);
            // duyệt qua danh sách các số
            foreach ($arr as $giai => $v) {
                if (trim($v) == '') {
                    continue;
                }
                $v = intval($v);
                // kiểm tra xem đã có trong mảng kết quả
                if (isset($result[$date][$v])) {
                    // thiết đặt dữ liệu cho cặp số ở ngày mở thưởng
                    $result[$date][$v] = $result[$date][$v] + 1;
                    if ($giai == 0)
                        $db[$date][$v] = 1;
                } else {
                    $result[$date][$v] = 1;
                    if ($giai == 0)
                        $db[$date][$v] = 1;
                }

                if (isset($count[$v])) {
                    $count[$v] = $count[$v] + 1;
                } else {
                    $count[$v] = 1;
                }
            }
        }

        $this->data['items'] = $result;
        $this->data['count'] = $count;
        $this->data['db'] = $db;
        $this->load->view('thongke/tansuat', $this->data);
    }

}