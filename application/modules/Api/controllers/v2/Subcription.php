<?php
//require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'modules/Api/controllers/v1/Base_Controller.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Api
 *
 * @author Mohd. Shahid
 */

class Subcription extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
    }


    /**
     * Index function
     *
     * @access	public
     */

    public function index_get() {
        echo "<h1 style='margin-top:5%; text-align: center'>" . SITE_TITLE . "</h1>";
    }


    public function index_post() {
        $postDataArr = $this->post();
        if ((!is_null($postDataArr)) && sizeof($postDataArr) > 0) {
            $response = $this->Subcription($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = '401';
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }


	//Function for User Login
	//POST DATA - email,password

    public function Subcription($postDataArr) {
        error_reporting(0);

            /*if ($this->form_validation->run("api/signup") == true) {   */



				if ($postDataArr) {
                    $subcriptionId = $this->Common_model->insert_single('subcription',$postDataArr);
                    $kidsIdList = $this->Common_model->fetch_data('subcription','*', array('subcriptionId' =>  $subcriptionId), true);   
                    
                
                     $subcriptionDetail = array(
                        "email" => $kidsIdList[0]->email,
                        "createdat" => $kidsIdList[0]->createdat
                    );



                    $errorMsgArr = array();
                    $errorMsgArr['code'] = '200';
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'subcription register';
                    $errorMsgArr['data'] = $subcriptionDetail;
                    $this->response($errorMsgArr);                    
                }else {

               $errorMsgArr = array();
                $errorMsgArr['code'] = '401';
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'subcription not register';
                $errorMsgArr['data'] = [];
                $this->response($errorMsgArr);
            }
       /* } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = '401';
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }*/
   }
}

