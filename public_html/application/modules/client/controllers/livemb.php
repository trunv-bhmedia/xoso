<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require 'client' . EXT;

class livemb extends Client
{
	function __construct() {
        parent::__construct();
    }

    public function index($alias)
    {
    	die('111');
    }
}