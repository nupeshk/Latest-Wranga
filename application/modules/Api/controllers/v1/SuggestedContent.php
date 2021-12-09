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

class SuggestedContent extends Base_Controller {

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
            $response = $this->suggested($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = '401';
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }


	//Function for contentData Login
	//POST DATA - email,password

            /*
                $this->load->library('email');
                $config['protocol']    = 'tls';
                $config['smtp_host']    = 'smtp.zoho.com';
                $config['smtp_port']    = '587';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = 'info@wranga.in';
                $config['smtp_pass']    = 'Wranga@1234';
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; 

                //$this->load->library('email', $config);
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
    
                 $name = 'wranga';
                 $email = 'info@wranga.in';
                 $this->email->from($email, $name);
                 $this->email->to('kaushlendras1@gmail.com');
                 $this->email->subject('Mi Dealership');
                 $this->email->message('<p>Dear '.$costmer.' , Your application For Mi store/Dealership is submitted Successfully.Our executive will contact within 48 hrs.</p>');
                 if($this->email->send()){
                    echo "send";
                 }else{
                    echo "not";
                 }  
                 die;*/


    public function suggested($postDataArr) {
       // if ($this->form_validation->run("api/v1/suggested") == true) {
        error_reporting(0);            
                     $postDataArr = $this->post();
                    $contentId=$postDataArr['contentId'];
                    $maxAge=$postDataArr['maxAge'];
                    $minAge=$postDataArr['minAge'];
                    $language=$postDataArr['language'];
                   $catgId=$this->Common_model->getContentCategoryId($contentId);
                   $sub_catgId=$this->Common_model->getContentSubCategoryId($contentId);

                   $contentData = $this->Common_model->selectData('content', $fld = '*', ['catgId'=>$catgId,'sub_catgId'=>$sub_catgId], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false,$postDataArr['contentId']);  

                   foreach ($contentData as $key => $contentDataValue) {
                    $contentDataDetail[] = array(
                        "id"=>$contentDataValue->contentId,
                        "title" => $contentDataValue->title,
                        "isMyList"=>$this->Common_model->selectDataCheckList('wrng_myList', $fld = '*',['contentId'=>$contentDataValue->contentId,'userId'=>$postDataArr['userId']]),

						"age" =>$contentDataValue->age,
                        "rating" => $contentDataValue->rating,
                        "thumbnailImage" => BASEURL."/assets/thumbnailImage/".$contentDataValue->thumbnailImage
                    );
                
                }    
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Suggested Value';
                    $errorMsgArr['data'] = $contentDataDetail;
                    $this->response($errorMsgArr);   
            /*} else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['data'] =(object) array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }       */                   
   }
}

