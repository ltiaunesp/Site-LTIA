<?php
  function create_post_message_type() {
    if(is_user_logged_in() && current_user_can('edit_others_posts'))
      register_post_type( 'message',
        array(
          'labels' => array(
            'name' => __( 'Messages' ),
            'singular_name' => __( 'Message' )
          ),
          'public' => true,
          'has_archive' => true,
        )
      );
  }
  add_action( 'init', 'create_post_message_type' );
?>
