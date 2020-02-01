<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends User_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    { 
        $data = $this->account;
        $data['page_title'] = 'your_account'; 
        $data['use_table'] = TRUE; 
        $data['table_method'] = 'list_user_products/'.$data['id'];
        $data['products'] = $this->school_model->fetch($data['id']); 
        $data['fullname'] = $data['name']; 
        $this->load->view('layout/header', $data);       
        $this->load->view('users/account', $data);       
        $this->load->view('layout/footer', $data);  
    } 

    public function payments()
    { 
        $data = $this->account;
        $data['page_title'] = 'payments'; 
        $data['use_table'] = TRUE; 
        $data['table_method'] = 'list_user_payments/'.$data['id'];
        $data['payments'] = $this->product_model->get_payments(['user_id' => $data['id']]); 
        $data['fullname'] = $data['name']; 
        $this->load->view('layout/header', $data);       
        $this->load->view('users/payments', $data);       
        $this->load->view('layout/footer', $data);  
    } 

    public function update($action = 'data')
    { 
        $data = $this->account;
        $data['page_title'] = 'update_profile'; 
        $data['fullname'] = $data['name'];
        $data['user_photo'] = $this->creative_lib->fetch_image($data['image']);
        $data['payments'] = $this->product_model->get_payments(['user_id' => $data['id']]);
        $data['product_'] = $this->school_model->get(['user_id' => $data['id']]);

        $this->load->view('layout/header', $data); 

        if ($action == 'data') {
             
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    		$this->form_validation->set_rules('password', 'Password', 'trim');
    		$this->form_validation->set_rules('fname', 'First Name', 'trim|required'); 
    		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required'); 
    		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|regex_match[/^[0-9]{11}$/]'); 
            $this->form_validation->set_rules('address', 'Address', 'trim|required'); 
    		if ($data['email'] == $this->input->post('email')) {
    			$this->form_validation->set_rules('email', 'Email', 'trim|required'); 
    		} else {
    			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]'); 
    		}
            if ($this->input->post('username')) {
                if ($data['username'] == $this->input->post('username')) {
                    $this->form_validation->set_rules('username', 'Username', 'trim|required'); 
                } else {
                    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[admin.username]'); 
                    $do_login = TRUE;
                }
                $save_username = TRUE;
            }  

            if ($this->form_validation->run() === FALSE) { 
        		$this->load->view('users/update', $data);  
            } else { 
            	if ($this->input->post('password')) {
                	$data['password'] = MD5($this->input->post('password'));
            	}
            	$save['id'] 	   = $data['id'];
            	$save['fname'] 	   = $this->input->post('fname');
            	$save['lname'] 	   = $this->input->post('lname');
            	$save['phone'] 	   = $this->input->post('phone'); 
                $save['email']     = $this->input->post('email');  
            	$save['address']   = $this->input->post('address');  
                if (isset($save_username)) {
                    $save['username']  = $this->input->post('username');  
                }

    			$save = $this->user_model->add($save); 
                if (isset($do_login)) {
                    $login = $this->user_model->get($save['username']);
                    $this->session->set_userdata($login);
                } 
            	$this->session->set_flashdata('msg', $this->my_config->alert(ucwords($data['site_name']).' Your Profile has been updated', 'success'));
                redirect('users/account/update');   
            }   
        } elseif ($action == 'upload_photo') {

            if (isset($_FILES["userphoto"])) { 

                $fileInfo = pathinfo($_FILES["userphoto"]["name"]);
                $img_name = mt_rand().'_'.mt_rand().'_'.mt_rand().'_p.' . $fileInfo['extension'];

                $_config['upload_path']          = './uploads/photos/'.$data['username'].'/';
                $_config['allowed_types']        = 'gif|jpg|png|jpeg';
                $_config['max_size']             = '1500';
                $_config['image_height']         = '500';
                $_config['image_width']          = '500';
                $_config['file_name']            = $img_name;
                $_config['file_ext_tolower']     = TRUE;

                $this->upload->initialize($_config);

                if ( ! $this->creative_lib->create_dir($_config['upload_path'])) {
                    $this->upload->set_error('upload_unable_to_write_file', 'debug');
                    $data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); 
                } else {
                    $this->creative_lib->delete_file('./'.$data['image']);
                }

                if ( ! $this->upload->do_upload('userphoto'))
                {
                    $data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); 
                }
                else
                {
                    $data['upload_data'] = $this->upload->data(); 
                    $data_img = array('id' => $data['id'], 'image' => 'uploads/photos/'.$data['username'].'/'.$img_name);
                    $this->user_model->add($data_img);
                    chmod($_config['upload_path'].'/'.$img_name, 0777);
                    $this->creative_lib->resize_image($_config['upload_path'].$img_name, ['maintain_ratio' => FALSE]);
                    redirect('users/account/update/upload_photo');
                }
            }
 
            $this->load->view('users/update', $data);  
        } else {
            $data['page_title'] = 'view_profile';  

            $this->load->view('users/profile', $data);  
        }
        $this->load->view('layout/footer', $data);  
    } 

    public function product($id = '') 
    {    

        $account = $this->account;
        $product = $this->school_model->get($id);  
        $data = $product;
        $data['fullname'] = $account['name'];
        $data['role'] = $account['role'];
        $data['user'] = $this->account_data->fetch($data['user_id']);
        $data['product_settings'] = $this->product_model->get($data['product']); 
        $data['errors'] = $this->product_model->get_errors(['product_id' => $data['id']]); 

        $data['page_title'] = 'view_product';  

        $fix_err = $this->input->post('delete_error');
        if (isset($fix_err)) {
            $this->product_model->delete_errors($this->input->post('id')); 
            $this->session->set_flashdata('msg', $this->my_config->alert(ucwords($data['site_name']).' Error Fixed', 'success'));
        }

        $this->load->view('layout/header', $data);     
        if ($product['user_id'] === $account['id']) {   
            $this->load->view('admin/product/details', $data);
        } else { 
            redirect('errors/error_404');   
        }   
        $this->load->view('layout/footer', $data);  
    } 

    public function logout() 
    {    
        $this->account_data->user_logout();
        redirect('access/login');       

    }

}
