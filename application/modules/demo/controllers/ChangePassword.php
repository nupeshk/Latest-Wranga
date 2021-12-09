<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/Admin/controllers/Base_Controller.php';

// Including Phil Sturgeon's Rest Server Library in our Server file.

class ChangePassword extends Base_Controller {
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
    public function index(){
		 //First thing to do!!!
        $data['adminData'] = $this->check_session();
        $postDataArr = $this->input->post();
        //Check validation is TRUE or FALSE		
        if ($this->form_validation->run('admin/dashboard/changepass') == TRUE) {
            //Get session user Id (adminID)
            $adminId = $data['adminData']['adminId'];
            //Call fetch_data function of Common Model get values
            //Check if function return some value or not 
            $where = array("where" =>array('adminId' => $adminId, 'adminPassword' => md5($postDataArr['old_password']), 'adminType' => 'admin'));
			$coloumn = array('adminId', 'adminName', 'adminEmail');
			//Call get_data function of Common_model to fetch data from the database
			//Function will return adminID and adminName
			$adminData = $this->Common_model->fetch_data("admin", $coloumn,$where, true);
			if (!empty($adminData)) {
				$update = array();
                $update['adminPassword'] = md5($postDataArr['new_password']);
                $where = array("where" =>array('adminId' => $adminId));
				$success = $this->Common_model->update_single("admin", $update, $where);
                //Check if function return some value or not)
                //Set success message in flash data
                if ($success) {
                    $this->session->set_flashdata(STATUS_SUCCESS, CHANGED_PASSWORD);
                    redirect('/admin/changepassword', 'refresh');
                    //redirect('/admin/dashboard/logout', 'refresh');  
                } else {
                    $this->session->set_flashdata(STATUS_ERROR, UPDATE_FAILED);
                }
            } else {
                $this->session->set_flashdata(STATUS_ERROR, WRONG_PASSWORD);
            }
        }

        $data["title"] = "Change Password";
        $data['main_content'] = 'change_password/index';
        $this->load->view('layout/layout', $data);
	}
}
