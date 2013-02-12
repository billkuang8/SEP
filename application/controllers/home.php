<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends SEP_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  
  function index()
  {
	
    $headerData = $this->headerData;
    $headerData['css'] = array('index.css');
    $headerData['js'] = array('index.js', 'about.js');
    $vars['content'] = $this->getEvents();
    $this->load->view('templates/header', $headerData);
    $this->load->view('home_old', $vars);
    $this->load->view('templates/footer');
    
  
    
    if (filesize(SEPFILES_BASE_PATH . 'counter.txt') == 0) {
      $handle = fopen(SEPFILES_BASE_PATH . 'counter.txt', 'w');
      fwrite($handle, '1');
      fclose($handle);
    } else {
      $handle = fopen(SEPFILES_BASE_PATH . 'counter.txt', 'r');
      $current_count = fread($handle, filesize(SEPFILES_BASE_PATH . 'counter.txt'));
      fclose($handle);
      
      $handle2 = fopen(SEPFILES_BASE_PATH . 'counter.txt', 'w');
      fwrite($handle2, $current_count + 1);
      fclose($handle2);
    }
  }
  
  private function getEvents()
  {
    if(file_exists(SEPFILES_BASE_PATH . 'news_update.html') && filesize(SEPFILES_BASE_PATH . 'news_update.html') > 0)
    {  
      $handle = fopen(SEPFILES_BASE_PATH . 'news_update.html', "r");  
      $contents = fread($handle, filesize(SEPFILES_BASE_PATH . 'news_update.html'));  
      fclose($handle);  
      return stripcslashes(html_entity_decode($contents));
    }
  }
  
  
  /*function brothers()
  {
    $data['title'] = 'Sigma Eta Pi - UC Berkeley';
    $data['css'] = array('gallery.css');
    $data['js'] = array('gallery.js', 'profile_update.js');
    $data['logout'] = $this->utils->logout_include();
    $data['dropdown'] = $this->utils->dropdown_include();
    $this->load->view('templates/header', $data);
    $this->load->view('brothers');
    $this->load->view('templates/footer');
}*/

}
?>