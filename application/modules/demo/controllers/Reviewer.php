<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/demo/controllers/Base_Controller.php';
/* * ***********************
 * PAGE: USE TO MANAGE ADMIN DASHBOARD CONTROLLER.
 * #COPYRIGHT: IPA
 * @AUTHOR: ADMIN <admin@ipa.com>.
 * CREATOR: 07/11/2017.
 * UPDATED: --/--/----.
 * Codeigniter    
 * *** */

class Reviewer extends Base_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->model('Common');
        $this->perPage = 20;
               $data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
       
        $this->perPage = 20;
    }

    /*
     * Use to open default page 
     */

    //Function for Admin Dashboard
    public function index() {
       $data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        
        /*$adminData = $this->check_session();
        //First thing to do!!!
        $data = array();
        $data['adminData'] = $this->check_session();
        $data['total_users'] = $this->Common_model->fetch_count("users", array("where" => array("status" => "1"))); //
        $data['total_purchases'] = 0; // $this->Common_model->fetch_count("payment", array('where' => array("paid" => '1')));
        //$total_revenue = $this->Common_model->fetch_data("payment", array("SUM(amount) as amount"), array('where' => array("paid" => '1')), true);
        $data['total_revenue'] = 0; //$total_revenue["amount"];
				
		//Get Dashboard Order Graph Data
        $get = $this->input->get();
        if (!empty($get['d'])) {
            $days = $get['d'];
        } else {
            $days = 15;
        }
        $currentDate = date('d-m-Y', strtotime(getTodayDate()));
        $backDate = date('d-m-Y', strtotime($currentDate . ' - '.$days.' days'));
        $dateArr = $this->getDatesFromRange($backDate, $currentDate, $format = "d-m-Y");
        //printArr($dateArr);
        $orderAxisArr = [];
        $xAxisArr = [];
        $orderArr = [];
        $orderGraphTitle = "Transaction Graph";
        $col = array("count(transactionId) as transactionCount", "DATE_FORMAT(createdDate, '%d-%m-%Y') as createdDate", "DATE_FORMAT(createdDate, '%d-%m-%Y') as period");
        $where = array('where' => array("(DATE(createdDate) BETWEEN CURDATE() - INTERVAL ".$days." DAY AND CURDATE()) <>" => "0"));      
        $where["group_by"] = array("DATE(createdDate)");      
        //$where["order_by"] = array("DATE(createdDate)" => "ASC");      
        $orderGraphData = $this->Common_model->fetch_data("transactions", $col, $where, false);
        //printArr($orderGraphData);
        $monthsArr = array();
        $number = 15;
        for ($i = 1; $i <= $days; $i++) {
            if ($i < 10) {
                $i = "0" . $i;
            }
            array_push($monthsArr, $i);
        }
        if ($orderGraphData) {
            foreach ($orderGraphData as $row) {
                $orderArr[$row["period"]] = $row["transactionCount"];
                //$orderArr[$row["updatedDate"]] = $row["orderCount"];
            }
        }
        //printArr($orderArr);
        foreach ($dateArr as $val) { //$monthsArr
            //print_r($val);die;
            if (isset($orderArr[$val])) {
                $value = $orderArr[$val];
            } else {
                $value = 0;
            }
            $xAxisArr[] = date('d/m', strtotime($val));
            //$xAxisArr[] = $val;
            $orderAxisArr[] = $value;
        } 

        //printArr($xAxisArr);
        /////// graph end
        //printArr(json_encode($bookingArr));
        $data['adminData'] = $adminData;
        $data['orderGraphTitle'] = $orderGraphTitle;
        $data['xAxis'] = $xAxisArr;
        $data['orderAxis'] = $orderAxisArr;
*/

        $data['title'] = 'Dashboard';
        $data['main_content'] = 'dashboard';
        $this->load->view('layout/layout_superadmin', $data);
    }
	
	public function getDatesFromRange($startDate, $endDate, $format = "Y-m-d")
    {
        $return = array($startDate);
        $start = $startDate;
        $i=1;
        if (strtotime($startDate) < strtotime($endDate))
        {
           while (strtotime($start) < strtotime($endDate))
            {
                $start = date($format, strtotime($startDate.'+'.$i.' days'));
                $return[] = $start;
                $i++;
            }
        }

        return $return;
    }
    
    public function timeDiff($time1, $time2) {
        $time1 = strtotime($time1);
        $time2 = strtotime($time2);
        $difference = abs($time2 - $time1) / 3600;
        return $difference;
    }

    public function dateDiff($date1, $date2) {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }

    /**
     * *Search Ajax Pagination Function Process For Dashboard Remittance Section
     * */
    public function getAjaxRemittance() {
        //First thing to do!!!  
        if ($this->input->is_ajax_request()) {
            $data = array();
            $adminData = $this->check_session();
            //$postDataArr = $this->input->post();
            $limit = $this->perPage;
            $offset = 0;
            $like = "";
            $where = array("status" => '0');
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
            } else {
                $offset = $page;
            }
            $data['page'] = $page;
            //printArr($where);
            $order_by = array("rr.createdDate", "desc");
            $coloumn = array("SQL_CALC_FOUND_ROWS rr.*", "DATE_FORMAT(transactionDate, '%d-%m-%Y') as transactionDate", "m.fullName", "m.mobileNumber", "m.photo", "m.countryCode", "r.fullName as recipientName", "r.photo as recipientPhoto", "r.countryCode as recipientCountryCode", "r.photo as recipientMobileNumber");
            $remittanceData = $this->Remittance_model->getFullRemittanceData($coloumn, $where, $like, $order_by, $limit, $offset);
            $totalRec = $remittanceData['count'];
            //pagination configuration
            $config['target'] = '#userList';
            $config['base_url'] = base_url() . 'admin/getajaxremittance';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = $this->perPage;
            $config['link_func'] = 'searchFilter';
            $config['uri_segment'] = 4;
            $this->ajax_pagination->initialize($config);
            $result = $remittanceData['result'];
            $remittanceArr = array();
            foreach ($result as $val) {
                if (!empty($val['photo'])) {
                    $photo = base_url() . PUBLIC_ABS . PROFILE_PATH . $val['photo'];
                    $thumbImage = base_url() . PUBLIC_ABS . PROFILE_THUMB_PATH . $val['photo'];
                } else {
                    $photo = base_url() . PUBLIC_ABS . "images/noimg.png";
                    $thumbImage = base_url() . PUBLIC_ABS . "images/noimg.png";
                }
                $val["totalAmount"] = $this->getCurrencySymbol($val["currency"]) . $val["amount"];
                $val['photo'] = $photo;
                $val['thumbImage'] = $thumbImage;
                $val['flag'] = $this->getFlag($val['countryCode']);

                if (!empty($val['recipientPhoto'])) {
                    $recipientPhoto = base_url() . PUBLIC_ABS . PROFILE_PATH . $val['recipientPhoto'];
                    $recipientThumbImage = base_url() . PUBLIC_ABS . PROFILE_THUMB_PATH . $val['recipientPhoto'];
                } else {
                    $recipientPhoto = base_url() . PUBLIC_ABS . "images/noimg.png";
                    $recipientThumbImage = base_url() . PUBLIC_ABS . "images/noimg.png";
                }
                $val['recipientPhoto'] = $recipientPhoto;
                $val['recipientThumbImage'] = $recipientThumbImage;
                $val['recipientFlag'] = $this->getFlag($val['recipientCountryCode']);
                $remittanceArr[] = $val;
            }

            $pageInfo = $this->getAjaxShowingText($page, $limit, $totalRec);
            $data['adminData'] = $adminData;
            $data['remittance'] = $remittanceArr;
            $data['pageInfo'] = $pageInfo;
            $this->load->view('dashboard/ajax-pagination-data', $data);
        }
    }

    //Function for admin logout
    public function logout() {
        //Set flash data logout success
        $this->session->set_flashdata('logout_success', 'You are successfully Logout'); //set message 
        if (isset($this->session->userdata['adminLogin'])) {
            //Unset admin session data
            $this->session->unset_userdata('adminLogin', $this->session->userdata['adminLogin']);
        }
        //Redirect!
        redirect('/admin');
    }

//Function used for change admin password
    //POST DATA = oldPass, newPass and confmNewPass
    public function changePassword() {
        //First thing to do!!!
        $data['adminData'] = $this->check_session();
        $postDataArr = $this->input->post();
        //Check validation is TRUE or FALSE		
        if ($this->form_validation->run('admin/dashboard/changepass') == TRUE) {
            //Get session user Id (adminID)
            $admin_id = $data['adminData']['adminId'];
            //Call fetch_data function of Common Model get values
            //Function will return adminEmail
            $adminData = $this->Common_model->fetch_data('admin', 'adminEmail', array("where" => array("adminID" => $admin_id, "adminPassword" => md5($postDataArr['old_password']))), true);
            //Check if function return some value or not 
            if (!empty($adminData)) {
                $updateData['adminPassword'] = md5($postDataArr['new_password']);
                $where = array("where" => array('adminID' => $admin_id));
                //Call update_data function of Common model
                //Function will return TRUE or FALSE
                $result = $this->Common_model->update_single('admin', $updateData, $where);
                //Check if function return some value or not)
                //Set success message in flash data
                if ($result) {
                    $this->session->set_flashdata(STATUS_SUCCESS, CHANGED_PASSWORD);
                    redirect('/admin/dashboard/changepassword', 'refresh');
                    //redirect('/admin/dashboard/logout', 'refresh');  
                } else {
                    $this->session->set_flashdata(STATUS_ERROR, UPDATE_FAILED);
                }
            } else {
                $this->session->set_flashdata(STATUS_ERROR, WRONG_PASSWORD);
            }
        }

        $data["title"] = "Change Password";
        //$data['users'] = $userRow;
        $data['main_content'] = 'change_password/index';
        $this->load->view('layout/layout', $data);
        // }
    }

    public function CheckCourtBooking() {

        $postDataArr = $this->input->post();
        if (isset($postDataArr['startDate']) && !empty($postDataArr['startDate']) && isset($postDataArr['startTime']) && !empty($postDataArr['startTime']) && isset($postDataArr['endTime']) && !empty($postDataArr['endTime']) && isset($postDataArr['days']) && !empty($postDataArr['days']
                        //&& isset($postDataArr['bookingHours']) && !empty($postDataArr['bookingHours']
                )
        ) {
            $coloumn = array("openingTime", "closingTime");
            $where = array("where" => array("status" => "1"));
            $timeData = $this->Common_model->fetch_data("duration", $coloumn, $where, true);

            //$bookingDate = date("Y-m-d", strtotime($postDataArr['bookingDate']));
            $startDate = date("Y-m-d", strtotime($postDataArr['startDate']));
            $endDate = (isset($postDataArr['endDate']) && !empty($postDataArr['endDate'])) ? date("Y-m-d", strtotime($postDataArr['endDate'])) : "";
            $startTime = date("H:i:s", strtotime($postDataArr['startTime']));
            $endTime = date("H:i:s", strtotime($postDataArr['endTime']));
            $days = $postDataArr['days'];
            $daysArr = explode(",", $days);
            //$bookingHours = $postDataArr['bookingHours'];
            $bookingHours = $this->timeDiff($startTime, $endTime);
            $currentDate = date("Y-m-d", strtotime(getTodayDate()));
            $availableCourt = 0;
            $tempCourt = 6;
            if (!empty($endDate)) {
                $datesArr = $this->getDatesArr($startDate, $endDate, $daysArr);
            } else {
                $datesArr = array($startDate);
            }
            foreach ($datesArr as $val) {
                $bookingDate = $val;
                $fullBookingTime = $bookingDate . " " . $startTime;
                for ($i = 0, $j = 1; $i < $bookingHours; $i++, $j++) {
                    $start = date('H:i:s', strtotime('+' . $i . ' hour', strtotime($startTime)));
                    $checkStartTime = strtotime('+' . $i . ' hour', strtotime($fullBookingTime));
                    $end = date('H:i:s', strtotime('+' . $j . ' hour', strtotime($startTime)));
                    $checkEndTime = strtotime('+' . $j . ' hour', strtotime($fullBookingTime));
                    //echo $bookingDate." ".$start . " ==== ".$bookingDate." ".$end ." ==== ". $bookingDate." ".$timeData["closingTime"] . " ===== ".strtotime($end) . " ===== ". strtotime($timeData["closingTime"]); echo "<br>";
                    //echo date('Y-m-d H:i:s', $checkStartTime). " ==== ".date('Y-m-d H:i:s', $checkEndTime)." ==== ".$bookingDate." ".$timeData["closingTime"]; echo "<br>";
                    if ($checkEndTime <= strtotime($bookingDate . " " . $timeData["closingTime"])) {
                        $where = array("bookingDate" => $bookingDate, "startTime" => $start, "endTime" => $end);
                        $bookingData = $this->Court_Booking_model->getBookingData(array("SUM(numberOfCourt) as numberOfCourt"), $where, true);
                        $bookedCourt = $bookingData["numberOfCourt"];
                        $availableCourt = 6 - $bookedCourt;
                        if ($availableCourt < $tempCourt) {
                            $tempCourt = $availableCourt;
                        }
                        $availableCourt = $tempCourt;
                        $flag = true;
                        /* if ($availableCourt < $numberOfCourt) {
                          $this->webserviceResponse(UNSUCCESS_CODE, "Court Not Available");
                          } else {
                          $flag = true;
                          } */
                    } else {
                        $availableCourt = 0;
                        $flag = true;
                        //$this->webserviceResponse(UNSUCCESS_CODE, "Court Not Available");
                    }
                }
            }
            $this->jsonResponse(array("success_code" => 200, "message" => DATA_FOUND, "availableCourt" => $availableCourt));
        }
    }

    public function getDatesArr($startDate, $endDate, $daysArr) {
        $date_Arr = array();
        $date_from = strtotime($startDate); // Convert date to a UNIX timestamp  
        $date_to = strtotime($endDate); // Convert date to a UNIX timestamp  
        for ($i = $date_from; $i <= $date_to; $i+=86400) {
            $dt = date("Y-m-d", $i);
            if (in_array(date("D", $i), $daysArr)) {
                array_push($date_Arr, $dt);
            }
            //echo date("Y-m-d", $i).'<br />';  
        }
        return $date_Arr;
    }

    public function SaveBlock() {
        $postDataArr = $this->input->post();
        if (!empty($postDataArr)) {
            //printArr($postDataArr);
            //$bookingDate = date("Y-m-d", strtotime($postDataArr['bookingDate']));
            $startDate = date("Y-m-d", strtotime($postDataArr['startDate']));
            $endDate = (isset($postDataArr['endDate']) && !empty($postDataArr['endDate'])) ? date("Y-m-d", strtotime($postDataArr['endDate'])) : "";
            $startTime = date("H:i:s", strtotime($postDataArr['startTime']));
            $endTime = date("H:i:s", strtotime($postDataArr['endTime']));
            $numberOfCourt = $postDataArr['numberOfCourt'];
            $days = $postDataArr['days'];
            //$daysArr = explode(",", $days);
            $daysArr = $days;
            //$bookingHours = $postDataArr['bookingHours'];
            $blockTitle = $postDataArr['blockTitle'];
            $bookingHours = $this->timeDiff($startTime, $endTime);
            //echo $bookingHours; die;
            if (!empty($endDate)) {
                $datesArr = $this->getDatesArr($startDate, $endDate, $daysArr);
            } else {
                $datesArr = array($startDate);
            }
            foreach ($datesArr as $val) {
                $bookingDate = $val;
                $bookingRefNumber = generateBarcode(8);
                //$endTime = date('H:i:s', strtotime('+' . $bookingHours . ' hour', strtotime($startTime)));
                $insert = array();
                $insert["bookingDate"] = $bookingDate;
                $insert["bookingRefNumber"] = $bookingRefNumber;
                $insert["startTime"] = $startTime;
                $insert["endTime"] = $endTime;
                $insert["numberOfCourt"] = $numberOfCourt;
                $insert["bookingHours"] = $bookingHours;
                $insert["bookingStatus"] = "2";
                $insert["createdDate"] = getTodayDate();
                $insert['updatedDate'] = getTodayDate();
                //printArr($insert);
                $bookingId = $this->Booking_model->insert($insert);
                for ($i = 0, $j = 1; $i < $bookingHours; $i++, $j++) {
                    $start = date('H:i:s', strtotime('+' . $i . ' hour', strtotime($startTime)));
                    $end = date('H:i:s', strtotime('+' . $j . ' hour', strtotime($startTime)));
                    $insert = array();
                    $insert["bookingDate"] = $bookingDate;
                    $insert["startTime"] = $start;
                    $insert["endTime"] = $end;
                    $insert["numberOfCourt"] = $numberOfCourt;
                    $insert["bookingId"] = $bookingId;
                    $insert["bookingHours"] = "1";
                    $insert["bookingStatus"] = "2";
                    $insert["blockTitle"] = $blockTitle;
                    $insert["createdDate"] = getTodayDate();
                    $insert['updatedDate'] = getTodayDate();
                    //printArr($insert);
                    $courtBookingId = $this->Court_Booking_model->insert($insert);
                }
            }
            if ($courtBookingId) {
                $this->jsonResponse(array("success_code" => 200, "message" => DATA_INSERT));
            } else {
                $this->jsonResponse(array("success_code" => 400, "message" => DATA_NOT_INSERT));
            }
        } else {
            $this->jsonResponse(array("success_code" => 400, "message" => PARAM_MISSING));
        }
    }

    public function GetBookingInfo() {
        $postDataArr = $this->input->post();
        if (!empty($postDataArr)) {
            $bookingId = $postDataArr['bookingId'];
            $bookingDate = $postDataArr['bookingDate'];
            $startTime = $postDataArr['startTime'];
            $endTime = $postDataArr['endTime'];
            $where = array("b.bookingId" => $bookingId, "b.bookingDate" => $bookingDate, "b.startTime" => $startTime, "b.endTime" => $endTime);
            $bookingData = $this->Court_Booking_model->getCourtBookingData(array("u.userId", "u.fullName", "u.mobile", "b.bookingDate", "b.startTime", "b.endTime", "customerName", "customerMobile", "customerEmail", "bookingMedium"), $where, array(), true);
            if ($bookingData) {
                $bookingData["fullName"] = !empty($bookingData['fullName']) ? ucwords($bookingData['fullName']) : ucwords($bookingData['customerName']) . ", " . $bookingData['customerEmail'] . " booked by " . $bookingData['bookingMedium'];
                $bookingData["mobile"] = !empty($bookingData['mobile']) ? ucwords($bookingData['mobile']) : $bookingData['customerMobile'];
                $bookingData["bookingDate"] = date("d-m-Y", strtotime($bookingData['bookingDate']));
                $bookingData["startTime"] = date("h A", strtotime($bookingData['startTime']));
                $bookingData["endTime"] = date("h A", strtotime($bookingData['endTime']));
                $this->jsonResponse(array("success_code" => 200, "message" => DATA_FOUND, "bookingData" => $bookingData));
            } else {
                $this->jsonResponse(array("success_code" => 400, "message" => DATA_NOT_FOUND));
            }
        } else {
            $this->jsonResponse(array("success_code" => 400, "message" => PARAM_MISSING));
        }
    }

    public function UnblockSlot() {
        $postDataArr = $this->input->post();
        if (!empty($postDataArr)) {
            $bookingId = $postDataArr['bookingId'];
            $startTime = $postDataArr['startTime'];
            $endTime = $postDataArr['endTime'];
            $where = array("bookingId" => $bookingId, "bookingStatus" => "2");
            $bookingData = $this->Booking_model->getBookingData(array("bookingId", "numberOfCourt"), $where, true);
            if ($bookingData) {
                //echo $bookingData["numberOfCourt"]; die;
                $where = array("bookingId" => $bookingId);
                $courtData = $this->Court_Booking_model->getBookingData(array("count(courtBookingId) as cnt"), $where, true);
                //echo $courtData["cnt"]; die;
                $where = array("bookingId" => $bookingId, "startTime" => $startTime, "endTime" => $endTime);
                $courtNumberData = $this->Court_Booking_model->getBookingData(array("numberOfCourt"), $where, true);
                $numberOfCourt = $courtNumberData["numberOfCourt"];
                if ($numberOfCourt > 1) {
                    //$where = array("bookingId" => $bookingId, "startTime" => $startTime, "endTime" => $endTime);
                    $update = array();
                    $update["numberOfCourt"] = (int) $numberOfCourt - 1;
                    $update["updatedDate"] = getTodayDate();
                    $courtBookingId = $this->Court_Booking_model->update($where, $update);
                } else {
                    $courtBookingId = $this->Court_Booking_model->delete($where);
                }
                if ($courtBookingId) {
                    //if ($courtData["cnt"] == "1") {
                    if ($bookingData["numberOfCourt"] == "1") {
                        $where = array("bookingId" => $bookingId, "bookingStatus" => "2");
                        $this->Booking_model->delete($where);
                    } else {
                        $where = array("bookingId" => $bookingId, "bookingStatus" => "2");
                        $update = array();
                        $update["numberOfCourt"] = (int) $bookingData["numberOfCourt"] - 1;
                        $update["updatedDate"] = getTodayDate();
                        $this->Booking_model->update($where, $update);
                    }
                    $this->jsonResponse(array("success_code" => 200, "message" => DELETE_SUCCESS));
                } else {
                    $this->jsonResponse(array("success_code" => 400, "message" => DELETE_FAILED));
                }
            } else {
                $this->jsonResponse(array("success_code" => 400, "message" => DATA_NOT_FOUND));
            }
        } else {
            $this->jsonResponse(array("success_code" => 400, "message" => PARAM_MISSING));
        }
    }

}
