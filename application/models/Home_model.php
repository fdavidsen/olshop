<?php 

class Home_model extends CI_Model {
	/**
	 * # 1
	 * Get all products first file.
	 *
	 * @link Home (Controller) # 1
	 * @link Home (Controller) # 2
	 * @return array $result => products' first file.
	 */
	public function getAllProductsFirstFile() {
		$query = $this->db->get('product_library')->result_array();
		$result = array();

		foreach ($query as $item) {
			if (! isset($result[$item['product_id']])) {
				$result[$item['product_id']] = $item;
			}
		}

		return $result;
	}

	/**
	 * # 2
	 * Increase or decrease like of a product.
	 *
	 * @link Home (Controller) # 4
	 * @param int $id 			 => id of the product.
	 * @param string $status => TRUE for like, FALSE for unlike.
	 */
	public function likeProduct($id, $status) {
		$this->db->where('id', $id);

		if ($status == TRUE) {
			$this->db->set('likes', 'likes + 1', FALSE);
		} else {
			$this->db->set('likes', 'likes - 1', FALSE);
		}
		
		$this->db->update('product');
	}

	/**
	 * # 3
	 * Get detail of a product.
	 *
	 * @link Home (Controller) # 2
	 * @param string $keyword => keyword to search for.
	 * @param string $orderBy => order by (id / likes).
	 * @return array => associated products.
	 */
	public function getSearchedProducts($keyword, $orderBy) {
		$this->db->order_by($orderBy, 'DESC');
		$this->db->like('name', $keyword);
		$this->db->or_like('category', $keyword);
		return $this->db->get('product')->result_array();
	}
}