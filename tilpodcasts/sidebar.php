<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
		<aside class="group">
		
			<?php	/* Widgetized Area */
					if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar') ) : ?>

            <!--BEGIN #widget-search-->
            <div id="widget-search" class="widget">
				<h3>Search</h3>
				<?php get_search_form(); ?>
            <!--END #widget-search--> 
            </div>
            
            <div class="nav">
            <?php wp_nav_menu( array('menu_class' => 'nav', 'before_link' => '<li>', 'after_link' => '</li>', 'sort_column' => 'menu_order', ) ); ?>
            </div>

            			<?php endif; /* (!function_exists('dynamic_sidebar') */ ?>
		<!--END #secondary .aside-->
		</aside>
