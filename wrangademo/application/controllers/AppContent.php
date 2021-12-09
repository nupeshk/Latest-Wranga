<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppContent extends CI_Controller {

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
				
		if(isset($postDataArr['SubmitAgeGroup'])){
			unset($postDataArr['SubmitAgeGroup']);
			$postDataAge['age']=$postDataArr['age'];
			$this->Common->update('content',$postDataAge,['contentId'=>$id]);
		}

		/** 16  108-114  Ease of Use 7 		SubmitEaseOfUse		EaseOfUseValue**/

		if($postDataArr['SubmitEaseOfUse']){
			unset($postDataArr['SubmitEaseOfUse']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$this->Common->deleteOther($id,16);
			for ($i=0; $i <=6; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=108+$i;
				$postDataArrMenu['value']=$postDataArr['EaseOfUseValue'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}						
			 $EaseOfUseValue=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$id,'ratingCalCategoryId'=>'16']);
			 $postDataArrr['ratning']=$this->ratingCalculation($EaseOfUseValue[0]->value);
			 $postDataArrr['ratningScore']=$EaseOfUseValue[0]->value;
			 $postDataArrr['contentId']=$id;
			 $postDataArrr['reatingCalCategoryId']=16;
			 $this->Common->deletemoralBoard($id,16);		
			 $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			 $this->calculationOfFinalRating($id);	
		}


		/** 17 115-121 PwD Accessibility 7 PwdAccessibilityValue	SubmitPwdAccessibility**/

		if($postDataArr['SubmitPwdAccessibility']){
			unset($postDataArr['SubmitPwdAccessibility']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			//	$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1']);		
			$this->Common->deleteOther($id,17);
			for ($i=0; $i <=6 ; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=115+$i;
				$postDataArrMenu['value']=$postDataArr['PwdAccessibilityValue'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}						
			 $sumPwdAccessibilityValue=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$id,'ratingCalCategoryId'=>'17']);
			 $postDataArrr['ratning']=$this->ratingCalculation($sumPwdAccessibilityValue[0]->value);
			 $postDataArrr['ratningScore']=$sumPwdAccessibilityValue[0]->value;
			 $postDataArrr['contentId']=$id;
			 $postDataArrr['reatingCalCategoryId']=17;
			 $this->Common->deletemoralBoard($id,17);		
			 $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			 $this->calculationOfFinalRating($id);
		}

		/** 18 122-126 Safety Features 5 SafetyFeaturesValue		SubmitSafetyFeaturesValue**/

		if($postDataArr['SubmitSafetyFeaturesValue']){
			unset($postDataArr['SubmitSafetyFeaturesValue']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			//	$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1']);		
			$this->Common->deleteOther($id,18);
			for ($i=0; $i <=4 ; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=122+$i;
				$postDataArrMenu['value']=$postDataArr['SafetyFeaturesValue'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}						
			 $sumSafetyFeatures=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$id,'ratingCalCategoryId'=>'18']);
			 $postDataArrr['ratning']=$this->ratingCalculation($sumSafetyFeatures[0]->value);
			 $postDataArrr['ratningScore']=$sumSafetyFeatures[0]->value;
			 $postDataArrr['contentId']=$id;
			 $postDataArrr['reatingCalCategoryId']=18;
			 $this->Common->deletemoralBoard($id,18);		
			 $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			 $this->calculationOfFinalRating($id);	
		}

		/** 19 127-151 Risk to Privacy 30 	SubmitRiskToPrivacyValue RiskToPrivacyValue**/

		if($postDataArr['SubmitRiskToPrivacyValue']){
			unset($postDataArr['SubmitRiskToPrivacyValue']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			//	$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1']);		
			$this->Common->deleteOther($id,19);
			for ($i=0; $i <30 ; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=127+$i;
				$postDataArrMenu['value']=$postDataArr['RiskToPrivacyValue'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}						
			 $sumSafetyFeatures=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$id,'ratingCalCategoryId'=>'19']);
			 $postDataArrr['ratning']=$this->ratingCalculation($sumSafetyFeatures[0]->value);
			 $postDataArrr['ratningScore']=$sumSafetyFeatures[0]->value;
			 $postDataArrr['contentId']=$id;
			 $postDataArrr['reatingCalCategoryId']=19;
			 $this->Common->deletemoralBoard($id,19);		
			 $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			 $this->calculationOfFinalRating($id);		
		}


		/** 20 157-161 Positive Learning 5 PositiveLearningValue SubmitPositiveLearningValue**/

		if($postDataArr['SubmitPositiveLearningValue']){
			unset($postDataArr['SubmitPositiveLearningValue']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			//	$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1']);		
			$this->Common->deleteOther($id,20);
			for ($i=0; $i <5 ; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=157+$i;
				$postDataArrMenu['value']=$postDataArr['PositiveLearningValue'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}						
			 $sumSafetyFeatures=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$id,'ratingCalCategoryId'=>'20']);
			 $postDataArrr['ratning']=$this->ratingCalculation($sumSafetyFeatures[0]->value);
			 $postDataArrr['ratningScore']=$sumSafetyFeatures[0]->value;
			 $postDataArrr['contentId']=$id;
			 $postDataArrr['reatingCalCategoryId']=20;
			 $this->Common->deletemoralBoard($id,20);		
			 $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			 $this->calculationOfFinalRating($id);		
		}

		/** 21 162-169 Negative Features 8 NegativeFeaturesValue		SubmitNegativeFeaturesValue**/

		if($postDataArr['SubmitNegativeFeaturesValue']){
			unset($postDataArr['SubmitNegativeFeaturesValue']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			//	$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1']);		
			$this->Common->deleteOther($id,21);
			for ($i=0; $i <8 ; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=162+$i;
				$postDataArrMenu['value']=$postDataArr['NegativeFeaturesValue'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}						
			 $sumSafetyFeatures=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$id,'ratingCalCategoryId'=>'21']);
			 $postDataArrr['ratning']=$this->ratingCalculation($sumSafetyFeatures[0]->value);
			 $postDataArrr['ratningScore']=$sumSafetyFeatures[0]->value;
			 $postDataArrr['contentId']=$id;
			 $postDataArrr['reatingCalCategoryId']=21;
			 $this->Common->deletemoralBoard($id,21);		
			 $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			 $this->calculationOfFinalRating($id);		
		}

		/** 22 170 Additional Feature 1 AdditionalFeatureValue		SubmitAdditionalFeatureValue**/

		if($postDataArr['SubmitAdditionalFeatureValue']){
			unset($postDataArr['SubmitAdditionalFeatureValue']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			//	$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1']);		
			$this->Common->deleteOther($id,22);
			for ($i=0; $i <1 ; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=170+$i;
				$postDataArrMenu['value']=$postDataArr['AdditionalFeatureValue'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}						
			 $sumSafetyFeatures=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$id,'ratingCalCategoryId'=>'22']);
			 $postDataArrr['ratning']=$this->ratingCalculation($sumSafetyFeatures[0]->value);
			 $postDataArrr['ratningScore']=$sumSafetyFeatures[0]->value;
			 $postDataArrr['contentId']=$id;
			 $postDataArrr['reatingCalCategoryId']=22;
			 $this->Common->deletemoralBoard($id,22);		
			 $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			 $this->calculationOfFinalRating($id);
		}


	
		/** **prohobitive 	***26 ***/
		if($postDataArr['PositiveLearningSubmitNew']){

			$postDataArr['ratingCalCategoryId']=26;
			
			unset($postDataArr['PositiveLearningSubmitNew']);
			$postDataArrr['desc']=$postDataArr['desc'];
			unset($postDataArr['desc']);
			$postDataArr['ratingCalCategoryId']=26;
			//	$wrng_reatingcalsubcategory=$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>'1']);		
			$this->Common->deleteOther($id,26);
			for ($i=0; $i <7; $i++) { 
				$postDataArrMenu['contentId']=$id;
				$postDataArrMenu['ratingCalCategoryId']=$postDataArr['ratingCalCategoryId'];
				$postDataArrMenu['ratingCalSubCategoryId']=181+$i;
				$postDataArrMenu['value']=$postDataArr['ProhibitiveCategoryApp'.$i];
				$this->Common->insert('wrng_contentthematicrating',$postDataArrMenu);	
			}
			$sumRisktoPrivacy=$this->Common->selectData('wrng_contentthematicrating', $fld = 'SUM(`value`) as value',['contentId'=>$postDataArr['ratingCalCategoryId'],'ratingCalSubCategoryId'=>'26']);
			$postDataArrr['ratning']=$this->ratingCalculation($sumRisktoPrivacy[0]->value);
			#$postDataArrr['ratningScore']=$sumRisktoPrivacy[0]->value;
			$postDataArrr['contentId']=$id;
			$postDataArrr['reatingCalCategoryId']=26;
			$this->Common->deletemoralBoard($id,26);		
			$moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
			$this->calculationOfFinalRating($id);	
		}


/***************************************************************************************/

		
		$data['adminCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>2]);
		$data['teamLeaderCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>3]);
		$data['reviewerCount'] = $this->Common->nrows('cms_admin','*',['user_type'=>4]);
		$data['mobileCount'] = $this->Common->nrows('users');

$data['REaseOfUse'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>16]);
$data['RPwDAccessibility'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>17]);
$data['RSafetyFeatures'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>18]);
$data['RRisktoPrivacy'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>19]);	
$data['RPositiveLearning'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>20]);
$data['RNegativeFeatures'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>21]);
$data['RAdditionalFeature'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>22]);
$data['RProhibitiveCategory'] =$this->Common->selectData('moralBoard', $fld = '*',['contentId'=>$id,'reatingCalCategoryId'=>26]);
		

		$id= $this->uri->segment(2);
		$data['id']=$id;
		$data['content'] =$this->Common->selectData('content', $fld = '*',['contentId'=>$id]);

	if(isset($postDataArr['submitAppRating'])){	
		foreach ($postDataArr as $key => $value) {
			$postDataArr=array(
				"contentId"=> $this->uri->segment(2),
				"ratingCalCategoryId"=>16,
				"ratingCalSubCategoryId"=>$key,
				"value"=>$value
			);
			$wrng_contentRating=$this->Common->selectData('wrng_contentthematicrating','*',['ratingCalCategoryId'=>'16',"contentId"=> $this->uri->segment(2),"ratingCalSubCategoryId"=>$key]);
					// $postDataArrr['reatingCalCategoryId']=1;
					// $postDataArrr['ratning']=$this->ratingCalculation($rangeScore);
					// $postDataArrr['ratningScore']=$rangeScore;
					// $postDataArrr['contentId']=$id;			
					// $this->Common->deletemoralBoard($id,1);			
					// $moralboardId=$this->Common->insert('moralBoard',$postDataArrr);	
		
			if($wrng_contentRating){
				$data=$this->Common->update('wrng_contentthematicrating',$postDataArr,['contentRatingId'=>$key]);
			}else{
				$this->Common->insert('wrng_contentthematicrating',$postDataArr);
			}	
				
		}	
	}


		$data['EaseOfUse'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>16]);
		$data['PwdAccessibility'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>17]);
		$data['SafetyFeatures'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>18]);
		$data['RiskToPrivacy'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>19]);
		$data['PositiveLearning'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>20]);
		$data['NegativeFeatures'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>21]);
		$data['AdditionalFeature'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>22]);
		$data['ProhibitiveCategoryApp'] =$this->Common->selectData('wrng_reatingCalSubCategory', $fld = '*',['parent'=>26]);

		$this->load->view('app-rating',$data);



	}

	public function occuranceMultiplierCal($mildValue,$extremValue,$vidieodDuratio,$mildMultiplier,$extremeMultiplier){
		 	$score=number_format(($mildValue/round($vidieodDuratio/60))/$mildMultiplier,2)+number_format(($extremValue/round($vidieodDuratio/60))/$extremeMultiplier,2);
		 return $score;
	}


	public function calculationOfFinalRating($contentId){
		$postDataArr=array();
		$safetyFeatures=$this->Common->moralBoardRating($contentId,12);
		$riskToPrivacy=$this->Common->moralBoardRating($contentId,13);
		$positiveLearning=$this->Common->moralBoardRating($contentId,14);
		$negativeFeatures=$this->Common->moralBoardRating($contentId,15);
		$prohibitiveCategory=$this->Common->moralBoardRating($contentId,16);

		$rating=$this->calculationOfScoreAndRating($safetyFeatures,$riskToPrivacy,$positiveLearning,$negativeFeatures,$prohibitiveCategory);
		  $postDataArr['rating']=$rating;
		 $data=$this->Common->update('content',$postDataArr,['contentId'=>$contentId]);
		 $this->updateContentPublishStatus($contentId);
	}


		public function calculationOfScoreAndRating($safetyFeatures,$riskToPrivacy,$positiveLearning,$negativeFeatures,$prohibitiveCategory){
			if($prohobitive>0){
				$finalScore=0;
			}else{
				$finalScore=$safetyFeatures-$riskToPrivacy+$positiveLearning-$negativeFeatures;
			}
			return $this->ratingCalculation($finalScore);
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
		$this->load->view('app-short-review',$data);
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
		$this->load->view('app-tips-and-tricks',$data);
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
				header("location:".base_url_index.'upload-new-app/'.$id);
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
				header("location:".base_url_index.'app-rating/'.$id);
			}	
		}

}
