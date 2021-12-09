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

                      $splashValue=$this->Common_model-> selectData('wrng_splash', $fld = '*',['id'=>1]);


                     $userDetail = array(
                        "app_version"=> $splashValue[0]->app_version,
                        "ios_version"=> $splashValue[0]->ios_version,
                        "tnc" => $splashValue[0]->tnc,
                        "aboutUs" => $splashValue[0]->aboutUs,
                        "helpCenter" => $splashValue[0]->helpCenter,
                        "privacy" => $splashValue[0]->privacy,
                        "fixProblem" => $splashValue[0]->fixProblem,
                        "platform" => $this->Common_model->fetch_data('platform','pId,name'),
                        "tnc" => $splashValue[0]->tnc,
                        "status" => $splashValue[0]->status,
                    );


         $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = STATUS_SUCCESS;
                    $errorMsgArr['message'] = 'success';
                    $errorMsgArr['data'] = $userDetail;
                    $this->response($errorMsgArr);


    }

    public function index_post() {
                echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>".SITE_TITLE."</span></h1>";        
    }
    
}
