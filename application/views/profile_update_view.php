		<div id="profile_update">
			<?=form_open_multipart('profile_update')?>
				<label>Choose a picture</label><br>
				<input type="file" id="picture_select" name="file" style="outline: none;"/><br><br>
				
				<label>Name</label><br>
				<input type="text" id="name" name="name" /><br><br>
				
				<label>Major</label><br>
				<input type="text" id="major" name="major" /><br><br>
				
				<label>Year</label><br>
				<input type="text" id="year" name="year" /><br><br>
				
				<label>Class</label><br>
				<select name="occupation">
					<option value="Founding">Founding Father</option>
					<option value="Alpha">Alpha</option>
					<option value="Beta">Beta</option>
					<option vlaue="Gamma">Gamma</option>
				</select><br><br>
				
				<label>Position</label><br>
				<input type="text" id="position" name="position" /><br><br>
				
				<label>Short Description</label><br>
				<textarea name="description" rows="4" cols="50" id="description" style="resize: none;"></textarea><br>
				<span id="character_count"></span><br><br>
				<div style="font-size: 12px; color: red;">
					<?=$error?>
				</div>
				<input type="submit" value="Submit" id="submit" />
			</form>
		</div>
