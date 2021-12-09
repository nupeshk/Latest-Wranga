<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        //$this->load->model('Common_model');
        //$this->load->model('Common');
        $data=array();
    }
	
	public function index()
	{
		//echo "ho"; die;
		//$this->load->view('template/header');
		$this->load->view('login');
		//$this->load->view('template/footer');
		//$this->load->view('index');
	}
}