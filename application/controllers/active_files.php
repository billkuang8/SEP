<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//TODO: change file paths to use constants
class Active_files extends Active_Controller {

	private $vars;
	
	function __construct() 
	{
		parent::__construct();
		
		//load essentials
		$this->load->library('security');
		
		//initializes global variable
		$session = $this->session->userdata('logged_in');
		$this->vars['chain'] = $this->chain();
		$this->vars['logged_in_as'] = $session['id'];
		$this->vars['privilege'] = $session['privilege'];
		$this->vars['content'] = $this->load_uploaded_files();
		if (isset($_GET['folder_id'])) {
			$this->vars['file_action'] = 'active_files/upload_files?folder_id='.$_GET['folder_id'];
		} else {
			$this->vars['file_action'] = 'active_files/upload_files';
		}
		if (isset($_GET['folder_id'])) {
			$this->vars['folder_action'] = 'active_files/create_folder?folder_id='.$_GET['folder_id'];
		} else {
			$this->vars['folder_action'] = 'active_files/create_folder';
		}
		if (isset($_GET['folder_id'])) {
			$this->vars['action'] = 'active_files?folder_id='.$_GET['folder_id'];
		} else {
			$this->vars['action'] = 'active_files';
		}
	}
	
	public function index() {
		$headerData = $this->headerData;
		$headerData['title'] = 'File Upload';
		$headerData['css'] = array('files.css', 'internal.css');
		$this->load->view('templates/header', $headerData);
		$this->load->view('active_files_view', $this->vars);
		$this->load->view('templates/footer');
	}
	
	function upload_files() {
		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
			//sanitizes file names to prevent directory traversal
			for ($i = 0; $i < count($filename); $i++) {
				$filename[$i] = $this->security->sanitize_filename($filename[$i]);
			}
			$filesize = $_FILES['file']['size'];
			$filetype = $_FILES['file']['type'];
			$temp_filename = $_FILES['file']['tmp_name'];
			if (!empty($filename)) {
				
				$session = $this->session->userdata('logged_in');
				
				//sets the directory to be uploaded
				if (!isset($_GET['folder_id'])) {
					$location = SEPFILES_BASE_PATH . 'active_upload';
					$handle = fopen(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_main.html', 'a');
					$id = $this->file_functions->line_number(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_main.html') + 1;
				} else {
					$array = explode('_', $_GET['folder_id']);
					$array[0] = 'active_upload';
					$location = SEPFILES_BASE_PATH . implode('/', $array);
					$handle = fopen(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$_GET['folder_id'].'.html', 'a');
					$id = $this->file_functions->line_number(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$_GET['folder_id'].'.html') + 1;
				}
				for ($length = 0; $length < count($filename); $length++) {
					if (!file_exists($location.'/'.$filename[$length]) && $this->file_functions->is_allowed($filename[$length])) {
						if (move_uploaded_file($temp_filename[$length], $location.'/'.$this->security->sanitize_filename($filename[$length]))) {
							$log = '<tr style="text-align: center; font-size: 12px;"><td><a href="'.$location.'/'.$filename[$length].'">'.$filename[$length].'</a><br></td><td>'.$session['user_name'].'</td><td>'.date('D, M d h:i:s a').'</td><td>'.$filetype[$length].'</td><td>'.$filesize[$length].' kb</td><td><a link_type="file" id="'.$id.'" filename="'.$filename[$length].'" uploaded_by="'.$session['id'].'" class="remove" href="javascript:void(0);">Remove</a></td></tr>
';				
							$id++;
							fwrite($handle, $log);
						}
					}
				}
				fclose($handle);
			}
		}
		
		redirect($this->vars['action']);
	}

	function create_folder() {
		if (isset($_POST['folder'])) {
			$folder_name = str_replace('_', ' ', $this->security->xss_clean($_POST['folder']));
			$session = $this->session->userdata('logged_in');
			if (!empty($_POST['folder'])) {
				if (!isset($_GET['folder_id'])) {
					$location = SEPFILES_BASE_PATH . 'active_upload';
					if (!file_exists($location.'/'.$folder_name)) {
						mkdir($location.'/'.$folder_name);
					}
					$folder_id = 'main_'.$folder_name;
					$handle = fopen(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_main.html', 'a');
					$id = $this->file_functions->line_number(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_main.html') + 1;
					if (!file_exists(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html')) {
						$log = '<tr style="text-align: center; font-size: 12px;"><td><a class="folder_link" current="main" href="active_files?folder_id='.$folder_id.'">'.$folder_name.'</a><br></td><td></td><td>'.date('D, M d h:i:s a').'</td><td>Folder</td><td></td><td><a link_type="folder" id="'.$id.'" filename="'.$folder_id.'" uploaded_by="'.$session['id'].'" class="remove" href="javascript:void(0);">Remove</a></td></tr>
';
						fwrite($handle, $log);
					}
					fclose($handle);
					$handle_temp = fopen(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html', 'w');
					fclose($handle_temp);
				} else {
					$array = explode('_', $_GET['folder_id']);
					$array[0] = 'active_upload';
					$location = SEPFILES_BASE_PATH . implode('/', $array);
					if (!file_exists($location.'/'.$folder_name)) {
						mkdir($location.'/'.$folder_name);
					}
					$folder_id = $_GET['folder_id'].'_'.$folder_name;
					$handle = fopen(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$_GET['folder_id'].'.html', 'a');
					$id = $this->file_functions->line_number(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$_GET['folder_id'].'.html') + 1;
					if (!file_exists(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html')) {
						$log = '<tr style="text-align: center; font-size: 12px;"><td><a class="folder_link" current="'.$_GET['folder_id'].'" href="active_files?folder_id='.$folder_id.'">'.$folder_name.'</a><br></td><td></td><td>'.date('D, M d h:i:s a').'</td><td>Folder</td><td></td><td><a link_type="folder" id="'.$id.'" filename="'.$folder_id.'" uploaded_by="'.$session['id'].'" class="remove" href="javascript:void(0);">Remove</a></td></tr>
';
						fwrite($handle, $log);
					}
					fclose($handle);
					$handle_temp = fopen(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html', 'a');
					fclose($handle_temp);
				}
			}
		}
		redirect($this->vars['action']);
	}
	
	function delete_file_folder() {
		if (isset($_POST['id']) && isset($_POST['filename']) && isset($_POST['location']) && isset($_POST['type'])) {
			$temp_id = $_POST['id'];
			$temp_filename = $_POST['filename'];
			$temp_location = $_POST['location'];
			$temp_type = $_POST['type'];
			if (isset($_GET['folder_id'])) {
				$folder_id = $_GET['folder_id'];
			} else {
				$folder_id = 'main';
			}
			if ($temp_type == 'file') {
				$data = file(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html');
				$delete_line = -1;
				for ($i = 0; $i < count($data); $i++) {
					if (strpos($data[$i], 'link_type="file" id="'.$temp_id.'"')) {
						$delete_line = $i + 1;
					}
				}
				$array = explode('_', $folder_id);
				$array[0] = 'active_upload';
				unlink(SEPFILES_BASE_PATH . implode('/', $array).'/'.$temp_filename);
				$this->file_functions->cutline(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html', $delete_line);
			} else {
				$array = explode('_', $temp_filename);
				$array[0] = 'active_upload';
				$this->deleteDirectory(SEPFILES_BASE_PATH . ''.implode('/', $array));
				unlink(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$temp_filename.'.html');
				$data = file(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html');
				$delete_line = -1;
				for ($i = 0; $i < count($data); $i++) {
					if (strpos($data[$i], 'link_type="folder" id="'.$temp_id.'"')) {
						$delete_line = $i + 1;
					}
				}
				$this->file_functions->cutline(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_'.$folder_id.'.html', $delete_line);
			}
		}
		redirect($this->vars['action']);
	}

	private function chain() {
		if (isset($_GET['folder_id'])) {
			$directory_path = $_GET['folder_id'];
			$href = array();
			$name = explode('_', $directory_path);
			$directory_path = $_GET['folder_id'].'_';
			$offset = 0;
			$array_index = 0;
			while (strpos($directory_path, '_', $offset)) {
				$href[$array_index] = substr($directory_path, 0, strpos($directory_path, '_', $offset));
				$offset = strpos($directory_path, '_', $offset) + 1;
				$array_index++;
			}
			
			$return = '<a href="active_files">Main</a>';
			for ($i = 1; $i < count($href); $i++) {
				$return = $return.' -> <a href="active_files?folder_id='.$href[$i].'">'.$name[$i].'</a>';
			}
			
			return $return;
		} else {
			return '<a href="active_files">Main</a>';
		}
	}

	private function load_uploaded_files() {
		if (!isset($_GET['folder_id'])) {
			if(file_exists(SEPFILES_BASE_PATH . "logs/active_file_upload_log_main.html") && filesize(SEPFILES_BASE_PATH . "logs/active_file_upload_log_main.html") > 0){
				$this->file_functions->sort_file(SEPFILES_BASE_PATH . 'logs/active_file_upload_log_main.html');
				$handle = fopen(SEPFILES_BASE_PATH . "logs/active_file_upload_log_main.html", "r");  
				$contents = fread($handle, filesize(SEPFILES_BASE_PATH . "logs/active_file_upload_log_main.html"));  
				fclose($handle);  
				return stripcslashes(html_entity_decode($contents));  
			} else {
				return '';
			}
		} else {
			$folder_id = $_GET['folder_id'];
			if(file_exists(SEPFILES_BASE_PATH . "logs/active_file_upload_log_".$folder_id.".html") && filesize(SEPFILES_BASE_PATH . "logs/active_file_upload_log_".$folder_id.".html") > 0){
				$this->file_functions->sort_file(SEPFILES_BASE_PATH . "logs/active_file_upload_log_".$folder_id.".html");
				$handle = fopen(SEPFILES_BASE_PATH . "logs/active_file_upload_log_".$folder_id.".html", "r");  
				$contents = fread($handle, filesize(SEPFILES_BASE_PATH . "logs/active_file_upload_log_".$folder_id.".html"));  
				fclose($handle);  
				return stripcslashes(html_entity_decode($contents));  
			} else {
				return '';
			}
		}
	}

	private function deleteDirectory($dir) {
	    if (!file_exists($dir)) {return true;}
	    if (!is_dir($dir)) return unlink($dir);
	    foreach (scandir($dir) as $item) {
	        if ($item == '.' || $item == '..') continue;
	        if (!$this->deleteDirectory($dir.'/'.$item)) {
	        	return false;
			}
	    }
	    return rmdir($dir);
	}
	
}

?>