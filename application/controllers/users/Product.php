<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends User_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->genref = $this->enc_lib->generateToken(5, 1, $this->my_config->item('payment_ref_pref'));
    }

    public function index()
    { 
        $data = $this->account;
        $this->load->view('layout/header', $data);   	 
        $this->load->view('users/account', $data);   	 
        $this->load->view('layout/footer', $data);  
    } 

    public function list()
    { 
        $data = $this->account;
        $data['page_title'] = 'active_products'; 
        $data['use_table'] = TRUE;
        $data['table_method'] = 'list_user_products/'.$data['id'];
        $data['products'] = $this->school_model->fetch($data['id']); 
        $data['fullname'] = $data['name']; 
        $this->load->view('layout/header', $data);       
        $this->load->view('users/products_list', $data);       
        $this->load->view('layout/footer', $data);  
    } 

    public function add()
    {  
        $data['user'] = $this->account;
        $data['products'] = $this->product_model->get(); 
        $data['page_title'] = 'add_product'; 
		$data['fullname'] = $data['user']['name']; 

        if (!isset($_SESSION['payment']['ref'])) 
        {
            $this->session->set_userdata(['payment' => ['ref' => $this->genref]]);
        } 

    	$this->load->view('layout/header', $data);    
		$this->load->view('product/add', $data);  	 
    	$this->load->view('layout/footer', $data);   
    } 

    public function plan($product = null) 
    {    
        $data = $this->account;
        $data['page_title'] = 'choose_plan'; 
		$data['product'] = $this->product_model->get($product); 
		$data['plans'] = $this->product_model->get_plan(); 
        $data['fullname'] = $data['name']; 
 
        if (!isset($_SESSION['payment']['ref'])) 
        {
            $this->session->set_userdata(['payment' => ['ref' => $this->genref]]);
        } 
        
    	$this->load->view('layout/header', $data);    
		$this->load->view('product/plan', $data);  	 
    	$this->load->view('layout/footer', $data);   

    }

    public function payment($product = null, $plan = null, $action = null) 
    {    
        $data = $this->account; 
        $data['fullname'] = $data['name']; 
        $data['page_title'] = 'checkout'; 
 
        if (!isset($_SESSION['payment']['ref'])) 
        {
            $this->session->set_userdata(['payment' => ['ref' => $this->genref]]);
        } 

        $ref = $this->session->userdata('payment')['ref'];

        $data['product'] = $this->product_model->get($product);
        $data['plan'] = $this->product_model->get_plan($plan); 

		if ($this->input->post('product')) {
			$pay = $this->input->post();
            $pay['ref'] = $ref;
			$this->session->set_userdata('payment', $pay); 
			redirect('users/product/payment/'.$product.'/'.$plan.'/'.$action);
		}

        $data['invoice'] = array(
            'date'  => date('Y-m-d H:m:s', strtotime('NOW')),
            'id'    => 'pending',
            'reference' => $ref,
            'description'   => 'Payment for ' . $data['plan']['title'] . ' ' . $data['product']['title'],
            'amount'        => $data['plan']['price'] 
        ); 
        $data['product'] = $this->product_model->get($product);
        $data['payment_id'] = 'pending/'.$product.'/'.$plan;
        $data['load_invoice'] = $this->load->view('product/invoice_inline', $data, TRUE);
        $data['load_summary'] = $this->load->view('product/checkout_summary', $data, TRUE);

    	$this->load->view('layout/header', $data);  
        if ($action !== null) {
            $this->load->view('product/'.$action, $data);  
        } else {
            $this->load->view('product/payment', $data);  
        }	 
    	$this->load->view('layout/footer', $data);    

    }

    public function payment_success() 
    {     
    
        $account = $this->account; 
        $payment = $this->session->userdata('payment');
        $product = $payment['product']; 
        $data = $account; 
        $data['page_title'] = 'payment_success'; 
        $data['fullname'] = $account['name'];

        $check_ref = $payment['ref'] ? $this->product_model->get_payments(['reference' => $payment['ref']]) : ''; 

        if (isset($_SESSION['payment'])) {
            $this->load->library('paystack');
            $verify_pay = $this->paystack->pay($payment['ref']);

            if ($verify_pay->data->status === 'success') 
            {
                if (!$check_ref) 
                { 
                    $data['product']    = $this->product_model->get($product);
                    $data['plan']       = $this->product_model->get_plan($payment['plan']); 
                    $save['reference']  = $payment['ref']; 
                    $save['user_id']    = $account['id']; 
                    $save['product_id'] = $product; 
                    $save['plan_id']    = $payment['plan']; 
                    $save['validity']   = $data['plan']['validity'];
                    $save['amount']     = $data['plan']['price'];
                    $save['description'] = 'Payment for ' . $data['plan']['title'] . ' ' . $data['product']['title']; 
                    $save['expiry']     = date('Y-m-d', strtotime('today + '.$data['plan']['validity']. 'days')); 
                    $data['payment_id'] = $this->product_model->add_payments($save);     
                    if ($data['payment_id']) {
                        $data['invoice'] = $this->product_model->get_payments($data['payment_id']);
                        $data['load_invoice'] = $this->load->view('product/invoice_inline', $data, TRUE);  
                        $this->session->set_flashdata('msg', $this->my_config->alert(ucwords($account['name']).$this->lang->line('payment_proccessed').$data['product']['title'], 'success')); 
                    }
                    unset($_SESSION['payment']);
                } 
                else 
                { 
                    $this->session->set_flashdata('msg', $this->my_config->alert($this->lang->line('payment_already_done'), 'warning'));
                    redirect('users/product/payment_error');    
                }
            } 
            else 
            {
                $this->session->set_flashdata('msg', $this->my_config->alert('<b>'.$verify_pay->data->message. '</b> '.$verify_pay->message, 'danger'));
                redirect('users/product/payment_error');
            }
        } else {
            $this->session->set_flashdata('msg', $this->my_config->alert($this->lang->line('error_processing_payment'), 'danger'));
            redirect('users/product/payment_error');
        }

        $this->load->view('layout/header', $data);    
        $this->load->view('product/payment_success', $data);     
        $this->load->view('layout/footer', $data);   

    }

    public function invoice($id = '', $action = '') 
    {     
        if ($this->uri->segment(7)) {
            $action = $this->uri->segment(7);
        }
        $account = $this->account; 
        $data = $account; 
        if ($id == 'pending') {
            $data['product'] = $this->product_model->get($this->uri->segment(5));
            $data['plan'] = $this->product_model->get_plan($this->uri->segment(6)); 
            $data['invoice'] = array(
                'date'  => date('Y-m-d H:m:s', strtotime('NOW')),
                'id'    => $id,
                'reference' => $this->session->userdata('payment')['ref'],
                'description'   => 'Payment for ' . $data['plan']['title'] . ' ' . $data['product']['title'],
                'amount'        => $data['plan']['price'],
                'product_id'    => $data['product']['id'],
                'plan_id'       => $data['plan']['id']
            );   
        } else {
            $data['invoice'] = $this->product_model->get_payments($id);
        }
        $product = $data['invoice']['product_id']; 
        $data['page_title'] = 'Payment Invoice'; 
        $data['fullname'] = $account['name']; 
        $data['payment_id'] = $id; 

        if ($data['invoice']) { 
            $data['product'] = $this->product_model->get($product);
            $data['plan'] = $this->product_model->get_plan($data['invoice']['plan_id']);      
            $data['load_invoice'] = $this->load->view('product/invoice_inline', $data, TRUE);   
        } else {
            $this->session->set_flashdata('msg', $this->my_config->alert($this->lang->line('error_processing_payment'), 'danger'));
            redirect('errors/error_404');
        }

        if ($action == 'print') {
            $this->load->view('layout/print_header', $data);    
            $this->load->view('product/invoice_inline', $data);     
            $this->load->view('layout/print_footer', $data);  
        } else {
            $this->load->view('layout/header', $data);    
            $this->load->view('product/payment_success', $data);     
            $this->load->view('layout/footer', $data);   
        }

    }

    public function payment_error() 
    {  
		$data = $this->account;  
        $data['page_title'] = 'payment_error'; 
        $data['fullname'] = $data['name'];

    	$this->load->view('layout/header', $data);    
		$this->load->view('product/payment_error', $data);  	 
    	$this->load->view('layout/footer', $data); 

    }

    public function setup($payment_id = null) 
    {  

		$account = $this->account;  
        $payment = $this->product_model->get_payments($payment_id);

        $data = $this->account; 
        $data['page_title'] = 'product_setup'; 
        $data['fullname'] = $account['name'];
        $data['payment_id'] = $payment_id;
		$data['product'] = $this->product_model->get($payment['product_id']);
		$data['plan'] = $this->product_model->get_plan($payment['plan_id']); 


        $this->load->view('layout/header', $data);   
        if ($payment) { 
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    		$this->form_validation->set_rules('name', $data['product']['simple_name'].' Name', 'trim|alpha_numeric_spaces|required|required|is_unique[school.site_name]|min_length[6]'); 
    		$this->form_validation->set_rules('address', 'Address', 'trim|required');  
    		$this->form_validation->set_rules('phone', 'Phone number', 'trim|numeric|required|is_unique[school.phone]|min_length[6]|regex_match[/^[0-9]{11}$/]');  

            if ($this->form_validation->run() === FALSE) { 
    			$this->load->view('product/setup', $data);  	
            } else {
            	$save['user_id'] = $account['id']; 
            	$save['username'] = url_title($this->input->post('name'), '', true); 
                $save['payment_id'] = $payment_id; 
            	$save['address'] = $this->input->post('address'); 
            	$save['site_name'] = $this->input->post('name'); 
            	$save['phone'] = $this->input->post('phone'); 
            	$save['email'] = 'admin@'.$save['username'].'.'.$data['product']['domain']; 
            	$save['site_url'] = $save['username'].'.'.$data['product']['domain']; 
            	$save['product'] = $data['product']['name']; 
    			$save['expiry'] = date('Y-m-d', strtotime('today + '.$data['plan']['validity']. 'days')); 
    			$save['purchase_code'] = $save['sslk'] = $this->license_model->get_unused($data['plan']['validity']);

    			if (!$save['purchase_code']) {				
    				$key =  $this->aes->generate_license();
    				$gen = array( 'key' => $key, 'valid_for' => $data['plan']['validity'] );
    				$this->license_model->add($gen);
    				$save['purchase_code'] = $save['sslk'] = $this->license_model->get_unused($data['plan']['validity']);			
    			} 

    			$setup = $this->school_model->add($save);
    			if ($setup) {
    				$save_licence = $this->license_model->approve($save['username'], $save['purchase_code']); 
        			$this->session->set_flashdata('msg', $this->my_config->alert('Congratulations, your '.$data['product']['simple_name'].' has been setup and would be active withing the next '.$data['product']['setup_time'].' Hours', 'success'));
    				$this->session->unset_userdata('payment'); 
        			redirect('users/account');
    			}	 
            } 
        } else { 
            $this->load->view('layout/page_404');  
        }
        $this->load->view('layout/footer', $data); 
    }

}
