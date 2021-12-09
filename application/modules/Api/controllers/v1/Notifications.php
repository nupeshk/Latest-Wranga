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

class Comment extends Base_Controller {

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
 			
 		if ($this->form_validation->run("api/v1/comment") == true) {
	        $postDataArr = $this->post();
        
        /*$user = $this->Common_model->fetch_data('wrng_comment','*', array('contentId' => $postDataArr['contentId']), true);
            if($user){*/
                $insert = array();
				        $insert['created_at'] = getTodayDate();    
				        $insert["contentId"] = $postDataArr['contentId'];
				        $insert["commentedUserId"] = $postDataArr['userId'];
				        $insert["commentRating"] = $postDataArr['commentRating'];
                $insert["comment"] = $postDataArr['comment'];
				        $insert["type"] = $postDataArr['type'];
                $success = $this->Common_model->insert_single("wrng_comment", $insert);

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = SUCCESS_CODE;
                    $errorMsgArr['status'] = STATUS_SUCCESS;
                    $errorMsgArr['message'] = 'Comment Updated successfull';
                    $errorMsgArr['data'] =$success;
                    echo json_encode($errorMsgArr);
       	 //}
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




    //Function for contentData Login
    //POST DATA - email,password

    public function CommentList_post() {

    		/*$_POST = json_decode(file_get_contents("php://input"), true);
            $auth = $this->checkheader();
           print_r($auth); die;  */ 



   if ($this->form_validation->run("api/v1/commentList") == true) {
	         $postDataArr = $this->post();
	        error_reporting(0);
	        $contentData = $this->Common_model->selectData('wrng_comment','*', array('contentId' => $postDataArr['contentId'],'type' => $postDataArr['type']), $or_where = false, $ord = 'commentId', $ordtype = 'DESC', $grpby = false, $whstr_in = false, $lmt = false); 

			        foreach ($contentData as  $i => $contentValue) {
			       			$contentDataDetail[$i]=array(
			       				'commentId' => $contentValue->commentId,
			      				'commentedUserId' => $contentValue->commentedUserId,
      							'commentedUserName' => userName($contentValue->commentedUserId),
                    'profilePic' => "http://wranga.in/Profile-Pic-Demo.png",
                    'commentRating' =>$contentValue->commentRating,
      							'comment' =>$contentValue->comment,
      							'isLike' => $this->Common_model->selectNumRowTrue('wrng_like','*',['commentId'=>$contentValue->commentId,'userId' => $postDataArr['userId']]),
      							'likeCount' => $this->Common_model->selectNumRow('wrng_like','*',['commentId'=>$contentValue->commentId]),
      							'created_at' => $contentValue->created_at
      						);

	        $commentReply = $this->Common_model->fetch_data('commentReply','*', array('commentId' => $contentValue->commentId), true);  

          if($commentReply){
			       			foreach ($commentReply as  $j => $valueReply) {
			       				$contentDataDetail[$i]['replyData'][$j]=array(
				       				'replyId' => $valueReply->replyId,
				      				'repliedUserId' => $valueReply->repliedUserId,
	      							'repliedUserName' => userName($valueReply->repliedUserId),
                       'profilePic' => "http://wranga.in/Profile-Pic-Demo.png",
	      							'replyMsg' => $valueReply->replyMsg,
	      							'created_at' => $valueReply->created_at
      							);	
      					}
            }else{
              $contentDataDetail[$i]['replyData']=[];
            }    

    				}

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    
                    $errorMsgArr['message'] = 'Comment List';

                    $errorMsgArr['data'] = $contentDataDetail;
                    $errorMsgArr['totalCount'] = count($contentData);
                    $this->response($errorMsgArr);  
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

       //Function for contentData Login
    //POST DATA - email,password

    public function CommentReply_post() {

   if ($this->form_validation->run("api/v1/commentReply") == true) {
	         $postDataArr = $this->post();
	        error_reporting(0);
	        $contentData = $this->Common_model->fetch_data('commentReply','*', array('commentId' => $postDataArr['commentId']), true);  
			        foreach ($contentData as $contentValue) {
			       			$contentDataDetail[]=array(
                    'repliedUserName' => userName($contentValue->repliedUserId),
                    'profilePic' => "http://wranga.in/Profile-Pic-Demo.png",
			      				'comment' => $contentValue->replyMsg,
      							 'created_at' => $contentValue->created_at,

      							 );
    				}

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Comment List';
                    $errorMsgArr['data'] = $contentDataDetail;
                    $this->response($errorMsgArr);  
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


       public function CommentReplyAdd_post() {

   if ($this->form_validation->run("api/v1/commentReply") == true) {
           $postDataArr = $this->post();
          error_reporting(0);
         $insert = array();
                $insert['created_at'] = getTodayDate();    
               // $insert["contentId"] = $postDataArr['contentId'];
                $insert["commentId"] = $postDataArr['commentId'];
                $insert["repliedUserId"] = $postDataArr['userId'];
                $insert["replyMsg"] = $postDataArr['comment'];
                $success = $this->Common_model->insert_single("commentReply", $insert);


              
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Comment List';
                    $errorMsgArr['data'] = $success;
                    $this->response($errorMsgArr);  
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

