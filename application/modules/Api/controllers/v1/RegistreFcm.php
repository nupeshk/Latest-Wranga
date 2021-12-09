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

class RegistreFcm extends Base_Controller {

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
            $response = $this->fcm($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] ='401';
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }


    //Function for User Login
    //POST DATA - email,password
    // 1 facebook , 1 gmail, 0 Email

    public function fcm($postDataArr) {

        if($postDataArr['deviceId'] && $postDataArr['deviceId'] && $postDataArr['fcmToken']){
                    $data = array(
                    "deviceId" => $postDataArr['deviceId'],
                    "userId" => $postDataArr['userId'],
                    "fcmToken" => $postDataArr['fcmToken']
                );

                $checkDeviceId = $this->Common_model->fetch_data('wrng_fcm','*', array('deviceId' => $postDataArr['deviceId']), true);    
                if($checkDeviceId){
                    $fcmId = $this->Common_model->updateAll('wrng_fcm',$data,array('deviceId' => $postDataArr['deviceId']));
                }else{
                     $fcmId = $this->Common_model->insert_single('wrng_fcm',$data);
                }
               
                 

                 if($fcmId){
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                   // $errorMsgArr['message'] = INVALID_POST_DATA;
                    $this->response($errorMsgArr);
                 }else{
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 401;
                    $errorMsgArr['status'] = 'fcm not inserted';
                   // $errorMsgArr['message'] = INVALID_POST_DATA;
                    $this->response($errorMsgArr);
                 }            
        }else{
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 401;
                    $errorMsgArr['status'] = 'Please fill out all  field.';
                   // $errorMsgArr['message'] = INVALID_POST_DATA;
                    $this->response($errorMsgArr);
                 }




   }
}

