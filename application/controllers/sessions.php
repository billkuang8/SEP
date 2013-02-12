<?php
class Sessions extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
  }
  
  function login($msg = "")
  {
    if ($this->utils->loggedin()) {
      redirect('home');
    } else {
      if($msg == "")
      {
        $data['error_msg'] = "";
      }
      else
      {
        $data['error_msg'] = $msg;
      }
      $this->load->helper('form');
      $data['title'] = 'Sigma Eta Pi - UC Berkeley';
      $data['js'] = array('login_dialog.js');
      $data['logout'] = $this->utils->logout_include();
      $data['dropdown'] = $this->utils->dropdown_include();
      $this->load->view('templates/header', $data);
      $this->load->view('login', $data);
      $this->load->view('templates/footer');
    }
  }
  
  
  function authenticate()
  {
    if ($this->utils->loggedin()) {
      redirect('home');
    } else {
      $this->load->model('user', '', true);
      $username = $this->input->post('username');
      $result = $this->user->authenticate($username, md5($this->input->post('password')));
      if($result)
      {
        $session_array = array('id' => $result->id, 'user_name' => $result->firstname . " " . $result->lastname, 'privilege' => $result->privilege);
        $this->session->set_userdata('logged_in', $session_array);
        header('Location: internal');
      }
      else
      {
        $this->login("Incorrect login");
      }
    }
  }
  
  function logout()
  {
    $this->session->unset_userdata('logged_in');
    header('Location: http://www.berkeleysep.com/home');
  }
  
  /*function registration()
  {
    $this->load->helper('form');
    
    $data['title'] = 'Registration';
    $data['js'] = array('registration_dialog.js');
    $this->load->view('templates/header', $data);
    $this->load->view('registration');
  }
  
  
  function register()
  {
    $data['firstname'] = $this->input->post('username');
    $data['lastname'] = $this->input->post('lastname');
    $data['email'] = $this->input->post('email');
    $data['username'] = $this->input->post('username');
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('firstname', 'First name', 'required|xss_clean');
    $this->form_validation->set_rules('lastname', 'Last name', 'required|xss_clean');
    $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|matches[password_confirmation]|md5');
    $this->form_validation->set_rules('password_confirmation', 'Password confirmation', 'required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
    
    if($this->form_validation->run() == FALSE)
    {
      $this->registration();
    }
    else
    {
      $this->load->model('user', '', true);
    }  
  }*/
}

?>