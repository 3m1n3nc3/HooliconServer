<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
		// redirect('admin/login');  	
    }  
}
