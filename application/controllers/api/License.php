<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License extends Api_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

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

    /**
     * Generates a number of license keys following the users spec
     * @param  integer $quantity the number of keys to generate
     * @param  action $action   what to do with the generated 
     *         keys (default is noting --- specify save to save the keys to database)
     * @param  integer $validity in days, how long should the keys last
     * * @return json       returns a json containing success and the generated keys
     */
	public function generate($quantity = 0, $action = null, $validity = 365)
	{	 
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
		$this->form_validation->set_rules('action', 'Action', 'trim|required');
		$this->form_validation->set_rules('validity', 'Validity', 'trim|required');
        if ($this->form_validation->run() != FALSE) {
        	$quantity = $this->input->post('quantity');
        	$action = $this->input->post('action'); 
        	$validity = $this->input->post('validity');
        }

		// $api = array(
		// 	'status' => 1, // Success
		// 	'message' => count($keys).' keys were generated',
		// 	'post_data' => $this->input->post(),
		// 	'response_data' => $this->input->post(),
		// 	'response' => $keys
		// );
		
		$api = $this->licenser->generate($quantity, $action, $validity);
        $api['response_data'] = $this->input->post();
		$api['post_data'] = $this->input->post(); 

		echo json_encode($api, JSON_FORCE_OBJECT);
	}

	/**
	 * Checks if a given key is valid for use
	 *@param  string $key  the license key to validate
	 * @return json       returns a json containing success and the key
	 */
	public function check($key = null) 
	{	
		$this->form_validation->set_rules('key', 'Key', 'trim|required');
        if ($this->form_validation->run() != FALSE) {
        	$key = $this->input->post('key');
        }
		$key = $this->license_model->check($key);
		if ($key) {
			$api = array(
				'status' => 1, // Success
				'message' => count($key).' keys were found',
				'post_data' => $key,
				'response_data' => $key,
				'response' => $key['key']
			);
		} else {
			$api = array(
				'status' => 2, // Error
				'error' => array('purchase_code' => 'The purchase code you provided is not valid'),
				'post_data' => $key,
				'response_data' => $key,
				'response' => 'Invalid key',
			);
		}
		echo json_encode($api, JSON_FORCE_OBJECT);
	}

	/**
	 * This method checks the given key against the users records
	 * and activates the school if a valid record was found
	 * @param  string $user this should contain the unique identifier for the user
	 * @param  string $key  the license key to validate
	 * @return json       returns a json containing success and the kay
	 */
	public function activation($user = null, $key = null) 
	{	
		$this->form_validation->set_rules('key', 'Key', 'trim|required');
		$this->form_validation->set_rules('user', 'Username', 'trim|required');
        if ($this->form_validation->run() != FALSE) {
        	$key = $this->input->post('key');
        	$user = $this->input->post('user');
        }
		$key = $this->license_model->validate($user, $key);

		$expiry = $this->account_data->days_diff($key['expiry']);	 

		if ($expiry && $key) {
			$api = array(
				'status' => 1, // Success
				'message' => ' Activation was successful',
				'post_data' => $user,
				'response_data' => $key,
				'response' => $key['purchase_code']
			);
		} else {
			$api = array(
				'status' => 2, // Error
				'error' => array('purchase_code' => 'The purchase code you provided is not valid or may have expired'),
				'post_data' => $user,
				'response_data' => $key,
				'response' => 'Invalid or Expired Key'
			);
		}
		echo json_encode($api, JSON_FORCE_OBJECT);
	}

	/**
	 * When a user is requesting activation, once the license is validated
	 * call approve to update all related records of the license usage
	 * @param  string $user this should contain the unique identifier for the user
	 * @return json       returns a json containing success and the kay
	 */
	public function approve($user = null) 
	{
		$key = $this->license_model->get_unused();
		$update = $this->license_model->approve($user, $key); 
		if ($update) {
			$api = array(
				'status' => 1, // Success
				'message' => ' Activation was successful',
				'post_data' => $user,
				'response_data' => $key,
				'response' => $update['purchase_code']
			);
		} else {
			$api = array(
				'status' => 2, // Error
				'error' => array('purchase_code' => 'No license to issue at this moment, please try again at a later time'),
				'post_data' => $user,
				'response_data' => $key,
				'response' => 'No license to issue at this moment, please try again'
			);
		}
		echo json_encode($api, JSON_FORCE_OBJECT);
	}

	/**
	 * Update the users data from an api call
	 * call approve to update all related records of the license user data
	 * @param  string $user this should contain the unique identifier for the user
	 * @return json       returns a json containing success and the kay
	 */
	public function update_user() 
	{ 
        $data = $this->input->post();
        if ($data) {
        	$check_key 	= $this->license_model->validate($data, $data['purchase_code']);
			$expiry = $this->account_data->days_diff($check_key['expiry']);

			if ($expiry && $check_key) {
	        	$data 	= $this->license_model->update_user($data); 
				$api 	= array(
					'status' => 1, // Success
					'message' => ' Product "'.$check_key['username'].'" has been successfully activated',
					'post_data' => $data,
					'response_data' => $check_key,
					'response' => $data['purchase_code']
				);				
			} else {
				$api 	= array(
					'status' => 2, // Error
					'error' => array('purchase_code' => 'The key you entered is invalid, or may have expired!'),
					'post_data' => $data,
					'response_data' => $check_key,
					'response' => 'The key you entered is invalid, or may have expired!'
				);
			}

		} else {

			$api 	= array(
				'status' => 2, // Error
				'error' => array('purchase_code' => 'The key you entered is invalid, or may have expired!,', 'email' => 'Invalid Email address'),
				'post_data' => $data,
				'response_data' => $data,
				'response' => 'Invalid parameters'
			);	

		}
		echo json_encode($api, JSON_FORCE_OBJECT);
	}
}

// $data = $this->curler->ssl_fetch('http://api.build.te/api/license/check/', array('key' => 'DWZDV-9RCFT-FDSYC-RJ2Y5'));print_r($data);


// $data = $this->curler->fetch('http://api.build.te/api/license/validate/', array('key' => 'ABC8EA-F1HIJK-LMNO9A', 'user' => 'hooliconschools'));print_r($data);
