<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/Admin/controllers/Base_Controller.php';

// Including Phil Sturgeon's Rest Server Library in our Server file.

class Users extends Base_Controller {
    /*
     * __construct function.
     * 
     * @access public
     * @return void
     */

    public function __construct() {
        parent::__construct();
        //Load all libraries, configs, models, langs and such here!
        //$this->load->library('m_pdf');
        $this->perPage = 20;
    }

    public function index() {
        //First thing to do!!!        
        $data = array();
        $adminData = $this->check_session();
        $postDataArr = $this->input->post();
        $limit = $this->perPage;
        $offset = 0;
        $coloumn = array("SQL_CALC_FOUND_ROWS u.*, 
            DATE_FORMAT(createdDate, '%d-%m-%Y') as createdDate,
            DATE_FORMAT(dob, '%d-%m-%Y') as dob, 
            DATE_FORMAT(lastTransactionDate, '%d-%m-%Y') as lastTransactionDate"
        );
        $where = array("isDeleted" => '0');
        $like = "";
        //printArr($postDataArr) ;
        if (isset($postDataArr['search']) && !empty($postDataArr['search'])) {
            $like = array("firstName" => $postDataArr['search']);
        }

        $order_by = array("u.createdDate", "desc");
        $userData = $this->User_model->getUserList($coloumn, $where, $like, $order_by, $limit, $offset);
        $totalRec = $userData['count'];
        $result = $userData['result'];
        $userArr = array();
        if ($result) {
            foreach ($result as $val) {

                //$image = $this->getImageUrl($val['photo'], "user");
                $val["firstName"] = ucwords($val["firstName"]);
                $val["lastName"] = ucwords($val["lastName"]);
                //$val['photo'] = $image["image"];
                //$val['thumbImage'] = $image["thumbImage"];
                //$val['deviceType'] = $this->getDeviceType($val['userId']);
                $userArr[] = $val;
            }
        }

        //pagination configuration
        $config['target'] = '#userList';
        $config['base_url'] = base_url() . 'admin/users/getajax';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->ajax_pagination->initialize($config);

        $pageInfo = $this->getShowingText($totalRec);
        $data["title"] = "Users";
        $data['post'] = $postDataArr;
        $data['adminData'] = $adminData;
        $data['userArr'] = $userArr;
        $data['pageInfo'] = $pageInfo;
        $data['totalUsers'] = $totalRec;
        $data['main_content'] = 'users/index';
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
            $like = "";
            $where = array("isDeleted" => '0');

            if (isset($postDataArr['search']) && !empty($postDataArr['search'])) {
                $like = array("firstName" => $postDataArr['search']);
            }
            $order_by = array("u.createdDate", "desc");

            $limit = $this->perPage;
            $offset = 0;

            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
            } else {
                $offset = $page;
            }
            $data['page'] = $page;
            $coloumn = array("SQL_CALC_FOUND_ROWS u.*, 
                DATE_FORMAT(createdDate, '%d-%m-%Y') as createdDate, 
                DATE_FORMAT(dob, '%d-%m-%Y') as dob,
                DATE_FORMAT(lastTransactionDate, '%d-%m-%Y') as lastTransactionDate");
            $userData = $this->User_model->getUserList($coloumn, $where, $like, $order_by, $limit, $offset);
            $totalRec = $userData['count'];
            $result = $userData['result'];
            $userArr = array();
            if ($result) {
                foreach ($result as $val) {
                    //$image = $this->getImageUrl($val['photo'], "user");
                    $val["firstName"] = ucwords($val["firstName"]);
                    $val["lastName"] = ucwords($val["lastName"]);
                    //$val['photo'] = $image["image"];
                    //$val['thumbImage'] = $image["thumbImage"];
                    $userArr[] = $val;
                }
            }
            //pagination configuration
            $config['target'] = '#userList';
            $config['base_url'] = base_url() . 'admin/users/getajax';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = $this->perPage;
            $config['link_func'] = 'searchFilter';
            $config['uri_segment'] = 4;
            $this->ajax_pagination->initialize($config);

            $pageInfo = $this->getAjaxShowingText($page, $limit, $totalRec);
            $data['post'] = $postDataArr;
            $data['adminData'] = $adminData;
            $data['userArr'] = $userArr;
            $data['pageInfo'] = $pageInfo;
            $data['totalUsers'] = $totalRec;
            $this->load->view('users/ajax-pagination-data', $data);
        }
    }

    /**
     * *Update user Function
     * */
    public function Edit() {
        $data = array();
        $data['adminData'] = $this->check_session();

        $postDataArr = $this->input->post();

        $this->form_validation->set_data($postDataArr);
        $this->form_validation->set_rules('userId', 'userId', 'trim|required');
        $this->form_validation->set_rules('firstName', 'firstName', 'trim|required');
        $this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
        //$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $userId = $postDataArr['userId'];
            $firstName = $postDataArr['firstName'];
            $lastName = $postDataArr['lastName'];
            $mobile = $postDataArr['mobile'];
            $email = (isset($postDataArr['email']) && !empty($postDataArr['email'])) ? $postDataArr['email'] : "";
            
            $update = array(
                "firstName" => $firstName,
                "lastName" => $lastName,
                "email" => $email,
                "mobile" => $mobile,
                "updatedDate" => getTodayDate()
            );
            $where = array("where" => array('userId' => $userId));
            $success = $this->Common_model->update_single("users", $update, $where);
            if ($success) {
                $this->jsonResponse(array("success_code" => 200, "message" => UPDATE_SUCCESS));
                //$this->session->set_flashdata('success', UPDATE_SUCCESS);
                //redirect('/admin/video', 'refresh');
            } else {
                $this->jsonResponse(array("success_code" => 400, "message" => UPDATE_FAILED));
                //$this->session->set_flashdata('error', UPDATE_FAILED);
            }
        }
    }
    
    public function getDeviceType($userId) {
        $where = array("where" => array('userId' => $userId));
        $where["order_by"] = array('id' => "DESC");
        $where["limit"] = array('1');
        $outhKeyArr = $this->Common_model->fetch_data("authtoken", array("deviceType"), $where, true);
        $deviceType = "";
        if ($outhKeyArr) {
            if ($outhKeyArr["deviceType"] == "1") {
                $deviceType = "iOS";
            } else {
                $deviceType = "Android";
            }
        }
        return $deviceType;
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

    public function CheckMobile() {
        $postData = $this->input->post();
        $mobile = $postData['mobile'];
        $userId = $postData['userId'];
        if (!empty($mobile) && !empty($userId)) {
            $where = array("where" => array('mobile' => $mobile, 'userId != ' => $userId,  'isDeleted' => '0'));
            $success = $this->Common_model->fetch_data("users", "userId", $where, true);
            if (!$success) {
                echo "true";
            } else {
                echo "false";
            }
        } else {
            echo "false";
        }
    }

    public function CheckEmail() {
        $postData = $this->input->post();
        $email = $postData['email'];
        $userId = $postData['userId'];
        if (!empty($email) && !empty($userId)) {
            $where = array("where" => array('email' => $email, 'userId != ' => $userId,  'isDeleted' => '0'));
            $success = $this->Common_model->fetch_data("users", "userId", $where, true);
            if (!$success) {
                echo "true";
            } else {
                echo "false";
            }
        } else {
            echo "false";
        }
    }
    
    public function GenerateIdCard() {
        $data = array();
        $adminData = $this->check_session();
        $userId = $this->uri->segment(4);
        $where = array("userId" => $userId);
        $userData = $this->User_model->getUserData(array(), $where, true);
        $image = $this->getImageUrl($userData['photo'], "user");
        $data["fullName"] = ucwords($userData["fullName"]);
        $data["email"] = $userData["email"];
        $data["mobile"] = $userData["mobile"];
        $data['photo'] = $image["image"];
        $data['thumbImage'] = $image["thumbImage"];
        $data["qrCodeImage"] = base_url() . 'public/qrcode/' . "qr_". $userId . ".png";
        
        $file_name = "id_card_download_" . $userId . ".pdf";
        $export_html = $this->load->view('users/user-id-card', $data, true);
        //echo $export_html; die;
        $this->m_pdf->pdf->SetDisplayMode('fullpage');
        $this->m_pdf->pdf->AddPage('', // L - landscape, P - portrait 
                '', '', '', '', 20, // margin_left
                20, // margin right
                15, // margin top
                15, // margin bottom
                0, // margin header
                0); // margin footer 
        $this->m_pdf->pdf->WriteHTML($export_html);
        $this->m_pdf->pdf->Output($file_name, "D");
    }
    
    
    /*     * Export* */

    public function Export() {

        $adminData = $this->check_session();
        require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('greychaindesign.com')
        ->setLastModifiedBy('Mohd Shahid')
        ->setTitle('User Export')
        ->setSubject('integrate codeigniter with PhpExcel')
        ->setDescription('User Export');

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
        $spreadsheet->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);


        // auto fit column to content

        foreach (range('A', 'D') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
        }
        // set the names of header cells
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue("A1", 'Name')
        ->setCellValue("B1", 'Email')
        ->setCellValue("C1", 'Mobile')
        ->setCellValue("D1", 'Active');

        // Add some data

        $postDataArr = $this->input->get();
        //printArr($postDataArr); die;
        $limit = 0;
        $offset = 0;
        $like = "";
        $coloumn = array("SQL_CALC_FOUND_ROWS u.userId, firstName, lastName, email, mobile, status, DATE_FORMAT(createdDate, '%d-%m-%Y') as createdDate, DATE_FORMAT(lastTransactionDate, '%d-%m-%Y') as lastTransactionDate");
        $where = array("isDeleted" => '0');
        //printArr($postDataArr) ;
        if (isset($postDataArr['search']) && !empty($postDataArr['search'])) {
            $like = array("fullName" => $postDataArr['search']);
        }
        
        $order_by = array("u.userId", "asc");
        $userData = $this->User_model->getUserList($coloumn, $where, $like, $order_by, $limit, $offset);
        $totalRec = $userData['count'];
        $result = $userData['result'];
        //printArr($result);
        $x = 2;
        foreach ($result as $val) {
            $active = ($val['status'] == "1") ? "Yes": "No"; 
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue("A$x", ucwords($val['firstName'] ." ". $val['lastName']))
            ->setCellValue("B$x", $val['email'])
            ->setCellValue("C$x", $val['mobile'])
            ->setCellValue("D$x", $active);
            $x++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Users Data');

        // set right to left direction
        //		$spreadsheet->getActiveSheet()->setRightToLeft(true);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $fileName = "user_" . date("YmdHis") . ".xlsx";
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
        $writer->save('php://output');
        exit;

        //  create new file and remove Compatibility mode from word title
    }
    // end
}
