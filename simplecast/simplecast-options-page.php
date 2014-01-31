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
}

function simplecast_settings_page() {

?>
<div class="wrap">
<h2>Reading List Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'simplecast-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Homepage Info</th>
        <td>
			<div><label>Next Show Airs: </label><input type="text" name="simplecast_next_date" value="<?php print get_option("simplecast_next_date"); ?>" /></div>
			
			<div><label>Next Topic: </label><input type="text" name="simplecast_next_topic" value="<?php print get_option("simplecast_next_topic"); ?>" /></div>
			
			<div><label>Sponsor: </label><input type="text" name="simplecast_sponsor" value="<?php print get_option("simplecast_sponsor"); ?>" /></div>
			
			<div><label>Sponsor Desc: </label><input type="text" name="simplecast_sponsor_desc" value="<?php print get_option("simplecast_sponsor_desc"); ?>" /></div>
			
			<div><label>Sponsor Link: </label><input type="text" name="simplecast_sponsor_link" value="<?php print get_option("simplecast_sponsor_link"); ?>" /></div>
         </td>
        </tr>
        
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>