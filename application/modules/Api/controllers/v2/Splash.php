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
class Splash extends Base_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index_get() {

                     $userDetail = array(
                        "app_version"=> '1.01',
                        "ios_version"=> '1.01',
                        "tnc" => 'http://wranga.in/',
                        "status" => 'future use',
                    );


         $errorMsgArr = array();
                    $errorMsgArr['code'] = '200';
                    $errorMsgArr['status'] = STATUS_SUCCESS;
                    $errorMsgArr['message'] = 'success';
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);


    }

    public function index_post() {
                echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>".SITE_TITLE."</span></h1>";        
    }
    
}
