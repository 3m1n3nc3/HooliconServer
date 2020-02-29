<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
        redirect('admin/admin/dashboard');
    } 

    public function dashboard($ids = '', $action = '') 
    {  

        $account = $this->account;
        $data = $account;

        $data['page_title'] = 'admin_dashboard'; 
        $data['fullname'] = $account['name'];
        $data['use_table'] = TRUE; 
        $data['use_chart'] = TRUE; 
        $data['table_method'] = 'list_admin_products';

        $data['get_products'] = $this->product_model->get();
        $data['get_plans'] = $this->product_model->get_plan(); 

        $xgp = [];
        foreach ($data['get_plans'] as $gp) {
            $xgp[] .= str_ireplace('.00', '', $gp['price']);//.' '. $this->my_config->item('currency_code');
        }
        $data['get_prices'] = implode(', ', $xgp);

        $data['products'] = $this->school_model->fetch();
        $data['users'] = $this->user_model->get(); 
        $data['payments'] = $this->product_model->get_payments(); 
        $data['visitors'] = $this->dashboard_model->get_unique_visitors(); 
        $data['sales_stats'] = $this->creative_lib->yearly_sales();

        $data['errors'] = $this->product_model->get_errors(); 

        if ($action == 'delete') {
            $this->product_model->delete_errors($ids); 
            $this->session->set_flashdata('msg', $this->my_config->alert('Error Deleted', 'success'));
            redirect('admin/admin/dashboard');
        }
        $fix_error = $this->input->post('fix_error');
        if ($fix_error) {
            foreach ($fix_error as $ids) {
                $this->product_model->delete_errors($ids); 
                $this->session->set_flashdata('msg', $this->my_config->alert(count($fix_error).' Errors Deleted', 'success'));
            }
            redirect('admin/admin/dashboard');
        }

        $this->load->view('layout/header', $data);        
        $this->load->view('admin/dashboard', $data);        
        $this->load->view('layout/footer', $data);  

    } 

    public function listproducts() 
    {  

        $account = $this->account;
        $data = $account;
        $data['page_title'] = 'active_products'; 
        $data['fullname'] = $account['name'];
        $data['use_table'] = TRUE; 
        $data['table_method'] = 'list_admin_products';
        $data['products'] = $this->school_model->fetch(); 
        $this->load->view('layout/header', $data);        
        $this->load->view('product/admin_product_list', $data);        
        $this->load->view('layout/footer', $data);  

    } 

    public function listusers() 
    {  

        $account = $this->account;
        $data = $account;
        $data['page_title'] = 'list_users'; 
        $data['fullname'] = $account['name'];
        $data['use_table'] = TRUE; 
        $data['table_method'] = 'list_users';
        $data['users'] = $this->user_model->get(); 
        $this->load->view('layout/header', $data);        
        $this->load->view('admin/admin_users_list', $data);        
        $this->load->view('layout/footer', $data);  

    } 

    public function listpayments() 
    {  

        $account = $this->account;
        $data = $account;
        $data['page_title'] = 'list_payments'; 
        $data['fullname'] = $account['name'];
        $data['use_table'] = TRUE; 
        $data['table_method'] = 'list_admin_payments';
        $data['payments'] = $this->product_model->get_payments(); 
        $this->load->view('layout/header', $data);        
        $this->load->view('admin/admin_payment_list', $data);        
        $this->load->view('layout/footer', $data);  

    } 

    public function visitors() 
    {  

        $account = $this->account;
        $data = $account;
        $data['page_title'] = 'visitors'; 
        $data['fullname'] = $account['name'];
        $data['use_table'] = TRUE; 
        $data['table_method'] = 'list_visitors';
        $data['visitors'] = $this->dashboard_model->get_unique_visitors(); 
        $this->load->view('layout/header', $data);        
        $this->load->view('admin/admin_visitor_list', $data);        
        $this->load->view('layout/footer', $data);  

    } 

    public function product($id = '', $action = '', $do_id = '', $do = '') 
    {    

        $account = $this->account;
        $product = $this->school_model->get($id);  
        $data = $product;
        $data['fullname'] = $account['name'];
        $data['role'] = $account['role']; 
        $data['user'] = $this->account_data->fetch($data['user_id']);
        $data['product_settings'] = $this->product_model->get($data['product']); 
        $data['errors'] = $this->product_model->get_errors(['product_id' => $data['id']]); 

        if ($do == 'delete') {
            $this->product_model->delete_errors($do_id); 
            $this->session->set_flashdata('msg', $this->my_config->alert('Error Deleted', 'success'));
            redirect('admin/admin/product/'.$id);
        }
        $fix_error = $this->input->post('fix_error');
        if ($fix_error) {
            foreach ($fix_error as $do_id) {
                $this->product_model->delete_errors($do_id); 
                $this->session->set_flashdata('msg', $this->my_config->alert(count($fix_error).' Errors Deleted', 'success'));
            }
            redirect('admin/admin/product/'.$id);
        }

        $load_view = ($action == 'update' ? 'product/update' : 'product'); 
        if ($action == 'update') {
            $data['page_title'] = 'update_product'; 
            $un     = $this->input->post('name') != $data['site_name'] ? '|is_unique[school.site_name]' : '';
            $up     = $this->input->post('phone') != $data['phone'] ? '|is_unique[school.phone]|regex_match[/^[0-9]{11}$/]' : '';
            $ue     = $this->input->post('email') != $data['email'] ? '|is_unique[school.email]' : '';
            $uus    = $this->input->post('username') != $data['username'] ? '|is_unique[school.username]' : '';
            $uu     = $this->input->post('url') != $data['site_url'] ? '|is_unique[school.site_url]' : '';

            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->form_validation->set_rules('name', $data['product_settings']['simple_name'].' Name', 'trim|alpha_numeric_spaces|required|required|min_length[6]'.$un); 
            $this->form_validation->set_rules('address', 'Address', 'trim|required');  
            $this->form_validation->set_rules('phone', 'Phone number', 'trim|numeric|required|min_length[6]'.$up); 
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'.$ue);  
            $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash'.$uus);  
            $this->form_validation->set_rules('url', 'Url', 'trim|required|valid_url'.$uu);  

            if ($this->form_validation->run() !== FALSE) { 
                $save['id'] = $data['id'];  
                $save['site_name']  = $this->input->post('name');  
                $save['address']    = $this->input->post('address'); 
                $save['phone']      = $this->input->post('phone'); 
                $save['username']   = $this->input->post('username'); 
                $save['email']      = $this->input->post('email'); 
                $save['site_url']   = $this->input->post('url'); 
                $save['status']     = $this->input->post('status'); 

                $this->school_model->add($save);  
                $this->session->set_flashdata('msg', $this->my_config->alert(ucwords($data['site_name']).' has been updated successfully', 'success'));
            }       

            $load_view = 'product/update';
        } else {
            $data['page_title'] = 'view_product'; 
            $load_view = 'product/details';
        }

        $fix_err = $this->input->post('delete_error');
        if (isset($fix_err)) {
            $this->product_model->delete_errors($this->input->post('id')); 
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Error Fixed</div>');
        }

        $this->load->view('layout/header', $data);        
        $this->load->view('admin/'.$load_view, $data);        
        $this->load->view('layout/footer', $data);  

    } 

    public function update($action = 'data')
    { 

        $data = $this->account;
        $data['page_title'] = 'update_profile'; 
        $data['fullname'] = $data['name'];
        $data['user_photo'] = $this->creative_lib->fetch_image($data['image']);

        $data['payments'] = array();
        $data['product_'] = array();

        $this->load->view('layout/header', $data); 
        if ($action == 'data') {
             
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->form_validation->set_rules('password', 'Password', 'trim'); 
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required'); 
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');  
            if ($data['phone'] == $this->input->post('phone')) {
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required'); 
            } else {
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_unique[admin.phone]|regex_match[/^[0-9]{11}$/]'); 
            }
            if ($data['email'] == $this->input->post('email')) {
                $this->form_validation->set_rules('email', 'Email', 'trim|required'); 
            } else {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[admin.email]'); 
            }
            if ($data['username'] == $this->input->post('username')) {
                $this->form_validation->set_rules('username', 'Username', 'trim|required'); 
            } else {
                $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[admin.username]'); 
                $do_login = TRUE;
            }   

            if ($this->form_validation->run() !== FALSE) { 
                if ($this->input->post('password')) {
                    $data['password'] = MD5($this->input->post('password'));
                }
                $save['id']     = $data['id'];
                $save['fname']  = $this->input->post('fname');
                $save['lname']  = $this->input->post('lname');
                $save['phone']  = $this->input->post('phone'); 
                $save['email']  = $this->input->post('email');  
                $save['address'] = $this->input->post('address');
                $save['username']  = $this->input->post('username');  

                $save = $this->admin_model->add($save);
                if (isset($do_login)) {
                    $login = array('admin' => $save['username']);
                    $this->session->set_userdata($login);
                } 
                $this->session->set_flashdata('msg', $this->my_config->alert(ucwords($data['name']).' Your Profile has been updated', 'success'));
                redirect('admin/admin/update');   
            }   

            $this->load->view('users/update', $data); 

        } elseif ($action == 'upload_photo') {

            if (isset($_FILES["userphoto"])) { 

                $fileInfo = pathinfo($_FILES["userphoto"]["name"]);
                $img_name = mt_rand().'_'.mt_rand().'_'.mt_rand().'_p.' . $fileInfo['extension'];

                $_config['upload_path']          = './uploads/admin/photos/'.$data['username'].'/';
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
                    $data_img = array('id' => $data['id'], 'image' => 'uploads/admin/photos/'.$data['username'].'/'.$img_name);
                    $this->admin_model->add($data_img);
                    chmod($_config['upload_path'].'/'.$img_name, 0777);
                    $this->creative_lib->resize_image($_config['upload_path'].$img_name, ['maintain_ratio' => FALSE]);
                    redirect('admin/admin/update/upload_photo');
                }
            }

            $this->load->view('users/update', $data); 

        } else {
            $data['page_title'] = 'view_profile';  

            $this->load->view('users/profile', $data);  
        }
 
        $this->load->view('layout/footer', $data);  
        
    } 

    public function viewuser($id = '', $action = '', $set = '')
    { 

        $data = $this->account_data->fetch($id);
        if ($data) { 
            $data['fullname'] = $data['name'];
            $data['update_action'] = site_url('admin/admin/viewuser/'.$id.'/'.$action);
            $data['upload_action'] = site_url('admin/admin/viewuser/'.$id.'/upload_photo');
            $data['user_photo'] = $this->creative_lib->fetch_image($data['image']);
            
            $data['payments'] = $this->product_model->get_payments(['user_id' => $id]);
            $data['product_'] = $this->school_model->get(['user_id' => $id]);

            $this->load->view('layout/header', $data); 
            if ($action == 'update') {
                $data['page_title'] = 'update_profile'; 

                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $this->form_validation->set_rules('password', 'Password', 'trim'); 
                $this->form_validation->set_rules('fname', 'First Name', 'trim|required'); 
                $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');  
                if ($data['phone'] == $this->input->post('phone')) {
                    $this->form_validation->set_rules('phone', 'Phone', 'trim|required'); 
                } else {
                    $this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_unique[admin.phone]|regex_match[/^[0-9]{11}$/]'); 
                }
                if ($data['email'] == $this->input->post('email')) {
                    $this->form_validation->set_rules('email', 'Email', 'trim|required'); 
                } else {
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]'); 
                }
                if ($data['username'] == $this->input->post('username')) {
                    $this->form_validation->set_rules('username', 'Username', 'trim|required'); 
                } else {
                    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');  
                }  

                if ($this->form_validation->run() === FALSE) { 
                    $this->load->view('users/update', $data);  
                } else { 
                    if ($this->input->post('password')) {
                        $data['password'] = MD5($this->input->post('password'));
                    }
                    $save['id']     = $data['id'];
                    $save['fname']  = $this->input->post('fname');
                    $save['lname']  = $this->input->post('lname');
                    $save['phone']  = $this->input->post('phone'); 
                    $save['email']  = $this->input->post('email');  
                    $save['username']  = $this->input->post('username');  

                    $save = $this->user_model->add($save); 
                    $this->session->set_flashdata('msg', $this->my_config->alert(ucwords($data['name']).' Profile successfully updated', 'success'));
                    $this->load->view('users/update', $data);   
                } 

            } elseif ($action == 'upload_photo') {

                $data['page_title'] = 'update_profile'; 
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
                        redirect($data['upload_action']);
                    }
                }
     
                $this->load->view('users/update', $data);  
            } else {
                $data['page_title'] = 'view_profile';  

                $this->load->view('users/profile', $data);  
            }

            $this->load->view('layout/footer', $data);  
        } else {
            redirect('errors/error_404');   
        }
        
    } 

    public function configuration($action = 'configuration', $id = null, $do = '') 
    { 

        $account = $this->account;
        $data = $account;
        $data['page_title'] = 'configuration';

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->input->post('value')) {
            $this->admin_model->save_settings($this->input->post('value'));
            $this->session->set_flashdata('msg', $this->my_config->alert('Configuration updated', 'success'));
        }

        if ($id) {
            $save['id'] = $id;
        }
        if ($this->input->post('product')) {
            $product = $this->product_model->get($id, true);
            $up  = $this->input->post('product') != $product['title'] ? '|is_unique[school.site_name]' : '';
            $this->form_validation->set_rules('product', 'Title', 'trim|alpha_numeric_spaces|required|min_length[6]'.$up);
            $this->form_validation->set_rules('simple', 'Simple Title', 'trim|alpha_numeric|required|min_length[6]'); 
            $this->form_validation->set_rules('domain', 'Product Domain', 'trim|valid_url|required'); 
            $this->form_validation->set_rules('tax', 'Product Tax', 'trim|numeric'); 
            $this->form_validation->set_rules('shipping', 'Shipping Fees', 'trim|numeric'); 
            $this->form_validation->set_rules('description', 'Product Description', 'trim|required|min_length[10]'); 

            if ($this->form_validation->run() !== FALSE) { 
                $save['title'] = $this->input->post('product');
                $save['name'] = url_title($save['title'], '-', TRUE);
                $save['simple_name'] = $this->input->post('simple');
                $save['setup_time'] = $this->input->post('setup_time');
                $save['domain'] = $this->input->post('domain');
                $save['tax'] = $this->input->post('tax');
                $save['shipping'] = $this->input->post('shipping');
                $save['description'] = $this->input->post('description'); 
                $saved = $this->product_model->add($save);
                $success = $saved ? 'Created' : 'Updated'; 
                $this->session->set_flashdata('msg', $this->my_config->alert('Product "'.$save['title'].'" '.$success, 'success')); 
            }
        }

        if ($this->input->post('plan')) {
            $plan = $this->product_model->get_plan($id, true); 
            $up  = $this->input->post('plan') != $plan['title'] ? '|is_unique[school.site_name]' : '';
            $this->form_validation->set_rules('plan', 'Title', 'trim|alpha_numeric_spaces|required|min_length[4]'.$up);
            $this->form_validation->set_rules('price', 'Price', 'trim|numeric|required|min_length[2]');  

            if ($this->form_validation->run() !== FALSE) { 
                $save['title'] = $this->input->post('plan');
                $save['name'] = url_title($save['title'], '-', TRUE);
                $save['price'] = $this->input->post('price');
                $save['validity'] = $this->input->post('validity'); 
                $saved = $this->product_model->add_plan($save);
                $success = $saved ? 'Created' : 'Updated';
                $this->session->set_flashdata('msg', $this->my_config->alert('Plan "'.$save['title'].'" '.$success, 'success'));
            }
        }

        $purchase_code = $this->input->post('purchase_code');
        $quantity = $this->input->post('quantity');
        $validity = $this->input->post('validity');
        if ($purchase_code) {
            $generate = $this->licenser->generate($quantity, $purchase_code, $validity); 
            if ($this->input->post('purchase_code') == 'test' || $this->input->post('show')) {
                $data['test_codes'] = $generate;
            }
        }
        $data['keys_counter'] = $this->license_model->count();
        $data['action'] = $action;

        $data['prid'] = $data['pid'] = ''; 
        if ($id && $action == 'products') {
            $data['product'] = $this->product_model->get($id); 
            $data['prid'] = $id; 
            if ($do == 'delete') {
                $this->product_model->remove($id); 
                $this->session->set_flashdata('msg', $this->my_config->alert('Product Deleted', 'success'));
                redirect('admin/admin/configuration/products');
            }
        } elseif ($id && $action == 'plans') {
            $data['plan'] = $this->product_model->get_plan($id); 
            $data['pid'] = $id; 
            if ($do == 'delete') {
                $this->product_model->remove_plan($id);
                $this->session->set_flashdata('msg', $this->my_config->alert('Plan Deleted', 'success'));
                redirect('admin/admin/configuration/plans');
            }
        }

        if (isset($_FILES["site_logo"]) && $_FILES["site_logo"]['name']) { 

            $fileInfo = pathinfo($_FILES["site_logo"]["name"]);
            $img_name = 'site_logo_'.rand().'.' . $fileInfo['extension'];

            $_config['upload_path']          = './uploads/site/';
            $_config['allowed_types']        = 'jpg|png|jpeg';
            $_config['max_size']             = '1500'; 
            $_config['file_name']            = $img_name;
            $_config['file_ext_tolower']     = TRUE;

            $this->upload->initialize($_config);

            if ( ! $this->creative_lib->create_dir($_config['upload_path'])) {
                $this->upload->set_error('upload_unable_to_write_file', 'debug');
                $data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); 
            } else {
                $this->creative_lib->delete_file('./'.$this->my_config->item('site_logo'));
            }

            if ( ! $this->upload->do_upload('site_logo'))
            {
                $data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); 
            }
            else
            {
                $data['upload_data'] = $this->upload->data(); 
                $data_img = array('site_logo' => 'uploads/site/'.$img_name);
                $this->admin_model->save_settings($data_img);
                chmod($_config['upload_path'].'/'.$img_name, 0777);
                $this->creative_lib->resize_image($_config['upload_path'].$img_name, ['width' => 150, 'height' => 150]);
                redirect('admin/admin/configuration');
            }
        }

        $this->load->view('layout/header', $data);        
        $this->load->view('admin/configuration', $data);        
        $this->load->view('layout/footer', $data);  

    } 

    public function logout() 
    {    

        $this->account_data->admin_logout();
        redirect('access/login/admin');       

    }

}
