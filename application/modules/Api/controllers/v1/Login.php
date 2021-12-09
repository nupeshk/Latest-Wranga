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

class Login extends Base_Controller {

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
            $response = $this->login($postDataArr);
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

    public function login($postDataArr) {
        error_reporting(0);
        $usersocialid =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email']]);         
      

        if($postDataArr['socialid']==1 || $postDataArr['socialid']==2){
                    if ($this->form_validation->run("api/v1/login2") == true) {


                 $user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email']]);   
                   
                   if($postDataArr['longitude'] && $postDataArr['latitude']){
                        $postDataArrr['longitude']=$postDataArr['longitude'];
                        $postDataArrr['latitude']=$postDataArr['latitude'];
                        $this->Common_model->update_single('users',$postDataArrr,['userId'=> $user[0]->userId]);
                    }

           if ($user) {
                if($usersocialid[0]->socialid==$postDataArr['socialid']){    
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

                    if($user[0]->userPhoto){
                        $userPic='http://wranga.in/assets/userPhoto/'.$user[0]->userPhoto;
                    }else{
                         $userPic="";
                    }

                    $userDetail = array(
                       // "token"=> $token,
                        "email" => $user[0]->email,
                        "name" => $user[0]->name,
                        "userId" => (string) $user[0]->userId,
                        "userPhoto" => $userPic,
                        "phone" => $user[0]->phone,
                        "paymentPlan" =>  paymentPlanTitle($user[0]->paymentPlan),
                        "paymentStatus" => (int) $user[0]->paymentStatus,
                        "socialid" => $user[0]->socialid,
                        "gender" => $user[0]->gender,
                        "longitude" => $user[0]->longitude,
                        "latitude" => $user[0]->latitude,
                        "isDefault" => $user[0]->isDefault,
                        "deviceId" => $user[0]->deviceId,
                           // "createdDate" => $postDataArr['createdDate'],
                        );

                          $kidsIdList = $this->Common_model->fetch_data('userKid','*', array('userId' => $user[0]->userId), true);   
                
                        if($kidsIdList){    

                              foreach ($kidsIdList as $key => $kidsValue) {
                                    $userDetail['kidsData'][$key]['kidName']=$kidsValue->kidName;
                                    $userDetail['kidsData'][$key]['kidAge']=$kidsValue->kidAge;
                                }  
                        }else{
                             $userDetail['kidsData']= [];
                        }        

                    $userDetail['features']= $this->Common_model-> selectData('wrng_features', $fld = '*'); 
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Login Successfully,,,';
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);    

                }else{
                        $errorMsgArr = array();
                        $errorMsgArr['code'] = 401;
                        $errorMsgArr['status'] = 'error';
                        if($usersocialid[0]->socialid==1){
                            $errorMsgArr['message'] = 'Please login with Faebook.';    
                        }elseif($usersocialid[0]->socialid==2){
                            $errorMsgArr['message'] = 'Please login with Gmail.';
                        }elseif($usersocialid[0]->socialid==0){
                            $errorMsgArr['message'] = 'Please login with Email..';
                        }
                        

                        $errorMsgArr['data'] =(object) array();
                        $this->response($errorMsgArr);    
                } 




                }else {

               $errorMsgArr = array();
                $errorMsgArr['code'] = 401;
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'The login credentials are invalid.';
                $errorMsgArr['data'] =(object) array();
                $this->response($errorMsgArr);
            }
                    } else {
                        $error = $this->form_validation->error_array();
                        $errorMsgArr = array();
                        $errorMsgArr['code'] = 401;
                        $errorMsgArr['status'] = 'error';
                        $errorMsgArr['message'] = PARAM_MISSING;
                        $errorMsgArr['error'] = $error;
                        $this->response($errorMsgArr);
                    }


    }else{









    if ($this->form_validation->run("api/v1/login") == true) {

         $user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email'],'password'=>$postDataArr['password']]);

                   
                   if($postDataArr['longitude'] && $postDataArr['latitude']){
                        $postDataArrr['longitude']=$postDataArr['longitude'];
                        $postDataArrr['latitude']=$postDataArr['latitude'];
                        $this->Common_model->update_single('users',$postDataArrr,['userId'=> $user[0]->userId]);
                    }


                if ($user) {
                 if($usersocialid[0]->socialid==$postDataArr['socialid']){
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

                    if($user[0]->userPhoto){
                        $userPic='http://wranga.in/assets/userPhoto/'.$user[0]->userPhoto;
                    }else{
                         $userPic="";
                    }

                    $userDetail = array(
                       // "token"=> $token,
                        "email" => $user[0]->email,
                        "name" => $user[0]->name,
                        "userId" => (string) $user[0]->userId,
                        "userPhoto" => $userPic,
                        "phone" => $user[0]->phone,
                        "paymentPlan" =>  paymentPlanTitle($user[0]->paymentPlan),
                        "paymentStatus" => (int) $user[0]->paymentStatus,
                        "socialid" => $user[0]->socialid,
                        "gender" => $user[0]->gender,
                        "longitude" => $user[0]->longitude,
                        "latitude" => $user[0]->latitude,
                        "isDefault" => $user[0]->isDefault,
                        "deviceId" => $user[0]->deviceId,
                           // "createdDate" => $postDataArr['createdDate'],
                        );

                     $kidsIdList = $this->Common_model->fetch_data('userKid','*', array('userId' => $user[0]->userId), true);   
                    
                    if($kidsIdList){    

                          foreach ($kidsIdList as $key => $kidsValue) {
                                $userDetail['kidsData'][$key]['kidName']=$kidsValue->kidName;
                                $userDetail['kidsData'][$key]['kidAge']=$kidsValue->kidAge;
                            }  
                    }else{
                         $userDetail['kidsData']= [];
                    }        
                    $userDetail['features']= $this->Common_model-> selectData('wrng_features', $fld = 'title,status'); 
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Login Successfully';
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);  

            }else{
                        $errorMsgArr = array();
                        $errorMsgArr['code'] = 401;
                        $errorMsgArr['status'] = 'error';
                        if($usersocialid[0]->socialid==1){
                            $errorMsgArr['message'] = 'Please login with Faebook.';    
                        }elseif($usersocialid[0]->socialid==2){
                            $errorMsgArr['message'] = 'Please login with Gmail.';
                        }elseif($usersocialid[0]->socialid==0){
                            $errorMsgArr['message'] = 'Please login with Email..';
                        }
                        

                        $errorMsgArr['data'] =(object) array();
                        $this->response($errorMsgArr);    
                }
                                          
                }else {

                $errorMsgArr = array();
                $errorMsgArr['code'] = 401;
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'The login credentials are invalid.';
                $errorMsgArr['data'] =(object) array();
                $this->response($errorMsgArr);
            }
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
}

