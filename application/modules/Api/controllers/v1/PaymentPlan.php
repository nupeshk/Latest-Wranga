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

class PaymentPlan extends Base_Controller {

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


    public function index_post() {
        $postDataArr = $this->post();
        
        //$benifits=array();

        $wrng_tipsLists = $this->Common_model->fetch_data('wrng_paymentPlan',$fields = '*',array("status"=>1), $returnRow = false,$lmt1= false,$lmt2= false,$ord = false, $ordtype = false);  


                foreach ($wrng_tipsLists as $key => $wrng_tipsList) {

                $benifits= $this->Common_model->fetch_data('wrng_planBenifits','benifitsId as id,benifitsTitle as title,status', array("paymentPlanId"=>$wrng_tipsList->paymentPlanId), true);

                            $contentDataDetail[] = array(
                                    "paymentPlanId"=> $wrng_tipsList->paymentPlanId,
                                    "paymentImage"=> $wrng_tipsList->planImage,
                                    "planName" => $wrng_tipsList->planName,
                                    "planAmount" => $wrng_tipsList->planAmount,
                                    "benifits" =>$benifits,
                                    "planDescription" => (string)$wrng_tipsList->planDescription,
                                    "status" => $wrng_tipsList->status,
                                    "createdat" =>$wrng_tipsList->createdat
                                );
                            }       

                    $errorMsgArr = array();
                    $errorMsgArr['code'] = 200;
                    $errorMsgArr['status'] = 'success';
                    $errorMsgArr['message'] = 'Payment Plan List';
                    $errorMsgArr['data'] = $contentDataDetail;
                    $this->response($errorMsgArr);     


}

}