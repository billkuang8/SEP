	<div id="rush_main" style="">
		<div>
			<?php if(isset($update_message)) {echo $update_message;}?>
		</div>
		<img id="rush_banner" src="<?php echo IMG_BASE_PATH . 'rush_banner.jpg' ?>" /><br><br>
		<?=form_open('update_rush/submit', array('style' => 'display: inline-block;'))?>
			<label><span style="font-size: 15px; font-weight: bold;">Update Rush Page Here</span></label><br><br>
			<div><textarea rows="12" cols="100" id="update_box" name="update_box" ><?php echo $existingContent ?></textarea></div>
			<br><input type="submit" value="Update" />
		</form><br><br><br>
	
		<div style="display: inline-block;">
			<p  style="font-size: 15px; font-weight: bold;">Upload the application files here...</p>
			<?=form_open_multipart('update_rush/submit', array('id' => 'upload'))?>
				<input type="file" name="file[]" multiple=""/>
				<input id="submit" type="submit" name="submit" value="Upload" />
			</form>
		</div>
	</div>
