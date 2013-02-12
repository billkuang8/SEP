<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_pw extends Pledge_Controller {
	
	private $vars;
	
	function __construct() {
		//loads the parent constructor
		parent::__construct();
		
		$this->load->model('user');
		$this->load->library(array('security', 'form_validation'));
		
		//initialize global variable
		$this->vars['error_message'] = '';
	}
	
	public function index() {
		
			
		//form submitted
		if (isset($_POST['password']) && isset($_POST['current']) && isset($_POST['password_confirmation'])) {
			$this->vars['error_message'] = $this->do_modification();
		}
		
		$headerData = $this->headerData;
		$headerData['title'] = 'File Upload';
		$headerData['css'] = array('files.css', 'internal.css');
		$headerData['js'] = array('change_pw_dialog.js');
		
		$this->load->view('templates/header', $headerData);
		$this->load->view('change_pw_view', $this->vars);
		$this->load->view('templates/footer');
			
	}
	
	private function do_modification() {
		//when form is submitted
		if (isset($_POST['password']) && isset($_POST['current']) && isset($_POST['password_confirmation'])) {
			$current = $this->security->xss_clean($this->input->post('current'));
			$password = $this->security->xss_clean($this->input->post('password'));
			$confirmation = $this->security->xss_clean($this->input->post('password_confirmation'));
			
			$this->form_validation->set_rules('current', 'Current Password', 'trim|required|xss_clean|callback__check_pw');
			//verifies the pw
			if ($this->form_validation->run() == FALSE) {
				return 'The current password you\'ve entered is incorrect.';
			} else {
				//checks if the password matches the confirmation
				if ($password == $confirmation) {
					//proceed to change the pw
					$this->form_validation->set_rules('password', 'New Password', 'trim|requsired|xss_clean|callback__change_pw');
					
					if ($this->form_validation->run() == FALSE) {
						return 'Oops, something went wrong. Please try again.';
					} else {
						return 'Your password has been reset. Click <a href="home">here</a> to go back to the home page.';
					}
					
				} else {
					return 'Your password does not match the confirmation.';
				}
			}
		} else {
			return '';
		}
	}

	function _check_pw($current) {
		//sets the variables that's not part of the callback function
		$session = $this->session->userdata('logged_in');
		$session_id = $session['id'];
		return $this->user->check_pw($current, $session_id);
	}

	function _change_pw($password) {
		$session = $this->session->userdata('logged_in');
		$session_id = $session['id'];
		return $this->user->change_pw($password, $session_id);
	}
}