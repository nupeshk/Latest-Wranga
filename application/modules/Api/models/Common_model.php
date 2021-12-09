<?php



class Common_model extends CI_Model {



    public function __construct() {

        $this->load->database();

    }



    /**

     * Fetch data from any table based on different conditions

     *

     * @access  public

     * @param   string

     * @param   string

     * @param   array

     * @return  bool

     */


public function query($id){
                  
                $this->db->select(' content.contentId as contentId, 
                                    content.reviewerId,
                                    catagories.name as catagories,
                                    subCatagories.name as subCatagories,
                                    ottType.name as ottType,
                                    wrng_contentType.name as ottcontentType,
                                    wrng_language.lName as language,
                                    platform.name as platform,
                                    wrng_content_video_url.video_url as videoUrl,
                                    content.videoDuration as videoDuration,
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.pgStatus as pgStatus,
                                    content.platformId as platformId,
                                    wrng_shortreview.description as description,
                                    content.releaseYear as releaseYear,
                                    content.editorName as editorName,
                                    content.rating as rating,
                                    content.age as age
                                ');
                $this->db->from('content');
                $this->db->join('catagories', 'catagories.catId = content.catgId');
                $this->db->join('ottType', 'ottType.ottTypeId = content.ottType_Id','left');
                $this->db->join('wrng_contentType', 'wrng_contentType.id = content.ottcontentTypeId','left');
                $this->db->join('wrng_language', 'wrng_language.lId = content.languageId','left');
                $this->db->join('wrng_content_video_url', 'wrng_content_video_url.contentId = content.contentId','left');
                $this->db->join('platform', 'platform.pId = content.platformId','left');
                $this->db->join('subCatagories', 'subCatagories.subId = content.sub_catgId','left');
                $this->db->join('wrng_shortreview', 'wrng_shortreview.contentId = content.contentId','left');

                

                $this->db->where('content.contentId', $id); 
                $result = $this->db->get()->result();
                    return $result;
        }

        public function myList($id){
                  
                $this->db->select(' wrng_notification.id as id,
                                    content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.description as description,
                                    wrng_notification.status as status,
                                    wrng_notification.created_at as created_at
                                    ');
                $this->db->from('content');
                $this->db->join('wrng_notification', 'wrng_notification.contentId = content.contentId');
                $this->db->where('wrng_notification.userId', $id); 
                $result = $this->db->get()->result();
                    return $result;
        }

        public function myListAll($id){
                  
                $this->db->select(' wrng_myList.id as id,
                                    content.contentId as contentId, 
                                    content.thumbnailImage as thumbnailImage,
                                    content.title as title,
                                    content.description as description,
                                    wrng_myList.status as status,
                                    wrng_myList.created_at as created_at
                                    ');
                $this->db->from('content');
                $this->db->join('wrng_myList', 'wrng_myList.contentId = content.contentId');
                $this->db->where('wrng_myList.userId', $id); 
                $result = $this->db->get()->result();
                    return $result;
        }


        


        public function moralBoardQuery($id){  
                $this->db->select('wrng_ratingCalCategory.name,moralBoard.ratning,moralBoard.desc,wrng_ratingCalCategory.colorCode');
                $this->db->from('moralBoard');
                $this->db->join('wrng_ratingCalCategory', 'wrng_ratingCalCategory.id = moralBoard.reatingCalCategoryId');
                $this->db->where('moralBoard.contentId', $id); 
                $result = $this->db->get()->result();
                    return $result;
        }

        public function getContentSubCategoryId($contentId){
                $this->db->select('sub_catgId');
                $this->db->from('content');
                $this->db->where('contentId', $contentId); 
                $result = $this->db->get()->result();
                    return $result[0]->sub_catgId;
        }


        public function getContentCategoryId($contentId){
                $this->db->select('catgId');
                $this->db->from('content');
                $this->db->where('contentId', $contentId); 
                $result = $this->db->get()->result();
                    return $result[0]->catgId;
        }



        function selectDataCheckList($table = false, $fld = '*', $conditions = false, $or_where = false, $ord = false, $ordtype = false, $grpby = false, $whstr_in = false, $lmt = false) {          
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
              if($drow){
                return true;
              }else{
                return false;
              }      
                
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

            if($where_not_in){
                $this->db->where_not_in('contentId', $where_not_in);
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



        function selectNumRowTrue($table = false, $fld = '*', $conditions = false, $whstr_in = false, $wh_or = false) { 
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
            if($trow){
                return true;
            }else{
                return false;
            }
            

        }

        



    public function fetch_data1($table, $fields = '*', $conditions = array(), $returnRow = false) {
        //Preparing query
        $this->db->select($fields, false);
        $this->db->select('id,CONCAT("http://yogeshgaur.in/hisabpe/public/transaction/", image) AS image', FALSE);
        $this->db->from($table);
        $this->db->where($conditions);
        //$this->db->order_by("emp_name", "desc");
       $menu = $this->db->get()->result();
            //echo $this->db->last_query();die;
        //Return      
        if($menu){
            return  $menu;
        }else{
            return array();
        }
    }


    public function fetch_data($table, $fields = '*', $conditions = array(), $returnRow = false,$lmt1= false,$lmt2= false,$ord = false, $ordtype = false) {
        //Preparing query
        $this->db->select($fields, false);
        $this->db->from($table);
        $this->db->where($conditions);
        if($lmt2){
              $this->db->limit($lmt1,$lmt2);  
        }

        if ($lmt1) {
            $this->db->limit($lmt1);
        }


        if ($ord && $ordtype) {
                $this->db->order_by($ord, $ordtype);
        }



        //$this->db->order_by("emp_name", "desc");
       $menu = $this->db->get()->result();
       #echo $this->db->last_query();die;
        //Return      
        if($menu){
            return  $menu;
        }else{
            return false;
        }
    }


        public function likeSearch($table,$fields,$column,$keyword,$lmt1= false,$lmt2= false,$where) {
            $this->db->select($fields, false);
            $this->db->from($table);
            if($where){
                 //$this->db->where($where);
                 $this->db->where('sub_catgId',$where);

            }

            $this->db->like($column, $keyword);
           // $this->db->like($column, $keyword, 'both');
            
            if($lmt2){
              $this->db->limit($lmt1,$lmt2);  
            }

            if ($lmt1) {
                $this->db->limit($lmt1);
            }
              //echo $this->db->last_query();die;
            return $this->db->get()->result_array();
        }    


    
    public function fetch_data_desc($table, $fields = '*', $conditions = array(), $returnRow = false) {
        //Preparing query
        $this->db->select($fields, false);
        $this->db->from($table);
        $this->db->where($conditions);
        $this->db->order_by("id","DESC");
       $menu = $this->db->get()->result();
            //echo $this->db->last_query();die;
        //Return      
        if($menu){
            return  $menu;
        }else{
            return false;
        }
    }




    /**

     * Count all records

     *

     * @access  public

     * @param   string

     * @return  array

     */

    public function fetch_count($table, $conditions = array()) {

        $this->db->from($table);

        //If there are conditions

        if (count($conditions) > 0) {

            $this->where($conditions);

        }

        return $this->db->count_all_results();

    }



    /**

     * Insert data in DB

     *

     * @access  public

     * @param   string

     * @param   array

     * @param   string

     * @return  string

     */

    public function insert_single($table, $data = array()) {

        //Check if any data to insert

        if (count($data) < 1) {

            return false;

        }



        $this->db->insert($table, $data);

        return $this->db->insert_id();

    }





        public function insert_createGroup($table, $data = array()) {

        //Check if any data to insert

        if (count($data) < 1) {

            return false;

        }



        $this->db->insert($table, $data);

        return $this->db->insert_id();

    }







    /**

     * Insert batch data

     *

     * @access  public

     * @param   string

     * @param   array

     * @param   array

     * @param   bool

     * @return  bool

     */

    public function insert_batch($table, $defaultArray, $dynamicArray = array(), $updatedTime = false) {

        //Check if default array has values

        if (count($dynamicArray) < 1) {

            return false;

        }



        //If updatedTime is true

        if ($updatedTime) {

            $defaultArray['UpdatedTime'] = time();

        }



        //Iterate it

        if (count($defaultArray) > 0) {

            foreach ($dynamicArray as $val) {

                $updates[] = array_merge($defaultArray, $val);

            }

        } else {

            $updates = $dynamicArray;

        }

        $this->db->insert_batch($table, $updates);

    }



    /**

     * Update details in DB

     *

     * @access  public

     * @param   string

     * @param   array

     * @param   array

     * @return  string

     */

    public function update_single($table, $updates, $conditions = array()) {

        //If there are conditions

        

        /*if (count($conditions) > 0) {

            $this->condition_handler($conditions);

        }

        return $this->db->update($table, $updates);*/

        $this->db->where($conditions);

        $this->db->update($table, $updates);

        /*print_r($this->db->last_query());

        die;*/

        return true;







    }





     public function updateAll($tbl,$data,$where) {

        try {

            $this->db->where($where);

            $update = $this->db->update($tbl, $data);

            if ($update) {

                return true;

            } else {

                return false;

            }

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }





    /**

     * Update Batch

     *

     * @access  public

     * @param   string

     * @param   array

     * @return  boolean

     */

    public function update_batch_data($table, $defaultArray, $dynamicArray = array(), $key) {

        //Check if any data

        if (count($dynamicArray) < 1) {

            return false;

        }



        //Prepare data for insertion

        foreach ($dynamicArray as $val) {

            $data[] = array_merge($defaultArray, $val);

        }

        return $this->db->update_batch($table, $data, $key);

    }



    /**

     * Delete data from DB

     *

     * @access  public

     * @param   string

     * @param   array

     * @param   string

     * @return  string

     */

    public function delete_data($table, $conditions = array()) {

        //If there are conditions

        if (count($conditions) > 0) {

            $this->condition_handler($conditions);

        }

        return $this->db->delete($table);

    }

    public function deleterecords($id)
    {
        $this->db->query("delete  from imageTransaction where id='".$id."'");
        return true;
    }



        public function deleteMyList($contentId,$userId){
        $this->db->query("delete  from wrng_myList where contentId='".$contentId."' and userId='".$userId."'");
        return true;
    }


    public function delete($table,$id)
    {   $this->db->delete($table, array('id' => $id));
        return true;
    }




    /**

     * Handle different conditions of query

     *

     * @access  public

     * @param   array

     * @return  bool

     */

    public function condition_handler($conditions) {

        //Where

        if (array_key_exists('where', $conditions)) {



            //Iterate all where's

            foreach ($conditions['where'] as $key => $val) {

                $this->db->where($key, $val);

            }

        }



        //Or Where

        if (array_key_exists('or_where', $conditions)) {



            //Iterate all where's

            foreach ($conditions['or_where'] as $key => $val) {

                $this->db->or_where($key, $val);

            }

        }



        //Where In

        if (array_key_exists('where_in', $conditions)) {



            //Iterate all where in's

            foreach ($conditions['where_in'] as $key => $val) {

                $this->db->where_in($key, $val);

            }

        }



        //Where Not In

        if (array_key_exists('where_not_in', $conditions)) {



            //Iterate all where in's

            foreach ($conditions['where_not_in'] as $key => $val) {

                $this->db->where_not_in($key, $val);

            }

        }



        //Having

        if (array_key_exists('having', $conditions)) {

            foreach ($conditions['having'] as $key => $val) {

                $this->db->having($key, $val);

            }

        }



        //Group By

        if (array_key_exists('group_by', $conditions)) {

            $this->db->group_by($conditions['group_by']);

        }



        //Order By

        if (array_key_exists('order_by', $conditions)) {

            //Iterate all order by's

            //print_r($conditions['order_by']); die;

            foreach ($conditions['order_by'] as $key => $val) {

                $this->db->order_by($key, $val);

            }

        }



        //Order By

        if (array_key_exists('like', $conditions)) {



            //Iterate all likes

            foreach ($conditions['like'] as $key => $val) {

                $this->db->like($key, $val); //, 'after'

            }

        }



        //Limit

        if (array_key_exists('limit', $conditions)) {



            //If offset is there too?

            if (count($conditions['limit']) == 1) {

                $this->db->limit($conditions['limit'][0]);

            } else {

                $this->db->limit($conditions['limit'][0], $conditions['limit'][1]);

            }

        }



        //Group Start (For and or conditions)

        if (array_key_exists('group_start', $conditions)) {

            $this->db->group_start();



            //Iterate all conditions

            $i = 0;

            foreach ($conditions['group_start'] as $key => $val) {

                if ($i == 0) {

                    $this->db->where($key, $val);

                } else {

                    $this->db->or_where($key, $val);

                }

                $i++;

            }

            $this->db->group_end();

        }

    }



    /**

     * Log error in DB

     *

     * @access  public

     * @param   array

     * @param   string

     */

    public function error_log_in_db($logData = array(), $message, $admin = true) {

        $insertData = array(

            'message' => $message,

            'data' => json_encode($logData),

            'type' => (string) ($admin ? 1 : 0),

            'loggedTime' => time(),

        );

        return $this->insert_single('error_logs', $insertData);

    }

    function deleteKids($userId){
         $sql="DELETE FROM `userKid` WHERE `userId`='".$userId."'";
         $this->db->query($sql);
         return true;
        //echo $this->db->last_query();die;
    }

}

