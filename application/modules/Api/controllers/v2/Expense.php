<?php


//require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'modules/Api/controllers/v1/Base_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Description of Donet
 *
 * @author
 */

class Expense extends Base_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('User_model');
        $this->load->model('Vehicle_model');
        $this->load->model('Transaction_model');
        $this->load->model('Common_model');
    }

    public function createGroup_post() {     
         error_reporting(0); 
            $_POST = json_decode(file_get_contents("php://input"), true);
            $auth = $this->checkheader();
           /*print_r($auth); die; */         
           $userId = $auth['userId'];
        if ($this->form_validation->run("api/createGroup") == true) {  
            $groupId=$this->Common_model->insert_createGroup('createGroup',['groupName'=>$_POST['groupName'],
                                             'currency'=>$_POST['currency'],'userId'=>$userId]);   
            if(isset($_POST['members'])){
                foreach ($_POST['members'] as $key => $value) {
                        $expensegroup=$this->Common_model->insert_single(
                                    'addMemberInGroup',['groupId'=>$groupId,
                                                    'memberName'=>$value['memberName'],
                                                    'memberMobileNo'=>$value['memberMobileNo']
                                                ]);
                }
            }    

            if($groupId){
                $this->webserviceResponse(SUCCESS_CODE, GROUP_INSERT);
                //$this->webserviceResponse(SUCCESS_CODE, GROUP_INSERT,['groupList'=>$groupList]);   
            }else{
                $this->webserviceResponse(UNSUCCESS_CODE, GROUP_NOT_INSERT);  
            }
        } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }    
     }



	public function groupList_post(){
         error_reporting(0);
			$_POST = json_decode(file_get_contents("php://input"), true);
            $auth = $this->checkheader();
            $userId = $auth['userId'];         
        /*if ($this->form_validation->run("api/createGroup") == true) {*/   
                $groupList=array();
                $createGroupList = $this->Common_model->fetch_data('createGroup','*',['userId'=>$userId]);
            if($createGroupList){    
                foreach ($createGroupList as $ky =>$groupLists) {
                    $groupList[$ky]['groupId']=$groupLists->id;
                    $groupList[$ky]['groupName']=$groupLists->groupName;
                    $groupList[$ky]['currency']=$groupLists->currency;
                   /* print_r($groupLists->id);
                    die;*/
                $memberGroup = $this->Common_model->fetch_data('addMemberInGroup','*', array('groupId' => $groupLists->id));
            if($memberGroup){    
                foreach ($memberGroup as $key =>$memberList) {
                            $groupList[$ky]['members'][] = array(
                                    "groupId" => $memberList->groupId,
                                    "memberId" => $memberList->id,
                                    "memberName" => $memberList->memberName,
                                    "memberMobileNo" => $memberList->memberMobileNo,
                                ); 
                }

              }  

            }
        }    
                    
            if($createGroupList){
                $this->webserviceResponse(SUCCESS_CODE, GROUP_LIST_SUCCESS,['groupList'=>$groupList]);   
            }else{
                $this->webserviceResponse(UNSUCCESS_CODE, GROUP_LIST_FAILED);  
            }
        /*} else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }*/  
	}   

  
     public function verifyOtp_post(){
        error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
           /*print_r($auth); die;*/
           /*print_r( $postDataArr);
        die;*/
       if ($this->form_validation->run("api/verifyOtp") == true) {
                //$expensegroup=$this->Common_model->update_single('users',$postDataArr,['mobileNo'=> $postDataArr['mobileNo']]);
             $otp = $this->Common_model->fetch_data('users','*', array('mobileNo' => $postDataArr['mobileNo'],'otp' => $postDataArr['otp']));
            if($otp){
                  /*$this->Common_model->update_single('createGroup',['isActive'=>1],array('mobileNo' => $postDataArr['mobileNo'],'otp' => $postDataArr['otp']));  */
                 $token = $this->Common_model->fetch_data('authToken','*', array('userId' => $otp[0]->userId));
                 $user = $this->User_model->getUserData(array(), array('mobileNo' => $postDataArr['mobileNo']), true);
                    $userDetail = array(
                        "name" => $user['name'],
                        "mobileNo" => $user['mobileNo'],
                        "countryCode" => $user['countryCode'],
                        "otp" => $user['otp'],
                        "isActive" => $user['isActive'],
                        "token" => encrypt($token[0]->token),
                    );
                 $this->webserviceResponse(SUCCESS_CODE, OTP_SUCCESS,['userData'=>$userDetail]);       
            }else{
                  $this->webserviceResponse(UNSUCCESS_CODE, OTP_FAILED);  
            } 
            /*$otp=$this->Common_model->updateAll('users',$postDataArr,['mobileNo'=> $postDataArr['mobileNo']]); */            
        } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }    
     }


      public function getProfile_get(){

            error_reporting(0);
            $_POST = json_decode(file_get_contents("php://input"), true);
            $postDataArr = $this->input->post();
            

            $auth = $this->checkheader();
            $userId = $auth['userId'];         
            $userData=array();
           

            

            $createGroupList = $this->Common_model->fetch_data('users','*',['userId'=>$userId]);
                 $userData['name']=$createGroupList[0]->name;
                 $userData['mobileNo']=$createGroupList[0]->mobileNo;
                 $userData['countryCode']=$createGroupList[0]->countryCode;
                 $userData['profilePhoto']=$createGroupList[0]->profilePhoto;
                 $userData['address']=$createGroupList[0]->address;
                 $userData['emailId']=$createGroupList[0]->emailId;
                 $userData['aboutUs']=$createGroupList[0]->aboutUs;
                 $userData['otp']=$createGroupList[0]->otp;
                 $userData['isActive']=$createGroupList[0]->isActive;
                 $userData['token']=$auth['token'];

            if($createGroupList){
                $this->webserviceResponse(SUCCESS_CODE, UPDATE_SUCCESS,['userData'=>$userData]);   
            }else{
                $this->webserviceResponse(UNSUCCESS_CODE, UPDATE_FAILED);  
            } 
    }


    public function updateProfile_post(){
         error_reporting(0);
           $postDataArr = $this->input->post();
            $auth = $this->checkheader();

            $userId = $auth['userId'];         
        if ($this->form_validation->run("api/updateProfile") == true) {

           if (isset($_FILES['profilePhoto']['name']) && !empty($_FILES['profilePhoto']['name'])) {
                $uploadPath = PUBLIC_PATH . PROFILE_PATHS;
                $filename = time() . ".png";

                //echo $uploadPath ; die;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //$config['max_size'] = 100;
                //$config['max_width'] = 1024;
                //$config['max_height'] = 768;
                $config['file_name'] = $filename;
                //print_r($config); die;
                $uploaded = $this->uploadImage("profilePhoto", $config, 150, 150);
                if ($uploaded) {
                    $postDataArr["profilePhoto"] = $filename;
                }
            }


            //unset($postDataArr['groupId']);
            $updateProfile=$this->Common_model->update_single('users',$postDataArr,['userId'=> $userId]); 

            $userData=array();
            $createGroupList = $this->Common_model->fetch_data('users','*',['userId'=>$userId]);
                 $userData['name']=$createGroupList[0]->name;
                 $userData['mobileNo']=$createGroupList[0]->mobileNo;
                 $userData['countryCode']=$createGroupList[0]->countryCode;
                 $userData['profilePhoto']='http://yogeshgaur.in/hisabpe/public/userProfile/'.$createGroupList[0]->profilePhoto;
                 $userData['address']=$createGroupList[0]->address;
                 $userData['emailId']=$createGroupList[0]->emailId;
                 $userData['aboutUs']=$createGroupList[0]->aboutUs;
                 $userData['otp']=$createGroupList[0]->otp;
                 $userData['isActive']=$createGroupList[0]->isActive;
                 $userData['token']=$auth['token'];

            if($updateProfile){
                $this->webserviceResponse(SUCCESS_CODE, UPDATE_SUCCESS,['userData'=>$userData]);   
            }else{
                $this->webserviceResponse(UNSUCCESS_CODE, UPDATE_FAILED);  
            }
        } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }  
    }



     public function updateGroup_post() {      
         error_reporting(0);
           $postDataArr = json_decode(file_get_contents("php://input"), true);
           $_POST = json_decode(file_get_contents("php://input"), true);
           $auth = $this->checkheader();
           /*print_r($auth); die;*/
              $postDataArr = $this->input->post();
        if ($this->form_validation->run("api/updateGroup") == true) {
            /*print_r($postDataArr);
            die;*/
            $postDataArr['id']=$postDataArr['groupId'];
            unset($postDataArr['groupId']);
            $expensegroup=$this->Common_model->update_single('createGroup',$postDataArr,['id'=> $postDataArr['id']]);          
            if($expensegroup){
                $this->webserviceResponse(SUCCESS_CODE, UPDATE_SUCCESS);   
            }else{
                $this->webserviceResponse(UNSUCCESS_CODE, UPDATE_FAILED);  
            }
        } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }    
     }

    public function addMemberInGroup_post(){
         error_reporting(0);
            $postDataArr = json_decode(file_get_contents("php://input"), true);
            $_POST = json_decode(file_get_contents("php://input"), true);
            $auth = $this->checkheader();
           /*print_r($auth); die;*/
            $postDataArr = $this->input->post();
     if ($this->form_validation->run("api/updateGroup") == true) {       
        $participants= $this->Common_model->insert_single('addMemberInGroup',$postDataArr);
         if($participants){
                $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
         }
    } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }      
    }

/******* userId, transactionType(CREDIT/DEBIT), transactionSubType(CREDIT-0/CREDIT-1 or DEBIT-0/DEBIT-1), amount, balanceAmount, transactionDate, notes, image, createdDate   ****/

    public function addTransaction_post(){ 
            error_reporting(0);
            $postDataArr = json_decode(file_get_contents("php://input"), true);
            $_POST = json_decode(file_get_contents("php://input"), true);
            $postDataArr = $this->post();
            $auth = $this->checkheader();
           /*print_r($auth); die;*/
            $postDataArr['userId'] = $auth['userId'];

            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $uploadPath = PUBLIC_PATH . TRANSACTION_PATH;
                $filename = time() . "_question" . ".jpg";
                //echo $uploadPath ; die;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //$config['max_size'] = 100;
                //$config['max_width'] = 1024;
                //$config['max_height'] = 768;
                $config['file_name'] = $filename;
                //print_r($config); die;
                $uploaded = $this->uploadImage("image", $config, 150, 150);
                if ($uploaded) {
                    $postDataArr["image"] = $filename;
                }
            }
          
     if ($this->form_validation->run("api/addTransaction") == true) {  
     
      //$postDataArr["transactionDate"] =date('m/d/Y', $postDataArr['transactionDate']);     
      $participants= $this->Common_model->insert_single('addTransaction',$postDataArr);
        
         if($participants){
              $paymentData=array();
                $addTransaction = $this->Common_model->fetch_data('addTransaction','*',['id'=>$participants]);
                $paymentData = array(
                            "transactionId" =>$addTransaction[0]->id,
                            "userId" =>$postDataArr['userId'] ,
                            "customerId" =>$postDataArr['customerId'] ,
                            "transactionType" => $addTransaction[0]->transactionType,
                            "transactionSubType" => $addTransaction[0]->transactionSubType,
                            "amount" => $addTransaction[0]->amount,
                            "balanceAmount" => $addTransaction[0]->balanceAmount,
                            "notes" => $addTransaction[0]->notes,
                            "image" =>  $this->Common_model->fetch_data1('imageTransaction','id,image',['transactionId'=>$transactionList->id]),
                            "transactionDate" => $addTransaction[0]->transactionDate,
                            //"transactionDate" => $memberList->memberMobileNo,
                        );
          
           $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT,['paymentData'=>$paymentData]);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
         }
    } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }      
    }


    public function deleteBill_post(){
            error_reporting(0);
            $postDataArr = json_decode(file_get_contents("php://input"), true);
            $_POST = json_decode(file_get_contents("php://input"), true);
            $postDataArr = $this->post();
            $auth = $this->checkheader();
           /*print_r($auth); die;*/
            $postDataArr['userId'] = $auth['userId'];
             unset($postDataArr['userId']);
             

             $participants= $this->Common_model->deleterecords($postDataArr['transactionId']);
             if($participants){
                $this->webserviceResponse(SUCCESS_CODE, DELETE_SUCCESS);   
             }else{
              $this->webserviceResponse(UNSUCCESS_CODE, DELETE_FAILED);  
             }

    }

    public function addTransactionBill_post(){ 
            error_reporting(0);
            $postDataArr = json_decode(file_get_contents("php://input"), true);
            $_POST = json_decode(file_get_contents("php://input"), true);
            $postDataArr = $this->post();
            $auth = $this->checkheader();
            $postDataArr['userId'] = $auth['userId'];

            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $uploadPath = PUBLIC_PATH . TRANSACTION_PATH;
                $filename = time() . "_transactionBill" . ".jpg";
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = $filename;
                //print_r($config); die;
                $uploaded = $this->uploadImage("image", $config, 150, 150);
                if ($uploaded) {
                    $postDataArr["image"] = $filename;
                }
            }

      unset($postDataArr['userId']);
      $participants= $this->Common_model->insert_single('imageTransaction',$postDataArr);        
      
         if($participants){
              $paymentData=array();
                $addTransaction = $this->Common_model->fetch_data('imageTransaction','*',['id'=>$participants]);
                $paymentData = array(
                            "transactionId" => $addTransaction[0]->id,
                            "image" => 'http://yogeshgaur.in/hisabpe/public/transaction/'.$addTransaction[0]->image,
                    );
           $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT,['transactionBill'=>$paymentData]);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
         }

    }



    public function addImageTransaction_post(){
    	error_reporting(0);
            $postDataArr = $this->post();
            $auth = $this->checkheader();
           /*print_r($auth); die;*/
            $postDataArr['userId'] = $auth['userId'];

            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $uploadPath = PUBLIC_PATH . TRANSACTION_PATH;
                $filename = time() . "_transaction" . ".jpg";
                //echo $uploadPath ; die;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //$config['max_size'] = 100;
                //$config['max_width'] = 1024;
                //$config['max_height'] = 768;
                $config['file_name'] = $filename;
                //print_r($config); die;
                $uploaded = $this->uploadImage("image", $config, 150, 150);
                if ($uploaded) {
                    $postDataArrr["image"] = $filename;
                }
            }
          
     $postDataArrr['transactionId']=$postDataArr['transactionId'];      
     $id=$postDataArr['transactionId'];
     $item= $this->Common_model->insert_single('imageTransaction',$postDataArrr);

         if($item){
              $paymentData=array();
              
                $imageList= $this->Common_model->fetch_data('imageTransaction','id,image',['transactionId'=>$id]);
          		foreach ($imageList as $key =>$imageLists) {
                            $paymentData['imageList'][$key] = array(
                                    "id" => $imageLists->id,
                                    "image" => 'http://yogeshgaur.in/hisabpe/public/transaction/'.$imageLists->image
                               ); 
                }

           $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT,['paymentData'=>$paymentData]);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
         }
   

    }



        public function updateTransaction_post(){ 
            error_reporting(0);
            /*$postDataArr = json_decode(file_get_contents("php://input"), true);
            $_POST = json_decode(file_get_contents("php://input"), true);*/
            $postDataArr = $this->post();
            $auth = $this->checkheader();
           /*print_r($auth); die;*/
            $postDataArr['userId'] = $auth['userId'];

            if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                $uploadPath = PUBLIC_PATH . TRANSACTION_PATH;
                $filename = time() . "_transaction" . ".jpg";
                //echo $uploadPath ; die;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //$config['max_size'] = 100;
                //$config['max_width'] = 1024;
                //$config['max_height'] = 768;
                $config['file_name'] = $filename;
                //print_r($config); die;
                $uploaded = $this->uploadImage("image", $config, 150, 150);
                if ($uploaded) {
                    $postDataArrr["image"] = $filename;
                }
            }
          
     if ($this->form_validation->run("api/addTransaction") == true) {  
     
      //$postDataArr["transactionDate"] =date('m/d/Y', $postDataArr['transactionDate']);    

       
      
        $postDataArrr['transactionId']=$postDataArr['transactionId'];      
       $id=$postDataArr['transactionId'];
       unset($postDataArr['transactionId']);
       unset($postDataArr['amount']);
       unset($postDataArr['balanceAmount']);

      $participants=$this->Common_model->update_single('addTransaction',$postDataArr,['id'=> $id]);
      $item= $this->Common_model->insert_single('imageTransaction',$postDataArrr);


         if($participants){
              $paymentData=array();
                $addTransaction = $this->Common_model->fetch_data('addTransaction','*',['id'=>$participants]);
                $paymentData = array(
                            "userId" =>$postDataArr['userId'] ,
                            "customerId" =>$postDataArr['customerId'] ,
                            "transactionType" => $addTransaction[0]->transactionType,
                            "transactionSubType" => $addTransaction[0]->transactionSubType,
                            "amount" => $addTransaction[0]->amount,
                            "balanceAmount" => $addTransaction[0]->balanceAmount,
                            "notes" => $addTransaction[0]->notes,
                            "image" => $addTransaction[0]->image,
                            "transactionDate" => $addTransaction[0]->transactionDate,
                            //"transactionDate" => $memberList->memberMobileNo,
                        );
                $imageList= $this->Common_model->fetch_data('imageTransaction','id,image',['transactionId'=>$id]);
          		foreach ($imageList as $key =>$imageLists) {
                            $paymentData['imageList'][$key] = array(
                                    "id" => $imageLists->id,
                                    "image" => 'http://yogeshgaur.in/hisabpe/public/transaction/'.$imageLists->image
                               ); 
                }


          		//$paymentData['imageList']=$imageList;



           $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT,['paymentData'=>$paymentData]);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
         }
    } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }      
    }




    public function transactionHistory_post(){
         error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
            $paymentData=array();
            $addTransaction = $this->Common_model->fetch_data('addTransaction','*', array('userId' => $auth['userId']));
            if($addTransaction){    
                foreach ($addTransaction as $key =>$transactionList) {
                            $paymentData[$key] = array(
                                    "userId" => $transactionList->userId,
                                    "customerId" => $transactionList->customerId,
                                    "paymentId" => $transactionList->id,
                                    "payment" => $transactionList->payment,
                                    "paymentType" => $transactionList->paymentType,
                                    "description" => $transactionList->description,
                                    "image" => $transactionList->image,
                                    "transactionDate" => $transactionList->transactionDate,
                               ); 
                }
              }
    
            if($addTransaction){
                $this->webserviceResponse(SUCCESS_CODE, GROUP_LIST_SUCCESS,['paymentDataList'=>$paymentData]);   
            }else{
                $this->webserviceResponse(UNSUCCESS_CODE, GROUP_LIST_FAILED);  
            }
    }

    public function customerTransactionHistory_post(){
         error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
        $paymentData=array();
        //print_r($postDataArr);	    

        $addTransaction = $this->Common_model->fetch_data('addTransaction','*', array('customerId' => $postDataArr['customerId']));

            if($addTransaction){    
                foreach ($addTransaction as $key =>$transactionList) {

                            $paymentData[] = array(
                                    "userId" => $transactionList->userId,
                                    "transactionId" => $transactionList->id,
                                    "customerId" => $transactionList->customerId,
                                    "transactionType" => $transactionList->transactionType,
                                    "transactionSubType" => $transactionList->transactionSubType,
                                    "amount" => $transactionList->amount,
                                    "balanceAmount" => $transactionList->balanceAmount,
                                    "image" => $this->Common_model->fetch_data1('imageTransaction','id,image',['transactionId'=>$transactionList->id]),
                                    "transactionDate" => $transactionList->transactionDate,
                                    "notes" => $transactionList->notes,
                                    "createdDate" => strtotime($transactionList->createdDate),
                               ); 


                            


                }
              }
    
            if($addTransaction){
                $this->webserviceResponse(SUCCESS_CODE, GROUP_LIST_SUCCESS,['paymentDataList'=>$paymentData]);   
            }else{
                $this->webserviceResponse(SUCCESS_CODE, GROUP_LIST_SUCCESS,['paymentDataList'=>[]]);
            }
    }



    public function updateMember_post(){
         error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
           /*print_r($auth); die;*/
            $postDataArr = $this->input->post();
     if ($this->form_validation->run("api/updateGroup") == true) {       
        $postDataArr['id']=$postDataArr['memberId'];
        unset($postDataArr['memberId']);
        $participants= $this->Common_model->update_single('addMemberInGroup',$postDataArr,['groupId'=> $postDataArr['groupId'],'id'=> $postDataArr['id']]);
         if($participants){
                $this->webserviceResponse(SUCCESS_CODE, UPDATE_SUCCESS);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, UPDATE_FAILED);  
         }
    } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }      
    }

    /*********  token(header), name, mobileNo, photo, address */

     public function updateUpdateContact_post(){
        error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
           /*print_r($auth); die;*/
            $postDataArr = $this->input->post();
     if ($this->form_validation->run("api/addContact") == true) {       
        
        /*$postDataArr['id']=$postDataArr['memberId'];
        unset($postDataArr['memberId']); */
        $postDataArr['id']=1;

        $participants= $this->Common_model->update_single('contactList',$postDataArr,['id'=> $postDataArr['id']]);
         if($participants){
                $this->webserviceResponse(SUCCESS_CODE, UPDATE_SUCCESS);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, UPDATE_FAILED);  
         }
    } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }
   }




   public function Item_post(){
     error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
           /*print_r($auth); die;*/
        $postDataArr = $this->input->post();
        $item= $this->Common_model->insert_single('item',$postDataArr);
        if($item){
                $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
         }
    } 

   public function addContact_post(){
        error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
          /*print_r($auth); die;*/
        $postDataArr['memberId'] = $auth['userId'];
     if ($this->form_validation->run("api/addContact") == true) { 
        unset($postDataArr['transactionDate']);      
        unset($postDataArr['amount']);      


if($this->Common_model->selectData('contactList','*', array('mobileNumber' =>$postDataArr['mobileNumber']))){
	$this->webserviceResponse(SUCCESS_CODE, MOBILE_EXIST);  
}else{

       $participants=  $this->Common_model->insert_single('contactList',$postDataArr);
       $contactDatasvalue=$this->Common_model->selectData('contactList','*', array('id' =>$participants),$or_where = false,'id','DESC', $grpby = false, $whstr_in = false, $lmt = false);

      // print_r($contactDatasvalue);
       
      $contactDatas=array();
      $contactDatas['id']=$contactDatasvalue['0']->id;
      $contactDatas['name']=$contactDatasvalue['0']->name;
      $contactDatas['mobileNumber']=$contactDatasvalue['0']->mobileNumber;
      $contactDatas['address']=$contactDatasvalue['0']->address;
    $contactDatas['transactionDate']=strtotime($contactDatasvalue['0']->createdDate);
      $contactDatas['amount']="0.0";

         if($participants){
                $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT,['contactData'=>$contactDatas]);   
         }else{
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
         }
        } 
    } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }
   }


    public function contactList_post(){
        error_reporting(0);
        $postDataArr = json_decode(file_get_contents("php://input"), true);
        $_POST = json_decode(file_get_contents("php://input"), true);
        $auth = $this->checkheader();
        $contactList=array();
        
            
        $mobileNumber = $this->Common_model->selectData('contactList','*', array('mobileNumber' => $postDataArr['mobileNumber']),$or_where = false,'id','DESC', $grpby = false, $whstr_in = false, $lmt = false);
            
        $contactList = $this->Common_model->selectData('contactList','*', array('memberId' => $auth['userId']),$or_where = false,'id','DESC', $grpby = false, $whstr_in = false, $lmt = false);

        if($mobileNumber){
            $this->webserviceResponse(SUCCESS_CODE, GROUP_LIST_SUCCESS,['contactList'=>'this mobile no already exists']);   
        }else{

        if($contactList){    
    
             foreach ($contactList as $key =>$contactLists) {
                	
          $lastTransaction=$this->Common_model->selectData('addTransaction','*', array('customerId' => $contactLists->id),$or_where = false,'id','DESC', $grpby = false, $whstr_in = false, $lmt = false);


          	if($lastTransaction[0]->amount){
          		$amount=$lastTransaction[0]->balanceAmount;
          	}else{
          		$amount=0;
          	}

          	$transactionDate=$lastTransaction[0]->transactionDate;
          	

                            $contactList[$key] = array(
                                    "id" => $contactLists->id,
                                    "name" => $contactLists->name,
                                    "mobileNumber" => $contactLists->mobileNumber,
                                    "photo" => $contactLists->photo,
                                    "address" => $contactLists->address,
                                    //"memberId" => $contactLists->memberId,
                                    "transactionDate" =>$transactionDate,
                                    "amount" =>$amount,
                                    //"amount" =>$contactLists->amount,
                                ); 
                }

              }

         if($contactLists){
                $this->webserviceResponse(SUCCESS_CODE, GROUP_LIST_SUCCESS,['contactList'=>$contactList]);   
            }else{
                //$this->webserviceResponse(UNSUCCESS_CODE, GROUP_LIST_FAILED);  
                $this->webserviceResponse(SUCCESS_CODE, GROUP_LIST_FAILED);  

            }

        }
    

    }


}