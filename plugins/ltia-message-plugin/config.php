<?php
  function create_post_message_type() {
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
