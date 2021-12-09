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
class Transaction extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Transaction_model");
    }

    /**
    * Index function
    *
    * @access	public
    */
    public function index_get() {
        echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>" . SITE_TITLE . "</span></h1>";
    }

    public function Add_post() {
        $auth = $this->checkheader();
        print_r($auth); die;
        $postDataArr = $this->post();
        $this->form_validation->set_data($postDataArr);
        $this->form_validation->set_rules('userId', 'userId', 'trim|required');
        $this->form_validation->set_rules('vehicleId', 'vehicleId', 'trim|required');
        $this->form_validation->set_rules('billNumber', 'billNumber', 'trim|required');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
        $this->form_validation->set_rules('transactionDate', 'transactionDate', 'trim|required');
        if ($this->form_validation->run() == true) {
            $userId = $postDataArr["userId"];
            $vehicleId = $postDataArr['vehicleId'];
            $billNumber = $postDataArr['billNumber'];
            $quantity = $postDataArr['quantity'];
            $transactionDate = date("Y-m-d", strtotime($postDataArr['transactionDate']));
            $where = array(
                "userId" => $userId,
                "billNumber" => $billNumber,
            );
            $transactionData = $this->Transaction_model->getTransactionData(array("transactionId"), $where, true);
            if(!$transactionData){
                $points = $quantity * 1;
                $data = array(
                    "vehicleId" => $vehicleId,
                    "userId" => $userId,
                    "billNumber" => $billNumber,
                    "quantity" => $quantity,
                    "transactionDate" => $transactionDate,
                    "points" => $points,
                    "transactionType" => "add",
                    "updatedDate" => getTodayDate(),
                    "createdDate" => getTodayDate()
                );
                //printArr($data);
                $transactionId = $this->Transaction_model->insert($data);
                if($transactionId){
					$this->sendTransactionSMS($userId, $points, $quantity, "add");
                    $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT);  
                } else {
                    $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
                }
            } else {
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_EXIST);
            }
        } else {
            $error = $this->form_validation->error_array();
            $this->webserviceResponse(UNSUCCESS_CODE, $error);
        }
    }

    public function Cancel_post() {
        $auth = $this->checkheader();
        //print_r($auth); die;
        $postDataArr = $this->post();
        $this->form_validation->set_data($postDataArr);
        $this->form_validation->set_rules('userId', 'userId', 'trim|required');
        //$this->form_validation->set_rules('vehicleId', 'vehicleId', 'trim|required');
        $this->form_validation->set_rules('billNumber', 'billNumber', 'trim|required');
        $this->form_validation->set_rules('transactionDate', 'transactionDate', 'trim|required');
        if ($this->form_validation->run() == true) {
            $userId = $postDataArr["userId"];
            //$vehicleId = $postDataArr['vehicleId'];
            $billNumber = $postDataArr['billNumber'];
            $transactionDate = date("Y-m-d", strtotime($postDataArr['transactionDate']));
            $where = array(
               // "vehicleId" => $vehicleId,
                "userId" => $userId,
                "billNumber" => $billNumber,
                "transactionDate" => $transactionDate,
                "transactionStatus" => "1",
                "transactionType" => "add"
            );

            $transactionData = $this->Transaction_model->getTransactionData(array("transactionId"), $where, true);
            if($transactionData){
                $points = $transactionData["points"];
                $update = array(
                    "transactionStatus" => "2",
                    "updatedDate" => getTodayDate()
                );
                $where = array(
                    "transactionId" => $transactionData["transactionId"],
                );
                //printArr($update);
                $success = $this->Transaction_model->update($where, $update);
                if($success){
                    $this->webserviceResponse(SUCCESS_CODE, UPDATE_SUCCESS);  
                } else {
                    $this->webserviceResponse(UNSUCCESS_CODE, UPDATE_FAILED);  
                }
            } else {
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_EXIST); 
            }
            
        } else {
            $error = $this->form_validation->error_array();
            $this->webserviceResponse(UNSUCCESS_CODE, $error);
        }
    }

    public function Redeem_post() {
        $auth = $this->checkheader();
        //print_r($auth); die;
        $postDataArr = $this->post();
        $this->form_validation->set_data($postDataArr);
        $this->form_validation->set_rules('userId', 'userId', 'trim|required');
        $this->form_validation->set_rules('points', 'points', 'trim|required');
        $this->form_validation->set_rules('remarks', 'remarks', 'trim|required');
        if ($this->form_validation->run() == true) {
            $userId = $postDataArr["userId"];
            $points = $postDataArr['points'];
            $remarks = $postDataArr['remarks'];
            $where = array("userId" => $userId);

            $userData = $this->User_model->getUserData(array("userId", "totalPoints"), $where, true);
            if($userData){
                $totalPoints = $userData["totalPoints"];
                if($totalPoints >= $points){
                    $data = array(
                        "userId" => $userId,
                        "transactionDate" => getTodayDate(),
                        "points" => $points,
                        "remarks" => $remarks,
                        "transactionType" => "redeem",
                        "updatedDate" => getTodayDate(),
                        "createdDate" => getTodayDate()
                    );
                    //printArr($data);
                    $transactionId = $this->Transaction_model->insert($data);
                    if($transactionId){
						$this->sendTransactionSMS($userId, $points, "", "redeem");
                        $this->webserviceResponse(SUCCESS_CODE, DATA_INSERT);  
                    } else {
                        $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_INSERT);  
                    }
                } else {
                    $this->webserviceResponse(UNSUCCESS_CODE, "Insufficient Points"); 
                }
            } else {
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_EXIST); 
            }

        } else {
            $error = $this->form_validation->error_array();
            $this->webserviceResponse(UNSUCCESS_CODE, $error);
        }
    }

}
