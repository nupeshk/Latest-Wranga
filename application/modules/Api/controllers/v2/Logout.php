<?php

require APPPATH . 'modules/Api/controllers/v1/Base_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logout
 *
 * @author Mohd. Shahid
 */
class Logout extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index_get() {
        $auth = $this->checkheader();
        $adminId = $auth["adminId"];
        $token = decrypt($auth["token"]);

        $this->Authtoken_model->delete(array('token' => $token));
        $this->webserviceResponse(SUCCESS_CODE, LOGOUT);  
    }

    public function index_post() {
        echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>" . SITE_TITLE . "</span></h1>";
    }

}
