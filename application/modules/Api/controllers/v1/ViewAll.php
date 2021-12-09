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

class ViewAll extends Base_Controller {

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
            $response = $this->ViewAll($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }


	//Function for User Login
	//POST DATA - email,password

    public function ViewAll($postDataArr) {
        error_reporting(0);
    
    $userPaymentPlan =  $this->Common_model->fetch_data('users','paymentPlan',['userId'=>$postDataArr['userId']]);

    if ($this->form_validation->run("api/v1/viewAll") == true) {
                   if($postDataArr['longitude'] && $postDataArr['latitude']){
                        $postDataArrr['longitude']=$postDataArr['longitude'];
                        $postDataArrr['latitude']=$postDataArr['latitude'];
                        $this->Common_model->update_single('users',$postDataArrr,['userId'=> $user[0]->userId]);
                    }


           if($postDataArr){         
                $page=$postDataArr['page'];
                $lmt1=($page-1)*10;
                $lmt2=($page)*10;
            }else{
              $page=0;
            }

if($postDataArr['sub_catgId']==4){
                      if($page == '1'){
              $content =  $this->Common_model->fetch_data('wrng_ottPlatformType','*',['status'=>1],$returnRow = false,10,$lmt2= false,$ord = 'ottPlatformTypeId', $ordtype = 'DESC');
            }elseif($page > 1){
              $content =  $this->Common_model->fetch_data('wrng_ottPlatformType','*',['status'=>1],$returnRow = false,$lmt1,$lmt2,$ord = 'ottPlatformTypeId', $ordtype = 'DESC');
            }else{
              $content =  $this->Common_model->fetch_data('wrng_ottPlatformType','*',['status'=>1],$returnRow = false,$lmt1= false,$lmt2= false,$ord = 'ottPlatformTypeId', $ordtype = 'DESC');
            } 
        if($content){         
                       foreach ($content as $keys => $contentValue) {                        
                        $userDetail[$keys] = array(
                            "id"=> $contentValue->ottPlatformTypeId,
                            "title"=> $contentValue->title,
                            "thumbnailImage"=> 'http://localhost/WrangaWeb/wrangademo/assets/thumbnailImage/'.$contentValue->image,
                            "isOttType"=>true,
                            "rating" => '',
                            "id" => $contentValue->ottPlatformTypeId,
                            "catgId" => '',
                            "age" => ''
                            );

                    }

                if($userPaymentPlan[0]->paymentPlan=='1' OR $userPaymentPlan[0]->paymentPlan==''){ 
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Please Upgrade Your Account';
                    $errorMsgArr['dataCount'] = 0;
                    $errorMsgArr['data'] = [];
                }else{
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'ViewAll';
                    $errorMsgArr['dataCount'] = count($content);
                    $errorMsgArr['data'] = $userDetail;
                }

                  
                    $this->response($errorMsgArr);      
              } else {
                $errorMsgArr = array();
                $errorMsgArr['code'] = 200;
                $errorMsgArr['status'] = 'success';
                $errorMsgArr['message'] = 'Search';
                $errorMsgArr['dataCount'] =0;
                $errorMsgArr['data'] =array();
                $this->response($errorMsgArr);
            }
}else{
                          if($page == '1'){
              $content =  $this->Common_model->fetch_data('content','*',['sub_catgId'=>$postDataArr['sub_catgId'],'catgId'=>$postDataArr['catgId'],'status'=>1],$returnRow = false,10,$lmt2= false,$ord = 'contentId', $ordtype = 'DESC');
            }elseif($page > 1){
              $content =  $this->Common_model->fetch_data('content','*',['sub_catgId'=>$postDataArr['sub_catgId'],'catgId'=>$postDataArr['catgId'],'status'=>1],$returnRow = false,$lmt1,$lmt2,$ord = 'contentId', $ordtype = 'DESC');
            }else{
              $content =  $this->Common_model->fetch_data('content','*',['sub_catgId'=>$postDataArr['sub_catgId'],'catgId'=>$postDataArr['catgId'],'status'=>1],$returnRow = false,$lmt1= false,$lmt2= false,$ord = 'contentId', $ordtype = 'DESC');
            } 
        if($content){         
                       foreach ($content as $keys => $contentValue) {                        
                        $userDetail[$keys] = array(
                            "id"=> $contentValue->contentId,
                            "title"=> $contentValue->title,
                            "thumbnailImage"=> 'http://localhost/WrangaWeb/wrangademo/assets/thumbnailImage/'.$contentValue->thumbnailImage,
                             "isOttType"=>false,
                            "rating" => $contentValue->rating,
                            "id" => $contentValue->contentId,
                            "catgId" => $contentValue->sub_catgId,
                            "age" => $contentValue->age
                            );

                    }

                if($userPaymentPlan[0]->paymentPlan=='1' OR $userPaymentPlan[0]->paymentPlan==''){ 
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Please Upgrade Your Account';
                    $errorMsgArr['dataCount'] = 0;
                    $errorMsgArr['data'] = [];
                }else{
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'ViewAll';
                    $errorMsgArr['dataCount'] = count($content);
                    $errorMsgArr['data'] = $userDetail;
                }

                 


                  
                    $this->response($errorMsgArr);      
              } else {
                $errorMsgArr = array();
                $errorMsgArr['code'] = 200;
                $errorMsgArr['status'] = 'success';
                $errorMsgArr['message'] = 'Search';
                $errorMsgArr['dataCount'] =0;
                $errorMsgArr['data'] =array();
                $this->response($errorMsgArr);
            }
}                          
    
               
   }else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['data'] =array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }                       
            
   }





}

