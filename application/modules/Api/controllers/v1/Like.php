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
class Like extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('User_model');
    }

    /**
     * Index function
     *
     * @access  public
     */
    public function index_get() {
        echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>" . SITE_TITLE . "</span></h1>";
    }

   

    public function index_post() {
      
      //if ($this->form_validation->run("api/like") == true) {
           /*$auth = $this->checkheader();
          print_r($auth); die;*/
          
        $postDataArr = $this->post();
        error_reporting(0);
        
        $insert = array();
    $insert["userId"] = $postDataArr['userId'];
    $insert["commentId"] = $postDataArr['commentId'];
    $user = $this->User_model->getLikeDataNews(array(), array('commentId' => $postDataArr['commentId'],'userId' => $postDataArr['userId']), true);

  if($user){
        //echo "1";
    $this->User_model->deleteLikeNews(array('commentId' => $postDataArr['commentId'],'userId' => $postDataArr['userId']));

        //$totalLike =$this->Common->selectNumRow('newsPayLike', $fld = '*',array('commentId' => $postDataArr['commentId']));
        $errorMsgArr = array();
            $errorMsgArr['code'] = SUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_SUCCESS;
            $errorMsgArr['message'] = 'Unlike successfull';
                $errorMsgArr['isLike'] = false;
                $errorMsgArr['likeCount'] =$this->Common_model->selectNumRow('wrng_like', $fld = '*',array('commentId' => $postDataArr['commentId']));

            echo json_encode($errorMsgArr);

  }else{    
              $insert = array();
              $insert["userId"] = $postDataArr['userId'];
              $insert["commentId"] = $postDataArr['commentId'];
        $id = $this->Common_model->insert_single("wrng_like", $insert);

              /*echo $id;
              die;*/

        if($id){
        $errorMsgArr = array();
            $errorMsgArr['code'] = SUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_SUCCESS;
            $errorMsgArr['message'] = 'Like successfull';
                $errorMsgArr['isLike'] = true;
                $errorMsgArr['likeCount'] = $this->Common_model->selectNumRow('wrng_like', $fld = '*',array('commentId' => $postDataArr['commentId']));
            echo json_encode($errorMsgArr);
           }else{ 

            $errorMsgArr = array();
                $errorMsgArr['code'] = UNSUCCESS_CODE;
                $errorMsgArr['status'] = STATUS_INVALID;
                $errorMsgArr['message'] = INVALID_CREDENTIAL;
                echo json_encode($errorMsgArr);


                } 

  }

    


             /*}
             else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['error'] = $error;
            $errorMsgArr['message'] = PARAM_MISSING;
            echo json_encode($errorMsgArr);
        }*/



    }

}
