<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_applications extends Active_Controller 
{  
    function __construct()
    {
      parent::__construct();
      $this->load->library('security');  
    }
    
    public function index() 
    {
        $query = "SELECT `name` FROM `applications` ORDER BY `name` ASC";
        $result = $this->db->query($query);

        $names = "";
        foreach ($result->result_array() as $row)
        {
            $names .= '<span style="margin-right: 130px; margin-top: 30px; display: inline-block;"><a href="view_applications/view/'.$row['name'].'">'.$row['name'].'</a></span>';
        }

        $vars['names'] = $names;
        $headerData = $this->headerData;
        $headerData['js'] = array('jquery.min.js', 'view_applications.js');
        $headerData['css'] = array('rush_update.css', 'internal.css');
        $this->load->view('templates/header', $headerData);
        $this->load->view('view_applications_view', $vars);
        $this->load->view('templates/footer');
    }

    public function view($name)
    {
        $query = "SELECT name, year, major, units, gpa, q1, q2, sa1, sa2, sa3, sa4, resume, picture FROM `applications` WHERE name = '".str_replace("%20", " ", $name)."'";
        $result = $this->db->query($query);

        $row = $result->row_array();
        
        $vars['name'] = $this->security->xss_clean($row['name']);
        $vars['year'] = $this->security->xss_clean($row['year']);
        $vars['major'] = $this->security->xss_clean($row['major']);
        $vars['units'] = $this->security->xss_clean($row['units']);
        $vars['gpa'] = $this->security->xss_clean($row['gpa']);
        $vars['q1'] = $this->security->xss_clean($row['q1']);
        $vars['q2'] = $this->security->xss_clean($row['q2']);
        $vars['sa1'] = $this->security->xss_clean($row['sa1']);
        $vars['sa2'] = $this->security->xss_clean($row['sa2']);
        $vars['sa3'] = $this->security->xss_clean($row['sa3']);
        $vars['sa4'] = $this->security->xss_clean($row['sa4']);
        $start = strpos($row['resume'], 'SEPFiles/');
        $vars['resume'] = substr($this->security->xss_clean($row['resume']), $start - 1);
        $vars['pic'] = substr($this->security->xss_clean($row['picture']), $start - 1);

        $headerData = $this->headerData;
        $headerData['js'] = array('jquery.min.js', 'view_applications.js');
        $headerData['css'] = array('rush_update.css', 'internal.css');
        $this->load->view('templates/header', $headerData);
        $this->load->view('view_applicant', $vars);
        $this->load->view('templates/footer');
    }
  
}

?>