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

class Like extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
    }


    /**
     * Index function
     *
     * @access  public
     */

    public function index_get() {
        echo "<h1 style='margin-top:5%; text-align: center'>" . SITE_TITLE . "</h1>";
    }


    public function index_post() {
 			
 		if ($this->form_validation->run("api/v1/like") == true) {
	        $postDataArr = $this->post();
        
        /*$user = $this->Common_model->fetch_data('wrng_comment','*', array('contentId' => $postDataArr['contentId']), true);
            if($user){*/
                $insert = array();
				        $insert['created_at'] = getTodayDate();    
				        $insert["contentId"] = $postDataArr['contentId'];
				        $insert["commentedUserId"] = $postDataArr['userId'];
				        $insert["commentRating"] = $postDataArr['commentRating'];
                $insert["comment"] = $postDataArr['comment'];
				        $insert["type"] = $postDataArr['type'];
                $success = $this->Common_model->insert_single("wrng_comment", $insert);

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = SUCCESS_CODE;
                    $errorMsgArr['status'] = STATUS_SUCCESS;
                    $errorMsgArr['message'] = 'Comment Updated successfull';
                    $errorMsgArr['data'] =$success;
                    echo json_encode($errorMsgArr);
       	 //}
        } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['data'] =(object) array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }

    }




}

