<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_plan extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
		// redirect('admin/login');  	
    }  

    public function plans()
    {	
		$data['action'] = 'plans'; 
		$data['plans'] = $this->product_model->get_plan(); 
		$this->load->view('admin/modals/product_plan', $data); 
	}
	
    public function products()
    {	
		$data['action'] = 'products'; 
        $data['products'] = $this->product_model->get(); 
		$this->load->view('admin/modals/product_plan', $data); 
    }  
}
