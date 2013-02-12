<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends SEP_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  
  function index()
  {
    $headerData = $this->headerData;
    $this->load->helper('file');
    $headerData['css'] = array('events.css');
    $headerData['js'] = array('events.js');
    $this->load->view('templates/header', $headerData);
    $vars['content'] = '
          
<div class="wrapper">
 <div id="table1">
  <center><font size="+3">RUSH WEEK</font></center>
   <br />
   <center>
   <font size="+1">MEET THE CHAPTER</font><br />
&nbsp;&nbsp;&nbsp;Maude Fife Room, Wheeler 315<br />
&nbsp;&nbsp;&nbsp;Tues February 5th | 7 - 9 PM<br />
&nbsp;&nbsp;&nbsp;Business Casual
<br /><br />
  <font size="+1">SOCIAL MIXER</font><br />
&nbsp;&nbsp;&nbsp;Caffe Strada<br />
&nbsp;&nbsp;&nbsp;Wed February 6th | 7 - 9 PM<br />
&nbsp;&nbsp;&nbsp;Campus Casual<br />
</center>
</div>

<br /><br /><br />
<div id="table2">
<center><font size="+3">INTERVIEWS</font></center>
<br />
<center>
<font size="+1">INDIVIDUAL</font><br />
&nbsp;&nbsp;&nbsp;February 9th<br />
&nbsp;&nbsp;&nbsp;Business professional<br />
&nbsp;&nbsp;&nbsp;*By appointment
<br /><br />
<font size="+1">GROUP</font><br />
&nbsp;&nbsp;&nbsp;February 10th<br />
&nbsp;&nbsp;&nbsp;Business professional<br />
&nbsp;&nbsp;&nbsp;*By invitation<br />
</center>
</div> <!--end wrapper-->
   <hr />           
     <p style="font-size:xx-large; text-align:center;"> Past Events</p>
          
           <img src="' . IMG_BASE_PATH . 'SEPGammaEventFlyer.jpg' . '" width="1000" style="position: relative; left: 30px; "/>
           <br />
            <img src="' . IMG_BASE_PATH . 'ThePitch.jpg' . '" width="1000" style="position: relative; left: 30px; "/>
            <br />
            <img src="' . IMG_BASE_PATH . 'CalExpo.jpg' . '" width="1000" style="position: relative; left: 30px; "/>
           
</div>           
            ';
    $this->load->view('events', $vars);
    $this->load->view('templates/footer');
  }
}
