<?php
class Internal extends CI_Controller
{
  function __construct()
  {
    parent::__construct();    
    if(!$this->utils->loggedin())
    {
      redirect('login');
    }
  }
  public function index() {

      $data['dropdown'] = $this->utils->dropdown_include();
      $data['logout'] = $this->utils->logout_include();
      $data['css'] = array('internal.css');
      $data['js'] = array('internal.js');
      
      $hits = file(SEPFILES_BASE_PATH . 'counter.txt');
      $vars['hits'] = $hits[0];
      
      $data['title'] = 'Sigma Eta Pi - UC Berkeley';
      $this->load->view('templates/header', $data);
      $vars['permission'] = $this->get_permission();
      $this->load->view('internal', $vars);
      $this->load->view('templates/footer');
  }
  
  private function get_permission() {
    if ($this->utils->is_exec()) {
      return 1;
    } else if ($this->utils->is_active()) {
      return 2;
    } else if ($this->utils->is_pledge()) {
      return 3;
    } else {
      return -1;
    }
  }
  

}

?>