<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class vietlott extends Client {

    function __construct() {
        parent::__construct();
        //$this->load->model(array('vietlott_model', 'help_model'));
        $this->load->library('pagination');
    }

    function so_lan_xuat_hien($mang_so) {

        $chuoi = "";
        $array = array();
        foreach ($mang_so as $key => $value) {
            $array[$value][] = $key;
        }
        return $array;
    }

    public function mega6($page = 1) {
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $url = base_url() . 'vietlott/mega6.html';
        $url_alias = base_url() . 'vietlott/mega6';

        $timewhere = time() - (86400 * 30);

        $data_mega = $this->db->select('*')
                ->from('vietlott_data')
                ->where('type', 1)
                ->where('date >=', date('Y-m-d', $timewhere))
                ->order_by('dateint', 'DESC')
                ->get()
                ->result();


        $cbvXosoLast = $data_mega[0];
        $this->data['vietlottmega1'] = $cbvXosoLast;
        $this->data['vietlottmega5'] = $data_mega;
        $this->data['vietlottmega6gt'] = file_get_contents('../feed/mega6gt.html');


        $arrayNumber = array();
        for ($i = 0; $i < count($data_mega); $i++) {
            $data_mega_content_item = json_decode($data_mega[$i]->content);
            for ($j = 0; $j < 6; $j++) {
                $arrayNumber[] = $data_mega_content_item->content->db[$j];
            }
        }

        $grouped = array_count_values($arrayNumber);
        $array_fullxh = $grouped;
        ksort($array_fullxh);
        arsort($grouped);
        //var_dump($array_fullxh);die;
        $solanxuathien = $this->so_lan_xuat_hien($grouped);

        $this->data['solanxuathien'] = $solanxuathien;
        $this->data['fullsolanxuathien'] = $array_fullxh;



        $total_rows = $this->db->select("count(n.id) as cnt")
                        ->from("vietlott_data AS n")
                        ->where('type', 1)
                        ->get()
                        ->row()
                ->cnt;

        $conf = array(
            'cur_page' => $page,
            'base_url' => $url,
            'total_rows' => $total_rows,
            'per_page' => $limit,
            'cur_class' => 'currentpage',
            'prev_class' => 'prevnext',
            'next_class' => 'prevnext',
            'first_link' => '&lt;&lt;',
            'last_link' => '&gt;&gt;',
            'next_link' => '&gt;',
            'prev_link' => '&lt;',
            'show_total' => 'no',
            'show_first_last' => 'yes'
        );
        $dateLast = date("d/m/Y", strtotime($cbvXosoLast->date));
        $dateLast2 = date("d/m", strtotime($cbvXosoLast->date));
        $dateLastThu = date("l", strtotime($cbvXosoLast->date));
        switch ($dateLastThu) {
            case "Monday": $dateLastThu = "2";
                break; // Chữ này là Thứ 2 do chuyển thành mã Unicode nên nó không show lên được.
            case "Tuesday": $dateLastThu = "3";
                break;
            case "Wednesday": $dateLastThu = "4";
                break;
            case "Thursday": $dateLastThu = "5";
                break;
            case "Friday": $dateLastThu = "6";
                break;
            case "Saturday": $dateLastThu = "7";
                break;
            case "Sunday": $dateLastThu = "chủ nhật";
                break;
            default: $dateLastThu = "Ngày";
                break;
        }
        if (strpos($link_uri, '/vietlott/mega6.html') == true) {
            $this->data['_meta']['title'] = "Kết Quả Xổ Số Vietlott Mega 6/45 - XOSO.COM - Vietlott ngày " . $dateLast;
            $this->data['_meta']['description'] = "Kết quả Xổ số Vietlott ngày " . $dateLast . ", Xem Xổ số Mega 6/45 Thứ " . $dateLastThu . " hôm nay, XS Mega " . $dateLast2 . " trực tiếp tại công ty Xổ số tự chọn điện toán Vietlott.";
            $this->data['_meta']['keywords'] = "kết quả xổ số, kết quả vietlott, xổ số vietlott, xổ số điện toán, xổ số, vietlott, xổ số hôm nay, vietlott hôm nay, vietlott moi, vietlott kiểu Mỹ";
        } else {
            $this->data['_meta']['title'] = "Kết Quả Xổ Số Vietlott Mega 6/45 - XOSO.COM - Vietlott ngày " . $dateLast;
            $this->data['_meta']['description'] = "Kết quả Xổ số Vietlott ngày " . $dateLast . ", Xem Xổ số Mega 6/45 Thứ " . $dateLastThu . " hôm nay, XS Mega " . $dateLast2 . " trực tiếp tại công ty Xổ số tự chọn điện toán Vietlott.";
            $this->data['_meta']['keywords'] = "kết quả xổ số, kết quả vietlott, xổ số vietlott, xổ số điện toán, xổ số, vietlott, xổ số hôm nay, vietlott hôm nay, vietlott moi, vietlott kiểu Mỹ";
        }
        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->display_ul_li_router($url_alias);

        $this->data['tmpl'] = 'vietlott/mega6';
        $this->load->view('layout/content', $this->data);
    }
    
    public function power6($page = 1) {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $url = base_url() . 'vietlott/power6.html';
        $url_alias = base_url() . 'vietlott/power6';
        $timewhere = time() - (86400 * 30);
        //echo date('Y-m-d', $timewhere);die;
        $data_mega = $this->db->select('*')
                ->from('vietlott_data')
                ->where('type', 3)
                ->where('date >=', date('Y-m-d', $timewhere))
                ->order_by('dateint', 'DESC')
                ->get()
                ->result();
        $cbvXosoLast = $data_mega[0];
        $this->data['vietlottpower1'] = $cbvXosoLast;
        $this->data['vietlottmega5'] = $data_mega;
        $this->data['vietlottpower6gt'] = file_get_contents('../feed/power6gt.html');
        $arrayNumber = array();
        $countItem=count($data_mega);
//        var_dump($data_mega);die;
        for ($i = 0; $i < $countItem; $i++) {
            $data_mega_content_item = json_decode($data_mega[$i]->content);
            //var_dump($data_mega_content_item); echo '<hr>';
            for ($j = 0; $j <= 6; $j++) {
                $arrayNumber[] = $data_mega_content_item->content->db[$j];
            }
        }
        //die;
        //var_dump($arrayNumber); die;
        $grouped = array_count_values($arrayNumber);

        $array_fullxh = $grouped;
        ksort($array_fullxh);
        arsort($grouped);
        //var_dump($array_fullxh);die;
        $solanxuathien = $this->so_lan_xuat_hien($grouped);

        //var_dump($solanxuathien); die;
        $this->data['solanxuathien'] = $solanxuathien;
        $this->data['fullsolanxuathien'] = $array_fullxh;
        $total_rows = $this->db->select("count(n.id) as cnt")
                        ->from("vietlott_data AS n")
                        ->where('type', 1)
                        ->get()
                        ->row()
                ->cnt;

        $conf = array(
            'cur_page' => $page,
            'base_url' => $url,
            'total_rows' => $total_rows,
            'per_page' => $limit,
            'cur_class' => 'currentpage',
            'prev_class' => 'prevnext',
            'next_class' => 'prevnext',
            'first_link' => '&lt;&lt;',
            'last_link' => '&gt;&gt;',
            'next_link' => '&gt;',
            'prev_link' => '&lt;',
            'show_total' => 'no',
            'show_first_last' => 'yes'
        );
        $dateLast = date("d/m/Y", strtotime($cbvXosoLast->date));
        $dateLast2 = date("d/m", strtotime($cbvXosoLast->date));
        $dateLastThu = date("l", strtotime($cbvXosoLast->date));
        switch ($dateLastThu) {
            case "Monday": $dateLastThu = "2";
                break; // Chữ này là Thứ 2 do chuyển thành mã Unicode nên nó không show lên được.
            case "Tuesday": $dateLastThu = "3";
                break;
            case "Wednesday": $dateLastThu = "4";
                break;
            case "Thursday": $dateLastThu = "5";
                break;
            case "Friday": $dateLastThu = "6";
                break;
            case "Saturday": $dateLastThu = "7";
                break;
            case "Sunday": $dateLastThu = "chủ nhật";
                break;
            default: $dateLastThu = "Ngày";
                break;
        }
        if (strpos($link_uri, '/vietlott/mega6.html') == true) {
            $this->data['_meta']['title'] = "Kết Quả Xổ Số Vietlott Power 6/55 - XOSO.COM - Vietlott ngày " . $dateLast;
            $this->data['_meta']['description'] = "Kết quả Xổ số Vietlott ngày " . $dateLast . ", Xem Xổ số Power 6/55 Thứ " . $dateLastThu . " hôm nay, XS Mega " . $dateLast2 . " trực tiếp tại công ty Xổ số tự chọn điện toán Vietlott.";
            $this->data['_meta']['keywords'] = "power 6, xo so power 6, kết quả xổ số, kết quả vietlott, xổ số vietlott, xổ số điện toán, xổ số, vietlott, xổ số hôm nay, vietlott hôm nay, vietlott moi, vietlott kiểu Mỹ";
        } else {
            $this->data['_meta']['title'] = "Kết Quả Xổ Số Vietlott Power 6/55 - XOSO.COM - Vietlott ngày " . $dateLast;
            $this->data['_meta']['description'] = "Kết quả Xổ số Vietlott ngày " . $dateLast . ", Xem Xổ số Power 6/55 Thứ " . $dateLastThu . " hôm nay, XS Mega " . $dateLast2 . " trực tiếp tại công ty Xổ số tự chọn điện toán Vietlott.";
            $this->data['_meta']['keywords'] = "power 6, xo so power 6, kết quả xổ số, kết quả vietlott, xổ số vietlott, xổ số điện toán, xổ số, vietlott, xổ số hôm nay, vietlott hôm nay, vietlott moi, vietlott kiểu Mỹ";
        }
        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->display_ul_li_router($url_alias);
        $this->data['tmpl'] = 'vietlott/power6';
        $this->load->view('layout/content', $this->data);
    }

    public function max4d($page = 1) {
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $url = base_url() . 'vietlott/max4d.html';
        $url_alias = base_url() . 'vietlott/max4d';

        $data_max4d = $this->db->select('*')
                ->from('vietlott_data')
                ->where('type', 2)
                ->order_by('dateint', 'DESC')
                ->limit($limit, $offset)
                ->get()
                ->result();
        $this->data['vietlottmax4d'] = $data_max4d;

        $total_rows = $this->db->select("count(n.id) as cnt")
                        ->from("vietlott_data AS n")
                        ->where('type', 2)
                        ->get()
                        ->row()
                ->cnt;

        $conf = array(
            'cur_page' => $page,
            'base_url' => $url,
            'total_rows' => $total_rows,
            'per_page' => $limit,
            'cur_class' => 'currentpage',
            'prev_class' => 'prevnext',
            'next_class' => 'prevnext',
            'first_link' => '&lt;&lt;',
            'last_link' => '&gt;&gt;',
            'next_link' => '&gt;',
            'prev_link' => '&lt;',
            'show_total' => 'no',
            'show_first_last' => 'yes'
        );
        if (strpos($link_uri, '/vietlott/mega6.html') == true) {
            $this->data['_meta']['title'] = "Kết quả xổ số điện toán Max 4D Vietlott &quot;Hôm Nay&quot; XO SO MAX 4D";
            $this->data['_meta']['description'] = "Xo so Max 4D, Trực tiếp kết quả Xổ số Max 4D Vietlott hôm nay, XS Max4D vào thứ 3, thứ 5 và thứ 7 hàng tuần tại công ty xổ số điện toán Vietlott.";
            $this->data['_meta']['keywords'] = "Kết quả,xổ số,Max 4d,Max4d,vietlott,ket qua,xo so,hôm nay";
        } else {
            $this->data['_meta']['title'] = "Kết quả xổ số điện toán Max 4D Vietlott &quot;Hôm Nay&quot; XO SO MAX 4D";
            $this->data['_meta']['description'] = "Xo so Max 4D, Trực tiếp kết quả Xổ số Max 4D Vietlott hôm nay, XS Max4D vào thứ 3, thứ 5 và thứ 7 hàng tuần tại công ty xổ số điện toán Vietlott.";
            $this->data['_meta']['keywords'] = "Kết quả,xổ số,Max 4d,Max4d,vietlott,ket qua,xo so,hôm nay";
        }
        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->display_ul_li_router($url_alias);

        $this->data['tmpl'] = 'vietlott/max4d';
        $this->load->view('layout/content', $this->data);
    }

    function detail($category_alias = '', $title_link = '') {
        $xs_redirectlinks = $this->xs_redirectlinks_model->get_by(array('md5_link' => md5($title_link . '.html'), 'published' => 1));
        if ($xs_redirectlinks) {
            redirect($this->data['uri_root'] . 'tin-xo-so/' . $xs_redirectlinks->rlink);
        }
        $row_news = $this->news_model->get_by(array('title_link' => $title_link, 'active' => 'yes'));

        if ($row_news) {
            $data = array('view' => $row_news->view + 1);
            $this->news_model->update($row_news->id, $data);

            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);
            $this->data['row_news'] = $row_news;

            $category = null;
            if ($category_alias != '') {
                $this->load->model('news_category_model');
                $category = $this->news_category_model->get($row_news->catid);
                $this->data['related_news'] = $this->news_model->order_by('created_date', 'DESC')->limit($this->config->item('page_limit_5'))->get_many_by(array('catid' => $category->id, 'active' => 'yes', 'created_date <=' => $row_news->created_date, 'id <>' => $row_news->id));
                $this->data['new_news'] = $this->news_model->order_by('created_date', 'DESC')->limit($this->config->item('page_limit_5'))->get_many_by(array('catid' => $category->id, 'active' => 'yes', 'id <>' => $row_news->id));
            } else {
                $this->data['related_news'] = $this->news_model->order_by('created_date', 'DESC')->limit($this->config->item('page_limit_5'))->get_many_by(array('active' => 'yes', 'created_date <=' => $row_news->created_date, 'id <>' => $row_news->id));
                $this->data['new_news'] = $this->news_model->order_by('created_date', 'DESC')->limit($this->config->item('page_limit_5'))->get_many_by(array('active' => 'yes', 'id <>' => $row_news->id));
            }

            $search = array('[TITLE]', '[CONTENT]', '[KEYWORD]');

            $description = '';
            $keywords = '';

            if ($row_news->meta_description != '')
                $description = $row_news->meta_description;
            else
                $description = trim(short_text(view_title(strip_tags($row_news->content)), 170));

            if ($row_news->meta_keywords != '')
                $keywords = $row_news->meta_keywords;
            else
                $keywords = 'tin xo so, thong tin so xo, tin xa hoi, tin tuc, tin kinh te';

            $replace = array($row_news->title, $description, $keywords);
            $this->data['_meta'] = $this->meta_model->show_title('news_detail', $search, $replace);

            $pattern = '/(<a .*?<\/a>)/i';
            //ma hoa link
            if (preg_match_all($pattern, $row_news->short_desc, $tmp)) {
                foreach ($tmp[0] as $value) {
                    $row_news->short_desc = str_replace($value, '[BEGIN_BHM_BASECODE]' . base64_encode($value) . '[END_BHM_BASECODE]', $row_news->short_desc);
                }
            }
            if (preg_match_all($pattern, $row_news->content, $tmp)) {
                foreach ($tmp[0] as $value) {
                    $row_news->content = str_replace($value, '[BEGIN_BHM_BASECODE]' . base64_encode($value) . '[END_BHM_BASECODE]', $row_news->content);
                }
            }

            $replacement = '<a target="_blank" title="Xo So - k?t qu? x? s? tr?c ti?p ba mi?n b?c, trung, nam" href="' . $this->data['uri_root'] . '">$1</a>';
            $row_news->short_desc = preg_replace('/(x? s?)/i', $replacement, $row_news->short_desc);
            $row_news->content = preg_replace('/(x? s?)/i', $replacement, $row_news->content);

            //giai ma link
            if (preg_match_all('/\[BEGIN_BHM_BASECODE\](.*?)\[END_BHM_BASECODE\]/i', $row_news->short_desc, $tmp)) {
                foreach ($tmp[1] as $value) {
                    $row_news->short_desc = str_replace('[BEGIN_BHM_BASECODE]' . $value . '[END_BHM_BASECODE]', base64_decode($value), $row_news->short_desc);
                }
            }
            if (preg_match_all('/\[BEGIN_BHM_BASECODE\](.*?)\[END_BHM_BASECODE\]/i', $row_news->content, $tmp)) {
                foreach ($tmp[1] as $value) {
                    $row_news->content = str_replace('[BEGIN_BHM_BASECODE]' . $value . '[END_BHM_BASECODE]', base64_decode($value), $row_news->content);
                }
            }
        } else {
            redirect($this->data['uri_root'] . '404_override');
        }
        $this->data['category'] = $category;
        $this->data['tmpl'] = 'news/detail';
        $this->load->view('layout/content', $this->data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */