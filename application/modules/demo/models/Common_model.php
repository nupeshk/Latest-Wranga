<?php
class Common_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	
	/**
	 * Fetch data from any table based on different conditions
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	bool
	 */
	public function fetch_data( $table, $fields = '*', $conditions = array(), $returnRow = false )
	{
		//Preparing query
		$this->db->select($fields);
		$this->db->from($table);
		
		//If there are conditions
		if (count($conditions) > 0) {
			$this->condition_handler($conditions);
		}
                
		$query = $this->db->get();
                //echo $this->db->last_query();die;
		
		//Return
		return $returnRow ? $query->row_array() : $query->result_array();
	}


	/**
	 * Count all records
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	public function fetch_count($table, $conditions = array())
	{
		$this->db->from($table);
		//If there are conditions
		if (count($conditions) > 0) {
			$this->condition_handler($conditions);
		}
		return $this->db->count_all_results();
    }


	/**
	 * Insert data in DB
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
	public function insert_single($table, $data = array())
	{
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
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	array
	 * @param	bool
	 * @return	bool
	 */
	public function insert_batch($table, $defaultArray, $dynamicArray = array(), $updatedTime = false)
	{
		//Check if default array has values
		if (count($dynamicArray) < 1) {
			return false;
		}
		
		//If updatedTime is true
		if ($updatedTime) {
			$defaultArray['UpdatedTime'] = time();
		}
		
		//Iterate it
		if (count ($defaultArray) > 0) {
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
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	array
	 * @return	string
	 */
	public function update_single($table, $updates, $conditions = array())
	{
		//If there are conditions
		if (count($conditions) > 0) {
			$this->condition_handler($conditions);
                        //echo $this->db->last_query();die;
		}                
		return $this->db->update($table, $updates);
	}


	/**
	 * Update Batch
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @return	boolean
	 */
	public function update_batch_data($table, $defaultArray, $dynamicArray = array(), $key)
	{
		//Check if any data
		if (count($dynamicArray) < 1) {
			return false;
		}
		
		//Prepare data for insertion
		foreach($dynamicArray as $val) {
			$data[] = array_merge($defaultArray, $val);
		}
		return $this->db->update_batch($table, $data, $key);
	}


	/**
	 * Delete data from DB
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	string
	 * @return	string
	 */
	public function delete_data($table, $conditions = array())
	{
		//If there are conditions
		if (count($conditions) > 0) {
			$this->condition_handler($conditions);
		}
		return $this->db->delete($table);
	}

	
	/**
	 * Handle different conditions of query
	 *
	 * @access	public
	 * @param	array
	 * @return	bool
	 */
	public function condition_handler($conditions)
	{
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
					$this->db->where($key,$val);
				} else {
					$this->db->or_where($key,$val);
				}
				$i++;
			}
			$this->db->group_end();
		}
	}


	/**
	 * Log error in DB
	 *
	 * @access	public
	 * @param	array
	 * @param	string
	 */
	public function error_log_in_db($logData = array(), $message, $admin = true)
	{
		$insertData = array(
			'message' => $message,
			'data' => json_encode($logData),
			'type' => (string) ($admin ? 1 : 0),
			'loggedTime' => time(),
		);
		return $this->insert_single('error_logs', $insertData);
	}
}
