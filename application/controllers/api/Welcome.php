<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Api_Controller {
	
	public function index()
	{
		$api = array(
			'status' => 1, // Success
			'message' => 'success',
			'api_version' => '1.0',
			'response' => 'success'
		);
		echo json_encode($api, JSON_FORCE_OBJECT); 
	}
}
