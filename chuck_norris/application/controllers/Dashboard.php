<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data = array();

    }

    public function index()
    {
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/dashboard/all");
        $this->load->view("admin/footer");
    }

}
