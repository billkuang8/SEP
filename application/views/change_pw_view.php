		<div id="change_pw_dialog" style="text-align: right;">
			<?=form_open('change_pw')?>
				<label for="current"><strong>Current Password: </strong></label><input type="password" name="current" /><br>
				<label for="password"><strong>New Password: </strong></label><input type="password" name="password" /><br>
				<label for="password_confirmation"><strong>New Password Confirmation: </strong></label><input type="password" name="password_confirmation" /><br>
				<div class="error_message">
					<?=$error_message?>
				</div>
				<input type="submit" value="Change">
			</form>
		</div>

