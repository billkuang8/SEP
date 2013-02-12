    <div id="wrapper">
        <div id="threadbox">
			
            <?php echo $content?>
        </div>
        
        <?php echo form_open('pledge_forum/discussion_action/'.$dir.'/'.$id) ?>
			<div style="position: relative; left: 6%;"><textarea cols="200" rows="8" class="post" name="post"></textarea></div>
			<input type="hidden" name="deleteid" />
            <input name="submitmsg" type="submit" id="submitmsg" value="Post" id="submit_button"/>
        </form>
    </div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.thread_div').mouseover(function() {
				var uploaded_by = $(this).attr('uploaded_by');
				var id = $(this).attr('id');
				var logged_in_as = "<?=$uploaded_by?>";
				var privilege = parseInt("<?=$privilege?>");
				if (logged_in_as == uploaded_by || privilege == 1 ) {
					$('#' + id + ' > .delete').show();
				}
			}).mouseout(function() {
				var uploaded_by = $(this).attr('uploaded_by');
				var id = $(this).attr('id');
				$('#' + id + ' > .delete').hide();
			});
		});
	</script>

