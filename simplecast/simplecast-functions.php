<?php
/***Shortcodes**/

function simplecast_latest_show(){
	global $post;
	
	
	$args = array( 'post_type' => 'simplecast-episodes',
				'posts_per_page' => 1
			);
			
	$myposts = get_posts( $args );

	foreach( $myposts as $post ) : setup_postdata($post); ?>

		<?php
			$url= get_post_custom_values('simplecast-url'); 
			$url= $url[0];

?>

		<h2>Listen Now! <?php the_title(); ?></h2>
		
		<iframe frameborder='0' height='36px' scrolling='no' seamless src='<?php print $url; ?>' width='100%'></iframe>
						
		<h3><a href="<?php the_permalink(); ?>">View Show Notes</a> | <a href="<?php print get_post_type_archive_link('simplecast-episodes'); ?>">See All Shows</a></h3>


<?php 

	endforeach;

}

function simplecast_embed_url($url){

		$color= (get_option('simplecast_embed_color') != '') ? get_option('simplecast_embed_color') : 'dark';

		$url= str_ireplace("fm/media/", "fm/e/", $url);
		$url= str_ireplace(".mp3", "?style=$color", $url);

		return $url;

	}
?>