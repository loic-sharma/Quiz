<?php

class Quiz_model extends CI_Model {

	/**
	 * Create
	 *
	 * Creates a new Quiz and returns the quiz's  ID
	 *
	 * @access	public
	 * @param	int
	 * @param	string
	 * @return	int
	 */
	public function create($author_id, $name)
	{
		$data = compact('author_id', 'name');

		$this->db->insert('quizzes', $data);

		return $this->db->insert_id();
	}

	// --------------------------------------------------------------------

	/**
	 * Get
	 *
	 * Returns a single quiz by its ID 
	 *
	 * @access	public
	 * @access	string
	 * @return	array
	 */
	public function get($id)
	{
		$this->db->select('quizzes.*, COUNT(questions.id) AS questions');
		$this->db->join('questions', 'questions.id = quizzes.id', 'LEFT');
		$this->db->where('quizzes.id', $id);

		$query = $this->db->get('quizzes', 1);

		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}

		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get By Email
	 *
	 * Returns an array of all the quizzes created by the user
	 *
	 * @access	public
	 * @access	string
	 * @return	array
	 */
	public function get_by_email($email)
	{
		$this->db->select('quizzes.id, quizzes.name');
		$this->db->where('accounts.email', $email);
		$this->db->join('quizzes', 'accounts.id = quizzes.author_id');

		$query = $this->db->get('accounts');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return array();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get Questions
	 *
	 * @access	public
	 * @param	int
	 * @param	boolean
	 * @return	array
	 */
	public function get_questions($id, $override_limit = FALSE)
	{
		if($override_limit == FALSE)
		{
			$this->db->select('max_questions');
			$this->db->where('id', $id);

			$query = $this->db->get('quizzes', 1);

			if($query->num_rows() > 0)
			{
				if(($limit = $query->row()->max_questions) != -1)
				{
					// Set the limit
					$this->db->order_by('id', 'rand');
					$this->db->limit($limit);
				}
				
			}

			else
			{
				// The quiz doesn't seem to exist, so we'll return
				// a blank array
				return array();
			}
		}

		// If we're given an actual limit to use, set it now
		elseif(is_int($override_limit) && $override_limit >= 0)
		{
			$this->db->limit($override_limit);
		}

		$this->db->where('quiz_id', $id);

		$query = $this->db->get('questions');

		if($query->num_rows() > 0)
		{
			return $query->result_array();	
		}

		else
		{
			return array();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Update
	 *
	 * Updates the quiz with the given ID
	 *
	 * @access	public
	 * @param	int
	 * @param	array
	 * @return	void
	 */
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->update('quizzes', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Delete
	 *
	 * Deletes the quiz with the given ID
	 *
	 * @access	public
	 * @access	int
	 * @return	void
	 */
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('quizzes');
	}
}