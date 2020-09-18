<?php 

class Manage extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Manage_model');
		$this->load->library('form_validation');
	}

	/**
	 * # 0.1
	 * Upload picture to public/img/
	 * 
	 * @link Manage (controller) # 3.1
	 * @link Manage (controller) # 3.2
	 * @link Manage (controller) # 4.1
	 * @link Manage (controller) # 4.2
	 * @param string $oldPicture 		 => previous picture name.
	 * @param string $targetRedirect => page to redirect after uploading.
	 * @param string $targetUpload	 => subdirectory of public/img/
	 * @return string => uploaded picture name if success.
	 */
	private function uploadPicture($oldPicture, $targetRedirect, $targetUpload = '') {
		$config = array(
			'file_name' => uniqid(),
			'allowed_types' => 'jpg|jpeg|jpeg|jpeg|gif|png',
			'upload_path' => './public/img/' . $targetUpload,
			'max_size' => 40000
		);
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('newPicture')) {
			$this->deletePicture($oldPicture, $targetUpload);
			return $this->upload->data('file_name');
		} else {
			$this->session->set_flashdata('status', $this->upload->display_errors());
			redirect('manage/' . $targetRedirect);
		}
	}

	/**
	 * # 0.2
	 * Delete picture from public/img/
	 * 
	 * @link Manage (controller) # 0.1
	 * @link Manage (controller) # 8
	 * @param string $oldPicture 	 => previous picture name.
	 * @param string $targetUpload => subdirectory of public/img/
	 */
	private function deletePicture($oldPicture, $targetUpload) {
		$default = ['male.png', 'female.png'];

		if (! in_array($oldPicture, $default)) {
			unlink('./public/img/' . $targetUpload . '/' . $oldPicture);
		}
	}

	/**
	 * # 0.3
	 * Upload multiple files to public/product/
	 * 
	 * @link Manage (controller) # 1
	 * @link Manage (controller) # 2.3
	 * @param string $targetRedirect => page to redirect after uploading.
	 * @return array $mediaProperty => file name and type of uploaded files.
	 */
	private function uploadFiles($targetRedirect='') {
		$mediaProperty = array();

		for ($i = 0; $i < count($_FILES['library']['name']); $i++) {
			$_FILES['file'] = array(
				'name' => $_FILES['library']['name'][$i],
        'type' => $_FILES['library']['type'][$i],
        'tmp_name' => $_FILES['library']['tmp_name'][$i],
        'error' => $_FILES['library']['error'][$i],
        'size' => $_FILES['library']['size'][$i]
			);

			$config = array(
				'file_name' => uniqid(),
				'allowed_types' => 'jpg|jpeg|jpeg|gif|png|mp4|mkv|mov|avi|webm',
				'upload_path' => './public/product/',
				'max_size' => 40000
			);
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file')) {
				$mediaProperty[$i] = array(
					'file_name' => $this->upload->data('file_name'),
					'type' => explode('/', $_FILES['file']['type'])[0]
				);
			} else {
				$this->session->set_flashdata('status', $this->upload->display_errors());
				redirect('manage/' . $targetRedirect);
			}
		}
		return $mediaProperty;
	}

	/**
	 * # 1
	 * > PRODUCT
	 * Index Page for this controller.
	 * Add new product.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 1
	 * @link Manage (controller) # 0.3
	 */
	public function index() {
		$data = array(
			'title' => 'New Product',
			'admin' => $this->Manage_model->getAdminData()
		);
		
		if ($this->input->post()) {
			$mediaProperty = $this->uploadFiles();
	    $this->Manage_model->newProduct($mediaProperty);
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/product/new_product');
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 2.1
	 * > PRODUCT
	 * Show all products and what action to take.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 2.1
	 */
	public function editAllProducts() {
		$data = array(
			'title' => 'Edit Products',
			'admin' => $this->Manage_model->getAdminData(),
			'allProducts' => $this->Manage_model->getAllProducts()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/product/edit_all_products', $data);
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 2.2.1
	 * > PRODUCT
	 * Edit information of selected product.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 2.2.1.2
	 * @link Manage (model) # 2.3.1
	 * @link Manage (model) # 2.2.1.1
	 */
	public function editProduct($id) {
		$data = array(
			'admin' => $this->Manage_model->getAdminData(),
			'product' => $this->Manage_model->getProduct($id),
			'productLibrary' => $this->Manage_model->getProductLibrary($id)
		);
		$data['title'] = $data['product']['name'];

		if ($this->input->post()) {
			$this->Manage_model->editProductInfo($id);
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/product/edit_product', $data);
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 2.2.2
	 * > PRODUCT
	 * Add first file if there's no file exists.
	 * 
	 * @link Manage (model) # 2.2.2
	 */
	public function addFirstFile() {
		$id = $this->input->post('id');
		
		$config = array(
			'file_name' => uniqid(),
			'allowed_types' => 'jpg|jpeg|gif|png|mp4|mkv|mov|avi|webm',
			'upload_path' => './public/product/',
			'max_size' => 40000
		);
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('newFile')) {
			$data = array(
				'product_id' => $id,
				'file_name' => $this->upload->data('file_name'),
				'type' => explode('/', $_FILES['newFile']['type'])[0]
			);
			$this->Manage_model->addFirstFile($id, $data);

			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', $this->upload->display_errors());
		}
		redirect('manage/editProduct/' . $id);
	}

	/**
	 * # 2.3
	 * > PRODUCT
	 * Show all product's media to take action.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 2.2.1.2
	 * @link Manage (model) # 2.3.1
	 * @link Manage (model) # 2.3.2
	 * @link Manage (controller) # 0.3
	 */
	public function editProductLibrary($id) {
		$data = array(
			'admin' => $this->Manage_model->getAdminData(),
			'product' => $this->Manage_model->getProduct($id),
			'productLibrary' => $this->Manage_model->getProductLibrary($id)
		);
		$data['title'] = $data['product']['name'];

		if (count($data['productLibrary']) == 0) {
			redirect('manage/editProduct/' . $id);
		}
		
		if ($this->input->post()) {
			$mediaProperty = $this->uploadFiles('editProductLibrary/' . $id);
			$this->Manage_model->uploadNewLibrary($id, $mediaProperty);
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/product/edit_product_library', $data);
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 2.4
	 * > PRODUCT
	 * Upload new file and delete previous file.
	 * 
	 * @link Manage (model) # 2.4
	 */
	public function changeLibraryFile() {
		$productId = $this->input->post('productId');
		$id = $this->input->post('id');
		$oldFile = $this->input->post('oldFile');
		
		$config = array(
			'file_name' => uniqid(),
			'allowed_types' => 'jpg|jpeg|gif|png|mp4|mkv|mov|avi|webm',
			'upload_path' => './public/product/',
			'max_size' => 40000
		);
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('newFile' . $id)) {
			$data = array(
				'fileName' => $this->upload->data('file_name'),
				'type' => explode('/', $_FILES['newFile' . $id]['type'])[0]
			);
			$this->Manage_model->changeLibraryFile($id, $data);

			unlink('./public/product/' . $oldFile);
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', $this->upload->display_errors());
		}
		redirect('manage/editProductLibrary/' . $productId);
	}

	/**
	 * # 2.5
	 * > PRODUCT
	 * Delete selected product's file.
	 * 
	 * @link Manage (model) # 2.5
	 * @param string $fileName => selected product's file name.
	 * @param int $productId 	 => id of selected product's file.
	 * @param int $id 				 => id of selected product.
	 */
	public function deleteLibraryFile($fileName, $productId, $id) {
		unlink('./public/product/' . $fileName);
		$this->Manage_model->deleteLibraryFile($productId, $id);
	}

	/**
	 * # 2.6
	 * > PRODUCT
	 * Delete selected product.
	 * 
	 * @link Manage (model) # 2.3.1
	 * @link Manage (model) # 2.6
	 * @param int $id => id of selected product.
	 */
	public function deleteProduct($id) {
		$query = $this->Manage_model->getProductLibrary($id);

		foreach ($query as $item) {
			unlink('./public/product/' . $item['file_name']);
		}
		
		$this->Manage_model->deleteProduct($id);
	}

	/**
	 * # 3.1
	 * > CONTACT
	 * Edit shop's contact information except picture.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (controller) # 0.1
	 * @link Contact (model) # 1
	 * @link Contact (model) # 2
	 */
	public function editContact() {
		$this->load->model('Contact_model');
		$data = array(
			'title' => 'Edit Contact',
			'admin' => $this->Manage_model->getAdminData(),
			'contact' => $this->Contact_model->getContact()
		);

		if ($this->input->post()) {
	    $this->Contact_model->editContact();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/contact/edit_contact', $data);
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 3.2
	 * > CONTACT
	 * Edit shop's brand picture.
	 * 
	 * @link Manage (controller) # 0.1
	 * @link Contact (model) # 3
	 */
	public function editContactPicture() {
		$this->load->model('Contact_model');
		$oldPicture = $this->input->post('oldPicture');

		if ($_FILES['newPicture']['error'] == 4) {
    	$newPicture = $oldPicture;
    } else {
    	$newPicture = $this->uploadPicture($oldPicture, 'editContact');
    }

    $this->Contact_model->editContactPicture($newPicture);
	}

	/**
	 * # 4.1
	 * > PROFILE
	 * Edit profile's information except picture.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 4.1
	 */
	public function editProfile() {
		$data['admin'] = $this->Manage_model->getAdminData();
		$data['title'] = $data['admin']['name'];

		if ($this->input->post()) {
			$this->Manage_model->editProfile();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/profile/edit_profile', $data);
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 4.2
	 * > PROFILE
	 * Edit profile's picture.
	 * 
	 * @link Manage (controller) # 0.1
	 * @link Manage (model) # 4.2
	 */
	public function editProfilePicture() {
		$oldPicture = $this->input->post('oldPicture');

    if ($_FILES['newPicture']['error'] == 4) {
    	$newPicture = $oldPicture;
    } else {
    	$newPicture = $this->uploadPicture($oldPicture, 'editProfile', 'profile_picture');
    }

    $this->Manage_model->editProfilePicture($newPicture);
	}

	/**
	 * # 5
	 * > PROFILE
	 * Change account's password.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 5
	 */
	public function changePassword() {
		$data['admin'] = $this->Manage_model->getAdminData();
		$data['title'] = $data['admin']['name'];

		$config = array(
			[
				'field' => 'oldPassword',
				'label' => 'Old Password',
				'rules' => 'required'
			],
			[
				'field' => 'newPassword',
				'label' => 'New Password',
				'rules' => ['required', 'min_length[6]', 'max_length[20]']
			]
		);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/manage/header');
			$this->load->view('manage/profile/change_password');
			$this->load->view('templates/manage/footer');
		} else {
	    $this->Manage_model->changePassword();
		}
	}

	/**
	 * # 6.1
	 * > ADMIN
	 * Show all registered admins.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 6.1
	 */
	public function viewAllAdmins() {
		$data = array(
			'title' => 'View Admins',
			'admin' => $this->Manage_model->getAdminData(),
			'allAdmins' => $this->Manage_model->getAllAdmins()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/admin/view_all_admins', $data);
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 6.2.1
	 * > ADMIN
	 * Search admins.
	 * 
	 * @link search (js)
	 * @link Manage (model) # 6.2.1
	 * @param string $keyword => admin's name to search for.
	 */
	public function searchAdmins($keyword='') {
		$data['allAdmins'] = $this->Manage_model->getSearchedAdmins($keyword);
		$this->load->view('manage/admin/searched_admins', $data);
	}

	/**
	 * # 6.2.2
	 * > ADMIN
	 * View selected admin.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 6.2.2
	 * @param int $id => id of selected admin.
	 */
	public function viewAdmin($id) {
		$data = array(
			'admin' => $this->Manage_model->getAdminData(),
			'visitedAdmin' => $this->Manage_model->getVisitedAdmin($id)
		);
		$data['title'] = $data['visitedAdmin']['name'] . "'s Profile";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/admin/view_admin', $data);
		$this->load->view('templates/manage/footer');
	}

	/**
	 * # 7
	 * > ADMIN
	 * Register new admin.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 7
	 */
	public function newAdmin() {
		$data = array(
			'title' => 'New Admin',
			'admin' => $this->Manage_model->getAdminData()
		);

		$config = array(
			[
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => ['required', 'min_length[6]', 'max_length[20]']
			]
		);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/manage/header');
			$this->load->view('manage/admin/new_admin');
			$this->load->view('templates/manage/footer');
		} else {
	    $this->Manage_model->register();
		}
	}

	/**
	 * # 8
	 * > ACCOUNT
	 * Delete account's profile picture and information.
	 * 
	 * @link Manage (model) # 0.1
	 * @link Manage (model) # 8
	 * @link Manage (controller) # 0.2
	 */
	public function deleteAccount() {
		$data['admin'] = $this->Manage_model->getAdminData();
		$data['title'] = $data['admin']['name'];

		if ($this->input->post()) {
	    $picture = $this->Manage_model->deleteAccount();
	    $this->deletePicture($picture, 'profile_picture');

	    $data = ['id', 'key', 'admin'];
	    $this->session->unset_userdata($data);

	    redirect('login');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/manage/header');
		$this->load->view('manage/account/delete_account');
		$this->load->view('templates/manage/footer');
	}
}