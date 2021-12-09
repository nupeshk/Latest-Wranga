<?php
         if ( ! defined('BASEPATH')) exit('No direct script access allowed');

            if ( ! function_exists('category')){
                    function category(){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_category"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
							 foreach($rows as $row){?>
								       <li class="wsshopmyaccount clearfix"><a href="<?=PATH_URL?>category/<?=$row->id?>"><?=$row->name?></a></li>
           
								 <?php 
							 }
                       }
            }
			
			


if (!function_exists('userName')){
    function userName($userId){
       $ci=& get_instance();
        $ci->load->database(); 
        $sql = "select * from users where userId='$userId'"; 
        $query = $ci->db->query($sql);
        $rows = $query->result();
        return $rows[0]->name;
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




			
			if (!function_exists('category_option')){
                    function category_option($limit1,$limit2){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from tbl_news limit $limit1,$limit2"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
							 foreach($rows as $row){
								 ?>
								 <option value="<?=$row->id?>"><?=$row->title?></option>
								 <?php 
							 }
                       }
            }
			





      if (!function_exists('mfg_sub_category')){
                    function mfg_sub_category($parentId){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_sub_category where categoryId='$parentId'"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                        foreach ($rows as $row) {?>
                             <input type="checkbox" name="category" value="<?=$row->id?>" class="fillchk">
                              <label><?=$row->subcategoryName?></label>

                      <?php   } 
            }
      }



       if (!function_exists('supplierList')){
                    function supplierList($supplierId){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_suppliers where id='$supplierId'"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                        $sn=1;
                        foreach ($rows as $row) {
                            //print_r($row);
                          ?>
                            <tr>
                            <td><?=$sn?></td>
                            <td><?=$row->name?></td>
                            <td><?=$row->state?></td>
                            <td><?=$row->city?></td>
                            <td><?=$row->created_at?></td>

<td><a href="<?=PATH_URL?>customer/chat/<?=$row->id?>"><img src="<?=BASEURL?>/assets/assets-dashboard/images/chat.png"></a></td>
                            </tr>

                      <?php   $sn++;} 
            }
      }

      
             if (!function_exists('supplierName')){
                    function supplierName($supplierId){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_suppliers where id='$supplierId'"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                        echo $rows[0]->name;
              }
            }


            if (!function_exists('customerName')){
                    function customerName($supplierId){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_customers where id='$supplierId'"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                        echo $rows[0]->name;
              }
            }



            if (!function_exists('certificationsName')){
                    function certificationsName($supplierId){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_certifications where name='$supplierId'"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                        echo $rows[0]->banner;
              }
            }





            if (!function_exists('customersName')){
                    function customersName($supplierId){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_customers where id='$supplierId'"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                        echo $rows[0]->name;
              }
            }

            



           if (!function_exists('commentProfilePic')){
                    function commentProfilePic($id){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select banner from mfg_customers where id='$id'"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                        $rows[0]->banner;
              }
            }





            if (!function_exists('chatList')){
                    function chatList($supplierId){
                       $ci=& get_instance();
                        $ci->load->database(); 
                        $sql = "select * from mfg_customerChat where supplierId='$supplierId' ORDER BY `mfg_customerChat`.`id` DESC"; 
                        $query = $ci->db->query($sql);
                        $rows = $query->result();
                            $sn=1;
                          ?>       
                    <td class="clr-green"><?=$rows[0]->createdat?></td>
                    <td class="clr-green"><?=$rows[0]->chats?></td>
                      
                      <?php   $sn++; 
                           }
      }   
?>