<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cpanel'); 
    }

    public function index()
    {

    } 

    public function install($product = '', $set_step = NULL) 
    {   
        $product = $this->school_model->get($product); 

        if (!$product) 
        {
            redirect('errors/error_404');
        }

        $user = $this->user_model->get($product['user_id']);

        $view_data['username'] = @$user['email'];
        $view_data['site_url'] = $product['site_url'];
        $view_data['site_username'] = $product['username'];
 
        // Generate a random charactered random password
        $password = $this->enc_lib->get_random_password(10, 10, true, true, true);

        // Commit the generated password to a session
        if (!isset($_SESSION['password'])) 
        {
            $this->session->set_userdata('password', $password);
        }

        // Parse the password session to the view
        $view_data['password'] = $password;//$this->session->userdata('password');

        // Check if this is a test site
        $db_name = '';
        if ($this->my_config->item('live_site')) 
        {
            $db_name = $this->my_config->item('db_prefix') . $product['username'];

            $args = array('name' => $db_name);

            // Check if the database does not exists
            if (!$this->cpanel->mysql($args, 'check_database')) 
            {
                // Create a new database
                $this->cpanel->mysql($args, 'create_database');

                // Set the users privileges on the new table
                $prevl = array(
                    'user' => $this->db->username, 
                    'database' => $db_name,
                    'privileges' => 'ALL PRIVILEGES'
                );

                $this->cpanel->mysql($prevl, 'set_privileges_on_database');
            }

            // Start the MySQLi Connection            
            $link = @mysqli_connect($this->db->hostname, $this->db->username, $this->db->password, $db_name);
        }
        else
        {
            // Start the MySQLi Connection
            $link = @mysqli_connect($this->db->hostname, $this->db->username, $this->db->password);
        }

        $view_data['username'] = @$user['email'];
        $this->error = $view_data['error'] = '';
        $view_data['page_title'] = 'Installation';
        $view_data['config_path'] = APPPATH . 'config/config.php';
        $view_data['debug'] = '';
        $view_data['step'] = 1;
        $view_data['passed_steps'] = array(
            1 => false,
            2 => false,
            3 => false,
            4 => false,
            5 => false,
        );

        if (!$link) {
            $this->error .= "Error: Unable to connect to MySQL Database '" . $db_name . "'." . PHP_EOL;
            $view_data['db_error'] = $this->error;
        } else {
            $view_data['debug'] .= "Success: Connection to " . $this->input->post('database') . " database is done successfully."; 
        }

        if (isset($view_data['db_error'])) 
        {
            $view_data['step'] = 1;
        }
        
        if ($product && ($this->input->post() || isset($_SESSION['step']) || $set_step)) 
        {
            if ($this->input->post('requirements_success') || $this->input->post('step') == 2)
            {
                $view_data['page_title'] = 'Database Installation';
                $view_data['passed_steps'][1] = true;
                $view_data['passed_steps'][2] = true;
                $view_data['step'] = 2;
            }

            if ($this->error === '' && ($this->input->post('step') == 2 || isset($_SESSION['step']) || $set_step == 2)) 
            { 
                if ($this->input->post('admin_password')) 
                { 
                    $this->form_validation->set_error_delimiters('<div class="text-danger"><small>', '</small></div>');
                    $this->form_validation->set_rules('admin_password', 'Password', 'trim|required|matches[admin_passwordr]');
                    $this->form_validation->set_rules('admin_passwordr', 'Confirm password', 'trim|required');

                    if ($this->form_validation->run() !== FALSE) 
                    { 
                        $this->session->set_userdata('step', $this->input->post('step'));

                        $admin_password = $this->input->post('admin_password');

                        $password_hash = $this->enc_lib->passHashEnc($admin_password);
                        $query = file_get_contents(APPPATH . 'controllers/admin/database.sql');

                        $insert = array(
                            $product['username'],
                            $product['username'],
                            $user['email'],
                            $password_hash
                        );
                        $database = vsprintf($query, $insert);
                        // $db_created = 1;

                        if (mysqli_multi_query($link, $database)) 
                        {
                            $this->clean_up_db_query($link);
                            mysqli_close($link);  
                            $db_created = 1;
                        }

                        // sleep for 120 seconds
                        sleep(120);
                        
                        if (isset($db_created)) 
                        {
                            $upd_data = array('default_password' => $admin_password, 'installed' => 1);
                            $this->db->where('id', $product['id']);
                            $this->db->update('school', $upd_data);
                            redirect('admin/operation/install/hooliconschools/2');
                        }
                    }
                }

                if ($product['installed'] && ($this->input->post('step') == 2 || $this->session->userdata('step') == 2 || $set_step == 2))
                {   
                    $view_data['page_title'] = 'Database Installation Complete';
                    $view_data['passed_steps'][1] = true;
                    $view_data['passed_steps'][2] = true;
                    $view_data['passed_steps'][3] = true;
                    $view_data['step'] = 3;

                    if (isset($_SESSION['step'])) $this->session->unset_userdata('step'); 
                    if (isset($_SESSION['password'])) $this->session->unset_userdata('password'); 
                }

            } else {
                $view_data['error'] = $this->error;
            }
        } else {
            if ($this->input->post()) $view_data['error'] = "Error: The product does not exist." . PHP_EOL;
        }
        $this->load->view('admin/install/install', $view_data);   
    } 

    public function database_installer($product = '') 
    {
        $product = $this->school_model->get($product); 
        $user = $this->user_model->get($product['user_id']);

        $db_name = '';
        if ($product) 
        {
            $db_name = $this->my_config->item('db_prefix') . $product['username'];

            $args = array('name' => $db_name);

            // Check if the database does not exists
            if (!$this->cpanel->mysql($args, 'check_database')) 
            {
                // Create a new database
                $this->cpanel->mysql($args, 'create_database');

                // Set the users privileges on the new table
                $prevl = array(
                    'user' => $this->db->username, 
                    'database' => $db_name,
                    'privileges' => 'ALL PRIVILEGES'
                );

                $this->cpanel->mysql($prevl, 'set_privileges_on_database');
            }

            // Start the MySQLi Connection            
            $link = @mysqli_connect($this->db->hostname, $this->db->username, $this->db->password, $db_name);

            // Validate the received input
            $this->form_validation->set_rules('admin_password', 'Password', 'trim|required|matches[admin_passwordr]');
            $this->form_validation->set_rules('admin_passwordr', 'Confirm password', 'trim|required');

            // if ($this->form_validation->run() !== FALSE) 
            if (!$this->input->post('admin_password')) 
            {
                echo json_encode(array('status' => '0', 'msg' => 'Password is required'), JSON_FORCE_OBJECT); 
            }
            elseif (!$this->input->post('admin_passwordr')) 
            {
                echo json_encode(array('status' => '0', 'msg' => 'Confirm Password is required'), JSON_FORCE_OBJECT);
            }
            elseif ($this->input->post('admin_password') !== $this->input->post('admin_passwordr'))
            {
                echo json_encode(array('status' => '0', 'msg' => 'Password and Confirm Password do not match'), JSON_FORCE_OBJECT);
            }
            else
            {  
                $admin_password = $this->input->post('admin_password');

                // Encode the password
                $password_hash = $this->enc_lib->passHashEnc($admin_password);
                $query = file_get_contents(APPPATH . 'controllers/admin/database.sql');

                $insert = array(
                    $product['username'],
                    $product['username'],
                    $user['email'],
                    $password_hash
                );
                $database = vsprintf($query, $insert);
                // $db_created = 1;

                // Run the database query
                if (mysqli_multi_query($link, $database)) 
                {
                    $this->clean_up_db_query($link);
                    mysqli_close($link);  
                    $db_created = 1;
                } 
                
                // Update the installation status
                if (isset($db_created)) 
                {
                    $upd_data = array('default_password' => $admin_password, 'installed' => 1);
                    $this->db->where('id', $product['id']);
                    $this->db->update('school', $upd_data);
                    echo json_encode(array('status' => '1', 'msg' => 'Database Successfully installed'), JSON_FORCE_OBJECT);
                } 
                else 
                {
                    // Installation error
                    echo json_encode(array('status' => '0', 'msg' => 'Unable to install Database'), JSON_FORCE_OBJECT);
                }
            }
            // else
            // { 
            //     // Password and inout error
            //     echo json_encode(array('status' => '0', 'msg' => validation_errors('<div class="text-danger"><small>', '</small></div>')), JSON_FORCE_OBJECT);
            // }
        }
        else
        {
            // Unknown product error
            echo json_encode(array('status' => '0', 'msg' => 'Unknown Product'), JSON_FORCE_OBJECT);
        }
    }

    public function propagate_domain($product = '') 
    {  

        $is_error = 0;
        $product = $this->school_model->get($product); 
        $user = $this->user_model->get($product['user_id']); 

        $view_data['username']      = @$user['email'];
        $view_data['site_url']      = $product['site_url'];
        $view_data['site_email']    = $product['email'];
        $email_to_generate          = explode('@', $product['email'])[0]; 

        $password = $this->enc_lib->get_random_password($chars_min = 7, $chars_max = 7, $use_upper_case = true, $include_numbers = true);

        $view_data['password'] = $password;
        $view_data['site_username'] = $product['username'];

        $view_data['passed_steps'] = array(
            1 => false,
            2 => false,
            3 => false,
            4 => false,
            5 => false,
        );
        $view_data['page_title'] = 'Propagate Domain';
        $view_data['debug'] = '';
        $view_data['status'] = 0;
        $view_data['error'] = null;
        $view_data['passed_steps'][1] = true;
        $view_data['passed_steps'][2] = true;
        $view_data['passed_steps'][3] = true;
        $view_data['passed_steps'][4] = true;
        $view_data['step'] = 4;

        if ($this->input->post('step') && $this->input->post('step') == 4) 
        {
            $view_data['page_title'] = 'Installation Complete';

            if ($this->input->post('domain') && $view_data['status'] == 0) 
            { 
                $gen_email = $this->input->post('gen_email'); // 1 / 0 / NULL
                $propagate_domain = $this->prop_domain($product, $gen_email);

                if ($propagate_domain['set_error']) 
                {
                    $view_data['error'] = $propagate_domain['error']; 
                } 

                if ($view_data['error']) 
                {
                    $view_data['error'][] .= 'Error: You can not fix this errors from here, you will have to update the product data and fix the errors manually from your admin dashboard.';
                }
                if (!$view_data['error']) 
                {
                    $view_data['step'] = 5;  
                }
            } 
        } 
        elseif ($this->input->post('step') && $this->input->post('step') == 5) 
        {
            $view_data['passed_steps'][1] = true;
            $view_data['passed_steps'][2] = true;
            $view_data['passed_steps'][3] = true;
            $view_data['passed_steps'][4] = true;
            $view_data['passed_steps'][5] = true;
            $view_data['step'] = 5;
        }

        $this->load->view('admin/install/install', $view_data);  
    } 

    public function manual_propagation($product = '', $action = '') 
    {  
        $account = $this->account;
        $data                  = $account;
        $view_data['fullname'] = $account['name'];

        if ($action == 'email') 
        {
            $view_data['page_title'] = 'propagate_email';
        } 
        else 
        {
            $view_data['page_title'] = 'propagate_domain';
        }

        $is_error = 0;
        $product = $this->school_model->get($product); 
        $user = $this->user_model->get($product['user_id']); 

        $view_data['site_name']     = $product['site_name'];
        $view_data['product_id']    = $product['id'];
        $view_data['action']        = $action;
        $view_data['username']      = @$user['email'];
        $view_data['site_url']      = $product['site_url'];
        $view_data['site_email']    = $product['email'];
        $view_data['prop_url']      = explode('.', $product['site_url'])[0]; 
        $view_data['prop_email']    = explode('@', $product['email'])[0]; 

        $gen_password = $this->enc_lib->get_random_password($chars_min = 7, $chars_max = 7, $use_upper_case = true, $include_numbers = true);
        if ($product['default_password']) 
        {
            $password = $product['default_password'];
        } 
        else 
        { 
            $this->db->where('id', $product['id']);
            $this->db->update('school', array('default_password' => $gen_password));
            $password = $gen_password;
        }

        $view_data['password'] = $password;
        $view_data['site_username'] = $product['username'];
        $view_data['debug'] = '';
        $view_data['status'] = 0;
        $view_data['error'] = null;

        if ($this->input->post('domain') && $view_data['status'] == 0) {

            $gen_email = $this->input->post('gen_email'); // 1 / 0 / NULL

            $propagate_domain = $this->prop_domain($product, $gen_email);

            if ($propagate_domain['set_error']) {
                $view_data['error'] = $propagate_domain['error']; 
            } else {
                $this->session->set_flashdata('msg', $this->my_config->alert($product['site_url'].' Has successfully propagated', 'success'));
            }
        } elseif ($this->input->post('email') && $view_data['status'] == 0) {
            $propagate_email = $this->prop_email($product, 1);

            if ($propagate_email['set_error']) {
                $view_data['error'] = $propagate_email['error'];
            } else {
                $this->session->set_flashdata('msg', $this->my_config->alert($product['email'].' Has successfully propagated', 'success'));
            }
        } 
        if ($view_data['error']) {
            $view_data['error'][] .= 'Error: Check your error logs for more info.';
        }

        $this->load->view('layout/header', $view_data);  
        $this->load->view('admin/product/manual_propagation', $view_data);  
        $this->load->view('layout/footer', $view_data);  
    } 

    public function prop_domain($product = array(), $prop_email = 0)
    {
        $data['set_error']  = '0';
        $data['error']      = [];
        $data['status']     = '0'; 
        $args = array(
            'domain'=> explode('.', $this->input->post('domain'))[0], 
            'rootdomain'=> $this->my_config->item('primary_server'), 
            'dir'=>'/public_html/'.$this->my_config->item('server_dir')
        );

        $propagate_domain = $this->cpanel->subdomain($args);

        if ($propagate_domain) {
            
            $this->product_model->delete_errors(['product_id' => $product['id'], 'code' => 'server']);

            if ($propagate_domain->status === 1) {

                $data['status'] = '1'; 
                $this->product_model->delete_errors(['product_id' => $product['id'], 'code' => 'domain']);
                $this->db->where('id', $product['id']);
                $this->db->update('school', array('site_url' => $args['domain'].'.'.$args['rootdomain']));
                if ($prop_email) { 
                    $propagate_email = $this->prop_email($product);
                    if ($propagate_email['set_error']) {
                        $data['error'][] .= $propagate_email['error'];
                    }
                }

            } else {
                if ($propagate_domain->errors) {
                    $errtxt = '';
                    foreach ($propagate_domain->errors as $error_) {
                        $errtxt .= $error_;
                        $err = array('product_id' => $product['id'], 'error_text' => $errtxt, 'code' => 'domain');
                        $this->product_model->add_errors($err);
                    }
                    $data['error'][] = $errtxt;
                    $data['set_error'] = '1';
                }
            }
        } else {
            $errtxt = 'Error: No response from server.';
            $err = array('product_id' => $product['id'], 'error_text' => $errtxt, 'code' => 'server');
            $this->product_model->add_errors($err); 
            $data['error'][] .= $errtxt;
            $data['set_error'] = '1';
        }     
        return $data;   
    }

    public function prop_email($product = array())
    {   
        $data['set_error']  = '0';
        $data['error']      = [];
        $data['status']     = '0';
        $post_email = $this->input->post('email');
        if (isset($post_email)) {
            $email_username = $post_email;
        } else {
            $email_username = $product['email'];
        }
        $post_domain = $this->input->post('domain');
        if (isset($post_domain)) {
            $subdomain = $this->input->post('domain');
        } else {
            $subdomain = $product['site_url'];
        }
        $email_to_generate =  explode('@', $email_username)[0];
        $subdomain = explode('.', $subdomain)[0];
        $args = array(
            'email'     => $email_to_generate, 
            'password'  => $product['default_password'], 
            'domain'    => $subdomain . '.' . $this->my_config->item('primary_server')
        );

        $propagate_email = $this->cpanel->email($args);
        if ($propagate_email) { 
            
            $this->product_model->delete_errors(['product_id' => $product['id'], 'code' => 'server']);

            if ($propagate_email->status === 1) {
                $data['status'] = '1'; 
                $this->product_model->delete_errors(['product_id' => $product['id'], 'code' => 'email']);
                $this->db->where('id', $product['id']);
                $this->db->update('school', array('email' => $args['email'].'@'.$args['domain']));
            } elseif ($propagate_email->status === 0 && $propagate_email->errors) {
                $errtxt = '';
                foreach ($propagate_email->errors as $error_) {
                    $errtxt .= $error_;
                    $err = array('product_id' => $product['id'], 'error_text' => $errtxt, 'code' => 'email');
                    $this->product_model->add_errors($err);
                }
                $data['error'][] = $errtxt;
                $data['set_error'] = '1';
            }     
        } else {
            $errtxt = 'Error: No response from server.';
            $err = array('product_id' => $product['id'], 'error_text' => $errtxt, 'code' => 'server');
            $this->product_model->add_errors($err); 
            $data['error'][] .= $errtxt;
            $data['set_error'] = '1';
        }   
        return $data;   
    }

    private function clean_up_db_query($conn_id) { 
        while (mysqli_more_results($conn_id) && mysqli_next_result($conn_id)) {
            $dummyResult = mysqli_use_result($conn_id);
            if ($dummyResult instanceof mysqli_result) {
                mysqli_free_result($conn_id);
            }
        }
    }     

    public function logout() 
    {    
        $this->account_data->user_logout();
        redirect('access/login/admin');       

    }
}
