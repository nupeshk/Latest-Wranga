<?php
//require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'modules/Api/controllers/v1/Base_Controller.php';

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

class ForgetPassword extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
    }


    /**
     * Index function
     *
     * @access	public
     */

    public function index_get() {
        echo "<h1 style='margin-top:5%; text-align: center'>" . SITE_TITLE . "</h1>";
    }


    public function index_post() {
        $postDataArr = $this->post();
        if ((!is_null($postDataArr)) && sizeof($postDataArr) > 0) {
            $response = $this->forgetPassword($postDataArr);
            $this->response($response);
        } else {
            $errorMsgArr = array();
            $errorMsgArr['code'] = UNSUCCESS_CODE;
            $errorMsgArr['status'] = STATUS_INVALID;
            $errorMsgArr['message'] = INVALID_POST_DATA;
            $this->response($errorMsgArr);
        }
    }


	//Function for User Login
	//POST DATA - email,password

    public function forgetPassword($postDataArr) {
        //error_reporting(0);
    if ($this->form_validation->run("api/v1/forget") == true) {
         $user =  $this->Common_model->fetch_data('users','*',['email'=>$postDataArr['email']]);


       

                    if($user){         

                        $postDataArrr['password']=rand(10000, 99999);
                        $postDataArrr['isDefault']=1;
                        $this->Common_model->update_single('users',$postDataArrr,['email'=>$postDataArr['email']]);
                        $errorMsgArr = array();
                       

                       $this->load->library('email');
                                  $config = array();
                      $config['protocol'] = 'smtp';
                      $config['smtp_host'] = 'smtp.zoho.in';
                      $config['smtp_user'] = 'info@wranga.in';
                      $config['smtp_pass'] = 'Wranga@1234';
                      $config['smtp_port'] = 465;
                      $config["smtp_crypto"] = "ssl";
                      $config["mailtype"] = "html";
                      $config["charset"] = "iso-8859-1";

                      $this->email->initialize($config);
                      $this->email->set_mailtype("html");
                      $this->email->set_newline("\r\n");
                       $name = 'wranga';
                       $email = 'info@wranga.in';
                        $message = "
                          <html><body>
                          <p>Wranga: Reset your password.</p>
                          <table>
                          <tr>
                          <th>Password</th>
                          <th>".$postDataArrr['password']."</th>
                          </tr>
                          </table>
                          </body>
                          </html>"; 
                       $this->email->from($email, $name);
                       $this->email->to($postDataArr['email']);
                       $this->email->subject('Wranga:forget Password');
                       $this->email->message($message);
                       $this->email->send();

                        $errorMsgArr['code'] = 200;
                        $errorMsgArr['status'] = 'success';
                        $errorMsgArr['message'] = 'Email has been send please check Your Email.';
                        $errorMsgArr['data'] = $postDataArrr;
                        $this->response($errorMsgArr);
                        
                          

                }else {

               $errorMsgArr = array();
                $errorMsgArr['code'] = 401;
                $errorMsgArr['status'] = 'error';
                $errorMsgArr['message'] = 'This email does not exist.';
                $errorMsgArr['data'] =(object) array();
                $this->response($errorMsgArr);
            }
        } else {
            $error = $this->form_validation->error_array();
            $errorMsgArr = array();
            $errorMsgArr['code'] = 401;
            $errorMsgArr['status'] = 'error';
            $errorMsgArr['message'] = PARAM_MISSING;
            $errorMsgArr['data'] =(object) array();
            $errorMsgArr['error'] = $error;
            $this->response($errorMsgArr);
        }  
   }
}

