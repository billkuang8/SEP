<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_contact extends Active_Controller {

	private $vars;
	
	function __construct() {
		//calls parent constructor
		parent::__construct();
		
		//loads essentials
		$this->load->helper('form');
		
		//variables to be passed into views
		$this->vars['messages'] = $this->load_messages();
	}
	
	public function index() {
		$headerData = $this->headerData;
		$headerData['title'] = 'Forum';
		$headerData['css'] = array('style.css', 'view_contact.css', 'internal.css');
		$headerData['js'] = array('jQuery.js', 'view_contact.js');
		$this->load->view('templates/header', $headerData);
		$this->load->view('view_contact_view', $this->vars);
		$this->load->view('templates/footer');
	}
	
	function delete() 
	{
		if (isset($_POST['id']))
		{
			$this->file_functions->cutline(SEPFILES_BASE_PATH . 'messages.html', $_POST['id']);	
		}
		redirect('view_contact');
	}
	
	private function load_messages() {
		$filePath = SEPFILES_BASE_PATH . 'messages.html';
		if(file_exists($filePath) && filesize($filePath) > 0){  
	        $handle = fopen($filePath, "r");  
	        $contents = fread($handle, filesize($filePath));  
	        fclose($handle); 
			if (trim($contents) == '') {
				return '<center>No more message</center>';
			} else {
				return $contents; 
			}
	    } else {
			return '<center>No more message</center>';
		}
	}
}

?>