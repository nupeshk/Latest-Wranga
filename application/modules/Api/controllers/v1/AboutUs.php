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

class AboutUs extends Base_Controller {

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
            $response = $this->details($postDataArr);
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

    public function details($postDataArr) {
        error_reporting(0);

                   $contentData = $this->Common_model->fetch_data('content','*', array('contentId' => '5'), true);  
                    $contentDataDetail = array(
                        "contentId"=> $token,
                        "reviewerId" => $contentData[0]->reviewerId,
                        "name" => $contentData[0]->name,
                        "catgId" => (string) $contentData[0]->catgId,
						"sub_catgId" => $contentData[0]->sub_catgId,
                        "octype_Id" => $contentData[0]->octype_Id,
                        "type_id" => $contentData[0]->type_id,
                        "pId" => $contentData[0]->pId,
                        "lId" => $contentData[0]->lId,
                        "title" => $contentData[0]->title,
                        "thumbnailImage" => $contentData[0]->thumbnailImage,
                        "description" => $contentData[0]->description,
                        "releaseYear" => $contentData[0]->releaseYear,
                        "editorName" => $contentData[0]->editorName,
                        "rating" => $contentData[0]->rating,
                        "age" => $contentData[0]->age,
                        "createdat" => $contentData[0]->createdat
                        );

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Login Successfully';
                    $errorMsgArr['data'] = $contentDataDetail;
                    $this->response($errorMsgArr);                    
   }
}

