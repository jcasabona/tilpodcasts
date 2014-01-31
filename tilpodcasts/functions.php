<?php
define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
define( 'IMAGES', TEMPPATH. "/images");

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
}



/*****Sidebars!******/

register_sidebar( array (
	'name' => __( 'Sidebar', 'main-sidebar' ),
	'id' => 'primary-widget-area',
	'description' => __( 'The primary widget area', 'wpbp' ),
	'before_widget' => '<div class="widget">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array (
	'name' => __( 'Sidebar2', 'secondary-sidebar' ),
	'id' => 'secondary-widget-area',
	'description' => __( 'The secondary widget area', 'wpbp' ),
	'before_widget' => '<div class="widget">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );




/*
function jlc_is_mobile_device(){
	try{
		$config = new WurflCloud_Client_Config(); 
		$config->api_key = '673289:CNry9beZIoP38Kn2z1WRQcAU6Fqd0TwS';  
		$client = new WurflCloud_Client_Client($config); 
		$client->detectDevice(); 
		
		return $client->getDeviceCapability('is_wireless_device');
	}catch (Exception $e){
		return wp_is_mobile();
	}
}

define( 'ISMOBILE', jlc_is_mobile_device());
*/


function til_scripts() {
	wp_enqueue_style( 'googlewebfonts', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' );
	wp_enqueue_style( 'fontawesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css');
	
    echo '<!--[if lt IE 9]>';
    echo '	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '	<script stc="'. TEMPPATH.'/js/respond.min.js"></script>';
    echo '<![endif]-->';
	
}

add_action( 'wp_enqueue_scripts', 'til_scripts' );



function til_get_attachements($pid){
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $pid ); 
	$attachments = get_posts( $args );
	if ($attachments) {
		foreach ( $attachments as $post ) {
			setup_postdata($post);
			the_attachment_link($post->ID, false, false, true);
		}
	}
}

function til_page_url() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function til_print_post_nav(){
?>
		<div class="navigation group">
			<div class="alignleft"><?php next_posts_link('&laquo; Next') ?></div>
			<div class="alignright"><?php previous_posts_link('Previous &raquo;') ?></div>
		</div>
<?php

}

function til_print_not_found(){
?>
		<h3 class="center">No posts found. Try a different search?</h3>
		<?php get_search_form(); ?>
<?php
}




?>