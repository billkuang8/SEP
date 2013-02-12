<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Companies extends SEP_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$headerData = $this->headerData;
		$headerData['css'] = array('companies.css');
		$headerData['js'] = array('companies.js');
		$this->load->view('templates/header', $headerData);
		$this->load->view('companies');
		$this->load->view('templates/footer');
	}
}