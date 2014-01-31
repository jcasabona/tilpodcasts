<?php
get_header();
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<div class="entry">
			<?php
				$url= get_post_custom_values('simplecast-url'); 
				$url= $url[0];
			?>
		
		<iframe frameborder='0' height='36px' scrolling='no' seamless src='<?php print $url; ?>' width='100%'></iframe>

				<p class="postmetadata alt">Posted on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?> | <a href="<?php the_permalink(); ?>">View Show Notes</a></p>
					
				</p>
			</div>
		</div>

	<?php endwhile; else: ?>

		<?php print_not_found(); ?>

<?php endif; ?>

</div>


<?php get_footer(); ?>
