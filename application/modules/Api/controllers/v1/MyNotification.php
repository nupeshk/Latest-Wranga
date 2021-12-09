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

class MyNotification extends Base_Controller {

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
        $postDataArr = $this->post();
        if ((!is_null($postDataArr)) && sizeof($postDataArr) > 0) {
            $response = $this->getNotification($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = '401';
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }



    public function getNotification($postDataArr) {
        error_reporting(0);
        $postDataArr = $this->post();
        $page=$postDataArr['page'];
                   $myList = $this->Common_model->fetch_data('wrng_notification','*', array('userId' => $postDataArr['userId']), true);  
                
                foreach ($myList as $key => $myListValue) {
                    $contentDataDetail[] = array(
                        "id"=> $myListValue->id,
                        "title"=> $myListValue->title,
                        "massage" => $myListValue->massage,
                        "image" => BASEURL.'/assets/notificationImage/'.$myListValue->image,
                        "created_at" => $myListValue->created_at
                        );
                }
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'myNotification';
                    $errorMsgArr['data'] = $contentDataDetail;
                    $errorMsgArr['totalSize'] = count($myList);
                    $this->response($errorMsgArr);                    
   }

   public function addToNotification_post() {
        //if ($this->form_validation->run("api/v1/comment") == true) {
            $postDataArr = $this->post();
        
        /*$user = $this->Common_model->fetch_data('wrng_comment','*', array('contentId' => $postDataArr['contentId']), true);
            if($user){*/
                $insert = array();
                $insert["contentId"] = $postDataArr['contentId'];
                $insert["userId"] = $postDataArr['userId'];
                $success = $this->Common_model->insert_single("wrng_notification", $insert);
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = SUCCESS_CODE;
                    $errorMsgArr['status'] = STATUS_SUCCESS;
                    $errorMsgArr['message'] = 'Added successfull';
                    $errorMsgArr['data'] =$success;
                    echo json_encode($errorMsgArr);
         //}
        /*} else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['data'] =(object) array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }*/
   }



   public function MyNotificationDelete_post() {
        //if ($this->form_validation->run("api/v1/comment") == true) {
            $postDataArr = $this->post();
        /*$user = $this->Common_model->fetch_data('wrng_comment','*', array('contentId' => $postDataArr['contentId']), true);
            if($user){*/

                $success = $this->Common_model->delete("wrng_notification",$postDataArr['id']);
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = SUCCESS_CODE;
                    $errorMsgArr['status'] = STATUS_SUCCESS;
                    $errorMsgArr['message'] = 'Deleted Form Notification';
                    $errorMsgArr['data'] =$success;
                    echo json_encode($errorMsgArr);
         //}
        /*} else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['data'] =(object) array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }*/
   }




}

