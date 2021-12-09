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
class Push extends Base_Controller {

    private $title;
    private $message;
    private $image;


    public function __construct() {
        parent::__construct();
       /* $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
*/
         $this->title = $title;
         $this->message = $message; 
         $this->image = $image; 

    }

    
    public function getPush() {
        $res = array();
        $res['notification']['body'] = $this->title;
        $res['notification']['title'] = $this->message;
        $res['notification']['icon'] = $this->image;
        $res['data']['title'] = $this->title;
        $res['data']['contentId'] = $this->message;
        $res['data']['imageUrl'] = $this->image;
        return $res;
    }



{


 
    

    public function index_post() {
                echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>".SITE_TITLE."</span></h1>";        
    }
    
}
