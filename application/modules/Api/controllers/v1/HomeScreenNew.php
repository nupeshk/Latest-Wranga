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

class HomeScreenNew extends Base_Controller {

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

            $userPaymentPlan =  $this->Common_model->fetch_data('users','paymentPlan',['userId'=>$postDataArr['userId']]);
            
            if($userPaymentPlan[0]->paymentPlan=='1' OR $userPaymentPlan[0]->paymentPlan==''){ 
               $limit=5;
            }

            $user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email'],'password'=>$postDataArr['password']]);
                   
                   if($postDataArr['longitude'] && $postDataArr['latitude']){
                   		$postDataArrr['longitude']=$postDataArr['longitude'];
                   		$postDataArrr['latitude']=$postDataArr['latitude'];
                        $this->Common_model->update_single('users',$postDataArrr,['userId'=> $user[0]->userId]);
                    }
       
    $catagories = $this->Common_model->fetch_data('catagories');   
    $userDetail=array();
    foreach ($catagories as $i => $catagoriesValue) {
    			
    			//print_r($catagoriesValue);
				$userDetail[$i]['category_id']=$catagoriesValue->catId;
				$userDetail[$i]['category_name']=$catagoriesValue->name;

				$subCatagories = $this->Common_model->fetch_data('subCatagories','*',['catgId'=>$catagoriesValue->catId]);   


            if($subCatagories){    
				foreach ($subCatagories as $j => $subcatagoriesvalue) {
                    $userDetail[$i]['data'][$j]['catg']=$subcatagoriesvalue->name;
					$userDetail[$i]['data'][$j]['catgId']=$subcatagoriesvalue->subId;

              if($subcatagoriesvalue->subId==4){

                    $wrng_ottPlatformType =  $this->Common_model->fetch_data('wrng_ottPlatformType','*',['status'=>1], $returnRow = false,$lmt1=$limit,$lmt2= false,$ord = false, $ordtype = false);

        foreach ($wrng_ottPlatformType as $keys => $ooTPlatFormValue) {

                $userDetail[$i]['data'][$j]['catgData'][$keys]= array(
                            "title"=> $ooTPlatFormValue->title,
                            "thumbnailImage"=> BASEURL.'/assets/ooTType/'.$ooTPlatFormValue->image,
                            "rating" => "",
                            "id" => $ooTPlatFormValue->ottPlatformTypeId,
                            "catgId" => "",
                            "age" => "",
                            "isOttType"=>true
                            );
                   } 
              }else{

	$content =  $this->Common_model->fetch_data('content','*',['sub_catgId'=>$subcatagoriesvalue->subId,'catgId'=>$catagoriesValue->catId,'status'=>1], $returnRow = false,$lmt1= $limit,$lmt2= false,'contentId', $ordtype = 'DESC');

                if($content){

                     foreach ($content as $keys => $contentValue) {
                        $userDetail[$i]['data'][$j]['catgData'][$keys] = array(
                            "title"=> $contentValue->title,
                            "thumbnailImage"=> BASEURL.'/assets/thumbnailImage/'.$contentValue->thumbnailImage,
                            "rating" => $contentValue->rating,
                            "id" => $contentValue->contentId,
                            "catgId" => $contentValue->sub_catgId,
                            "age" => $contentValue->age,
                            "isOttType"=>false
                            );
                        }
                        

                }else{
                    $userDetail[$i]['data'][$j]['catgData']=[];
                } 

      }                  
				}
            }else{
                $userDetail[$i]['data']=[];
            }    
    }   	




                    

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'homescreen';
                    $errorMsgArr['category_data'] = $userDetail;
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

