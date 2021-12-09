<?php

Class User_Database extends CI_Model {
		
	function __construct()
	{
		$this->load->database();
		if (isset($_SESSION['destroyed']) && $_SESSION['destroyed'] < time() - 300) 
		{
			$_SESSION['destroyed']=time();
			session_regenerate_id();
		}	
	}


	public function fetchNameUserById($did)
	{
		$condition = " id='".$did."'";
		$this->db->select('*');
		$this->db->from('paper_users');
		$this->db->where($condition);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() >0) {
			//print_r($query->result());die();
			foreach($query->result() as $val)
			{
				return $val->name;
			}
		}else
		{ 
			return false;
		}	
	}

	public function getTemplateDetailByMailType($mailType)
	{
		$condition =  "mailType =" . "'" . $mailType . "' order by id desc";
		$this->db->select('*');
		$this->db->from('mailTemplate');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}

	public function getusernameBYUseriD($userId)
	{
		$condition =  "id =" . "'" . $userId . "' order by id desc";
		$this->db->select('*');
		$this->db->from('paper_users');
		$this->db->where($condition);
		$query = $this->db->get();
		$query->result();
		$name="";
		foreach($query->result() as $usVal)
		{
			$name=$usVal->name;
		}
		return $name;
	}
	
	public function getusernameBYEmail($email)
	{
		$condition =  "user_email =" . "'" . $email . "' order by id desc limit 1";
		$this->db->select('*');
		$this->db->from('paper_users');
		$this->db->where($condition);
		$query = $this->db->get();
		$query->result();
		if ($query->num_rows() >0) {
			foreach($query->result() as $usVal)
			{
			$name=$usVal->name;
			}
		}else
		{
			$name="Support Team";
		}
		return $name;
	}
	
	public function getusernameUseriD($userId)
	{
		$condition =  "id =" . "'" . $userId . "' order by id desc";
		$this->db->select('*');
		$this->db->from('paper_users');
		$this->db->where($condition);
		$query = $this->db->get();
		$query->result();
		return $query->result();
	}

	public function getuserList($id) 
	{
		$condition =  "user_type='".$id."' order by name Asc";
		$this->db->select('*');
		$this->db->from('cms_admin');
		$this->db->where($condition);
		$query = $this->db->get();
		//echo $this->db->last_query(); 
		if ($query->num_rows() >0) {
			//print_r($query->result());die();
			return $query->result();
		}else
		{ 
			return false;
		}
	}
	
	public function getUserDetailsById($ediId) 
	{
		$condition =  "id =" . "'" . $ediId . "'";
		$this->db->select('*');
		$this->db->from('paper_users');
		$this->db->where($condition);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() >0) {
			//print_r($query->result());die();
			return $query->result();
		}else
		{ 
			return false;
		}
	}

	public function getEmailDetailsValidity($email) 
	{
		$condition =  " email = '".$email."' ";
		$this->db->select('*');
		$this->db->from('cms_admin');
		$this->db->where($condition);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() >0) {
			//print_r($query->result());die();
			return $query->result();
		}else
		{ 
			return false;
		}
	}

	public function getuserSearchList($srchTxt, $did)
	{
		if($did==1)
		{
			$fieldName="";
		}if($did==1)
		{
			$fieldName="name";
		}else if($did==2)
		{
			$fieldName="user_initial";
		}
		else if($did==3)
		{
			$fieldName="user_email";
		}
		else if($did==4)
		{
			$fieldName="userType";
		}
		else if($did==5)
		{
			$fieldName="companyName";
		}
		else if($did==6)
		{
			$fieldName="address";
		}
		else if($did==7)
		{
			$fieldName="user_name";
		}
		else if($did==8)
		{
			$fieldName="user_dept";
		}
		else if($did==9)
		{
			$fieldName="mobile";
		}
		else if($did==10)
		{
			$fieldName="accountStatus";
		}else{
			$fieldName="";
		}
		if($this->session->userdata('type')=='Corporate')
		{	
			if($srchTxt=="" || $fieldName=="")
			{
				$condition =  "projectId =" . "'" .$this->session->userdata('projectId'). "' and (deptType='Corporate' or deptType='Both')";
				$this->db->select('*');
				$this->db->from('paper_users');
				$this->db->where($condition);
				$query = $this->db->get();
			}else{
				$condition =  "projectId =" . "'" .$this->session->userdata('projectId'). "' and (deptType='Corporate' or deptType='Both') and ".$fieldName."  like '%".$srchTxt."%'";
				$this->db->select('*');
				$this->db->from('paper_users');
				$this->db->where($condition);
				$query = $this->db->get();
			}
		}else if($this->session->userdata('type')=='Retail')
		{	
			if($srchTxt=="" || $fieldName=="")
			{
				$condition =  "projectId =" . "'" .$this->session->userdata('projectId'). "' and (deptType='Retail' or deptType='Both')";
				$this->db->select('*');
				$this->db->from('paper_users');
				$this->db->where($condition);
				$query = $this->db->get();
			}else{
				$condition =  "projectId =" . "'" .$this->session->userdata('projectId'). "' and (deptType='Retail' or deptType='Both') and ".$fieldName."  like '%".$srchTxt."%'";
				$this->db->select('*');
				$this->db->from('paper_users');
				$this->db->where($condition);
				$query = $this->db->get();
			}
		}else
		{
			if($srchTxt=="" || $fieldName=="")
			{
				$condition =  "projectId =" . "'" .$this->session->userdata('projectId'). "' ";
				$this->db->select('*');
				$this->db->from('paper_users');
				$this->db->where($condition);
				$query = $this->db->get();
			}else{
				$condition =  "projectId =" . "'" .$this->session->userdata('projectId'). "'  and ".$fieldName."  like '%".$srchTxt."%'";
				$this->db->select('*');
				$this->db->from('paper_users');
				$this->db->where($condition);
				$query = $this->db->get();
			}
		}

		//$query1=$this->db->select('SELECT * FROM paper_users  WHERE '.$fieldName.' LIKE "%'.$srchTxt.'%"');
		//$query = $this->db->get($query1);
		if ($query->num_rows() >0) {
			return $query->result();
		}else
		{ 
			return false;
		}
	}

	public function insertUserDetails($post, $pass)
	{
		if($post['user_dept']=="Corporate Finance – Operations" || $post['user_dept']=="Corporate Finance – Customer Care" || $post['user_dept']=="Corporate Finance – Sales" || $post['user_dept']=="Corporate Finance – Credit" || $post['user_dept']=="Corporate Finance – Collections" || $post['user_dept']=="Corporate Finance & Accounts" || $post['user_dept']=="Corporate Human Resources" || $post['user_dept']=="Corporate Legal & Compliance" || $post['user_dept']=="Corporate CEO Office" )
		{
			$userDpt='Corporate';
		}else
		{
			$userDpt='Retail';
		}
		$pass=str_replace("'", "",$pass);
		$pass=trim($pass);
		$pass=md5($pass . "!yBZlh6A)4%L");
		$data=array(
		'projectId'=>$this->session->userdata('projectId'),
		'name'=>$this->security->xss_clean(strip_tags($post['name'])),
		'user_initial'=>$this->security->xss_clean(strip_tags($post['user_initial'])),
		'user_email'=>$this->security->xss_clean(strip_tags($post['user_email'])),
		'userType'=>$this->security->xss_clean($post['userType']),
		'companyName'=>$this->security->xss_clean(strip_tags($post['companyName'])),
		'address'=>$this->security->xss_clean(strip_tags($post['address'])),
		'user_name'=>$this->security->xss_clean(strip_tags($post['user_email'])),
		'user_pass'=>$pass,
		'user_dept'=>$this->security->xss_clean(strip_tags($post['user_dept'])),
		'deptType'=>$this->security->xss_clean(strip_tags($userDpt)),
		'mobile'=>$this->security->xss_clean(strip_tags($post['mobile'])),
		'accountStatus'=>'Active',
		'insertDate'=>date('Y-m-d H:i:s')
		);
		return $this->db->insert('paper_users', $data);	
	}

	public function forActiveAccount($pid,$did)
	{
		$data=array(
		'accountStatus'=>'Active',
		'lastUpdateDate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $did);
		return $this->db->update('cms_admin', $data);
	}

	public function forNonActiveAccount($pid,$did)
	{
		$data=array(
		'accountStatus'=>'Deactive',
		'lastUpdateDate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $did);
		return $this->db->update('cms_admin', $data);	
	}

	public function deleteUserDetails($pid,$did)
	{
		$this->db->where('id', $did);
		return $this->db->delete('cms_admin'); 	
	}

	public function updatePassword($post)
	{
		$pass=str_replace("'", "",$post['password']);
		$pass=trim($pass);
		$pass=md5($pass . "!yBZlh6A)4%L");
		$data=array(
		'user_pass'=>$pass,
		//'lastUpdateDate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $this->user_database->decryptform($post['eid'], $this->user_database->validateToken()));
		return $this->db->update('cms_admin', $data);
	}
	
	public function updatePassword1($post)
	{
		$pass=str_replace("'", "",$post['passing']);
		$pass=trim($pass);
		$pass=md5($pass . "!yBZlh6A)4%L");
		$data=array(
		'user_pass'=>$pass,
		'lastUpdateDate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $this->user_database->decryptform($post['eid'], $this->user_database->validateToken()));
		return $this->db->update('cms_admin', $data);
	}

	public function updatePassword12($post)
	{
		$pass=str_replace("'", "",$post['password']);
		$pass=trim($pass);
		$pass=md5($pass . "!yBZlh6A)4%L");
		$data=array(
		'user_pass'=>$pass,
		//'lastUpdateDate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('id', $post['eid']);
		return $this->db->update('cms_admin', $data);
	}

	public function changePassword($post)
	{
		$passOld="";
		$pass=str_replace("'", "",$post['password']);
		$pass=trim($pass);
		$pass=md5($pass . "!yBZlh6A)4%L");
		$condition =  "id =" . "'" . $this->session->userdata('userId') . "'";
		$this->db->select('*');
		$this->db->from('cms_admin');
		$this->db->where($condition);
		$query = $this->db->get();
		foreach($query->result() as $upass)
		{
			$passOld=$upass->user_pass;
		}
		if($pass===$passOld)
		{
			return 'same';
		}else
		{
			$data=array(
			//'newLoginStatus'=>'1',
			'password'=>$pass,
			//'lastUpdateDate'=>date('Y-m-d H:i:s'),
			//'changePasswordDate'=>date('Y-m-d H:i:s')
			);
			$this->db->where('id', $this->session->userdata('userId'));
			$this->db->update('cms_admin', $data);
			return 'right';
		}
	}

	//=============== CompanyName of user================================
	
	public function getDepartmentList()
	{
		$condition =  "status ='1' ";
		$this->db->select('*');
		$this->db->from('departmentList');
		$this->db->where($condition);
		$query = $this->db->get();
		return 	$query->result();	
	}

///////////////////// encrypt start for All /////////////////////////////////
	public function encryptform($data, $key) 
	{
		$cypher = 'aes-128-cbc';  
		$ivSize  = openssl_cipher_iv_length($cypher);
		$ivData  = openssl_random_pseudo_bytes($ivSize);
		$encripted = openssl_encrypt($data, 
								  $cypher, 
								  $key, 
								  OPENSSL_RAW_DATA, 
								  $ivData);		
		$mainval=base64_encode($ivData.$encripted);	  
		$mainval = str_replace("+", "1111", $mainval);	
		$mainval = str_replace("=", "2222", $mainval);	
		$mainval = str_replace("_", "3333", $mainval);							  
		$mainval = str_replace("-", "4444", $mainval);							  
		$mainval = str_replace("!", "9999", $mainval);							  
		$mainval = str_replace("@", "5555", $mainval);							  
		$mainval = str_replace("#", "6666", $mainval);							  
		$mainval = str_replace("$", "7777", $mainval);							  
		$mainval = str_replace("%", "0000", $mainval);							  
		$mainval = str_replace("^", "8888", $mainval);							  
		$mainval = str_replace("&", "1234", $mainval);							  
		$mainval = str_replace("*", "5678", $mainval);							  
		$mainval = str_replace("(", "9012", $mainval);							  
		$mainval = str_replace(")", "3456", $mainval);							  
		$mainval = str_replace(",", "7890", $mainval);							  
		$mainval = str_replace("{", "2345", $mainval);							  
		$mainval = str_replace("}", "6789", $mainval);							  
		$mainval = str_replace("[", "0123", $mainval);							  
		$mainval = str_replace("]", "4567", $mainval);							  
		$mainval = str_replace("|", "8901", $mainval);							  
		$mainval = str_replace("<", "3345", $mainval);							  
		$mainval = str_replace(">", "4456", $mainval);							  
		$mainval = str_replace("?", "6678", $mainval);
		$mainval = str_replace("/","6634",  $mainval);	 						  
		return $mainval;
	}
	
	public function decryptform($data, $key) 
	{
		$data = str_replace("1111","+", $data);	
		$data = str_replace("2222","=", $data);	
		$data = str_replace("3333","_",  $data);							  
		$data = str_replace("4444","-",  $data);							  
		$data = str_replace("9999","!",  $data);							  
		$data = str_replace("5555","@",  $data);							  
		$data = str_replace("6666","#",  $data);							  
		$data = str_replace("7777","$",  $data);							  
		$data = str_replace("0000","%",  $data);							  
		$data = str_replace("8888","^",  $data);							  
		$data = str_replace("1234","&",  $data);							  
		$data = str_replace("5678","*",  $data);							  
		$data = str_replace("9012","(",  $data);							  
		$data = str_replace("3456",")", $data);							  
		$data = str_replace("7890",",",  $data);							  
		$data = str_replace("2345","{",  $data);							  
		$data = str_replace("6789","}",  $data);							  
		$data = str_replace("0123","[",  $data);							  
		$data = str_replace("4567","]",  $data);							  
		$data = str_replace("8901","|",  $data);							  
		$data = str_replace("3345","<",  $data);							  
		$data = str_replace("4456",">",  $data);							  
		$data = str_replace("6678","?",  $data);
		$data = str_replace("6634","/",  $data);
		$cypher = 'aes-128-cbc';  
		$ivSize  = openssl_cipher_iv_length($cypher);
		$data = base64_decode($data);
		$ivData   = substr($data, 0, $ivSize);
		$encData = substr($data, $ivSize);
		$output = openssl_decrypt($encData, 
								$cypher, 
								$key, 
								OPENSSL_RAW_DATA, 
								$ivData);
		return $output;
	}
	
	public function isthisexistIdform($srcEncrypted,$table)
	{
		$srcDecrypted = $this->user_database->decryptform($srcEncrypted, $this->user_database->validateToken());
		$condition =  "id ='".$srcDecrypted."' order by id desc";
		$this->db->select('*');
		$this->db->from($table); 
		$this->db->where($condition);
		$query = $this->db->get();
			//echo $this->db->last_query();
		if($query->num_rows()>0)
		{
			foreach($query->result() as $usVal)
			{
				if($table == 'form_master')
				{
					$id=$usVal->Id;
				} else {
					$id=$usVal->id;
				}
			}
		}else
		{
			$id='';
		}
		return $id;
	}
	
///////////////////// encrypt End for All /////////////////////////////////	

	public function validateToken()
	{
		$mix=$this->session->userdata('mixture');
		if($mix=="")
		{
			echo "<script>window.location.href='".base_url('loginExpired')."'</script>";
		}else
		{
			$condition =  "id =" . "'" . $this->session->userdata('userId')."'";
			$this->db->select('*');
			$this->db->from('paper_users');
			$this->db->where($condition);
			$query = $this->db->get();
			if($query->num_rows()>0)
			{
				foreach($query->result_array() as $val)
				{
					$valMix1=$val['mixture'];
					$valMix2=$val['mixture1'];
					$valMix3=$val['mixture2'];
					$valMix4=$val['mixture3'];
					$valMix5=$val['mixture4'];
				}
			}else
			{
				$valMix1=999999;
				$valMix2=888888;
				$valMix3=777777;
				$valMix4=666666;
				$valMix5=555555;
			}
			$vM=array($valMix1,$valMix2,$valMix3,$valMix4,$valMix5);
			$travleMix=$this->user_database->decryptform($mix,"Qhse21HFcl");
			if(in_array($travleMix, $vM))
			{
				return $travleMix;
			}else
			{
				echo "";
			}
		}
	}
	
	public function fileCHeckMimeType($filename)
	{
	  $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
		$tmp = explode('.', $filename);
		$ext = end($tmp);
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        
        else {
            return 'application/octet-stream';
        }
	}
	
	public function checkRow($formTable,$fieldName,$rowId,$status)
	{
		$this->db->select('*');
		$this->db->from($formTable);
		$this->db->where($fieldName, $rowId);
		$this->db->where('status', $status); 
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() >0) {
			//print_r($query->result());die();
			return '1';//$query->result();
		} else
		{ 
			return '0';
		}
	}
	
	
}
?>