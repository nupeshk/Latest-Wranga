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

class Category extends Base_Controller {

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
            $response = $this->Category($postDataArr);
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

    public function Category($postDataArr) {
        error_reporting(0);

              if ($postDataArr) {

                    $userDetail=array();
                    $content =  $this->Common_model->fetch_data('catagories');
                    $value->name='category';
                    
                       foreach ($content as $key => $contentValue) {
                        $userDetail[$key] = array(
                            "id"=> $contentValue->catId,
                            "name" => $contentValue->name,
                            "status" => $contentValue->status
                            );

                    }



                    $errorMsgArr = array();
                    $errorMsgArr['code'] = '200';
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = '';
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

