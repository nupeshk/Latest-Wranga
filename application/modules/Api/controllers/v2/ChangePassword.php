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

class ChangePassword extends Base_Controller {

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
            $response = $this->change($postDataArr);
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

       public function change($postDataArr) {
        error_reporting(0);

/*
        print_r($postDataArr);
        die;*/

         $user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email']]);
    
                    if($user){                          
                           
                           $postDataArrrr['password']=$postDataArr['password'];     
                           $postDataArrrr['isDefault']=0;     
                        $this->Common_model->update_single('users',$postDataArrrr,['email'=>$postDataArr['email']]);

                        $errorMsgArr = array();
                        $errorMsgArr['code'] = '200';
                        $errorMsgArr['status'] = 'success';
                        $errorMsgArr['message'] = 'Your Password has been changed';
                        $errorMsgArr['data'] = "";
                        $this->response($errorMsgArr);
                }else {

               $errorMsgArr = array();
                $errorMsgArr['code'] = '401';
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'the Email credentials are invalid';
                $errorMsgArr['data'] = "";
                $this->response($errorMsgArr);
            }
   }




}

