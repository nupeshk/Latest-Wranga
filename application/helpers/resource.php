<?php ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resource extends CI_Controller {
		function __construct(){
			parent::__construct();
			$data=array();
			$this->load->library('session');
			$data['CONTACT'] = $this->admincms_model->selectContact(1);	
			$this->load->model('Adminmodel');	
			$this->load->model('Common');
			//$this->load->library('session');
			$data['BEST'] =$this->Common->selectData('tbl_fbanner','pdf',array('status'=>'1'));
			$global_data = array('some_var'=>$data['BEST'][0]->pdf);
			$data['BEST'] =$this->Common->selectData('tbl_fbanner','pdf',array('status'=>'1')); 
			$this->load->vars($global_data);			
		}
		
		
	public function validateResource(){
        if(!$this->session->userdata('logged_in')['RESOURCE']) {	
			$msg=array("MSG"=>'<div class="isa_warning">Please login here</div>');
			$this->session->set_userdata($msg);
            header("location:".PATH_URL.'login');
        }
    }	
		
	public function logout(){	
		$this->session->unset_userdata('RESOURCE');
		header("location:".PATH_URL);

    }
	
	
	
	
	public function resourceIndex(){
		$this->validateResource();
		$data['mfg_customers']= $this->Common->selectData('mfg_customers');
		$data['mfg_comments']= $this->Common->selectData('mfg_comments');
		$data['_view'] = 'engineeringResource/index';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceEnquiry(){
		$this->validateResource();
		$data['mfg_customers']= $this->Common->selectData('mfg_customers');
		$data['_view'] = 'engineeringResource/enquiry';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceChat(){
		$this->validateResource();
		$data['mfg_customers']= $this->Common->selectData('mfg_customers');
		$data['_view'] = 'engineeringResource/chat';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceComments(){
		$this->validateResource();
		$data['mfg_comments']= $this->Common->selectData('mfg_comments');
		$data['_view'] = 'engineeringResource/comments';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceSubscription(){
		$this->validateResource();
		$data['_view'] = 'engineeringResource/subscription';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceTransactionStatus(){
		$this->validateResource();
		$data['mfg_transaction_status']= $this->Common->selectData('mfg_transaction_status');
		$data['_view'] = 'engineeringResource/transaction-status';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	
	public function resourceProfile($email = NULL){
		$email=$this->session->userdata('logged_in')['email'];
		$this->validateResource();
		if($email && $_POST){
				$columnArr = $this->input->post();




				if($_FILES['banner']['size'] == 0){
					$columnArr["banner"] = $_POST["banner1"];
				}else{
				    $pre= time(); 
					$image=$_FILES['banner']['name'];
					$target_path = "assets/banner/";
					$file= $_FILES['banner']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["banner"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$columnArr["banner"] = $pre.$file;
				  }
				  
				unset($columnArr['banner1']);				
				unset($columnArr['submit']);



				$row = $this->Adminmodel->updateDb('mfg_designer', $columnArr,array('email'=> $email));
				
				$msg=array("MSG"=>'<div class="isa_success">Profile Updated Successfully</div>');
				$this->session->set_userdata($msg);
		}	
		


		$data = array();
		if($email){
			$data['cmsdata'] = $this->Common->selectData('mfg_designer','*',array('email'=>$email));		
		}else{
			$data['cmsdata']=NULL; 
		}
		$data['mfg_transaction_status']= $this->Common->selectData('mfg_transaction_status');
		$data['mfg_category']= $this->Common->selectData('mfg_category');
		$data['mfg_sub_category']= $this->Common->selectData('mfg_sub_category');
		$data['mfg_subsub_category']= $this->Common->selectData('mfg_subsub_category');


		
		$data['_view'] = 'engineeringResource/profile';	
		$this->load->view('layouts/engineeringresource',$data);	

    }


	
	public function resourceNotification(){
		$this->validateResource();
		$data['mfg_notification']= $this->Common->selectData('mfg_notification');
		$data['_view'] = 'engineeringResource/notification';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceViewNotification(){
		$this->validateResource();
		$data['mfg_notification']= $this->Common->selectData('mfg_notification');
		$data['_view'] = 'engineeringResource/view-notification';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceChangePassword(){
		$this->validateResource();
		$data['_view'] = 'engineeringResource/change-password';	
		$this->load->view('layouts/engineeringresource',$data);	
    }
	
	public function resourceLogout(){
		$this->validateResource();
    }
	
			

}

//class/* End of file welcome.php *//* Location: ./application/controllers/welcome.php */