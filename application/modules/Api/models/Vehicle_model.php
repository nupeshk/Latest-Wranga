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

class Vehicle_model extends CI_Model {

    protected $model_tbl = 'vehicles';
    protected $users_tbl = 'users';

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
    function getVehicleData($coloumn = array(), $where = array(), $row = false) {
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
     * Get Event data
     * @param array $where $coloumn
     * @return array $result
     * 
     */
    function getVehicleUser($coloumn = array(), $where = array(), $row = false) {
        try {
            $this->db->select($coloumn);
            $this->db->from($this->model_tbl);
            $this->db->join($this->users_tbl, $this->model_tbl . ".userId = " . $this->users_tbl . ".userId", "INNER");

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

}
