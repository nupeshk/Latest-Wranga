<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/Admin/controllers/Base_Controller.php';

// Including Phil Sturgeon's Rest Server Library in our Server file.

class Transaction extends Base_Controller {
    /*
     * __construct function.
     * 
     * @access public
     * @return void
     */

    public function __construct() {
        parent::__construct();
        //Load all libraries, configs, models, langs and such here!
        $this->load->model('Transaction_model');
        $this->perPage = 20;
    }

    public function index() {
        //First thing to do!!!        
        $data = array();
        $adminData = $this->check_session();
        $postDataArr = $this->input->post();
        $userId = $this->uri->segment(3);
        
        $limit = $this->perPage;
        $offset = 0;
        $coloumn = array("SQL_CALC_FOUND_ROWS t.*, v.vehicleNumber, v.vehicleType, u.firstName, u.lastName, u.email, DATE_FORMAT(t.transactionDate, '%d-%m-%Y') as transactionDate, DATE_FORMAT(t.createdDate, '%d-%m-%Y') as createdDate");
        $where = array();
        if (!empty($userId)) {
			$where = array("t.userId" => $userId);
        }
        
        $like = "";
        //printArr($postDataArr) ;
        if(!empty($postDataArr)){
			if (isset($postDataArr['search']) && !empty($postDataArr['search'])) {
				$like = array("billNumber" => $postDataArr['search'], "vehicleNumber" => $postDataArr['search']);
			}
			$sTransactionDate = $postDataArr['sTransactionDate'];
			$eTransactionDate = $postDataArr['eTransactionDate'];
			//if (isset($postDataArr['sTransactionDate']) && !empty($postDataArr['sTransactionDate'])) {
				//$where["DATE(t.transactionDate)"] = date("Y-m-d", strtotime($postDataArr['sTransactionDate']));
			//}
			if(!empty($sTransactionDate) && empty($eTransactionDate)){
				$where["DATE(t.transactionDate)"] = date("Y-m-d", strtotime($sTransactionDate));
			}
			
			if(!empty($sTransactionDate) && !empty($eTransactionDate)){
				$where["DATE(t.transactionDate) >= "] = date("Y-m-d", strtotime($sTransactionDate));
				$where["DATE(t.transactionDate) <= "] = date("Y-m-d", strtotime($eTransactionDate));
			}
		}
        
        $order_by = array("t.transactionId", "desc");
        $transData = $this->Transaction_model->getTransactionList($coloumn, $where, $like, $order_by, $limit, $offset);
        $totalRec = $transData['count'];
        $result = $transData['result'];
        $transArr = array();
        if ($result) {
            foreach ($result as $val) {
                //$val["fullName"] = ucwords($val["fullName"]);
                $transArr[] = $val;
            }
        }
		//printArr($transArr);
        //pagination configuration
        $config['target'] = '#transactionList';
        $config['base_url'] = base_url() . 'admin/transaction/getajax';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->ajax_pagination->initialize($config);

        $pageInfo = $this->getShowingText($totalRec);
        $data["title"] = "Transaction";
        $data['post'] = $postDataArr;
        $data['adminData'] = $adminData;
        $data['transArr'] = $transArr;
        $data['pageInfo'] = $pageInfo;
        $data['totalTransaction'] = $totalRec;
        $data['userId'] = $userId;
        $data['main_content'] = 'transaction/index';
        $this->load->view('layout/layout', $data);
    }

    /**
     * *Search Ajax Function Process For Migrant Section
     * */
    public function getAjax() {
        //First thing to do!!!  
        if ($this->input->is_ajax_request()) {
            $data = array();
            $adminData = $this->check_session();
            $postDataArr = $this->input->post();
            //printArr($postDataArr);
            $userId = $postDataArr["userId"];
            $like = "";
            $where = array();
			if (!empty($userId)) {
				$where = array("t.userId" => $userId);
			}
            
            if (isset($postDataArr['search']) && !empty($postDataArr['search'])) {
                $like = array("billNumber" => $postDataArr['search'], "vehicleNumber" => $postDataArr['search']);
            }
            if(!empty($postDataArr)){
				if (isset($postDataArr['search']) && !empty($postDataArr['search'])) {
					$like = array("billNumber" => $postDataArr['search'], "vehicleNumber" => $postDataArr['search']);
				}
				$sTransactionDate = $postDataArr['sTransactionDate'];
				$eTransactionDate = $postDataArr['eTransactionDate'];
				//if (isset($postDataArr['sTransactionDate']) && !empty($postDataArr['sTransactionDate'])) {
					//$where["DATE(t.transactionDate)"] = date("Y-m-d", strtotime($postDataArr['sTransactionDate']));
				//}
				if(!empty($sTransactionDate) && empty($eTransactionDate)){
					$where["DATE(t.transactionDate)"] = date("Y-m-d", strtotime($sTransactionDate));
				}
				
				if(!empty($sTransactionDate) && !empty($eTransactionDate)){
					$where["DATE(t.transactionDate) >= "] = date("Y-m-d", strtotime($sTransactionDate));
					$where["DATE(t.transactionDate) <= "] = date("Y-m-d", strtotime($eTransactionDate));
				}
			}
			
            $order_by = array("t.transactionId", "desc");

            $limit = $this->perPage;
            $offset = 0;

            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
            } else {
                $offset = $page;
            }
            $data['page'] = $page;
            $coloumn = array("SQL_CALC_FOUND_ROWS t.*, v.vehicleNumber, v.vehicleType, u.firstName, u.lastName, u.email, DATE_FORMAT(t.transactionDate, '%d-%m-%Y') as transactionDate, DATE_FORMAT(t.createdDate, '%d-%m-%Y') as createdDate");
            $transData = $this->Transaction_model->getTransactionList($coloumn, $where, $like, $order_by, $limit, $offset);
			$totalRec = $transData['count'];
			$result = $transData['result'];
			$transArr = array();
			if ($result) {
				foreach ($result as $val) {
					//$val["fullName"] = ucwords($val["fullName"]);
					$transArr[] = $val;
				}
			}
            //pagination configuration
            $config['target'] = '#transactionList';
            $config['base_url'] = base_url() . 'admin/transaction/getajax';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = $this->perPage;
            $config['link_func'] = 'searchFilter';
            $config['uri_segment'] = 4;
            $this->ajax_pagination->initialize($config);

            $pageInfo = $this->getAjaxShowingText($page, $limit, $totalRec);
            $data['post'] = $postDataArr;
            $data['adminData'] = $adminData;
            $data['transArr'] = $transArr;
            $data['pageInfo'] = $pageInfo;
            $data['totalUsers'] = $totalRec;
            $this->load->view('transaction/ajax-pagination-data', $data);
        }
    }

    /**
     * *View Function Process For Migrant Section
     * */
    public function view() {
        $data['adminData'] = $this->check_session();
        $userId = $this->uri->segment(4);
        if (empty($userId)) {
            redirect('/admin/host');
        }
        // Get Migrant Data
        $column = array("userId", "fullName", "photo", "mobileNumber", "rewardUsablePoint", "totalPoint", "rewardPoint", "tag",
            "redeemedPoint", "PHPAmount", "DATE_FORMAT(lastLogin, '%d-%m-%Y') as lastLogin", "isDeleted", "deletedBy", "DATE_FORMAT(deletedDate, '%d-%m-%Y') as deletedDate");

        $where = array('userId' => $userId);
        $like = array();
        $getMigrantData = $this->Migrant_model->getMigrantData($column, $where, $like, true);

        $deletedId = $getMigrantData['deletedBy'];
        $deletedByRow = $this->Common_model->fetch_data('admin', 'adminName', array("where" => array("adminID" => $deletedId)), true);

        if (!empty($getMigrantData['photo'])) {
            $photo = base_url() . PUBLIC_ABS . PROFILE_PATH . $getMigrantData['photo'];
            $thumbImage = base_url() . PUBLIC_ABS . PROFILE_THUMB_PATH . $getMigrantData['photo'];
        } else {
            $photo = base_url() . PUBLIC_ABS . "images/noimg.png";
            $thumbImage = base_url() . PUBLIC_ABS . "images/noimg.png";
        }
        $getMigrantData["totalAmount"] = $this->getCurrencySymbol($this->currency) . $getMigrantData[$this->currency . "Amount"];
        $getMigrantData['photo'] = $photo;
        $getMigrantData['thumbImage'] = $thumbImage;
        $getMigrantData['deletedBy'] = $deletedByRow['adminName'];
        // End
        // Get Recipiecnt Data
        $column = array("recipients.recipientId", "recipients.relation", "recipients.targetBeneficiary", "users.fullName", "users.photo", "users.mobileNumber", "users.totalAmount", "users.PHPAmount", "users.USDAmount", "users.AEDAmount", "users.countryCode");
        $where = array('recipients.migrantId' => $userId, 'users.userType' => 'Recipient', "users.isDeleted" => '0');
        $getRecipientData = $this->Recipient_model->getRecipientData($column, $where, false);

        $recipientArr = array();
        if ($getRecipientData) {
            foreach ($getRecipientData as $val) {
                if (!empty($val['photo'])) {
                    $photo = base_url() . PUBLIC_ABS . PROFILE_PATH . $val['photo'];
                    $thumbImage = base_url() . PUBLIC_ABS . PROFILE_THUMB_PATH . $val['photo'];
                } else {
                    $photo = base_url() . PUBLIC_ABS . "images/noimg.png";
                    $thumbImage = base_url() . PUBLIC_ABS . "images/noimg.png";
                }
                //$val["totalAmount"] = (!empty($val['totalAmount'])) ? $val['totalAmount'] : 0;                    
                $val['photo'] = $photo;
                $val['thumbImage'] = $thumbImage;
                $val['flag'] = $this->getFlag($val['countryCode']);
                $val["totalAmount"] = $this->getCurrencySymbol($this->currency) . $val[$this->currency . "Amount"];
                $recipientArr[] = $val;
            }
        }
        // End
        // Get Remittanace Data 
        $column = array("rr.remittanceId", "rr.status", "rr.amount", "rr.currency", "rr.label", "rr.PHP", "rr.USD", "rr.AED", "DATE_FORMAT(rr.transactionDate, '%d-%m-%Y') as transactionDate", "r.userId", "r.fullName", "r.mobileNumber", "r.photo", "r.countryCode");
        $where = array('rr.migrantId' => $userId);
        $getRemittanceData = $this->Remittance_model->getRemittanceData($column, $where, false);

        $remittanceArr = array();
        if ($getRemittanceData) {
            foreach ($getRemittanceData as $val) {
                if (!empty($val['photo'])) {
                    $photo = base_url() . PUBLIC_ABS . PROFILE_PATH . $val['photo'];
                    $thumbImage = base_url() . PUBLIC_ABS . PROFILE_THUMB_PATH . $val['photo'];
                } else {
                    $photo = base_url() . PUBLIC_ABS . "images/noimg.png";
                    $thumbImage = base_url() . PUBLIC_ABS . "images/noimg.png";
                }
                $val['photo'] = $photo;
                $val['thumbImage'] = $thumbImage;
                $val['flag'] = $this->getFlag($val['countryCode']);
                //$val["amount"] = $this->getCurrencySymbol($this->currency) . $val[$this->currency];
                $val["amount"] = $this->getCurrencySymbol($val["currency"]) . $val["amount"];
                $remittanceArr[] = $val;
            }
        }
        // End
        // Get Reward Data         
        $column = array("reward_history.*", "DATE_FORMAT(createdDate, '%d-%m-%Y') as createdDate");
        $where = array('userId' => $userId, 'rewardType!=' => 'RedeemReward');
        $rewardArr = $this->Reward_model->getRewardHistoryData($column, $where, false);
        //printArr($rewardArr);
        // End 
        // Get Survey Data 
        $column = array("DATE_FORMAT(user_survey.expiryDate, '%d-%m-%Y') as expiryDate", "user_survey.surveyStatus", "DATE_FORMAT(user_survey.createdDate, '%d-%m-%Y') as sendDate", "DATE_FORMAT(user_survey.completedDate, '%d-%m-%Y') as completedDate", "survey.surveyName", "survey.expireIn", "survey.rewardPoint");
        $where = array('user_survey.userId' => $userId);
        $surveyArr = $this->Survey_model->getSurveyInfo($column, $where, false);
        // End
        // Get Total Remittances       
        $column = array("SUM(PHP) as totalRamittance");
        $where = array('migrantId' => $userId);
        $data['totalRemittances'] = $this->Remittance_model->getRemittance($column, $where, true);
        // End
        // Get Total Rewards       
        $data['totalRewards'] = $this->Common_model->fetch_count("redeem_reward", array('where' => array("userId" => $userId)));
        // End
        // Get Total Surveys       
        $data['totalSurveys'] = $this->Common_model->fetch_count("user_survey", array('where' => array("userId" => $userId, "surveyStatus" => "1")));
        // End

        $data["title"] = "Migrant: View";
        $data['migrant'] = $getMigrantData;
        $data['recipientData'] = $recipientArr;
        $data['remittanceData'] = $remittanceArr;
        $data['rewardData'] = $rewardArr;
        $data['surveyData'] = $surveyArr;
        $data['main_content'] = 'migrants/view';
        $this->load->view('layout/layout', $data);
    }

    /**
     * *Change Status Function Process For Migrant Section
     * */
    public function changeStatus() {
        $postData = $this->input->post();
        $StatusId = $postData['StatusId'];
        $StatusVal = $postData['StatusVal'];
        if (!empty($StatusId)) {
            if ($StatusVal == "1") {
                $update = array("isActive" => "0");
            } else {
                $update = array("isActive" => "1");
            }
            $where = array("userId" => $StatusId);
            $success = $this->User_model->update($where, $update);

            if ($success) {
                $this->jsonResponse(array("success_code" => 200, "message" => UPDATE_SUCCESS));
            } else {
                $this->jsonResponse(array("success_code" => 400, "message" => UPDATE_FAILED));
            }
        }
    }

    /**
     * *Delete Function Process For Migrant Section
     * */
    public function delete() {
        $adminData = $this->check_session();
        $postData = $this->input->post();
        $DeleteId = $postData['DeleteId'];
        if (!empty($DeleteId)) {
            $update = array(
                "isDeleted" => '1',
                //"deletedBy" => $adminData['adminId'],
                //"deletedDate" => getTodayDate(),
                "updatedDate" => getTodayDate()
            );
            $where = array("userId" => $DeleteId);
            $success = $this->User_model->update($where, $update);
            if ($success) {
                $this->jsonResponse(array("success_code" => 200, "message" => DELETE_SUCCESS));
            } else {
                $this->jsonResponse(array("success_code" => 400, "message" => DELETE_FAILED));
            }
        }
    }
    // end
    
    /*     * Export* */

    public function Export() {
		//error_reporting(E_ALL);
		//ini_set('display_errors', 1);
        $adminData = $this->check_session();
        require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('greychaindesign.com')
                ->setLastModifiedBy('Mohd Shahid')
                ->setTitle('Transaction Export')
                ->setSubject('integrate codeigniter with PhpExcel')
                ->setDescription('Transaction Export');

        // add style to the header
        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'top' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'fill' => array(
                'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startcolor' => array(
                    'argb' => 'FFA0A0A0',
                ),
                'endcolor' => array(
                    'argb' => 'FFFFFFFF',
                ),
            ),
        );
        $spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);


        // auto fit column to content

        foreach (range('A', 'H') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }
        // set the names of header cells
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue("A1", 'Vehicle Number')
                ->setCellValue("B1", 'Vehicle Type')
                ->setCellValue("C1", 'Transaction Date')
                ->setCellValue("D1", 'Bill Number')
                ->setCellValue("E1", 'Quantity')
                ->setCellValue("F1", 'Points')
                ->setCellValue("G1", 'Transaction Type')
                ->setCellValue("H1", 'Remarks');
	
	 	 	 	 	 	 	
        // Add some data

        $postDataArr = $this->input->get();
        //printArr($postDataArr); die;
        $userId = $postDataArr["userId"];
        $limit = 0;
        $offset = 0;
        $like = "";
        $coloumn = array("SQL_CALC_FOUND_ROWS t.*, v.vehicleNumber, v.vehicleType, u.firstName, u.lastName, u.email, DATE_FORMAT(t.transactionDate, '%d-%m-%Y') as transactionDate, DATE_FORMAT(t.createdDate, '%d-%m-%Y') as createdDate");
        $where = array();
		if (!empty($userId)) {
			$where = array("t.userId" => $userId);
		}
        //printArr($postDataArr) ;
        if(!empty($postDataArr)){
			if (isset($postDataArr['search']) && !empty($postDataArr['search'])) {
				$like = array("billNumber" => $postDataArr['search'], "vehicleNumber" => $postDataArr['search']);
			}
			$sTransactionDate = $postDataArr['sTransactionDate'];
			$eTransactionDate = $postDataArr['eTransactionDate'];
			//if (isset($postDataArr['sTransactionDate']) && !empty($postDataArr['sTransactionDate'])) {
				//$where["DATE(t.transactionDate)"] = date("Y-m-d", strtotime($postDataArr['sTransactionDate']));
			//}
			if(!empty($sTransactionDate) && empty($eTransactionDate)){
				$where["DATE(t.transactionDate)"] = date("Y-m-d", strtotime($sTransactionDate));
			}
			
			if(!empty($sTransactionDate) && !empty($eTransactionDate)){
				$where["DATE(t.transactionDate) >= "] = date("Y-m-d", strtotime($sTransactionDate));
				$where["DATE(t.transactionDate) <= "] = date("Y-m-d", strtotime($eTransactionDate));
			}
		}
		
        $order_by = array("t.transactionId", "desc");
        $transData = $this->Transaction_model->getTransactionList($coloumn, $where, $like, $order_by, $limit, $offset);
        $totalRec = $transData['count'];
        $result = $transData['result'];
        //printArr($result);
        
        $x = 2;
        foreach ($result as $val) {
            $transaction = "";
			if($val["transactionType"] == "add" && $val["transactionStatus"] == "1"){
				$transaction = "Added";
			} else if($val["transactionType"] == "add" && $val["transactionStatus"] == "2"){
				$transaction = "Cancelled";
			} else if($val["transactionType"] == "redeem" && $val["transactionStatus"] == "1"){
				$transaction = "Redeemed";
			}
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue("A$x", $val['vehicleNumber'])
                    ->setCellValue("B$x", $val['vehicleType'])
                    ->setCellValue("C$x", $val['transactionDate'])
                    ->setCellValue("D$x", $val['billNumber'])
                    ->setCellValue("E$x", $val['quantity'])
                    ->setCellValue("F$x", $val['points'])
                    ->setCellValue("G$x", $transaction)
                    ->setCellValue("H$x", $val["remarks"]);
            $x++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Transaction Data');

        // set right to left direction
        //		$spreadsheet->getActiveSheet()->setRightToLeft(true);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $fileName = "transaction_" . date("YmdHis") . ".xlsx";
        // Redirect output to a client’s web browser (Excel2007)
        //header('Content-type: application/octet-stream; charset=UTF-8');
        header('Content-Encoding: UTF-8');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');

        header('Content-Disposition: attachment;filename=' . $fileName);
        header('Cache-Control: max-age=0');
        header("Pragma: no-cache");
        header("Expires: 0");
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
        ob_end_clean();
		ob_start();
        $writer->save('php://output');
        exit;

        //  create new file and remove Compatibility mode from word title
    }
    // end
}
