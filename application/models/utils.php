<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Utils extends CI_Model
{

public function line_number($filename) 
{
	$lines = 0;
	if (file_exists($filename)) {
		$data = file($filename);
		for ($count = 0; $count < count($data); $count++) {
			$line = $data[$count];
			if ($line != '') {
				$lines++;
			}
		}
		return $lines;
	} else {
		return 0;
	}
}

function loggedin() {
	if ($this->session->userdata('logged_in')) {
		return TRUE;
	} else {
		return FALSE;
	}
}

public function logout_include() 
{ 
	if ($this->session->userdata('logged_in')) {
		$session = $this->session->userdata('logged_in');
		return 'Welcome, <strong>'.$session['user_name'].'!</strong> &nbsp; <a href="logout" style="text-decoration: underline !important;">Logout</a>';
	} else {
		return '';
	}
}

function is_exec() {
	if ($this->loggedin()) {
		$session = $this->session->userdata('logged_in');
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
	if ($this->loggedin()) {
		$session = $this->session->userdata('logged_in');
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
	if ($this->loggedin()) {
		$session = $this->session->userdata('logged_in');
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
	if ($this->is_exec()) {
		return '<ul class="sub">
			<li class="mid"><a href="calendar">CALENDAR</a></li>
			<li class="mid"><a href="view_contact">MESSAGES</a></li>
			<li class="mid"><a href="update">UPDATE EVENTS</a></li>
			<li class="mid"><a href="update_rush">UPDATE RUSH</a></li>
			<li class="mid"><a href="active_forum">ACTIVE\'S FORUM</a></li>
			<li class="mid"><a href="active_files">ACTIVE\'S FILES</a></li>
			<li class="mid"><a href="http://www.google.com">PLEDGE\'S FORUM</a></li>
			<li class="mid"><a style="border: none;" href="pledge_files">PLEDGE\'S FILES</a></li>
		</ul>';
	} else if ($this->is_active()) {
		return '<ul class="sub">
			<li class="mid"><a href="calendar">CALENDAR</a></li>
			<li class="mid"><a href="view_contact">MESSAGES</a></li>
			<li class="mid"><a href="active_forum">ACTIVE\'S FORUM</a></li>
			<li class="mid"><a href="active_files">ACTIVE\'S FILES</a></li>
			<li class="mid"><a href="pledge_forum">PLEDGE\'S FORUM</a></li>
			<li class="mid"><a style="border: none;" href="pledge_files">PLEDGE\'S FILES</a></li>
		</ul>';
	} else if ($this->is_pledge()) {
		return '<ul class="sub">
			<li class="mid"><a href="pledge_forum">FORUM</a></li>
			<li class="mid"><a style="border: none;" href="pledge_files">FILES</a></li>
			</ul>';
	} else {
		return '';
	}
}
}