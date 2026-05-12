<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class tags extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array('news_model'));
        $this->load->library('pagination');
    }

    public function index($tags) {
        $page = (isset($_GET['p']) ? $_GET['p'] : 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $url = base_url() . 'tags/' . $tags;

        $tags = urldecode($tags);

//        $this->db->start_cache();
        $this->db->where("n.active", "yes");
        $where = implode(" ", $this->db->ar_where);
        $this->db->_reset_select();

        $this->db->like("n.title", $tags);
        $this->db->or_like("n.short_desc", $tags);
        $this->db->or_like("n.content", $tags);
        $like = implode(" ", $this->db->ar_like);
        $this->db->_reset_select();
//        $this->db->stop_cache();

        $rows = $this->db->select("n.*")->from("c_news AS n")
                ->where($where . ' AND (' . $like . ' )')
                ->order_by("n.order", "ASC")
                ->order_by("n.id", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();
//        echo $this->db->last_query();
        if (!$rows)
            redirect($this->data['uri_root'] . '404_override');

        $total_rows = $this->db->select("count(n.id) as cnt")->from("c_news AS n")
                        ->where($where . ' AND (' . $like . ')')
                        ->get()->row()->cnt;
//        $this->db->flush_cache();
//        echo $this->db->last_query();

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
        $this->data['pagnav'] = $this->pagination->display_ul_li_query_string();

        $search = array('[TITLE]');
        $replace = array($tags);
        $this->data['_meta'] = $this->meta_model->show_title('tags', $search, $replace);

        $this->data['tags'] = $tags;
        $this->data['tmpl'] = 'news/tags';
        $this->load->view('layout/content', $this->data);
    }

}