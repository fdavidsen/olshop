<?php 

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * # 1
	 * Index Page for this controller.
	 * Login page for admin.
	 * 
	 * @link Login (model) # 1
	 */
	public function index() {
		$data['title'] = 'Log In';
		
		if ($this->input->post()) {
	    $this->Login_model->login();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('login/index');
		$this->load->view('templates/footer');
	}

	/**
	 * # 2
	 * Clear session and cookie (logout).
	 */
	public function logout() {
		$this->session->sess_destroy();
		delete_cookie('admin');
		redirect('login');
	}
}