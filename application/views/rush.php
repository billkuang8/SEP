<div id="rush_main">
  <div>
    <?php
      
        if($success)
        {
          echo '<b>Thank you for signing up. We will update you via the email address you\'ve entered.</b><br><br>';  
        }
		else if($appsuccess)
		{
			echo '<b>Your application has been submitted successfully.</b><br><br>';	
		}
        else if($errors)
        {
          echo '<b>' . $errors . '</b>';  
        }
      ?>
    </div>
    
    <img id="rush_banner" src="<?php echo IMG_BASE_PATH . 'home_rush.png' ?>" width="750" /><br><br>
      
    <h3><?=$rush_message?></h3><br>
      
    <?=$rush_file?>

      	
      <div style="float:left">
      <br><br><span><b>Please sign up to receive important rush updates:</b></span>
      
        <?php echo form_open('rush/signup'); ?>        
        <label>Email Address: </label>
        <input type="email" name="email" size="30"/>
        <input type="submit" name="submit" value="Sign Up"/>
      </form>
		</div>
		 <br><br> <br>
		<div id="application" style="float:right">
		<a href="<?php echo DOMAIN_BASE_PATH . 'rush/app'; ?>">Apply Now</a>
		</div>
    </div>

