<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Active_forum extends Active_Controller 
{
  var $session_array;
  function __construct()
  {
    parent::__construct();
    $this->load->library('security');  
    $this->session_array = $this->session->userdata('logged_in');
  }
  
  public function index() 
  {
    $headerData = $this->headerData;
    $vars['lines_general'] = $this->file_functions->line_number_trim(SEPFILES_BASE_PATH . 'Forum/General/active_threads_log.html');
    $vars['last_general'] = $this->file_functions->last_line(SEPFILES_BASE_PATH . 'Forum/General/active_threads_log.html');
    $vars['lines_project'] = $this->file_functions->line_number_trim(SEPFILES_BASE_PATH . 'Forum/Project/active_threads_log.html');
    $vars['last_project'] = $this->file_functions->last_line(SEPFILES_BASE_PATH .'Forum/Project/active_threads_log.html');
    $vars['lines_misc'] = $this->file_functions->line_number_trim(SEPFILES_BASE_PATH . 'Forum/Misc/active_threads_log.html');
    $vars['last_misc'] = $this->file_functions->last_line(SEPFILES_BASE_PATH . 'Forum/Misc/active_threads_log.html');

    $headerData['js'] = array('bridge_main.js', 'threads.js');
    $headerData['css'] = array('style.css', 'internal.css');
    $headerData['title'] = "Discussion Board";
    
    $this->load->view('templates/header', $headerData);
    $this->load->view('active_thread_main_view', $vars);
    $this->load->view('templates/footer');          
  }
  
  
  public function load_thread_view($dir = "")
  {
    if($this->input->post('deleteid'))
    {
      $this->delete("thread", ucfirst($dir), $this->input->post('deleteid'));
    }
    $headerData = $this->headerData;
    if ($dir != "") 
    {
      if ($folder = $this->determine_folder($this->security->xss_clean($dir))) 
      {
        $vars['folder'] = $folder;        
      } 
      else 
      {
        redirect('active_forum');
      }
      
      $vars['uploaded_by'] = $this->session_array['id'];
      $vars['privilege'] = $this->session_array['privilege'];
      $vars['content'] = $this->file_functions->load_file(SEPFILES_BASE_PATH . 'Forum/' . $folder . '/active_threads_log.html');
      $headerData['js'] = array('jQuery.js', 'jquery.min.js', 'threads.js');
      $headerData['css'] = array('style.css', 'internal.css');
      $headerData['title'] = "Forum";
      $this->load->view('templates/header', $headerData);
      $this->load->view('active_threads_view', $vars);
      $this->load->view('templates/footer');
    }
  }
  
  public function load_discussion_view($dir, $id)
  {
    if($this->input->post('deleteid'))
    {
      $this->delete("discussion", ucfirst($dir), $id);
    }
    $headerData = $this->headerData;
    if ($id) 
    {
      //loads a discussion view
      $logFilePath = SEPFILES_BASE_PATH . 'Forum/' . ucfirst($dir)  . "/active_threads_log_" . $id . ".html";
      $identifier = $this->security->xss_clean($id);
      if(file_exists($logFilePath) && filesize($logFilePath) > 0)
      {  
            $handle = fopen($logFilePath, "r");  
              $contents = fread($handle, filesize($logFilePath));  
              fclose($handle);  
        $vars['content'] = stripcslashes(html_entity_decode($contents)); 
            } 
      else 
      {
        $vars['content'] = '';
      }
      $headerData['js'] = array('jQuery.js', 'jquery.min.js', 'jquery.cleditor.min.js', 'threads.js');
      $headerData['css'] = array('style.css', 'jquery.cleditor.css', 'internal.css');
      $headerData['title'] = "Forum";
      $vars['id'] = $id;
      $vars['dir'] = $dir;
      $vars['uploaded_by'] = $this->session_array['id'];
      $vars['privilege'] = $this->session_array['privilege'];
      $vars['identifier'] = $identifier;
      $this->load->view('templates/header', $headerData);
      $this->load->view('active_discussion_view', $vars);
      $this->load->view('templates/footer');
    }
  }
  
  private function delete($source, $folder, $id)
  {
    $deleteid = $this->input->post('deleteid');
    if ($source == 'discussion') 
    {
      $this->file_functions->cutline(SEPFILES_BASE_PATH . 'Forum/' . $folder . '/active_threads_log_'. $id . '.html', $deleteid);
      redirect('active_forum/load_discussion_view/'.strtolower($folder).'/'.$id);
    }
    else if($source == 'thread')
    {
      $this->delete_post($folder, $id);
    }
  }
        
  public function discussion_action($dir, $id)
  {    
    if ($this->input->post('post')) 
    {
      $post = $this->security->xss_clean($this->input->post('post'));
      $this->update_discussion_log($post, $id, ucfirst($dir), $this->session_array['user_name']);
      redirect('active_forum/load_discussion_view/'.$dir.'/'.$id);
    }    
  } 
        
  public function thread_action($dir)
  {
    $directory = $this->determine_folder($this->security->xss_clean($dir));
    if ($this->input->post('new_post'))
    {
      $this->update_thread_log($dir);
      redirect('active_forum/load_thread_view/'.strtolower($directory));
    }
  }
  
  
  private function determine_folder($directory) {
    if ($directory == 'general') {
      return 'General';
    } else if ($directory == 'project') {
      return 'Project';
    } else if ($directory == 'misc') {
      return 'Misc';
    } else if ($directory == 'general_discussion') {
      return 'General';
    } else if ($this->security->xss_clean($this->input->get('directory')) == 'project_discussion') {
      return 'Project';
    } else if ($this->security->xss_clean($this->input->get('directory')) == 'misc_discussion') {
      return 'Misc';
    } else {
      return FALSE;
    }
  }

  private function update_thread_log($dir) 
  {
      $message = $this->security->xss_clean($this->input->post('new_post'));
    $post = $this->security->xss_clean($this->input->post('post'));
    
    if (!empty ($message)) {
      if ($dir == 'general') {
        $folder = 'General';
      } else if ($dir == 'project') {
        $folder = 'Project';
      } else if ($dir == 'misc') {
        $folder = 'Misc';
      } else {
        redirect('active_forum');
      }
      $active_thread_logs_path = SEPFILES_BASE_PATH . 'Forum/' . $folder . '/active_threads_log.html';
      
      $new_identifier = $this->file_functions->line_number($active_thread_logs_path);
        $handle = fopen($active_thread_logs_path, 'a');
        $log = "<br><br><div uploaded_by='".$this->session_array['user_name']."' class=\"thread\" id='".($new_identifier+1)."' style=\"border-bottom: 1px dotted black;\"><b class=\"topic\"><a class=\"link\" identifier='".($new_identifier + 1)."' href=\"".DOMAIN_BASE_PATH."active_forum/post/".strtolower($folder)."/".($new_identifier+1)."\">".str_replace("
", "", nl2br(htmlentities($message)))."</a></b><a style='float: right;' class='delete' href='javascript:void(0);'>Delete</a><br><span>Posted by <b>".$this->session_array['user_name']."</b> on ".date('D, M d h:i:s a')."</span></div>
";
        fwrite($handle, $log);
        fclose($handle);
      
      $count = $this->file_functions->line_number($active_thread_logs_path);
      
      $handle1 = fopen(SEPFILES_BASE_PATH ."Forum/". $folder ."/active_threads_log_".$count.".html", 'a');
      $log = "<h1>Discussion</h1><a href=\"".DOMAIN_BASE_PATH."active_forum\">Main</a><span> -> </span><a href=\"".DOMAIN_BASE_PATH."active_forum/load_thread_view/".strtolower($folder)."\">".$folder." Topics</a><span> -> </span><a href=\"javascript:void(0);\">".$message."</a><hr><span style=\"font-weight: bold; margin-left: 20px; font-size: 14px;\">".$message."</span><div class=\"forum_post\" style=\"border-bottom: 1px dotted black;\">".str_replace("
", "", nl2br(htmlentities($post)))."<br><br><br><span>Posted by <b>".$this->session_array['user_name']."</b> on ".date('D, M d h:i:s a')."</span></div>
";
      fwrite($handle1, $log);
      fclose($handle1);
    }
  }

  private function update_discussion_log($post, $identifier, $folder, $uploaded_by) {
    
    $new_identifier = $this->file_functions->line_number(SEPFILES_BASE_PATH . 'Forum/' . $folder . '/active_threads_log_'.$identifier.'.html') + 1;
    
    $handle = fopen(SEPFILES_BASE_PATH. 'Forum/' . $folder ."/active_threads_log_".$identifier.".html", 'a');
    $log = "<br><div identifier='".$identifier."' id='".$new_identifier."' uploaded_by='".$uploaded_by."' class='thread_div'><span style=\"color: gray; margin-left: 20px;\">Response:</span><a class='delete' style='float: right;' href='javascript:void(0);'>Delete</a><div class=\"forum_post\" style=\"border-bottom: 1px dotted black;\">".str_replace("
", "", nl2br(htmlentities($post)))."<br><br><br><span>Posted by <b>".$uploaded_by."</b> on ".date('D, M d h:i:s a')."</span></div></div>
";
    fwrite($handle, $log);
    fclose($handle);
  }
  
  private function delete_post($folder, $id) {
    $this->file_functions->cutline(SEPFILES_BASE_PATH . 'Forum/' . $folder.'/active_threads_log.html', $id);
    unlink(SEPFILES_BASE_PATH . 'Forum/'.$folder.'/active_threads_log_'.$id.'.html');
    redirect('active_forum/load_thread_view/'.strtolower($directory));
  }
  
}

?>