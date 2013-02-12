<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Active_Controller extends Pledge_Controller
{
	var $headerData;
	
	function __construct()
	{
		parent::__construct();
		if($this->utils->is_pledge())
		{
			redirect('home');
		}

	}
}

?>