<?php

//ketquaveso.com
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class xs_dudoan extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model('xs_dudoan_model');
        $this->load->library('pagination');
    }

    public function home() {
        $date = date('d-m-Y');
        $this->data['date'] = $date;

        $date = date('Y-m-d', strtotime($date));
        $this->db->where('date', $date);
        $this->db->where('active', 'yes');
        $rows = $this->db->select("title,title_link,lid")->from("xs_dudoan")->get()->result();

        $this->data['dudoan'] = array();
        if ($rows) {
            foreach ($rows as $value) {
                $this->data['dudoan'][$value->lid] = $value;
            }
        }

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array('', '');
        $this->data['_meta'] = $this->meta_model->show_title('dudoan', $search, $replace);
		
        $this->data['tmpl'] = 'xs_dudoan/home';
        $this->load->view('layout/content', $this->data);
    }

    public function index($category_alias = '', $page = 1) {
//        $page = (isset($_GET['p']) ? $_GET['p'] : 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $url = base_url() . 'du-doan-xo-so.html';
        $url_alias = base_url() . 'du-doan-xo-so';

        $this->db->start_cache();
        if ($category_alias != '') {
            if ($category_alias == 'xo-so-mien-bac')
                $this->db->where("n.lid", 1);
            elseif ($category_alias == 'xo-so-mien-trung')
                $this->db->where("l.area", 'MT');
            elseif ($category_alias == 'xo-so-mien-nam')
                $this->db->where("l.area", 'MN');
            else
                $this->db->where("l.alias", $category_alias);
            $url = base_url() . 'du-doan-' . $category_alias . '.html';
            $url_alias = base_url() . 'du-doan-' . $category_alias;
        }
        $this->db->where("n.active", "yes");
        $this->db->stop_cache();

        $rows = $this->db->select("n.*,l.name AS cname,l.area,l.lid_list")->from("xs_dudoan AS n")
                ->join('xs_location AS l', 'n.lid = l.id', 'left')
                ->order_by("n.order", "ASC")
                ->order_by("n.id", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();

        if (!$rows)
            redirect(base_url() . 'du-doan-xo-so.html');

        $total_rows = $this->db->select("count(n.id) as cnt")->from("xs_dudoan AS n")
                        ->join('xs_location AS l', 'n.lid = l.id', 'left')
                        ->get()->row()->cnt;
        $this->db->flush_cache();
//            echo $this->db->last_query();

        $this->data['news'] = $rows;

        $conf = array(
            'cur_page' => $page,
            'base_url' => $url,
            'total_rows' => $total_rows,
            'per_page' => $limit,
            'cur_class' => 'currentpage',
            'prev_class' => 'prevnext',
            'next_class' => 'prevnext',
            'first_link' => 'Trang đầu',
            'last_link' => 'Trang cuối',
            'next_link' => '&gt;&gt;',
            'prev_link' => '&lt;&lt;',
            'show_total' => 'no',
            'show_first_last' => 'yes'
        );

        $this->pagination->initialize($conf);
        $this->data['pagnav'] = $this->pagination->display_ul_li_router($url_alias);

        if ($category_alias == 'xo-so-mien-bac')
            $rows[0]->cname = 'Miền Bắc';
        elseif ($category_alias == 'xo-so-mien-trung')
            $rows[0]->cname = 'Miền Trung';
        elseif ($category_alias == 'xo-so-mien-nam')
            $rows[0]->cname = 'Miền Nam';

        $this->data['lid_list'] = array();
        if ($category_alias != 'xo-so-mien-trung' && $category_alias != 'xo-so-mien-nam') {
            $arr_lid = explode(',', $rows[0]->lid_list);
            $lid_list = array();

            foreach ($arr_lid as $value) {
                if ($value > 0) {
                    $lid_list[] = $this->db->select("n.id")->from("xs_dudoan AS n")
                                    ->join('xs_location AS l', 'n.lid = l.id', 'left')
                                    ->where('n.lid', $value)
                                    ->order_by("n.date", "DESC")
                                    ->get()
                                    ->row()->id;
                }
            }
            if ($lid_list) {
                $this->data['lid_list'] = $this->db->select("n.*,l.name AS cname,l.area")->from("xs_dudoan AS n")
                        ->join('xs_location AS l', 'n.lid = l.id', 'left')
                        ->where_in('n.id', $lid_list)
                        ->order_by("n.date", "DESC")
                        ->get()
                        ->result();
            }
        }

        $search = array('[TITLE]', '[TITLE_NONE]');
        $replace = array(' ' . $rows[0]->cname, ' ' . strtolower(RemoveSign($rows[0]->cname)));
        $this->data['_meta'] = $this->meta_model->show_title('dudoan', $search, $replace);
		
        if($page == 1){
			$next = $page + 1;
			$this->data['_meta']['page'] = "<link rel='next' href='".$url_alias."-trang-".$next.".html'>";
		}elseif($page >= 2){
			$prev = $page - 1;
			$next = $page + 1;
			$this->data['_meta']['page'] = '<link rel="prev" href="'.$url_alias.'-trang-'.$prev.'.html">
											<link rel="next" href="'.$url_alias.'-trang-'.$next.'.html">';
		}		
		
        $this->data['category_alias'] = $category_alias;
        $this->data['tmpl'] = 'xs_dudoan/index';
        $this->load->view('layout/content', $this->data);
    }

    function detail($category_alias = '', $title_link = '') {
        $row_news = $this->xs_dudoan_model->get_by(array('title_link' => $title_link, 'active' => 'yes'));

        if ($row_news) {
            $data = array('view' => $row_news->view + 1);
            $this->xs_dudoan_model->update($row_news->id, $data);

            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);
            $this->data['row_news'] = $row_news;

            $this->load->model('xs_location_model');
            $category = $this->xs_location_model->get($row_news->lid);
            $this->data['related_news'] = $this->xs_dudoan_model->order_by('created_date', 'DESC')->limit($this->config->item('page_limit_5'))->get_many_by(array('lid' => $row_news->lid, 'active' => 'yes', 'created_date <=' => $row_news->created_date, 'id <>' => $row_news->id));
            $this->data['new_news'] = $this->xs_dudoan_model->order_by('created_date', 'DESC')->limit($this->config->item('page_limit_5'))->get_many_by(array('lid' => $row_news->lid, 'active' => 'yes', 'id <>' => $row_news->id));

            $search = array('[TITLE]', '[CONTENT]', '[KEYWORD]');

            $description = '';
            $keywords = '';

            if ($row_news->meta_description != '')
                $description = $row_news->meta_description;
            else
                $description = trim(short_text(view_title(strip_tags($row_news->content)), 170));

            if ($row_news->meta_keywords != '') {
                $keywords = $row_news->meta_keywords;
            } else {
                $cname = strtolower(RemoveSign($category->name));
                $keywords = 'du doan ket qua xo so ' . $cname . ', du doan ket qua xo so ' . str_replace('-', ' ', $category_alias) . ', du doan xo so ' . $cname . ' hom nay';
            }

            $replace = array($row_news->title, $description, $keywords);
            $this->data['_meta'] = $this->meta_model->show_title('news_detail', $search, $replace);
			if(!preg_match('/(ngay|ngày)/ism', $this->data['_meta']['title'], $matchs)){
				$this->data['_meta']['title'] .= " ngày ".date('d-m-Y', strtotime($row_news->date));
			} 

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

            $replacement = '<a target="_blank" title="Xo So - kết quả xổ số trực tiếp ba miền bắc, trung, nam" href="' . $this->data['uri_root'] . '">$1</a>';
            $row_news->short_desc = preg_replace('/(xổ số)/i', $replacement, $row_news->short_desc);
            $row_news->content = preg_replace('/(xổ số)/i', $replacement, $row_news->content);

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
        $this->data['tmpl'] = 'xs_dudoan/detail';
        $this->load->view('layout/content', $this->data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */