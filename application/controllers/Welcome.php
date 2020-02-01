<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Frontsite_Controller {
	
	public function index()
	{	
		$data['slides'] = $this->content_model->get(['type' => 'main_slides']);
		$data['about'] = $this->content_model->get(['type' => 'about'], true);
		$data['services'] = $this->content_model->get(['type' => 'services']);
		$data['products'] = $this->content_model->get(['type' => 'products']);
		$data['partners'] = $this->content_model->get(['type' => 'partners']);
		$data['team'] = $this->content_model->get(['type' => 'team']);
		$data['parallax'] = $this->content_model->get(['type' => 'parallax'], true);
		$data['parallax_one'] = $data['parallax']['image'];

		$this->load->view('layout/frontsite/header', $data);
		$this->load->view('frontsite/homepage', $data);
		$this->load->view('layout/frontsite/footer', $data);
	}
	
	public function details($id = '', $static_page = '')
	{	
		$data['fix_nav'] = true;
		$data['static'] = $static_page;
		if ($id == 'static') {
			$data['content'] = $this->content_model->get(['type' => $static_page], true);
		}	else {
			$data['content'] = $this->content_model->get($id);
		}
		if ($data['content']) { 
			$data['page_title'] = $data['content']['title'];
			$this->load->view('layout/frontsite/header_clickable', $data);
			$this->load->view('frontsite/details', $data);
			$this->load->view('layout/frontsite/footer', $data);
		} else {
			redirect('errors/error_404');
		}
	}
}
