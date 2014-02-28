<?php
/*
Plugin Name: Simplecast Episodes
Plugin URI: http://wordpress.org/#
Description: This plugin creates a custom post type & template page that you can use to display Simplecast Podcast Information
Author: Joe Casabona
Version: 0.4
Author URI: http://casabona.org/
*/


//some set-up.

define('SCPREFIX', 'sc_');
define('SCTYPE', 'simplecast-episodes');
define('SCLABEL', 'Episodes');
define('SINGLESCLABEL', 'Episode');
define('SCSLUG', 'simplecast-episodes');
define('SCICON', 'dashicons-video-alt3');
define( 'SCPATH', plugins_url(__FILE__) );


require_once('simplecast-functions.php');
require_once('simplecast-options-page.php');

/** Create the Custom Post SCTYPE**/
add_action('init', SCPREFIX.'register');  
  
 
function sc_register() {  
    
    //Arguments to create post type.
    $args = array(  
        'label' => __(SCLABEL),  
        'singular_label' => __(SINGLESCLABEL),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => true,  
        'menu_icon' => SCICON,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'comments'),
        'rewrite' => array('slug' => SCSLUG, 'with_front' => false),
       );  
  
  	//Register SCTYPE and custom taxonomy for SCTYPE.
    register_post_type( SCTYPE , $args );   
    
    register_taxonomy("topic", array(SCTYPE), array("hierarchical" => false, "SCLABEL" => "Topics", "singular_SCLABEL" => "Topic", "rewrite" => true, "SCSLUG" => 'episode-topics'));
}  
 

$cpt_meta= SCPREFIX.'meta_box';
$cpt_meta = array(
    'id' => SCSLUG.'-meta',
    'title' => __(SINGLESCLABEL. ' Information'),
    'page' => SCTYPE,
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => __('Direct Download URL'),
            'desc' => __(''),
            'id' => 'simplecast-url',
            'type' => 'text',
            'std' => ""
        ),	
        
    )
);

add_action('admin_menu', SCPREFIX.'meta');


// Add meta box
function sc_meta() {
    global $cpt_meta;
    
    add_meta_box($cpt_meta['id'], $cpt_meta['title'], SCPREFIX.'show_meta', $cpt_meta['page'], $cpt_meta['context'], $cpt_meta['priority']);
}

// Callback function to show fields in meta box
function sc_show_meta() {
    global $cpt_meta, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="'.SCPREFIX.'meta_nonce2" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($cpt_meta['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'post_list':  
			$items = get_posts( array (  
				'post_SCTYPE' => 'courses',  
				'posts_per_page' => -1  
			));  
				echo '<select name="', $field['id'],'" id="'.$field['id'],'"> 
						<option value="">Select One</option>'; // Select One  
					foreach($items as $item) {  
						echo '<option value="'.$item->ID.'"', $metas == $item->ID ? ' selected="selected"' : '','> '.$item->post_title.'</option>';  
					} // end foreach  
				echo '</select><br />'.$field['desc'];  
			break; 
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}

// get current post meta data

add_action('save_post', SCPREFIX.'save_data');

// Save data from meta box
function sc_save_data($post_id) {
    global $cpt_meta;
    
    // verify nonce
    if (!wp_verify_nonce($_POST[SCPREFIX.'meta_nonce2'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    
    
    foreach ($cpt_meta['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
       
       if($field['id'] == 'simplecast-url'){ 
        	$new= simplecast_embed_url($new);
        }
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

// check autosave
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
 return $post_id;
}

?>