<?php

class Question_model extends CI_Model {

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('questions');
	}
}