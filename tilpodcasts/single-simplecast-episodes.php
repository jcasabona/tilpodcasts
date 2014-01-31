<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="date"><i class="fa fa-calendar"></i> <?php the_time('F jS, Y'); ?></div>
		
			<h2><?php the_title(); ?></h2>
			
			<article class="entry">
			<?php
				$url= get_post_custom_values('simplecast-url'); 
				$url= $url[0];
			?>
		
		<iframe frameborder='0' height='36px' scrolling='no' seamless src='<?php print $url; ?>' width='100%'></iframe>

			
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>				

				
			</article>
			
			
			<div class="navigation group">
				<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
				<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
			</div>
			
		</div>

	
	

	<?php endwhile; else: ?>

		<?php print_not_found(); ?>

<?php endif; ?>

</div>


<?php get_footer(); ?>
