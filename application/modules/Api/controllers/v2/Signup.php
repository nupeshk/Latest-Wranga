<?php
require APPPATH . 'modules/Api/controllers/v1/Base_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Api-signup
 *
 * @author brainmobi
 */
class Signup extends Base_Controller {

    public function __construct() {
     parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
    }

    public function index_get() {
        echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>".SITE_TITLE."</span></h1>";
    }

public function index_post() {
        $postDataArr = $this->post();
        if ((!is_null($postDataArr)) && sizeof($postDataArr) > 0) {
            $response = $this->signup($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = '401';
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }

    
    
    public function signup($postDataArr) {


                if($postDataArr['socialid']==1 || $postDataArr['socialid']==2){
                    
                    if ($this->form_validation->run("api/v1/signup2") == true) {
                         $user = $this->Common_model->fetch_data('users','*', array('email' => $postDataArr['email']), true);  
                         if (!$user) {

$postDataArr['email'] = (isset($postDataArr['email']) && !empty($postDataArr['email'])) ? $postDataArr['email'] :"";
$postDataArr['name'] = (isset($postDataArr['name']) && !empty($postDataArr['name'])) ? $postDataArr['name'] :"";
$postDataArr['password'] = (isset($postDataArr['password']) && !empty($postDataArr['password'])) ? $postDataArr['password'] :"";
$postDataArr['socialid'] = (isset($postDataArr['socialid']) && !empty($postDataArr['socialid'])) ? $postDataArr['socialid'] :"";
$postDataArr['longitude'] = (isset($postDataArr['longitude']) && !empty($postDataArr['longitude'])) ? $postDataArr['longitude'] :"";
$postDataArr['deviceId'] = (isset($postDataArr['deviceId']) && !empty($postDataArr['deviceId'])) ? $postDataArr['deviceId'] :"";
$postDataArr['latitude'] = (isset($postDataArr['latitude']) && !empty($postDataArr['latitude'])) ? $postDataArr['latitude'] :"";


                $data = array(
                    "email" => $postDataArr['email'],
                    "name" => $postDataArr['name'],
                    "password" => $postDataArr['password'],
                    "socialid" => $postDataArr['socialid'],
                    "longitude" => $postDataArr['longitude'],
                    "deviceId" => $postDataArr['deviceId'],
                    "latitude" => $postDataArr['latitude'],
                    "createdDate" => getTodayDate()
                );
                //printArr($data );
                $userId = $this->User_model->insert($data);
                if ($userId) {
                    $token = generateToken();
                    $token_data = array();
                    $token_data['token'] = $token;
                    $token_data['userId'] = $userId;
                //    $token_data['deviceId'] = $postDataArr['deviceId'];
                //    $token_data['deviceType'] = $postDataArr['deviceType'];
                    $this->Authtoken_model->insert($token_data);
                    
                    $user = $this->Common_model->fetch_data('users','*', array('userId' =>  $userId), true);   

                         
                
                     $userDetail = array(
                        "token"=> $token,
                        "email" => $user[0]->email,
                        "name" => $user[0]->name,
                        "userId" => $userId,
                        "socialid" => $user[0]->socialid,
                        "longitude" => $user[0]->longitude,
                        "deviceId" => $user[0]->deviceId
                    );
                    
                    $userDetail['kidsData']=[];
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = '200';
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = SIGNUP_SUCCESS;
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);
                }
            } else {
                $errorMsgArr = array();
                $errorMsgArr['code'] = '401';
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = EMAIL_EXIST;
                 $errorMsgArr['data'] =(object) array();
                $this->response($errorMsgArr);
            }


                    }else{
                         $error = $this->form_validation->error_array();
                        $errorMsgArr = array();
                        $errorMsgArr['code'] = '401';
                        $errorMsgArr['status'] = 'error';
                        $errorMsgArr['message'] = PARAM_MISSING;
                         $errorMsgArr['data'] =(object) array();
                        $errorMsgArr['error'] = $error;
                        $this->response($errorMsgArr);    
                   }     
             }else{      

        if ($this->form_validation->run("api/v1/signup") == true) {
                
                    $user = $this->Common_model->fetch_data('users','*', array('email' => $postDataArr['email']), true);   


          if (!$user) {

$postDataArr['email'] = (isset($postDataArr['email']) && !empty($postDataArr['email'])) ? $postDataArr['email'] :"";
$postDataArr['name'] = (isset($postDataArr['name']) && !empty($postDataArr['name'])) ? $postDataArr['name'] :"";
$postDataArr['password'] = (isset($postDataArr['password']) && !empty($postDataArr['password'])) ? $postDataArr['password'] :"";
$postDataArr['socialid'] = (isset($postDataArr['socialid']) && !empty($postDataArr['socialid'])) ? $postDataArr['socialid'] :"";
$postDataArr['longitude'] = (isset($postDataArr['longitude']) && !empty($postDataArr['longitude'])) ? $postDataArr['longitude'] :"";
$postDataArr['deviceId'] = (isset($postDataArr['deviceId']) && !empty($postDataArr['deviceId'])) ? $postDataArr['deviceId'] :"";
$postDataArr['latitude'] = (isset($postDataArr['latitude']) && !empty($postDataArr['latitude'])) ? $postDataArr['latitude'] :"";


                $data = array(
                    "email" => $postDataArr['email'],
                    "name" => $postDataArr['name'],
                    "password" => $postDataArr['password'],
                    "socialid" => $postDataArr['socialid'],
                    "longitude" => $postDataArr['longitude'],
                    "deviceId" => $postDataArr['deviceId'],
                    "latitude" => $postDataArr['latitude'],
                    "createdDate" => getTodayDate()
                );
                //printArr($data );
                $userId = $this->User_model->insert($data);
                if ($userId) {
                    $token = generateToken();
                    $token_data = array();
                    $token_data['token'] = $token;
                    $token_data['userId'] = $userId;
                //    $token_data['deviceId'] = $postDataArr['deviceId'];
                //    $token_data['deviceType'] = $postDataArr['deviceType'];
                    $this->Authtoken_model->insert($token_data);
                    
                    $user = $this->Common_model->fetch_data('users','*', array('userId' =>  $userId), true);   

                         
               	
					 $userDetail = array(
					 	"token"=> $token,
                        "email" => $user[0]->email,
                        "name" => $user[0]->name,
                        "userId" => $userId,
						"socialid" => $user[0]->socialid,
                        "longitude" => $user[0]->longitude,
                        "deviceId" => $user[0]->deviceId
                    );
					
                    $userDetail['kidsData']=[];
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = '200';
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = SIGNUP_SUCCESS;
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);
                }
            } else {
                $errorMsgArr = array();
                $errorMsgArr['code'] = '401';
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = EMAIL_EXIST;
                 $errorMsgArr['data'] =(object) array();
                $this->response($errorMsgArr);
            }
        } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = '401';
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
             $errorMsgArr['data'] =(object) array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }
    }

}



    
    public function profile($postDataArr) {
        if ($postDataArr['userId'] != '') {
            if ($postDataArr['fbId'] == '') {
                $user = $this->Common_model->fetch_data('users', '', array('where' => array('id' => $postDataArr['userId'])), true);
                if ($user) {
                    //echo "<pre>";print_r($_FILES);die;
                    if (isset($_FILES['userImage']['name']) AND ! empty($_FILES['userImage']['tmp_name']) && exif_imagetype($_FILES['userImage']['tmp_name']) != FALSE) {
                        if ($_FILES['userImage']['type'] == 'image/jpeg' || $_FILES['userImage']['type'] == 'image/gif' || $_FILES['userImage']['type'] == 'image/png') {
                            $imageName = $_FILES['userImage']['tmp_name'];
                            list($name, $ext) = explode(".", $_FILES['userImage']['name']);
                            $filename = time() . rand() . '.' . $ext;
                            $path = base_url() . 'public/upload/user_profile/';
                            $path1 = getcwd() . '/public/upload/user_profile/';
                            $fullPath = $path . $filename;
                            $fullPath1 = $path1 . $filename;
                            $a = move_uploaded_file($imageName, $fullPath1);
                            if ($filename) {
                                $postDataArr['userImage'] = $fullPath;
                            }
                        }
                    }
                    if (isset($postDataArr['fbImage']) && $postDataArr['fbImage'] != "") {
                        $type = exif_imagetype($postDataArr['fbImage']);
                        if ($type == "2") {
                            $ext = "jpg";
                        } else if ($type == "3") {
                            $ext = "png";
                        }
                        $time = time();
                        copy($postDataArr['fbImage'], getcwd() . '/public/upload/user_profile/' . $time . "." . $type);
                        $postDataArr['userImage'] = base_url() . 'public/upload/user_profile/' . $time . '.' . $type;
                    }

                    $sessionId = chr(mt_rand(ord('a'), ord('z'))) . substr(md5(time()), 1);

                    $data = array(
                        "email" => isset($postDataArr['email']) ? $postDataArr['email'] : "",
                        "username" => isset($postDataArr['username']) ? $postDataArr['username'] : "",
                        "fullName" => isset($postDataArr['fullName']) ? $postDataArr['fullName'] : "",
                        "dob" => isset($postDataArr['dob']) ? $postDataArr['dob'] : "",
                        "location" => isset($postDataArr['location']) ? $postDataArr['location'] : "",
                        "phone" => isset($postDataArr['phone']) ? $postDataArr['phone'] : "",
                        "userImage" => isset($postDataArr['userImage']) ? $postDataArr['userImage'] : "",
                        "sessionId" => $sessionId,
                        "loginTime" => date('Y-m-d H:i:s'),
                        "status" => '1',
                        "userDeviceType" => $postDataArr['userDeviceType'],
                        "userDeviceToken" => $postDataArr['userDeviceToken'],
                    );
                    $this->Common_model->update_single('users', $data, array('where' => array('id' => $user['id'])));

                    $userDetail = array(
                        "email" => isset($postDataArr['email']) ? $postDataArr['email'] : "",
                        "username" => isset($postDataArr['username']) ? $postDataArr['username'] : "",
                        "fullName" => isset($postDataArr['fullName']) ? $postDataArr['fullName'] : "",
                        "dob" => isset($postDataArr['dob']) ? $postDataArr['dob'] : "",
                        "location" => isset($postDataArr['location']) ? $postDataArr['location'] : "",
                        "phone" => isset($postDataArr['phone']) ? $postDataArr['phone'] : "",
                        "userImage" => isset($postDataArr['userImage']) ? $postDataArr['userImage'] : "",
                        "voletAmount" => '$0',
                        "sessionId" => $sessionId,
                        "userId" => $user['id']
                    );

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = "SIGNUP_SUCCESS";
                    $errorMsgArr['message'] = is_register;
                    $errorMsgArr['VALUE'] = $userDetail;
                    $this->response($errorMsgArr);
                } else {
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = UNSUCCESS_code;
                    $errorMsgArr['status'] = "LOGIN_ERROR";
                    $errorMsgArr['message'] = not_exist;
                    $this->response($errorMsgArr);
                }
            } else {
                $user = $this->Common_model->fetch_data('users', '', array('where' => array('email' => $postDataArr['email'])), true);
                if (!$user) {
                    $user = $this->Common_model->fetch_data('users', '', array('where' => array('username' => $postDataArr['username'])), true);
                    if (!$user) {
                        if (isset($_FILES['userImage']['name']) AND ! empty($_FILES['userImage']['tmp_name']) && exif_imagetype($_FILES['userImage']['tmp_name']) != FALSE) {
                            if ($_FILES['userImage']['type'] == 'image/jpeg' || $_FILES['userImage']['type'] == 'image/gif' || $_FILES['userImage']['type'] == 'image/png') {
                                $imageName = $_FILES['userImage']['tmp_name'];
                                list($name, $ext) = explode(".", $_FILES['userImage']['name']);
                                $filename = time() . rand() . '_' . $_FILES['userImage']['name'];
                                $path = base_url() . 'public/upload/user_profile/';
                                $path1 = getcwd() . '/public/upload/user_profile/';
                                $fullPath = $path . $filename;
                                $fullPath1 = $path1 . $filename;
                                $a = move_uploaded_file($imageName, $fullPath1);
                                if ($filename) {
                                    $postDataArr['userImage'] = $fullPath;
                                }
                            }
                        }
                        if (isset($postDataArr['fbImage']) && $postDataArr['fbImage'] != "") {
                            $type = exif_imagetype($postDataArr['fbImage']);
                            if ($type == "2") {
                                $ext = "jpg";
                            } else if ($type == "3") {
                                $ext = "png";
                            }
                            $time = time();
                            copy($postDataArr['fbImage'], getcwd() . '/public/upload/user_profile/' . $time . "." . $type);
                            $postDataArr['userImage'] = base_url() . 'public/upload/user_profile/' . $time . '.' . $type;
                        }

                        $sessionId = chr(mt_rand(ord('a'), ord('z'))) . substr(md5(time()), 1);

                        $data = array(
                            "email" => isset($postDataArr['email']) ? $postDataArr['email'] : "",
                            "username" => isset($postDataArr['username']) ? $postDataArr['username'] : "",
                            "fullName" => isset($postDataArr['fullName']) ? $postDataArr['fullName'] : "",
                            "dob" => isset($postDataArr['dob']) ? $postDataArr['dob'] : "",
                            "location" => isset($postDataArr['location']) ? $postDataArr['location'] : "",
                            "phone" => isset($postDataArr['phone']) ? $postDataArr['phone'] : "",
                            "userImage" => isset($postDataArr['userImage']) ? $postDataArr['userImage'] : "",
                            "sessionId" => $sessionId,
                            "loginTime" => date('Y-m-d H:i:s'),
                            "status" => '1',
                            "userDeviceType" => $postDataArr['userDeviceType'],
                            "userDeviceToken" => $postDataArr['userDeviceToken'],
                        );
                        $this->Common_model->update_single('users', $data, array('where' => array('id' => $postDataArr['userId'])));

                        $userDetail = array(
                            "email" => isset($postDataArr['email']) ? $postDataArr['email'] : "",
                            "username" => isset($postDataArr['username']) ? $postDataArr['username'] : "",
                            "fullName" => isset($postDataArr['fullName']) ? $postDataArr['fullName'] : "",
                            "dob" => isset($postDataArr['dob']) ? $postDataArr['dob'] : "",
                            "location" => isset($postDataArr['location']) ? $postDataArr['location'] : "",
                            "phone" => isset($postDataArr['phone']) ? $postDataArr['phone'] : "",
                            "userImage" => isset($postDataArr['userImage']) ? $postDataArr['userImage'] : "",
                            "sessionId" => $sessionId,
                            "userId" => $postDataArr['userId']
                        );

                        $errorMsgArr = array();
                        $errorMsgArr['code'] = 200;
                        $errorMsgArr['status'] = "SIGNUP_SUCCESS";
                        $errorMsgArr['message'] = is_register;
                        $errorMsgArr['VALUE'] = $userDetail;
                        $this->response($errorMsgArr);
                    } else {
                        $errorMsgArr = array();
                        $errorMsgArr['code'] = UNSUCCESS_code;
                        $errorMsgArr['status'] = STATUS_INVALID;
                        $errorMsgArr['message'] = username_exist;
                        $this->response($errorMsgArr);
                    }
                } else {
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = UNSUCCESS_code;
                    $errorMsgArr['status'] = STATUS_INVALID;
                    $errorMsgArr['message'] = email_exist;
                    $this->response($errorMsgArr);
                }
            }
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_code;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = require_param;
            $this->response($errorMsgArr);
        }
    }

    public function facebook($postDataArr) {

        if ($this->form_validation->run("api/fbregistration") == true) {
			
            $flag = false;
            if ($postDataArr['facebookId'] != '') {
                $user = $this->User_model->getdata(array(), array('facebookId' => $postDataArr['facebookId']), true);
                if ($user) {
                    $flag = true;
                } else if(isset($postDataArr['email']) && !empty($postDataArr['email'])){
                    $flag = false;
                    $user = $this->User_model->getdata(array(), array('email' => $postDataArr['email']), true);
                    if ($user) {
                        $flag = true;
                    } else {
                        $flag = false;
                    }
                } else {
					$errorMsgArr = array();
					$errorMsgArr['code'] = UNSUCCESS_CODE;
					$errorMsgArr['status'] = STATUS_INVALID;
					$errorMsgArr['message'] = PARAM_MISSING;
					$this->response($errorMsgArr);
				}
            }

            //var_dump($flag);
            //printArr($user);
            if ($flag) {
                
                $userId = $user['userId'];
                $postDataArr['deviceId'] = (isset($postDataArr['deviceId']) && !empty($postDataArr['deviceId'])) ? $postDataArr['deviceId'] :"";
                $update = array();
                $update['updatedDate'] = getTodayDate();
                $update["deviceId"] = $postDataArr['deviceId'];
                $update["deviceType"] = $postDataArr['deviceType'];
                $update["facebookId"] = $postDataArr['facebookId'];
                $update['lastLogin'] = getTodayDate();
                
                $imageUrl = 'https://graph.facebook.com/'.$postDataArr['facebookId'].'/picture?type=large';
                //$imageUrl = $postDataArr['photo'];
                $uploadPath = PUBLIC_PATH . PROFILE_PATH;
                $thumImagePath = PUBLIC_PATH . PROFILE_THUMB_PATH;
                $filename = time() . "_" . $userId . ".jpg";
                
                $uploded = $this->uploadImageFacebookURL($filename, $imageUrl, $uploadPath, $thumImagePath, $width = 150, $height = 150);
                if($uploded){
                    $update["photo"] = $filename;
                }
                $this->User_model->update(array('userId' => $userId), $update);

                $token = generateToken();

                $token_data = array();
                $token_data['token'] = $token;
                $token_data['userId'] = $userId;
                $token_data['deviceId'] = $postDataArr['deviceId'];
                $token_data['deviceType'] = $postDataArr['deviceType'];
                $this->Authtoken_model->insert($token_data);

                $login_data = array();
                $login_data['userId'] = $userId;
                $this->Login_detail_model->insert($login_data);
                
                $user = $this->User_model->getdata(array(), array('userId' => $userId), true);
                $userDetail = array('userId' => $userId,
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'facebookId' => $user['facebookId'],
                    'status' => (($user['status'] == '1') ? true : false),
                    'token' => encrypt($token),
                );
                /* @var $user type */
                if (!empty($user["photo"])) {
                    $userDetail["photo"] = PROFILE_PATH . $user["photo"];
                    $userDetail["thumbPhoto"] = PROFILE_THUMB_PATH . $user["photo"];
                } else {
                    $userDetail["photo"] = "";
                    $userDetail["thumbPhoto"] = "";
                }

                //echo "<pre>";print_r($userDetail);die;
                $errorMsgArr = array();
                $errorMsgArr['code'] = SUCCESS_CODE;
                $errorMsgArr['status'] = STATUS_SUCCESS;
                $errorMsgArr['message'] = LOGIN_SUCCESS;
                $errorMsgArr['data'] = $userDetail;
                $this->response($errorMsgArr);
            } else {
                
                $data = array(
                    "email" => $postDataArr['email'],
                    "name" => $postDataArr['name'],
                    "deviceId" => $postDataArr['deviceId'],
                    "deviceType" => $postDataArr['deviceType'],
                    "facebookId" => $postDataArr['facebookId'],
                    "signupMedium" => "fb",
                    "status" => "1",
                    "createdDate" => getTodayDate(),
                    "lastLogin" => getTodayDate()
                );
                //printArr($data );
                $userId = $this->User_model->insert($data);
                
                $imageUrl = 'https://graph.facebook.com/'.$postDataArr['facebookId'].'/picture?type=large';
                //$imageUrl = $postDataArr['photo'];
                $uploadPath = PUBLIC_PATH . PROFILE_PATH;
                $thumImagePath = PUBLIC_PATH . PROFILE_THUMB_PATH;
                $filename = time() . "_" . $userId . ".jpg";
                
                $uploded = $this->uploadImageFacebookURL($filename, $imageUrl, $uploadPath, $thumImagePath, $width = 150, $height = 150);
                if($uploded){
                    $update["photo"] = $filename;
                }
                $this->User_model->update(array('userId' => $userId), $update);
                $token = generateToken();

                $token_data = array();
                $token_data['token'] = $token;
                $token_data['userId'] = $userId;
                $this->Authtoken_model->insert($token_data);

                $login_data = array();
                $login_data['userId'] = $userId;
                $this->Login_detail_model->insert($login_data);
                
                
                $userDetail = array(
                    "email" => $postDataArr['email'],
                    "name" => $postDataArr['name'],
                    "status" => true,
                    "userId" => $userId,
					"signupMedium" => "fb",
                    "facebookId" =>$postDataArr['facebookId'],
                    'token' => encrypt($token),
                );
                
                if(!empty($update["photo"])) {
                    $userDetail["photo"] = PROFILE_PATH . $filename;
                    $userDetail["thumbPhoto"] = PROFILE_THUMB_PATH . $filename;
                } else {
                    $userDetail["photo"] = "";
                    $userDetail["thumbPhoto"] = "";
                }
                
                /* $email = $postDataArr['email'];
                  $activate = base64_encode(base64_encode($email . "#####" . $userId . "#####" . $otp));
                  $url = base_url() . "activate?key=" . $activate;

                  $mailTo = $postDataArr['email'];
                  $nameTo = $postDataArr['name'];
                  $subject = 'Welcome to quikCatalog';
                  $message = "Welcome to 'QuikCatalog' and thanks for registering! Please  <a href='" . $url . "' target='blank'><b>Click Here</b></a> for activating your account.<br>";


                  $TemplatePath = "";
                  $TemplatePath = file_get_contents(getcwd() . "/public/templates/common_emailer.php");
                  $TemplatePath = str_replace("[NAME]", ucfirst($postDataArr['name']), $TemplatePath);
                  $TemplatePath = str_replace("[MESSAGE]", $message, $TemplatePath);
                  sendmailsmtp("info@quikcatalog.com", "quikCatalog", $mailTo, $nameTo, $replyTo = "noreply@quikcatalog.com", $replyName = "quikCatalog", $subject, $TemplatePath);
                 */
				 
                $errorMsgArr = array();
                $errorMsgArr['code'] = SUCCESS_CODE;
                $errorMsgArr['status'] = STATUS_SUCCESS;
                $errorMsgArr['message'] = SIGNUP_SUCCESS;
                $errorMsgArr['data'] = $userDetail;
                $this->response($errorMsgArr);
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


}
