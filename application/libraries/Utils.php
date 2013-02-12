<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Utils
{	
	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->library('session');
	}
	
	function loggedin() {
		$CI =& get_instance();
		$CI->load->library('session');
		if ($CI->session->userdata('logged_in')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function logout_include() 
	{ 
		$CI =& get_instance();
		$CI->load->library('session');
		if ($CI->session->userdata('logged_in')) {
			$session = $CI->session->userdata('logged_in');
			return 'Welcome, <strong>'.$session['user_name'].'!</strong> <br> [ <a href="'.DOMAIN_BASE_PATH.'change_pw">Change Password</a> | <a href="'.DOMAIN_BASE_PATH.'logout" >Logout</a> ]';
		} else {
			return '';
		}
	}

	function is_exec() {
		$CI =& get_instance();
		$CI->load->library('session');
		if ($this->loggedin()) {
			$session = $CI->session->userdata('logged_in');
			if ($session['privilege'] == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function is_active() {
		$CI =& get_instance();
		$CI->load->library('session');
		if ($this->loggedin()) {
			$session = $CI->session->userdata('logged_in');
			if ($session['privilege'] == 2) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function is_pledge() {
		$CI =& get_instance();
		$CI->load->library('session');
		if ($this->loggedin()) {
			$session = $CI->session->userdata('logged_in');
			if ($session['privilege'] == 3) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function dropdown_include() {
		$CI =& get_instance();
		$CI->load->library('session');
		if ($this->is_exec()) {
			return '<ul class="sub">
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'calendar">CALENDAR</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'update">EVENT UPDATE</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'pledge_forum">PLEDGE\'S FORUM</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'active_forum">ACTIVE\'S FORUM</a></li>
				<li class="mid"><a style="border: none;" href="'.DOMAIN_BASE_PATH.'pledge_files">PLEDGE\'S FILES</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'active_files">ACTIVE\'S FILES</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'view_contact">MESSAGES</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'view_applications">VIEW APPLICATIONS</a></li>
			</ul>';
		} else if ($this->is_active()) {
			return '<ul class="sub">
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'calendar">CALENDAR</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'view_contact">MESSAGES</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'active_forum">ACTIVE\'S FORUM</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'active_files">ACTIVE\'S FILES</a></li>
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'pledge_forum">PLEDGE\'S FORUM</a></li>
				<li class="mid"><a style="border: none;" href="'.DOMAIN_BASE_PATH.'pledge_files">PLEDGE\'S FILES</a></li>
			</ul>';
		} else if ($this->is_pledge()) {
			return '<ul class="sub">
				<li class="mid"><a href="'.DOMAIN_BASE_PATH.'pledge_forum">FORUM</a></li>
				<li class="mid"><a style="border: none;" href="'.DOMAIN_BASE_PATH.'pledge_files">FILES</a></li>
				</ul>';
		} else {
			return '';
		}
	}

}


?>