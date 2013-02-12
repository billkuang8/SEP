<?php
if($permission == 3)
{
  ?>
    <div id="calendar" class="button_effect" style="display: none;">
      <a href="calendar"><img src="public/images/calendar.jpg" /></a>
      <span><h2>Calendar</h2></span>
    </div>
    
    <div id="forum" class="button_effect" style="display: none;">
      <a href="active_forum"><img src="public/images/forum.jpg" /></a>
      <span><h2>Discussion Board</h2></span>
    </div>
    
    <div id="files" class="button_effect" style="display: none;">
      <a href="active_files"><img src="public/images/files.jpg" /></a>
      <span><h2>File Upload</h2></span>
    </div>
    
    <div id="pledge_forum" class="button_effect">
      <a href="pledge_forum"><img src="public/images/forum.jpg" /></a>
      <span><h3>Pledge Discussion Board</h3></span>
    </div>
    
    <div id="pledge_files" class="button_effect">
      <a href="pledge_files"><img src="public/images/files.jpg" /></a>
      <span><h3>Pledge File Upload</h3></span>
    </div>
    
    <div id="messages" class="button_effect" style="display: none;">
      <a href="view_contact" style="text-decoration: none;"><img src="public/images/messages.jpg" /></a>
      <span><h2>Messages</h2></span>
    </div>
    
    <div id="news_update_button" class="button_effect" style="display: none;">
      <a href="view_applications"><img src="public/images/publications.jpg" /></a>
      <span><h2>View Applications</h2></span>
    </div>
    
    <div id="rush_update_button" class="button_effect" style="display: none;">
      <a href="update"><img src="public/images/news.jpg" /></a>
      <span><h2>Event Update</h2></span>
    </div><?php
}
else if($permission == 2)
{
  ?>
    <div id="calendar" class="button_effect">
      <a href="calendar"><img src="public/images/calendar.jpg" /></a>
      <span><h2>Calendar</h2></span>
    </div>
    
    <div id="forum" class="button_effect">
      <a href="active_forum"><img src="public/images/forum.jpg" /></a>
      <span><h2>Discussion Board</h2></span>
    </div>
    
    <div id="files" class="button_effect">
      <a href="active_files"><img src="public/images/files.jpg" /></a>
      <span><h2>File Upload</h2></span>
    </div>
    
    <div id="pledge_forum" class="button_effect">
      <a href="pledge_forum"><img src="public/images/forum.jpg" /></a>
      <span><h3>Pledge Discussion Board</h3></span>
    </div>
    
    <div id="pledge_files" class="button_effect">
      <a href="pledge_files"><img src="public/images/files.jpg" /></a>
      <span><h3>Pledge File Upload</h3></span>
    </div>
    
    <div id="messages" class="button_effect">
      <a href="view_contact" style="text-decoration: none;"><img src="public/images/messages.jpg" /></a>
      <span><h2>Messages</h2></span>
    </div>
    
    <div id="news_update_button" class="button_effect">
      <a href="view_applications"><img src="public/images/publications.jpg" /></a>
      <span><h2>View Applications</h2></span>
    </div>
    
    <div id="rush_update_button" class="button_effect" style="display: none;">
      <a href="update"><img src="public/images/news.jpg" /></a>
      <span><h2>Events Update</h2></span>
    </div><?php 
}
else if($permission == 1)
{
?>  <div id="calendar" class="button_effect">
      <a href="calendar"><img src="public/images/calendar.jpg" /></a>
      <span><h2>Calendar</h2></span>
    </div>
    
    <div id="pledge_forum" class="button_effect">
      <a href="pledge_forum"><img src="public/images/forum.jpg" /></a>
      <span><h3>Pledge Discussion Board</h3></span>
    </div>
    
    <div id="pledge_files" class="button_effect">
      <a href="pledge_files"><img src="public/images/files.jpg" /></a>
      <span><h3>Pledge File Upload</h3></span>
    </div>
    
    <div id="messages" class="button_effect">
      <a href="view_contact"><img src="public/images/messages.jpg" /></a>
      <span><h2>Messages</h2></span>
    </div>
    
    <div id="files" class="button_effect">
      <a href="active_files"><img src="public/images/files.jpg" /></a>
      <span><h2>File Upload</h2></span>
    </div>
    
    <div id="forum" class="button_effect">
      <a href="active_forum"><img src="public/images/forum.jpg" /></a>
      <span><h2>Discussion Board</h2></span>
    </div>
    
    <div id="news_update_button" class="button_effect">
      <a href="view_applications"><img src="public/images/publications.jpg" /></a>
      <span><h2>View Applications</h2></span>
    </div>
    
    <div id="rush_update_button" class="button_effect">
      <a href="update"><img src="public/images/news.jpg" /></a>
      <span><h2>Event Update</h2></span>
    </div><?php
}


?>

<h3 id="hitcount">Current Home Page Hit Count Since 8/24/2012 2:27 PM: <?=$hits?></h3>
  
  

