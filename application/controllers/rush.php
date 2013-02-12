<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rush extends SEP_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('file');	
		$this->load->database();	
	}
	
	public function index()
	{
		$vars['errors'] = $this->session->flashdata('errors');
		$vars['success'] = $this->session->flashdata('success');
		$vars['appsuccess'] = $this->session->flashdata('appsuccess');
		$vars['rush_message'] = $this->getContent();
		$vars['rush_file'] = $this->getFileContent();
		$headerData = $this->headerData;
		$headerData['css'] = array('rush.css');
		$headerData['js'] = array('rush.js');	
		$this->load->view('templates/header', $headerData);
		$this->load->view('rush', $vars);
		$this->load->view('templates/footer');
	}
	
	public function signup()
	{
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
		$this->form_validation->set_message('required', "The email field must contain a valid email address.");
		if($this->form_validation->run() == TRUE)
		{
			if(write_file('./SEPFiles/rush_emails.txt', $this->input->post('email') . ", ", 'a'))
			{
				$this->session->set_flashdata('success', TRUE);
			}
			else
			{
				$this->session->set_flashdata('errors', '<b>Oops. Something went wrong. Please try again.</b>');
			}
		}
		else
		{
			$this->session->set_flashdata('errors', validation_errors());
		}
		redirect('rush');
	}
	
	public function app()
	{
		$headerData = $this->headerData;
		$var['error'] = $this->session->flashdata('error');
		$headerData['css'] = array('rush.css');
		$headerData['js'] = array('rush.js');	
		$this->load->view('templates/header', $headerData);
		$this->load->view('application', $var);
		$this->load->view('templates/footer');
	}
	
	public function submit_app()
	{
		$config['upload_path'] = './' . SEPFILES_BASE_PATH . 'rush_application/';
		$config['allowed_types'] = 'pdf|doc|docx|jpg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('major', 'Major', 'required');
		$this->form_validation->set_rules('units', 'Units', 'required');
		$this->form_validation->set_rules('gpa', 'Gpa', 'required');
		$this->form_validation->set_rules('q1', 'Q1', 'required');
		$this->form_validation->set_rules('q2', 'Q2', 'required');
		$this->form_validation->set_rules('sa1', 'Short Answer 1', 'required');
		$this->form_validation->set_rules('sa2', 'Short Answer 2', 'required');
		$this->form_validation->set_rules('sa3', 'Short Answer 3', 'required');
		$this->form_validation->set_rules('sa4', 'Short Answer 4', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', TRUE);
			redirect('rush/app');
		}
		if($this->upload->do_upload('resume'))
		{
			$file_data = $this->upload->data();
			$resumeFullpath = $file_data['full_path'];
		}
		else
		{
			$this->session->set_flashdata('error', TRUE);
			redirect('rush/app');	
		} 
		if($this->upload->do_upload('picture'))
		{
			$file_data = $this->upload->data();
			$pictureFullpath = $file_data['full_path'];	
		}
		else
		{
			$this->session->set_flashdata('error', TRUE);
			redirect('rush/app');
		}
		$sql = "INSERT INTO applications (name, year, major, units, gpa, q1, q2, sa1, sa2, sa3, sa4, resume, picture)
		VALUES (\"". mysql_real_escape_string($this->input->post('name'))."\", \"". mysql_real_escape_string($this->input->post('year'))."\", \"".mysql_real_escape_string($this->input->post('major'))."\", \"".mysql_real_escape_string($this->input->post('units'))."\", \"".mysql_real_escape_string($this->input->post('gpa'))."\", \"".mysql_real_escape_string($this->input->post('q1'))."\", \"".mysql_real_escape_string($this->input->post('q2'))."\", \"".mysql_real_escape_string($this->input->post('sa1'))."\", \"".mysql_real_escape_string($this->input->post('sa2'))."\", \"".mysql_real_escape_string($this->input->post('sa3'))."\", \"".mysql_real_escape_string($this->input->post('sa4'))."\"," . "\" $resumeFullpath \"," . "\" $pictureFullpath \"" . " )";
		$this->db->query($sql);
		$this->session->set_flashdata('appsuccess', TRUE);
		redirect('rush');
	}
	
	private function getContent()
	{
		$contents = read_file(SEPFILES_BASE_PATH . "rush_update.html");
		if(!$contents)
		{
			$contents = "<h2>Updating... Please come back later.</h2>";
		}
		return $contents;
	}
	
	private function getFileContent()
	{
		$contents = read_file(SEPFILES_BASE_PATH . "logs/update_rush_file.html");
		if(!$contents)
		{
			$contents = '';
		}
		return $contents;
	}		
}

?>
