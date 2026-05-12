<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    var $data = array();

    function __construct() {
        parent::__construct();
        redirect('client/home');
    }

    function index() {
        die('Admin Default');
    }

}
