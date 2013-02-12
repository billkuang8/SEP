<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends SEP_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('file');
    $this->load->library('form_validation');
  }
  
  function index()
  {
    $headerData = $this->headerData;
    $vars['success'] = $this->session->flashdata('success');
    $vars['errors'] = $this->session->flashdata('errors');
    $headerData['css'] = array('style.css', 'contact.css');
    $headerData['js'] = array('jQuery.js', 'contact.js', 'jQuery-UI.js');
    $this->load->view('templates/header', $headerData);

    $this->load->view('contact', $vars);
  
    $this->load->view('templates/footer');
  }
  
  function submit()
  {
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
    $this->form_validation->set_rules('message', 'message', 'xss_clean');
    $this->form_validation->set_message('required', "The email field must contain a valid email address.");
    
    if($this->form_validation->run() == TRUE)
    {
      $id = $this->file_functions->line_number(SEPFILES_BASE_PATH . 'messages.html') + 1;
      $email = $this->input->post('email');
      $message = $this->input->post('message');
      $handle = fopen(SEPFILES_BASE_PATH . 'messages.html', 'a');
      $log = "<div id='" . $id . "'><br><span style=\"font-weight: bold;   margin-left: 20px;\">From: ".$email."</span><a class='reply' id='".$id."'style='float: right; margin-right: 20px;' href='javascript:void(0);'>Just replied! Click here to delete.</a><div class=\"forum_post\" style=\"border-bottom: 1px dotted black;\">".str_replace("
", "", nl2br(htmlentities($message)))."<br><br><span>Sent on ".date('D, M d h:i:s a')."</span></div></div><br>\n";
      if(fwrite($handle, $log))
      {  
        $this->session->set_flashdata('success', TRUE); 
      }
      else
      {
        $this->session->set_flashdata('errors', '<b>Oops. Something went wrong. Please try again.</b>');
      }
      fclose($handle);
    }
    else
    {
      $this->session->set_flashdata('errors', validation_errors());
    }
    redirect('contact');
  }
}