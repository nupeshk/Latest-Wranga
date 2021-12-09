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
class User extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Vehicle_model');
    }

    /**
     * Index function
     *
     * @access	public
     */
    public function index_get() {
        echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>" . SITE_TITLE . "</span></h1>";
    }

    public function index_post() {
        $auth = $this->checkheader();
        //print_r($auth); die;
        $postDataArr = $this->post();
        if ((!is_null($postDataArr)) && sizeof($postDataArr) > 0) {
            //$response = $this->login($postDataArr);
            //$this->response($response);
            echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>" . SITE_TITLE . "</span></h1>";
        } else {
            $this->webserviceResponse(UNSUCCESS_CODE, INVALID_POST_DATA);
        }
    }

     /* Add User:
     * Method: Post
     * Response: Json Array
     * 
     */

     public function Add_post() {
        $auth = $this->checkheader();
        
        //print_r($auth); die; 
        $postDataArr = $this->input->post();
        if (!empty($postDataArr)) {
            //print_r($postDataArr); die; 
            $this->form_validation->set_data($postDataArr);
            $this->form_validation->set_rules('firstName', 'firstName', 'trim|required');
            //$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
            //$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
            $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
            $this->form_validation->set_rules('vehicleNumber', 'vehicleNumber', 'trim|required');
            $this->form_validation->set_rules('vehicleType', 'vehicleType', 'trim|required');
            $this->form_validation->set_rules('dob', 'dob', 'trim|required');
            //$this->form_validation->set_rules('referrer', 'referrer', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $firstName = $postDataArr['firstName'];
                $lastName = isset($postDataArr['lastName']) && !empty($postDataArr['lastName']) ? $postDataArr['lastName'] : "";
                $email = isset($postDataArr['email']) && !empty($postDataArr['email']) ? $postDataArr['email'] : "";
                $dob = date("Y-m-d", strtotime($postDataArr['dob']));
                $mobile = $postDataArr['mobile'];
                $vehicleNumber = $postDataArr['vehicleNumber'];
                $vehicleType = $postDataArr['vehicleType'];
                $referrer = isset($postDataArr['referrer']) && !empty($postDataArr['referrer']) ? $postDataArr['referrer'] : "";
                
                //check vehicle
                $vehicleExist = $this->Vehicle_model->getVehicleData(array("vehicleId"), array('vehicleNumber' => $vehicleNumber), true);
                if ($vehicleExist) {
                    $this->webserviceResponse(UNSUCCESS_CODE, "Vehicle exists."); 
                }

                $userExist = $this->User_model->getUserData(array("userId"), array('mobile' => $mobile), true);
                if ($userExist) {
                    $userId = $userExist["userId"];
                    $where = array("userId" => $userId);
                    $update = array(
                        "dob" => $dob,
                        "lastName" => $lastName,
                        "email" => $email,
                        "updatedDate" => getTodayDate()
                    );
                    
                    $success = $this->User_model->update($where, $update);
                    if($referrer){
                        $checkRef = $this->User_model->getUserData(array("userId"), array('mobile' => $referrer, 'userId != ' => $userId), true);
                        if(!$checkRef){
                            $this->webserviceResponse(UNSUCCESS_CODE, "Referrer not exists."); 
                        }
                    } 

                } else {
                    $insert = array();
                    $insert["firstName"] = $firstName;    
                    $insert["lastName"] = $lastName;    
                    $insert["email"] = $email;
                    $insert["mobile"] = $mobile;
                    $insert["dob"] = $dob;
                    $insert['updatedDate'] = getTodayDate();
                    $insert['createdDate'] = getTodayDate();
                    //printArr($insert); 
                    $userId = $this->User_model->insert($insert);
                }

                if($userId){
                    $vehicleExist = $this->Vehicle_model->getVehicleData(array("vehicleId"), array('vehicleNumber' => $vehicleNumber), true);
                    if (!$vehicleExist) {
                        $insert = array();
                        $insert["userId"] = $userId;    
                        $insert["vehicleNumber"] = $vehicleNumber;    
                        $insert["vehicleType"] = $vehicleType;
                        $insert['updatedDate'] = getTodayDate();
                        $insert['createdDate'] = getTodayDate();
                        //printArr($insert); 
                        $vehicleId = $this->Vehicle_model->insert($insert);
                        if($vehicleId){
                            //$result = array("userData" =>$userData);                
                            //$this->webserviceResponse(SUCCESS_CODE, UPDATE_SUCCESS, $result); 
                            $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT);   
                        } else {
                            $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT); 
                        }
                    } else{
                        $this->webserviceResponse(UNSUCCESS_CODE, DATA_EXIST); 
                    }
                } else {
                    $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT); 
                }

            } else {
                $error = $this->form_validation->error_array();
                $this->webserviceResponse(UNSUCCESS_CODE, $error);
            }
        }
    }

}
