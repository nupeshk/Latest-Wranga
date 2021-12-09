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

class Transaction_model extends CI_Model {

    protected $model_tbl = 'transactions';
    protected $vehicle_tbl = 'vehicles';
    protected $user_tbl = 'users';
    
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
    function getTransactionData($coloumn = array(), $where = array(), $row = false) {
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
     * Get Coupon data          
     * */
    public function getTransactionList($col = array(), $where = array(), $search = '', $order_by = array("t.transactionId", "desc"), $limit = "", $start = "") {
        $this->db->select($col, FALSE)->from($this->model_tbl. ' as t');
        $this->db->join('vehicles as v', 'v.vehicleId = t.vehicleId', 'LEFT');
        $this->db->join('users as u', 'u.userId = t.userId', 'LEFT');
        if (!empty($where)) {
            foreach ($where as $k => $v) {
                $this->db->where($k, $v);
            }
        }
        //if ($search != '') {
          //  $this->db->like($search);
        //}
        if ($search != '') {
            $i = 0;
            $this->db->group_start();
            foreach ($search as $k => $v) {
                if ($i == 0) {
                    $this->db->like($k, $v);
                } else {
                    $this->db->or_like($k, $v);
                }
                $i++;
            }
            $this->db->group_end();
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);
        }
        if ($limit != '' || $start != '') {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $return['result'] = $query->result_array();
        $return['count'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;
        return $return;
    }
    
    /**
     * Get Bartender Pending Applicatoion data          
     * */
    public function getTransactionDetail($col = array(), $where = array(), $search = '', $order_by = array("p.ProductId", "desc"), $limit = "", $start = "") {
        $this->db->select($col, FALSE)->from($this->product_tbl . ' as p');
        $this->db->join('inventoryStock as is', 'is.SupplierItemID = p.SupplierItemID', 'INNER');
        if (!empty($where)) {
            foreach ($where as $k => $v) {
                $this->db->where($k, $v);
            }
        }
        if ($search != '') {
            $i = 0;
            $this->db->group_start();
            foreach ($search as $k => $v) {
                if ($i == 0) {
                    $this->db->like($k, $v);
                } else {
                    $this->db->or_like($k, $v);
                }
                $i++;
            }
            $this->db->group_end();
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);
        }
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
