<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class School_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This function takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select('*')->from('school');
        if ($id != null) {
            if (isset($id['user_id'])) {
                $this->db->where('user_id', $id['user_id']); 
            } elseif (isset($id['payment_id'])) {
                $this->db->where('payment_id', $id['payment_id']); 
            } else { 
                $this->db->where('id', $id);
                $this->db->or_where('username', $id);
                $this->db->or_where('email', $id);
                $this->db->or_where('site_url', $id);
            }
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null && !isset($id['user_id'])) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function fetch($id = null) {
        $this->db->select('*')->from('school');
        if ($id != null) {
            $this->db->where('user_id', $id); 
        }
        $this->db->order_by('id');
        $query = $this->db->get(); 
        return $query->result_array(); 
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        if (isset($id['user_id'])) {
            $this->db->where('user_id', $id['user_id']);
        } else {
            $this->db->where('id', $id);
        }
        $this->db->delete('school');
        return $this->db->affected_rows();
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('school', $data);
        } else {
            $this->db->insert('school', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }      

}
