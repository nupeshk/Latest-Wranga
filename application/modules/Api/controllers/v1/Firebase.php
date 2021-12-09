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
class Firebase extends Base_Controller {

    public function __construct() {
        parent::__construct();
       /* $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
*/

    }


        public function index_get() {
        echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>".SITE_TITLE."</span></h1>";
    }

public function index_post() {
        $postDataArr = $this->post();
        if ((!is_null($postDataArr)) && sizeof($postDataArr) > 0) {
            $response = $this->send();
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }


public function getMassage($notificationBody,$notificationTitle,$notificationIcon,$dataTitle,$dataContentId,$dataImageUrl) {
        $res = array();
        $res['notification']['body'] = $notificationBody;
        $res['notification']['title'] = $notificationTitle;
        $res['notification']['icon'] = $notificationIcon;

        return $res;
    }



public function getAllTokens_get(){
        $tokens = array(); 
        while($token = $this->Common_model->fetch_data('wrng_fcm')){
            array_push($tokens, $token['fcmToken']);
        }
        print_r($tokens);
        //return $tokens; 
    }


  public function getAllTokens(){

      $tokens = array(); 
      $tokens = $this->Common_model->fetch_data('wrng_fcm'); 
               foreach ($tokens as $key => $value) {
                     $tokensDetail[] = $value->fcmToken;
                }  
        return $tokensDetail;
    }

// sending push message to single user by firebase reg id
    public function send() {
                    $postDataArr = $this->post();
                    $title=$postDataArr['title'];
                    $body=$postDataArr['body'];

                    $curl = curl_init();
                    $authKey = "key=AAAAw4nIoTk:APA91bEzPV2eHTx1OAreASxQYWkMX50dUV-5K_KGB_KDrdeoz5vTN8NGVlU6croKYLUdPp_RTOFu41AokWi8VqKhs2WvBwx83XbLl-e_u0KZhd4fFzj1CkBa5EBTCF5UgSOhW5iiWLYI";

              	$tokens = array(); 
      			$tokens = $this->Common_model->fetch_data('wrng_fcm'); 
	              foreach ($tokens as $key => $value) {
	                     $tokensDetail[] = $value->fcmToken;
	                }

                    $comma_separated = implode('","', $tokensDetail);
                    $registration_ids = '["'.$comma_separated.'"]';

                    
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => '{
                    "registration_ids": ' . $registration_ids . ',
                    "notification": {
                    "title": "'. $title . '",
                    "body": "' . $body . '"
                    }
                    }',
                    CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $authKey,
                    "Content-Type: application/json",
                    "cache-control: no-cache"
                    ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                    echo "cURL Error #:" . $err;
                    } else {
                    echo $response;
                    } 

    }
 
   
 
  
 
    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
       // require_once __DIR__ . '/config.php';
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
 
        return $result;
    }
    

   
}
