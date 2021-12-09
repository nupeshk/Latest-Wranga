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
class SendNotification extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
    }

    public function index_get() {

/*print_r($this->Common_model->fetch_data('wrng_fcm'));
die;*/
       $tokens = array(); 
        while($token = $this->Common_model->fetch_data('wrng_fcm')){
                
                print_r($token);
            //array_push($tokens, $token->fcmToken);
        }
        print_r($tokens);
        //return $tokens; 

    }





    public function index_post() {
                echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>".SITE_TITLE."</span></h1>";        
    }
    
}
