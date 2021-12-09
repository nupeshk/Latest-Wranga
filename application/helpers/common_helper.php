<?php

/* * **********************
 * 
 * 
 * @AUTHOR: Mohd Shahid <shahidansari.bit@gmail.com>.
 * CREATED AT:10/02/2017
 * UPDATED AT:
 * Codiginiter    
 * ** */

/**
 * encrypt function.
 * 
 * @access public
 * @return void
 */
/* function encrypt($text, $salt = ENCRYPTION_KEY) {
  return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
  } */




function encrypt($str, $key = ENCRYPTION_KEY) {
    $key = hex2binary($key);
    $td = mcrypt_module_open("rijndael-128", "", "cbc", "fedcba9876543210");
    mcrypt_generic_init($td, $key, "fedcba9876543210");
    $encrypted = mcrypt_generic($td, $str);

    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    return bin2hex($encrypted);
}

/**
 * decrypt function.
 *
 * @access public
 * @return void
 */
/* function decrypt($text, $salt = ENCRYPTION_KEY) {
  $text = str_replace(" ", "+", $text);
  return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
  } */

function decrypt($code, $key = ENCRYPTION_KEY) {
    $key = hex2binary($key);
    $code = hex2binary($code);

    $td = mcrypt_module_open("rijndael-128", "", "cbc", "");

    mcrypt_generic_init($td, $key, "fedcba9876543210");
    $decrypted = mdecrypt_generic($td, $code);

    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    return utf8_encode(trim($decrypted));
}


/*if (!function_exists('getallheaders')) {
    function getallheaders() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
    }
}
*/


/** Additional function for encrypt and decrypt
 * 
 * * */
function hex2binary($hexdata) {
    $bindata = "";

    for ($i = 0; $i < strlen($hexdata); $i += 2) {
        $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
    }

    return $bindata;
}

/* * *
 * Get date 
 * 
 */

function getTodayDate() {
	date_default_timezone_set("Asia/Kolkata");
    $date = date('Y-m-d H:i:s');
    return $date;
}

function getMessage($userId, $tagName) {
    $msg = strtolower($tagName);
    $CI = & get_instance();
    $CI->load->helper('file');
    $messageArr = array();
    $string = read_file(PUBLIC_PATH . 'messages/file_' . $userId . '.txt');
    $messageData = json_decode($string, true);
    if($messageData){
      foreach ($messageData as $val) {
        $messageArr[$val["name"]] = $val["value"];
      }
    if (!empty($messageArr[$msg])) {
        return $messageArr[$msg];
    } else {
        return $tagName;
    }
  } else {
     return $tagName;
  }
}

/**
 * genrateToken
 * 
 * @access public
 * @return void
 * CREATED AT:10/02/2017
 */
function generateToken() {
    $token = chr(mt_rand(ord('a'), ord('z'))) . substr(md5(time()), 1);
    return $token;
}

/**
 * getRandomNumberfunction
 * 
 * @access public
 * @return void
 * CREATED AT:10/11/2016
 */
function getRandomNumber($endlength) {
    $alphabet = "123456789123456789123456789123456789123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 1; $i <= $endlength; $i++) {
        $n = rand(1, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

/* * *
 * numberFormat
 * CREATED AT:28/07/2019
 * 
 */
	
function numberFormat($number) {
    $english_format_number = number_format($number, 2, '.', '');
    return $english_format_number; //return formatted number
}

/***
 * price format 
 */
	function priceFormat($price){
		$rc = str_replace(",", "", $price);
		$newPrice = number_format((float)$rc, 2, '.', '');
		return $newPrice;	
	}
	
/* * *
 * generateTempPassword
 * CREATED AT:01/03/2017
 * 
 */

function generateBarcode($endlength) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $endlength; $i++) {
        $n = mt_rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

/* Check valid number from Twillio
 * Param: Phone number
 * 
 */

function checkValidMobileNumber($phoneNumber) {
    $CI = & get_instance();
    $CI->load->library('Twilio'); // load library 
    $account_sid = 'AC253eac6afeafc89daba9d02224911baa';  // live
    $auth_token = '62f639cf7d6b1820f6edd86e507a212d';
    $client = new Twilio\Rest\Client($account_sid, $auth_token);
    try {
        //$client = new Twilio\Rest\Client($account_sid, $auth_token);
        $number = $client->lookups
                ->phoneNumbers($phoneNumber)
                ->fetch(
                array("type" => array("carrier", "caller_name"))
        );

        //print_r ($number). "\r\n";
        //echo $number->caller_name["caller_name"] . "\r\n";
        //echo $number->caller-name["caller-type"] . "\r\n";
        //echo $number->carrier["type"] . "\r\n";
        //echo $number->carrier["name"];
        if ($number->carrier["type"] == "mobile") {
            return true;
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = "Invalid mobile number";
            return $errorMsgArr;
        }
    } catch (Twilio\Exceptions\RestException $e) {
        $errorMsgArr = array();
        $errorMsgArr['code'] = UNSUCCESS_CODE;
        $errorMsgArr['status'] = STATUS_INVALID;
        //$errorMsgArr['message'] = $e->getCode() . ' : ' . $e->getMessage();
        $errorMsgArr['message'] = "Invalid mobile number";
        return $errorMsgArr;
    }
}


/* function getallheaders() 
    { 
           $headers = ''; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       return $headers;
}*/


function sendsms($phoneNumber, $message) {
    $sender = "PJFSTN"; //"PJFSTN"; //TESTIN
    $authentication_key = "301247AdvJ3LBcLXbZ5db83547";
    $response = file_get_contents("https://api.msg91.com/api/sendhttp.php?mobiles=".$phoneNumber."&authkey=$authentication_key&route=4&sender=".$sender."&message=".urlencode($message)."&country=91");
    //$response = file_get_contents("http://103.247.98.91/API/SendMsg.aspx?uname=" . $user_id . "&pass=" . $password . "&send=" . $sender_id . "&dest=" . $phoneNumber . "&msg=" . urlencode($message));
    return $response;
}

/* Send SMS from Twillio
 * Param: Phone number, message
 * 
 */

function sendsms_old($phoneNumber, $message) {
    $user_id = 20181983;
    $password = "LEl0OR9j";
    $sender_id = "FLOWSP";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://103.247.98.91/API/SendMsg.aspx?uname=" . $user_id . "&pass=" . $password . "&send=" . $sender_id . "&dest=" . $phoneNumber . "&msg=" . $message . "&priority=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    /* if ($err) {
      echo "cURL Error #:" . $err;
      } else {
      echo $response;
      } */
    return $response;
}

/* function sendsms($phoneNumber, $message) {
  $CI = & get_instance();
  $CI->load->library('Twilio'); // load library

  $account_sid = 'ACf0c4fff11ad3a96cdf5e7e9cc6693dcf';  // live
  $auth_token = '096604ac380306b5e042ac1d63d78cf9';
  try {
  $client = new Twilio\Rest\Client($account_sid, $auth_token);
  $messages = $client->accounts($account_sid)
  ->messages->create($phoneNumber, array(
  'From' => "+14243257306",
  'Body' => $message,
  // 'statusCallback' => ""
  ));
  //print_r($messages); die;
  //echo $json = (string)$messages; die;
  } catch (Twilio\Exceptions\RestException $e) {
  //$body = $e->getJsonBody();
  echo $e->getMessage() . "\n";
  //echo $e->getCode() . ' : ' . $e->getMessage() . "<br>";
  //echo $e;
  die;
  }
  } */

/**
 * 
 * @param array $dataarray
 * @param type $userData
 */
function printArr($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    die;
}

/**
 * Send mail 
 * @param type $emailFrom
 * @param type $nameFrom
 * @param type $mailTo
 * @param type $nameTo
 * @param type $replyTo
 * @param type $replyName
 * @param type $subject
 * @param type $message
 * @return boolean
 */
function sendmailsmtp($emailFrom, $nameFrom, $mailTo, $nameTo, $replyTo = "noreply@quikcatalog.com", $replyName = "QuikCatalog", $subject, $message) {
    require 'public/PHPMailer/PHPMailerAutoload.php';

    //PHPMailer Object
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    /* $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      //$mail->SMTPDebug = 0;                               // Enable SMTP authentication
      $mail->Username = 'quikcatalog2017@gmail.com';                 // SMTP username
      $mail->Password = 'quikcatalog@2017';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 25; //25; //465; //587;                                    // TCP port to connect to
     */

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.imobisoft.uk';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'floyd@imobisoft.uk';                 // SMTP username
    $mail->Password = '9w-Rbk6er';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25; //465; //587;                                    // TCP port to connect to


    $mail->setFrom($emailFrom, $nameFrom);
    $mail->addAddress($mailTo, $nameTo);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('floyd@imobisoft.uk', 'Floyd App');
    $mail->addReplyTo($replyTo, $replyName);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }

    /* if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
      echo 'Message has been sent';
      } */
}

function sendAndroidPush($registration_ids, $message) {
    $url = 'https://android.googleapis.com/gcm/send';
    $fields = array(
        'registration_ids' => array($registration_ids),
        'data' => $message,
    );

    $headers = array(
        'Authorization:key=' . GOOGLE_API_KEY,
        'Content-Type: application/json'
    );
    //echo json_encode($fields); die;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);
    //var_dump($result); die;
    if ($result === false)
        die('Curl failed ' . curl_error());

    curl_close($ch);
    return $result;
}

function sendIphonePush($deviceToken, $payload) {
    try {

        //$apnsHost = 'gateway.push.apple.com';
        //$apnsCert = getcwd() . '/public/ck/apns-dev-cert.pem';

        $apnsHost = 'gateway.sandbox.push.apple.com';
        $apnsCert = getcwd() . '/public/ck/CertificatesPush.pem';

        $apnsPort = '2195';
        $passphrase = '12345';

        $streamContext = stream_context_create();
        $a = stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
        $a = stream_context_set_option($streamContext, 'ssl', 'passphrase', $passphrase);
        $apnsConnection = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);
        if ($apnsConnection == false) {
            echo "False";
            exit;
        }
        $payload = json_encode($payload);
        $token = str_replace(' ', '', $deviceToken);
        if (!empty($payload)) {
            $apnsMessage = chr(0) . pack("n", 32) . pack('H*', $token) . pack("n", strlen($payload)) . $payload;
            if (fwrite($apnsConnection, $apnsMessage)) {
                //echo "true"; die;
                return true;
            } else {
                //echo "false"; die;
                return false;
            }
        }
    } catch (Exception $e) {
        echo "<pre>";
        print_r($e);
        die;
    }
}

/*
  function sendActivationLink($where, $userData) {
  $user_email = $where['user_email'];
  $user_activation_key = createAccessToken();
  $activation_key_creation_time = date('Y-m-d H:i:s');

  $updateData['user_activation_key_creation_time'] = $activation_key_creation_time;
  $updateData['user_activation_key'] = $user_activation_key;
  $key = encrypt($user_email . "#####" . $user_activation_key . "#####" . $activation_key_creation_time);
  $accountActivateUrl = base_url() . 'user/auth/activate/?key=' . $key;

  $where = array('user_id' => $userData['user_id']);
  $CI = & get_instance();
  $CI->load->model('user_model');

  $CI->user_model->updateUser($where, $updateData);

  $to = $user_email;
  $msg = 'Hi ' . ',';
  $msg .= "<br><br>";
  $msg .= "<br>Here is your link. Please click the link below and verify your email address.";
  $msg.= '<br/><a href="' . $accountActivateUrl . '"> click here</a>';
  $msg .= '<br> “Please do not reply to this email.';
  $msg .= "<br><br>";
  $msg .="<br><br>Regards,<br>Perzue Team<br><br>";
  $subject = 'Perzue Activaion Link';
  phpMailerFunction($to, $subject, $msg);
  $data['response_key'] = '1';
  $data['response_message'] = "Activation link is send to your email address, Please Check your email";
  echo json_encode($data);
  } */

//Define SendNotification function using FCM

function sendFcmNotification($registrationIds, $dataArr) {
    $url = 'https://fcm.googleapis.com/fcm/send'; //Google URL
    //$registrationIds = explode(",", $registrationIds);
    //$registrationIds = array($registrationIds); //Fcm Device ids array
    //$registrationIds = array("eTSL9nIeKts:APA91bGm5KI5QTkIY4Tyt3KhB65DjfJFzey3WyXbfSCuMChxg8md9b47q2X8tjRu1o-_VLYJenZlZMz_DPQboNetG8VRq3EkmdqeXy2FP8E-3w8EWe1I9WpUDDyhcQi7FUuvE4H9I7PO"); //Fcm Device ids array
    //print_r($registrationIds); die;
    $fields = array('registration_ids' => $registrationIds, 'data' => $dataArr);
    //print_r($fields); die;
    $headers = array(
        'Authorization: key=' . FCM_API_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    // Execute post
    $result = curl_exec($ch);
    //var_dump($result); die;
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    // Close connection
    curl_close($ch);

    return $result;
}




