<?php
/*
	Template Name: Home
*/
?>
<?php get_header(); ?>
	<div class="main group">
					<section class="listen">
							
							<?php 
							
								if(function_exists('simplecast_latest_show')){
									simplecast_latest_show(); 
								}else{
									print "<h2>There are no shows at this time.</h2>";
								}
								?>					
						
					</section>
					
					<section class="upcoming left">
						<h3>Next Show: <?php print get_option('simplecast_next_date'); ?></h3>
						<p>Topic: <?php print get_option('simplecast_next_topic'); ?></p>
					</section>
					
					<section class="sponsors right group">
							<h3>Sponsored by: <?php print get_option('simplecast_sponsor'); ?></h3>
							<p><?php print get_option('simplecast_sponsor_desc'); ?> <a href="<?php print get_option('simplecast_sponsor_link'); ?>">Visit the Website</a></p>
					</section>
	</div>
	
</div>			

<?php get_footer(); ?>


