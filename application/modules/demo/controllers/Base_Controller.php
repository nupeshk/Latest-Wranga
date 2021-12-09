<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author Shabnam
 */
class Base_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('Ajax_pagination');
        $this->load->model('User_model');
        $this->load->model('Common_model');
        $this->load->helper('common');
        $this->perPage = 20;
        error_reporting(E_ALL);
    }

    /**
     * Index function
     *
     * @access	public
     */
    public function check_session() {
        //print_r($_SESSION); die;
        $adminLogin = $this->session->userdata('adminLogin');
        //print_r($adminLogin); die;
        if (!$adminLogin) {
            redirect('/admin');
        }
        return $adminLogin;
    }
    
    
    /* public function checkheader() {
      //$request = $this->head();
      $request = getallheaders();
      //print_r($request); die;
      $authorizationHeader = $request["token"];
      if ($authorizationHeader == null || $authorizationHeader == '') {
      $errorMsgArr = array();
      $errorMsgArr['code'] = AUTH_FAIL_CODE;
      $errorMsgArr['status'] = STATUS_INVALID;
      $errorMsgArr['message'] = TOKEN_EMPTY;
      $this->response($errorMsgArr);
      }
      try {
      $outhKeyArr = $this->Authtoken_model->getAuthData(array(), array('token' => decrypt($authorizationHeader)), true);
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
      } */
    
    
		public function xml_request($xml_data){
			$url = "http://b2b.cebeo.be/webservices/xml";
			
				$ch = curl_init($url);
				//curl_setopt($ch, CURLOPT_MUTE, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
				curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$output = curl_exec($ch);
				$err = curl_error($ch);
				/*if($err) {
			      echo "cURL Error #:" . $err;
			    } else {
			      //echo $output;
			    } */
				curl_close($ch);
				//print_r($output); die;
				$array_data = array();
				if($this->isValidXml($output)){
					$array_data = json_decode(json_encode(simplexml_load_string($output)), true);
				}
				return $array_data;
				
		}
		
		function isValidXml($content)
		{
			$content = trim($content);
			if (empty($content)) {
				return false;
			}
			//html go to hell!
			if (stripos($content, '<!DOCTYPE html>') !== false) {
				return false;
			}

			libxml_use_internal_errors(true);
			simplexml_load_string($content);
			$errors = libxml_get_errors();          
			libxml_clear_errors();  

			return empty($errors);
		}
		
		// get product data
		
		public function getProductData($SupplierItemID, $cols=array()){
			$where = array("where" => array('SupplierItemID' => $SupplierItemID));
            $productData = $this->Common_model->fetch_data("products", $cols, $where, true);
			return $productData;
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
            if ($type == "user") {
                $image["image"] = base_url() . PUBLIC_ABS . "images/noimg.png";
                $image["thumbImage"] = base_url() . PUBLIC_ABS . "images/noimg.png";
            } else {
                $image["image"] = base_url() . PUBLIC_ABS . "images/noimg.png";
                $image["thumbImage"] = base_url() . PUBLIC_ABS . "images/noimg.png";
            }
        }
        return $image;
    }
    
    /* get json response
     * 
     * * */

    public function jsonResponse($array) {
        echo json_encode($array);
        die;
    }
    
    /**
     * Get showing per page data on top
     * 
     */
    public function getShowingText($totalRec) {
        if ($totalRec == 0) {
            $pageInfo = "Showing 0-0 Of 0";
        } else if ($totalRec < $this->perPage) {
            $pageInfo = "Showing 1-" . $totalRec . " Of " . $totalRec;
        } else {
            //$pageInfo = "Showing 1-" . $this->perPage . " Of " . $totalRec;
            $pageInfo = "Showing 1-" . $totalRec . " Of " . $totalRec;
        }
        return $pageInfo;
    }

    /**
     * Get showing per page data on ajax page
     * 
     */
    public function getAjaxShowingText($page, $limit, $totalRec) {
        $start = $page + 1;
        $end = $page + $limit;
        if ($totalRec == 0) {
            $pageInfo = "Showing 0-0 Of 0";
        } else if ($totalRec < $this->perPage) {
            $pageInfo = "Showing " . $start . "-" . $totalRec . " Of " . $totalRec;
        } else if ($totalRec <= $end) {
            $pageInfo = "Showing " . $start . "-" . $totalRec . " Of " . $totalRec;
        } else {
            $pageInfo = "Showing " . $start . "-" . $end . " Of " . $totalRec;
        }
        return $pageInfo;
    }
    
    public function getUserNotificationCount($userId) {
        //get unread Notification 
        $where = array("where" => array("recieverId" => $userId, "isRead" => "0"));
        $notificationCount = $this->Common_model->fetch_count("notification", $where);
        return $notificationCount;
    }
    /**
     * upload image 
     * 
     * @access public
     * @return void
     * CREATED AT:22/02/2017
     */
    public function uploadImage($imageName = "", $config = array(), $width = 150, $height = 150) {
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
            $file_name = $image_data['file_name'];
            //echo $file_name;die;            

            return $file_name;
        } else {
            $error = array('error' => $this->upload->display_errors());
            //printArr($error);
            return false;
        }
    }

    /**
     * Create Thumbnail image 
     * 
     * @access public
     * @return void
     * CREATED AT:13/09/2017
     */
    function create_thumb($src, $dest, $desired_width = false, $desired_height = false) {
        /* If no dimenstion for thumbnail given, return false */
        if (!$desired_height && !$desired_width)
            return false;
        $fparts = pathinfo($src);
        $ext = strtolower($fparts['extension']);
        /* if its not an image return false */
        if (!in_array($ext, array('gif', 'jpg', 'png', 'jpeg')))
            return false;

        /* read the source image */
        if ($ext == 'gif')
            $resource = imagecreatefromgif($src);
        else if ($ext == 'png')
            $resource = imagecreatefrompng($src);
        else if ($ext == 'jpg' || $ext == 'jpeg')
            $resource = imagecreatefromjpeg($src);

        $width = imagesx($resource);
        $height = imagesy($resource);
        /* find the "desired height" or "desired width" of this thumbnail, relative to each other, if one of them is not given  */
        if (!$desired_height)
            $desired_height = floor($height * ($desired_width / $width));
        if (!$desired_width)
            $desired_width = floor($width * ($desired_height / $height));

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresized($virtual_image, $resource, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        /* Use correct function based on the desired image type from $dest thumbnail source */
        $fparts = pathinfo($dest);
        $ext = strtolower($fparts['extension']);
        /* if dest is not an image type, default to jpg */
        if (!in_array($ext, array('gif', 'jpg', 'png', 'jpeg')))
            $ext = 'jpg';
        //$dest = $fparts['dirname'] . '/' . $fparts['filename'] . '.' . $ext;

        if ($ext == 'gif')
            imagegif($virtual_image, $dest);
        else if ($ext == 'png')
            imagepng($virtual_image, $dest, 1);
        else if ($ext == 'jpg' || $ext == 'jpeg')
            imagejpeg($virtual_image, $dest, 100);

        return array(
            'width' => $width,
            'height' => $height,
            'new_width' => $desired_width,
            'new_height' => $desired_height,
            'dest' => $dest
        );
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
