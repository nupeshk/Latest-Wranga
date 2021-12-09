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

class TipsList extends Base_Controller {

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
            $response = $this->list($postDataArr);
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

    public function list($postDataArr) {
        error_reporting(0);

                   $wrng_tipsLists = $this->Common_model->fetch_data('wrng_tipsList','*', array("contentId"=>$postDataArr['contentId']), true);  

                foreach ($wrng_tipsLists as $key => $wrng_tipsList) {
                            $contentDataDetail[] = array(
                                    "id"=> $wrng_tipsList->id,
                                    "title" => $wrng_tipsList->title,
                                    "contentId" => $wrng_tipsList->contentId,
                                    "description" => $wrng_tipsList->description,
                                    "tipsType" => $wrng_tipsList->tipsType,
                                    "videoUrl" => $wrng_tipsList->videoUrl,
                                    "videoThumbnailImage" => BASEURL."/assets/photo/".$wrng_tipsList->videoThumbnailImage,
                                    "imageUrl" =>$wrng_tipsList->imageUrl,
                                    "status" => $wrng_tipsList->status,
                                    "videoPlatformType" =>$wrng_tipsList->videoPlatformType
                                );
                            }       

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Tips List';
                    $errorMsgArr['data'] = $contentDataDetail;
                     $errorMsgArr['totalCount'] = count($wrng_tipsLists);
                    $this->response($errorMsgArr);                    
   }
}

