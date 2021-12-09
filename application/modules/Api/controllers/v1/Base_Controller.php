<?php

require APPPATH . 'libraries/REST_Controller.php';

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
class Base_Controller extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Authtoken_model');
        $this->load->model('Common_model');
        $this->load->model('User_model');
        $this->load->helper('common');
    }

    /**
     * Index function
     *
     * @access	public
     */
    public function index_get() {
        echo "<h1 style='margin-left:41%;margin-top:20%;font-color:#641F11;'><span style='font-size:50px;'>".SITE_TITLE."</span></h1>";
    }

   public function checkheader() {
        //$request = $this->head();
        $request = getallheaders();
        /*print_r($request); 
        die;*/

        if (isset($request["Token"])) {
            $authorizationHeader = $request["Token"];
            if ($authorizationHeader == null || $authorizationHeader == '') {
                $errorMsgArr = array();
                $errorMsgArr['code'] = AUTH_FAIL_CODE;
                $errorMsgArr['status'] = STATUS_INVALID;
                $errorMsgArr['message'] = TOKEN_EMPTY;
                $this->response($errorMsgArr);
            }
            try {
        $outhKeyArr = $this->Authtoken_model->getAuthData(array(), array('token' => $authorizationHeader), true);
               
                if ($outhKeyArr) {
                    //print_r($outhKeyArr); die;
                    $userId = $outhKeyArr['userId'];
                    //$col = array("userId", "name", "email");
                    //$userArr = $this->User_model->getUserData($col, array('userId' => $userId), true);
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = SUCCESS_CODE;
                    $errorMsgArr['status'] = STATUS_SUCCESS;
                    $errorMsgArr['message'] = AUTH_SUCCESS;
                    $errorMsgArr['userId'] = $userId;
                    $errorMsgArr['token'] = $request["Token"];
                    return $errorMsgArr;
                } else {
                    $errorMsgArr = array();
                    $errorMsgArr['code'] = AUTH_FAIL_CODE;
                    $errorMsgArr['status'] = STATUS_INVALID;
                    $errorMsgArr['message'] = INVALID_TOKEN;
                    $this->response($errorMsgArr);
                }
            } catch (Exception $e) {
                $errorMsgArr = array();
                $errorMsgArr['code'] = AUTH_FAIL_CODE;
                $errorMsgArr['status'] = STATUS_INVALID;
                $errorMsgArr['message'] = INVALID_TOKEN;
                $this->response($errorMsgArr);
            }
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = AUTH_FAIL_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = TOKEN_EMPTY;
            $this->response($errorMsgArr);
        }
    }

    /* update token
     */

    public function updateToken($adminId, $deviceToken, $deviceType) {
        $token = generateToken();
        $exist = $this->Authtoken_model->getAuthData($coloumn = array(), $where = array("adminId" => $adminId, "deviceToken" => $deviceToken, true));
        if (!$exist) {
            $token_data = array();
            $token_data['token'] = $token;
            $token_data['adminId'] = $adminId;
            $token_data["deviceToken"] = $deviceToken;
            $token_data["deviceType"] = $deviceType;
            $token_data["createdDate"] = getTodayDate();
            //Here userId,token and deviceType will be insert in the authtoken table
            $this->Authtoken_model->insert($token_data);
        } else {
            $token_data = array();
            $token_data['token'] = $token;
            //$token_data['userId'] = $userId;
            //$token_data["deviceId"] = $deviceId;
            //$token_data["deviceType"] = $deviceType;
            $token_data["createdDate"] = getTodayDate();
            //Here userId,token and deviceType will be insert in the authtoken table
            $where = array("adminId" => $adminId, "deviceToken" => $deviceToken);
            $this->Authtoken_model->update($where, $token_data);
        }
        return $token;
    }

    
     /**
     * Web service response messages
     */
    public function webserviceResponse($code, $errorMessage, $result = array()) {
        $errorMsgArr = array();
        if ($code == 200) {
            $errorMsgArr['code'] = SUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_SUCCESS;
        } else {
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
        }
        if (is_array($errorMessage) && !empty($errorMessage)) {
            $error = array_values($errorMessage);
            $errorMsgArr['error'] = $errorMessage;
            $errorMsgArr['message'] = $error[0];
        } else if (empty($errorMessage)) {
            $errorMsgArr['message'] = INVALID_POST_DATA;
        } else {
            $errorMsgArr['message'] = $errorMessage;
        }
        if (!empty($result)) {
            $errorMsgArr = array_merge($errorMsgArr, $result);
        }
        $this->response($errorMsgArr);
    }

    // sanitize number

    public function sanitizeMobileNumber($number) {
        //$number = '+19650706465';
        $checkPlus = substr($number, 0, 1);
        if ($checkPlus == "+") {
            $number = ltrim($number, '+');
        }
        $checkone = substr($number, 0, 1);
        if ($checkone == "1") {
            $number = ltrim($number, '1');
        }
        return $number;
    }
	
	
	/* send sms after transaction
     * 
     */
      
    public function sendTransactionSMS($userId, $points, $quantity, $action){
		
		$where = array('userId' => $userId);
        $userData = $this->User_model->getUserData(array('firstName', 'userId', 'mobile', 'totalPoints'), $where, true);
        $mobile = "+91".$userData["mobile"];
        $totalPoints = $userData["totalPoints"];
        $firstName = ucfirst($userData["firstName"]);
        if($action == "add"){            
			//$message = $points . " points has been credited in your account";
			$message = "Dear ". $firstName . ", You have purchased ". $quantity . " liters at Pooja Filling Station Ambala Cantt. You have earned ". $points . " points. Your current balance is ". $totalPoints . ".";
		} else if($action == "redeem"){
			//$message = "You have redeemed ". $points . " points";
			$message = "Dear ". $firstName . ", You have redeemed ". $points . " points at Pooja Filling Station Ambala Cantt. Your current balance is ". $totalPoints . ".";
		}
        sendsms($mobile, $message);
	}
	
    /* get image url
     * 
     */

    public function getImageUrl($imageName, $type) {
        if ($type == "user") {
            $path = PUBLIC_ABS . PROFILE_PATH;
            $thumbPath = PUBLIC_ABS . PROFILE_THUMB_PATH;
            $fileExistPath = PUBLIC_PATH . PROFILE_PATH . $imageName;
        } else if ($type == "event") {
            $path = PUBLIC_ABS . EVENT_PATH;
            $thumbPath = PUBLIC_ABS . EVENT_THUMB_PATH;
            $fileExistPath = PUBLIC_PATH . EVENT_PATH . $imageName;
        } else if ($type == "banner") {
            $path = PUBLIC_ABS . BANNER_PATH;
            $thumbPath = PUBLIC_ABS . BANNER_THUMB_PATH;
            $fileExistPath = PUBLIC_PATH . BANNER_PATH . $imageName;
        }
        $image = array();
        if (!empty($imageName) && file_exists($fileExistPath)) {
            $image["image"] = base_url() . $path . $imageName;
            $image["thumbImage"] = base_url() . $thumbPath . $imageName;
        } else {
            $image["image"] = "";
            $image["thumbImage"] = "";
        }
        return $image;
    }

    /** Handling error codes of stripe 
     * 
     */
    public function handleStripeErrorCode($e) {
        $body = $e->getJsonBody();
        //print_r($body) . "\n";
        $err = $body['error'];
        /* print('Status is:' . $e->getHttpStatus() . "\n");
          print('Type is:' . $err['type'] . "\n");
          print('Code is:' . $err['code'] . "\n");
          // param is '' in this case
          print('Param is:' . $err['param'] . "\n");
          print('Message is:' . $err['message'] . "\n");
          die; */
          $errorMsgArr = array();
          $errorMsgArr['code'] = UNSUCCESS_CODE;
          $errorMsgArr['status'] = STATUS_INVALID;
          $errorMsgArr['message'] = $err['message'];
          $this->response($errorMsgArr);
      }

    /** Handling error codes of stripe 
     * 
     */
    public function handleExceptionErrorCode($e) {

        /* print('Status is:' . $e->getHttpStatus() . "\n");
          print('Type is:' . $err['type'] . "\n");
          print('Code is:' . $err['code'] . "\n");
          // param is '' in this case
          print('Param is:' . $err['param'] . "\n");
          print('Message is:' . $err['message'] . "\n");
          die; */
          $errorMsgArr = array();
          $errorMsgArr['code'] = UNSUCCESS_CODE;
          $errorMsgArr['status'] = STATUS_INVALID;
          $errorMsgArr['message'] = $e->getMessage();
          $this->response($errorMsgArr);
      }

    /**
     * upload image 
     * 
     * @access public
     * @return void
     * CREATED AT:22/02/2017
     */
    public function uploadImage($imageName = "image.jpg", $config = array(), $width = 150, $height = 150) {
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($imageName)) {
            $image_data = $this->upload->data();
            //printArr($image_data);
            //your desired config for the resize() function
            $this->load->library('image_lib');
            $config = array(
                'source_image' => $image_data['full_path'], //path to the uploaded image
                'new_image' => $image_data['file_path'] . "thumbs/", //path to
                'maintain_ratio' => true,
                'width' => $width,
                'height' => $height
            );
//printArr($config);
//this is the magic line that enables you generate multiple thumbnails
//you have to call the initialize() function each time you call the resize()
//otherwise it will not work and only generate one thumbnail
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
//printArr($image_data);
            return true;
        } else {
            $error = array('error' => $this->upload->display_errors());
//printArr($error);
            return false;
        }
    }

    /**
     * upload uploadFile 
     * 
     * @access public
     * @return void
     * CREATED AT:22/02/2017
     */
    public function uploadFile($imageName, $config = array()) {
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($imageName)) {
            $image_data = $this->upload->data();
            //printArr($image_data);
            //your desired config for the resize() function
            return true;
        } else {
            $error = array('error' => $this->upload->display_errors());
            //printArr($error);
            return false;
        }
    }

    /**
     * upload image from facebook url
     * 
     * @access public
     * @return void
     * CREATED AT:22/02/2017
     */
    public function uploadImageFacebookURL($filename, $imageURL, $imagePath, $thumImagePath, $width = 150, $height = 150) {
        $image = file_get_contents($imageURL);
        $file = $imagePath . $filename;
        $uploaded = file_put_contents($file, $image);
        if ($uploaded) {
            $this->load->library('image_lib');
            $config = array(
                'source_image' => $imagePath . $filename, //path to the uploaded image
                'new_image' => $thumImagePath, //path to
                'maintain_ratio' => true,
                'width' => $width,
                'height' => $height
            );
//printArr($config);
//this is the magic line that enables you generate multiple thumbnails
//you have to call the initialize() function each time you call the resize()
//otherwise it will not work and only generate one thumbnail
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            return true;
        } else {
            return false;
        }
    }

    public function uploadImageBase64($filename, $postReceiptImage, $imagePath, $thumImagePath, $width = 150, $height = 150) {
        $image = base64_decode($postReceiptImage);
        $file = $imagePath . $filename;
        $uploaded = file_put_contents($file, $image);
        if ($uploaded) {
            $this->load->library('image_lib');
            $config = array(
                'source_image' => $imagePath . $filename, //path to the uploaded image
                'new_image' => $thumImagePath, //path to
                'maintain_ratio' => true,
                'width' => $width,
                'height' => $height
            );
//printArr($config);
//this is the magic line that enables you generate multiple thumbnails
//you have to call the initialize() function each time you call the resize()
//otherwise it will not work and only generate one thumbnail
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            return true;
        } else {
            return false;
        }
    }
    
     /**
     * For sending mail
     *
     * @access	public
     * @param	string
     * @param	string
     * @param	string
     * @param	boolean
     * @return	array
     */
     public function sendmail($email, $subject, $message = false, $single = true) {
        $this->config->load('email');
        if ($single == true) {
            $this->load->library('email');
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => $this->config->item('smtp_host'), //'ssl://smtp.example.com',
                'smtp_port' => $this->config->item('smtp_port'), //465,
                'smtp_user' => $this->config->item('smtp_user'), //'email@example.com',
                'smtp_pass' => $this->config->item('smtp_pass'), //'email_password',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );
            $this->email->initialize($config);
        }

        $this->email->from($this->config->item('from'), $this->config->item('from_name'));
        $this->email->reply_to($this->config->item('repy_to'), $this->config->item('reply_to_name'));
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        //var_dump($this->email->send() ? true : false);die; 
        return $this->email->send() ? true : false;
    }

}
