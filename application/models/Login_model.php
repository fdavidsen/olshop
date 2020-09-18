<?php 

class Login_model extends CI_Model {
	/**
	 * # 1
	 * Verify username and password.
	 * Create cookie for remember me.
	 * 
	 * @link Login (controller) # 1
	 */
	public function login() {
		$username = $this->input->post('username', TRUE);
	  $password = $this->input->post('password', TRUE);
	  $rememberMe = $this->input->post('rememberMe', TRUE);

	  $this->db->where('username', $username);
	  $query = $this->db->get('admin')->row_array();

	  // Check username
	  if (! $query) {
	  	$this->session->set_flashdata('status', 'Incorrect username!');
	  	redirect('login');
	  }

	  // Check password
		if (password_verify($password, $query['password'])) {
			$id = $query['id'];
			$key = hash('sha1', uniqid());

			$this->db->where('id', $id);
			$this->db->update('admin', ['login_key' => $key]);

			if (! is_null($rememberMe)) {
				set_cookie('admin', $key, time() + pow(10, 10));
			}

			$data = array(
				'id' => $id,
				'admin' => TRUE
			);
			$this->session->set_userdata($data);
			redirect('manage');
		} else {
			$this->session->set_flashdata('status', 'Incorrect password!');
			redirect('login');
		}
	}

	/**
	 * # 2
	 * Verify cookie with login key from database.
	 * Delete session and cookie if key doesn't match.
	 * 
	 * @link header (view)
	 */
	public function checkLoginCookie() {
		$key = $_COOKIE['admin'];
		$this->db->where('login_key', $key);
		$query = $this->db->get('admin')->row_array();

		if (! is_null($query)) {
			$data = array(
				'id' => $query['id'],
				'admin' => TRUE
			);
			$this->session->set_userdata($data);
		} else {
			$this->session->sess_destroy();
			delete_cookie('admin');
		}
	}
}