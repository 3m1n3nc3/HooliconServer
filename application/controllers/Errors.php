<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends My_Controller{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function error_404()
    {   
        $data = array();
        $data['page_title'] = 'page_not_found_404'; 
        $data['fullname'] = 'Error 404';
        $this->load->view('layout/public_header', $data);  
        $this->load->view('layout/page_404');
        $this->load->view('layout/footer', $data);  
    } 

}
