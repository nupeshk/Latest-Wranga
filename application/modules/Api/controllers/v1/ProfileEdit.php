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

class ProfileEdit extends Base_Controller {

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
            $response = $this->login($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] ='401';
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }

   public function login($postDataArr) {
       error_reporting(0);
       $myJSON = json_decode($postDataArr['kidsData']);     
       $this->Common_model->deleteKids($myJSON[0]->userId);	

       		foreach ($myJSON as $key => $value) {
       			$postDataArrKids['kidName']=$value->kidName;
       			$postDataArrKids['kidAge']=$value->kidAge;
       			$postDataArrKids['userId']=$value->userId;
				$this->Common_model->insert_single('userKid',$postDataArrKids);
       		}


    $postDataArrr['longitude']=$postDataArr['longitude'];
    $postDataArrr['latitude']=$postDataArr['latitude'];
   	$postDataArrr['gender']=$postDataArr['gender'];
   	$postDataArrr['phone']=$postDataArr['phone'];
   	$postDataArrr['dob']="";
   	$postDataArrr['name']=$postDataArr['name'];


    if($_FILES['userPhoto']['size']>0){
		$pre= time(); 
		$image=$_FILES['userPhoto']['name'];
		$target_path = "assets/userPhoto/";
		$file= $_FILES['userPhoto']['name'];
		$target_path = $target_path.$pre.$file;
		$source=$_FILES["userPhoto"]["tmp_name"];	
		move_uploaded_file($source,$target_path);	
		$postDataArrr['userPhoto'] = $pre.$file;
}
        	$this->Common_model->update_single('users',$postDataArrr,['userId'=> $postDataArr['userId']]);




          $user = $this->Common_model->fetch_data('users','*', array('userId' => $postDataArr['userId']), true);  
                    if($user[0]->email==NULL){ $user[0]->email=""; }
                    if($user[0]->name==NULL){  $name=$user[0]->name=""; }
                    if($user[0]->socialid==NULL){ $user[0]->socialid=""; }
                    if($user[0]->longitude==NULL){ $user[0]->longitude=""; }
                    if($user[0]->latitude==NULL){ $user[0]->latitude=""; }
                    if($user[0]->deviceId==NULL){ $user[0]->deviceId=""; }

                    if($user[0]->userPhoto){
                        $userPic='http://wranga.in/assets/userPhoto/'.$user[0]->userPhoto;
                    }else{
                         $userPic="";
                    }

                    
                    $userDetail = array(
                       // "token"=> $token,
                        "email" => $user[0]->email,
                        "name" => $user[0]->name,
                        "userId" => (string) $user[0]->userId,
                        "paymentPlan" =>  paymentPlanTitle($user[0]->paymentPlan),
                        "paymentStatus" => (int) $user[0]->paymentStatus,
                       "userPhoto" => $userPic,
                        "phone" => (string)  $user[0]->phone,
                        "socialid" => $user[0]->socialid,
                        "gender" => $user[0]->gender,
                        "longitude" => $user[0]->longitude,
                        "latitude" => $user[0]->latitude,
                        "isDefault" => $user[0]->isDefault,
                        "deviceId" => $user[0]->deviceId,
                           // "createdDate" => $postDataArr['createdDate'],
                        );

                          $kidsIdList = $this->Common_model->fetch_data('userKid','*', array('userId' =>  $postDataArr['userId']), true);   
                
                        if($kidsIdList){    

                              foreach ($kidsIdList as $key => $kidsValue) {
                                    $userDetail['kidsData'][$key]['kidName']=$kidsValue->kidName;
                                    $userDetail['kidsData'][$key]['kidAge']=$kidsValue->kidAge;
                                }  
                        }else{
                             $userDetail['kidsData']= [];
                        }        

                         $userDetail['features']= $this->Common_model-> selectData('wrng_features', $fld = 'title,status'); 


        	 		$errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Profile Data Updated Successfully';
                    $errorMsgArr['data'] =$userDetail;;
                    $this->response($errorMsgArr);  


                   
   }



}

