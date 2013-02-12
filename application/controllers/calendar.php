<?php

class Calendar extends Active_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index() 
	{
		$this->load->view('calendar_view');
	}
	
}

?>