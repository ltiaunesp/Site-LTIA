<?php
/* Define the custom meta box for Edit Post/Edit Page screen */

global $wp_version;

if ( version_compare($wp_version, '3.0', '<' ) ) {
	// backwards compatible (before WP 3.0)
	add_action( 'admin_init', 'hupso_add_custom_box', 1 );
}
else {
	add_action( 'add_meta_boxes', 'hupso_add_custom_box' );
}


// Add Hupso for 'posts' and 'pages'
add_filter('manage_posts_columns', 'hupso_manage_posts_columns', 10, 2);
add_filter('manage_pages_columns', 'hupso_manage_posts_columns', 10, 2);
function hupso_manage_posts_columns($posts_columns)
{
    $posts_columns['hupso'] = __('Hupso');
    return $posts_columns;
}


add_action( 'manage_posts_custom_column' , 'hupso_manage_posts_custom_column', 10, 2 );
add_action( 'manage_pages_custom_column' , 'hupso_manage_posts_custom_column', 10, 2 );

function hupso_manage_posts_custom_column( $column, $post_id ) {
	global $post;
    if ( $column == 'hupso' ) {
		  $value = get_post_meta( $post->ID, 'hupso-share-buttons', true );
		  $display = '';
		  switch ($value) {
		  	case '': 
				$display = __('Default');
				break;
			case 'default':	
				$display = __('Default');
				break;
			case 'enabled':
				$display = __('Enabled');
				break;
			case 'disabled':
				$display = __('Disabled');
				break;
		  }
		  echo $display;
    }
}


/* Do something with the data entered */
add_action( 'save_post', 'hupso_save_post' );

/* Adds a box to the main column on the Post and Page edit screens */
function hupso_add_custom_box() {
    $screens = array( 'post', 'page' );
    foreach ($screens as $screen) {
        add_meta_box(
            '',
            'Hupso Share Buttons',
            'hupso_inner_custom_box',
            $screen,
			'side'
        );
    }
}

/* Prints the box content */
function hupso_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'hupso_noncename' );

  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $value = get_post_meta( $post->ID, 'hupso-share-buttons', true );
  $checked = ' checked="checked" ';
  $def = '';
  $ena = '';
  $dis = '';
  switch ($value) {
  	case '':
		$def = $checked;
		break;
  	case 'enabled':
		$ena = $checked;
		break;
	case 'disabled':
		$dis = $checked;
		break;
	default:
		$def = $checked;		
  }
  echo '<input type="radio" name="hupso-share-buttons" value="default" ' . $def . '> ' .  __('Default', 'hupso') . ' (<a href="options-general.php?page=hupso-share-buttons-for-twitter-facebook-google/share-buttons-hupso.php">' . __('Settings', 'hupso') . '</a>)<br>';
  echo '<input type="radio" name="hupso-share-buttons" value="enabled" ' . $ena . '> ' . __('Enabled', 'hupso') . '<br>';
  echo '<input type="radio" name="hupso-share-buttons" value="disabled" ' . $dis . '> ' . __('Disabled', 'hupso') . '<br>';
}

/* When the post is saved, saves our custom data */
function hupso_save_post( $post_id ) {

	global $post;

  // First we need to check if the current user is authorised to do this action. 
  if ( isset($_REQUEST['post_type']) && 'page' == $_REQUEST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['hupso_noncename'] ) || ! wp_verify_nonce( $_POST['hupso_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Thirdly we can save the value to the database
  // sanitize user input
  $mydata = sanitize_text_field( $_POST['hupso-share-buttons'] );
  $value = get_post_meta( $post->ID, 'hupso-share-buttons', true );
  if  ($mydata != 'default') {
  		update_post_meta( $post->ID, 'hupso-share-buttons', $mydata);
  }
  else {
  		delete_post_meta( $post->ID, 'hupso-share-buttons');
  }
}
?>