<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends User_Controller{

    function __construct() {
        parent::__construct();

        $this->time = strtotime(date('d-m-Y H:i:s'));
    }

    function invoice($id = '') {
        $data = []; 
        $invoice = $this->product_model->get_payments($id);
        $data = $this->account_data->fetch($invoice['user_id']); 
        $data['invoice'] = $invoice;
        $data['page_title'] = 'Payment Invoice'; 
        $data['fullname'] = $data['name']; 
        $data['payment_id'] = $id; 
        $data['dontprint'] = TRUE; 

        if ($data['invoice']) { 
            $data['product'] = $this->product_model->get($data['invoice']['product_id']);
            $data['plan'] = $this->product_model->get_plan($data['invoice']['plan_id']);      
            $data['load_invoice'] = $this->load->view('product/invoice_inline', $data, TRUE);   
        
            $html = $this->load->view('layout/print_header', $data, true);
            $html .= $this->load->view('product/invoice_inline', $data, true);
            $html .= $this->load->view('layout/print_footer', $data, true);
            $pdfFilePath = $this->time . ".pdf";
            // $this->load->library('m_pdf');
            // $this->m_pdf->pdf->WriteHTML($html);
            // $this->m_pdf->pdf->Output($pdfFilePath, "D");
        }
    }

}
