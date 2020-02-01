<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This function takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null, $single = false) {
        $this->db->select('*')->from('content');
        if ($id != null) {
            if (isset($id['type'])) {
                $this->db->where('type', $id['type']); 
            } else { 
                $this->db->where('id', $id); 
            }
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null && !isset($id['type']) || $single === true) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    } 

    public function get_sections($id = null, $single = false) {
        $this->db->select('*')->from('sections');
        if ($id != null) {
            if (isset($id['name'])) {
                $this->db->where('name', $id['name']); 
            } else { 
                $this->db->where('id', $id); 
            }
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null && !isset($id['name']) || $single === true) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    } 

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        if (isset($id['type'])) {
            $this->db->where('type', $id['type']);
        } else {
            $this->db->where('id', $id);
        }
        $this->db->delete('content');
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
            $this->db->update('content', $data);
        } else {
            $this->db->insert('content', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    } 

    public function add_sections($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sections', $data);
        } else {
            $this->db->insert('sections', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }      

}
