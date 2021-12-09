<?php

Class Login_Database extends CI_Model {
 
	public function fetchUserDetailViaEmail($prjId, $post)
	{	
		$condition = "projectId =" . "'" . $prjId . "' and user_email='".$post['email']."' and accountStatus='Active'";
		$this->db->select('*');
		$this->db->from('paper_users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() >0) {
			return $query->result();	
		}else
		{
			return false;
		}
	}

	public function updateAdmin($id)
	{
		$query = $this->db->get_where('cms_admin', array('id' => $id));
		$resutl = $query->result();
		return $resutl;
	}

	public function admindelete($id)
	{
		//echo "OK $id"; die();
		$this->db->where('id', $this->security->xss_clean(strip_tags($id)));
		return $this->db->delete('cms_admin');
	}
	
	public function updatesadmin($result,$upFIle)
	{
		/*if(!empty($result['photo']))
		{
			$file_name1=str_replace("[removed]","",$result['photo']);
			$imagedata1 = base64_decode($file_name1);
			$filename1 = "1_".md5(date("dmYhisA"));
			//Location to where you want to created sign image
			$file_name11 = 'assets/photo/'.$filename1.'.png';
			file_put_contents($file_name11,$imagedata1);
		} else {
			$file_name11 = $result['oldfile'];
		}*/
		$data1=array( 
			'name'=>$this->security->xss_clean(strip_tags($result['name'])),
			//'email'=>$this->security->xss_clean(strip_tags($result['email'])),
			'phone'=>$this->security->xss_clean(strip_tags($result['phone'])),
			'address'=>$this->security->xss_clean(strip_tags($result['address'])),
			'pan'=>$this->security->xss_clean(strip_tags($result['pan'])),
			'adhar'=>$this->security->xss_clean(strip_tags($result['adhar'])),
			'password'=>$this->security->xss_clean(strip_tags($result['password'])),
			'parent_type'=>$this->security->xss_clean(strip_tags($result['parent_type'])),
			'comment'=>$this->security->xss_clean(strip_tags($result['comment'])),
			'photo'=>$this->security->xss_clean(strip_tags($upFIle))
		);
		$this->db->where('id', $this->uri->segment(2));
		$insert = $this->db->update('cms_admin', $data1);				
		return $insert;
	}

	public function save_activityaddAdmin($result,$upFIle)
	{
		/*$file_name1=str_replace("[removed]","",$result['photo']);
		$imagedata1 = base64_decode($file_name1);
		$filename1 = "1_".md5(date("dmYhisA"));
		//Location to where you want to created sign image
		$file_name11 = 'assets/photo/'.$filename1.'.png';
		file_put_contents($file_name11,$imagedata1);*/
		
		$data=array( 
			'user_type'=>'2',
			'name'=>$this->security->xss_clean(strip_tags($result['name'])),
			'email'=>$this->security->xss_clean(strip_tags($result['email'])),
			'phone'=>$this->security->xss_clean(strip_tags($result['phone'])),
			'address'=>$this->security->xss_clean(strip_tags($result['address'])),
			'pan'=>$this->security->xss_clean(strip_tags($result['pan'])),
			'adhar'=>$this->security->xss_clean(strip_tags($result['adhar'])),
			'password'=>$this->security->xss_clean(strip_tags($result['password'])),
			'comment'=>$this->security->xss_clean(strip_tags($result['comment'])),
			'photo'=>$this->security->xss_clean(strip_tags($upFIle)),
			'created_at'=>date('Y-m-d H:i:s')
		);
		$data=$this->security->xss_clean($data);
		$this->db->insert('cms_admin',$data); 
		$insert_id=$this->db->insert_id();
		return $insert_id;
	}

	public function save_activityaddTeamleader($result,$upFIle)
	{
		/*$file_name1=str_replace("[removed]","",$result['photo']);
		$imagedata1 = base64_decode($file_name1);
		$filename1 = "1_".md5(date("dmYhisA"));
		//Location to where you want to created sign image
		$file_name11 = 'assets/photo/'.$filename1.'.png';
		file_put_contents($file_name11,$imagedata1);*/
		
		$data=array( 
			'user_type'=>'3',
			'name'=>$this->security->xss_clean(strip_tags($result['name'])),
			'email'=>$this->security->xss_clean(strip_tags($result['email'])),
			'phone'=>$this->security->xss_clean(strip_tags($result['phone'])),
			'address'=>$this->security->xss_clean(strip_tags($result['address'])),
			'pan'=>$this->security->xss_clean(strip_tags($result['pan'])),
			'adhar'=>$this->security->xss_clean(strip_tags($result['adhar'])),
			'password'=>$this->security->xss_clean(strip_tags($result['password'])),
			'parent_type'=>$this->security->xss_clean(strip_tags($result['parent_type'])),
			'comment'=>$this->security->xss_clean(strip_tags($result['comment'])),
			'photo'=>$this->security->xss_clean(strip_tags($upFIle)),
			'created_at'=>date('Y-m-d H:i:s')
		);
		$data=$this->security->xss_clean($data);
		$this->db->insert('cms_admin',$data); 
		$insert_id=$this->db->insert_id();
		return $insert_id;
	}

	public function save_activityaddReviewer($result,$upFIle)
	{
		/*$file_name1=str_replace("[removed]","",$result['photo']);
		$imagedata1 = base64_decode($file_name1);
		$filename1 = "1_".md5(date("dmYhisA"));
		//Location to where you want to created sign image
		$file_name11 = 'assets/photo/'.$filename1.'.png';
		file_put_contents($file_name11,$imagedata1);*/
		
		$data=array( 
			'user_type'=>'4',
			'name'=>$this->security->xss_clean(strip_tags($result['name'])),
			'email'=>$this->security->xss_clean(strip_tags($result['email'])),
			'phone'=>$this->security->xss_clean(strip_tags($result['phone'])),
			'address'=>$this->security->xss_clean(strip_tags($result['address'])),
			'pan'=>$this->security->xss_clean(strip_tags($result['pan'])),
			'adhar'=>$this->security->xss_clean(strip_tags($result['adhar'])),
			'password'=>$this->security->xss_clean(strip_tags($result['password'])),
			'parent_type'=>$this->security->xss_clean(strip_tags($result['parent_type'])),
			'comment'=>$this->security->xss_clean(strip_tags($result['comment'])),
			'photo'=>$this->security->xss_clean(strip_tags($upFIle)),
			'created_at'=>date('Y-m-d H:i:s')
		);
		$data=$this->security->xss_clean($data);
		$this->db->insert('cms_admin',$data); 
		$insert_id=$this->db->insert_id();
		return $insert_id;
	}

	public function getlist($st)
	{
		$this->db->select('*');
		$this->db->from('cms_admin');
		$this->db->where('user_type', $st);
		$this->db->order_by('id','Desc');
		$qry = $this->db->get();
		if ($qry->num_rows() >0) {
			return $qry->result();
		}else
		{ 
			return false;
		}
	}

	public function validateUsernamePassword($user,$pass)
	{
		$pass=str_replace("'", "",$pass);
		$pass=trim($pass);
		$user=str_replace("1=1", "",$user);
		$user=str_replace(" or ", "",$user);
		$user=str_replace(" ", "",$user);
		$user=str_replace("'", "",$user);
		$user=str_replace("=","",$user);
		$user=str_replace("+","",$user);
		$user=str_replace("*","",$user);
		$user=str_replace("/","",$user);
		$user=str_replace("#","",$user);
		$user=str_replace("$","",$user);
		$user=str_replace("%","",$user);
		$user=str_replace("!","",$user);
		$user=str_replace("^","",$user);
		$user=str_replace("&","",$user);
		$user=str_replace("(","",$user);
		$user=str_replace(")","",$user);
		$user=str_replace("}","",$user);
		$user=str_replace("}","",$user);
		$user=str_replace("]","",$user);
		$user=str_replace("[","",$user);
		$user=str_replace("/","",$user);
		$user=str_replace("?","",$user);
		$user=trim($user);
		//$pass=md5($pass . "!yBZlh6A)4%L");
		$condition = "email =" . "'" . $user . "' AND " . "password =" . "'" . $pass . "'". " AND " . "status =" . "'" . 1 . "'". "              ";
		$this->db->select('id');
		$this->db->from('cms_admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query(); 
		if ($query->num_rows() == 1) {
		$arrRes=$query->result();
		//print_r($arrRes);
		foreach($arrRes as $value)
		{
			$loginId=$value->id;
		}
		return $loginId;
		} else {
			return false;
		}	
	}

	public function fetchLoginUserBYId($id)
	{
		$condition = "id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('cms_admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}	
	}

}
?>