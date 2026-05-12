<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class Html extends Client {

    function __construct() {
        parent::__construct();
//        $this->load->library(array('form_validation', 'message'));
    }

    function index() {
        $this->data['_meta'] = $this->meta_model->show_title('lich_mo_thuong');
        $this->data["tmpl"] = "html/index";
        $this->load->view("layout/content", $this->data);
    }

    function vip() {
        $this->data['_meta']['title'] = 'Đăng ký thành viên VIP';
        $this->data["tmpl"] = "html/vip";
        $this->load->view("layout/content", $this->data);
    }

    function gioithieu() {
        $this->load->model(array("gioithieu_model"));
        $row_news = $this->gioithieu_model->get(1);

        if ($row_news) {
            $row_news->title = trim($row_news->title);
            $row_news->content = trim($row_news->content);
            $this->data['row_news'] = $row_news;
        } else {
            redirect(base_url());
        }

        $this->data['_meta'] = $this->meta_model->show_title('gioithieu');
        $this->data["tmpl"] = "html/gioithieu";
        $this->load->view("layout/content", $this->data);
    }

    function contact() {
        die;
        $this->load->model(array("contact_model"));
        $submit = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullname = $this->input->post("fullname");
            $email = $this->input->post("email");
            $mobile = $this->input->post("mobile");
            $address = $this->input->post("address");
            $content = $this->input->post("content");

            $submit["fullname"] = $fullname;
            $submit["email"] = $email;
            $submit["mobile"] = $mobile;
            $submit["address"] = $address;
            $submit["content"] = str_replace("\r\n", "", $content);

            $this->form_validation->set_rules('fullname', 'Họ tên', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('content', 'Nội dung', 'required|xss_clean|min_length[20]');
            $this->form_validation->set_rules('captcha', 'Mã xác nhận', 'required|xss_clean|callback__check_captcha');

            if ($this->form_validation->run()) {
                $data = array(
                    "fullname" => $fullname,
                    "email" => $email,
                    "mobile" => $mobile,
                    "address" => $address,
                    "content" => $content,
                    "time" => date("Y-m-d H:i:s")
                );

                if ($this->contact_model->insert($data)) {
                    $this->message->add('suc', "Cảm ơn bạn! Bạn đã gửi thông tin liên hệ thành công!");
                    $submit["fullname"] = '';
                    $submit["email"] = '';
                    $submit["mobile"] = '';
                    $submit["address"] = '';
                    $submit["content"] = '';
                } else {
                    $this->message->add('error', "Có lỗi trong quá trình xử lý.");
                }
            } else {
                $this->message->add('error', validation_errors());
            }
        }

        $this->data['_meta'] = $this->meta_model->show_title('contact');
        $this->data["submit"] = $submit;
        $this->data["tmpl"] = "html/contact";
        $this->load->view("layout/content", $this->data);
    }

    function _check_captcha($code) {
        $code = strtoupper($code);
        if ($_SESSION['captcha'] != $code) {
            $this->form_validation->set_message('_check_captcha', 'Mã xác nhận không đúng.');
            return false;
        }
        return true;
    }

}