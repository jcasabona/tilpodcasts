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

function simplecast_direct_url($url){

		$color= (get_option('simplecast_embed_color') != '') ? get_option('simplecast_embed_color') : 'dark';

		$url= str_ireplace("fm/e/", "fm/media/", $url);
		$url= str_ireplace("?style=$color", ".mp3", $url);

		return $url;
	}

function simplecast_download_episode($url, $post_id=0){
		$tmp = download_url( $url );

		$desc= "Simplecast Episode for post $post_id";

		$file_array['name'] = basename($url);
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );

		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}

		$src = wp_get_attachment_url( $id );
}
?>