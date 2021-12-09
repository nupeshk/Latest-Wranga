<?php

if (!defined('BASEPATH')) {
exit('No direct script access allowed');
}

class Common extends CI_Model 
{
	function nrows($table = false, $fld = '*', $conditions = false) 
	{
		$this->db->select($fld)
		->from($table);
		if ($conditions) {
			$this->db->where($conditions, false, false);
		}
		$trow = $this->db->get()->num_rows();
		//echo $this->db->last_query();die;
		return $trow;
	}


	function selectData($table = false, $fld = '*', $conditions = false, $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false,$where_not_in= false) {
			
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

            if ($where_not_in) {
               $this->db->where_not_in('subId', $where_not_in);
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

    
        function selectData2($table = false, $fld = '*', $conditions = false, $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false,$where_not_in= false) {
			
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

            if ($where_not_in) {
               $this->db->where_not_in('subId', $where_not_in);
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
			
			 echo $this->db->last_query(); die;
			return $drow;
		}



		    /**
     * Insert data in DB
     *
     * @param	string
     * @param	array
     * @return	string
     */
    public function insert($tbl,$data = array()) {
        //Check if any data to insert
        if (count($data) < 1) {
            return false;
        }
        $this->db->insert($tbl, $data);
         #echo $this->db->last_query();die;
        return $this->db->insert_id();
    }


    public function insert3($tbl,$data = array()) {
        //Check if any data to insert
        if (count($data) < 1) {
            return false;
        }
        $this->db->insert($tbl, $data);
         echo $this->db->last_query();die;
        return $this->db->insert_id();
    }




    	public function update($table, $updates, $conditions = array()){
		try {
            $this->db->where($conditions);
            $update = $this->db->update($table, $updates);

             //echo $this->db->last_query();die;


            if ($update) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
	}

		function deleteDb($table,$where = false) {
			if($where){
	  			$this->db->where($where , NULL, false);
	  		}
	   	    $this->db->delete($table);
		    //echo $this->db->last_query();die;
	        return $this->db->affected_rows();  
	}  


    function deleteOther($contentId){
        $sql="DELETE FROM `wrng_contentthematicrating` WHERE `contentId`='".$contentId."'";
       $this->db->query($sql);
       //echo $this->db->last_query();die;
   }

   function deleteAge($contentId){
    $sql="DELETE FROM `wrng_age_group` WHERE `contentId`='".$contentId."'";
   $this->db->query($sql);
   //echo $this->db->last_query();die;
}


    function deleteThemetic($contentId,$ratingCalCategoryId){
         $sql="DELETE FROM `wrng_contentthematicrating` WHERE `contentId`='".$contentId."' AND `ratingCalCategoryId`='".$ratingCalCategoryId."'";
        $this->db->query($sql);
        //echo $this->db->last_query();die;
    }


    function deleteOccurrence($contentId,$ratingCalCategoryId){
         $sql="DELETE FROM `wrng_contentoccurrencerating` WHERE `contentId`='".$contentId."' AND `ratingCalCategoryId`='".$ratingCalCategoryId."'";
        $this->db->query($sql);
        //echo $this->db->last_query();die;
    }


        function deleteProhobitive($contentId,$ratingCalCategoryId){
         $sql="DELETE FROM `wrng_prohobitiveCategory` WHERE `contentId`='".$contentId."' AND `ratingCalCategoryId`='".$ratingCalCategoryId."'";
        $this->db->query($sql);
        //echo $this->db->last_query();die;
    }


     function deletemoralBoard($contentId,$ratingCalCategoryId){
         $sql="DELETE FROM `moralBoard` WHERE `contentId`='".$contentId."' AND `reatingCalCategoryId`='".$ratingCalCategoryId."'";
        $this->db->query($sql);
        //echo $this->db->last_query();die;
    }

	public function query($id,$userType){                  
                $this->db->select(' content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.rating as rating,
                                    content.reviewerId as reviewerId,
                                    contentStatus.name as status,
                                    contentStatus.id as statusId,
                                    content.createdat as createdat
                                ');
                $this->db->from('content');
      /*          $this->db->join('catagories', 'catagories.catId = content.catgId');
                $this->db->join('ottType', 'ottType.ottTypeId = content.ottType_Id','left');
                $this->db->join('wrng_contentType', 'wrng_contentType.id = content.ottcontentTypeId','left');
                $this->db->join('wrng_language', 'wrng_language.lId = content.languageId','left');
                $this->db->join('platform', 'platform.pId = content.platformId','left');
                $this->db->join('subCatagories', 'subCatagories.subId = content.sub_catgId','left');*/
                $this->db->join('contentStatus', 'contentStatus.id = content.status','left');
	
                if($userType==4){
                    $this->db->where('content.reviewerId', $id);                     
                }elseif ($userType==3) {
                     $arr =getReviewArr($id);
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);                     
                   }  


                }elseif ($userType==2) {
                    
                    $arrr =getReviewArr($id);  // Tema Leader Array
                    $arr=getAllReviewThrougTramLeaderArr($arrr);       
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);
                   }  


                }

                $this->db->order_by("createdat","desc");
                 $this->db->where('content.catgId',1);
                $result = $this->db->get()->result();
                 //echo $this->db->last_query();die;
                    return $result;
        }
        	public function queryApply($filter,$reviewerId,$userType){                  
                $this->db->select(' content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.rating as rating,
                                    content.reviewerId as reviewerId,
                                    contentStatus.name as status,
                                    contentStatus.id as statusId,
                                    content.createdat as createdat
                                ');
                $this->db->from('content');
      /*          $this->db->join('catagories', 'catagories.catId = content.catgId');
                $this->db->join('ottType', 'ottType.ottTypeId = content.ottType_Id','left');
                $this->db->join('wrng_contentType', 'wrng_contentType.id = content.ottcontentTypeId','left');
                $this->db->join('wrng_language', 'wrng_language.lId = content.languageId','left');
                $this->db->join('platform', 'platform.pId = content.platformId','left');
                $this->db->join('subCatagories', 'subCatagories.subId = content.sub_catgId','left');*/
                $this->db->join('contentStatus', 'contentStatus.id = content.status','left');
	           $this->db->where_in('content.status',  $filter); 
               if($userType!=1){
                $this->db->where('content.reviewerId', $reviewerId); 
               } 
                $this->db->order_by("createdat","desc");
                $result = $this->db->get()->result();
                #echo $this->db->last_query();die;
                    return $result;
        }

        public function queryApplySearch($search,$reviewerId,$userType){                  
                $this->db->select(' content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.rating as rating,
                                    content.reviewerId as reviewerId,
                                    contentStatus.name as status,
                                    contentStatus.id as statusId,
                                    content.createdat as createdat
                                ');
                $this->db->from('content');
                $this->db->join('contentStatus', 'contentStatus.id = content.status','left');
               $this->db->like('content.title',  $search); 
              /* if($userType!=1){
                $this->db->where('content.reviewerId', $reviewerId); 
               } */
                $this->db->order_by("createdat","desc");
                $result = $this->db->get()->result();
                    return $result;
        }


        /*
        * Query for Games
        */
            public function queryGames($id,$userType){                  
                $this->db->select(' content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.rating as rating,
                                    content.reviewerId as reviewerId,
                                    contentStatus.name as status,
                                    contentStatus.id as statusId,
                                    content.createdat as createdat
                                ');
                $this->db->from('content');
      /*          $this->db->join('catagories', 'catagories.catId = content.catgId');
                $this->db->join('ottType', 'ottType.ottTypeId = content.ottType_Id','left');
                $this->db->join('wrng_contentType', 'wrng_contentType.id = content.ottcontentTypeId','left');
                $this->db->join('wrng_language', 'wrng_language.lId = content.languageId','left');
                $this->db->join('platform', 'platform.pId = content.platformId','left');
                $this->db->join('subCatagories', 'subCatagories.subId = content.sub_catgId','left');*/
                $this->db->join('contentStatus', 'contentStatus.id = content.status','left');
    
                if($userType==4){
                    $this->db->where('content.reviewerId', $id);                     
                }elseif ($userType==3) {
                     $arr =getReviewArr($id);
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);                     
                   }  
                }elseif ($userType==2) {
                    $arrr =getReviewArr($id);  // Tema Leader Array
                    $arr=getAllReviewThrougTramLeaderArr($arrr);       
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);
                   }
                }
                 $this->db->where('content.catgId',2);
                $this->db->order_by("createdat","desc");
                $result = $this->db->get()->result();
                #echo $this->db->last_query();die;
                return $result;
        }

        /*
        * Query for App
        */
            public function queryApp($id,$userType){                  
                $this->db->select(' content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.rating as rating,
                                    content.reviewerId as reviewerId,
                                    contentStatus.name as status,
                                    contentStatus.id as statusId,
                                    content.createdat as createdat
                                ');
                $this->db->from('content');
      /*          $this->db->join('catagories', 'catagories.catId = content.catgId');
                $this->db->join('ottType', 'ottType.ottTypeId = content.ottType_Id','left');
                $this->db->join('wrng_contentType', 'wrng_contentType.id = content.ottcontentTypeId','left');
                $this->db->join('wrng_language', 'wrng_language.lId = content.languageId','left');
                $this->db->join('platform', 'platform.pId = content.platformId','left');
                $this->db->join('subCatagories', 'subCatagories.subId = content.sub_catgId','left');*/
                $this->db->join('contentStatus', 'contentStatus.id = content.status','left');
    
                if($userType==4){
                    $this->db->where('content.reviewerId', $id);                     
                }elseif ($userType==3) {
                     $arr =getReviewArr($id);
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);                     
                   }  
                }elseif ($userType==2) {
                    $arrr =getReviewArr($id);  // Tema Leader Array
                    $arr=getAllReviewThrougTramLeaderArr($arrr);       
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);
                   }
                }
                 $this->db->where('content.catgId',3);
                $this->db->order_by("createdat","desc");
                $result = $this->db->get()->result();
                #echo $this->db->last_query();die;
                return $result;
        }

        /*
        * Query for Book
        */
            public function queryBook($id,$userType){                  
                $this->db->select(' content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.rating as rating,
                                    content.reviewerId as reviewerId,
                                    contentStatus.name as status,
                                    contentStatus.id as statusId,
                                    content.createdat as createdat
                                ');
                $this->db->from('content');
      /*          $this->db->join('catagories', 'catagories.catId = content.catgId');
                $this->db->join('ottType', 'ottType.ottTypeId = content.ottType_Id','left');
                $this->db->join('wrng_contentType', 'wrng_contentType.id = content.ottcontentTypeId','left');
                $this->db->join('wrng_language', 'wrng_language.lId = content.languageId','left');
                $this->db->join('platform', 'platform.pId = content.platformId','left');
                $this->db->join('subCatagories', 'subCatagories.subId = content.sub_catgId','left');*/
                $this->db->join('contentStatus', 'contentStatus.id = content.status','left');
    
                if($userType==4){
                    $this->db->where('content.reviewerId', $id);                     
                }elseif ($userType==3) {
                     $arr =getReviewArr($id);
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);                     
                   }  
                }elseif ($userType==2) {
                    $arrr =getReviewArr($id);  // Tema Leader Array
                    $arr=getAllReviewThrougTramLeaderArr($arrr);       
                     $where_in=getTeamReviewArr($arr,$id);
                   if($where_in){
                        $this->db->where_in('content.reviewerId', $where_in);
                   }
                }
                 $this->db->where('content.catgId',4);
                $this->db->order_by("createdat","desc");
                $result = $this->db->get()->result();
                #echo $this->db->last_query();die;
                return $result;
        }



   public function update_single($table, $updates, $conditions = array()) {
        $this->db->where($conditions);
        $this->db->update($table, $updates);
        return true;
    }

    public function totalRateing($contentId,$ratingCalCategoryId) {
        $query = $this->db->query("select sum(ratingScore) as total from wrng_contentoccurrencerating where contentId='".$contentId."' AND ratingCalCategoryId='".$ratingCalCategoryId."'");
        $result = $query->result();
        return number_format($result[0]->total,2); 
    } 



    public function moralBoardRating($contentId,$ratingCalCategoryId) {
        $query = $this->db->query("select ratningScore from moralBoard where contentId='".$contentId."' AND reatingCalCategoryId='".$ratingCalCategoryId."'");
        $result = $query->result();
        return $result[0]->ratningScore; 
    } 

    public function videoDurationValue($contentId) {
        $query = $this->db->query("select videoDuration from content where contentId='".$contentId."'");
        $result = $query->result();
        return $result[0]->videoDuration; 
    } 


    public function mildMultiplierValue($id) {
        $query = $this->db->query("select mildMultiplier from wrng_reatingCalSubCategory where id='".$id."'");
        $result = $query->result();
        return $result[0]->mildMultiplier; 
    } 

    public function extremeMultiplierValue($id) {
        $query = $this->db->query("select extremeMultiplier from wrng_reatingCalSubCategory where id='".$id."'");
        $result = $query->result();
        return $result[0]->extremeMultiplier; 
    }


    

    /*public function prohobitiveValue($contentId,$ratingCalSubCategoryId) {
        $query = $this->db->query("select * from wrng_prohobitiveCategory where contentId='".$contentId."' AND ratingCalSubCategoryId='".$ratingCalSubCategoryId."' ");
        $result = $query->result();
        return $result[0]->extremeMultiplier; 
    }
*/



    //SELECT count(*) as total from moralBoard WHERE `reatingCalCategoryId` IN (1,2,3,4,5,6,7,8,9,10,11) and `contentId`='38'


     public function conutTotalValue($contentId){	
		$in='1,2,3,4,5,6,7,8,9,10,11';
		$condition = "SELECT count(*) as total from moralBoard WHERE `reatingCalCategoryId` IN (".$in.") and `contentId`='".$contentId."'";
		$query=$this->db->query($condition);
		$result= $query->result();
		//echo $this->db->last_query(); die;
		if ($result[0]->total ==11) {
			return 1;	
		}else{
			return 0;
		}
	}



	public function genralInfoValidation($contentId){	
	
		$condition = "SELECT count(*) as total FROM content INNER JOIN wrng_contentGenre ON content.contentId = wrng_contentGenre.contentId INNER JOIN content_image ON content.contentId = content_image.contentId WHERE content.contentId='".$contentId."'";
		$query=$this->db->query($condition);
		$result= $query->result();
		//echo $this->db->last_query(); die;
		if ($result[0]->total > 1) {
			return true;	
		}else{
			return false;
		}
	}




	



	
}
