<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdvisoryContent extends CI_Controller {

    public function __construct() {
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
	
	public function index()
	{
		//echo "ho"; die;
		//$this->load->view('template/header');
		$this->load->view('login');
		//$this->load->view('template/footer');
		//$this->load->view('index');
	}


	public function dashboard()
	{
		$data=array();
		$this->load->view('dashboard',$data);
	}

	
	function deleteId($tbl,$id,$location){
		 	$tbl=$this->uri->segment(3);
		 		$id=$this->uri->segment(4);
	 			$location=$this->uri->segment(5);
			//$data['cmsdata'] = $this->Common->deleteDb($tbl,array('id'=>$id));
			$data['cmsdata'] = $this->Common->deleteDb('content',array('contentId'=>$id));
			
			if($data){
				header("location:". base_url_index.$location);
			}
	}


		function deletePymant($tbl,$id,$location){
		 		$id=$this->uri->segment(4);
	 			$location=$this->uri->segment(5);
			$data['cmsdata'] = $this->Common->deleteDb('wrng_paymentPlan',array('paymentPlanId'=>$id));
			
			if($data){
				header("location:". base_url_index.$location);
			}
	}



		function deleteIdALl($tbl,$id,$location){
		 	$tbl=$this->uri->segment(3);
		 		$id=$this->uri->segment(4);
	 			$location=$this->uri->segment(5);
			//$data['cmsdata'] = $this->Common->deleteDb($tbl,array('id'=>$id));
			$data['cmsdata'] = $this->Common->deleteDb($tbl,array('benifitsId'=>$id));
			
			if($data){
				header("location:". base_url_index.$location);
			}
	}


	function deleteThumbnailImage($id){
		$id=$this->uri->segment(3);
		$postDataArr['thumbnailImage']="";
		$data=$this->Common->update('content',$postDataArr,['contentId'=>$id]);

		if($data){
				header("location:".base_url_index.'upload-new-otts/'.$id);
			}

	}


   	function delete($tbl,$id,$location,$contentId){
		 		$tbl=$this->uri->segment(3);
		 		$id=$this->uri->segment(4);
	 			$location=$this->uri->segment(5);
	 			$contentId=$this->uri->segment(6);
			$data['cmsdata'] = $this->Common->deleteDb($tbl,array('id'=>$id));
			if($data){
				header("location:".base_url_index.$location.'/'.$contentId);
			}	
	}

	public function publishedOtts(){
		error_reporting(0);	
		$data=array();
		$postDataArr=$this->input->post();
			if(isset($postDataArr['Create'])){
			unset($postDataArr['genre']);
			unset($postDataArr['Submit']);
			unset($postDataArr['Create']);
			$postDataArr['reviewerId']=$_SESSION['userId'];
			$postDataArr['catgId']=1;
			$postDataArr['ottcontentTypeId']=1;
			$id=$this->Common->insert('content',$postDataArr);	
				if($id){
					header("Location:http://localhost/WrangaWeb/wrangademo/index.php/upload-new-otts/".$id);					
				}
			}		
			$userType=$_SESSION['userType'];
			$userId=$_SESSION['userId'];	

			if(isset($postDataArr['applyFilter']) && isset($postDataArr['apply'])){
				$filter=$postDataArr['apply'];
				$data['content'] = $this->Common->queryApply($filter,$userId,$userType);
			}else{
				$data['content'] = $this->Common->query($userId,$userType);
			}

			if(isset($postDataArr['searchButton']) && isset($postDataArr['search'])){
				$search=$postDataArr['search'];
				$data['content'] = $this->Common->queryApplySearch($search,$userId,$userType);
			}else{
				$data['content'] = $this->Common->query($userId,$userType);
			}

		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['contentStatus'] = $this->Common->selectData('contentStatus');
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');	
		$this->load->view('published-otts',$data);
	}


	public function uploadNewOtts($id=NULL){
		error_reporting(0);
		$id= $this->uri->segment(2);
		$postDataArr=$this->input->post();
		if($postDataArr){
			
		if(isset($_POST['submitGeneral'])){
			unset($postDataArr['Othes']);
			unset($postDataArr['submitGeneral']);
			//$postDataArr['reviewerId']=$_SESSION['userName'];

	foreach ($postDataArr['genre'] as $valueGenre) {
				$data = array('contentId' => $id,
                               'genreId' => $valueGenre);
				$this->Common->insert('wrng_contentGenre',$data);
			}
			unset($postDataArr['genre']);

					unset($postDataArr['genre']);
		$postDataArr['reviewerId']=$_SESSION['userName'];
		$postDataArr['updateat']=date("yy-m-dd- H:MI:SS");


		
		if($postDataArr['ottType_Id']!=3){
			$postDataArr['sesson']='';		
			$postDataArr['episode']='';			
		}		
	

		$this->Common->update('content',$postDataArr,['contentId'=>$id]);
		$this->updateContentPublishStatus($this->uri->segment(2));
		}	
	

		if(isset($_POST['submitThumbnail'])){   
	       	        if(!empty($_FILES['thumbnailImage']['name'])){
	       	  		 $pre= time(); 
					$image=$_FILES['thumbnailImage']['name'];
					$target_path = "assets/thumbnailImage/";
					$file= $_FILES['thumbnailImage']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["thumbnailImage"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["thumbnailImage"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->update('content', $columnArrr,['contentId'=>$id]);
	       	  	}
	       	  	$this->updateContentPublishStatus($this->uri->segment(2));
	       	}


		 if(isset($_POST['castSubmit'])){   
		 	$countfiles = count($_FILES['cast_image']['name']);
	       for($i=0;$i<1;$i++){
	       	        if(!empty($_FILES['cast_image']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['cast_image']['name'][$i];
					$target_path = "assets/castImage/";
					$file= $_FILES['cast_image']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["cast_image"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					
	       	  	}
	       	  }

	       	$columnArrr["cast_image"] = $pre.$file;	
			$columnArrr["contentId"] = $id;	
	       	$columnArrr["cast_name"] = $_POST['cast_name'];	
			$row = $this->Common->insert('wrng_cast', $columnArrr);


	       	$this->updateContentPublishStatus($this->uri->segment(2));  
	       	}

	    if(isset($_POST['submitBanner'])){   
	       $countfiles = count($_FILES['image_path']['name']);
	       for($i=0;$i<$countfiles;$i++){
	       	        if(!empty($_FILES['image_path']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['image_path']['name'][$i];
					$target_path = "assets/bannerImage/";
					$file= $_FILES['image_path']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["image_path"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["image_path"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->insert('content_image', $columnArrr);
	       	  	}
	       	  }
	       	  $this->updateContentPublishStatus($this->uri->segment(2));
	       	}  
		}

		if(isset($_POST['videoSubmit'])){
			$columnArrr=$this->input->post();
		       	        
		       	        if(!empty($_FILES['video_image']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_image']['name'];
							$target_path = "assets/videoImage/";
							$file= $_FILES['video_image']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_image"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	
							$columnArrr["video_image"] = $pre.$file;
						}


						if(!empty($_FILES['video_mp4']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_mp4']['name'];
							$target_path = "assets/videoMP4/";
							$file= $_FILES['video_mp4']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_mp4"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	

							if(move_uploaded_file($source,$target_path)){
							    $display_message = "file moved successfully";
							    }
							    else{
							        $display_message = " STILL DID NOT MOVE";
							            }


            
							$columnArrr["video_mp4"] = $pre.$file;
						}


					$columnArrr["contentId"] =$this->uri->segment(2);	
					unset($columnArrr['videoSubmit']);

						

					 $wrng_content_video_url = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$this->uri->segment(2)]);
					 $videoDuration['videoDuration']=$columnArrr['duration'];	
					 $videoDuration['platformId']=$columnArrr['videoPlatform'];	

					if(empty($wrng_content_video_url)){

						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->insert('wrng_content_video_url', $columnArrr);
					}else{
						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->update_single('wrng_content_video_url', $columnArrr,['contentId'=>$this->uri->segment(2)]);

					}
			$this->updateContentPublishStatus($this->uri->segment(2));		
		}

		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');

		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',false, $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = 3);


		$data['platform'] = $this->Common->selectData('platform');
		$data['ottType'] = $this->Common->selectData('ottType');
		$data['wrng_contentType'] = $this->Common->selectData('wrng_contentType');
		$data['wrng_genre'] = $this->Common->selectData('wrng_genre', $fld = '*', $conditions = false, $or_where = false, $ord = 'name', $ordtype = 'ASC', $grpby = false, $whstr_in = false, $lmt = false,false);

		$data['wrng_ottPlatformType'] = $this->Common->selectData('wrng_ottPlatformType');
		
		$wrng_contentGenre = $this->Common->selectData('wrng_contentGenre','*',['contentId'=>$id]);
		
		foreach ($wrng_contentGenre as $key => $wrng_contentGenre) {
			$array[]=$wrng_contentGenre->genreId;
		}
		$data['wrng_contentGenreAll']=implode(',',$array);
		
		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['content_image'] = $this->Common->selectData('content_image','*',['contentId'=>$id]);
		$data['wrng_cast'] = $this->Common->selectData('wrng_cast','*',['contentId'=>$id]);

		$data['wrng_content_video_url'] = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$id]);
		if(empty($data['wrng_content_video_url'])){
			$data['wrng_content_video_url']=NULL;
		}	

		$data['id']=$this->uri->segment(2);
		$id= $this->uri->segment(2);
		$data['content'] = $this->Common->selectData('content','*',['contentId'=>$this->uri->segment(2)]);
		$this->load->view('upload-new-otts',$data);
	}	



	public function uploadNewGames($id=NULL){
		error_reporting(0);
		$id= $this->uri->segment(2);
		$postDataArr=$this->input->post();
		if($postDataArr){
			
		if(isset($_POST['submitGeneral'])){
			unset($postDataArr['Othes']);
			unset($postDataArr['submitGeneral']);
			//$postDataArr['reviewerId']=$_SESSION['userName'];

	foreach ($postDataArr['genre'] as $valueGenre) {
				$data = array('contentId' => $id,
                               'genreId' => $valueGenre);
				$this->Common->insert('wrng_contentGenre',$data);
			}
			unset($postDataArr['genre']);

					unset($postDataArr['genre']);
		$postDataArr['reviewerId']=$_SESSION['userName'];
		$postDataArr['updateat']=date("yy-m-dd- H:MI:SS");


		
		if($postDataArr['ottType_Id']!=3){
			$postDataArr['sesson']='';		
			$postDataArr['episode']='';			
		}		
	

		$this->Common->update('content',$postDataArr,['contentId'=>$id]);
		$this->updateContentPublishStatus($this->uri->segment(2));
		}	
	

		if(isset($_POST['submitThumbnail'])){   
	       	        if(!empty($_FILES['thumbnailImage']['name'])){
	       	  		 $pre= time(); 
					$image=$_FILES['thumbnailImage']['name'];
					$target_path = "assets/thumbnailImage/";
					$file= $_FILES['thumbnailImage']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["thumbnailImage"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["thumbnailImage"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->update('content', $columnArrr,['contentId'=>$id]);
	       	  	}
	       	  	$this->updateContentPublishStatus($this->uri->segment(2));
	       	}


		 if(isset($_POST['castSubmit'])){   
		 	$countfiles = count($_FILES['cast_image']['name']);
	       for($i=0;$i<1;$i++){
	       	        if(!empty($_FILES['cast_image']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['cast_image']['name'][$i];
					$target_path = "assets/castImage/";
					$file= $_FILES['cast_image']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["cast_image"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					
	       	  	}
	       	  }

	       	$columnArrr["cast_image"] = $pre.$file;	
			$columnArrr["contentId"] = $id;	
	       	$columnArrr["cast_name"] = $_POST['cast_name'];	
			$row = $this->Common->insert('wrng_cast', $columnArrr);


	       	$this->updateContentPublishStatus($this->uri->segment(2));  
	       	}

	    if(isset($_POST['submitBanner'])){   
	       $countfiles = count($_FILES['image_path']['name']);
	       for($i=0;$i<$countfiles;$i++){
	       	        if(!empty($_FILES['image_path']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['image_path']['name'][$i];
					$target_path = "assets/bannerImage/";
					$file= $_FILES['image_path']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["image_path"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["image_path"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->insert('content_image', $columnArrr);
	       	  	}
	       	  }
	       	  $this->updateContentPublishStatus($this->uri->segment(2));
	       	}  
		}

		if(isset($_POST['videoSubmit'])){
			$columnArrr=$this->input->post();
		       	        
		       	        if(!empty($_FILES['video_image']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_image']['name'];
							$target_path = "assets/videoImage/";
							$file= $_FILES['video_image']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_image"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	
							$columnArrr["video_image"] = $pre.$file;
						}


						if(!empty($_FILES['video_mp4']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_mp4']['name'];
							$target_path = "assets/videoMP4/";
							$file= $_FILES['video_mp4']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_mp4"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	

							if(move_uploaded_file($source,$target_path)){
							    $display_message = "file moved successfully";
							    }
							    else{
							        $display_message = " STILL DID NOT MOVE";
							            }


            
							$columnArrr["video_mp4"] = $pre.$file;
						}


					$columnArrr["contentId"] =$this->uri->segment(2);	
					unset($columnArrr['videoSubmit']);

						

					 $wrng_content_video_url = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$this->uri->segment(2)]);
					 $videoDuration['videoDuration']=$columnArrr['duration'];	
					 $videoDuration['platformId']=$columnArrr['videoPlatform'];	

					if(empty($wrng_content_video_url)){

						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->insert('wrng_content_video_url', $columnArrr);
					}else{
						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->update_single('wrng_content_video_url', $columnArrr,['contentId'=>$this->uri->segment(2)]);

					}
			$this->updateContentPublishStatus($this->uri->segment(2));		
		}

		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');

		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',['catgId'=>2], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt =false);


		$data['platform'] = $this->Common->selectData('platform');
		$data['ottType'] = $this->Common->selectData('ottType');
		$data['wrng_contentType'] = $this->Common->selectData('wrng_contentType');
		$data['wrng_genre'] = $this->Common->selectData('wrng_genre', $fld = '*', $conditions = false, $or_where = false, $ord = 'name', $ordtype = 'ASC', $grpby = false, $whstr_in = false, $lmt = false,false);

		$data['wrng_ottPlatformType'] = $this->Common->selectData('wrng_ottPlatformType');
		
		$wrng_contentGenre = $this->Common->selectData('wrng_contentGenre','*',['contentId'=>$id]);
		
		foreach ($wrng_contentGenre as $key => $wrng_contentGenre) {
			$array[]=$wrng_contentGenre->genreId;
		}
		$data['wrng_contentGenreAll']=implode(',',$array);
		
		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['content_image'] = $this->Common->selectData('content_image','*',['contentId'=>$id]);
		$data['wrng_cast'] = $this->Common->selectData('wrng_cast','*',['contentId'=>$id]);

		$data['wrng_content_video_url'] = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$id]);
		if(empty($data['wrng_content_video_url'])){
			$data['wrng_content_video_url']=NULL;
		}	

		$data['id']=$this->uri->segment(2);
		$id= $this->uri->segment(2);
		$data['content'] = $this->Common->selectData('content','*',['contentId'=>$this->uri->segment(2)]);
		$this->load->view('upload-new-games',$data);
	}
	
	
	public function uploadNewApp($id=NULL){
		error_reporting(0);
		$id= $this->uri->segment(2);
		$postDataArr=$this->input->post();
		if($postDataArr){
			
		if(isset($_POST['submitGeneral'])){
			unset($postDataArr['Othes']);
			unset($postDataArr['submitGeneral']);
			//$postDataArr['reviewerId']=$_SESSION['userName'];

	foreach ($postDataArr['genre'] as $valueGenre) {
				$data = array('contentId' => $id,
                               'genreId' => $valueGenre);
				$this->Common->insert('wrng_contentGenre',$data);
			}
			unset($postDataArr['genre']);

					unset($postDataArr['genre']);
		$postDataArr['reviewerId']=$_SESSION['userName'];
		$postDataArr['updateat']=date("yy-m-dd- H:MI:SS");


		
		if($postDataArr['ottType_Id']!=3){
			$postDataArr['sesson']='';		
			$postDataArr['episode']='';			
		}		
	

		$this->Common->update('content',$postDataArr,['contentId'=>$id]);
		$this->updateContentPublishStatus($this->uri->segment(2));
		}	
	

		if(isset($_POST['submitThumbnail'])){   
	       	        if(!empty($_FILES['thumbnailImage']['name'])){
	       	  		 $pre= time(); 
					$image=$_FILES['thumbnailImage']['name'];
					$target_path = "assets/thumbnailImage/";
					$file= $_FILES['thumbnailImage']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["thumbnailImage"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["thumbnailImage"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->update('content', $columnArrr,['contentId'=>$id]);
	       	  	}
	       	  	$this->updateContentPublishStatus($this->uri->segment(2));
	       	}


		 if(isset($_POST['castSubmit'])){   
		 	$countfiles = count($_FILES['cast_image']['name']);
	       for($i=0;$i<1;$i++){
	       	        if(!empty($_FILES['cast_image']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['cast_image']['name'][$i];
					$target_path = "assets/castImage/";
					$file= $_FILES['cast_image']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["cast_image"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					
	       	  	}
	       	  }

	       	$columnArrr["cast_image"] = $pre.$file;	
			$columnArrr["contentId"] = $id;	
	       	$columnArrr["cast_name"] = $_POST['cast_name'];	
			$row = $this->Common->insert('wrng_cast', $columnArrr);


	       	$this->updateContentPublishStatus($this->uri->segment(2));  
	       	}

	    if(isset($_POST['submitBanner'])){   
	       $countfiles = count($_FILES['image_path']['name']);
	       for($i=0;$i<$countfiles;$i++){
	       	        if(!empty($_FILES['image_path']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['image_path']['name'][$i];
					$target_path = "assets/bannerImage/";
					$file= $_FILES['image_path']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["image_path"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["image_path"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->insert('content_image', $columnArrr);
	       	  	}
	       	  }
	       	  $this->updateContentPublishStatus($this->uri->segment(2));
	       	}  
		}

		if(isset($_POST['videoSubmit'])){
			$columnArrr=$this->input->post();
		       	        
		       	        if(!empty($_FILES['video_image']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_image']['name'];
							$target_path = "assets/videoImage/";
							$file= $_FILES['video_image']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_image"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	
							$columnArrr["video_image"] = $pre.$file;
						}


						if(!empty($_FILES['video_mp4']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_mp4']['name'];
							$target_path = "assets/videoMP4/";
							$file= $_FILES['video_mp4']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_mp4"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	

							if(move_uploaded_file($source,$target_path)){
							    $display_message = "file moved successfully";
							    }
							    else{
							        $display_message = " STILL DID NOT MOVE";
							            }


            
							$columnArrr["video_mp4"] = $pre.$file;
						}


					$columnArrr["contentId"] =$this->uri->segment(2);	
					unset($columnArrr['videoSubmit']);

						

					 $wrng_content_video_url = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$this->uri->segment(2)]);
					 $videoDuration['videoDuration']=$columnArrr['duration'];	
					 $videoDuration['platformId']=$columnArrr['videoPlatform'];	

					if(empty($wrng_content_video_url)){

						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->insert('wrng_content_video_url', $columnArrr);
					}else{
						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->update_single('wrng_content_video_url', $columnArrr,['contentId'=>$this->uri->segment(2)]);

					}
			$this->updateContentPublishStatus($this->uri->segment(2));		
		}

		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');

		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',['catgId'=>3], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);


		$data['platform'] = $this->Common->selectData('platform');
		$data['ottType'] = $this->Common->selectData('ottType');
		$data['wrng_contentType'] = $this->Common->selectData('wrng_contentType');
		$data['wrng_genre'] = $this->Common->selectData('wrng_genre', $fld = '*', $conditions = false, $or_where = false, $ord = 'name', $ordtype = 'ASC', $grpby = false, $whstr_in = false, $lmt = false,false);

		$data['wrng_ottPlatformType'] = $this->Common->selectData('wrng_ottPlatformType');
		
		$wrng_contentGenre = $this->Common->selectData('wrng_contentGenre','*',['contentId'=>$id]);
		
		foreach ($wrng_contentGenre as $key => $wrng_contentGenre) {
			$array[]=$wrng_contentGenre->genreId;
		}
		$data['wrng_contentGenreAll']=implode(',',$array);
		
		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['content_image'] = $this->Common->selectData('content_image','*',['contentId'=>$id]);
		$data['wrng_cast'] = $this->Common->selectData('wrng_cast','*',['contentId'=>$id]);

		$data['wrng_content_video_url'] = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$id]);
		if(empty($data['wrng_content_video_url'])){
			$data['wrng_content_video_url']=NULL;
		}	

		$data['id']=$this->uri->segment(2);
		$id= $this->uri->segment(2);
		$data['content'] = $this->Common->selectData('content','*',['contentId'=>$this->uri->segment(2)]);
		$this->load->view('upload-new-app',$data);
	}
	
	
	public function uploadNewBook($id=NULL){
		error_reporting(0);
		$id= $this->uri->segment(2);
		$postDataArr=$this->input->post();
		if($postDataArr){
			
		if(isset($_POST['submitGeneral'])){
			unset($postDataArr['Othes']);
			unset($postDataArr['submitGeneral']);
			//$postDataArr['reviewerId']=$_SESSION['userName'];

	foreach ($postDataArr['genre'] as $valueGenre) {
				$data = array('contentId' => $id,
                               'genreId' => $valueGenre);
				$this->Common->insert('wrng_contentGenre',$data);
			}
			unset($postDataArr['genre']);

					unset($postDataArr['genre']);
		$postDataArr['reviewerId']=$_SESSION['userName'];
		$postDataArr['updateat']=date("yy-m-dd- H:MI:SS");


		
		if($postDataArr['ottType_Id']!=3){
			$postDataArr['sesson']='';		
			$postDataArr['episode']='';			
		}		
	

		$this->Common->update('content',$postDataArr,['contentId'=>$id]);
		$this->updateContentPublishStatus($this->uri->segment(2));
		}	
	

		if(isset($_POST['submitThumbnail'])){   
	       	        if(!empty($_FILES['thumbnailImage']['name'])){
	       	  		 $pre= time(); 
					$image=$_FILES['thumbnailImage']['name'];
					$target_path = "assets/thumbnailImage/";
					$file= $_FILES['thumbnailImage']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["thumbnailImage"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["thumbnailImage"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->update('content', $columnArrr,['contentId'=>$id]);
	       	  	}
	       	  	$this->updateContentPublishStatus($this->uri->segment(2));
	       	}


		 if(isset($_POST['castSubmit'])){   
		 	$countfiles = count($_FILES['cast_image']['name']);
	       for($i=0;$i<1;$i++){
	       	        if(!empty($_FILES['cast_image']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['cast_image']['name'][$i];
					$target_path = "assets/castImage/";
					$file= $_FILES['cast_image']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["cast_image"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					
	       	  	}
	       	  }

	       	$columnArrr["cast_image"] = $pre.$file;	
			$columnArrr["contentId"] = $id;	
	       	$columnArrr["cast_name"] = $_POST['cast_name'];	
			$row = $this->Common->insert('wrng_cast', $columnArrr);


	       	$this->updateContentPublishStatus($this->uri->segment(2));  
	       	}

	    if(isset($_POST['submitBanner'])){   
	       $countfiles = count($_FILES['image_path']['name']);
	       for($i=0;$i<$countfiles;$i++){
	       	        if(!empty($_FILES['image_path']['name'][$i])){
	       	  		 $pre= time(); 
					$image=$_FILES['image_path']['name'][$i];
					$target_path = "assets/bannerImage/";
					$file= $_FILES['image_path']['name'][$i];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["image_path"]["tmp_name"][$i];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["image_path"] = $pre.$file;	
					$columnArrr["contentId"] = $id;	
					$row = $this->Common->insert('content_image', $columnArrr);
	       	  	}
	       	  }
	       	  $this->updateContentPublishStatus($this->uri->segment(2));
	       	}  
		}

		if(isset($_POST['videoSubmit'])){
			$columnArrr=$this->input->post();
		       	        
		       	        if(!empty($_FILES['video_image']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_image']['name'];
							$target_path = "assets/videoImage/";
							$file= $_FILES['video_image']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_image"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	
							$columnArrr["video_image"] = $pre.$file;
						}


						if(!empty($_FILES['video_mp4']['name'])){
			       	  		 $pre= time(); 
							$image=$_FILES['video_mp4']['name'];
							$target_path = "assets/videoMP4/";
							$file= $_FILES['video_mp4']['name'];
							$target_path = $target_path.$pre.$file;
							$source=$_FILES["video_mp4"]["tmp_name"];	
							move_uploaded_file($source,$target_path);	

							if(move_uploaded_file($source,$target_path)){
							    $display_message = "file moved successfully";
							    }
							    else{
							        $display_message = " STILL DID NOT MOVE";
							            }


            
							$columnArrr["video_mp4"] = $pre.$file;
						}


					$columnArrr["contentId"] =$this->uri->segment(2);	
					unset($columnArrr['videoSubmit']);

						

					 $wrng_content_video_url = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$this->uri->segment(2)]);
					 $videoDuration['videoDuration']=$columnArrr['duration'];	
					 $videoDuration['platformId']=$columnArrr['videoPlatform'];	

					if(empty($wrng_content_video_url)){

						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->insert('wrng_content_video_url', $columnArrr);
					}else{
						$row = $this->Common->update_single('content', $videoDuration,['contentId'=>$this->uri->segment(2)]);
						$row = $this->Common->update_single('wrng_content_video_url', $columnArrr,['contentId'=>$this->uri->segment(2)]);

					}
			$this->updateContentPublishStatus($this->uri->segment(2));		
		}

		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');

		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',['catgId'=>4], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);


		$data['platform'] = $this->Common->selectData('platform');
		$data['ottType'] = $this->Common->selectData('ottType');
		$data['wrng_contentType'] = $this->Common->selectData('wrng_contentType');
		$data['wrng_genre'] = $this->Common->selectData('wrng_genre', $fld = '*', $conditions = false, $or_where = false, $ord = 'name', $ordtype = 'ASC', $grpby = false, $whstr_in = false, $lmt = false,false);

		$data['wrng_ottPlatformType'] = $this->Common->selectData('wrng_ottPlatformType');
		
		$wrng_contentGenre = $this->Common->selectData('wrng_contentGenre','*',['contentId'=>$id]);
		
		foreach ($wrng_contentGenre as $key => $wrng_contentGenre) {
			$array[]=$wrng_contentGenre->genreId;
		}
		$data['wrng_contentGenreAll']=implode(',',$array);
		
		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['content_image'] = $this->Common->selectData('content_image','*',['contentId'=>$id]);
		$data['wrng_cast'] = $this->Common->selectData('wrng_cast','*',['contentId'=>$id]);

		$data['wrng_content_video_url'] = $this->Common->selectData('wrng_content_video_url','*',['contentId'=>$id]);
		if(empty($data['wrng_content_video_url'])){
			$data['wrng_content_video_url']=NULL;
		}	

		$data['id']=$this->uri->segment(2);
		$id= $this->uri->segment(2);
		$data['content'] = $this->Common->selectData('content','*',['contentId'=>$this->uri->segment(2)]);
		$this->load->view('upload-new-book',$data);
	}
	
	
	public function uploadPaymentPlan($id=NULL){
		error_reporting(0);
		$id= $this->uri->segment(2);
		$postDataArr=$this->input->post();
		$id=$this->input->post('paymentPlanId');
		if($postDataArr){
				if(isset($_POST['submitGeneral'])){
				unset($postDataArr['submitGeneral']);
				unset($postDataArr['paymentPlanId']);
				unset($postDataArr['planImage1']);
				$postDataArr['updateat']=date("yy-m-dd- H:MI:SS");

					if(!empty($_FILES['planImage']['name'])){
					       	  		 $pre= time(); 
									$image=$_FILES['planImage']['name'];
									$target_path = "assets/paymentPlanImage/";
									$file= $_FILES['planImage']['name'];
									$target_path = $target_path.$pre.$file;
									$source=$_FILES["planImage"]["tmp_name"];	
									move_uploaded_file($source,$target_path);	
									$postDataArr["planImage"] = 'http://localhost/WrangaWeb/wrangademo/assets/paymentPlanImage/'.$pre.$file;	
				}

				$this->Common->update('wrng_paymentPlan',$postDataArr,['paymentPlanId'=>$id]);
				redirect('index.php/paymentPlan');
				}	
		}
	}	


	public function updateBenifits($id=NULL){
		error_reporting(0);
		$id= $this->uri->segment(2);
		$postDataArr=$this->input->post();
		if($postDataArr){
			if(isset($_POST['submitBenifits'])){
				unset($postDataArr['submitBenifits']);
				$benifitsId=$this->input->post('benifitsId');
				$postDataArr['updateat']=date("yy-m-dd- H:MI:SS");
				$this->Common->update('wrng_planBenifits',$postDataArr,['benifitsId'=>$benifitsId]);
				redirect('index.php/planBenifits');
			}	
		}

	}





	public function updateContentPublishStatus($contentId){

		 $conutTotalValue=$this->Common->conutTotalValue($contentId);
		 $wrng_shortreview = $this->Common->nrows('wrng_shortreview','*',['contentId'=>$contentId]);
		 $wrng_tipsList = $this->Common->nrows('wrng_tipsList','*',['contentId'=>$contentId]);
		 $genralInfoValidation=$this->Common->genralInfoValidation($contentId);

		if($conutTotalValue && $wrng_shortreview && $wrng_tipsList){
			echo $updateDataArr['status']=2;
			//return $data['publish']=1;
		}else{
			echo $updateDataArr['status']=3;
			//return $data['publish']=0;
		}
			$this->Common->update_single('content',$updateDataArr,['contentId'=>$contentId]);
	}



		public function pendingOtts(){
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('pending-otts',$data);
	}

	public function gamesPublished()
	{
		error_reporting(0);	
		$data=array();
		$postDataArr=$this->input->post();
			if(isset($postDataArr['Create'])){
			unset($postDataArr['genre']);
			unset($postDataArr['Submit']);
			unset($postDataArr['Create']);
			$postDataArr['reviewerId']=$_SESSION['userId'];
			$postDataArr['catgId']=2;
			$postDataArr['ottcontentTypeId']=1;
			$id=$this->Common->insert('content',$postDataArr);	
				if($id){
					header("Location:http://localhost/WrangaWeb/wrangademo/index.php/upload-new-games/".$id);					
				}
			}		
			$userType=$_SESSION['userType'];
			$userId=$_SESSION['userId'];	
		
			
			if(isset($postDataArr['applyFilter']) && isset($postDataArr['apply'])){
				$filter=$postDataArr['apply'];
				$data['content'] = $this->Common->queryApply($filter,$userId,$userType);
			}else{
				$data['content'] = $this->Common->queryGames($userId,$userType);
			}



			if(isset($postDataArr['searchButton']) && isset($postDataArr['search'])){
				$search=$postDataArr['search'];
				$data['content'] = $this->Common->queryApplySearch($search,$userId,$userType);
			}else{
				$data['content'] = $this->Common->queryGames($userId,$userType);
			}
		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['contentStatus'] = $this->Common->selectData('contentStatus');
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('games-published',$data);
	}

	public function gamesPending()
	{
		error_reporting(0);	
		$data=array();
		$postDataArr=$this->input->post();
			if(isset($postDataArr['Create'])){
			unset($postDataArr['genre']);
			unset($postDataArr['Submit']);
			unset($postDataArr['Create']);
			$postDataArr['reviewerId']=$_SESSION['userId'];
			$postDataArr['catgId']=1;
			$postDataArr['ottcontentTypeId']=1;
			$id=$this->Common->insert('content',$postDataArr);	
				if($id){
					header("Location:http://localhost/WrangaWeb/wrangademo/index.php/upload-new-otts/".$id);					
				}
			}		
			$userType=$_SESSION['userType'];
			$userId=$_SESSION['userId'];	
		
			
			if(isset($postDataArr['applyFilter']) && isset($postDataArr['apply'])){
				$filter=$postDataArr['apply'];
				$data['content'] = $this->Common->queryApply($filter,$userId,$userType);
			}else{
				$data['content'] = $this->Common->query($userId,$userType);
			}



			if(isset($postDataArr['searchButton']) && isset($postDataArr['search'])){
				$search=$postDataArr['search'];
				$data['content'] = $this->Common->queryApplySearch($search,$userId,$userType);
			}else{
				$data['content'] = $this->Common->query($userId,$userType);
			}


			

		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['contentStatus'] = $this->Common->selectData('contentStatus');
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('games-pending',$data);
	}


	public function appPublished()
	{
		error_reporting(0);	
		$data=array();
		$postDataArr=$this->input->post();
			if(isset($postDataArr['Create'])){
			unset($postDataArr['genre']);
			unset($postDataArr['Submit']);
			unset($postDataArr['Create']);
			$postDataArr['reviewerId']=$_SESSION['userId'];
			$postDataArr['catgId']=3;
			$postDataArr['ottcontentTypeId']=1;
			$id=$this->Common->insert('content',$postDataArr);	
				if($id){
					header("Location:http://localhost/WrangaWeb/wrangademo/index.php/upload-new-app/".$id);					
				}
			}		
			$userType=$_SESSION['userType'];
			$userId=$_SESSION['userId'];	
		
			
			if(isset($postDataArr['applyFilter']) && isset($postDataArr['apply'])){
				$filter=$postDataArr['apply'];
				$data['content'] = $this->Common->queryApply($filter,$userId,$userType);
			}else{
				$data['content'] = $this->Common->queryApp($userId,$userType);
			}



			if(isset($postDataArr['searchButton']) && isset($postDataArr['search'])){
				$search=$postDataArr['search'];
				$data['content'] = $this->Common->queryApplySearch($search,$userId,$userType);
			}else{
				$data['content'] = $this->Common->queryApp($userId,$userType);
			}


			

		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['contentStatus'] = $this->Common->selectData('contentStatus');
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('app-published',$data);
	}
	
	public function appPending()
	{
				$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('app-pending',$data);
	}

	public function bookPublished()
	{
		error_reporting(0);	
		$data=array();
		$postDataArr=$this->input->post();
			if(isset($postDataArr['Create'])){
			unset($postDataArr['genre']);
			unset($postDataArr['Submit']);
			unset($postDataArr['Create']);
			$postDataArr['reviewerId']=$_SESSION['userId'];
			$postDataArr['catgId']=4;
			$postDataArr['ottcontentTypeId']=1;
			$id=$this->Common->insert('content',$postDataArr);	
				if($id){
					header("Location:http://localhost/WrangaWeb/wrangademo/index.php/upload-new-book/".$id);					
				}
			}		
			$userType=$_SESSION['userType'];
			$userId=$_SESSION['userId'];	
		
			
			if(isset($postDataArr['applyFilter']) && isset($postDataArr['apply'])){
				$filter=$postDataArr['apply'];
				$data['content'] = $this->Common->queryApply($filter,$userId,$userType);
			}else{
				$data['content'] = $this->Common->queryBook($userId,$userType);
			}



			if(isset($postDataArr['searchButton']) && isset($postDataArr['search'])){
				$search=$postDataArr['search'];
				$data['content'] = $this->Common->queryApplySearch($search,$userId,$userType);
			}else{
				$data['content'] = $this->Common->queryBook($userId,$userType);
			}


			

		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$data['contentStatus'] = $this->Common->selectData('contentStatus');
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('book-published',$data);
	}


	
	public function bookPending()
	{
				$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('book-pending',$data);
	}

	public function admin()
	{
				$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('admin',$data);
	}

	public function teamLeaders()
	{
				$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('team-leaders',$data);
	}
	
	public function reviewers()
	{
				$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('reviewers',$data);
	}

	public function mobileUsers()
	{
				$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['users'] = $this->Common->selectData('users', $fld = '*', $conditions = false);
		$this->load->view('mobile-users',$data);
	}
	
	public function categories(){	
		if(isset($_POST['submitCategories'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategories']);	
					$row = $this->Common->insert('subCatagories', $columnArrr);
	      }

	     if(isset($_POST['submitCategoriesEdit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategoriesEdit']);
					//unset($postDataArr['subId']);
					$update=$this->Common->update('subCatagories',$columnArrr,['subId'=>$columnArrr['subId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/categories");
					}

	      } 
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',['catgId'=>1], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false,4);
		$this->load->view('categories',$data);
	}



	public function gamesCategories()
	{	if(isset($_POST['submitCategories'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategories']);	
					$row = $this->Common->insert('subCatagories', $columnArrr);
	      }

	     if(isset($_POST['submitCategoriesEdit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategoriesEdit']);
					//unset($postDataArr['subId']);
					$update=$this->Common->update('subCatagories',$columnArrr,['subId'=>$columnArrr['subId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/games-categories");
					}

	      } 
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',['catgId'=>2], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false,4);
		$this->load->view('games-categories',$data);
	}

	public function gamesLanguage()
	{
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('games-language',$data);
	}

	public function appCategories()
	{	if(isset($_POST['submitCategories'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategories']);	
					$row = $this->Common->insert('subCatagories', $columnArrr);
	      }

	     if(isset($_POST['submitCategoriesEdit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategoriesEdit']);
					//unset($postDataArr['subId']);
					$update=$this->Common->update('subCatagories',$columnArrr,['subId'=>$columnArrr['subId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/app-categories");
					}

	      } 
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',['catgId'=>3], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false,4);
		$this->load->view('app-categories',$data);
	}

	public function appLanguage()
	{
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('app-language',$data);
	}

	public function bookCategories()
	{	if(isset($_POST['submitCategories'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategories']);	
					$row = $this->Common->insert('subCatagories', $columnArrr);
	      }

	     if(isset($_POST['submitCategoriesEdit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitCategoriesEdit']);
					//unset($postDataArr['subId']);
					$update=$this->Common->update('subCatagories',$columnArrr,['subId'=>$columnArrr['subId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/book-categories");
					}

	      } 

		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['subCatagories'] = $this->Common->selectData('subCatagories', $fld = '*',['catgId'=>4], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false,4);
		$this->load->view('book-categories',$data);
	}

	public function bookLanguage()
	{
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('book-language',$data);
	}

	public function pushNotification()
	{	error_reporting(0);
		$data=array();
		$postDataArr=$this->input->post();
			
			if($postDataArr){
                    $title=$postDataArr['title'];
                    $body=$postDataArr['body'];
                    $columnArrr['title']=$title;
                    $columnArrr['massage']=$body;
                    $columnArrr['userId']=getUserId($postDataArr['userId']);
                   
                   if(!empty($_FILES['image']['name'])){
	       	  		 $pre= time(); 
					$image=$_FILES['image']['name'];
					$target_path = "assets/notificationImage/";
					$file= $_FILES['image']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["image"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
	       	  	}
	       	  	$columnArrr["image"] = $pre.$file;	

                    $row = $this->Common->insert('wrng_notification', $columnArrr);
                    $curl = curl_init();
                    $authKey = authKey;
               if($postDataArr['userId']==0){     
              	$tokens = array(); 
      			$tokens = $this->Common->selectData('wrng_fcm'); 
	              foreach ($tokens as $key => $value) {
	                     $tokensDetail[] = $value->fcmToken;
	                }

                    $comma_separated = implode('","', $tokensDetail);
                    $registration_ids = '["'.$comma_separated.'"]';
               }else{
               		$registration_ids=$columnArrr['userId'];
               }     

                    $imageValue="http://localhost/WrangaWeb/wrangademo/assets/notificationImage/".$_FILES['image']['name'];

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => '{
                    "registration_ids": ' . $registration_ids . ',
                    "notification": {
                    "title": "'. $title . '",
                    "body": "' . $body .'",
                    "icon": "https://api.androidhive.info/images/minion.jpg"
                    },
                    "data": {
       						"image": "https://api.androidhive.info/images/minion.jpg"  
   						}
                    }',
                    CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $authKey,
                    "Content-Type: application/json",
                    "cache-control: no-cache"
                    ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                    echo "cURL Error #:" . $err;
                    } else {
                    
                     $response;
                    } 
			}

		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['user'] =$this->Common->selectData('users');
		$this->load->view('push-notification',$data);
	}

	public function settingAboutUs()
	{	error_reporting(0);
		$data=array();
		$postDataArr=$this->input->post();
		if($postDataArr){
			unset($postDataArr['submit']);
			$update=$this->Common->update('wrng_splash',$postDataArr,['id'=>1]);	
			if($update){
				header("Location: http://localhost/WrangaWeb/wrangademo/index.php/setting-about-us");
			}
		}
		$data['setting'] =$this->Common->selectData('wrng_splash', $fld = '*',['id'=>'1']);
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$this->load->view('setting-about-us',$data);
	}



	public function platform(){
		$data=array();
		if(isset($_POST['submit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submit']);	
					$row = $this->Common->insert('platform', $columnArrr);
	      }
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		 $data['platform'] = $this->Common->selectData('platform');
		$this->load->view('platform',$data);
	}
	
	public function language()
	{
				$data=array();
				if(isset($_POST['submit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submit']);	
					$row = $this->Common->insert('wrng_language', $columnArrr);
	      }

	      if(isset($_POST['submitUpdate'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitUpdate']);
					$update=$this->Common->update('wrng_language',$columnArrr,['lId'=>$columnArrr['lId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/language");
					}
	      } 
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['wrng_language'] = $this->Common->selectData('wrng_language');
		$this->load->view('language',$data);
	}

	public function ottContentType(){
				$data=array();
				if(isset($_POST['submit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submit']);	
					$row = $this->Common->insert('ottType', $columnArrr);
	      }
	      if(isset($_POST['submitUpdate'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitUpdate']);
					$update=$this->Common->update('ottType',$columnArrr,['ottTypeId'=>$columnArrr['ottTypeId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/ott-content-type");
					}
	      } 

		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['ottType'] = $this->Common->selectData('ottType');
		$this->load->view('ott-content-type',$data);
	}


	public function ottPlatformType(){
		$data=array();
		if(isset($_POST['submit'])){   
					$columnArrr=$this->input->post();
					$pre= time(); 
					$image=$_FILES['image']['name'];
					$target_path = "assets/ooTType/";
					$file= $_FILES['image']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["image"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$columnArrr["image"] = $pre.$file;	
					unset($columnArrr['submit']);	
					$row = $this->Common->insert('wrng_ottPlatformType', $columnArrr);
	      }

	      if(isset($_POST['submitUpdate'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitUpdate']);
					$update=$this->Common->update('wrng_ottPlatformType',$columnArrr,['ottPlatformTypeId'=>$columnArrr['ottPlatformTypeId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/ott-platform-type");
					}
	      } 

		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['wrng_ottPlatformType'] = $this->Common->selectData('wrng_ottPlatformType');
		$this->load->view('ott-platform-type',$data);
	}



	
	public function contentType()
	{
				$data=array();
		if(isset($_POST['submit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submit']);	
					$row = $this->Common->insert('wrng_contentType', $columnArrr);
	     }

	     if(isset($_POST['submitUpdate'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitUpdate']);
					$update=$this->Common->update('wrng_contentType',$columnArrr,['id'=>$columnArrr['id']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/content-type");
					}
	     }


		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['wrng_contentType'] = $this->Common->selectData('wrng_contentType');
		$this->load->view('content-type',$data);
	}

	public function genre(){
				$data=array();
		 if(isset($_POST['submit'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submit']);	
					$row = $this->Common->insert('wrng_genre', $columnArrr);
	      }

	      if(isset($_POST['submitUpdate'])){   
					$columnArrr=$this->input->post();
					unset($columnArrr['submitUpdate']);
					$update=$this->Common->update('wrng_genre',$columnArrr,['gId'=>$columnArrr['gId']]);	
					if($update){
						header("Location: http://localhost/WrangaWeb/wrangademo/index.php/genre");
					}

	      } 


		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		
		 $data['wrng_genre'] = $this->Common->selectData('wrng_genre', $fld = '*', $conditions = false, $or_where = false, $ord = 'name', $ordtype = 'ASC', $grpby = false, $whstr_in = false, $lmt = false,false);

		$this->load->view('genre',$data);
	}

	public function ratingCalculation($value){
			
			if($value<=0.5){
				return 0.5;
			}elseif($value<=1){
				return 1;
			}elseif($value<=1.5){
				return 1.5;
			}elseif($value<=2){
				return 2;
			}elseif($value<=2.5){
				return 2.5;
			}elseif($value<=3){
				return 3;
			}elseif($value<=3.5){
				return 3.5;
			}elseif($value<=4){
				return 4;
			}elseif($value<=4.5){
				return 4.5;
			}else{
				return 5;
			}
	}

	public function rating($id=NULL){
		$data=array();
		error_reporting(0);
	 	$id= $this->uri->segment(2);
	 	$videoDuration= round($this->Common->videoDurationValue($id));
		$postDataArr=$this->input->post();		
				
		if(isset($postDataArr['positiveMessages'])){
			unset($postDataArr['positiveMessages']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);
		$sno=1;
		$this->Common->deleteThemetic($id,1);
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=1;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;

			if ($sno==1) {
				$ranges=$postDataArr['nationBuilding'];
			}elseif($sno==2){
				$ranges=$postDataArr['socialHarmony'];
			}elseif($sno==3){
				$ranges=$postDataArr['familyValues'];
			}elseif($sno==4){
				$ranges=$postDataArr['motivation'];
			}
			$postDataArrMenu['ranges']=$ranges;
			$postDataArrMenu['present']=0;
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$postDataArrMenu['ratingScore']=$postDataArr[$key+1];
			$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			$rangeScore+=$ranges;
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=1;
			$postDataArrr['ratning']=$this->ratingCalculation($rangeScore);
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;			
			$this->Common->deletemoralBoard($id,1);			
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}	

		if(isset($postDataArr['educationalValues'])){
			unset($postDataArr['educationalValues']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'2'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);
			
		$sno=1;
		$this->Common->deleteThemetic($id,2);
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=2;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;

			if ($sno==1) {
				echo $ranges=$postDataArr['informative'];
			}elseif($sno==2){
				echo $ranges=$postDataArr['logicalThinking'];
			}elseif($sno==3){
				echo $ranges=$postDataArr['skills'];
			}elseif($sno==4){
				echo $ranges=$postDataArr['healthFitness'];
			}elseif($sno==5){
				echo $ranges=$postDataArr['genderSensitisation'];
			}elseif($sno==6){
				echo $ranges=$postDataArr['educational'];
			}

			$postDataArrMenu['ranges']=$ranges;
			$postDataArrMenu['present']=0;
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$postDataArrMenu['ratingScore']=$postDataArr[$key+1];

			$this->Common->deleteThemetic('wrng_contentthematicrating',38,1);
			$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			$rangeScore+=$ranges;
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=2;
			$postDataArrr['ratning']=$this->ratingCalculation($rangeScore);
			$postDataArrr['contentId']=$id;
			$postDataArrr['ratningScore']=$rangeScore;
			$this->Common->deletemoralBoard($id,2);		
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			$printCal=$this->calculationOfFinalAge($id);	
		}



		if(isset($postDataArr['consumerismValues'])){
			unset($postDataArr['consumerismValues']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);




			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'3'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);
			
		$sno=1;
		$this->Common->deleteThemetic($id,3);
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=3;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;
			if ($sno==1) {
				echo $ranges=$postDataArr['consumerismRange'];
			}

			$postDataArrMenu['ranges']=$ranges;
			$postDataArrMenu['present']=0;
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$postDataArrMenu['ratingScore']=$ranges;

			$this->Common->deleteThemetic('wrng_contentthematicrating',$id,3);
			$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			$rangeScore+=$ranges;
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=3;
			$postDataArrr['ratning']=$this->ratingCalculation($rangeScore);
			$postDataArrr['contentId']=$id;
						$this->Common->deletemoralBoard($id,3);		
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
				$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}


/**
*Violence   4
*submitViolence
*/

		if(isset($postDataArr['submitViolence'])){			
			unset($postDataArr['submitViolence']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);

			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'4'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteOccurrence($id,4);
		
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=4;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;
				
				if ($sno==1) {
					$mild=$postDataArr['mild1'];
					$mildTimeStamp=$postDataArr['mildTimeStamp1'];
					$extreme=$postDataArr['extreme1'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp1'];

				}elseif($sno==2){
					$mild=$postDataArr['mild2'];
					$mildTimeStamp=$postDataArr['mildTimeStamp2'];
					$extreme=$postDataArr['extreme2'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp2'];

				}elseif($sno==3){
					$mild=$postDataArr['mild3'];
					$mildTimeStamp=$postDataArr['mildTimeStamp3'];
					$extreme=$postDataArr['extreme3'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp3'];

				}elseif($sno==4){
					$mild=$postDataArr['mild4'];
					$mildTimeStamp=$postDataArr['mildTimeStamp4'];
					$extreme=$postDataArr['extreme4'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp4'];
				}elseif($sno==5){
					$mild=$postDataArr['mild5'];
					$mildTimeStamp=$postDataArr['mildTimeStamp5'];
					$extreme=$postDataArr['extreme5'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp5'];
				}elseif($sno==6){
					$mild=$postDataArr['mild6'];
					$mildTimeStamp=$postDataArr['mildTimeStamp6'];
					$extreme=$postDataArr['extreme6'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp6'];
				}


			$postDataArrMenu['mild']=$mild;
			$postDataArrMenu['mildTimeStamp']=$mildTimeStamp;
			$postDataArrMenu['extreme']=$extreme;
			$postDataArrMenu['extremeTimeStamp']=$extremeTimeStamp;
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$mild=$postDataArrMenu['mild'];
			$extreme=$postDataArrMenu['extreme'];
			$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));

			$this->Common->deleteThemetic($id,4);
			$this->Common->insert('wrng_contentoccurrencerating',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=4;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,4));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;

			$this->Common->deletemoralBoard($id,4);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}


/**
*Violence   5
*sexNudity
*/



		if(isset($postDataArr['sexNudity'])){
			unset($postDataArr['sexNudity']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'5'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteOccurrence($id,5);
		
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=5;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;
				
				if ($sno==1) {
					$mild=$postDataArr['mild1'];
					$mildTimeStamp=$postDataArr['mildTimeStamp1'];
					$extreme=$postDataArr['extreme1'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp1'];
				}elseif($sno==2){
					$mild=$postDataArr['mild2'];
					$mildTimeStamp=$postDataArr['mildTimeStamp2'];
					$extreme=$postDataArr['extreme2'];
					$extremeTimeStamp=$postDataArr['extremeTimeStamp2'];
				}

			$postDataArrMenu['mild']=$mild;
			$postDataArrMenu['mildTimeStamp']=$mildTimeStamp;
			$postDataArrMenu['extreme']=$extreme;
			$postDataArrMenu['extremeTimeStamp']=$extremeTimeStamp;
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$mild=$postDataArrMenu['mild'];
			$extreme=$postDataArrMenu['extreme'];
			$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));

			$this->Common->deleteThemetic($id,5);
			$this->Common->insert('wrng_contentoccurrencerating',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=5;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,5));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;
			$this->Common->deletemoralBoard($id,5);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}

/** abusiveLanguage
*6
*/

		if(isset($postDataArr['abusiveLanguage'])){
						unset($postDataArr['abusiveLanguage']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'6'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteOccurrence($id,6);
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=6;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;

			$postDataArrMenu['mild']=$postDataArr['mild'];
			$postDataArrMenu['mildTimeStamp']=$postDataArr['mildTimeStamp'];
			$postDataArrMenu['extreme']=$postDataArr['extreme'];
			$postDataArrMenu['extremeTimeStamp']=$postDataArr['extremeTimeStamp'];
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$mild=$postDataArrMenu['mild'];
			$extreme=$postDataArrMenu['extreme'];
			$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));
			$this->Common->deleteThemetic($id,6);
			$this->Common->insert('wrng_contentoccurrencerating',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=6;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,6));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;
			$this->Common->deletemoralBoard($id,6);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}




/***************************************************childAbuse		7 ******************************/

		if(isset($postDataArr['childAbuse'])){
			unset($postDataArr['childAbuse']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'7'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteThemetic($id,7);
		
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=7;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;
			
			$postDataArrMenu['mild']=$postDataArr['mild'];
			$postDataArrMenu['mildTimeStamp']=$postDataArr['mildTimeStamp'];
			$postDataArrMenu['extreme']=$postDataArr['extreme'];
			$postDataArrMenu['extremeTimeStamp']=$postDataArr['extremeTimeStamp'];

			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$mild=$postDataArrMenu['mild'];
			$extreme=$postDataArrMenu['extreme'];
			$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));

			$this->Common->deleteOccurrence($id,7);
			$this->Common->insert('wrng_contentoccurrencerating',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=7;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,7));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;

			$this->Common->deletemoralBoard($id,7);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}


/***************************************************submitDrinking		8 ******************************/
if(isset($postDataArr['submitDrinking'])){
			unset($postDataArr['submitDrinking']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'8'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteThemetic($id,8);
		
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=8;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;
			$postDataArrMenu['mild']=$postDataArr['mild'];
			$postDataArrMenu['mildTimeStamp']=$postDataArr['mildTimeStamp'];
			$postDataArrMenu['extreme']=$postDataArr['extreme'];
			$postDataArrMenu['extremeTimeStamp']=$postDataArr['extremeTimeStamp'];
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$mild=$postDataArrMenu['mild'];
			$extreme=$postDataArrMenu['extreme'];
			$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));

			$this->Common->deleteOccurrence($id,8);
			$this->Common->insert('wrng_contentoccurrencerating',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=8;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,8));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;

			$this->Common->deletemoralBoard($id,8);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}


/***************************************************submitStereotype	9 ******************************/
if(isset($postDataArr['submitStereotype'])){
			unset($postDataArr['submitStereotype']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'9'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteThemetic($id,9);
		
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=9;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;
			
			$postDataArrMenu['mild']=$postDataArr['mild'];
			$postDataArrMenu['mildTimeStamp']=$postDataArr['mildTimeStamp'];
			$postDataArrMenu['extreme']=$postDataArr['extreme'];
			$postDataArrMenu['extremeTimeStamp']=$postDataArr['extremeTimeStamp'];

			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$mild=$postDataArrMenu['mild'];
			$extreme=$postDataArrMenu['extreme'];
			$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));

			$this->Common->deleteOccurrence($id,9);

			//unset($postDataArrMenu['mildTimeStamp']);
			//unset($postDataArrMenu['extremeTimeStamp']);
			

			$this->Common->insert('wrng_contentoccurrencerating',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=9;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,9));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;
			$this->Common->deletemoralBoard($id,9);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}

/***************************************************submitSexism		10 ******************************/
if(isset($postDataArr['submitSexism'])){
			unset($postDataArr['submitSexism']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'10'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteThemetic($id,10);
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=10;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;
			$postDataArrMenu['mild']=$postDataArr['mild'];
			$postDataArrMenu['mildTimeStamp']=$postDataArr['mildTimeStamp'];
			$postDataArrMenu['extreme']=$postDataArr['extreme'];
			$postDataArrMenu['extremeTimeStamp']=$postDataArr['extremeTimeStamp'];
			$postDataArrMenu['ottDurationMinutes']="";
			$postDataArrMenu['ottDurationHours']="";
			$mild=$postDataArrMenu['mild'];
			$extreme=$postDataArrMenu['extreme'];
			$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));
			
			$this->Common->deleteOccurrence($id,10);
			$this->Common->insert('wrng_contentoccurrencerating',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=10;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,10));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;
			$this->Common->deletemoralBoard($id,10);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}


		/**
		**prohobitive
		***11
		*/

		if(isset($postDataArr['submitProhibitive'])){		


			unset($postDataArr['submitProhibitive']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['prohibitive']);

			$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'11'], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);			
		$sno=1;
		$this->Common->deleteProhobitive($id,11);
		
		foreach($wrng_reatingcalsubcategory as  $key=>$wrng_reatingcalsubcategory){	
			$postDataArrMenu['contentId']=$id;
			$postDataArrMenu['ratingCalCategoryId']=11;
			$postDataArrMenu['ratingCalSubCategoryId']=$wrng_reatingcalsubcategory->id;

				if ($sno==1) {
					$ratingScore=$postDataArr['suicide'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp1'];
				}elseif($sno==2){
					$ratingScore=$postDataArr['hardcoreSex'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp2'];
				}elseif($sno==3){
					$ratingScore=$postDataArr['paedophilia'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp3'];
				}elseif($sno==4){
					$ratingScore=$postDataArr['excessiveDrinking'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp4'];
				}elseif($sno==5){
					$ratingScore=$postDataArr['rape'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp5'];
				}elseif($sno==6){
					$ratingScore=$postDataArr['promotes'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp6'];
				}elseif($sno==7){
					$ratingScore=$postDataArr['banned'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp7'];
				}elseif($sno==8){
					$ratingScore=$postDataArr['disrespect'];
					$postDataArrMenu['timeStamp']=$postDataArr['timeStamp8'];
				}

			$postDataArrMenu['ratingScore']=$ratingScore;

			//$postDataArrMenu['ratingScore']=$this->occuranceMultiplierCal($mild,$extreme,$videoDuration,$this->Common->mildMultiplierValue($wrng_reatingcalsubcategory->id),$this->Common->extremeMultiplierValue($wrng_reatingcalsubcategory->id));

			$this->Common->insert('wrng_prohobitiveCategory',$postDataArrMenu);	
			$rangeScore+=$postDataArrMenu['ratingScore'];
			$sno++;
		}	
			$postDataArrr['reatingCalCategoryId']=11;
			$postDataArrr['ratning']=$this->ratingCalculation($this->Common->totalRateing($id,11));
			$postDataArrr['ratningScore']=$rangeScore;
			$postDataArrr['contentId']=$id;

			$this->Common->deletemoralBoard($id,11);
			unset($postDataArrr['prohibitive']);
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);
			$printCal=$this->calculationOfFinalAge($id);	
				if($moralboardId){
					//echo "<script>alert('".$printCal."');</script>";					
				}
		}


/***************************************************************************************/

		
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');

$data['positiveRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>1]);
$data['educationRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>2]);
$data['consumerismRatingValue'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>3]);
$data['violenceRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>4]);	
$data['sexRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>5]);
$data['abusiveRatingValue'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>6]);
$data['childRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>7]);
$data['drinkingRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>8]);
$data['stereotypeRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>9]);
$data['sexismRating'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>10]);
		

		$id= $this->uri->segment(2);
		$data['id']=$id;
		$data['content'] =$this->Common->selectData('content', $fld = '*',['contentId'=>$id]);


		$this->load->view('advisory-rating',$data);



	}

	public function occuranceMultiplierCal($mildValue,$extremValue,$vidieodDuratio,$mildMultiplier,$extremeMultiplier){
		 	$score=number_format(($mildValue/round($vidieodDuratio/60))/$mildMultiplier,2)+number_format(($extremValue/round($vidieodDuratio/60))/$extremeMultiplier,2);
		 return $score;
	}


	public function calculationOfFinalAge($contentId){
			$score=array();
		 	$score18['postiveMessages']=$this->Common->moralBoardRating($contentId,1);
		 	$score18['educationValues']=$this->Common->moralBoardRating($contentId,2);
		 	$score18['violence']=$this->Common->moralBoardRating($contentId,3);
		 	$score18['abusiveLanguage']=$this->Common->moralBoardRating($contentId,4);
		 	$score18['childAbuse']=$this->Common->moralBoardRating($contentId,5);
		 	$score18['sexNudity']=$this->Common->moralBoardRating($contentId,6);
		 	$score18['consumerism']=$this->Common->moralBoardRating($contentId,7);
		 	$score18['drinkingDrugsSmoking']=$this->Common->moralBoardRating($contentId,8);
		 	$score18['stereotype']=$this->Common->moralBoardRating($contentId,9);
		 	$score18['sexism']=$this->Common->moralBoardRating($contentId,10);
		 	$score18['prohobitive']=$this->Common->moralBoardRating($contentId,11);
		 	
		 	///    Calculation and Rating For 14+
		 	$score14['postiveMessages']=$score18['postiveMessages'];
		 	$score14['educationValues']=$score18['educationValues'];
		 	$score14['violence']=$score18['violence']*1.2;
		 	$score14['abusiveLanguage']=$score18['abusiveLanguage']*1.2;
		 	$score14['childAbuse']=$score18['childAbuse']*1.2;
		 	$score14['sexNudity']=$score18['sexNudity']*1.2;
		 	$score14['consumerism']=$score18['consumerism'];
		 	$score14['drinkingDrugsSmoking']=$score18['drinkingDrugsSmoking']*1.2;
		 	$score14['stereotype']=$score18['stereotype']*1.2;
		 	$score14['sexism']=$score18['sexism']*1.2;
		 	$score14['prohobitive']=$score18['prohobitive'];
		 	

		 	$score10['postiveMessages']=$score14['postiveMessages'];
		 	$score10['educationValues']=$score14['educationValues'];
		 	$score10['violence']=$score14['violence']*1.2;
		 	$score10['abusiveLanguage']=$score14['abusiveLanguage']*1.2;
		 	$score10['childAbuse']=$score14['childAbuse']*1.2;
		 	$score10['sexNudity']=$score14['sexNudity']*1.2;
		 	$score10['consumerism']=$score14['consumerism'];
		 	$score10['drinkingDrugsSmoking']=$score14['drinkingDrugsSmoking']*1.2;
		 	$score10['stereotype']=$score14['stereotype']*1.2;
		 	$score10['sexism']=$score14['sexism']*1.2;
		 	$score10['prohobitive']=$score14['prohobitive'];

		 	$score7['postiveMessages']=$score10['postiveMessages'];
		 	$score7['educationValues']=$score10['educationValues'];
		 	$score7['violence']= $score10['violence']*1.2;
		 	$score7['abusiveLanguage']= $score10['abusiveLanguage']*1.2;
		 	$score7['childAbuse']=$score10['childAbuse']*1.2;
		 	$score7['sexNudity']=$score10['sexNudity']*1.2;
		 	$score7['consumerism']=$score10['consumerism'];
		 	$score7['drinkingDrugsSmoking']=$score10['drinkingDrugsSmoking']*1.2;
		 	$score7['stereotype']=$score10['stereotype']*1.2;
		 	$score7['sexism']=$score10['sexism']*1.2;
		 	$score7['prohobitive']=$score10['prohobitive'];

		 	$score4['postiveMessages']=$score7['postiveMessages'];
		 	$score4['educationValues']=$score7['educationValues'];
		 	$score4['violence']=$score7['violence']*1.2;
		 	$score4['abusiveLanguage']=$score7['abusiveLanguage']*1.2;
		 	$score4['childAbuse']=$score7['childAbuse']*1.2;
		 	$score4['sexNudity']=$score7['sexNudity']*1.2;
		 	$score4['consumerism']=$score7['consumerism'];
		 	$score4['drinkingDrugsSmoking']=$score7['drinkingDrugsSmoking']*1.2;
		 	$score4['stereotype']=$score7['stereotype']*1.2;
		 	$score4['sexism']=$score7['sexism']*1.2;
		 	$score4['prohobitive']=$score7['prohobitive'];

		 	
		 	$totalScore18= $this->calculationOfAgeScore($score18['postiveMessages'],$score18['educationValues'],$score18['violence'],$score18['abusiveLanguage'],$score18['childAbuse'],$score18['sexNudity'],$score18['consumerism'],$score18['drinkingDrugsSmoking'],$score18['stereotype'],$score18['sexism'],$score18['prohobitive']);

		 	$totalScore14= $this->calculationOfAgeScore($score14['postiveMessages'],$score14['educationValues'],$score14['violence'],$score14['abusiveLanguage'],$score14['childAbuse'],$score14['sexNudity'],$score14['consumerism'],$score14['drinkingDrugsSmoking'],$score14['stereotype'],$score14['sexism'],$score14['prohobitive']);


		 	$totalScore10= $this->calculationOfAgeScore($score10['postiveMessages'],$score10['educationValues'],$score10['violence'],$score10['abusiveLanguage'],$score10['childAbuse'],$score10['sexNudity'],$score10['consumerism'],$score10['drinkingDrugsSmoking'],$score10['stereotype'],$score10['sexism'],$score10['prohobitive']);


		 	$totalScore7= $this->calculationOfAgeScore($score7['postiveMessages'],$score7['educationValues'],$score7['violence'],$score7['abusiveLanguage'],$score7['childAbuse'],$score7['sexNudity'],$score7['consumerism'],$score7['drinkingDrugsSmoking'],$score7['stereotype'],$score7['sexism'],$score7['prohobitive']);

		 	$totalScore4= $this->calculationOfAgeScore($score4['postiveMessages'],$score4['educationValues'],$score4['violence'],$score4['abusiveLanguage'],$score4['childAbuse'],$score4['sexNudity'],$score4['consumerism'],$score4['drinkingDrugsSmoking'],$score4['stereotype'],$score4['sexism'],$score4['prohobitive']);
		 	//return $totalScore18,$totalScore14,$totalScore10,$totalScore7,$totalScore4);


		 	$ratingScore18=$this->ratingCalculation($totalScore18);
		 	$ratingScore14=$this->ratingCalculation($totalScore14);
		 	$ratingScore10=$this->ratingCalculation($totalScore10);
		 	$ratingScore7=$this->ratingCalculation($totalScore7);
		 	$ratingScore4=$this->ratingCalculation($totalScore4);


		 	if($totalScore4 > 4){
		 		$age=4;
		 		$rating=$ratingScore4;
		 	}elseif($totalScore7 > 4){
		 		$age=7;
		 		$rating=$ratingScore7;
		 	}elseif($totalScore10 > 4){
		 		$age=10;
		 		$rating=$ratingScore10;
		 	}elseif($totalScore14 > 4){
		 		$age=14;
		 		$rating=$ratingScore14;
		 	}elseif($totalScore18 > 4){
		 		$age=18;
		 		$rating=$ratingScore18;
		 	}else{
		 		$age=18;
		 		$rating=$ratingScore18;	
		 	}
		 	$postDataArr=array();
		 	 $postDataArr['age']=$age;
		 	 $postDataArr['rating']=$rating;
		 	
		 	$data=$this->Common->update('content',$postDataArr,['contentId'=>$contentId]);
		 	$this->updateContentPublishStatus($contentId);
	}


	public function calculationOfAgeScore($postiveMessages,$educationValues,$violence,$abusiveLanguage,$childAbuse,$sexNudity,$consumerism,$drinkingDrugsSmoking,$stereotype,$sexism,$prohobitive){
		if($prohobitive>0){
			$finalScore=0;
		}else{
			$finalScore=$postiveMessages+$educationValues-$violence-$abusiveLanguage-$childAbuse-$sexNudity-$consumerism-$drinkingDrugsSmoking-$stereotype-$sexism;
		}

		return $finalScore;
	}



	public function shortReview($id=NULL){
		$postDataArr=$this->input->post();
		$data=array();
		$id= $this->uri->segment(2);
		$data['id']=$id;
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['wrng_shortreview'] = $this->Common->selectData('wrng_shortreview', $fld = '*',['contentId'=>$id], $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false);

	if($postDataArr){	
		$postDataArr['contentId']=$id;
		unset($postDataArr['submit']);
				if($data['wrng_shortreview']){
						$this->Common->update_single('wrng_shortreview',$postDataArr,['contentId'=>$id]);
								$this->updateContentPublishStatus($this->uri->segment(2));
				}else{
						$this->Common->insert('wrng_shortreview',$postDataArr);	
								$this->updateContentPublishStatus($this->uri->segment(2));
				}
		}


		$id= $this->uri->segment(2);
		$data['id']=$id;		

		$data['content'] =$this->Common->selectData('content', $fld = '*',['contentId'=>$this->uri->segment(2)]);
		$data['wrng_shortreview'] =$this->Common->selectData('wrng_shortreview', $fld = '*',['contentId'=>$this->uri->segment(2)]);
		$this->load->view('advisory-short-review',$data);

	}




	public function tipsandTricks(){
		$postDataArr=$this->input->post();
		$data=array();
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');
		$data['id']=$this->uri->segment(2);
		
		if(isset($postDataArr['submit'])){
					$pre= time(); 
					$image=$_FILES['videoThumbnailImage']['name'];
					$target_path = "assets/photo/";
					$file= $_FILES['videoThumbnailImage']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["videoThumbnailImage"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$postDataArr["videoThumbnailImage"] = $pre.$file;	
					unset($postDataArr['updateTricks']);	
					unset($postDataArr['submit']);
					$postDataArr['contentId']=$this->uri->segment(2);	

					$this->Common->insert('wrng_tipsList',$postDataArr);	
					$this->updateContentPublishStatus($this->uri->segment(2));
		}
		if(isset($postDataArr['updateTricks'])){
				
				if($_FILES['videoThumbnailImage']['size'] == 0){
					$columnArr["videoThumbnailImage"] = $_POST["videoThumbnailImage1"];
				}else{
					$pre= time(); 
					$image=$_FILES['videoThumbnailImage']['name'];
					$target_path = "assets/photo/";
					$file= $_FILES['videoThumbnailImage']['name'];
					$target_path = $target_path.$pre.$file;
					$source=$_FILES["videoThumbnailImage"]["tmp_name"];	
					move_uploaded_file($source,$target_path);	
					$postDataArr["videoThumbnailImage"] = $pre.$file;	
				}
				unset($postDataArr['updateTricks']);

				$tipsId=$postDataArr['tipsId'];	
				unset($postDataArr['tipsId']);	
				unset($postDataArr['description2']);	
				unset($postDataArr['videoThumbnailImage1']);	
				$this->Common->update_single('wrng_tipsList',$postDataArr,['id'=>$tipsId]);
				$this->updateContentPublishStatus($this->uri->segment(2));
				//header("location:". base_url_index);
		}
		$data['content'] =$this->Common->selectData('content', $fld = '*',['contentId'=>$this->uri->segment(2)]);
		$data['wrng_tipslist'] =$this->Common->selectData('wrng_tipsList', $fld = '*',['contentId'=>$this->uri->segment(2)]);
		$data['platform'] =$this->Common->selectData('platform');
		$data['content'] = $this->Common->selectData('content','*',['contentId'=>$this->uri->segment(2)]);
		$this->load->view('advisory-tips-and-tricks',$data);
	}



	function tipsDelete($tbl,$id,$location,$contentId){
		 		$tbl=$this->uri->segment(3);
		 		$id=$this->uri->segment(4);
	 			$location=$this->uri->segment(5);
	 			$contentId=$this->uri->segment(6);
			$data['cmsdata'] = $this->Common->deleteDb($tbl,array('id'=>$id));
			if($data){
				header("location:".base_url_index.$location.'/'.$contentId);
			}	
	}


	function categoriesDelete($tbl,$id,$location){
		 		$tbl=$this->uri->segment(3);
		 		$id=$this->uri->segment(4);
	 			$location=$this->uri->segment(5);
	 			$contentId=$this->uri->segment(6);
			$data['cmsdata'] = $this->Common->deleteDb($tbl,array('subId'=>$id));
			if($data){
				header("location:".base_url_index.$location);
			}	
	}


		function categoriesDeleteAll($tbl,$id,$location){
		 		$tbl=$this->uri->segment(3);
		 		$id=$this->uri->segment(4);
	 			$location=$this->uri->segment(5);
	 			$contentId=$this->uri->segment(6);
			$data['cmsdata'] = $this->Common->deleteDb($tbl,array($contentId=>$id));
			if($data){
				header("location:".base_url_index.$location);
			}	
	}






	function contentStatusActivate(){
			$id=$this->uri->segment(4);
		 	$postDataArr['status']=1;	
			$data['cmsdata'] = $this->Common->update_single('content',$postDataArr,['contentId'=>$this->uri->segment(4)]);
			//print_r($data['cmsdata']);
			if($data){
				header("location:".base_url_index.'upload-new-book/'.$id);
			}	
	}


	function userStatusActivate(){

			$location=$this->uri->segment(4);
			$value=$this->uri->segment(3);

		 	$postDataArr['status']=$value;	
			$data['cmsdata'] = $this->Common->update_single('cms_admin',$postDataArr,['id'=>$this->uri->segment(5)]);
			//print_r($data['cmsdata']);

			
			if($data){
				header("location:".base_url_index.$location);
			}	
	}



		
		function pgStatusActivate(){
		 	$id=$this->uri->segment(4);
		 	$postDataArr['pgStatus']=$this->uri->segment(3);
			$data['cmsdata'] = $this->Common->update('content',$postDataArr,['contentId'=>$id]);
			if($data){
				header("location:".base_url_index.'advisory-rating/'.$id);
			}	
		}

}
