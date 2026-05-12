<?php

//ketquaveso.com
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class xs_kinhnghiem extends Client {

    function __construct() {
        parent::__construct();
        $this->load->model('xs_kinhnghiem_model');
    }

    function detail($title_link = '') {
        $row_news = $this->xs_kinhnghiem_model->get_by(array('title_link' => $title_link, 'active' => 'yes'));

        if ($row_news) {
            $data = array('view' => $row_news->view + 1);
            $this->xs_kinhnghiem_model->update($row_news->id, $data);

            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);
            $this->data['row_news'] = $row_news;

            $this->data['related_news'] = $this->xs_kinhnghiem_model->order_by('created_date', 'DESC')->limit(10)->get_many_by(array('active' => 'yes', 'id <>' => $row_news->id));

            $this->data['_meta'] = $this->meta_model->show_title('home');
            $this->data['_meta']['title'] = $row_news->title;

            if ($row_news->meta_description != '')
                $this->data['_meta']['description'] = $row_news->meta_description;
            else
                $this->data['_meta']['description'] = trim(short_text(view_title(strip_tags($row_news->content)), 170));

            if ($row_news->meta_keywords != '')
                $this->data['_meta']['keywords'] = $row_news->meta_keywords;

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
        $this->data['tmpl'] = 'xs_kinhnghiem/detail';
        $this->load->view('layout/content', $this->data);
    }

}