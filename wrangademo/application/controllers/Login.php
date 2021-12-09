<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Login extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');
		$this->load->helper('security');
		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		//$this->load->library('session');

		// Load database
		$this->load->model('Common');
		$this->load->model('login_database');
		$this->load->model('user_database');
		//$this->load->model('excel_import_model');
		//$this->load->library('excel');
	}

	public function dashboard()
	{		

			

		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{			
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			//$this->load->view('template/header');
			$this->load->view('index', $data);
			//$this->load->view('template/footer');
		}
	}

	public function loginprocess()
	{
		//echo "he";die;
		$user = $this->input->post('user_name');
		$user=$this->security->xss_clean($user);
		$pass = $this->input->post('pass');
		$pass=$this->security->xss_clean($pass);
		$validateLoginProcess=$this->login_database->validateUsernamePassword($user,$pass);
		if($validateLoginProcess==false)
		{
			$data['error'] = 'Invalid username and password';
			//$this->load->view('template/header');
			$this->load->view('login', $data);
			//$this->load->view('template/footer');
		}else
		{
			$fetchLoginUserDetails=$this->login_database->fetchLoginUserBYId($validateLoginProcess);	
			if($fetchLoginUserDetails==FALSE)
			{
				$data['error'] = 'Your Account is Invalid';
				//$this->load->view('template/header');
				$this->load->view('login', $data);
				//$this->load->view('template/footer');	
			}else
			{			
				foreach($fetchLoginUserDetails as $userDetails)
				{
					$userType=$userDetails->user_type;
					$userId=$userDetails->id;
					$userName=$userDetails->name;
					$userPhoto=$userDetails->photo;
				}
					//session_start();
				$_SESSION['projectId']="";
				$_SESSION['userType']="";
				$_SESSION['userId']="";
				$_SESSION['userName']="";
				$_SESSION['userType']=$userType;
				$_SESSION['userId']=$userId;
				$_SESSION['userName']=$userName;
				$_SESSION['userPhoto']=$userPhoto;
				$_SESSION['destroyed']=time();
				echo '<script>window.location.href="'.base_url_index.'published-otts'.'"</script>';		

			}
		}
	}


	function logout()
	{
		$user_data = $this->session->all_userdata();
		if(isset($_SESSION['userType'])) {  unset($_SESSION['userType']); }
		if(isset($_SESSION['userId'])) {  unset($_SESSION['userId']); }
		if(isset($_SESSION['userName'])) {  unset($_SESSION['userName']); }
		if(isset($_SESSION['userPhoto'])) {  unset($_SESSION['userPhoto']); }
		if(isset($_SESSION['destroyed'])){ unset($_SESSION['destroyed']); }
		$this->session->sess_destroy();	
		echo '<script>window.location.href="'.base_url('').'";</script>';
	}

/////////// Admin Start ////////////////////

	public function adminprocess()
	{
		if(empty($_SESSION['userName'])) 
		{  
			//echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{			
			$members = $this->login_database->getlist('2');
			if($members==false || $members=="")
			{
				$data['getListData'] ="";
			}else
			{
				$data['getListData'] =$members; 
			} 
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			if(($this->session->userdata('userType')=='1'))
			{
				//$this->load->view('template/header');
				//$this->load->view('template/after-login-navigation');
				$this->load->view('inprocess-admin',$data);
				//$this->load->view('template/footer');
			} else {
				//echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function adminadd()
	{		
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			if(($this->session->userdata('userType')=='1'))
			{				
				//$this->load->view('template/header');
				//$this->load->view('template/after-login-navigation');
				$this->load->view('admin-add',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function adminaddInsert()
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			$result=$this->input->post();
			
			$upFIle="";
			$res1 = "";
			//______________________ User Image Upload Code_____________________
			if(isset($_FILES['photo']['name'])) 
			{
				$file=preg_replace('~[\(,\)]~', '_', $_FILES['photo']['name']);
				if($file!="")
				{
					$allowed_types = array ( 'image/png','image/PNG','image/jpg','image/JPG');
					$file_size = $_FILES['photo']['size'];
					$detected_type=$this->user_database->fileCHeckMimeType($_FILES['photo']['name']);
					if (!in_array($detected_type, $allowed_types) ) 
					{
						echo '<script>alert("Please try again");window.location.href="'.base_url_index.'adminadd'.'"</script>'; 
						$res1 = 0;
					}else if (($file_size > 2097152))
					{
						echo '<script>alert("Please try again");window.location.href="'.base_url_index."adminadd".'"</script>'; 
						$res1 = 0;
					}else {
						$temp_name=$_FILES['photo']['tmp_name'];
						$folder="userphoto/";
						$temp = explode(".", $_FILES["photo"]["name"]);
						$extension = end($temp);
						$fileName ="user_".date('Ymdhis')."_".rand(0, 3000).".png";
						$finalFIleNameFooter=$folder.$fileName;
						move_uploaded_file($temp_name,$finalFIleNameFooter);
						$upFIle=$folder.$fileName;
						$res1 = 1;
					}
				}
			}
			
			if(($this->session->userdata('userType')=='1'))
			{				
				//echo "hi3";die;
				$checkEmailValidity=$this->user_database->getEmailDetailsValidity($result['email']);
				if($checkEmailValidity==TRUE)
				{
					echo '<script>alert("Email is already exists, Please try another email id.");window.location.href="'.base_url_index."adminadd".'"</script>';
					//$data['error']="Email is already exists, Please try another email id.";
				}else
				{
					$inserdata = $this->login_database->save_activityaddAdmin($result,$upFIle);	
					if($inserdata>0)
					{
						echo '<script>alert("Administrator has been added successfully.");window.location.href="'.base_url_index."adminprocess".'"</script>';
					} else
					{
						echo '<script>alert("Please try again");
						window.location.href="'.base_url_index."adminadd".'"</script>'; 
					}
				}				
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function adminedit($id=0)
	{  
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users'); 
			
			$getValEditedStDetails= $this->login_database->updateAdmin($this->uri->segment(2));
			if(count($getValEditedStDetails)>0)
			{
				foreach($getValEditedStDetails as $getValD)
				{
					$data['name']= $getValD->name;
					$data['email']= $getValD->email;
					$data['phone']=$getValD->phone;
					$data['adhar']=$getValD->adhar;
					$data['pan']=$getValD->pan;
					$data['address']=$getValD->address;
					$data['password']=$getValD->password;
					$data['comment']=$getValD->comment;
					$data['photo']=$getValD->photo;
					$data['user_type']=$getValD->user_type;
				 }
			 }else
			 {
				$data['name']= "";
				$data['email']= "";
				$data['phone']="";
				$data['adhar']="";
				$data['pan']="";
				$data['address']="";
				$data['password']="";
				$data['comment']="";
				$data['photo']="";
				$data['user_type']="";
			 }
			 if(($this->session->userdata('userType')=='1'))
			 {
				//$this->load->view('template/header');
				$this->load->view('admin-edit',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	} 
	
	public function deleteadmin($id=0)
	{
		$id = $this->uri->segment(2);
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else
		{ 
			if(($this->session->userdata('userType')=='1'))
			{
				$result1 = $this->login_database->admindelete($id);
				echo '<script>window.location.href="'.base_url_index.'adminprocess'.'"</script>';
				//$this->load->view('template/header' );
				//$this->load->view('adminprocess');
				//$this->load->view('template/footer'); 
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			} 
		}
	}	

	public function update_admin($id=0)
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{
			$id=$this->uri->segment(2);
			$result=$this->input->post();
			$upFIle="";
			$res1 = "";
			//______________________ User Image Upload Code_____________________
			if(isset($_FILES['photo']['name'])) 
			{
				$file=preg_replace('~[\(,\)]~', '_', $_FILES['photo']['name']);
				if($file=="")
				{
					$upFIle=$this->input->post('oldfile');
					$res1 = 1;
				} else 
				{
					$allowed_types = array ( 'image/png','image/PNG','image/jpg','image/JPG');
					$file_size = $_FILES['photo']['size'];
					$detected_type=$this->user_database->fileCHeckMimeType($_FILES['photo']['name']);
					if (!in_array($detected_type, $allowed_types) ) 
					{
						echo '<script>alert("Only Png, Jpg image allowed.");window.location.href="'.base_url_index."adminedit/".$id.'"</script>'; 
						$res1 = 0;
					}else if (($file_size > 2097152))
					{
						echo '<script>alert("Image size maximum 2mb.");window.location.href="'.base_url_index."adminedit/".$id.'"</script>'; 
						$res1 = 0;
					}else {
						$temp_name=$_FILES['photo']['tmp_name'];
						$folder="userphoto/";
						$temp = explode(".", $_FILES["photo"]["name"]);
						$extension = end($temp);
						$fileName ="user_".date('Ymdhis')."_".rand(0, 3000).".png";
						$finalFIleNameFooter=$folder.$fileName;
						move_uploaded_file($temp_name,$finalFIleNameFooter);
						$upFIle=$folder.$fileName;
						$res1 = 1;
					}
				}
			}
			if(($this->session->userdata('userType')=='1'))
			{
				$inserdata = $this->login_database->updatesadmin($result,$upFIle);	
				if($inserdata=='1')
				{
					echo '<script>alert("Administrator has been updated successfully.");window.location.href="'.base_url_index."adminprocess".'"</script>';
				} else {
					echo '<script>window.location.href="'.base_url_index."adminedit/".$id.'"</script>';
				}
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			} 
		}
	}
	
/////////// Admin End ////////////////////

/////////// Teamleader Start ////////////////////

	public function deleteteamleader($id=0)
	{
		$id = $this->uri->segment(2);
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else
		{ 
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2'))
			{ 
				$result1 = $this->login_database->admindelete($id);
				echo '<script>window.location.href="'.base_url_index.'teamleaderprocess'.'"</script>';
				//$this->load->view('template/header' );
				//$this->load->view('teamleaderprocess');
				//$this->load->view('template/footer');  
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			} 
		}
	}	

	public function update_teamleader($id=0)
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{
			$id=$this->uri->segment(2);
			$result=$this->input->post();
			$upFIle="";
			$res1 = "";
			//______________________ User Image Upload Code_____________________
			if(isset($_FILES['photo']['name'])) 
			{
				$file=preg_replace('~[\(,\)]~', '_', $_FILES['photo']['name']);
				if($file=="")
				{
					$upFIle=$this->input->post('oldfile');
					$res1 = 1;
				} else 
				{
					$allowed_types = array ( 'image/png','image/PNG','image/jpg','image/JPG');
					$file_size = $_FILES['photo']['size'];
					$detected_type=$this->user_database->fileCHeckMimeType($_FILES['photo']['name']);
					if (!in_array($detected_type, $allowed_types) ) 
					{
						echo '<script>alert("Only Png, Jpg image allowed.");window.location.href="'.base_url_index."revieweredit/".$id.'"</script>'; 
						$res1 = 0;
					}else if (($file_size > 2097152))
					{
						echo '<script>alert("Image size maximum 2mb.");window.location.href="'.base_url_index."revieweredit/".$id.'"</script>'; 
						$res1 = 0;
					}else {
						$temp_name=$_FILES['photo']['tmp_name'];
						$folder="userphoto/";
						$temp = explode(".", $_FILES["photo"]["name"]);
						$extension = end($temp);
						$fileName ="user_".date('Ymdhis')."_".rand(0, 3000).".png";
						$finalFIleNameFooter=$folder.$fileName;
						move_uploaded_file($temp_name,$finalFIleNameFooter);
						$upFIle=$folder.$fileName;
						$res1 = 1;
					}
				}
			}
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2'))
			{ 
				$result=$this->input->post();
				$inserdata = $this->login_database->updatesadmin($result,$upFIle);	
				if($inserdata=='1')
				{
					echo '<script>alert("Team leader has been updated successfully.");window.location.href="'.base_url_index."teamleaderprocess".'"</script>';
				} else {
					echo '<script>window.location.href="'.base_url_index."teamleaderedit/".$id.'"</script>';
				}
			} else {
				echo '<script>window.location.href="'.base_url().'"</script>';
			}
		}
	}

	public function teamleaderedit($id=0)
	{  
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users'); 
			
			$getValEditedStDetails= $this->login_database->updateAdmin($this->uri->segment(2));
			if(count($getValEditedStDetails)>0)
			{
				foreach($getValEditedStDetails as $getValD)
				{
					$data['name']= $getValD->name;
					$data['email']= $getValD->email;
					$data['phone']=$getValD->phone;
					$data['adhar']=$getValD->adhar;
					$data['pan']=$getValD->pan;
					$data['address']=$getValD->address;
					$data['password']=$getValD->password;
					$data['comment']=$getValD->comment;
					$data['photo']=$getValD->photo;
					$data['user_type']=$getValD->user_type;
					$data['parent_type']=$getValD->parent_type;
				 }
			 }else
			 {
				$data['name']= "";
				$data['email']= "";
				$data['phone']="";
				$data['adhar']="";
				$data['pan']="";
				$data['address']="";
				$data['password']="";
				$data['comment']="";
				$data['photo']="";
				$data['user_type']="";
				$data['parent_type']="";
			 }
			 if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2'))
			 { 
				//$this->load->view('template/header');
				$this->load->view('teamleader-edit',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	} 
	
	public function teamleaderprocess()
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{			
			$members = $this->login_database->getlist('3');
			if($members==false || $members=="")
			{
				$data['getListData'] ="";
			}else
			{
				$data['getListData'] =$members; 
			} 
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2')){ 
				//$this->load->view('template/header');
				//$this->load->view('template/after-login-navigation');
				$this->load->view('inprocess-teamleader',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function teamleaderadd()
	{		
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2')){ 
				//$this->load->view('template/header');
				//$this->load->view('template/after-login-navigation');
				$this->load->view('teamleader-add',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function teamleaderaddInsert()
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			
			$upFIle="";
			$res1 = "";
			//______________________ User Image Upload Code_____________________
			if(isset($_FILES['photo']['name'])) 
			{
				$file=preg_replace('~[\(,\)]~', '_', $_FILES['photo']['name']);
				if($file!="")
				{
					$allowed_types = array ( 'image/png','image/PNG','image/jpg','image/JPG');
					$file_size = $_FILES['photo']['size'];
					$detected_type=$this->user_database->fileCHeckMimeType($_FILES['photo']['name']);
					if (!in_array($detected_type, $allowed_types) ) 
					{
						echo '<script>alert("Please try again");window.location.href="'.base_url_index."teamleaderadd".'"</script>'; 
						$res1 = 0;
					}else if (($file_size > 2097152))
					{
						echo '<script>alert("Please try again");window.location.href="'.base_url_index."teamleaderadd".'"</script>'; 
						$res1 = 0;
					}else {
						$temp_name=$_FILES['photo']['tmp_name'];
						$folder="userphoto/";
						$temp = explode(".", $_FILES["photo"]["name"]);
						$extension = end($temp);
						$fileName ="user_".date('Ymdhis')."_".rand(0, 3000).".png";
						$finalFIleNameFooter=$folder.$fileName;
						move_uploaded_file($temp_name,$finalFIleNameFooter);
						$upFIle=$folder.$fileName;
						$res1 = 1;
					}
				}
			}
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2')){ 
				$result=$this->input->post();
				$checkEmailValidity=$this->user_database->getEmailDetailsValidity($result['email']);
				if($checkEmailValidity==TRUE)
				{
					echo '<script>alert("Email is already exists, Please try another email id.");window.location.href="'.base_url_index."teamleaderadd".'"</script>';
					//$data['error']="Email is already exists, Please try another email id.";
				}else
				{
					$inserdata = $this->login_database->save_activityaddTeamleader($result,$upFIle);	
					if($inserdata>0)
					{
						echo '<script>alert("Team leader has been added successfully.");window.location.href="'.base_url_index."teamleaderprocess".'"</script>';
					}else
					{
						echo '<script>alert("Please try again");
						window.location.href="'.base_url_index."teamleaderadd".'"</script>'; 
					}
				}
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}
	
/////////// Teamleader End ////////////////////

/////////// Reviewer Start ////////////////////
	
	public function reviewerprocess()
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{			
			$members = $this->login_database->getlist('4');
			if($members==false || $members=="")
			{
				$data['getListData'] ="";
			}else
			{
				$data['getListData'] =$members; 
			} 
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3'))
			{
				//$this->load->view('template/header');
				//$this->load->view('template/after-login-navigation');
				$this->load->view('inprocess-reviewer',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function revieweradd()
	{		
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3'))
			{
				//$this->load->view('template/header');
				//$this->load->view('template/after-login-navigation');
				$this->load->view('reviewer-add',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function revieweraddInsert()
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users');
			
			$upFIle="";
			$res1 = "";
			//______________________ User Image Upload Code_____________________
			if(isset($_FILES['photo']['name'])) 
			{
				$file=preg_replace('~[\(,\)]~', '_', $_FILES['photo']['name']);
				if($file!="")
				{
					$allowed_types = array ( 'image/png','image/PNG','image/jpg','image/JPG');
					$file_size = $_FILES['photo']['size'];
					$detected_type=$this->user_database->fileCHeckMimeType($_FILES['photo']['name']);
					if (!in_array($detected_type, $allowed_types) ) 
					{
						echo '<script>alert("Please try again");window.location.href="'.base_url_index."revieweradd".'"</script>'; 
						$res1 = 0;
					}else if (($file_size > 2097152))
					{
						echo '<script>alert("Please try again");window.location.href="'.base_url_index."revieweradd".'"</script>'; 
						$res1 = 0;
					}else {
						$temp_name=$_FILES['photo']['tmp_name'];
						$folder="userphoto/";
						$temp = explode(".", $_FILES["photo"]["name"]);
						$extension = end($temp);
						$fileName ="user_".date('Ymdhis')."_".rand(0, 3000).".png";
						$finalFIleNameFooter=$folder.$fileName;
						move_uploaded_file($temp_name,$finalFIleNameFooter);
						$upFIle=$folder.$fileName;
						$res1 = 1;
					}
				}
			}
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3'))
			{
				$result=$this->input->post();
				$checkEmailValidity=$this->user_database->getEmailDetailsValidity($result['email']);
				if($checkEmailValidity==TRUE)
				{
					echo '<script>alert("Email is already exists, Please try another email id.");window.location.href="'.base_url_index."revieweradd".'"</script>';
					//$data['error']="Email is already exists, Please try another email id.";
				}else
				{
					$inserdata = $this->login_database->save_activityaddReviewer($result,$upFIle);	
					if($inserdata>0)
					{
						echo '<script>alert("Reviewer has been added successfully.");window.location.href="'.base_url_index."reviewerprocess".'"</script>';
					}else
					{
						echo '<script>alert("Please try again");
						window.location.href="'.base_url_index."revieweradd".'"</script>'; 
					}
				}
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function update_reviewer($id=0)
	{
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{
			$id=$this->uri->segment(2);
			$result=$this->input->post();
			$upFIle="";
			$res1 = "";
			//______________________ User Image Upload Code_____________________
			if(isset($_FILES['photo']['name'])) 
			{
				$file=preg_replace('~[\(,\)]~', '_', $_FILES['photo']['name']);
				if($file=="")
				{
					$upFIle=$this->input->post('oldfile');
					$res1 = 1;
				} else 
				{
					$allowed_types = array ( 'image/png','image/PNG','image/jpg','image/JPG');
					$file_size = $_FILES['photo']['size'];
					$detected_type=$this->user_database->fileCHeckMimeType($_FILES['photo']['name']);
					if (!in_array($detected_type, $allowed_types) ) 
					{
						echo '<script>alert("Only Png, Jpg image allowed.");window.location.href="'.base_url_index."revieweredit/".$id.'"</script>'; 
						$res1 = 0;
					}else if (($file_size > 2097152))
					{
						echo '<script>alert("Image size maximum 2mb.");window.location.href="'.base_url_index."revieweredit/".$id.'"</script>'; 
						$res1 = 0;
					}else {
						$temp_name=$_FILES['photo']['tmp_name'];
						$folder="userphoto/";
						$temp = explode(".", $_FILES["photo"]["name"]);
						$extension = end($temp);
						$fileName ="user_".date('Ymdhis')."_".rand(0, 3000).".png";
						$finalFIleNameFooter=$folder.$fileName;
						move_uploaded_file($temp_name,$finalFIleNameFooter);
						$upFIle=$folder.$fileName;
						$res1 = 1;
					}
				}
			}
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3'))
			{
				$result=$this->input->post();
				$id=$this->uri->segment(2); 
				$inserdata = $this->login_database->updatesadmin($result,$upFIle);	
				if($inserdata=='1')
				{
					echo '<script>alert("Reviewer has been updated successfully.");window.location.href="'.base_url_index."reviewerprocess".'"</script>';
				} else {
					echo '<script>window.location.href="'.base_url_index."revieweredit/".$id.'"</script>';
				}
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}

	public function revieweredit($id=0)
	{  
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else 
		{	
			$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
			$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
			$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
			$data['mobileCount'] = $this->Common->nrows('users'); 
			
			$getValEditedStDetails= $this->login_database->updateAdmin($this->uri->segment(2));
			if(count($getValEditedStDetails)>0)
			{
				foreach($getValEditedStDetails as $getValD)
				{
					$data['name']= $getValD->name;
					$data['email']= $getValD->email;
					$data['phone']=$getValD->phone;
					$data['adhar']=$getValD->adhar;
					$data['pan']=$getValD->pan;
					$data['address']=$getValD->address;
					$data['password']=$getValD->password;
					$data['comment']=$getValD->comment;
					$data['photo']=$getValD->photo;
					$data['user_type']=$getValD->user_type;
					$data['parent_type']=$getValD->parent_type;
				 }
			 }else
			 {
				$data['name']= "";
				$data['email']= "";
				$data['phone']="";
				$data['adhar']="";
				$data['pan']="";
				$data['address']="";
				$data['password']="";
				$data['comment']="";
				$data['photo']="";
				$data['user_type']="";
				$data['parent_type']="";
			 }
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3'))
			{
				//$this->load->view('template/header');
				$this->load->view('reviewer-edit',$data);
				//$this->load->view('template/footer');
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	} 
	
	public function deletereviewer($id=0)
	{
		$id = $this->uri->segment(2);
		if(empty($_SESSION['userName'])) 
		{  
			echo '<script>window.location.href="'.base_url('').'"</script>';
		} else
		{ 
			if(($this->session->userdata('userType')=='1') || ($this->session->userdata('userType')=='2') || ($this->session->userdata('userType')=='3'))
			{
				$result1 = $this->login_database->admindelete($id);
				echo '<script>window.location.href="'.base_url_index.'reviewerprocess'.'"</script>';
				//$this->load->view('template/header' );
				//$this->load->view('reviewerprocess');
				//$this->load->view('template/footer'); 
			} else {
				echo '<script>window.location.href="'.base_url('').'"</script>';
			}
		}
	}	

/////////// Reviewer End ////////////////////	
	
	public function forgetPassword($id=0)
	{
		$this->load->view('template/header');
		$this->load->view('forgetpassword');
		$this->load->view('template/footer');
	}

	public function sendPassword($id=0)
	{
		$projectId=$this->uri->segment(2);
		$post=$this->input->post();
		$post=$this->security->xss_clean($post);
		//echo $post['email'];
		if(empty($post['email']))
		{
			$data['errorMsg']="Please enter email.";
		}else
		{
			$userDetails=$this->login_database->fetchUserDetailViaEmail($projectId,$post);
			if($userDetails==FALSE)
			{
				$data['errorMsg']="This email is not found, Please enter right email id.";
			}else
			{
				$data['errorMsg']="";
				foreach($userDetails as $user)
				{
					$username=$user->user_name;
					$password=$user->user_pass;
					$uid=$user->id;
				}
				$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
				$pass = array(); //remember to declare $pass as an array
				$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
				for ($i = 0; $i < 8; $i++) 
				{
					$n = rand(0, $alphaLength);
					$pass[] = $alphabet[$n];
				}
				$post1=array();
				$post1['password']=implode($pass);
				$post1['eid']=$uid;
				$updatePass=$this->user_database->updatePassword12($post1);
				$datP='forgetPassword';
				$mailTemplate=$this->user_database->getTemplateDetailByMailType($datP);
				foreach($mailTemplate as $valMail)
				{
					$mailContent=$valMail->mailTemplate;
					$mailSubject=$valMail->subject;
				}
				$mailContent=str_replace("[username]",$username,$mailContent);
				$mailContent=str_replace("[password]",$post1['password'],$mailContent);
				$mailContent=str_replace("[url]","https://wranga.net.in",$mailContent);
				$to=trim($post['email']);
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: Paperless<noreply@.net.in>' . "\r\n";
				$headers .= 'Bcc: info@wranga.net.in' . "\r\n";
				if(!empty($to))
				{
					//mail($to,$mailSubject,$mailContent,$headers);
				}
				// END Mail COde ____________________________________________________________
				$data['message']='Success_'.$this->uri->segment(2);
				$this->load->view('hfcl/forgetPasswordAlert', $data);
			}
		}
		$projectId=$this->uri->segment(2);
		$projectDetails=$this->login_database->fetchProjectDetails($projectId);
		foreach($projectDetails as $valDet)
		{
			$data['projectLogo']=$valDet->logo;
			if($data['projectLogo']=="")
			{
				$data['projectLogo']='img/logonotfound.jpg';
			}
			$this->load->view('template/header');
			$this->load->view('hfcl/forgetpassword', $data);
			$this->load->view('template/footer');
		}
	}

	public function error420()
	{
		$user_data = $this->session->all_userdata();
		$userPId=$this->session->userdata('projectId');
		foreach ($user_data as $key => $value) {
		if ($key != 'session_id') {
		$this->session->unset_userdata($key);
		}
		}
		$this->session->sess_destroy();
		$this->load->view('template/err404');
	}

	public function unauthorized()
	{
		if(isset($_SESSION))
		{
		$this->session->sess_destroy();
		}
		$this->load->view('template/err404');		
	}

	public function sessionLogin()
	{
		$this->load->view('template/header');
		$this->load->view('template/sessionLogin');
		$this->load->view('template/footer');
	}

}
?>