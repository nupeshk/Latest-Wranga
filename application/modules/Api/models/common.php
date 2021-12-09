<?php
	
	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');
	}
	
	class Common extends CI_Model {
		
		public function __construct() {
			
			parent::__construct();
		}
		
		public function encode($value) {
			return base64_encode($value);
		}
		
		public function decode($value) {
			return base64_decode($value);
		}

		
		
		public function selectMenu($table = false, $fld = false, $conditions = array(), $ord = false, $ordtype = false, $in = false, $inf = false, $or_wh = false) {
			
			
			$this->db->select($fld)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($or_wh) {
				$this->db->where($or_wh);
			}
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			if ($in && $inf) {
				$this->db->where_in($inf, $in);
			}
			
			$menu = $this->db->get()->result();
			//echo $this->db->last_query();die;
			
			return $menu;
		}
		
		function selectDB($table = false, $fld = '*', $conditions = false, $ord = false, $ordtype = false, $wh_in_fld = false, $wh_in = false, $limit = false, $or_wh = false) {
			
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($or_wh) {
				$this->db->where($or_wh);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			if ($limit) {
				$this->db->limit($limit);
			}
			$drow = $this->db->get()->result();
			
			
			// echo $this->db->last_query();echo "<br>";
			
			return $drow;
		}
		
		function selectData($table = false, $fld = '*', $conditions = false, $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false) {
			
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($whstr_in) {
				$this->db->where($whstr_in, null, false);
			}
			if ($or_where) {
				$this->db->or_where($or_where);
			}
			
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			if ($grpby) {
				$this->db->group_by($grpby);
			}
			if ($lmt) {
				$this->db->limit($lmt);
			}
			$drow = $this->db->get()->result();
			
			// echo $this->db->last_query(); die;
			return $drow;
		}
		
		function get_auto_data($q) {
			$this->db->select('*')->from('tbl_blog');
			$this->db->like('title', $q);
			$this->db->or_like('news', $q);

			return$this->db->get()->result();
		}
		
		
		
		
		function selectSpecialData($table = false, $fld = '*', $conditions = false, $grpby = false, $having = false, $whstr_in = false) {
			$result = array();
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($whstr_in) {
				$this->db->where($whstr_in);
			}
			if ($grpby) {
				$this->db->group_by($grpby);
			}
			if ($having) {
				$this->db->having($having);
			}
			
			$drow = $this->db->get()->result();
			foreach ($drow as $res) {
				$result['status'][] = $res->present_status;
				$result['value'][] = $res->nm;
			}
			
			// echo $this->db->last_query();//die;
			
			return $result;
		}
		
		function selectRow($table = false, $fld = '*', $conditions = false, $ord = false, $ordtype = false, $wh_in_fld = false, $wh_in = false) {
			
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			$row = $this->db->get()->row();
			
			
			//        echo $this->db->last_query();die;
			
			return $row;
		}
		
		function selectRowArray($table = false, $fld = '*', $conditions = false, $ord = false, $ordtype = false, $wh_in_fld = false, $wh_in = false) {
			
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			$row = $this->db->get()->row_array();
			
			
			//echo $this->db->last_query();die;
			
			return $row;
		}
		
		function selectResultArray($table = false, $fld = '*', $conditions = false, $ord = false, $ordtype = false, $wh_in_fld = false, $wh_in = false) {
			$sub_Arr = array('dashboard');
			$this->db->select($fld)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			$row = $this->db->get()->result();
			
			//echo $this->db->last_query();die;
			foreach ($row as $rdata) {
				$sub_Arr[] = $rdata->action_name;
			}
			
			return $sub_Arr;
		}
		
		function selectInArray($table = false, $fld = '*', $conditions = false, $wh_in_fld = false, $wh_in = false, $gp = false) {
			$sub_Arr = array();
			$this->db->select($fld)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			
			//~ if(!empty($wh_in_fld) && empty($wh_in) ){
			//~ $this->db->where_in($wh_in_fld);
			//~ } 
			if (!empty($gp)) {
				$this->db->group_by($gp);
			}
			
			$row = $this->db->get()->result();
			//pr($row);die;	   
			//echo $this->db->last_query();die;
			foreach ($row as $rdata) {
				$expV = explode('/', $rdata->$fld);
				$page = (count($expV) > 2) ? $expV[2] : $expV[1];
				$sub_Arr[] = $page;
			}
			
			return $sub_Arr;
		}
		
		function selectArray($table = false, $fld = '*', $conditions = false, $wh_in_fld = false, $wh_in = false, $gp = false) {
			$sub_Arr = array();
			$this->db->select($fld)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			
			//~ if(!empty($wh_in_fld) && empty($wh_in) ){
			//~ $this->db->where_in($wh_in_fld);
			//~ } 
			if (!empty($gp)) {
				$this->db->group_by($gp);
			}
			
			$row = $this->db->get()->result();
			//pr($row);die;	   
			//echo $this->db->last_query();die;
			foreach ($row as $rdata) {
				
				$sub_Arr[] = $rdata->$fld;
			}
			
			return $sub_Arr;
		}
		
		public function checkPermission($table = false, $fld = '*', $conditions = false, $ord = false, $ordtype = false, $cpage = false) {
			$sn_final = array();
			$this->db->select($fld)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			$drow = $this->db->get()->result();
			
			foreach ($drow as $row) {
				$sn = explode(',', $row->sn_id);
				$sn_final = array_merge($sn_final, $sn);
			}
			if (count($sn_final) > 0) {
				$purl = $this->db->select('page_url')->from('sub_nav')
				->where_in('sn_id', $sn_final)
				->where(array('status' => 1))
				->get()->result();
				} else {
				$purl = "";
			}
			// echo $this->db->last_query();
			$page_array = array();
			foreach ($purl as $pp) {
				$abc = explode('/', $pp->page_url);
				if (count($abc) == 3) {
					$page_array[] = $abc[2];
					} else {
					$page_array[] = $abc[1];
				}
			}
			
			$check = in_array($cpage, $page_array);
			return $check;
		}
		
		function nrows($table = false, $fld = '*', $conditions = false) {
			
			$this->db->select($fld)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions, false, false);
			}
			
			$trow = $this->db->get()->num_rows();
			
			
			//echo $this->db->last_query();die;
			
			return $trow;
		}
		
		function selectNumRow($table = false, $fld = '*', $conditions = false, $whstr_in = false, $wh_or = false) {
			
			$this->db->select($fld)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($whstr_in) {
				$this->db->where($whstr_in);
			}
			if ($wh_or) {
				$this->db->or_where($wh_or);
			}
			$trow = $this->db->get()->num_rows();
			
			
			//echo $this->db->last_query();die;
			
			return $trow;
		}
		
		function recordByQueryString($qry) {
			
			$query = $this->db->query($qry);
			
			return $query->result();
		}
		
		function countRowByQueryString($qry) {
			$query = $this->db->query($qry);
			return $query->num_rows();
		}
		
		function findCentreName($cat, $cid) {
			$wh = array('status' => 1);
			if ($cat == 1 || $cat == 2 || $cat == 3) {
				if ($cat == 1) {
					$tblname = "itvt_ghar_homes";
					$idf = "home_id as center_id";
					$fldName = "concat($tblname.home_name,'/',$tblname.home_code,' (',$tblname.home_for,')') as center_name,$idf";
					if ($cid) {
						$wh['home_id'] = $cid;
					}
					}else if ($cat == 2) {
					$tblname = "itvt_usf_center";
					$idf = "center_id as center_id";
					$fldName = "center_name as center_name,$idf";
					if ($cid) {
						$wh['center_id'] = $cid;
					}
					}else if ($cat == 3) {
					$tblname = "itvt_center_master";
					$idf = "center_id as center_id";
					$fldName = "center_name as center_name,$idf";
					if ($cid) {
						$wh['center_id'] = $cid;
					}
				}
				$cdata = $this->Common->selectRow($tblname, $fldName, $wh);
				$cname = (!empty($cdata) && !empty($cdata->center_name)) ? $cdata->center_name : '';
				}else {
				$cname = '';
			}
			return $cname;
		}
		
		function selectMultiDB($table = false, $fld = '*', $conditions = false, $ord = false, $ordtype = false, $wh_in_fld = false, $wh_in = false, $joinArray = false, $grpby = false, $whstr_in = false, $limit = false) {
			
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($whstr_in) {
				$this->db->where($whstr_in);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			if ($grpby) {
				$this->db->group_by($grpby);
			}
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			if ($limit) {
				$this->db->limit($limit);
			}
			if ($joinArray) {
				
				foreach ($joinArray as $jarray) {
					$this->db->join($jarray['tbl'], $jarray['on'], $jarray['typ']);
				}
			}
			$drow = $this->db->get()->result();
			
			
			//echo $this->db->last_query();die;
			
			return $drow;
		}
		
		function selectMultiDBRow($table = false, $fld = '*', $conditions = false, $wh_in_fld = false, $wh_in = false, $joinArray = false, $grpby = false, $ord = false) {
			
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			if ($grpby) {
				$this->db->group_by($grpby);
			}
			
			if ($joinArray) {
				
				foreach ($joinArray as $jarray) {
					$this->db->join($jarray['tbl'], $jarray['on'], $jarray['typ']);
				}
			}
			if (!empty($ord)) {
				$this->db->order_by($ord, false);
			}
			$drow = $this->db->get()->row();
			
			
			//echo $this->db->last_query();die;
			
			return $drow;
		}
		
		function selectMultiDbFld($table = false, $fld = '*', $conditions = false, $ord = false, $ordtype = false, $wh_in_fld = false, $wh_in = false, $joinArray = false, $grpby = false,$upper_limit=false) {
			
			$this->db->select($fld, false)
			->from($table);
			if ($conditions) {
				$this->db->where($conditions);
			}
			if ($wh_in && $wh_in_fld) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			if ($grpby) {
				echo $this->db->group_by($grpby);
			}
			if ($ord && $ordtype) {
				$this->db->order_by($ord, $ordtype);
			}
			if ($upper_limit) {
				$this->db->limit($upper_limit);
			}
			
			if ($joinArray) {
				foreach ($joinArray as $jarray) {
					$this->db->join($jarray['tbl'], $jarray['on'], $jarray['typ']);
				}
			}
			$fld = $this->db->get()->list_fields();
			foreach ($fld as $fname) {
				$result[] = ucwords(strtolower(str_replace('center', 'centre', (str_replace('_', ' ', (str_replace('1', '', $fname)))))));
			}
			
			//echo $this->db->last_query();die;
			
			return $result;
		}
		
		function selectDatatableRecord($tblmain, $fld, $jnArray = false, $whs = false, $gp = false, $wh_in = false, $ord = false,$having=false,$wh_str=false,$wh_str2=false , $wh_in_fld_name = false, $wh_in_fld_val = false ) {
			
			$this->datatables->select($fld)
			->from($tblmain);
			if ($jnArray) {
				foreach($jnArray as $jarray) {
					$this->datatables->join($jarray['tbl'], $jarray['on'], $jarray['typ']);
				}
			}
			
			if ($wh_in_fld_name && $wh_in_fld_val) {
				
				// echo $wh_in_fld_val; die;
				$this->datatables->where($wh_in_fld_name.' in ('.$wh_in_fld_val.')' , null , false);
				
			}
			
			
			if ($whs) {
				$this->datatables->where($whs);
			}
			if ($gp) {
				
				$this->datatables->group_by($gp);
				
			}
			if ($wh_in) {
				$this->datatables->where($wh_in);
			}
			if ($having) {
				$this->db->having($having);
			}
			if($wh_str)
			{
				$this->db->where($wh_str.' '.'is NOT NULL', NULL, FALSE);   
			}
			if($wh_str2)
			{
				$this->db->where($wh_str2.' '.'is NULL', NULL, TRUE);   
			}
			
			
			
			
			$resultData = $this->datatables->generate();
			// echo $this->db->last_query();die; 
			
			return $resultData;
		}
		
		public function db_in_csv($tblmain, $fld, $joinA = false, $wh = false, $fname = "report", $wh_in_fld = false, $wh_in = false, $gp = false, $ord_fld = false, $ordtype = false) {
			
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			$this->db->select($fld, false)->from($tblmain);
			if ($joinA) {
				foreach ($joinA as $jarray) {
					$this->db->join($jarray['tbl'], $jarray['on'], $jarray['typ']);
				}
			}
			if (!empty($wh)) {
				$this->db->where($wh);
			}
			if (!empty($wh_in) && !empty($wh_in_fld)) {
				$this->db->where_in($wh_in_fld, $wh_in);
			}
			
			if ($gp) {
				$this->db->group_by($gp);
			}
			if ($ord_fld && $ordtype) {
				$this->db->order_by($ord_fld, $ordtype);
			}
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			$delimiter = ",";
			$newline = "\r\n";
			$fileName = $fname . date('dmY') . '.csv';
			$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
			
			force_download($fileName, $data);
		}
		
		public function makePasswd($lval) {
			$passwd = '';
			$s1 = range('A', 'Z');
			$s2 = range('Z', 'A');
			
			for ($i = 1; $i <= $lval; $i++) {
				
				$str2 = rand(0, 9);
				$str3 = rand(2, 9);
				$str = $s1[$i] . $str2 . $s2[$lval] . $str3;
				$c = floor((rand() * strlen($str) + 1) / getrandmax());
				$passwd.= substr($str, $c, 1);
			}
			
			return $passwd;
		}
		
		
		public function get_single_record($table, $condn = '') {
			// $condn must be an associative array
			$this->db->select('*');
			$this->db->from($table);
			if (!empty($condn)) {
				$this->db->where($condn);
			}
			$query = $this->db->get();
			return $query->row();
		}
		//22-jan-18
		public function insert($table,$data)
		{	  if($this->db->insert($table,$data)){
				return true;
			}else{ return false;
			} 
			
		}
		//22-jan-18
		

		function deleteKids($kidId){
         $sql="DELETE FROM `userKid` WHERE `kidId`='".$kidId."'";
       	 $this->db->query($sql);
       	 return true;
        //echo $this->db->last_query();die;
    }
		
		
	}
