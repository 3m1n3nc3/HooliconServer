<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This function will return the configuration settings from the db
     * If key is not provided, then it will fetch all the records form the table.
     * @param string $key
     * @return mixed
     */
    public function get_unique_visitors() {

        $this->db->select('ip')->from('visitors');
        $this->db->order_by('ip'); 
        $this->db->group_by('ip');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_visitors($id = null) {
        $this->db->select('*')->from('visitors');
        if ($id != null) {
            $this->db->where('id', $id); 
            $this->db->or_where('ip', $id); 
        } else {
            $this->db->order_by('ip');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function save_visitor($data = null)
    {
        if (isset($data['id'])) { 
            $this->db->or_where('id', $data['id']); 
            $this->db->update('visitors', $data);
            $affected = $this->db->affected_rows();
            return $affected;
        } else {
            $this->db->insert('visitors', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    public function sales_stats_year($data = '')
    {   
        $year = date('Y-m-d', strtotime('last year'));
        $this->db->select('YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) AS last_year, YEAR(CURDATE()) AS this_year')->from('payments');
        $this->db->group_by('last_year, this_year'); 
        $this->db->order_by('this_year'); 
        $query = $this->db->get();
            return $query->result_array();
    }

    public function sales_stats($data = '')
    {   
        $year = (isset($data['year']) ? $data['year'] : date('Y-m-d', strtotime('NOW')));

        $this->db->select('SUM(amount) AS sales, MONTH(date) AS month')->from('payments');
        if (isset($data['id'])) {
            $this->db->where('product_id', $data['id']); 
        }
        $this->db->where('YEAR(date)', $year); 
        $this->db->group_by('month'); 
        $this->db->order_by('month'); 
        $query = $this->db->get();
        return $query->result_array();
    }

}
