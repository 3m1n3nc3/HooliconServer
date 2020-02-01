<?php 

class MY_Controller extends CI_Controller
{ 

    public function __construct()
    {

        parent::__construct();  
        $this->my_config->item('primary_server');
        $this->ip->save();
        $this->currency     = $this->my_config->item('currency_code');
        $this->cr_symbol    = $this->intl->currency(3, $this->my_config->item('currency_code'));
        $this->frcr_symbol    = $this->my_config->item('currency_symbol');

        if ($this->account_data->logged_in()) $this->admin_logged_in = TRUE;
        if ($this->account_data->user_logged_in()) $this->user_logged_in = TRUE;
    }

}


class Api_Controller extends MY_Controller
{


}

class Access_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();  

    }

}

class Frontsite_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();  

    }

}


class User_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();    
        $this->account_data->is_logged_in_user('user'); 

        $this->is_user = TRUE;

        if ($this->session->has_userdata('username')) {
            $this->account = $this->account_data->fetch($this->session->userdata('username'));
        } elseif (get_cookie('username')) {
            $this->account = $this->account_data->fetch(get_cookie('username'));
        }

    }

}


class Admin_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();    
        $this->account_data->is_logged_in(); 

        $this->is_admin = TRUE;

        if ($this->session->has_userdata('admin')) {
            $this->account = $this->account_data->fetch($this->session->userdata('admin'), 1);
        } elseif (get_cookie('admin')) {
            $this->account = $this->account_data->fetch(get_cookie('admin'), 1);
        }
 
    }

}
