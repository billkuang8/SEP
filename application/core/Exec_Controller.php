<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exec_Controller extends Active_Controller
{
	var $headerData;
	
	function __construct()
	{
		parent::__construct();
		if(!$this->utils->is_exec())
		{
			redirect('home');
		} 
	}
}

?>