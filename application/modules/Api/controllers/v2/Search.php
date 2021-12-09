<?php

//require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'modules/Api/controllers/v1/Base_Controller.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Donet
 *
 * @author
 */
class Search extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Vehicle_model');
        $this->load->model('Transaction_model');
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
        echo "<h1 style='margin-left:41%; margin-top:20%; font-color:#641F11;'><span style='font-size: 50px;'>" . SITE_TITLE . "</span></h1>";
    }

    /* Search transaction:
     * Method: Post
     * Response: Json Array
     * 
     */

    public function Transaction_post() {
        $auth = $this->checkheader();
        $postDataArr = $this->post();
        $this->form_validation->set_data($postDataArr);
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|required');
        //Check validation is TRUE or FALSE
        if ($this->form_validation->run() == true) {
            $keyword = $postDataArr['keyword'];
            if(is_numeric($keyword)){
                $type = "mobile";
            } else {
                if(filter_var($keyword, FILTER_VALIDATE_EMAIL)) {
                    $type = "email";
                } else {
                    $type = "vehicle";
                }
            }
            if(($type=="mobile") || ($type=="email")) {
				//$where = array("or_where" => array("mobile" => $keyword, "email" => $keyword));
                //$where["where"] = array("status" => "1");
                $where = array("where" => array("status" => "1"));
                $where["group_start"] = array("mobile" => $keyword, "email" => $keyword);
                $userData = $this->Common_model->fetch_data("users", array(), $where, true);
                //printArr($userData);
            } else {
                $where = array("vehicleNumber" => $keyword, "users.status" => "1");
                $userData = $this->Vehicle_model->getVehicleUser(array("users.*"), $where, true);
            }
            //printArr($userData);
            if($userData){
                $userId = $userData["userId"];
                $where = array("userId" => $userId, "status" => "1");
                $vehicleArr = $this->Vehicle_model->getVehicleData(array(), $where, false);
                $vehicleList = array();
                if($vehicleArr){
                    foreach ($vehicleArr as $key => $value) {
                        $row = array();
                        $row["vehicleId"] = $value["vehicleId"];
                        $row["vehicleNumber"] = $value["vehicleNumber"];
                        $vehicleList[] = $row;
                    }
                }

                $where = array("transactions.userId" => $userId);
                $cols = array("transactionId", "transactions.userId", "transactions.vehicleId", "billNumber", "points", "remarks", "transactionType", "transactionStatus", "vehicleNumber", "vehicleType", "transactionDate");
                $transArr = $this->Transaction_model->getFullTransactionData($cols, $where, false);
                $transList = array();
                if($transArr){
                    foreach ($transArr as $key => $value) {
                        
                        $value["transactionDate"] = date("d-M-Y", strtotime($value["transactionDate"]));
                        $value["vehicleNumber"] = isset($value['vehicleNumber']) && !empty($value['vehicleNumber']) ? $value['vehicleNumber'] : "";
                        $value["vehicleType"] = isset($value['vehicleType']) && !empty($value['vehicleType']) ? $value['vehicleType'] : "";
                        $value["transactionStatus"] = $value['transactionStatus'] == '1' ? "Added" : "Cancelled";
                        $transList[] = $value;
                    }
                }
                //printArr($transList);
                $result = array("userData" => $userData, "vehicleList" => $vehicleList, "transactionList" => $transList);
                $this->webserviceResponse(SUCCESS_CODE, DATA_FOUND, $result);
            } else {
                $this->webserviceResponse(UNSUCCESS_CODE, "User not exists, Please register."); //DATA_NOT_EXIST
            }
        } else {
            $error = $this->form_validation->error_array();
            $this->webserviceResponse(UNSUCCESS_CODE, $error);
        }
    }


    /* Search Customer:
     * Method: Post
     * Response: Json Array
     * 
     */

    public function User_post() {
        $auth = $this->checkheader();
        $postDataArr = $this->post();
        //$this->form_validation->set_data($postDataArr);
        //$this->form_validation->set_rules('keyword', 'keyword', 'trim|required');
        //Check validation is TRUE or FALSE
        if (!empty($postDataArr)) {
            $mobile = isset($postDataArr['mobile']) && !empty($postDataArr['mobile']) ? $postDataArr['mobile'] : "";
            //$email = isset($postDataArr['email']) && !empty($postDataArr['email']) ? $postDataArr['email'] : "";
            $vehicleNumber = isset($postDataArr['vehicleNumber']) && !empty($postDataArr['vehicleNumber']) ? $postDataArr['vehicleNumber'] : "";
            $billNumber = isset($postDataArr['billNumber']) && !empty($postDataArr['billNumber']) ? $postDataArr['billNumber'] : "";

            if(!empty($mobile)) {
                $where = array("mobile" => $mobile, "status" => "1");
                $userData = $this->User_model->getUserData(array(), $where, true);
            } else if(!empty($vehicleNumber)){
                $where = array("vehicleNumber" => $vehicleNumber, "users.status" => "1");
                $userData = $this->Vehicle_model->getVehicleUser(array("users.*"), $where, true);
            } else if(!empty($billNumber)){
                $where = array("billNumber" => $billNumber, "users.status" => "1");
                $userData = $this->Transaction_model->getUserTransaction(array("users.*"), $where, true);    
            }

            if($userData){
                $userId = $userData["userId"];
                $where = array("userId" => $userId, "status" => "1");
                $vehicleArr = $this->Vehicle_model->getVehicleData(array(), $where, false);
                $vehicleList = array();
                if($vehicleArr){
                    foreach ($vehicleArr as $key => $value) {
                        $row = array();
                        $row["vehicleId"] = $value["vehicleId"];
                        $row["vehicleNumber"] = $value["vehicleNumber"];
                        $row["vehicleType"] = $value["vehicleType"];
                        $vehicleList[] = $row;
                    }
                }
                $userData["lastTransactionDate"] = date("d-M-Y", strtotime($userData['lastTransactionDate']));
                $result = array("userData" => $userData, "vehicleList" => $vehicleList);
                $this->webserviceResponse(SUCCESS_CODE, DATA_FOUND, $result);
            } else {
                $this->webserviceResponse(UNSUCCESS_CODE, DATA_NOT_EXIST);
            }
        } else {
            $error = $this->form_validation->error_array();
            $this->webserviceResponse(UNSUCCESS_CODE, $error);
        }
    }

}
