<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Api_Controller {
	
	public function index()
	{
		redirect('users/account');
	}
}
