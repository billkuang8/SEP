		<div id="registration_dialog" style="text-align: right;">
			<?php echo validation_errors(); ?>
			<?php echo form_open('register'); ?>				
				<label for="firstname"><strong>First Name: </strong></label><input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" /><br>
				<label for="lastname"><strong>Last Name: </strong></label><input type="text" name="lastname" value="<?php  echo set_value('lastname'); ?>" /><br>
				<label for="username"><strong>Username: </strong></label><input type="text" name="username" value="<?php echo set_value('username');?>" /><br>
				<label for="password"><strong>Password: </strong></label><input type="password" name="password" /><br>
				<label for="password_confirmation"><strong>Password Confirmation: </strong></label><input type="password" name="password_confirmation" /><br>
				<label for="email"><strong>Email: </strong></label><input type="email" name="email" value="<?php echo set_value('email'); ?>"><br>
				<div class="error_message">
					<?php
					REGISTRATION:
					if (isset($_POST['firstname'])&&
							isset($_POST['lastname'])&&
							isset($_POST['username'])&&
							isset($_POST['password'])&&
							isset($_POST['password_confirmation'])&&
							isset($_POST['email']) &&
							isset($_POST['code'])) {
						
						$firstname = $_POST['firstname'];
						$lastname = $_POST['lastname'];
						$username = $_POST['username'];
						$password = $_POST['password'];
						$password_confirmation = $_POST['password_confirmation'];
						$email = $_POST['email'];
						$code = $_POST['code'];
						$code_hash = md5($code);
						
						
						if (!empty($firstname)&&
								!empty($lastname)&&
								!empty($username)&&
								!empty($password)&&
								!empty($password_confirmation)&&
								!empty($email)) {
							
							
							if (strpos($email, '@') == false || strpos($email, '.') == false) {
								echo 'Not a valid email address.';
							} else {
								$query1 = "SELECT `id` FROM `users` WHERE `username` = '".mysql_real_escape_string($username)."'";
								$query1_run = mysql_query($query1);
								
								if (mysql_num_rows($query1_run) == 0) {
									if ($password == $password_confirmation) {
										
										if ($code_hash == md5('pledge')) {
											$privilege = 3;
											
											$query2 = "INSERT INTO `tsinghua`.`users` (`id`, `username`, `password_hash`, `firstname`, `lastname`, `email`, `privilege`) 
											VALUES (NULL, '".$username."', '".md5($password)."', '".$firstname."', '".$lastname."', '".$email."', '".$privilege."')";

											if (mysql_query($query2)) {
												echo 'Registration success! Click <a href="loginform.inc.php">here</a> to log in.';
											} else {
												echo 'Oops! Something went wrong. Please try again.';
											}
										} else if ($code_hash == md5('exec')) {
											$privilege = 1;
										
											$query2 = "INSERT INTO `tsinghua`.`users` (`id`, `username`, `password_hash`, `firstname`, `lastname`, `email`, `privilege`) 
											VALUES (NULL, '".$username."', '".md5($password)."', '".$firstname."', '".$lastname."', '".$email."', '".$privilege."')";

											if (mysql_query($query2)) {
												echo 'Registration success! Click <a href="loginform.inc.php">here</a> to log in.';
											} else {
												echo 'Oops! Something went wrong. Please try again.';
											}
										} else if ($code_hash == md5('active')) {
											$privilege = 2;
										
											$query2 = "INSERT INTO `tsinghua`.`users` (`id`, `username`, `password_hash`, `firstname`, `lastname`, `email`, `privilege`) 
											VALUES (NULL, '".$username."', '".md5($password)."', '".$firstname."', '".$lastname."', '".$email."', '".$privilege."')";

											if (mysql_query($query2)) {
												echo 'Registration success! Click <a href="loginform.inc.php">here</a> to log in.';
											} else {
												echo 'Oops! Something went wrong. Please try again.';
											}
										} else {
											echo 'The Admin Code you entered is incorrect. Please try again.';
										}
									} else {
										echo 'Your password does not match the confirmation.';
									}
								} else {
									echo 'This username already exists. Please choose another username.';
								}
							} 
						} else {
							echo 'Please enter all fields.';
						}
					}
					?>
				</div>
				<input type="submit" value="Register">
			</form>
		</div>

