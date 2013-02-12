<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SEP_Controller extends CI_Controller
{
  var $headerData;
  
  function __construct()
  {
    parent::__construct();
    $this->headerData['title'] = 'Sigma Eta Pi - UC Berkeley'; //set as default title
    $this->headerData['dropdown'] = $this->utils->dropdown_include();
    $this->headerData['logout'] = $this->utils->logout_include();
    
  }
}

?>