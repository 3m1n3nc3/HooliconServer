<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontsite extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
        $data['page_title'] = 'frontsite';
        $data['content'] = $this->content_model->get(); 
        $data['use_table'] = TRUE; 
        $data['table_method'] = 'public_content';
        $this->load->view('layout/header', $data);  
        $this->load->view('admin/frontsite/home', $data); 	     
        $this->load->view('layout/footer', $data);  
    }  

    public function add_content($id = '', $action = 'create')
    {	
        $data = $this->content_model->get($id);  
        $data['sections'] = $this->content_model->get_sections();  
        $data['page_title'] = 'frontsite';

        if ($action == 'create') {
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->form_validation->set_rules('value[title]', 'Title', 'trim|alpha_numeric_spaces|required|min_length[6]'); 
            $this->form_validation->set_rules('value[subtitle]', 'Subtitle', 'trim|min_length[3]'); 
            $this->form_validation->set_rules('value[content]', 'Content', 'trim|min_length[10]'); 
            $this->form_validation->set_rules('value[details]', 'Details', 'trim'); 
            $this->form_validation->set_rules('value[type]', 'Type', 'trim|callback_duplicate_check['.($id ? $id : 'save').']'); 
            
            if ($this->form_validation->run() !== FALSE) { 

                $save = $this->input->post('value');
                if ($id) {
                    $save['id'] = $id;
                }
                if (isset($_FILES["content_image"]) && $_FILES["content_image"]['name']) { 

                    $fileInfo = pathinfo($_FILES["content_image"]["name"]);
                    $extension = isset($fileInfo['extension']) ? $fileInfo['extension'] : 'nulled';
                    $img_name = mt_rand().'_'.mt_rand().'_'.mt_rand().'_c.' . $extension;

                    $_config['upload_path']          = './uploads/content/';
                    $_config['allowed_types']        = 'jpg|png|jpeg|mp4';
                    if ($extension === 'mp4') {
                        $_config['max_size']         = '15000'; 
                    } else {
                        $_config['max_size']         = '1500'; 
                    }
                    $_config['file_name']            = $img_name;
                    $_config['file_ext_tolower']     = TRUE;

                    $this->upload->initialize($_config);

                    if ( ! $this->creative_lib->create_dir($_config['upload_path'])) {
                        $this->upload->set_error('upload_unable_to_write_file', 'debug');
                        $data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); 
                    } else {
                        if (isset($data['image'])) {
                            $this->creative_lib->delete_file('./'.$data['image']);
                        }
                    }

                    if ( ! $this->upload->do_upload('content_image'))
                    {
                        $data['upload_error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); 
                    }
                    else
                    {
                        $data['upload_data'] = $this->upload->data(); 
                        $save['image'] = 'uploads/content/'.$img_name; 
                        chmod($_config['upload_path'].'/'.$img_name, 0777);
                        $this->creative_lib->resize_image($_config['upload_path'].$img_name, ['width' => 1500, 'height' => 1500]);
                    }
                }

                if (!isset($data['upload_error'])) {
                    $insert = $this->content_model->add($save); 
                    $done = $id ? 'updated' : 'created';
                    $this->session->set_flashdata('msg', $this->my_config->alert('Content has been ' . $done, 'success'));
                    if ($insert) {
                        redirect('admin/frontsite/add_content/'.$insert.'/'.$action);
                    }
                }
            }
        } elseif ($action == 'section') {
            $data['id'] = $id;
            $section = $this->input->post('section');
            if ($section) {
                redirect('admin/frontsite/add_content/'.$section.'/'.$action);
            }
            $sid = (filter_var($id, FILTER_VALIDATE_INT) ? $id : ['name' => $id]);
            $data['section'] = $this->content_model->get_sections($sid, true);

            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->form_validation->set_rules('val[title]', 'Title', 'trim|required|min_length[4]'); 
            $this->form_validation->set_rules('val[content]', 'Content', 'trim|required|min_length[10]'); 

            if ($this->form_validation->run() != FALSE) { 
                $save = $this->input->post('val');
                if ($save) { 
                    if (isset($data['section']['id'])) {
                        $save['id'] = $data['section']['id'];
                    }
                    $save['name'] = ($id && $id !== 'set' && !$data['section'] ? $id : ($data['section'] ? $data['section']['name'] : url_title($save['title'], '_', true))); 
                    $insert = $this->content_model->add_sections($save); 
                    $done = isset($save['id']) ? 'updated' : 'created';
                    $this->session->set_flashdata('msg', $this->my_config->alert('Section has been ' . $done, 'success'));
                    if ($insert) {
                        redirect('admin/frontsite/add_content/'.$insert.'/'.$action);
                    }
                }
            }
        } elseif ($action == 'contact') {

            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->form_validation->set_rules('contact[contact_email]', 'Email', 'trim|required|valid_email|min_length[4]'); 
            $this->form_validation->set_rules('contact[contact_phone]', 'Phone', 'trim|required|regex_match[/^[0-9]{11}$/]'); 
            $this->form_validation->set_rules('contact[contact_address]', 'Address', 'trim|required|min_length[10]'); 
            if ($this->form_validation->run() != FALSE) {  
                $this->admin_model->save_settings($this->input->post('contact'));
                $this->session->set_flashdata('msg', $this->my_config->alert('Contact information updated', 'success')); 
            }
        }

        $this->load->view('layout/header', $data);  
        $this->load->view('admin/frontsite/create_content', $data);      
        $this->load->view('layout/footer', $data);  
	}

    public function duplicate_check($str, $action = '')
    {   
        $data = $this->content_model->get(['type' => $str], true);
        if ($data && $data['id'] != $action && ($str == 'about' || $str == 'parallax'))
        {
            $this->form_validation->set_message('duplicate_check', 'You can only have one content with {field} set as "'.$str.'"');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
