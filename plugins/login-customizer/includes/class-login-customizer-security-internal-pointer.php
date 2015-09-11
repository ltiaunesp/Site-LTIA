<?php
add_action( 'admin_enqueue_scripts', 'logincust_pointer_load', 1000 );

function logincust_pointer_load( $hook_suffix ) {

	// Don't run on WP < 3.3
	if ( get_bloginfo( 'version' ) < '3.3' )
		return;


	// Get pointers for this screen
	$pointers = apply_filters( 'logincust_admin_pointers', array() );

	if ( ! $pointers || ! is_array( $pointers ) )
		return;

	// Get dismissed pointers
	$dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
	$valid_pointers =array();
	// Check pointers and remove dismissed ones.
	foreach ( $pointers as $pointer_id => $pointer ) {

		// Sanity check
		if ( in_array( $pointer_id, $dismissed ) || empty( $pointer )  || empty( $pointer_id ) || empty( $pointer['target'] ) || empty( $pointer['options'] ) )
			continue;

		$pointer['pointer_id'] = $pointer_id;

		// Add the pointer to $valid_pointers array
		$valid_pointers['pointers'][] =  $pointer;
	}

	// No valid pointers? Stop here.
	if ( empty( $valid_pointers ) )
		return;

	// Add pointers style to queue.
	wp_enqueue_style( 'wp-pointer' );

	// Add pointers script to queue. Add custom script.
	wp_enqueue_script( 'logincust-pointer', LOGINCUST_FREE_URL."js/logincust_pointer.js", array( 'wp-pointer' ) );

	// Add pointer options to script.
	wp_localize_script( 'logincust-pointer', 'logincust', $valid_pointers );
}

add_filter( 'logincust_admin_pointers', 'logincust_register_pointer_security' );
function logincust_register_pointer_security( $p ) {
	$p['logincustsecurity'] = array(
		'target' => '#menu-appearance',
		'options' => array(
			'content' => sprintf( '<h3> %s </h3> <p> %s </p>',
				__( 'Security Addon Available ' ,'login-customizer'),
				__( 'Check out the new <a target="_blank"  href="https://themeisle.com/plugins/custom-login-customizer-security-addon/">Security Addon</a> for Custom Login Page Customizer .','login-customizer')
			),
			'position' => array( 'edge' => 'top', 'align' => 'middle' )
		)
	);
	return $p;
}