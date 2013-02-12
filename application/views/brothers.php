		<div class="picture_area">
		<?=$button?>
			<ul>
				<?php
				$items = array('<li><a href="#Founding">Actives</a></li>', '<li><a href="#Alpha">Alumni</a></li>');
				foreach ($items as $item) {
					echo $item;
				}
				?>
			</ul>
			<?php 
			foreach ($content as $item) {
				echo $item;
			}
			?>
		</div>
		<div class="description"></div>
		<?=form_open('brothers')?>
		</form>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.container').mouseover(function() {
					var uploaded_by = $(this).attr('uploaded_by');
					var id = $(this).attr('id');
					var logged_in_as = "<?=$logged_in_as?>";
					var privilege = parseInt("<?=$privilege?>");
					if (logged_in_as == uploaded_by || privilege == 1 ) {
						$('#' + id + ' > .delete').show();
					}
				}).mouseout(function() {
					var id = $(this).attr('id');
					$('#' + id + ' > .delete').hide();
				});
			});
		</script>