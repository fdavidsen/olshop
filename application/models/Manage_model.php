<?php 

class Manage_model extends CI_Model {
	/**
	 * # 0.1
	 * Get admin data that currently log in.
	 * 
	 * @link Manage (controller) # 1
	 * @link Manage (controller) # 2.1
	 * @link Manage (controller) # 2.2.1
	 * @link Manage (controller) # 2.3
	 * @link Manage (controller) # 3.1
	 * @link Manage (controller) # 4.1
	 * @link Manage (controller) # 5
	 * @link Manage (controller) # 6.1
	 * @link Manage (controller) # 6.2.2
	 * @link Manage (controller) # 7
	 * @link Manage (controller) # 8
	 * @link Manage (model) # 4
	 * @link Manage (model) # 5
	 * @link Contact (controller) # 1
	 * @link Home (controller) # 1
	 * @return array => admin data.
	 */
	public function getAdminData() {
		$this->db->where('id', $this->session->userdata('id'));
		return $this->db->get('admin')->row_array();
	}

	/**
	 * # 0.2
	 * Check if username has been claimed when user
	 * changes username or promote new admin.
	 * 
	 * @link Manage (model) # 4
	 * @link Manage (model) # 7
	 * @param string $username => username that being query.
	 * @return array => record if exist.
	 */
	private function checkUsername($username) {
		$this->db->where('username', $username);
		return $this->db->get('admin')->row_array();
	}

	/**
	 * # 0.3
	 * Add number of action on currently log in admin.
	 * 
	 * @link Manage (model) # 1
	 * @link Manage (model) # 2.2.1.1
	 * @link Manage (model) # 2.2.1.2
	 * @link Manage (model) # 2.3.2
	 * @link Manage (model) # 2.4
	 * @link Manage (model) # 2.5
	 * @link Manage (model) # 2.6
	 * @param string $type => type of action as field to increment in database.
	 */
	private function incrementAction($type) {
		$this->db->where('id', $this->session->userdata('id'));

		if ($type == 'add') {
			$field = 'addition';
		} else if ($type == 'edit') {
			$field = 'edit';
		} else if ($type == 'delete') {
			$field = 'deletion';
		}
		$this->db->set($field, $field . '+ 1', FALSE);
		$this->db->update('admin');
	}

	/**
	 * # 1
	 * > PRODUCT
	 * Add new product and its informations.
	 * 
	 * @link Manage (controller) # 1
	 * @param array $mediaProperty => informations of uploaded products' media.
	 */
	public function newProduct($mediaProperty) {
		$name = $this->input->post('name', TRUE);
		$category = $this->input->post('category', TRUE);
		$price = $this->input->post('price', TRUE);
    $description = $this->input->post('description', TRUE);

		if ($price == '') $price = '-';

    $data = array(
    	'name' => $name,
			'category' => strtolower($category),
			'price' => $price,
	    'description' => $description
    );
    $this->db->insert('product', $data);
    $productId = $this->db->insert_id();

    foreach ($mediaProperty as $item) {
    	$data = array(
    		'product_id' => $productId,
    		'file_name' => $item['file_name'],
    		'type' => $item['type']
    	);
    	$this->db->insert('product_library', $data);
    }

	  if ($this->db->affected_rows() > 0) {
	  	$this->incrementAction('add');
			$this->session->set_flashdata('status', 'Successfully created!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was created!');
		}
    redirect('manage');
	}

	/**
	 * # 2.1
	 * > PRODUCT
	 * Get all available products in descending order (to latest).
	 * 
	 * @link Manage (controller) # 2.1
	 * @link Home (controller) # 1
	 * @return array => all available products.
	 */
	public function getAllProducts() {
		$this->db->order_by('id', 'DESC');
		return $this->db->get('product')->result_array();
	}

	/**
	 * # 2.2.1.1
	 * > PRODUCT
	 * Edit products' information.
	 * 
	 * @link Manage (controller) # 2.2.1
	 * @param int $id => id of selected product.
	 */
	public function editProductInfo($id) {
		$name = $this->input->post('name', TRUE);
		$category = $this->input->post('category', TRUE);
		$price = $this->input->post('price', TRUE);
		$description = $this->input->post('description', TRUE);

		if ($price == '') $price = '-';

		$data = array(
			'name' => $name,
			'category' => $category,
			'price' => $price,
			'description' => $description
		);
		$this->db->where('id', $id);
		$this->db->update('product', $data);

		if ($this->db->affected_rows() > 0) {
			$this->incrementAction('edit');
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was updated!');
		}
    redirect('manage/editProduct/' . $id);
	}

	/**
	 * # 2.2.1.2
	 * > PRODUCT
	 * Get all available products in descending order (to latest).
	 * 
	 * @link Manage (controller) # 2.2.1
	 * @link Manage (controller) # 2.3
	 * @link Home (controller) # 3
	 * @param int $id => id of selected product.
	 * @return array => information of selected product.
	 */
	public function getProduct($id) {
		$this->db->where('id', $id);
		return $this->db->get('product')->row_array();
	}

	/**
	 * # 2.2.2
	 * > PRODUCT
	 * Add first file to selected product if there's no one before.
	 * 
	 * @link Manage (controller) # 2.2.2
	 * @param int $id => id of selected product.
	 * @param array $data => information of added file.
	 */
	public function addFirstFile($id, $data) {
		$this->db->insert('product_library', $data);

		if ($this->db->affected_rows() > 0) {
			$this->incrementAction('add');
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was updated!');
		}
	}

	/**
	 * # 2.3.1
	 * > PRODUCT
	 * Get all products' media.
	 * 
	 * @link Manage (controller) # 2.2.1
	 * @link Manage (controller) # 2.3
	 * @link Manage (controller) # 2.6
	 * @link Home (controller) # 3
	 * @param int $id => id of selected product.
	 * @return array => media of selected product.
	 */
	public function getProductLibrary($id) {
		$this->db->where('product_id', $id);
		return $this->db->get('product_library')->result_array();
	}

	/**
	 * # 2.3.2
	 * > PRODUCT
	 * Get all products' media.
	 * 
	 * @link Manage (controller) # 2.3
	 * @param int $productId 			 => id of selected product.
	 * @param array $mediaProperty => informations of uploaded products' media.
	 */
	public function uploadNewLibrary($productId, $mediaProperty) {
		foreach ($mediaProperty as $item) {
			$data = array(
				'product_id' => $productId,
				'file_name'=> $item['file_name'],
				'type' => $item['type']
			);
			$this->db->insert('product_library', $data);
		}

		if ($this->db->affected_rows() > 0) {
			$this->incrementAction('add');
			$this->session->set_flashdata('status', 'Successfully uploaded!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was uploaded!');
		}
		redirect('manage/editProductLibrary/' . $productId);
	}

	/**
	 * # 2.4
	 * > PRODUCT
	 * Change media file of selected product.
	 * 
	 * @link Manage (controller) # 2.4
	 * @param int $id  => id of selected product.
	 * @param array $d => informations of uploaded product's file.
	 */
	public function changeLibraryFile($id, $d) {
		$data = array(
			'file_name' => $d['fileName'],
			'type' => $d['type']
		);

		$this->db->where('id', $id);
		$this->db->update('product_library', $data);

		if ($this->db->affected_rows() > 0) {
			$this->incrementAction('edit');
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was updated!');
		}
	}

	/**
	 * # 2.5
	 * > PRODUCT
	 * Delete selected file's information.
	 * 
	 * @link Manage (controller) # 2.5
	 * @param int $productId  => id of selected product's file.
	 * @param int $id => id of selected product.
	 */
	public function deleteLibraryFile($productId, $id) {
		$this->db->where('id', $id);
		$this->db->delete('product_library');

		if ($this->db->affected_rows() > 0) {
			$this->incrementAction('delete');
			$this->session->set_flashdata('status', 'Successfully deleted!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was deleted!');
		}
		redirect('manage/editProductLibrary/' . $productId);
	}

	/**
	 * # 2.6
	 * > PRODUCT
	 * Delete selected product.
	 * 
	 * @link Manage (controller) # 2.6
	 * @param int $id => id of selected product.
	 */
	public function deleteProduct($id) {
		$this->db->where('product_id', $id);
		$this->db->delete('product_library');

		$this->db->where('id', $id);
		$this->db->delete('product');

		if ($this->db->affected_rows() > 0) {
			$this->incrementAction('delete');
			$this->session->set_flashdata('status', 'Successfully deleted!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was deleted!');
		}
		redirect('manage/editAllProducts');
	}

	/**
	 * # 4.1
	 * > PROFILE
	 * Edit profile's information except picture.
	 * 
	 * @link Manage (controller) # 4.1
	 * @link Manage (model) # 0.1
	 * @return bool FALSE => if username is already claimed.
	 */
	public function editProfile() {
		$id = $this->input->post('id');
		$name = $this->input->post('name', TRUE);
    $username = $this->input->post('username', TRUE);
    $description = $this->input->post('description', TRUE);

    if ($username != $this->getAdminData()['username']) {
    	if ($this->checkUsername($username)) {
    		$this->session->set_flashdata('status', 'Username is already claimed!');
    		return FALSE;
    	}
    }
    
    $data = array(
    	'username' => $username,
    	'name' => $name,
    	'description' => $description
    );
    
		$this->db->where('id', $id);
		$this->db->update('admin', $data);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was updated!');
		}
		redirect('manage/editProfile');
	}

	/**
	 * # 4.2
	 * > PROFILE
	 * Edit profile's picture.
	 * 
	 * @link Manage (controller) # 4.2
	 * @param string $newPicture => new picture's file name.
	 */
	public function editProfilePicture($newPicture) {
		$id = $this->input->post('id');
		
		$this->db->where('id', $id);
		$this->db->update('admin', ['picture' => $newPicture]);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was updated!');
		}
		redirect('manage/editProfile');
	}

	/**
	 * # 5
	 * > PROFILE
	 * Change account's password.
	 * 
	 * @link Manage (controller) # 5
	 * @link Manage (model) # 0.1
	 */
	public function changePassword() {
		$oldPassword = $this->input->post('oldPassword', TRUE);
    $newPassword = $this->input->post('newPassword', TRUE);
    $adminData = $this->getAdminData();

    // Check password
		if (password_verify($oldPassword, $adminData['password'])) {
			$data = ['password' => password_hash($newPassword, PASSWORD_BCRYPT)];

			$this->db->where('id', $adminData['id']);
			$this->db->update('admin', $data);
			
			$this->session->set_flashdata('status', 'Successfully changed!');
		} else {
			$this->session->set_flashdata('status', 'Incorrect password!');
		}
		redirect('manage/changePassword');
	}

	/**
	 * # 6.1
	 * > ADMIN
	 * Get all registered admins.
	 * 
	 * @link Manage (controller) # 6.1
	 * @return array => all registered admins.
	 */
	public function getAllAdmins() {
		return $this->db->get('admin')->result_array();
	}

	/**
	 * # 6.2.1
	 * > ADMIN
	 * Get searched admins.
	 * 
	 * @link Manage (controller) # 6.2.1
	 * @param string $keyword => admin's name to search for.
	 * @return array => all searched admins.
	 */
	public function getSearchedAdmins($keyword) {
		$this->db->like('name', $keyword);
		return $this->db->get('admin')->result_array();
	}

	/**
	 * # 6.2.2
	 * > ADMIN
	 * Get selected admin's information.
	 * 
	 * @link Manage (controller) # 6.2.2
	 * @param int $id => id of selected admin.
	 * @return array => selected admin's information.
	 */
	public function getVisitedAdmin($id) {
		$this->db->where('id', $id);
		return $this->db->get('admin')->row_array();
	}

	/**
	 * # 7
	 * > ADMIN
	 * Register new admin.
	 * 
	 * @link Manage (controller) # 7
	 * @link Manage (model) # 0.2
	 */
	public function register() {
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$name = $this->input->post('name', TRUE);
		$picture = $this->input->post('picture');

		$query = $this->checkUsername($username);
		
		// If username doesn't exist.
		if (! $query) {
			$data = array(
				'username' => $username,
				'password' => password_hash($password, PASSWORD_BCRYPT),
				'name' => $name,
				'picture' => $picture
			);

			$this->db->insert('admin', $data);
			$this->session->set_flashdata('status', 'Account successfully created!');
		} else {
			$this->session->set_flashdata('status', 'Account creation failed, username is already claimed!');
		}
		redirect('manage/newAdmin');
	}

	/**
	 * # 8
	 * > ACCOUNT
	 * Delete account's information if password matched.
	 * 
	 * @link Manage (controller) # 8
	 * @link Manage (model) # 0.1
	 * @return string $adminData['picture'] => account's profile picture being deleted if password matched.
	 */
	public function deleteAccount() {
		$password = $this->input->post('password', TRUE);
		$adminData = $this->getAdminData();
		if (password_verify($password, $adminData['password'])) {
			$this->db->where('id', $adminData['id']);
			$this->db->delete('admin');

			if ($this->db->affected_rows() < 1) {
				$this->session->set_flashdata('status', 'Oops, something went wrong!');
				redirect('manage/deleteAccount');
			}

			return $adminData['picture'];
		} else {
			$this->session->set_flashdata('status', 'Incorrect password!');
			redirect('manage/deleteAccount');
		}
	}
}