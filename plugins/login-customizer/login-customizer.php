<?php
/*
Plugin Name: Custom Login Page Customizer
Plugin URI: https://themeisle.com/plugins/login-customizer/
Description: Custom Login Customizer plugin allows you to easily customize your login page straight from your WordPress Customizer! Awesome, right?
Author: Hardeep Asrani
Author URI:  https://themeisle.com/
Version: 1.0.5
*/

define("LOGINCUST_VERSION","1.0.5");
define("LOGINCUST_FREE_PATH",plugin_dir_path( __FILE__ ));
define("LOGINCUST_FREE_URL",plugin_dir_url( __FILE__ ));
if ( !defined( 'LOGINCUST_TEXTDOMAIN' ) ) {
	define("LOGINCUST_TEXTDOMAIN","login-customizer");
}
define("LOGINCUST_PRO_TEXT",__('<p class="logincust_pro_text">You need to buy the <a href="http://themeisle.com/plugins/custom-login-customizer-security-addon/" target="_blank">SECURITY ADDON</a> to have this options. </p>',LOGINCUST_TEXTDOMAIN));
function logincust_check_security(){
	return (defined("LOGINCUST_SECURITY_VERSION"));
}
  
if (!class_exists('TAV_Remote_Notification_Client')) {
	require( LOGINCUST_FREE_PATH.'/includes/class-remote-notification-client.php' );
}
include( LOGINCUST_FREE_PATH . 'customizer.php');
include( LOGINCUST_FREE_PATH . 'option-panel.php');
include( LOGINCUST_FREE_PATH . 'includes/class-login-customizer-security-internal-pointer.php');

$notification = new TAV_Remote_Notification_Client( 48, '0f7b61c2420ea7ec', 'http://themeisle.com?post_type=notification' );