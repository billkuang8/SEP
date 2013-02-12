<div id="login_dialog">
			<?php echo form_open('authenticate'); ?>				
				<strong>Username</strong><br>
				<input type="text" name="username"><br><br>
				
				<strong>Password</strong><br>
				<input type="password" name="password"><br><br>
				<div class="error_message">
					
				</div>
				<input type="submit" value="Sign In"><br>
				<!--<span>Not registered? Register </span><a href="registration" style="color: blue;">here</a><span>!</span> -->
			</form>
			<span style="color: red; font-size: 12px;"><?php echo $error_msg ?></span>
		</div>
        