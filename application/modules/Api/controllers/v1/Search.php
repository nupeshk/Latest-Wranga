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

class Search extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
       $this->load->helper('category');
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
            $response = $this->Search($postDataArr);
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

    public function Search($postDataArr) {
          
        //print_r(categoryName(3));

        error_reporting(0);
    if ($this->form_validation->run("api/v1/search") == true) {

           if($postDataArr){         
            $page=$postDataArr['page'];
            $sub_catgId=$postDataArr['sub_catgId'];
            $lmt1=($page-1)*10;
            $lmt2=($page)*10;
            }else{
              $page=0;
            }


    if($postDataArr['sub_catgId']==4){

            $content =  $this->Common_model->likeSearch('wrng_ottPlatformType','*','title',$postDataArr['search'],$lmt1= 10,$lmt2= false); 

    }else{

            if($page == '1'){
                if($sub_catgId){
                $content =  $this->Common_model->likeSearch('content','*','title',$postDataArr['search'],$lmt1= 10,$lmt2= false,$sub_catgId);
                }else{
                    $content =  $this->Common_model->likeSearch('content','*','title',$postDataArr['search'],$lmt1= 10,$lmt2= false);
                }
            
            }elseif($page > 1){
                if($sub_catgId){
                  $content =  $this->Common_model->likeSearch('content','*','title',$postDataArr['search'],$lmt1,$lmt2,$sub_catgId);
                }else{
                  $content =  $this->Common_model->likeSearch('content','*','title',$postDataArr['search'],$lmt1,$lmt2);  
                }
            }else{
                if($sub_catgId){
                   $content =  $this->Common_model->likeSearch('content','*','title',$postDataArr['search'],$lmt1= false,$lmt2= false,$sub_catgId);
                }else{
                    $content =  $this->Common_model->likeSearch('content','*','title',$postDataArr['search'],$lmt1= false,$lmt2= false); 
                }
            
            }   
    }


                

            if($content){         
                       foreach ($content as $keys => $contentValue) {      

                        $userDetail[$keys] = array(
                            "title"=> $contentValue['title'],
                            "thumbnailImage"=> 'http://localhost/WrangaWeb/wrangademo/assets/thumbnailImage/'.$contentValue['thumbnailImage'],
                            "rating" => $contentValue['rating'],
                            "id" => $contentValue['contentId'],
                            "catgId" => $contentValue['sub_catgId'],
                            "sub_catgName" => $contentValue['sub_catgId'],
                            //"sub_catgName" => categoryName($contentValue['sub_catgId']),
                            "age" => $contentValue['age']
                            );
                    }

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Search';
                    $errorMsgArr['dataCount'] = count($content);
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);      
             } else {
                $errorMsgArr = array();
                $errorMsgArr['code'] = 200;
                $errorMsgArr['status'] = 'success';
                $errorMsgArr['message'] = 'Search';
                $errorMsgArr['dataCount'] = count($content);
                $errorMsgArr['data'] =array();
                $this->response($errorMsgArr);
            }       

              
   }else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['data'] = array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }  
    } 


}

