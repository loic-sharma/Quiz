<?php

class Account {

	private $session;

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		$this->session = get_instance()->session;
	}

	// --------------------------------------------------------------------

	/**
	 * Logged in
	 *
	 * Verifies if the current user is logged in
	 *
	 * @access	public
	 * @return	void
	 */
	public function logged_in()
	{
		return $this->session->userdata('logged_in');
	}

	// --------------------------------------------------------------------

	/**
	 * Login
	 *
	 * Logs the user in with the given email
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function login($email)
	{
		$data = get_instance()->account_model->get_by_email($email);

		$data['logged_in'] = TRUE;
		$data['email']     = $email;

		foreach($data as $key => $value)
		{
			$this->session->set_userdata($key, $value);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get
	 *
	 * Gets information specific to the logged in user
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	 public function get($key)
	 {
	 	if( ! ($value = $this->session->userdata($key)))
		{
			show_error('Cannot find user data: ' . $key);
		}

		return $value;
	 }

	// --------------------------------------------------------------------

	/**
	 * Give Access
	 *
	 * Grants the account access to a quiz
	 *
	 * @access	public
	 * @param	int
	 * @return 	void
	 */
	public function give_access($quiz_id)
	{
		$this->session->set_userdata('can_access_quiz_' . $quiz_id, TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * Can Access
	 *
	 * Verifies if the account has access to a quiz
	 *
	 * @access	public
	 * @param	int
	 * @return 	void
	 */
	public function can_access($quiz_id)
	{
		return $this->session->userdata('can_access_quiz_' . $quiz_id);
	}
}