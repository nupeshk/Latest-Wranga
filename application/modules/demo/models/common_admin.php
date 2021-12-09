<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_admin extends CI_Model {

	public function __construct() {

		parent::__construct();	

	}
		
	function insertDb($tblname,$data) {
        $status=$this->db->insert($tblname, $data);
		//echo $this->db->last_query();die;
		 return $status;
    }
	
	function updateDb($tblname,$data,$whe){
		$this->db->update($tblname,$data,$whe);	
		//echo $this->db->last_query();die;
		return true;
	}

	
	function selectData($table,$fld='*',$condition=false,$ordcol=false,$ord=false){
		if($condition){
			$this->db->where($condition);
		}
		if($ordcol && $ord){
		$this->db->order_by($ordcol,$ord);
		}
		$catData = $this->db->select($fld)->get($table)->result();
		//echo $this->db->last_query();die;
		return $catData;
	}
	
		###------------Status-------

	function activeDeactiveDb($table,$cols=false,$where = false) {
 
		if($where){
  			 $this->db->where($where);
  		}
   	    $this->db->update($table,$cols);
	    //echo $this->db->last_query();die;
        return $this->db->affected_rows();  
	}  
	
	function deleteDb($table,$where = false) {
		if($where){
  			$this->db->where($where , NULL, false);
  		}
   	    $this->db->delete($table);
	    //echo $this->db->last_query();die;
        return $this->db->affected_rows();  
            
	}  

	

} //model closed



