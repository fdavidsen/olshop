<?php 

class Contact_model extends CI_Model {
	/**
	 * # 1
	 * Get existing contact info.
	 * 
	 * @link Contact (controller) # 1
	 * @link Manage (controller) # 3.1
	 * @return array => shop's contact info.
	 */
	public function getContact() {
		return $this->db->get('contact')->row_array();
	}

	/**
	 * # 2
	 * Edit contact info.
	 *
	 * @link Manage (controller) # 3.1
	 */
	public function editContact() {
		$title = $this->input->post('title', TRUE);
		$subtitle = $this->input->post('subtitle', TRUE);
		$description = $this->input->post('description', TRUE);

		$data = array(
			'title' => $title,
			'subtitle' => $subtitle,
			'description' => $description
		);

		$this->db->where('id', 1);
    $this->db->update('contact', $data);

    if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was updated!');
		}

		redirect('manage/editContact');
	}

	/**
	 * # 3
	 * Edit shop's brand picture.
	 *
	 * @link Manage (controller) # 3.2
	 * @param string $newPicture => file name of new uploaded picture.
	 */
	public function editContactPicture($newPicture) {
		$this->db->where('id', 1);
    $this->db->update('contact', ['picture' => $newPicture]);

    if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('status', 'Successfully updated!');
		} else {
			$this->session->set_flashdata('status', 'Nothing was updated!');
		}

		redirect('manage/editContact');
	}
}