<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pledge_Controller extends SEP_Controller
{
	var $headerData;
	
	function __construct()
	{
		parent::__construct();
		if (!$this->utils->loggedin()) 
		{
			redirect('login');
		}
	}
}

?>