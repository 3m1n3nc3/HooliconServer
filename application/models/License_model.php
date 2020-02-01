<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class License_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($data = null)
    {
        $this->db->insert('license', $data);
    }

    public function check($key = null)
    {
        $this->db->select('key')->from('license');
        $this->db->where('key', $key);
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function validate($user = '', $key = null)
    {
        $this->db->select('*')->from('school');
        if ($key) {
            $this->db->where('purchase_code', $key);
        }
        
        if (isset($data['site_url'])) 
        {
            $this->db->where('site_url', $data['site_url']); 
        } 
        elseif (isset($data['email'])) 
        {
            $this->db->where('email', $data['email']); 
        } 
        elseif (isset($data['username'])) 
        {
            $this->db->where('username', $data['username']); 
        } 
        elseif (isset($data['id'])) 
        {
            $this->db->where('id', $data['id']); 
        }   
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_unused($validity = null)
    {
        $this->db->select('key')->from('license');
        if ($validity) {
            $this->db->where('valid_for', $validity);
        }
        $this->db->where('used_by', NULL);
        $this->db->where('used_date', NULL);
        $this->db->order_by('id', 'RANDOM');

        $query = $this->db->get();
        return $query->row_array()['key'];
    }

    public function count($query = array())
    {    
        $sql = "SELECT (SELECT COUNT(*) from license) as `total`, (SELECT COUNT(*) from license where `used_date` IS NULL) as `unused`, (SELECT COUNT(*) from license where `used_date` IS NOT NULL) as `used`";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function approve($user = null, $key = null, $type = 0)
    {   
        $data = $this->validate($user);
        $update = array(
            'purchase_code' => $key,
            'sslk'          => $key
        );
        if ($type == 0) {
            if (isset($data['id'])) {
                $this->db->where('username', $data['username']); 
                $this->db->update('school', $update);
                $this->approve($user, $key, 1);
                return $update;
            }     
        } else {
            $use_data = array(
                'used_by'       => $data['id'],
                'used_date'     => date('Y-m-d', strtotime('NOW'))
            );

            if (isset($data['id'])) {
                $this->db->where('key', $data['purchase_code']);
                $this->db->update('license', $use_data);
            }
        }
    } 

    public function update_user($data = array())
    {
       if (isset($data['username']) || isset($data['purchase_code'])) { 
            if (isset($data['username'])) {
                $this->db->where('username', $data['username']);
                $this->db->or_where('id', $data['username']); 
                $this->db->update('school', $data);
            } elseif (isset($data['purchase_code'])) {
                $this->db->where('purchase_code', $data['purchase_code']);
                $this->db->update('school', $data);
            } elseif (isset($data['email'])) {
                $this->db->where('email', $data['email']);
                $this->db->update('school', $data);
            }
            return $data;

        }
    }   
}
