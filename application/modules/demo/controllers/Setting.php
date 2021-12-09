<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/Admin/controllers/Base_Controller.php';

// Including Phil Sturgeon's Rest Server Library in our Server file.

class Setting extends Base_Controller {
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

    public function index() {
		$data = array();
        $data['adminData'] = $this->check_session();
        $postDataArr = $this->input->post();
        if (!empty($postDataArr)) {
            $update = array(
                "pointPerLiter" => $postDataArr['pointPerLiter'],
                "valuePerPoint" => $postDataArr['valuePerPoint'],
                "updatedDate" => getTodayDate()
            );

            $where = array("where" => array("settingId" => "1"));
            $success = $this->Common_model->update_single("setting", $update, $where);
            if ($success) {
				$this->session->set_flashdata('success', UPDATE_SUCCESS);
                redirect('/admin/setting', 'refresh');
            } else {
                $this->session->set_flashdata('error', UPDATE_FAILED);
            }
        }
        $where = array("where" => array("settingId" => "1"));
        $settingData = $this->Common_model->fetch_data("setting", array(), $where, true);
            
        //printArr($settingData); die;
        $data["title"] = "Cebeo Setting";
        $data["settingData"] = $settingData;
        $data['main_content'] = 'setting/index';
        $this->load->view('layout/layout', $data);
    }

}
