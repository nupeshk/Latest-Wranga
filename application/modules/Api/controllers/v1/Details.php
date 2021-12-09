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

                   $contentData = $this->Common_model->query($postDataArr['contentId']);  
                    $contentDataDetail = array(
                        "contentId"=> (int) $contentData[0]->contentId,
                        "title" => trim($contentData[0]->title),
						"age" => (int) $contentData[0]->age,
                        "rating" =>  $contentData[0]->rating,
                        "pgStatus" =>(int) $contentData[0]->pgStatus,
                        "videoDuration" =>(int) $contentData[0]->videoDuration,
                        "releaseYear" => (int) $contentData[0]->releaseYear,
                        "description" => trim($contentData[0]->description),
                        "thumbnailImage" => BASEURL.'/assets/thumbnailImage/'.$contentData[0]->thumbnailImage,
                        "ottcontentType" => $contentData[0]->ottcontentType,
                        "ottType" => $contentData[0]->ottType,
                        "serieseNo" =>(int) $contentData[0]->serieseNo,
                        "episodeNo" =>(int) $contentData[0]->episodeNo,
                        "platform" =>$contentData[0]->platform,
                        "platformId" =>$contentData[0]->platformId,
                        "isMyList"=>$this->Common_model->selectDataCheckList('wrng_myList', $fld = '*',['contentId'=>$contentData[0]->contentId,'userId'=>$postDataArr['userId']]),
                        "videoUrl" =>$contentData[0]->videoUrl,
                        "uploadedVideo" =>'http://localhost/WrangaWeb/wrangademo/assets/videoMP4/1600398546_1980117315withSound.mp4',
                        "language" =>$contentData[0]->language,
                        "editorName" =>$contentData[0]->editorName,
                    );



                $bannersImages=$this->Common_model-> selectData('content_image', $fld = '*',['contentId'=>$contentData[0]->contentId]); 
                 if($bannersImages){   
                        foreach ($bannersImages as $key => $bannersImagesValue) {
                            $contentDataDetail['bannersImages'][] = array(
                                "id"=> $bannersImagesValue->id,
                                "imageUrl" => BASEURL."/assets/bannerImage/".$bannersImagesValue->image_path
                                );
                } 
                    }else{
                        $contentDataDetail['bannersImages']=[];
                    }    
                    
                    
                    $moralBoard=$this->Common_model->moralBoardQuery($contentData[0]->contentId); 
                    if($moralBoard){   
                        foreach ($moralBoard as $key => $moralBoardValue) {
                            $contentDataDetail['moralBoard'][] = array(
                                "catgName"=>$moralBoardValue->name,
                                "rating" => $moralBoardValue->ratning,
                                "description" =>trim($moralBoardValue->desc) ,
                                "colorStatus" => $moralBoardValue->colorCode
                                );
                       } 
                    }else{
                        $contentDataDetail['moralBoard']=[];
                    }

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Details Value';
                    $errorMsgArr['data'] = $contentDataDetail;
                    $this->response($errorMsgArr);                    
   }
}

