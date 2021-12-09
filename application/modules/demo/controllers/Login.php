<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/demo/controllers/Base_Controller.php';
/* * ***********************
 * PAGE: USE TO MANAGE ADMIN LOGIN CONTROLLER.
 * #COPYRIGHT: IPA
 * @AUTHOR: SHABNAM <shabnam@greychaindesign.com>.
 * CREATED: 07/11/2017.
 * UPDATED: --/--/----.
 * Codeigniter   
 * *** */

class Login extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('Common_model');
        $this->load->model('Common');
    }

    /*
     * Use to open default page 
     * 
     */

    //Function for Authenticate ADMIN
    //POST DATA - admin_email,admin_password
    public function index() {

        //Use to chek Admin is login or not
        if($this->session->userdata('logged_in')){
             //header("location:".SITE_URL);
        }

        /*if(empty($_POST)){
            $newdata = array(
                   'backPage'     => $_SERVER['HTTP_REFERER'],
                   'back' => TRUE
               );
            $this->session->set_userdata($newdata);
            $session_id = $this->session->userdata('backPage');
        }*/
            
        if($_POST){
                    $columnArr = array();
                    $columnArr["email"] = $_POST["email"];
                    //$columnArr["password"] = md5($_POST["password"]);
                    $columnArr["password"] = $_POST["password"];
                    $data['userdata'] = $this->Common->selectData('cms_admin','*',$columnArr);
                            
                          /*  print_r($data['userdata']);
                            die;*/
                        //$user
                           
                        if(count($data['userdata'])>0){
                            if($data['userdata'][0]->user_type==1){

                                    $user=array("SuperAdmin"=>'true',
                                         'id'=>$data['userdata'][0]->id,
                                         'name'=>$data['userdata'][0]->name,
                                         'photo'=>$data['userdata'][0]->photo,
                                         'email'=>$data['userdata'][0]->email
                                        );
                                    header("Location: http://wranga.in/index.php/demo/SuperAdmin/index");


                            }elseif($data['userdata'][0]->user_type==2){
                                    $user=array("Admin"=>'true',
                                         'id'=>$data['userdata'][0]->id,
                                         'name'=>$data['userdata'][0]->name,
                                         'photo'=>$data['userdata'][0]->photo,
                                         'email'=>$data['userdata'][0]->email
                                        );
                                      header("Location: http://wranga.in/index.php/demo/Admin/index"); 

                            }elseif($data['userdata'][0]->user_type==3){
                                    $user=array("teamLeader"=>'true',
                                         'id'=>$data['userdata'][0]->id,
                                         'name'=>$data['userdata'][0]->name,
                                         'photo'=>$data['userdata'][0]->photo,
                                         'email'=>$data['userdata'][0]->email
                                        );
                                header("Location: http://wranga.in/index.php/demo/TeamLeader/index");    

                            }elseif($data['userdata'][0]->user_type==4){
                                    $user=array("Reviewer"=>'true',
                                         'id'=>$data['userdata'][0]->id,
                                         'name'=>$data['userdata'][0]->name,
                                         'photo'=>$data['userdata'][0]->photo,
                                         'email'=>$data['userdata'][0]->email
                                        );
                                header("Location: http://wranga.in/index.php/demo/Reviewer/index"); 
                            }

                            $this->session->set_userdata('logged_in', $user);

                           } 


                        }
                        else{
                            $msg=array("MSG"=>'<div class="isa_warning">Invalid Details</div>');
                            $this->session->set_userdata($msg);
                        }
            
        $this->load->view('login/index');
    }

}
