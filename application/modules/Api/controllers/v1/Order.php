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

class Order extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authtoken_model');
        $this->load->model('Admin_model');
        $this->load->model('Common_model');
    }


    /**
     * Index function
     *
     * @access  public
     */

    public function index_get() {
        echo "<h1 style='margin-top:5%; text-align: center'>" . SITE_TITLE . "</h1>";
    }


    public function createOrder_post() {
                $postDataArr = $this->post();
                $data = array("amount" => $postDataArr['amount'],"currency" => $postDataArr['currency']);
                    $data_string = json_encode($data);                                                                                   
                    $api_key = "rzp_test_psMiF3ep7bWpZR";   
                    $password = "ZmN7BlYZftBjrQHctxgPfRnS";                                                                                                                 
                    $ch = curl_init(); 
                    curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");    
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
                    curl_setopt($ch, CURLOPT_POST, true);                                                                   
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
                    curl_setopt($ch, CURLOPT_USERPWD, $api_key.':'.$password);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
                        'Accept: application/json',
                        'Content-Type: application/json')                                                           
                    );             

                    if(curl_exec($ch) === false)
                    {
                        echo 'Curl error: ' . curl_error($ch);
                    }                                                                                                      
                    $errors = curl_error($ch);                                                                                                            
                    echo $result = curl_exec($ch);
                    $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);  
                    //echo $returnCode;
                    //var_dump($errors);
                    
                    $arr=json_decode($result, true);

                    $data = array(
                    "orderId" => $arr['id'],
                    "userId" =>  $postDataArr['userId'],
                    "planId " => $postDataArr['planId'],
                    "entity " => $arr['entity'],
                    "amount " => $arr['amount'],
                    "amount_paid " => $arr['amount_paid'],
                    "amount_due " => $arr['amount_due'],
                    "currency " => $arr['currency'],
                    "receipt " => $arr['receipt'],
                    "offer_id " => $arr['offer_id'],
                    "status " => $arr['status']
                );
                    $fcmId = $this->Common_model->insert_single('wrng_order',$data);
    }

    public function orderStatus_post() {
                $postDataArr = $this->post();
                $data = array(
                    "status" => $postDataArr['status'],
                    "razorpay_payment_id " => $postDataArr['razorpay_payment_id'],
                    //"razorpay_order_id " => $postDataArr['razorpay_order_id'],
                    "razorpay_signature " => $postDataArr['razorpay_signature']
                );
            $order = $this->Common_model->updateAll('wrng_order',$data,array('orderId' => $postDataArr['orderId']));
            if($order){   
            //$generated_signature = hmac_sha256($postDataArr['orderId'] + "|" + $postDataArr['razorpay_payment_id'], 'rzp_test_psMiF3ep7bWpZR');
            
            //$generated_signature = hash('sha256',($postDataArr['orderId'] + "|" + $postDataArr['razorpay_payment_id']));
           // if ($generated_signature == $postDataArr['razorpay_signature']) {
              
              if($postDataArr['status']==200){
                $postDataArr['status']=1;
              }else{
                $postDataArr['status']=0;
              }

              if ($postDataArr['status'] == 1) {

                     $fcmId = $this->Common_model->updateAll('users',['paymentStatus'=>1,'paymentPlan'=>$postDataArr['planId']],array('userId' => $postDataArr['userId']));

                    $contentDataDetail = array(
                                     "paymentPlan" =>  paymentPlanTitle($postDataArr['planId']),
                                    "paymentStatus" => $postDataArr['status'],
                                    "features" => $this->Common_model-> selectData('wrng_features', $fld = 'title,status')
                                );

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'payment is successful';
                    $errorMsgArr['data'] = $contentDataDetail;
                    $this->response($errorMsgArr);

              }else{
                $errorMsgArr = array();
                    $errorMsgArr['code'] = 401;
                    $errorMsgArr['status'] = 'faild';
                    $errorMsgArr['message'] = 'payment is Faild';
                     $errorMsgArr['data'] = (object) array();
                    $this->response($errorMsgArr);
              }
         }     
    }

}