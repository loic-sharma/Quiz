<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index
	 *
	 * @access	public
	 * @return	void
	 */
	public function index()
	{
		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}

		$this->load->view('user/index');
	}

	// --------------------------------------------------------------------

	/**
	 * Register
	 *
	 * @access	public
	 * @return	void
	 */
	public function register()
	{
		if($this->account->logged_in())
		{
			redirect('user');
		}

		$error = '';

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form->set_rules('password', 'Password', 'trim|required|matches[confirm]');

		if($this->form->run())
		{
			$this->load->database();
			$this->load->model('account_model');

			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			if( ! $this->account_model->exists($email))
			{
				$this->account_model->create($email, $password);

				$this->account->login($email);

				redirect('user');
			}

			else
			{
				$error = 'That email is already taken.';
			}
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('user/register', compact('error'));
	}

	// --------------------------------------------------------------------

	/**
	 * Login
	 *
	 * @access	public
	 * @return	void
	 */
	public function login()
	{
		if($this->account->logged_in())
		{
			redirect('user');
		}

		$error = '';

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form->set_rules('password', 'Password', 'trim|required');

		if($this->form->run())
		{
			$this->load->database();
			$this->load->model('account_model');

			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			if($this->account_model->exists($email, $password))
			{
				$this->account->login($email);

				redirect('user');
			}

			else
			{
				$error = 'Invalid email/password.';
			}
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('user/login', compact('error'));
	}

	// --------------------------------------------------------------------

	/**
	 * Logout
	 *
	 * @access	public
	 * @return	void
	 */
	public function logout()
	{
		$this->session->sess_destroy();

		redirect('user/login');
	}
}