<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class xs_dreams extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model(array("xs_dreams_model", "xs_dreams_categories_model"));
        $this->load->library('pagination');
    }

    function index($page = 1) {
//        $page = (isset($_GET['p']) ? $_GET['p'] : 1);
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $this->db->start_cache();
        if (isset($_GET["title"]) && $_GET["title"] != "") {
            $this->db->like("title", $_GET["title"]);
        }
        $this->db->stop_cache();

        $rows = $this->db->select("id,title,catid,order,str_number,published")->from("xs_dreams")
                ->order_by("order", "DESC")
                ->order_by("id", "DESC")
                ->limit($limit, $offset)
                ->get()
                ->result();
//        echo $this->db->last_query();
        $total_rows = $this->db->select("count(id) as cnt")->from("xs_dreams")->get()->row()->cnt;
        $this->db->flush_cache();

        foreach ($rows as $k => $row) {
            $cat = $this->xs_dreams_categories_model->get($row->catid);
            if ($cat) {
                $rows[$k]->cat_name = $cat->title;
            }
        }

        $url = base_url() . 'giai-dap-giac-mo.html';
        $url_alias = base_url() . 'giai-dap-giac-mo';

        $conf = array(
            'cur_page' => $page,
            'base_url' => $url . (isset($_GET["title"]) ? "?title=" . $_GET["title"] : ""),
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

        $this->data['rows'] = $rows;
        $this->data["count"] = $total_rows;
        $this->data['offset'] = $offset;

        $this->data['_meta'] = $this->meta_model->show_title('giac_mo');
        $this->data['_meta']['title'] = isset($_GET["title"]) ? $this->data['_meta']['title'] . ' - ' . $_GET["title"] : $this->data['_meta']['title'];
        $this->data['_meta']['description'] = isset($_GET["title"]) ? $this->data['_meta']['description'] . ' ' . $_GET["title"] : $this->data['_meta']['description'];

        $this->data["tmpl"] = "xs_dreams/index";
        $this->load->view("layout/content", $this->data);
    }

}