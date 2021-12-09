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

class UserKidsAge extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
        //$this->load->model('Common');
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
        $_POST = json_decode(file_get_contents("php://input"), true);

        if ((!is_null($postDataArr)) && sizeof($postDataArr) > 0) {
            $response = $this->UserKidsAge($postDataArr);
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

    public function UserKidsAge($postDataArr) {
        error_reporting(0);

         /*$auth = $this->checkheader();
           print_r($auth); die; */   
       
       $postDataArr = json_decode(file_get_contents("php://input"), true);

         //$user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email']]);
    
                    if($postDataArr){                          
                           
                            foreach ($postDataArr as $key => $value) {
                                /*print_r($value);
                                die;*/

                                $kidsId = $this->Common_model->insert_single('userKid',$value);
                            }

                            //$kidsId = $this->Common_model->insert_single('userKid',$postDataArr);
                            
                            $kidsIdList = $this->Common_model->fetch_data('userKid','*', array('kidId' =>  $kidsId), true);   

                         
               	foreach ($postDataArr as $key => $value) {

					 $kidsDetail[] = array(
                        //"userId" => $value['userId'],
                        "kidName" => $value['kidName'],
						"kidAge" => $value['kidAge'],
                        /*"status" => $value['status'],
                        "createdat" => $value['createdat']*/
                    );
                }     


                        $errorMsgArr = array();
                        $errorMsgArr['code'] = '200';
                        $errorMsgArr['status'] = 'success';
                        $errorMsgArr['message'] = 'Kids Added Successfuly';
                        $errorMsgArr['data'] = $kidsDetail;
                        $this->response($errorMsgArr);
                }else {

               $errorMsgArr = array();
                $errorMsgArr['code'] = '401';
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'Kids not Added';
                $errorMsgArr['data'] = [];
                $this->response($errorMsgArr);
            }
   }

}

