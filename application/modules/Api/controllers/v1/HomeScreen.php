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

class HomeScreen extends Base_Controller {

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
            $response = $this->HomeScreen($postDataArr);
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

    public function HomeScreen($postDataArr) {
        error_reporting(0);

            /*if ($this->form_validation->run("api/signup") == true) {   */

         $user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email'],'password'=>$postDataArr['password']]);

                   
                   if($postDataArr['longitude'] && $postDataArr['latitude']){
                   		$postDataArrr['longitude']=$postDataArr['longitude'];
                   		$postDataArrr['latitude']=$postDataArr['latitude'];
                        $this->Common_model->update_single('users',$postDataArrr,['userId'=> $user[0]->userId]);
                    }


/*				if (!$user) {
*/           

                    $subCatagories = $this->Common_model->fetch_data('subCatagories');  

                    /*print_r($subCatagories);
                    die;*/
                    $userDetail=array();
                    foreach ($subCatagories as $key => $value) {                    
                    
    $content =  $this->Common_model->fetch_data('content','*',['sub_catgId'=>$value->subId,'catgId'=>$postDataArr['catgId'],'status'=>1]);


                           /* print_r($content);
                            die;*/

                       foreach ($content as $keys => $contentValue) {

                      /*  $userDetail[$value->name] = array(
                            "title"=> $contentValue->title,
                            "rating" => $contentValue->rating,
                            "sub_catgId" => $contentValue->sub_catgId
                            );
*/
                        $userDetail[$key]['catg'] = $value->name;
                        
                        $userDetail[$key]['catgData'][$keys] = array(
                            "title"=> $contentValue->title,
                            "thumbnailImage"=> 'http://localhost/WrangaWeb/wrangademo/assets/thumbnailImage/'.$contentValue->thumbnailImage,
                            "rating" => $contentValue->rating,
                            "id" => $contentValue->contentId,
                            "catgId" => $contentValue->sub_catgId,
                            "age" => $contentValue->age
                            );



                    }

                          }       

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'homescreen';
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);                    
            

               /* }else {

               $errorMsgArr = array();
                $errorMsgArr['code'] = 401;
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'the login credentials are invalid';
                $errorMsgArr['data'] = "";
                $this->response($errorMsgArr);
            }*/


       /* } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }*/
   }
}

