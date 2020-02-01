<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validate extends Api_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
		$api = array(
			'status' => 'success',
			'api_version' => '1.0'
		);
		echo json_encode($api, JSON_FORCE_OBJECT);
    }

	public function school($id = null)
	{	
		$this->form_validation->set_rules('school', 'School', 'trim|required');
        if ($this->form_validation->run() != FALSE) {
        	$id = $this->input->post('school');
		}
		$school = $this->school_model->get($id);
		echo json_encode($school, JSON_FORCE_OBJECT);
	}
}
