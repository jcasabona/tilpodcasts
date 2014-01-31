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

function cse_show_events($atts, $content=null){ 
	extract( shortcode_atts( array(
		'num' => -1,
		'previous' => false,
	), $atts ) );
			
	$events = cse_print_events($num, $previous);
	return $events;
	
}

add_shortcode('cse_events', 'cse_show_events');



function cse_print_events($numPosts=-1, $previous=false){

global $post;

$events= "<dl class=\"cse-events\">\n";

$compare= ($previous) ? '<' : '>=';
$order= ($previous) ? 'DESC' : 'ASC';

$args = array( 'post_type' => 'speaking-events',
				'orderby' => 'meta_value',
				'meta_key' => 'unixdate',
				'meta_value' => date('Y-m-d'),
				'meta_compare' => $compare,
				'order' => $order,
				'posts_per_page' => $numPosts	
		);

$myposts = get_posts( $args );

foreach( $myposts as $post ) : setup_postdata($post); ?>

		<?php
			$title= str_ireplace('"', '', trim(get_the_title()));
			$desc= str_ireplace('"', '', trim(get_the_content()));
			$eventName= get_post_custom_values('eventname'); 
			$eventName= $eventName[0];
			$loc= get_post_custom_values('location');
			$loc= "<a href=\"https://www.google.com/maps/preview#!q=".$loc[0]."\">".$loc[0]."</a>";
			$date= get_post_custom_values('eventdate');
			$date= $date[0];
			$pres= get_post_custom_values('preslink');
			$pres= ($pres[0] != "") ? '<a href="'.$pres[0].'">Slides and Resources</a>' : "";
			
			$events.="<div>";
			$events.= "<dt> $date: $title</dt>
				<dd class=\"loc\">$eventName at $loc</dd>
				<dd>$desc</dd>";
			if($pres != ""){
				$events.= "<dd>$pres</dd>";
			}
			$events.="</div>";

		
endforeach;

$events.="</dl>";


return $events;

}  

add_shortcode( 'cse_events', 'cse_show_events' );

function cse_single_loop(){

	if (have_posts()) : while (have_posts()) : the_post();
			
			$author= get_post_custom_values('author');
			$amzn= get_post_custom_values('amazonLink');
			$status= get_post_custom_values('bookStatus');
			$r= get_post_custom_values('rating');
			if($status[0] == 1) $status[1]= "Reading";
			else if($status[0] == -1) $status[1]= "Finished Reading";
			else $status[1]= "Want to Read";
			
			$rating= ($status[0] == -1 && $r[0] != "") ? readlist_build_rating($r[0]) : "--";
		?>
		
			<h1 class="entry-title full-title"><em><?php the_title(); ?></em> by: <?php print $author[0]; ?></h1>
			<p class="status">Status: <?php print $status[1]; ?> <?php if($status[0] == -1){ ?> | Rating: <?php print $rating; ?> <?php } ?></p>
			<p><?php if($amzn[0] != "") print '<p><a href="'.$amzn[0].'">Get <em>'. get_the_title() .'</em> on Amazon</a></p>'; ?></p>
			
			<?php the_content(); ?>

		
	<?php endwhile; endif;
}


?>