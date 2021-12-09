<?php
         if ( ! defined('BASEPATH')) exit('No direct script access allowed');

       if (!function_exists('valueAllAtributs')){
            function valueAllAtributs($table,$contentId,$ratingCalCategoryId,$ratingCalSubCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                 $sql = "SELECT * FROM $table where contentId='$contentId' AND ratingCalCategoryId='$ratingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->ranges;   


          }
      } 

      if (!function_exists('getvalueAllAtributs')){
        function getvalueAllAtributs($table,$contentId,$ratingCalCategoryId,$ratingCalSubCategoryId){
           $ci=& get_instance();
            $ci->load->database(); 
           $sql = "SELECT * FROM $table where contentId='$contentId' AND ratingCalCategoryId='$ratingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
            $query = $ci->db->query($sql);
            $rows = $query->result();
             // print_r($rows);
             return $rows[0]->value;   


      }
  } 

  if (!function_exists('getAgeValue')){
    function getAgeValue($contentId){
       $ci=& get_instance();
        $ci->load->database(); 
       $sql = "SELECT age FROM content where contentId='$contentId'"; 
        $query = $ci->db->query($sql);
        $rows = $query->result();
         // print_r($rows);
         return $rows[0]->age;   


  }
}

  
      if (!function_exists('valueAllAtributsOccurrenceMild()')){
            function valueAllAtributsOccurrenceMild($table,$contentId,$ratingCalCategoryId,$ratingCalSubCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                 $sql = "SELECT * FROM $table where contentId='$contentId' AND ratingCalCategoryId='$ratingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->mild;   
          }
      }

      if(!function_exists('PublisherName()')){
        function PublisherName($userId){
            $ci=& get_instance();
                $ci->load->database(); 
                 $sql = "SELECT * FROM cms_admin where id='$userId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                if($rows){
                  return $rows[0]->name;
                }else{
                  return "N/A";
                } 
                    

        }
      } 


        if (!function_exists('valueAllAtributsOccurrenceExtreme()')){
            function valueAllAtributsOccurrenceExtreme($table,$contentId,$ratingCalCategoryId,$ratingCalSubCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                 $sql = "SELECT * FROM $table where contentId='$contentId' AND ratingCalCategoryId='$ratingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->extreme;   


          }
      } 


      if (!function_exists('mildTime()')){
            function mildTime($table,$contentId,$ratingCalCategoryId,$ratingCalSubCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                 $sql = "SELECT * FROM $table where contentId='$contentId' AND ratingCalCategoryId='$ratingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 return $rows[0]->mildTimeStamp;   
          }
      } 

      if (!function_exists('extremeTime()')){
            function extremeTime($table,$contentId,$ratingCalCategoryId,$ratingCalSubCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                 $sql = "SELECT * FROM $table where contentId='$contentId' AND ratingCalCategoryId='$ratingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->extremeTimeStamp;
          }
      } 



      if (!function_exists('prohobitive()')){
            function prohobitive($contentId,$ratingCalCategoryId,$ratingCalSubCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                 $sql = "SELECT * FROM wrng_prohobitiveCategory where contentId='$contentId' AND ratingCalCategoryId='$ratingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->timeStamp;
          }
      } 




 if (!function_exists('descMoralbord()')){
            function descMoralbord($contentId,$reatingCalCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                $sql = "SELECT * FROM moralBoard where contentId='$contentId' AND reatingCalCategoryId='$reatingCalCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->desc;   
          }
      } 



      


       if (!function_exists('prohibitiveValue()')){
            function prohibitiveValue($contentId,$reatingCalCategoryId,$ratingCalSubCategoryId){
               $ci=& get_instance();
                $ci->load->database(); 
                $sql = "SELECT * FROM wrng_prohobitiveCategory where contentId='$contentId' AND ratingCalCategoryId='$reatingCalCategoryId' AND ratingCalSubCategoryId='$ratingCalSubCategoryId'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->ratingScore;   
          }
      }

      if (!function_exists('wrng_ratingCalCategoryColor()')){
            function wrng_ratingCalCategoryColor($id){
               $ci=& get_instance();
                $ci->load->database(); 
                $sql = "SELECT * FROM wrng_ratingCalCategory where id='$id'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                 // print_r($rows);
                 return $rows[0]->colorCode;   
          }
      }

       
       if (!function_exists('getUserId()')){
            function getUserId($email){
               $ci=& get_instance();
                $ci->load->database(); 
                $sql = "SELECT * FROM users where email='$email'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                  /*print_r($rows);
                die;*/
                if($rows[0]->userId){
                 return $rows[0]->userId;   
                }else{
                  return 0;
                }
          }
      }


      if (!function_exists('getReviewArr()')){
            function getReviewArr($id){
                $name=array();
                $ci=& get_instance();
                $ci->load->database(); 
                $sql = "SELECT `id` FROM `cms_admin` WHERE `parent_type`='$id'"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                foreach ($rows as $key => $value) {
                  $name[]=$value->id;
                 } 
                     return $name;
          }
      }



      if (!function_exists('getAllReviewThrougTramLeaderArr()')){
            function getAllReviewThrougTramLeaderArr($arr){
                /*$name=array();
                $ci=& get_instance();
                $ci->load->database(); 
                $arrr = implode(",", $arr);
               echo $sql = "SELECT `id` FROM `cms_admin` WHERE `parent_type` IN ($arrr)"; 
                $query = $ci->db->query($sql);
                $rows = $query->result();
                foreach ($rows as $key => $value) {
                  $name[]=$value->id;
                 } 
                 return array_merge($arr,$name);*/
      }
}





      if (!function_exists('getTeamReviewArr()')){
            function getTeamReviewArr($arr,$id){
                $name=array();
                $ci=& get_instance();
                $ci->load->database(); 
                array_push($arr,$id);
                return $arr;
          }
      }

      
      if (!function_exists('paymentPlanTitle')){
    function paymentPlanTitle($planId){
       $ci=& get_instance();
        $ci->load->database(); 
        $sql = "select planName from wrng_paymentPlan where paymentPlanId='$planId'"; 
        $query = $ci->db->query($sql);
        $rows = $query->result();
        return $rows[0]->planName;
         }
}


if (!function_exists('getCatagoriesName')){
  function getCatagoriesName($catId){
     $ci=& get_instance();
      $ci->load->database(); 
     $sql = "SELECT `name` FROM catagories where catId='$catId'"; 
      $query = $ci->db->query($sql);
      $rows = $query->result();
       // print_r($rows);
       return $rows[0]->name;   
  }
}

function delete_directory($dirname) {

  if (is_dir($dirname))
    $dir_handle = opendir($dirname);

    if (!$dir_handle)
      return false;
          while($file = readdir($dir_handle)) {
              if ($file != "." && $file != "..") {
                  if (!is_dir($dirname."/".$file))
                        unlink($dirname."/".$file);
                  else
                        delete_directory($dirname.'/'.$file);
              }
          }

          closedir($dir_handle);
    rmdir($dirname);
    return true;
}



?>