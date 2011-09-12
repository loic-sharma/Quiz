<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {

	/**
	 * Types
	 *
	 * @var	array
	*/
	public $types = array(
		'free response',
		'multiple choice'
	);

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();

		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}

		$this->load->database();
		$this->load->model('quiz_model');
	}

	// --------------------------------------------------------------------

	/**
	 * Index
	 *
	 * @access	public
	 * @return	void
	 */
	public function index()
	{
		$email   = $this->account->get('email');
		$quizzes = $this->quiz_model->get_by_email($email);

		$this->load->view('quiz/index', compact('quizzes'));
	}

	// --------------------------------------------------------------------

	/**
	 * Create
	 *
	 * @access	public
	 * @return	void
	 */
	public function create()
	{
		$error = '';

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('name', 'Name', 'trim|required|xss_clean');

		if($this->form->run())
		{
			$id   = $this->account->get('id');
			$name = $this->input->post('name');

			$quiz_id = $this->quiz_model->create($id, $name);

			redirect('quiz/edit/' . $quiz_id);
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('quiz/create', compact('error'));
	}

	// --------------------------------------------------------------------

	/**
	 * Edit
	 *
	 * @access	public
	 * @return	void
	 */
	public function edit()
	{
		if( ! ($id = $this->uri->segment(3)) || ! is_numeric($id))
		{
			redirect('quiz');
		}

		// Start building the Quiz's data
		$data = $this->quiz_model->get($id);

		$data['error']     = '';
		$data['questions'] = $this->quiz_model->get_questions($id, $data['max_questions']);

		// Build the choices for the Max Displayed Questions field
		$questions = count($data['questions']);

		$data['options'][-1] = 'Show all Questions';
		$data['options'][0]  = 'Show no questions';

		$i = 1;

		while($questions >= $i)
		{
			$data['options'][$i] = 'Only show ' . $i . ' question(s)';

			$i++;
		}

		// Form validation
		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form->set_rules('password', 'Password', 'trim|xss_clean');
		$this->form->set_rules('max_questions', 'Max Displayed Questions', 'trim|required|numeric');

		if($this->form->run())
		{
			// Update the quiz
			$this->quiz_model->update($id, array(
				'name'			=> $this->input->post('name'),
				'password'		=> $this->input->post('password'),
				'max_questions' => $this->input->post('max_questions'),
			));
		}

		else
		{
			$data['error'] = validation_errors(' ', ' ');
		}

		// Since we're messing a lot with the data here, we manually
		// repopulate the form
		if($this->input->post('edit'))
		{
			$data['name']          = $this->input->post('name');
			$data['password']      = $this->input->post('password');
			$data['max_questions'] = $this->input->post('max_questions');
		}

		$this->load->helper('edit_quiz');
		$this->load->view('quiz/edit', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Add Question
	 *
	 * @access	public
	 * @return	void
	 */
	public function add_question()
	{
		if( ! ($id = $this->uri->segment(3)) || ! is_numeric($id))
		{
			redirect('quiz');
		}

		$error = '';
		$types = array();

		// Generate the possible types
		$types[] = '-- SELECT TYPE --';

		foreach($this->types as $type)
		{
			$types[] = ucwords($type);
		}

		$this->load->library('form_validation', NULL, 'form');
		$this->load->helper('add_question');

		$this->form->set_rules('question', 'Question', 'required|xss_clean');
		$this->form->set_rules('type', 'Type', 'required|numeric');

		if($this->form->run())
		{
			$error = $this->_add_question();

			if(empty($error))
			{
				redirect('quiz/edit/' . $id);
			}
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('quiz/add_question', compact('id', 'error', 'types'));
	}

	// --------------------------------------------------------------------

	/**
	 * Add Question
	 *
	 * Handles the form validation and actual adding of questions
	 * to the database.
	 *
	 * @access	public
	 * @return	string
	 */
	public function _add_question()
	{
		// Get the global question information
		$data['quiz_id']  = $this->uri->segment(3);
		$data['question'] = $this->input->post('question');
		$data['type']     = $this->input->post('type');

		// Check that a valid type was given
		if( ! in_array($data['type'], array(1, 2)))
		{
			return 'You must select a valid question type.';
		}

		// Free response
		if($data['type'] == 1)
		{
			$data['answer'] = $this->input->post('free_response_answer');
		}

		// Multiple choice
		if($data['type'] == 2)
		{
			$answers = $this->input->post('multiple_choice_answers');
			$answers = explode("\n", $answers);

			// Get all the non-blank answers
			foreach($answers as $answer)
			{
				$answer = trim($answer);

				if( ! empty($answer))
				{
					$data['answers'][] = $answer;
				}
			}

			// The answer to the question is the first answer
			$answer = $data['answers'][0];

			// Shuffle the array so that it is no longer in order
			shuffle($data['answers']);

			// Now get the answer's new location
			$data['answer'] = array_search($answer, $data['answers']);

			// Serialize the answers to get them database ready
			$data['answers'] = serialize($data['answers']);
		}

		// Now insert the data to the database
		$this->db->insert('questions', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Delete Question
	 *
	 * @access	public
	 * @return	void
	 */
	public function delete_question()
	{
		// We a valid quiz ID
		if( ! ($quiz_id = $this->uri->segment(3)) || ! is_numeric($quiz_id))
		{
			redirect('quiz');
		}
		
		// We also need a valid question ID
		if( ! ($id = $this->uri->segment(4)) || ! is_numeric($id))
		{
			redirect('quiz');
		}

		$this->load->model('question_model');

		$this->question_model->delete($id);

		redirect('quiz/edit/' . $quiz_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Enter
	 *
	 * @access	public
	 * @return	void
	 */
	public function enter()
	{
		$error = '';

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('id', 'Quiz ID', 'required|numeric');

		if($this->form->run())
		{
			$id       = $this->input->post('id');
			$password = $this->input->post('password');

			$this->db->where('id', $id);

			if( ! empty($password))
			{
				$this->db->where('password', $password);
				$this->db->or_where('password', NULL);
			}

			else
			{
				$this->db->where('password', NULL);
			}

			if($this->db->count_all_results('quizzes') > 0)
			{
				$this->account->give_access($id);

				redirect('quiz/take/' . $id);
			}
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('quiz/enter', compact('error'));
	}

	// --------------------------------------------------------------------

	/**
	 * Take
	 *
	 * @access	public
	 * @return	void
	 */
	public function take()
	{
		// We a valid quiz ID
		if( ! ($id = $this->uri->segment(3)) || ! is_numeric($id))
		{
			redirect('quiz/enter');
		}

		if( ! $this->account->can_access($id))
		{
			redirect('quiz/enter');
		}

		// Start building the Quiz's data
		$data = $this->quiz_model->get($id);

		$data['error']    = '';
		$data['questions'] = $this->quiz_model->get_questions($id, $data['max_questions']);

		if(($post_count = count($_POST)) > 1)
		{
			unset($_POST['submit']);
			$post_count--;

			$result['answered']   = $answered - 1;
			$result['unanswered'] = $data['max_questions'];


			var_dump($_POST);
			var_dump($data);
		}

		$this->load->helper('form');
		$this->load->view('quiz/take', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Delete
	 *
	 * @access	public
	 * @return	void
	 */
	public function delete()
	{
		$id = $this->uri->segment(3);

		$this->quiz_model->delete($id);

		redirect('quiz');
	}
}