<div id="contact_main"> <h4> 
<?php
if($success) 
{ 
  echo 'Thank you! We\'ll get back to you as soon as we can.'; 
} 
else 
{ 
  echo $errors; 
}
?> 
</h4> <h3>Please fill out this contact form</h3> 
<?php echo form_open('contact/submit'); ?> 
<input id="email" type="email" name="email" size="50" value="Please enter your email address here..."/><br><br> 
<textarea id="message" name="message" rows="12"></textarea><br> 
<input id="submit" type="submit" name="submit" value="Submit" /> 
</form> <br> 
<div id="confirmation"></div> 
</div>

<div id="contact_information"> <h2>Main Contacts</h2><hr><br> <div style="margin-left: 30px;"> <span style="font-size: 14px; font-weight: bold;">President:
Andy Yang</span> <ul class="contact-list"> <li> Phone: 1 (408) 823-3603 </li> <li> Email  : yang.andy91@gmail.com </li> </ul><br>

<span style="font-size: 14px; font-weight: bold;">Vice President: Kirtan Upadhyaya</span> <ul class="contact-list"> <li> Phone: 1 (714) 261-5679 </li> <li> Email  
  : kirtanupadhyaya@gmail.com </li> </ul><br>
 
<span style="font-size: 14px; font-weight: bold;">Education Director: Eric Liu</span> <ul class="contact-list"> <li> Phone: 1 (408) 480-4313  </li> <li> Email  
  : ericlucb@gmail.com </li> </ul><br> </div> </div>
