<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results for: <?php print get_search_query(); ?></h2>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<p><small><?php the_time('l, F jS, Y') ?></small></p>
				
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>

		<?php endwhile; ?>

		<?php print_post_nav(); ?>

	<?php else : ?>

		<?php print_not_found(); ?>

	<?php endif; ?>
	
	</div>

		<?php get_sidebar(); ?>

<?php get_footer(); ?>
