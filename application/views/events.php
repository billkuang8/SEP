	<div id="events_list">			
			<?php 
				if(empty($content))
				{
					echo '<h2>Updating... Please come back later.</h2>';
				}
				else
				{
					echo $content;
				}
			?>
		</div>
