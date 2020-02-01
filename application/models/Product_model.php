<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


        // $get_compiled_select = $this->db->get_compiled_select('mytable');
        // echo $get_compiled_select;
    /**
     * This function takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select('*')->from('products');
        if ($id != null) {
            $this->db->where('id', $id); 
            $this->db->or_where('name', $id); 
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_plan($id = null, $row = false) {
        $this->db->select('*')->from('plan');
        if ($id != null) {
            $this->db->where('id', $id); 
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null || $row === true) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_payments($id = null, $row = false) {
        $this->db->select('*')->from('payments');
        if ($id != null) {
            if (isset($id['reference'])) {
                $this->db->where('reference', $id['reference']); 
            } elseif (isset($id['user_id'])) {
                $this->db->where('user_id', $id['user_id']); 
            } else {
                $this->db->where('id', $id); 
            }
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null && !isset($id['user_id']) || $row === true) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_sales($id = null) {
        $this->db->select('COUNT(id) AS sold, SUM(amount) AS sales')->from('payments');
        if ($id != null) {
            $this->db->where('product_id', $id); 
        }

        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('products');
        return $this->db->affected_rows();
    }

    public function remove_plan($id) {
        $this->db->where('id', $id);
        $this->db->delete('plan');
        return $this->db->affected_rows();
    }

    public function remove_payments($id) {
        if (isset($id['user_id'])) {
            $this->db->where('user_id', $id['user_id']);
        } else {
            $this->db->where('id', $id);
        }
        $this->db->delete('payments');
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
            $this->db->update('products', $data);
        } else {
            $this->db->insert('products', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }  

    public function add_plan($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('plan', $data);
        } else {
            $this->db->insert('plan', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }  

    public function add_payments($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('payments', $data);
        } else {
            $this->db->insert('payments', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }  

    public function add_errors($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('errors', $data);
        } else {
            $this->db->insert('errors', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }  

    public function delete_errors($id) {
        if (isset($id['product_id'])) {
            $this->db->where('product_id', $id['product_id']);
            if (isset($id['code'])) {
                $this->db->where('code', $id['code']);
            }
        } else {
            $this->db->where('id', $id);
        }
        $this->db->delete('errors');
        return $this->db->affected_rows();
    }    

    public function get_errors($data = null) {
        $this->db->select('*')->from('errors');
        if (isset($data['product_id'])) {
            $this->db->where('product_id', $data['product_id']);  
        } elseif (isset($data['id'])) {
            $this->db->where('id', $data['id']);  
        } else {
            $this->db->order_by('id DESC');
        }
        $query = $this->db->get();
        if (isset($data['id'])) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }  

}
