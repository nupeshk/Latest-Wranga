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

class Details extends Base_Controller {

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
            $response = $this->login($postDataArr);
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

    public function login($postDataArr) {
        error_reporting(0);

            /*if ($this->form_validation->run("api/signup") == true) {   */

         $user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email'],'password'=>$postDataArr['password']]);

                   
                   if($postDataArr['longitude'] && $postDataArr['latitude']){
                   		$postDataArrr['longitude']=$postDataArr['longitude'];
                   		$postDataArrr['latitude']=$postDataArr['latitude'];
                        $this->Common_model->update_single('users',$postDataArrr,['userId'=> $user[0]->userId]);
                    }


				if ($user) {
                	$token = generateToken();
                    $token_data = array();
                    $token_data['token'] = $token;
                    $token_data['userId'] = (string) $user[0]->userId;
                    $token_data['deviceId'] = $postDataArr['deviceId'];
                    $token_data['deviceType'] = $postDataArr['deviceType'];

                    $this->Authtoken_model->insert($token_data);
                    $user = $this->Common_model->fetch_data('users','*', array('userId' => $user[0]->userId), true);  


                    if($user[0]->email==NULL){ $user[0]->email=""; }
                    if($user[0]->name==NULL){  $name=$user[0]->name=""; }
                    if($user[0]->socialid==NULL){ $user[0]->socialid=""; }
                    if($user[0]->longitude==NULL){ $user[0]->longitude=""; }
                    if($user[0]->latitude==NULL){ $user[0]->latitude=""; }
                    if($user[0]->deviceId==NULL){ $user[0]->deviceId=""; }
                 

                    $userDetail = array(
                        "token"=> $token,
                        "email" => $user[0]->email,
                        "name" => $user[0]->name,
                        "userId" => (string) $user[0]->userId,
						"socialid" => $user[0]->socialid,
                        "longitude" => $user[0]->longitude,
                        "latitude" => $user[0]->latitude,
                        "deviceId" => $user[0]->deviceId,
                           // "createdDate" => $postDataArr['createdDate'],
                        );

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = '200';
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Login Successfully';
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);                    
                }else {

               $errorMsgArr = array();
                $errorMsgArr['code'] = '401';
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'the login credentials are invalid';
                $errorMsgArr['data'] = "";
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

