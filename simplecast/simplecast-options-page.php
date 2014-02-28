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
	register_setting( 'simplecast-settings-group', 'simplecast_next_date' );
	register_setting( 'simplecast-settings-group', 'simplecast_next_topic' );
	register_setting( 'simplecast-settings-group', 'simplecast_sponsor' );
	register_setting( 'simplecast-settings-group', 'simplecast_sponsor_desc' );
	register_setting( 'simplecast-settings-group', 'simplecast_sponsor_link' );
	register_setting( 'simplecast-settings-group', 'simplecast_embed_color');
}

function simplecast_settings_page() {

	// Check that the user is allowed to update options
if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
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
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
    </p>
</form>
</div>
<?php } ?>