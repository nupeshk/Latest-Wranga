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

class Welcome extends Base_Controller {

    public function __construct() {
       parent::__construct();
       $this->load->model('Common_model');
       $this->load->model('Common');
       $this->perPage = 20;
       $data=array();
       
       $data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');

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
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'dashboard';
        $this->load->view('layout/layout_superadmin', $data);
    }
	
	
	public function adminList(){
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
		$data['title'] = 'Dashboard';
        $data['main_content'] = 'adminList';
        $this->load->view('layout/layout_superadmin', $data);
    
    }

    
    public function teamLeaderList(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
    	$data['title'] = 'Dashboard';
        $data['main_content'] = 'teamLeaderList';
        $this->load->view('layout/layout_superadmin', $data);
    }

    public function reviewerList(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
    	$data['title'] = 'Dashboard';
        $data['main_content'] = 'reviewerList';
        $this->load->view('layout/layout_superadmin', $data);
    }

    public function mobileusersList(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);

       $data['mobileCount'] = $this->Common->nrows('users');
    	$data['title'] = 'Dashboard';
        $data['mobileusersList'] = $this->Common->selectData('users','*',false,  $or_where = false, 'userId', 'DESC', $grpby = false, $whstr_in = false, $lmt1= false,$lmt2= false);
        $data['main_content'] = 'mobileusersList';
        $this->load->view('layout/layout_superadmin', $data);
    }


    
    public function uploadOtt(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');

                $postDataArr=$this->input->post();
                    if($postDataArr){                          
                            $kidsId = $this->Common_model->insert_single('content',$postDataArr);
                       }


    	$data['title'] = 'Dashboard';
        $data['main_content'] = 'upload-new-OTT';
        $this->load->view('layout/layout_superadmin', $data);
    }



    public function publishedOtt(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
    	$data['title'] = 'Dashboard';
        $data['main_content'] = 'published-OTTs';
        $this->load->view('layout/layout_superadmin', $data);
    }


    public function pendingOtt(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
    	$data['title'] = 'Dashboard';
        $data['main_content'] = 'pending-OTTs';
        $this->load->view('layout/layout_superadmin', $data);
    }


    public function section4List(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
    	$data['title'] = 'Dashboard';
        $data['main_content'] = 'section-4';
        $this->load->view('layout/layout_superadmin', $data);
    }


    public function gamePublished(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'gamePublished';
        $this->load->view('layout/layout_superadmin', $data);
    }

    public function gamePending(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'gamePending';
        $this->load->view('layout/layout_superadmin', $data);
    }
    public function appPublished(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'appPublished';
        $this->load->view('layout/layout_superadmin', $data);
    }
    public function appPending(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'appPending';
        $this->load->view('layout/layout_superadmin', $data);
    }
    public function bookPublished(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'bookPublished';
        $this->load->view('layout/layout_superadmin', $data);
    }
    public function bookPending(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'bookPending';
        $this->load->view('layout/layout_superadmin', $data);
    }
        public function dashboard(){
        $data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
	       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'dashboard';
        $this->load->view('layout/layout_superadmin', $data);
    }

    

    public function admin(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
       $data['title'] = 'Dashboard';
       


       $postDataArr = $this->input->post();
        if($postDataArr){

        $columnArr = $this->input->post();
        if($_FILES['photo']){
					$pre= time(); 
					$image=$_FILES['photo']['name'];
					$target_path = "assets/photo/";
					$file= $_FILES['photo']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["photo"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
				}		
		    $columnArr["photo"] = $pre.$file;
            $this->Common->insert('cms_admin',$postDataArr);

            $this->session->set_userdata('logged_in');
          $msg=array("MSG"=>'<div class="isa_success">Admin user register  successfully.</div>');
          $this->session->set_userdata($msg);

        }



        $data['admin'] = $this->Common->selectData('cms_admin','*',['user_type'=>2],  $or_where = false, 'id', 'DESC', $grpby = false, $whstr_in = false, $lmt1= false,$lmt2= false);
        
        $data['main_content'] = 'admin';
        $this->load->view('layout/layout_superadmin', $data);
    }


    public function teamLeader(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $postDataArr = $this->input->post();


        if($postDataArr){
          if($_FILES['photo']){
          $pre= time(); 
          $image=$_FILES['photo']['name'];
          $target_path = "assets/photo/";
          $file= $_FILES['photo']['name'];
          $target_path = $target_path.$pre.$file;
          $source=$_FILES["photo"]["tmp_name"]; 
          move_uploaded_file($source,$target_path); 
        }   
        $postDataArr["photo"] = $pre.$file;
            $this->Common->insert('cms_admin',$postDataArr);           
            $this->session->set_userdata('logged_in');
          $msg=array("MSG"=>'<div class="isa_success">Team Leader user register  successfully.</div>');
          $this->session->set_userdata($msg);

        }

        $data['teamLeader'] = $this->Common->selectData('cms_admin','*',['user_type'=>3],  $or_where = false, 'id', 'DESC', $grpby = false, $whstr_in = false, $lmt1= false,$lmt2= false);
        $data['main_content'] = 'team-leader';
        $this->load->view('layout/layout_superadmin', $data);
    }

    public function reviewer(){
    	$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
       $data['mobileCount'] = $this->Common->nrows('users');


       $data['teamLeaderData'] = $this->Common->selectData('cms_admin','*',['user_type'=>3]);

        $data['title'] = 'Dashboard';
        $postDataArr = $this->input->post();
        if($postDataArr){
              if($_FILES['photo']){
          $pre= time(); 
          $image=$_FILES['photo']['name'];
          $target_path = "assets/photo/";
          $file= $_FILES['photo']['name'];
          $target_path = $target_path.$pre.$file;
          $source=$_FILES["photo"]["tmp_name"]; 
          move_uploaded_file($source,$target_path); 
        }   
        $postDataArr["photo"] = $pre.$file;
        
              $this->Common->insert('cms_admin',$postDataArr);
              $this->session->set_userdata('logged_in');
              $msg=array("MSG"=>'<div class="isa_success">Reviewer user register  successfully.</div>');
              $this->session->set_userdata($msg);

        }

        $data['reviewer'] = $this->Common->selectData('cms_admin','*',['user_type'=>4],  $or_where = false, 'id', 'DESC', $grpby = false, $whstr_in = false, $lmt1= false,$lmt2= false);
        $data['main_content'] = 'reviewer';
        $this->load->view('layout/layout_superadmin', $data);
    }




       public function uploadOttgenralInfo(){
        $data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
         $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'uploadOttgenralInfo';
        $this->load->view('layout/layout_superadmin', $data);
    }

     public function uploadOttRating(){
        $data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
         $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'uploadOttRating';
        $this->load->view('layout/layout_superadmin', $data);
    }

     public function uploadOttReview(){
        $data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
       $data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
       $data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
         $data['mobileCount'] = $this->Common->nrows('users');
        $data['title'] = 'Dashboard';
        $data['main_content'] = 'uploadOttReview';
        $this->load->view('layout/layout_superadmin', $data);
    }



    public function delete(){
         $table=$this->uri->segment(4);
         $id=$this->uri->segment(5);
         $redirct=$this->uri->segment(6);

         $delete = $this->Common->deleteDb($table,['id'=>$id]);
         if($delete){
           header("Location: http://wranga.in/index.php/demo/".$redirct); 
         }
    }


    public function updateProfile(){
          
          print_r($_POST);
          $postDataArrr=$this->input->post();
          /*  $table
            $updates
            $conditions */
              unset($postDataArrr['url']);
            $update=$this->Common_model->update_single('cms_admin',$postDataArrr,['id'=> $postDataArrr['id']]);
            if($update){
              echo "TTT";
            }else{
              echo "KKK";
            }
    }

    

}
