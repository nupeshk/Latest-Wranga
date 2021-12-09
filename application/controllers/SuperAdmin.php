<?php ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Superadmin extends CI_Controller {
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
		
		

	public function validateSuperAdmin(){
        if(!$this->session->userdata('logged_in')['ADMIN']) {
			$msg=array("MSG"=>'<div class="isa_warning">Please login here</div>');
			$this->session->set_userdata($msg);
            header("location:".PATH_URL.'superadmin/login');
        }
    }

	

	function logout(){
		$this->session->unset_userdata('ADMIN');
		header("location:".PATH_URL.'superadmin');
	}
	


		public function login(){
	//	print_r($this->session->userdata('logged_in'));
		/*if($this->session->userdata('logged_in')){
			 header("location:".SITE_URL);
		}*/
		/*if(empty($_POST)){
			$newdata = array(
                   'backPage'     => $_SERVER['HTTP_REFERER'],
                   'back' => TRUE
               );
			$this->session->set_userdata($newdata);
			$session_id = $this->session->userdata('backPage');
		}*/

		if($_POST){
					$columnArr = array();
					$columnArr["email"] = $_POST["email"];
					//$columnArr["password"] = md5($_POST["password"]);
					$columnArr["password"] = $_POST["password"];
					$data['userdata'] = $this->Common->selectData('mfg_admin','*',$columnArr);

						if(count($data['userdata'])>0){
									$user=array("ADMIN"=>'true',
										 'id'=>$data['userdata'][0]->id,
										 'name'=>$data['userdata'][0]->name,
										 'email'=>$data['userdata'][0]->email,
										 'mobile'=>$data['userdata'][0]->phone
										);
									header("Location: ".PATH_URL."superadmin/index");
							$this->session->set_userdata('logged_in', $user);
							print_r($this->session->userdata('logged_in')); 
							//print_r($data['userdata']);
							/*if($this->session->userdata('backPage')){
								header("Location: ".$this->session->userdata('backPage'));
							}else{
								header("Location: ".SITE_URL."user_dashboard");
							}*/						
						}
						else{
							$msg=array("MSG"=>'<div class="isa_warning">Invalid Details</div>');
							$this->session->set_userdata($msg);
						}
			}

		$data['_view'] = 'front/superadmin';	
		$this->load->view('layouts/main',$data);	
	}

	
	
	// Index
	public function superIndex(){
		$this->validateSuperAdmin();
		$data['mfg_suppliers']= $this->Common->selectData('mfg_suppliers');
		$data['mfg_customers']= $this->Common->selectData('mfg_customers');
		$data['mfg_designer']= $this->Common->selectData('mfg_designer');
		$data['mfg_enquiry']= $this->Common->selectData('mfg_enquiry');
		$data['mfg_comments']= $this->Common->selectData('mfg_comments');
		$data['mfg_comment']= $this->Common->selectData('mfg_comment');
		$data['_view'] = 'superAdmin/index';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Suppliers
	public function supplier(){
		$this->validateSuperAdmin();
		$data['mfg_suppliers']= $this->Common->selectData('mfg_suppliers');
		$data['_view'] = 'superAdmin/suppliers';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Supplier View Details
	public function supplierViewDetails(){
		$this->validateSuperAdmin();
		$data['mfg_suppliers']= $this->Common->selectData('mfg_suppliers');
		$data['_view'] = 'superAdmin/supplier-view-details';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Customers
	public function customer(){
		$this->validateSuperAdmin();
		$data['mfg_customers']= $this->Common->selectData('mfg_customers');
		$data['_view'] = 'superAdmin/customers';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Customer View Details
	public function customerViewDetails(){
		$this->validateSuperAdmin();
		$data['mfg_customers']= $this->Common->selectData('mfg_customers');
		$data['_view'] = 'superAdmin/customer-view-details';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Designers
	public function designers(){
		$this->validateSuperAdmin();
		$data['mfg_designer']= $this->Common->selectData('mfg_designer');
		$data['_view'] = 'superAdmin/designers';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Designer View Details
	public function designerViewDetails(){
		$this->validateSuperAdmin();
		$data['mfg_designer']= $this->Common->selectData('mfg_designer');
		$data['_view'] = 'superAdmin/designer-view-details';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Enquiry
	public function enquiry(){
		$this->validateSuperAdmin();
		$data['mfg_enquiry']= $this->Common->selectData('mfg_enquiry');
		$data['_view'] = 'superAdmin/enquiry';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Send Enquiry
	public function sendEnquiry(){
		$this->validateSuperAdmin();
		$data['mfg_enquiry']= $this->Common->selectData('mfg_enquiry');
		$data['_view'] = 'superAdmin/send-enquiry';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Chat
	public function chat(){
		$this->validateSuperAdmin();
		$data['mfg_enquiry']= $this->Common->selectData('mfg_enquiry');
		$data['_view'] = 'superAdmin/chat';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Comments
	public function comments(){
		$this->validateSuperAdmin();
		$data['mfg_comments']= $this->Common->selectData('mfg_comments');
		$data['mfg_comment']= $this->Common->selectData('mfg_comment');
		
		$data['_view'] = 'superAdmin/comments';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Subscription
	public function subscription(){
		$this->validateSuperAdmin();
		$data['_view'] = 'superAdmin/subscription';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Transaction Status
	public function transactionStatus(){
		$this->validateSuperAdmin();
		$data['mfg_transaction_status']= $this->Common->selectData('mfg_transaction_status');
		$data['_view'] = 'superAdmin/transaction-status';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Pages
	public function pages(){
		$this->validateSuperAdmin();
		$data['mfg_pages']= $this->Common->selectData('mfg_pages');
		$data['_view'] = 'superAdmin/pages';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Add Blog
	public function addBlog($id = NULL){
		$this->validateSuperAdmin();
		if($_POST  && $id==''){
			$columnArr = $this->input->post();
                    if($_FILES['banner']){
					$pre= time(); 
					$image=$_FILES['banner']['name'];
					$target_path = "assets/banner/";
					$file= $_FILES['banner']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["banner"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
				}		
		$columnArr["banner"] = $pre.$file;
		unset($columnArr['banner1']);
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_blog', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">The news added  Successfully</div>');
				$this->session->set_userdata($msg);

			}elseif($id && $_POST){
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
				  
				unset($columnArr['submit']);
				unset($columnArr['banner1']);
		
				$row = $this->Adminmodel->updateDb('mfg_blog', $columnArr,array('id'=> $id));
				
				$msg=array("MSG"=>'<div class="isa_success">Record updated successfully</div>');
				$this->session->set_userdata($msg);
		}

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_blog','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}	
	
		$data['_view'] = 'superAdmin/add-blog';	
		$this->load->view('layouts/superadmin',$data);
    }



	// Add Page
	public function addPage($id = NULL){
		$this->validateSuperAdmin();
		if($_POST  && $id==''){
			$columnArr = $this->input->post();
                    if($_FILES['banner']){
					$pre= time(); 
					$image=$_FILES['banner']['name'];
					$target_path = "assets/banner/";
					$file= $_FILES['banner']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["banner"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
				}		
		$columnArr["banner"] = $pre.$file;
		unset($columnArr['banner1']);
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_pages', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">New Page added Successfully</div>');
				$this->session->set_userdata($msg);

			}elseif($id && $_POST){
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
				  
				unset($columnArr['submit']);
				unset($columnArr['banner1']);
		
				$row = $this->Adminmodel->updateDb('mfg_pages', $columnArr,array('id'=> $id));
				$msg=array("MSG"=>'<div class="isa_success">Record updated successfully</div>');
				$this->session->set_userdata($msg);
		}

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_pages','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}	

	

		$data['_view'] = 'superAdmin/add-page';	
		$this->load->view('layouts/superadmin',$data);

    }

	
	/*public function editPage(){
		$this->validateSuperAdmin();
		$data['mfg_pages']= $this->Common->selectData('mfg_pages');
		$data['_view'] = 'superAdmin/edit-page';	
		$this->load->view('layouts/superadmin',$data);	
    }*/
	
	
	// Navigation
	public function Navigation($id = NULL){
		$this->validateSuperAdmin();
		
		if($_POST  && $id==''){
			$columnArr = $this->input->post();
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_navigation', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">Navigation Successfully</div>');
				$this->session->set_userdata($msg);
			}elseif($id && $_POST){
				$columnArr = $this->input->post();
				//print_r($columnArr);
				unset($columnArr['submit']);
				$row = $this->Adminmodel->updateDb('mfg_navigation', $columnArr,array('id'=> $id));
				$msg=array("MSG"=>'<div class="isa_success">Navigation Updated Successfully</div>');
				$this->session->set_userdata($msg);
		}	

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_navigation','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}
		
		$data['mfg_navigation']= $this->Common->selectData('mfg_navigation');
		$data['mfg_category']= $this->Common->selectData('mfg_category');
		$data['mfg_sub_category']= $this->Common->selectData('mfg_sub_category');
		$data['mfg_subsub_category']= $this->Common->selectData('mfg_subsub_category');
		
		$data['_view'] = 'superAdmin/navigation';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Add Main Category
		public function addMainCategory($id = NULL){
		$this->validateSuperAdmin();

		if($_POST  && $id==''){
			$columnArr = $this->input->post();
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_category', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">Main Category Successfully</div>');
				$this->session->set_userdata($msg);
			}elseif($id && $_POST){
				$columnArr = $this->input->post();
				//print_r($columnArr);
				unset($columnArr['submit']);
				$row = $this->Adminmodel->updateDb('mfg_category', $columnArr,array('id'=> $id));
				$msg=array("MSG"=>'<div class="isa_success">main Category Updated Successfully</div>');
				$this->session->se1t_userdata($msg);
		}	

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_category','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}
		
		$data['mfg_category']= $this->Common->selectData('mfg_category');
		$data['_view'] = 'superAdmin/add-main-category';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Add Sub Category
	public function addSubCategory($id = NULL){
		$this->validateSuperAdmin();
		
		if($_POST  && $id==''){
			$columnArr = $this->input->post();
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_sub_category', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">Add Sub Category Successfully</div>');
				$this->session->set_userdata($msg);
			}elseif($id && $_POST){
				$columnArr = $this->input->post();
				//print_r($columnArr);
				unset($columnArr['submit']);
				$row = $this->Adminmodel->updateDb('mfg_sub_category', $columnArr,array('id'=> $id));
				$msg=array("MSG"=>'<div class="isa_success">Sub category Updated Successfully</div>');
				$this->session->set_userdata($msg);
		}	

		$data = array();
		if(isset($id)){
			$data['cmsdata'] = $this->Common->selectData('mfg_sub_category','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}
		
		$data['mfg_category']= $this->Common->selectData('mfg_category');
		$data['mfg_sub_category']= $this->Common->selectData('mfg_sub_category');



		$data['_view'] = 'superAdmin/add-sub-category';	
		$this->load->view('layouts/superadmin',$data);	
    }

	
	
	// Add Sub 2 Sub Category
	public function addSub2subCategory($id = NULL){
		$this->validateSuperAdmin();
		
		if($_POST  && $id==''){
			$columnArr = $this->input->post();
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_subsub_category', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">Add Sub 2 Sub Category Successfully</div>');
				$this->session->set_userdata($msg);
			}elseif($id && $_POST){
				$columnArr = $this->input->post();
				//print_r($columnArr);
				unset($columnArr['submit']);
				$row = $this->Adminmodel->updateDb('mfg_subsub_category', $columnArr,array('id'=> $id));
				$msg=array("MSG"=>'<div class="isa_success">Sub 2 Sub category Updated Successfully</div>');
				$this->session->set_userdata($msg);
		}	

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_subsub_category','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}
		$data['mfg_category']= $this->Common->selectData('mfg_category');
		$data['mfg_sub_category']= $this->Common->selectData('mfg_sub_category');
		$data['mfg_subsub_category']= $this->Common->selectData('mfg_subsub_category');

		$data['_view'] = 'superAdmin/add-sub2sub-category';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Banner
	public function banner($id = NULL){
		$this->validateSuperAdmin();

		if($_POST  && $id==''){
			$columnArr = $this->input->post();
                    if($_FILES['banner']){
					$pre= time(); 
					$image=$_FILES['banner']['name'];
					$target_path = "assets/banner/";
					$file= $_FILES['banner']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["banner"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
				}		
		$columnArr["banner"] = $pre.$file;
		unset($columnArr['banner1']);
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_banner', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">The news added  Successfully</div>');
				$this->session->set_userdata($msg);

			}elseif($id && $_POST){
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
				  
				unset($columnArr['submit']);
				unset($columnArr['banner1']);
		
				$row = $this->Adminmodel->updateDb('mfg_banner', $columnArr,array('id'=> $id));
				
				$msg=array("MSG"=>'<div class="isa_success">Record updated successfully</div>');
				$this->session->set_userdata($msg);
		}

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_banner','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}

		$data['mfg_banner']= $this->Common->selectData('mfg_banner');
		$data['_view'] = 'superAdmin/banner';	
		$this->load->view('layouts/superadmin',$data);	


    }
	

/*	public function editBanner(){
		$this->validateSuperAdmin();
		$data['_view'] = 'superAdmin/edit-banner';	
		$this->load->view('layouts/superadmin',$data);	
    }*/
	
	
	
	
	// Blog
	public function blogs(){
		$this->validateSuperAdmin();
		$data['mfg_blog']= $this->Common->selectData('mfg_blog');
		$data['_view'] = 'superAdmin/blogs';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Notification
	public function notification(){
		$this->validateSuperAdmin();
		$data['mfg_notification']= $this->Common->selectData('mfg_notification');
		$data['_view'] = 'superAdmin/notification';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Send Notification
	public function sendNotification(){
		$this->validateSuperAdmin();	
		$data['_view'] = 'superAdmin/send-notification';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// View Notification
	public function viewNotification(){
	$this->validateSuperAdmin();
		$data['mfg_notification']= $this->Common->selectData('mfg_notification');
		$data['_view'] = 'superAdmin/view-notification';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// certifications
	public function certifications($id = NULL){
		$this->validateSuperAdmin();

		if($_POST  && $id==''){
			$columnArr = $this->input->post();
                    if($_FILES['banner']){
					$pre= time(); 
					$image=$_FILES['banner']['name'];
					$target_path = "assets/banner/";
					$file= $_FILES['banner']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["banner"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
				}		
		$columnArr["banner"] = $pre.$file;
		unset($columnArr['banner1']);
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_certifications', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">New Certification Added Successfully</div>');
				$this->session->set_userdata($msg);

			}elseif($id && $_POST){
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
				  
				unset($columnArr['submit']);
				unset($columnArr['banner1']);
		
				$row = $this->Adminmodel->updateDb('mfg_certifications', $columnArr,array('id'=> $id));
				
				$msg=array("MSG"=>'<div class="isa_success">Record updated successfully</div>');
				$this->session->set_userdata($msg);
		}

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_certifications','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}

	
		$this->validateSuperAdmin();
		$data['mfg_certifications']= $this->Common->selectData('mfg_certifications');
		$data['_view'] = 'superAdmin/certifications';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	
	
	
	// Edit Certifications
	public function editCertifications(){
		$this->validateSuperAdmin();
		$data['mfg_certifications']= $this->Common->selectData('mfg_certifications');
		$data['_view'] = 'superAdmin/edit-certifications';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Change Password
	public function changePassword(){
		$this->validateSuperAdmin();
		$data['_view'] = 'superAdmin/change-password';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	
	// Mode of Payment
	public function modeOfPayment($id = NULL){
		$this->validateSuperAdmin();

		if($_POST  && $id==''){
			$columnArr = $this->input->post();
                    if($_FILES['banner']){
					$pre= time(); 
					$image=$_FILES['banner']['name'];
					$target_path = "assets/banner/";
					$file= $_FILES['banner']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["banner"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
				}		
		$columnArr["banner"] = $pre.$file;
		unset($columnArr['banner1']);
		unset($columnArr['banner']);
		unset($columnArr['submit']);
		$row = $this->Adminmodel->insertDb('mfg_modepayment', $columnArr);
		$msg=array("MSG"=>'<div class="isa_success">New Mode Payment Added Successfully</div>');
				$this->session->set_userdata($msg);

			}elseif($id && $_POST){
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
				  
				unset($columnArr['submit']);
				unset($columnArr['banner1']);
		
				$row = $this->Adminmodel->updateDb('mfg_modepayment', $columnArr,array('id'=> $id));
				
				$msg=array("MSG"=>'<div class="isa_success">Record updated successfully</div>');
				$this->session->set_userdata($msg);
		}

		$data = array();
		if($id){
			$data['cmsdata'] = $this->Common->selectData('mfg_modepayment','*',array('id'=>$id));		
		}else{
			$data['cmsdata']=NULL; 
		}
		
		$this->validateSuperAdmin();
		$data['mfg_modepayment']= $this->Common->selectData('mfg_modepayment');
		$data['_view'] = 'superAdmin/mode-of-payment';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// Edit Mode Of Payment
	public function editModeOfPayment(){
		$this->validateSuperAdmin();
		$data['mfg_modepayment']= $this->Common->selectData('mfg_modepayment');
		$data['_view'] = 'superAdmin/edit-mode-of-payment';	
		$this->load->view('layouts/superadmin',$data);	
    }
	
	
	// My Profile
	public function myProfile(){
		$this->validateSuperAdmin();
		$data['mfg_my_profile']= $this->Common->selectData('mfg_superadmin_profile');
		$data['_view'] = 'superAdmin/my-profile';	
		$this->load->view('layouts/superadmin',$data);	
    }
	

			

}

//class/* End of file welcome.php *//* Location: ./application/controllers/welcome.php */