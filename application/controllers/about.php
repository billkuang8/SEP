<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends SEP_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$headerData = $this->headerData;
		$headerData['css'] = array('about_us.css', 'jquery.cleditor.css');
		$headerData['js'] = array('jQuery.js', 'jquery.min.js', 'jquery.cleditor.min.js', 'about_us.js', 'jQuery-UI.js');	
		$this->load->view('templates/header', $headerData);
		$this->load->view('about_us');
		$this->load->view('templates/footer');
	}
}
?>
