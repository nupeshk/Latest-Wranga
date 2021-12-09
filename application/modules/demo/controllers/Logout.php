<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/Admin/controllers/Base_Controller.php';

// Including Phil Sturgeon's Rest Server Library in our Server file.

class Logout extends Base_Controller {
    /*
     * __construct function.
     * 
     * @access public
     * @return void
     */

    public function __construct() {
        parent::__construct();
        //Load all libraries, configs, models, langs and such here!
    }
    
    //Function for admin logout
    public function index() {
		$adminData = $this->check_session();
        //Set flash data logout success
        $this->session->set_flashdata('logout_success', 'You are successfully Logout'); //set message 
        if (isset($this->session->userdata['adminLogin'])) {
            //Unset admin session data
            $this->session->unset_userdata('adminLogin', $this->session->userdata['adminLogin']);
        }
        //Redirect!
        redirect('/admin');
    }
  
}
