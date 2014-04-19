<?php
// create custom plugin settings menu
add_action('admin_menu', 'simplecast_create_menu');

function simplecast_create_menu() {

	//create new top-level menu
	add_submenu_page( 'edit.php?post_type=simplecast-episodes', 'Podcast Settings', 'Settings', 'administrator', __FILE__, 'simplecast_settings_page');

	//call register settings function
	add_action( 'admin_init', 'simplecast_register_settings' );
}


function simplecast_register_settings() {
	//register our settings
	register_setting( 'simplecast-settings-group', 'simplecast_next_date', 'sanitize_text_field' );
	register_setting( 'simplecast-settings-group', 'simplecast_next_topic', 'sanitize_text_field' );
	register_setting( 'simplecast-settings-group', 'simplecast_sponsor', 'sanitize_text_field' );
	register_setting( 'simplecast-settings-group', 'simplecast_sponsor_desc', 'sanitize_text_field' );
	register_setting( 'simplecast-settings-group', 'simplecast_sponsor_link', 'esc_url' );
	register_setting( 'simplecast-settings-group', 'simplecast_embed_color');
	register_setting( 'simplecast-settings-group', 'simplecast_download_episode');
	register_setting( 'simplecast-settings-group', 'simplecast_last_download');
}

function simplecast_settings_page() {

	// Check that the user is allowed to update options
if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
}

if(isset($_POST['simplecast-download-all-submit'])){
	try{
		$posts= new WP_Query('post_type='.SCTYPE);
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) {
				$posts->the_post();
				$embed_url= get_post_custom_values('simplecast-url'); 
				$download= simplecast_direct_url($embed_url[0]);
				$downloaded= simplecast_download_episode($download, get_the_ID());
				
				if($downloaded){
					print "Episode for ". get_the_title . " downloaded<br/>";
				}
			}
		}
		if($downloaded) update_option('simplecast_last_download', date('Y-m-d'));
	}catch(Exception $e){
		print "<p>Hmm. There was an error.</p>";
	}
}

?>


<div class="wrap">
<h2>Podcast Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'simplecast-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        	<th scope="row"><label>Next Show Airs: </label></th>
			<td><input type="text" name="simplecast_next_date" value="<?php print get_option("simplecast_next_date"); ?>" /></td>
        </tr>
		<tr valign="top">
        	<th scope="row"><label>Next Topic: </label></th>
        	<td><input type="text" name="simplecast_next_topic" value="<?php print get_option("simplecast_next_topic"); ?>" /></td>
		</tr>
		<tr valign="top">
        	<th scope="row"><label>Sponsor: </label></th>
        	<td><input type="text" name="simplecast_sponsor" value="<?php print get_option("simplecast_sponsor"); ?>" /></td>
		</tr>
		<tr valign="top">
        	<th scope="row"><label>Sponsor Desc: </label></th>
        	<td><input type="text" name="simplecast_sponsor_desc" value="<?php print get_option("simplecast_sponsor_desc"); ?>" /></td>
		</tr>
		<tr valign="top">
        	<th scope="row"><label>Sponsor Link: </label></th>
        	<td><input type="text" name="simplecast_sponsor_link" value="<?php print get_option("simplecast_sponsor_link"); ?>" /></td>
		</tr>
		 <tr valign="top">
        	<th scope="row"><label>Embed Color: </label></th>
        	<td><label>Dark <input type="radio" name="simplecast_embed_color" value="dark" <?php if(get_option("simplecast_embed_color") != 'light') print "checked"; ?> /></label> <label> Light <input type="radio" name="simplecast_embed_color" value="light" <?php if(get_option("simplecast_embed_color") == 'light') print "checked"; ?> /></label></td>
        </tr>
         <tr valign="top">
        	<th scope="row"><label>Download Epsiodes when they are added: </label></th>
        	<td><label>Yes <input type="radio" name="simplecast_download_episode" value="true" <?php if(get_option("simplecast_download_episode")) print "checked"; ?> /></label> <label> No <input type="radio" name="simplecast_download_episode" value="false" <?php if(!get_option("simplecast_download_episode")) print "checked"; ?> /></label></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
    </p>
</form>


<form method="post" name="simplecast-download-all">
	<table class="form-table">
        <tr valign="top">
        	<th scope="row"><label>Click this button to download any episodes you've added.</label> You should only do this once probably...</th>
        </tr>
    </table>
    	<p>Also, it might take a while, especially if you have a lot of episodes....</p>

    	<?php if(get_option('simplecast_last_download') != '') print "<p>Also, You did this on ". get_option('simplecast_last_download') ."...</p>"; ?>
         <p class="submit">
    		<input type="submit" class="button-primary" name="simplecast-download-all-submit" value="<?php esc_attr_e('Download Them All!') ?>" />
    	</p>
    	
</form>

<p class="alignright"><em>You are using Simplecast Episodes, version <?php print SCVERSION; ?>. Thanks!</em></p>
</div>
<?php } ?>