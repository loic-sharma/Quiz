<?php

class Account_model extends CI_Model {

	/**
	 * Exists
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function exists($email, $password = FALSE)
	{
		$this->db->where('email', $email);

		if($password !== FALSE)
		{
			$password = $this->encrypt_password($email, $password);

			$this->db->where('password', $password);
		}

		return ($this->db->count_all_results('accounts') > 0);
	}

	// --------------------------------------------------------------------

	/**
	 * Create
	 *
	 * Creates an account
	 *
	 * @access	public
	 * @access	string
	 * @access	string
	 * @return	void
	 */
	public function create($email, $password)
	{
		$account = array(
			'email'      => $email,
			'password'   => $this->encrypt_password($email, $password),
			'ip_address' => $this->input->ip_address(),
		);

		$this->db->insert('accounts', $account);
	}

	// --------------------------------------------------------------------

	/**
	 * Get by Email
	 *
	 * Gets an account's info by using the email
	 *
	 * @access	public
	 * @access	string
	 * @return	array
	 */
	public function get_by_email($email)
	{
		$this->db->where('email', $email);

		$query = $this->db->get('accounts');

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
	 * Encrypt Password
	 *
	 * Encrypts the password using both the email and the password. Super
	 * secret stuffz, ya?
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	private function encrypt_password($email, $password)
	{
		return sha1($email . ':' . $password);
	}
}