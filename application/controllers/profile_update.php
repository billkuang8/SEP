<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_update extends Active_Controller 
{
  
  private $vars;
  
  function __construct() {
    parent::__construct();
    
    //loads essentials
    $this->load->library('security');
    $this->load->library('image_lib');
  }
  
  public function index() 
  {
    //if profile update form is submitted
    if ($this->input->post('name')) {
      $this->vars['error'] = $this->update_profiles();
    } else {
      $this->vars['error'] = '';
    }
    
    $headerData = $this->headerData;
    $headerData['css'] = array('gallery.css');
    $headerData['js'] = array('profile_update.js');
    
    $this->load->view('templates/header', $headerData);
    $this->load->view('profile_update_view', $this->vars);
    $this->load->view('templates/footer');
  }
  
  private function sort_profile($filename) 
  {
    $data = file($filename);
    $handle = fopen($filename, 'w');
    $name = array();
    for ($lines = 0; $lines < count($data); $lines++) {
      $name_length = strpos($data[$lines], 'filename') - 13;
      $name[$lines] = substr($data[$lines], 11, $name_length);
    }
    
    sort($name);
    
    foreach ($name as $key => $val) {
      for ($number = 0; $number < count($data); $number++) {
        if (strpos($data[$number], $val)) {
          fwrite($handle, $data[$number]);
          break;
        }
      }
    }
    
    fclose($handle);
    
  }
  
  private function update_profiles()
   {
    $session = $this->session->userdata('logged_in');
    $name = $this->security->xss_clean($this->input->post('name'));
    $major = $this->security->xss_clean($this->input->post('major'));
    $year = $this->security->xss_clean($this->input->post('year'));
    $occupation = $this->security->xss_clean($this->input->post('occupation'));
    $position = $this->security->xss_clean($this->input->post('position'));
    
    if (!empty($_FILES['file']['name']) && substr($_FILES['file']['type'], 0, 5) == 'image') 
    {
      $filename = $this->security->sanitize_filename($_FILES['file']['name']);
      $temp_filename = $_FILES['file']['tmp_name'];
      $location = SEPFILES_BASE_PATH . 'profiles/';
      move_uploaded_file($temp_filename, $location.$filename);
      $this->resize_image($location.$filename);
    }
    else 
    {
      $filename = 'question.jpg';
    }
    return $this->write_to_profile_log($name, $major, $year, $occupation, $position, $filename, $session);      
  }
  
  private function resize_image($path)
  {
    list($width, $height, $type, $attr) = getimagesize($path);
  
    if($width/$height == 170/150)
    {
      return;
    }
    
    $config['image_library'] = 'gd2';
    $config['maintain_ratio'] = TRUE;
    $config['source_image'] = $path;
    if($width > 2000)
    {
      $width = $width / 4;
      $height = $height / 4;
      $config['width'] = $width;
      $config['height'] = $height;
    }
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    $config['maintain_ratio'] = FALSE;
    if($width > $height * 170 / 150)
    {
      $config['x_axis'] = ($width - 170 / 150 * $height) / 2;
      $config['width'] = 170 / 150 * $height;
    }
    else
    {
      $config['y_axis'] = ($height - 150 / 170 * $width) / 2;
      $config['height'] = 150 / 170 * $width;
    }
  
    $this->image_lib->initialize($config);
    if(! $this->image_lib->crop())
    {
      return  $this->image_lib->display_errors();
    }
    $this->image_lib->clear();
  }
  
  private function write_to_profile_log($name, $major, $year, $occupation, $position, $filename, $session)
  {
    if (!empty($name) && strpos($this->file_functions->load_file(SEPFILES_BASE_PATH . 'profiles/profile_log_'.$occupation.'.html'), 'div name="'.$name.'"') == FALSE) 
    {
      $handle = fopen(SEPFILES_BASE_PATH . 'profiles/profile_log_'.$occupation.'.html', 'a');
      $log = '<div name="'.$name.'" filename="'.$filename.'" occupation="'.($occupation).'" class="container" id="'.md5($name).'" uploaded_by="'.$session['id'].'"><div class="image_container"><img src="'.SEPFILES_BASE_PATH.'profiles/'.$filename.'" /></div><div class="info_container"><span style="color: #f48225; font-size: 14px;">'.htmlentities($name).'</span><br><span>Major: '.htmlentities($major).'</span><br><span>Year: '.htmlentities($year).'</span><br><a href="javascript:void(0);" class="description_dialog" info="'.str_replace("
", "", nl2br(htmlentities($this->security->xss_clean($this->input->post('description'))))).'">View description here</a></div><a href="javascript:void(0);" class="delete">x</a></div>';
      if (fwrite($handle, $log."\n"))
      {
        fclose($handle);
        $this->sort_profile(SEPFILES_BASE_PATH . 'profiles/profile_log_'.$occupation.'.html');
        return 'Successfully uploaded! Click <a href="brothers">here</a> to view.';
      } 
      else 
      {
        return 'Oops, something went wrong. Please try again.';
      }
    } 
    else 
    {
      return 'Please enter your name and check that it does not already exist.';
    }
  }
  
  
  
}

?>