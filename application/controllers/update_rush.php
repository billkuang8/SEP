<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_rush extends Exec_Controller 
{  
  function __construct()
  {
    parent::__construct();
    $this->load->library('security');
    $this->load->helper('file');    
  }
  
  public function index() 
  {
    $vars['update_message'] = $this->session->flashdata('update_message');
    $vars['existingContent'] = read_file(SEPFILES_BASE_PATH . "rush_update.html");
    $headerData = $this->headerData;
    $headerData['js'] = array('jquery.min.js', 'update_rush.js', 'rush.js');
    $headerData['css'] = array('rush_update.css', 'internal.css');
    $this->load->view('templates/header', $headerData);
    $this->load->view('update_rush_view', $vars);
    $this->load->view('templates/footer');
  }
  
  public function submit()
  {
    if ($this->input->post('update_box')) 
    {
      $message = str_replace("
", "", nl2br(htmlentities($this->security->xss_clean($this->input->post('update_box')))));
      
      //updates the message
      if ($this->update_rush_message($message)) 
      {
        $this->session->set_flashdata('update_message', '<b>Update successful. Click <a href="rush">here</a> to view.</b><br><br>');
      } 
      else 
      {
         $this->session->set_flashdata('update_message', '<b>Something went wrong. Please try again.</b>');
      }
    } 
    else if (isset($_FILES['file']['name'])) 
    {  
      //updates the application files
      $filename = $_FILES['file']['name'];
      
      //sanitizes file names to prevent directory traversal
      for ($i = 0; $i < count($filename); $i++) {
        $filename[$i] = $this->security->sanitize_filename($filename[$i]);
      }
      
      $filesize = $_FILES['file']['size'];
      $filetype = $_FILES['file']['type'];
      $temp_filename = $_FILES['file']['tmp_name'];
      
      if ($this->update_rush_files($filename, $filesize, $filetype, $temp_filename))
      {
        $this->session->set_flashdata('update_message', '<b>Update successful. Click <a href="rush">here</a> to view.</b><br><br>');
      } 
      else 
      {
         $this->session->set_flashdata('update_message', '<b>Cannot upload empty files.</b>');
      }
    }
    redirect('update_rush');
  }
  
  private function update_rush_message($message) {
    $handle = fopen(SEPFILES_BASE_PATH . 'rush_update.html', 'w');
    $log = $message;
    if (fwrite($handle, $log)) 
    {
      fclose($handle);
      if (file_exists(SEPFILES_BASE_PATH . 'logs/update_rush_file.html')) {
        unlink(SEPFILES_BASE_PATH . 'logs/update_rush_file.html');
      }
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  private function update_rush_files($filename, $filesize, $filetype, $temp_filename) {
    if (!empty($filename[0])) {
      $location = SEPFILES_BASE_PATH . 'rush_application/';
      $handle = fopen(SEPFILES_BASE_PATH . 'logs/update_rush_file.html', 'w');
      fwrite($handle, '<ol>');
      for ($length = 0; $length < count($filename); $length++) {
        if (!file_exists(SEPFILES_BASE_PATH . 'rush_application/'.$filename[$length]) && $this->file_functions->is_allowed($filename[$length])) {
          if (move_uploaded_file($temp_filename[$length], $location.$filename[$length])) {
            $content = '<li><a href="' . SEPFILES_BASE_PATH . 'rush_application/'.$filename[$length].'">'.$filename[$length].'</a></li>';
            fwrite($handle, $content);
          }
        } else {
          @unlink(SEPFILES_BASE_PATH . 'rush_application/'.$filename[$length]);
          if (move_uploaded_file($temp_filename[$length], $location.$filename[$length])) {
            $content = '<li><a href="' . SEPFILES_BASE_PATH . 'rush_application/'.$filename[$length].'">'.$filename[$length].'</a></li>';
            fwrite($handle, $content);
          }
        }
      }
      fwrite($handle, '</ol>');
      fclose($handle);
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
}

?>