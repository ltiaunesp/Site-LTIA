<?php
function logincust_register_options_page() {
    add_theme_page(__('Login Customizer',LOGINCUST_TEXTDOMAIN), __('Login Customizer',LOGINCUST_TEXTDOMAIN), 'manage_options', 'logincust_options', 'logincust_options_page');
}
add_action('admin_menu', 'logincust_register_options_page');

function logincust_register_scripts(){
	if(!logincust_check_security()){
		wp_enqueue_style( 'customizer_disable_controls_css', LOGINCUST_FREE_URL . '/css/disable_controls.css',array(), LOGINCUST_VERSION, false );
	}
}
add_action('customize_controls_enqueue_scripts', 'logincust_register_scripts');

function logincust_options_page() {
	?>
	<style type="text/css">
		.appearance_page_logincust_options #wpcontent #wrap h3,
		.appearance_page_logincust_options #wpcontent #wrap h2,
		.appearance_page_logincust_options #wpcontent #wrap a,
		.appearance_page_logincust_options #wpcontent  #wrap {
			color:#777;
		}
		#logincust-logo{
			background:url("<?php echo LOGINCUST_FREE_URL; ?>/css/logo.png") ;
			width: 123px;
			height: 85px;
			background-repeat: no-repeat;
			background-position: center;
			position: absolute;
			right: 13%;
		}
		.appearance_page_logincust_options #submit:hover{

			background: #FF907A !important;
			border-color: #FF9D89 !important;
		}
		.appearance_page_logincust_options #submit{
			color:#fff !important;

			background: #FF7F66 !important;
			border-color: #FF5F3F !important;
			box-shadow: 0px 1px 0px #FF9682 inset, 0px 1px 0px rgba(0, 0, 0, 0.15);
		}
		.appearance_page_logincust_options #wpcontent {
			background:#fff;
		}

	</style>
<div class="wrap">
	<div id="logincust-logo"></div>
	<h2><?php _e('Login Customizer', LOGINCUST_TEXTDOMAIN); ?></h2>
    <h3><?php _e('Howdy!', LOGINCUST_TEXTDOMAIN); ?></h3>
    <p><?php _e('Login Customizer plugin allows you to easily customize your login page straight from your WordPress Customizer! You can preview your changes before you save them! Awesome, right?', LOGINCUST_TEXTDOMAIN); ?></p>
    <p><?php _e('In Customizer, navigate to Login Customizer', LOGINCUST_TEXTDOMAIN); ?>.</p>
    <a href="<?php echo get_admin_url(); ?>customize.php?url=<?php echo wp_login_url(); ?>" id="submit" class="button button-primary"><?php _e('Start Customizing!', LOGINCUST_TEXTDOMAIN); ?></a>
    <h3><?php _e('Credits/Support (All the unwanted crap)', LOGINCUST_TEXTDOMAIN); ?></h3>
    <p><?php _e('If you find any issues or if you want to contribute, then please free to drop me a mail at', LOGINCUST_TEXTDOMAIN); ?> <a href="https://themeisle.com/contact" target="_blank" rel="nofollow"><?php _e('this link', LOGINCUST_TEXTDOMAIN); ?></a>.</p>
    <p><?php _e('Thanks for using this plugin. Don not forget to leave a review.', LOGINCUST_TEXTDOMAIN); ?></p>
    <p> <a href="https://themeisle.com/" target="_blank" rel="nofollow"><?php _e('ThemeIsle :)', LOGINCUST_TEXTDOMAIN); ?></a>.</p>
</div>
<?php
}
?>