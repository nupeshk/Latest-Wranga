<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/demo/controllers/Base_Controller.php';
/* * ***********************
 * PAGE: USE TO MANAGE ADMIN LOGIN CONTROLLER.
 * #COPYRIGHT: IPA
 * @AUTHOR: SHABNAM <shabnam@greychaindesign.com>.
 * CREATED: 07/11/2017.
 * UPDATED: --/--/----.
 * Codeigniter   
 * *** */

class Register extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('Common_model');

    }

    /*
     * Use to open default page 
     * 
     */

    //Function for Authenticate ADMIN
    //POST DATA - admin_email,admin_password
    public function index() {

        //Use to chek Admin is login or not
        if($_POST){
                $columnArr = $this->input->post();


                  
                unset($columnArr['terms']);               
                unset($columnArr['submit']);



                $row = $this->Common_model->insert_single('cms_admin', $columnArr);
                
                $msg=array("MSG"=>'<div class="isa_success">Profile Updated Successfully</div>');
                $this->session->set_userdata($msg);
        }   
        
        $this->load->view('register');
    }

}
