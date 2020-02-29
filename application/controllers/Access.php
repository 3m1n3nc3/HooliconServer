<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends Access_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
		redirect('access/login');  	
    }

	/**
	 * This method will enroll the user on the validation platform
	 * and activates the school if a valid record was found
	 * @param  string $user this should contain the unique identifier for the user
	 * @param  string $key  the license key to validate
	 * @return json       returns a json containing success and the kay
	 */
	public function signup() 
	{	
        if ($this->account_data->user_logged_in()) {
            $this->account_data->user_redirect();
        }
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules('username', 'Username', 'trim|alpha_dash|required|is_unique[user.username]|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[user.email]'); 
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('repassword', 'Repeat Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('agree', 'Agree to terms', 'required',
            array('required' => 'You have to agree to the terms and conditions')
        ); 

        if ($this->form_validation->run() === FALSE) {
        	$this->load->view('layout/login_header');   
        	$this->load->view('users/signup');	 
        	$this->load->view('layout/login_footer');   
        } else {
        	$data['username'] = $this->input->post('username');
            $data['password'] = MD5($this->input->post('password'));
        	$data['email'] = $this->input->post('email'); 
        	$data['role'] = 'user'; 

			$register = $this->user_model->add($data);
            if ($register) {
                $data = $this->user_model->get($data['username']);
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Hello '.$data['username'].$this->lang->line('signup_success_message').'</div>'); 
                $this->session->set_userdata($data);
                redirect('access/signup_success');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('registration_failed').'</div>');
                $this->load->view('layout/login_header');   
                $this->load->view('users/signup');   
                $this->load->view('layout/login_footer'); 
            }	
        }

	}

    public function login($action = 'user') 
    {   
        $data['page_title'] = $action.'_login';    

        if ($action === 'admin' && $this->account_data->logged_in()) {
            $this->account_data->is_logged_in(true);    
        } elseif ($action === 'user' && $this->account_data->user_logged_in()) {
            $this->account_data->user_redirect();
        }
        $data['action'] = $action;
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('username', 'Username', 'trim|alpha_dash|required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

        $this->load->view('layout/login_header', $data);
        $this->load->view('layout/login_footer', $data);     
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('users/login', $data);       
        } else {
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');

            $login = $this->user_model->userLogin($data);
            $admin = $this->admin_model->adminLogin($data);

            $logged = 0;
            if ($action === 'admin') {
                if ($admin) {
                    $logged = 1;
                    if ($this->input->post('remember')) { 
                        $this->input->set_cookie('admin', $data['username'], time() + 30 * 24 * 60 * 60);             
                    }
                    $data = array('admin' => $data['username']);
                    $this->session->set_userdata($data);

                    if (isset($_SESSION['redirect_to']))
                        redirect($_SESSION['redirect_to']);
                    else
                        redirect('admin/admin/dashboard'); 
                }                 
            } else {
                if ($login) {
                    $logged = 1;
                    if ($this->input->post('remember')) { 
                        $this->input->set_cookie('username', $data['username'], time() + 30 * 24 * 60 * 60);             
                    }
                    $data = $this->user_model->get($data['username']);
                    $this->session->set_userdata($data);

                    if (isset($_SESSION['redirect_to_user']))
                        redirect($_SESSION['redirect_to_user']);
                    else
                        redirect('users/account');    
                }               
            }
            if ($logged === 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-warning">'.$this->lang->line('invalid_username_password').'</div>');
                $this->load->view('users/login', $data);  
            }
        }     

    }

    public function signup_success() 
    {   
        $this->account = $this->account_data->fetch($this->session->userdata('username'));
        $data = $this->account;
        $data['page_title'] = 'signup_success';    
        $data['fullname'] = $data['name']; 
        $this->session->set_flashdata('msg', $this->my_config->alert('Hello '.$data['username'].$this->lang->line('signup_success_message'), 'success')); 

        $this->load->view('layout/header', $data);      
        $this->load->view('users/signup_success', $data);       
        $this->load->view('layout/footer', $data);      

    }

}
