<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brothers extends SEP_Controller 
{
	private $vars;
	
	public function __construct()
	{
		parent::__construct();
		
		//initializes variables	
		if ($this->utils->is_active() || $this->utils->is_exec()) {
			$this->vars['button'] = '<a href="profile_update" id="new_profile">+</a>';
		} else {
			$this->vars['button'] = '';
		}
		
		$session = $this->session->userdata('logged_in');
		$this->vars['logged_in_as'] = $session['id'];
		$this->vars['privilege'] = $session['privilege'];
		
		$greek_alphabet = array('Founding', 'Alpha', 'Beta', 'Gamma');
		$temp = array();
		for ($letters = 0; $letters < count($greek_alphabet); $letters++) {
			
			$class = $this->file_functions->load_file(SEPFILES_BASE_PATH . "profiles/profile_log_".$greek_alphabet[$letters].".html");  
			if (!empty($class)) {
				$temp[$letters] = '<div id="'.$greek_alphabet[$letters].'">'.($class).'</div>'; 
			} else {
				$temp[$letters] = '<div id="'.$greek_alphabet[$letters].'">'.''.'</div>';
			}
		}
		
		$this->vars['content'] = $temp;
		
		
		$list = array();
		for ($letters = 0; $letters < count($greek_alphabet); $letters++) {
			
			$list[$letters] = '<li><a href="#'.$greek_alphabet[$letters].'">'.$greek_alphabet[$letters].' Class</a></li>';
		}
		$this->vars['tabs'] = $list;
	}
	
	public function index()
	{
		$headerData = $this->headerData;
		$headerData['css'] = array('gallery.css');
		$headerData['js'] = array('gallery.js', 'profile_update.js');
		
		$this->load->view('templates/header', $headerData);
		$this->load->view('brothers', $this->vars);
		$this->load->view('templates/footer');
	}
	
	function delete() 
	{
		if (isset($_POST['id']) && isset($_POST['filename']) && isset($_POST['occupation'])) {
			$this->update($this->input->post('id'), $this->input->post('filename'), $this->input->post('occupation'));
		}
		redirect('brothers', 'refresh');
	}
	
	private function update($id, $filename, $occupation) 
	{
		$data = file(SEPFILES_BASE_PATH . 'profiles/profile_log_'.$occupation.'.html');
		$delete_line = -1;
		for ($lines = 0; $lines < count($data); $lines++) {
			if (strpos($data[$lines], 'class="container" id="'.$id)) {
				$delete_line = $lines + 1;
			}
		}
		$this->file_functions->cutline(SEPFILES_BASE_PATH . 'profiles/profile_log_'.$occupation.'.html', $delete_line);
		if ($filename != 'question.jpg') {
			unlink(SEPFILES_BASE_PATH . 'profiles/'.$filename);
		}
		if ($this->file_functions->line_number_trim(SEPFILES_BASE_PATH . 'profiles/profile_log_'.$occupation.'.html') == 0) {
			unlink(SEPFILES_BASE_PATH . 'profiles/profile_log_'.$occupation.'.html');
		}
	}
	
}

?>