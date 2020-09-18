<?php 

class Contact extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Manage_model');
		$this->load->model('Contact_model');
	}

	/**
	 * # 1
	 * Index Page for this controller.
	 * Page for showing contact info.
	 * 
	 * @link Contact (model) # 1
	 * @link Manage (model) # 0.1
	 */
	public function index() {
		$data = array(
			'title' => 'Contact',
			'contact' => $this->Contact_model->getContact()
		);
		
		if ($this->session->userdata('admin') == TRUE) {
			$data['admin'] = $this->Manage_model->getAdminData();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('contact/index', $data);
		$this->load->view('templates/footer');
	}
}