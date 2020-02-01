<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function delete()
    {   
        $delete = null;
        $data = $this->input->post('data');
        $type = $data['type'];
        $id = $data['id'];

        if ( $type == 'product' ) 
        {
            $delete = $this->school_model->remove($id);
        }
        elseif ($type == 'user') 
        {
            $data = $this->account_data->fetch($id);
            if (isset($data['image'])) {
                $this->creative_lib->delete_file('./'.$data['image']);
            }
            $this->school_model->remove(['user_id' => $id]);
            $this->product_model->remove_payments(['user_id' => $id]);
            $delete = $this->user_model->remove($id);
        }
        elseif ($type == 'content') 
        { 
            $data = $this->content_model->get($id); 
            if (isset($data['image'])) {
                $this->creative_lib->delete_file('./'.$data['image']);
            }
            $delete = $this->content_model->remove($id);
        }

        if ($delete) 
        {
            $response = array('status' => 1, 'msg' => 'Your '.$type.' has been deleted successfully');
        } 
        else {
            $response = array('status' => 0, 'msg' => 'Your '.$type.' could not be deleted');
        }

        echo json_encode($response);
    } 

}
