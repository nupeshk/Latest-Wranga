<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* * ***********************
 * PAGE: USE TO MANAGE USER 
 * #COPYRIGHT: Greychain
 * @AUTHOR: Mohd Shahid <shahidansari.bit@gmail.com>.
 * CREATOR: 09/02/2017.
 * UPDATED: 
 * Codigniter    
 * *** */

class Authtoken_model extends CI_Model {

    protected $model_tbl = 'authtoken';
    protected $user_tbl = 'users';
    protected $admin_tbl = 'admin';

    function _construct() {
        parent::_construct();
    }

    /**
     * Insert data in DB
     *
     * @param	string
     * @param	array
     * @return	string
     */
    public function insert($data = array()) {
        //Check if any data to insert
        if (count($data) < 1) {
            return false;
        }
		//echo $this->db->last_query();die;
        $this->db->insert($this->model_tbl, $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @param array $where $coloumn
     * @return array $result
     * @author mohd shahid <shahidansari.bit@gmail.com>
     */
    function update($where, $data) {
        try {
            $this->db->where($where);
            $update = $this->db->update($this->model_tbl, $data);
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
     * function for delete
     * @param array $where 
     * @return bool
     * @author mohd shahid <shahidansari.bit@gmail.com>
     */
    function delete($where) {
        try {

            $this->db->where($where);
            $deletData = $this->db->delete($this->model_tbl);
            if ($deletData) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get user data
     * @param array $where $coloumn
     * @return array $result
     * 
     */
    function getAuthData($coloumn = array(), $where = array(), $row = false) {
        try {
            $this->db->select($coloumn);
            $this->db->from($this->model_tbl);
            if (is_array($where) && count($where) > 0) {
                $this->db->where($where);
            }
            $query = $this->db->get();
            //echo $this->db->last_query();die;
            if ($row) {
                $result = $query->row_array();
            } else {
                $result = $query->result_array();
            }
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    /**
     * 
     * **/
    function getNotifyUserData($coloumn = array(), $where, $row = false) {
        try {
            $this->db->select($coloumn);
            $this->db->from($this->model_tbl. " as a");
             $this->db->join($this->user_tbl . " as u", "u.userId = a.userId", "inner");
            if (is_array($where) && count($where) > 0) {
                $this->db->where($where);
            } else {
                $this->db->where($where);
            }
            $query = $this->db->get();
            //echo $this->db->last_query();die;
            if ($row) {
                $result = $query->row_array();
            } else {
                $result = $query->result_array();
            }
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    
    /**
     * Get Administrators data          
     * */
    public function getAdministratordData($col = array(), $where = array(), $search = '', $limit = "", $start = "") {
        //echo $search;die;
        $this->db->select($col, FALSE)
                ->from($this->admin_tbl . ' as admin');
        if (!empty($where)) {
            foreach ($where as $k => $v) {
                $this->db->where($k, $v);
            }
        }
        if ($search != '') {
            $this->db->like($search);
        }
        $this->db->order_by("createdDate", "desc");
        if ($limit != '' || $start != '') {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $return['result'] = $query->result_array();
        $return['count'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;
        return $return;
    }
    
}
