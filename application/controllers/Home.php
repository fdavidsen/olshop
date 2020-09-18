<?php 

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Manage_model');
		$this->load->model('Home_model');
	}

	/**
	 * # 1
	 * Index Page for this controller.
	 * Main page of this website.
	 * 
	 * @link Manage (model) # 2.1
	 * @link Manage (model) # 0.1
	 * @link Home (model) # 1
	 */
	public function index() {
		$data = array(
			'title' => $this->config->item('shop_name'),
			'allProducts' => $this->Manage_model->getAllProducts(),
			'productsFirstFile' => $this->Home_model->getAllProductsFirstFile()
		);

		if ($this->session->userdata('admin') == TRUE) {
			$data['admin'] = $this->Manage_model->getAdminData();
		}

		$this->load->view('templates/header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * # 2
	 * Load searched products page.
	 * 
	 * @link search (js)
	 * @link Home 	(model) # 3
	 * @link Home 	(model) # 1
	 * @param string $target  => view to load (home / manage).
	 * @param string $keyword => keyword to search for.
	 * @param string $order 	=> order by (id / likes).
	 */
	public function searchProducts($target, $keyword, $order='id') {
		if ($target == 'manage')				$target .= '/product';
		if ($keyword == 'nullnanfalse')	$keyword = '';
		
		$data = array(
			'allProducts' => $this->Home_model->getSearchedProducts($keyword, $order),
			'productsFirstFile' => $this->Home_model->getAllProductsFirstFile()
		);
		$this->load->view($target . '/searched_products', $data);
	}

	/**
	 * # 3
	 * Get detail of a product.
	 * 
	 * @link Manage (model) # 2.2.1.2
	 * @link Manage (model) # 2.3.1
	 * @param string $id => id of the product.
	 * @return json $data => detail of the product.
	 */
	public function getProductDetail($id) {
		is_null(get_cookie('product_' . $id, TRUE)) ? $button = 'Like' : $button = 'Unlike';

		$data = array(
			'product' => $this->Manage_model->getProduct($id),
			'productLibrary' => $this->Manage_model->getProductLibrary($id),
			'button' => $button
		);
		echo json_encode($data);
	}

	/**
	 * # 4
	 * Like or unlike a product.
	 * 
	 * @link Home (model) # 2
	 * @param string $id => id of the product.
	 * @return json $data => like counts and button status (Like/ Unlike).
	 */
	public function likeProduct($id) {
		if (is_null(get_cookie('product_' . $id, TRUE))) {
			set_cookie('product_' . $id, 'LOVE', time() + pow(10, 10));
			$status = TRUE;
			$button = 'Unlike';
		} else {
			delete_cookie('product_' . $id);
			$status = FALSE;
			$button = 'Like';
		}
		$this->Home_model->likeProduct($id, $status);

		$data = array(
			'likeCounts' => $this->Manage_model->getProduct($id)['likes'],
			'button' => $button
		);
		echo json_encode($data);
	}
}