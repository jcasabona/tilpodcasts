<?php get_header(); ?>


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2><?php the_title(); ?></h2>

			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

	<?php endwhile; endif; ?>


	</div>

<?php get_footer(); ?>

