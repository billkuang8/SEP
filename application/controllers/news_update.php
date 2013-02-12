<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_update extends Exec_Controller {

	function __construct()
	{
		parent::__construct();    
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index() 
	{
		$vars['message'] = $this->session->flashdata('message');
		$vars['news'] = $this->load_current_events();
		$headerData = $this->headerData;
		$headerData['js'] = array('jQuery.js', 'jquery.min.js', 'update.js', 'jQuery-UI.js');
		$headerData['css'] = array('update.css', 'internal.css');
		$this->load->view('templates/header', $headerData);
		$this->load->view('update_view', $vars);
		$this->load->view('templates/footer');
	}

	public function update()
	{
		$this->form_validation->set_rules('date', 'date', 'required|xss_clean');
		$this->form_validation->set_rules('title', 'title', 'required|xss_clean');
		$this->form_validation->set_rules('time', 'time', 'required|xss_clean');
		$this->form_validation->set_rules('location', 'location', 'required|xss_clean');
		$this->form_validation->set_rules('attire', 'attire', 'required|xss_clean');
		$this->form_validation->set_rules('news_update_message', 'Message', 'xss_clean');

		if($this->form_validation->run() == TRUE)
		{
			$date = htmlentities($this->input->post('date'));
			$title = htmlentities($this->input->post('title'));
			$time = htmlentities($this->input->post('time'));
			$location = htmlentities($this->input->post('location'));
			$attire = htmlentities($this->input->post('attire'));
			$message = htmlentities($this->input->post('news_update_message'));
			$month = substr($date, 0, 2);
			$day = substr($date, 3, 2);
			$year = substr($date, 6, 4);
			$entered_date = $year.$month.$day;
			$current_date = date('Ymd');

			if ($entered_date < $current_date) 
			{
				$message = 'The event time you\'ve entered has already passed.';
			}
			else if ($this->append_news($date, $title, $time, $location, $attire, $message)) 
			{
				$message = 'News has been updated. Click <a href="home">here</a> to go back to homepage.';
			} 
			else 
			{
				$message = 'Oops, something went wrong. Please try again.';
			}
			$this->sort_news();
			if (count(file(SEPFILES_BASE_PATH . 'news_update.html')) == 6) 
			{
				$this->file_functions->cutline(SEPFILES_BASE_PATH . 'news_update.html');
			}
		}
		else
		{
			$message = validation_errors();
		}
		$this->session->set_flashdata('message', $message);
		redirect('update');
	}

	private function replaceline($filename,$line_no=-1, $content) { 

		$strip_return=FALSE; 

		$data=file($filename); 
		$pipe=fopen($filename,'w'); 
		$size=count($data); 

		if($line_no==-1) { 
			$skip=$size-1; 
		} else {
			$skip=$line_no-1; 
		}

		for($line=0;$line<$size;$line++) { 
			if($line!=$skip) {
				fputs($pipe,$data[$line]); 
			} else {
				fputs($pipe,$content); 
				$strip_return=TRUE; 
			}
		}
		return $strip_return; 
	} 

	private function append_news($date, $title, $time, $location, $attire, $message) {
		$handle = fopen(SEPFILES_BASE_PATH . 'news_update.html', 'a');
		$log = '<div style="background-color: #f0f0f0; padding: 10px; font-size: 14px;"><span style="color: gray;">'.mysql_real_escape_string(htmlentities($date)).'</span><br><b>'.htmlentities($title).'</b><br />'.htmlentities($time).'<br />'.htmlentities($location).'<br />'.htmlentities($attire).'<br />'.str_replace("
		", "", nl2br(htmlentities($message))).'</div><br />
		';
		if (fwrite($handle, $log)) {
			fclose($handle);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function sort_news() {
		$data = file(SEPFILES_BASE_PATH . 'news_update.html');
		$handle = fopen(SEPFILES_BASE_PATH . 'news_update.html', 'w');
		$date = array();
		$current_date = date('Ymd');
		for ($lines = 0; $lines < count($data); $lines++) {
			$date[$lines] = substr($data[$lines], 105, 4).substr($data[$lines], 99, 2).substr($data[$lines], 102, 2);
		}

		sort($date);

		foreach ($date as $key => $val) {
			$sorted_date = substr($val, 4, 2).'/'.substr($val, 6, 2).'/'.substr($val, 0, 4);
			for ($number = 0; $number < count($data); $number++) {
				if (strpos($data[$number], $sorted_date) && $date[$number] >= $current_date) {
					fwrite($handle, $data[$number]);
					$data[$number] = '';
					break;
				}
			}
		}

		fclose($handle);

	}

	private function load_current_events() 
	{
		if(file_exists("SEPFiles/news_update.html") && filesize("SEPFiles/news_update.html") > 0){  
			$handle = fopen("SEPFiles/news_update.html", "r");  
			$contents = fread($handle, filesize("SEPFiles/news_update.html"));  
			fclose($handle);  
			return stripcslashes(html_entity_decode($contents));
		} else {
			return '';
		}
	}

}

?>