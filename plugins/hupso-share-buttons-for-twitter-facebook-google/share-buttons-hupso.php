<?php
/*
Plugin Name: Hupso Share Buttons for Twitter, Facebook & Google+
Plugin URI: http://www.hupso.com/share/
Description: Add simple social share buttons to your articles. Your visitors will be able to easily share your content on the most popular social networks: Twitter, Facebook, Google Plus, Linkedin, Tumblr, Pinterest, StumbleUpon, Digg, Reddit, Bebo, VKontakte and Delicous. These services are used by millions of people every day, so sharing your content there will increase traffic to your website.
Version: 4.0.3
Author: kasal
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: hupso
Domain Path: /languages
*/

global $HUPSO_VERSION;
$HUPSO_VERSION = '4.0.3';

$hupso_dev = '';
$hupso_state = 'normal';
$HUPSO_SHOW = true;

$hupso_plugin_url = plugins_url() . '/hupso-share-buttons-for-twitter-facebook-google';


/* Check if SSL is used */
if ( is_ssl() ) {
	$hupso_p = 'https:';
	if ( strpos( $hupso_plugin_url, 'http://' ) !== false) {
		$hupso_plugin_url = str_replace( 'http://', 'https://', $hupso_plugin_url);
	}
} 
else {
	$hupso_p = 'http:';
 }
 
if ( ! function_exists( 'is_ssl' ) ) {
	function is_ssl() {
		if ( isset($_SERVER['HTTPS']) ) {
			if ( 'on' == strtolower($_SERVER['HTTPS']) )
				return true;
			if ( '1' == $_SERVER['HTTPS'] )
				return true;
		} 
		elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
			return true;
		}
		return false;
	}
}

add_filter( 'the_content', 'hupso_the_content_normal', 10 );
add_filter( 'get_the_excerpt', 'hupso_get_the_excerpt', 1);
add_filter( 'the_excerpt', 'hupso_the_excerpt', 100 );

load_plugin_textdomain( 'hupso', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

if ( is_admin() ) {
	add_filter('plugin_action_links', 'hupso_plugin_action_links', 10, 2);
	add_action('admin_menu', 'hupso_admin_menu');
}

add_action( 'wp_head', 'hupso_set_facebook_thumbnail', 1 );

$hupso_all_services = array(
	'Twitter', 'Facebook', 'Google Plus', 'Pinterest', 'Linkedin', 'Tumblr', 'StumbleUpon', 'Digg', 'Reddit', 'Bebo', 'Delicious', 'VKontakte', 'Odnoklassniki', 'Sina Weibo', 'QZone', 'Renren', 'Email', 'Print'
);
$hupso_default_services = array(
	'Twitter', 'Facebook', 'Google Plus', 'Pinterest', 'Linkedin', 'StumbleUpon', 'Digg', 'Reddit', 'Bebo', 'Delicious'
);	

add_action('widgets_init', 'hupso_widget_init');
add_shortcode( 'hupso', 'hupso_shortcodes' );


/* Use shortcodes in text widgets */
$hupso_widget_text = get_option( 'hupso_widget_text', '1');
if ( $hupso_widget_text == '1' ) {
	add_filter('widget_text', 'do_shortcode');
}

/* Meta box on "Edit Post" screen */
$hupso_meta_box = get_option( 'hupso_meta_box', '' );
if ($hupso_meta_box == "1") {
   	include_once(plugin_dir_path( __FILE__ ) . '/share-buttons-hupso-meta.php');	
}

/* Add stylesheet */
add_action( 'wp_enqueue_scripts', 'hupso_add_my_stylesheet' );

function hupso_add_my_stylesheet() {
   wp_register_style( 'hupso_css', plugins_url('style.css', __FILE__) );
   wp_enqueue_style( 'hupso_css' );
}

function hupso_widget_init() {
    include_once(plugin_dir_path( __FILE__ ) . '/share-buttons-hupso-widget.php');
    register_widget('Hupso_Widget');
}

function hupso_shortcodes( $atts ) {
    global $hupso_state, $hupso_shortcode_params;
    $hupso_state = 'shortcodes';    
    if ($atts == '') {
        return hupso_the_content_shortcodes('');
    }
    else {
        $hupso_shortcode_params = $atts;
        return hupso_the_content_shortcodes('');
    }  
}

if ( function_exists('register_activation_hook') )
	register_activation_hook( __FILE__, 'hupso_plugin_activation' );

if ( function_exists('register_uninstall_hook') )
	register_uninstall_hook( __FILE__, 'hupso_plugin_uninstall' );

function hupso_plugin_uninstall() {
	delete_option( 'hupso_custom' );
	delete_option( 'hupso_button_type' );
	delete_option( 'hupso_button_size' );
	delete_option( 'hupso_toolbar_size' );
	delete_option( 'hupso_share_image' );
	delete_option( 'hupso_share_image_lang' );
	delete_option( 'hupso_share_image_custom_url' );
	delete_option( 'hupso_menu_type' );
	delete_option( 'hupso_button_position' );
	delete_option( 'hupso_show_posts' );
	delete_option( 'hupso_show_pages' );		
	delete_option( 'hupso_show_frontpage' );
	delete_option( 'hupso_show_category' );
	delete_option( 'hupso_show_search' );	
	delete_option( 'hupso_show_excerpts' );		
	delete_option( 'hupso_twitter_tweet' );
	delete_option( 'hupso_facebook_like' );
	delete_option( 'hupso_facebook_send' );
	delete_option( 'hupso_google_plus_one' );
	delete_option( 'hupso_pinterest_pin' );
	delete_option( 'hupso_linkedin_share' );
	delete_option( 'hupso_counters_lang' );
	delete_option( 'hupso_share_buttons_code' );
	delete_option( 'hupso_twitter' );
	delete_option( 'hupso_facebook' );
	delete_option( 'hupso_googleplus' );
	delete_option( 'hupso_pinterest' );	
	delete_option( 'hupso_linkedin' );
	delete_option( 'hupso_tumblr' );	
	delete_option( 'hupso_stumbleupon' );
	delete_option( 'hupso_digg' );
	delete_option( 'hupso_reddit' );
	delete_option( 'hupso_bebo' );
	delete_option( 'hupso_delicious' );
	delete_option( 'hupso_vkontakte' );		
	delete_option( 'hupso_odnoklassniki' );			
	delete_option( 'hupso_sinaweibo' );		
	delete_option( 'hupso_qzone' );		
	delete_option( 'hupso_renren' );				
	delete_option( 'hupso_email' );	
	delete_option( 'hupso_print' );	
	delete_option( 'hupso_email_button' );	
	delete_option( 'hupso_print_button' );	
	delete_option( 'hupso_title_text' );
	delete_option( 'hupso_twitter_via' );
	delete_option( 'hupso_facebook_image' );	
	delete_option( 'hupso_facebook_custom_image' );	
	delete_option( 'hupso_css_style' );
	delete_option( 'hupso_widget_text' );
	delete_option( 'hupso_password_protected' );	
	delete_option( 'hupso_page_url' );	
	delete_option( 'hupso_page_title' );		
	delete_option( 'hupso_hide_categories' );	
	delete_option( 'hupso_button_image_custom_url' );
	delete_option( 'hupso_custom_icons' );	
	delete_option( 'hupso_image_folder_url' );	
	delete_option( 'hupso_background_color' );	
	delete_option( 'hupso_border_color' );		
	delete_option( 'hupso_meta_box' );		
	
	/* Delete custom post types */
	$args = array(
	   'public'   => true,
	   '_builtin' => false
	);
	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $args, $output, $operator ); 
				
	foreach ( $post_types  as $post_type ) {
		$name = 'hupso_custom_post_' . $post_type;
		delete_option( $name );
	}
	
}

function hupso_plugin_activation() {
	
	/* Fix for bug in version 3.0 */
	$size = get_option( 'hupso_button_size', '');
	if ( ($size == 'share_button') or ($size == 'share_toolbar') or ($size == 'counters') ) {
		@update_option( 'hupso_button_size', 'button100x23');
	}
	
	/* Save plugin version */
	global $HUPSO_VERSION;
	@update_option( 'hupso_version', $HUPSO_VERSION );
	
}

function hupso_admin_menu() {
	add_options_page('Hupso Share Buttons Settings', 'Hupso Share Buttons', 'manage_options', __FILE__, 'hupso_admin_settings_show', '', 6);
}


function hupso_set_facebook_thumbnail() {
	global $post;
	
	/*
	if ( !is_singular() )
		return;
	*/	
		
	$thumb_image = '';		
	$hupso_facebook_image = get_option( 'hupso_facebook_image', 'fch' );
	$hupso_facebook_custom_image = get_option( 'hupso_facebook_custom_image', '' );	
	
	switch ( $hupso_facebook_image ) {
		case 'header':
			$thumb_image = get_header_image();
			break;
		case 'featured':
			if ( ( function_exists('has_post_thumbnail') ) && ( isset( $post ) && has_post_thumbnail( $post->ID ) ) ) {
				$thumb_image_temp = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
				$thumb_image = $thumb_image_temp[0];
			}
			break;	
		case 'custom':
			$thumb_image = $hupso_facebook_custom_image;
			break;
		case 'none': 
			$thumb_image = '';
			break;
		case 'fch': /* featured, custom, header */ 
			if ( ( function_exists('has_post_thumbnail') ) && ( isset( $post ) && has_post_thumbnail( $post->ID ) ) ) {
				$thumb_image_temp = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
				$thumb_image = $thumb_image_temp[0];
				break;
			}
			if (  $hupso_facebook_custom_image != '') {
				$thumb_image = $hupso_facebook_custom_image;
				break;						
			}
			$thumb_image = get_header_image();
			break;
	}	
	
	
	if ( $thumb_image != '' ) {
		echo '<meta property="og:image" content="' . esc_attr( $thumb_image ) . '"/>';
	}	
}

function hupso_get_the_excerpt($content) {
	$content = str_ireplace('[hupso_hide]', '', $content);
	$content = str_ireplace('[hupso]', '', $content);
	return $content;
}

function hupso_admin_settings_show() {
	global $hupso_all_services, $hupso_default_services, $hupso_plugin_url;
	
	wp_enqueue_script(
			'js_color',
			plugins_url('/js/jscolor/jscolor.js', __FILE__ )
	);		
	
	wp_enqueue_script(
			'hupso_create_button',
			plugins_url('/js/create_button.js', __FILE__ )
	);	

	
	$hupso_lang_code = __('en_US', 'hupso');
	$hupso_language = __('English', 'hupso');	
	$hupso_share_image = __('Share', 'hupso');
	$hupso_excerpts = __('Excerpts', 'hupso');

	
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' , 'hupso') );
	}
	
	/* save settings */
	if ( @$_POST[ 'button_type' ] != '' ) {	
		hupso_admin_settings_save();
	}
	
	
	echo '<div class="wrap" style="padding-bottom:100px;"><div class="icon32" id="icon-users"></div>';
	echo '<h2>'. __('Hupso Share Buttons for Twitter, Facebook & Google+ (Settings)', 'hupso').'</h2>';
	echo '<form name="hupso_settings_form" method="post" action="">'; 	
	
	echo '<div id="right" style="float:right; width:200px; margin-right:10px; margin-left:20px; margin-top:20px;">';
	echo '<div id="button_preview" style="background: #F7FFBF; padding: 10px 10px 10px 10px; "><table><tr><td><h3>' . __( 'Preview', 'hupso') . '</h3></td><td style="padding-left:50px;"><input class="button-primary" name="submit-preview" type="button" onclick="hupso_create_code()" value="' . __('Update', 'hupso') . '" /></td></tr></table><br/>';
	echo '<div id="button"></div>';
	echo '<div id="move_mouse"><p style="font-size:13px; padding-top: 15px;"><b>Move your mouse over the button to see the sharing menu.</b></p></div><br/><br/>';
	echo '<div style="padding-left:40px;"><input class="button-primary" name="submit-preview" type="submit" onclick="hupso_create_code()" value="' . __('Save Settings', 'hupso') . '" /></div>';
	echo '</div>';	
	
	echo '<div id="tips" style="background: #CCCCFF; padding: 10px 10px 10px 10px; margin-top:30px; ">';
	echo '<p><b>' . __('Shortcodes', 'hupso') . '</b></p>';
	echo '<p>Use <b>[hupso_hide]</b> anywhere in post\'s text to hide buttons for specific post.</p>';
	echo '<p>Use <b>[hupso]</b> anywhere in post\'s text to show buttons for specific post at custom position.</p>';
    echo '<p>Use <b>[hupso url="URL"]</b> anywhere in post\'s text to show buttons for specific post at custom position and using custom URL.</p>';
	echo '<p>Use <b>Hupso Share Buttons Widget</b> to show share buttons in sidebar or footer.</p>';	
	echo '<p>Use <b>echo do_shortcode( \'[hupso]\' ); </b> to show share buttons anywhere inside template files.</p>';	
	echo '<p>Use <b>global $HUPSO_SHOW; $HUPSO_SHOW = false;</b> to hide share buttons inside template files. Make sure you do this before div id="content". This will hide the buttons in content. Share buttons will still show in widget (if used).</p>';		
	echo '</div>';	
	
	echo '<div id="feedback" style="background: #C7FFA3; padding: 10px 10px 10px 10px; margin-top:30px; ">';	
	echo '<p><b>Bugs? Comments?</b></p>';
	echo '<p>Please read <a href="http://wordpress.org/extend/plugins/hupso-share-buttons-for-twitter-facebook-google/faq/" target="_blank">Frequently Asked Questions</a>.</p>';
	echo '<p>We value your feedback. Please send comments, bug reports and suggestions, so we can make this plugin the best social sharing plugin for Wordpress.</p>';
	echo '<p><a href="http://www.hupso.com/share/feedback/" target="_blank">Use this suggestion form</a></p>';
	echo '</div>';	
	
	echo '<div id="generic" style="background: #FFDD7F; padding: 10px 10px 10px 10px; margin-top:30px; ">';		
	echo '<p><b>Generic HTML code</b></p>';	
	echo '<p>If you need generic HTML code for Hupso Share Buttons to use in HTML documents or inside other CMS, you can <a href="http://www.hupso.com/share/" target="_blank">generate the code here</a>.</p>';
	echo '</div>';
    
    echo '<div id="translations" style="background: #99EEDD; padding: 10px 10px 10px 10px; margin-top:30px; ">';     
    echo '<p><b>Translations</b></p>'; 
    echo '<p>If you would like to translate this plugin into your language, send message <a href="http://www.hupso.com/share/feedback/" target="_blank"> here</a>. Your translations will be included in the next version of the plugin.</p>';
    echo '</div>';
	
	echo '</div>';
	
	
	$start = '<!-- Hupso Share Buttons - http://www.hupso.com/share/ -->';
	$end = '<!-- Hupso Share Buttons -->';
	$class_name = 'hupso_pop';
	$alt = 'Share Button';	
	$class_url = ' href="http://www.hupso.com/share/" ';	
	$style = 'padding-left:5px; padding-top:5px; padding-bottom:5px; margin:0; border:0px;';

	$button_60_img = '<img style="'.$style.' width: 60px; height:14px;" src="'.$hupso_plugin_url.'/buttons/button60x14.png" alt="'.$alt.'"/>';	
	$button_80_img = '<img style="'.$style.' width: 80px; height:19px;" src="'.$hupso_plugin_url.'/buttons/button80x19.png" alt="'.$alt.'"/>';
	$button_100_img = '<img style="'.$style.' width: 100px; height:23px;" src="'.$hupso_plugin_url.'/buttons/button100x23.png" alt="'.$alt.'"/>';
	$button_120_img = '<img style="'.$style.' width: 120px; height:28px;" src="'.$hupso_plugin_url.'/buttons/button120x28.png" alt="'.$alt.'"/>';	
	$button_160_img = '<img style="'.$style.' width: 160px; height:37px;" src="'.$hupso_plugin_url.'/buttons/button160x37.png" alt="'.$alt.'"/>';		
	
	
	$checked = 'checked="checked"';
	$current_button_size = get_option( 'hupso_button_size' , 'button100x23' ); 
	$button60_checked = '';
	$button80_checked = '';
	$button100_checked = '';
	$button120_checked = '';
	$button160_checked = '';
	$share_button_custom_checked = '';
	switch ( $current_button_size ) {
		case 'button60x14'  : $button60_checked = $checked; break;
		case 'button80x19'  : $button80_checked = $checked; break;
		case 'button100x23' : $button100_checked = $checked; break;
		case 'button120x28' : $button120_checked = $checked; break;
		case 'button160x37' : $button160_checked = $checked; break;
		case 'custom': $share_button_custom_checked = $checked; break;
		default:
			$button100_checked = $checked; break;
	}
	
	?>
	
	<input type="hidden" name="code" value="" />	
	<br/>
	<div id="button_type">	
	<table style="border: 0px;">
	<tr>
		<td style="width:100px;"><?php _e('Button type', 'hupso'); ?>
		</td>
		<?php
			$hupso_button_type = get_option( 'hupso_button_type', 'share_toolbar' );
			$hupso_button_image_custom_url = get_option( 'hupso_button_image_custom_url', '');
			$checked = ' checked="checked" ';
			$hupso_share_button_checked = '';
			$hupso_share_toolbar_checked = '';
			$hupso_share_counters_checked = '';
			switch ( $hupso_button_type ) {
				case 'share_button': 	$hupso_share_button_checked = $checked; break;
				case 'share_toolbar': 	$hupso_share_toolbar_checked = $checked; break;
				case 'counters': 		$hupso_share_counters_checked = $checked; break;
				default: $hupso_share_toolbar_checked = $checked;
			}			
		?>		
		<td><input type="radio" name="button_type" onclick="hupso_create_code()" onchange="hupso_create_code()" value="share_button" <?php echo $hupso_share_button_checked; ?>  /> Share Button<br/><img src="<?php echo  $hupso_plugin_url.'/buttons/button100x23.png';?>" /><br/><br/>
		<input type="radio" name="button_type" onclick="hupso_create_code()" onchange="hupso_create_code()" value="share_toolbar" <?php echo $hupso_share_toolbar_checked; ?> /> Share Toolbar <br/><img src="<?php echo $hupso_plugin_url.'/img/share_toolbar_big.png';?>" /><br/><br/>	
		<input type="radio" name="button_type" onclick="hupso_create_code()" onchange="hupso_create_code()" value="counters" <?php echo $hupso_share_counters_checked; ?> /> Counters <br/><img src="<?php echo $hupso_plugin_url.'/img/counters.png';?>" /><br/><br/>
		</td>	
	</tr>
	<tr><td style="width:100px;"></td><td><hr style="height:1px; width:500px; float:left;"/></td></tr>
	</table>	
	</div>
	
	<div id="button_style">
	<table style="border: 0px;">
	<tr>
		<td style="width:100px;"><?php _e('Button size', 'hupso'); ?></td>
		<td>
			<table style="border: 0px;">
			<tr><td><input type="radio" name="size" value="button60x14" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $button60_checked; ?> /></td><td style="padding-right:10px;"><?php echo $button_60_img ?></td></tr>
			<tr><td><input type="radio" name="size" value="button80x19" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $button80_checked; ?>/></td><td style="padding-right:10px;"><?php echo $button_80_img ?></td></tr>
			<tr><td><input type="radio" name="size" value="button100x23" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $button100_checked; ?>/></td><td style="padding-right:10px;"><?php echo $button_100_img ?></td></tr>
			<tr><td><input type="radio" name="size" value="button120x28" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $button120_checked; ?>/></td><td style="padding-right:10px;"><?php echo $button_120_img ?></td></tr>
			<tr><td><input type="radio" name="size" value="button160x37" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $button160_checked; ?>/></td><td style="padding-right:20px;"><?php echo $button_160_img ?></td></tr>
			<tr><td><input type="radio" name="size" value="custom" onclick="hupso_create_code()" onchange="hupso_create_code()"  <?php echo $share_button_custom_checked; ?>  /></td><td style="padding-left:10px;"><?php _e('Custom image from URL', 'hupso'); ?>: <input type="text" name="hupso_button_image_custom_url" onchange="create_code()" style="width:300px;" value="<?php echo $hupso_button_image_custom_url; ?>"/><br/> See <a href="http://www.hupso.com/share/gallery.php" target="_blank">gallery of custom share buttons</a>.</td></tr>				
			</table>
<hr style="height:1px; width:500px;"/>			
		</td>
	</tr>
	</table>
	</div>
	
	<div id="toolbar_size" style="display:none;">
	<table style="border: 0px;">
	<tr>
		<td style="width:100px;"><?php _e('Toolbar size', 'hupso'); ?></td>
		<td style="width:100px">
		<?php
			$hupso_toolbar_size = get_option( 'hupso_toolbar_size', 'medium' );
			$hupso_toolbar_size_big_checked = '';
			$hupso_toolbar_size_medium_checked = '';
			$hupso_toolbar_size_small_checked = '';
			$checked = ' checked="checked" ';
			switch ( $hupso_toolbar_size ) {
				case 'big': 	 $hupso_toolbar_size_big_checked = $checked; break;
				case 'medium' :  $hupso_toolbar_size_medium_checked = $checked; break;
				case 'small' :   $hupso_toolbar_size_small_checked = $checked; break;
				default: $hupso_toolbar_size_medium_checked = $checked;
			}			
		?>
		<input type="radio" name="select_toolbar_size" value="big" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $hupso_toolbar_size_big_checked; ?> /> <?php _e( 'Big', 'hupso');?> <br/>
		<input type="radio" name="select_toolbar_size" value="medium" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $hupso_toolbar_size_medium_checked; ?> /> <?php _e( 'Medium', 'hupso');?> <br/>	
		<input type="radio" name="select_toolbar_size" value="small" onclick="hupso_create_code()" onchange="hupso_create_code()" <?php echo $hupso_toolbar_size_small_checked; ?> /> <?php _e( 'Small', 'hupso');?> <br/>
		<hr style="height:1px; width:500px;"/>	
		</td>
	</tr>		
	</table>
	</div>	
	
	
	<div id="share_image" style="padding-top:10px;">
	<table style="border: 0px;">
		<tr>
		<td style="width:100px;"><?php _e('Share image', 'hupso'); ?></td>
		<td style="width:500px">
			<?php
			
				/* hupso_share_image */
				$checked = ' checked="checked" ';
				$hupso_share_image = get_option( 'hupso_share_image', 'normal' );
				$hupso_share_image_show_checked = '';
				$hupso_share_image_hide_checked = '';
				$hupso_share_image_lang_checked = '';
				$hupso_share_image_custom_checked = '';
				switch ( $hupso_share_image ) {
					case '':
					case 'show':	$hupso_share_image_show_checked = $checked; break;
					case 'hide':	$hupso_share_image_hide_checked = $checked;	break;
					case 'lang':	$hupso_share_image_lang_checked = $checked;	break;	
					case 'custom':	$hupso_share_image_custom_checked = $checked; break;	
				}
				
				$hupso_share_image_lang = get_option ( 'hupso_share_image_lang', '' );
				$hupso_share_image_custom_url = get_option ( 'hupso_share_image_custom_url', '' );
			
			?>
		<input type="radio" name="hupso_share_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="show" <?php echo $hupso_share_image_show_checked; ?>/> <?php _e('Show in language', 'hupso');?>:  
			<select id="share_image_lang" name="share_image_lang" onclick="hupso_create_code()" onchange="hupso_create_code()">
			  <option value="en" <?php if ( ($hupso_share_image_lang == 'en') || ($hupso_share_image_lang == '') ) echo ' selected ';?>>English</option>		
			  <option value="fr" <?php if ($hupso_share_image_lang == 'fr') echo ' selected ';?>>French</option>
			  <option value="de" <?php if ($hupso_share_image_lang == 'de') echo ' selected ';?>>German</option>
			  <option value="it" <?php if ($hupso_share_image_lang == 'it') echo ' selected ';?>>Italian</option>	  		  		  
			  <option value="pt" <?php if ($hupso_share_image_lang == 'pt') echo ' selected ';?>>Portuguese</option>
			  <option value="es" <?php if ($hupso_share_image_lang == 'es') echo ' selected ';?>>Spanish</option>
			  <option value="ru" <?php if ($hupso_share_image_lang == 'ru') echo ' selected ';?>>Russian</option>			  
			  <option value="id" <?php if ($hupso_share_image_lang == 'id') echo ' selected ';?>>Indonesian</option>
			  <option value="da" <?php if ($hupso_share_image_lang == 'da') echo ' selected ';?>>Danish</option>	
			  <option value="nl" <?php if ($hupso_share_image_lang == 'nl') echo ' selected ';?>>Dutch</option>	
			  <option value="sv" <?php if ($hupso_share_image_lang == 'sv') echo ' selected ';?>>Swedish</option>	
			  <option value="no" <?php if ($hupso_share_image_lang == 'no') echo ' selected ';?>>Norwegian</option>	
			  <option value="sr" <?php if ($hupso_share_image_lang == 'sr') echo ' selected ';?>>Serbian</option>
			  <option value="hr" <?php if ($hupso_share_image_lang == 'hr') echo ' selected ';?>>Croatian</option>
			  <option value="et" <?php if ($hupso_share_image_lang == 'et') echo ' selected ';?>>Estonian</option>
			  <option value="ro" <?php if ($hupso_share_image_lang == 'ro') echo ' selected ';?>>Romanian</option>
			  <option value="ga" <?php if ($hupso_share_image_lang == 'ga') echo ' selected ';?>>Irish</option>
			  <option value="af" <?php if ($hupso_share_image_lang == 'af') echo ' selected ';?>>Afrikaans</option>
			  <option value="sl" <?php if ($hupso_share_image_lang == 'sl') echo ' selected ';?>>Slovenian</option>
			  <option value="pl" <?php if ($hupso_share_image_lang == 'pl') echo ' selected ';?>>Polish</option>
			  <option value="bs" <?php if ($hupso_share_image_lang == 'bs') echo ' selected ';?>>Bosnian</option>
			  <option value="ms" <?php if ($hupso_share_image_lang == 'ms') echo ' selected ';?>>Malay</option>
			  <option value="zh" <?php if ($hupso_share_image_lang == 'zh') echo ' selected ';?>>Chinese</option>	
			  <option value="cs" <?php if ($hupso_share_image_lang == 'cs') echo ' selected ';?>>Czech</option>	
			  <option value="tr" <?php if ($hupso_share_image_lang == 'tr') echo ' selected ';?>>Turkish</option>			  		  
			</select><br/>
		<input type="radio" name="hupso_share_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="hide" <?php echo $hupso_share_image_hide_checked; ?>/> <?php _e('Hide', 'hupso'); ?><br/>
		<input type="radio" name="hupso_share_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="custom" <?php echo $hupso_share_image_custom_checked; ?>/> <?php _e('Custom image from URL', 'hupso'); ?>: <input name="hupso_share_image_custom_url" type="text" onmouseout="hupso_create_code()" onchange="hupso_create_code()" value="<?php echo $hupso_share_image_custom_url;?>" size="50" /><br/><span style="padding-left:30px; font-size:10px;">(<?php _e('Optimal image height: 32px - big, 24px - medium, 16px - small/counters', 'hupso'); ?>)</span><br/>	
		<hr style="height:1px; width:500px;"/>			
		</td>	
		</tr>	
		</table>
	</div>	
	
		<?php
				/* background & border color */
				$hupso_background_color = get_option( 'hupso_background_color', 'EAF4FF');			
				$hupso_border_color = get_option( 'hupso_border_color', '66CCFF');		
			?>	
	<div id="show_color">
	<table style="border: 0px;">
	<tr><td style="width:100px;"><?php _e('Background color');?></td><td><input class="color" type="text" id="background_color" name="background_color" value="#<?php echo $hupso_background_color; ?>" onchange="hupso_create_code()" onmouseout="hupso_create_code()" style="width: 100px;" /><input style="margin-left:30px;" type="button" value="Restore default" onclick="hupso_restore_background_color()" /></td></tr>
	<tr><td style="width:100px;"><?php _e('Border color');?></td><td><input class="color" type="text" id="border_color" name="border_color" value="#<?php echo $hupso_border_color; ?>" onchange="hupso_create_code()" onmouseout="hupso_create_code()" style="width: 100px;" /><input style="margin-left:30px;" type="button" value="Restore default" onclick="hupso_restore_border_color()" />	<hr style="height:1px; width:500px;"/></td></tr>
	</table>	
	</div>

	
	
	<div id="services">
	<table style="border: 0px;">
	<tr>
		<td style="width:100px;"><?php _e('Social networks', 'hupso'); ?></td>
		<td><?php hupso_settings_print_services(); ?></td>
	</tr>
	</table>
	</div>
		<?php
			$checked = ' checked="checked" ';
			$twitter_tweet_checked = '';
			$facebook_like_checked = '';
			$facebook_send_checked = '';
			$google_plus_one_checked = '';
			$pinterest_pin_checked = '';
			$email_button_checked = '';
			$print_button_checked = '';
			$linkedin_share_checked = '';
			
			$twitter_tweet = get_option( 'hupso_twitter_tweet', '1' );
			if ( $twitter_tweet == 1 ) $twitter_tweet_checked = $checked;
			
			$facebook_like = get_option( 'hupso_facebook_like', '1' );
			if ( $facebook_like == 1 ) $facebook_like_checked = $checked;	
			
			$facebook_send = get_option( 'hupso_facebook_send', '1' );
			if ( $facebook_send == 1 ) $facebook_send_checked = $checked;
			
			$google_plus_one = get_option( 'hupso_google_plus_one', '1' );
			if ( $google_plus_one == 1 ) $google_plus_one_checked = $checked;
			
			$pinterest_pin = get_option( 'hupso_pinterest_pin', '1' );
			if ( $pinterest_pin == 1 ) $pinterest_pin_checked = $checked;			
			
			$email_button = get_option( 'hupso_email_button', '0' );
			if ( $email_button == 1 ) $email_button_checked = $checked;	
			
			$print_button = get_option( 'hupso_print_button', '0' );
			if ( $print_button == 1 ) $print_button_checked = $checked;						
			
			$linkedin_share = get_option( 'hupso_linkedin_share', '0' );
			if ( $linkedin_share == 1 ) $linkedin_share_checked = $checked;	
		?>	
	<div id="counters_config" style="display:none;">
	<table style="border: 0px;">
	<tr>
		<td style="width:100px;"><?php _e('Social networks', 'hupso'); ?></td>
		<td>
			<table>
			<tr>
				<td><input type="checkbox" name="twitter_tweet" onclick="hupso_create_code()" value="1" <?php echo $twitter_tweet_checked;?> /></td>
				<td><img src="<?php echo $hupso_plugin_url; ?>/img/counters/twitter_tweet.png" /></td>
				<td></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="facebook_like" onclicke="hupso_create_code()" value="1" <?php echo $facebook_like_checked;?> /></td>
				<td><img src="<?php echo $hupso_plugin_url; ?>/img/counters/facebook_like.png" /></td>
				<td>
					<table>
						<tr>
							<td><input type="checkbox" name="facebook_send" onclick="hupso_create_code()" value="1" <?php echo $facebook_send_checked;?> /></td>
							<td><img src="<?php echo $hupso_plugin_url; ?>/img/counters/facebook_send.png" /></td>
						</tr>
					</table>
			</tr>
			<tr>
				<td><input type="checkbox" name="google_plus_one" onclick="hupso_create_code()" value="1" <?php echo $google_plus_one_checked;?> /></td>
				<td><img src="<?php echo $hupso_plugin_url; ?>/img/counters/google_plus_one.png" /></td>
				<td></td>
			</tr>	
			<tr>
				<td><input type="checkbox" name="pinterest_pin" onclick="hupso_create_code()" value="1" <?php echo $pinterest_pin_checked;?> /></td>
				<td><img src="<?php echo $hupso_plugin_url; ?>/buttons/PinExt.png" /></td>
				<td></td>
			</tr>		
			<tr>
				<td><input type="checkbox" name="email_button" onclick="hupso_create_code()" value="1" <?php echo $email_button_checked;?> /></td>
				<td><img src="<?php echo $hupso_plugin_url; ?>/img/services/email-button.png" /></td>
				<td></td>
			</tr>	
			<tr>
				<td><input type="checkbox" name="print_button" onclick="hupso_create_code()" value="1" <?php echo $print_button_checked;?> /></td>
				<td><img src="<?php echo $hupso_plugin_url; ?>/img/services/print-button.png" /></td>
				<td></td>
			</tr>									
			<tr>
				<td><input type="checkbox" name="linkedin_share" onclick="hupso_create_code()" value="1" <?php echo $linkedin_share_checked;?> /></td>
				<td><img src="<?php echo $hupso_plugin_url; ?>/img/counters/linkedin_share.png" /></td>
				<td></td>
			</tr>
	<tr>
	<td style="padding-top:70px;">&nbsp;</td>
	<td><? _e('Show counters in language', 'hupso');?>: 
	<select id="hupso_counters_lang" name="hupso_counters_lang" onchange="hupso_create_code()" onclick="hupso_create_code()">
	<?php hupso_counters_lang_list(); ?>
	</select><br/><br/>
	(<?php _e('Language changes will not show in preview', 'hupso');?>)
	</td><td><?php _e('Select which language to use for Counters (Tweet, Facebook Like, Facebook Share...)', 'hupso');?>. <?php _e('Some social networks support more languages than others, so some buttons might get translated, while some might stay in English', 'hupso');?>.</td>
	</tr>									
			</table>	

		</td>
	</tr>
	</table>
	
	</div>
	<div id="show_icons">	
	<table style="border: 0px;">
	<tr>
		<td style="width:100px;"><?php _e('Type of menu', 'hupso'); ?></td>
		<?php
			$menu_type = get_option( 'hupso_menu_type', 'labels' );
			$checked = ' checked="checked" ';
			$hupso_labels_checked = '';
			$hupso_icons_checked = '';
			switch ( $menu_type ) {
				case 'labels': 	$hupso_labels_checked = $checked; break;
				case 'icons' :  $hupso_icons_checked = $checked; break;
				default: $hupso_labels_checked = $checked;
			}			
		
		?>
		<td><hr style="height:1px; width:500px;"/><input type="radio" name="menu_type" value="labels" onclick="hupso_create_code()" <?php echo $hupso_labels_checked; ?> /> <?php _e('Show icons and service names', 'hupso'); ?><br/>
		<input type="radio" name="menu_type" value="icons" onclick="hupso_create_code()" <?php echo $hupso_icons_checked; ?> /> <?php _e('Show icons only', 'hupso'); ?><br/></td>
	</tr>	
	</table>
	</div>
	
	<table style="border: 0px;">
	<tr>
		<td style="width:100px;"><?php _e('Button position', 'hupso'); ?></td>
		<?php
			$button_position = get_option( 'hupso_button_position', 'below' );
			$checked = ' checked="checked" ';
			$hupso_below_checked = '';
			$hupso_above_checked = '';
			$hupso_both_checked = '';
			switch ( $button_position ) {
				case 'below': 	$hupso_below_checked = $checked; break;
				case 'above' :  $hupso_above_checked = $checked; break;
				case 'both':	$hupso_both_checked = $checked; break;
				default: $hupso_below_checked = $checked;
			}			
		?>
		<td><hr style="height:1px; width:500px;" align="left"/>
		<input type="radio" name="hupso_button_position" value="above" <?php echo $hupso_above_checked; ?> /> <?php _e('Above the post', 'hupso'); ?><br/>
		<input type="radio" name="hupso_button_position" value="below" <?php echo $hupso_below_checked; ?> /> <?php _e('Below the post', 'hupso'); ?><br/>
		<input type="radio" name="hupso_button_position" value="both" <?php echo $hupso_both_checked; ?> /> <?php _e('Above and below the post', 'hupso'); ?><br/></td>
	</tr>	
	<tr>
		<td style="width:100px;"><?php _e('Show buttons on', 'hupso'); ?></td>
		<td><hr style="height:1px; width:500px;" align="left"/>
			<?php
				$checked = ' checked="checked" ';
				$hupso_show_posts_checked = '';
				$hupso_show_pages_checked = '';
				$hupso_show_frontpage_checked = '';
				$hupso_show_category_checked = '';
				$hupso_show_excerpts_checked = '';				
				
				/* posts */
				$hupso_show_posts = get_option( 'hupso_show_posts', '1' );
				if ( $hupso_show_posts == 1 )
					$hupso_show_posts_checked = $checked;	
				else
					$hupso_show_posts_checked = '';		
					
				/* pages */	
				$hupso_show_pages = get_option( 'hupso_show_pages', '1' );
				if ( $hupso_show_pages == 1 )
					$hupso_show_pages_checked = $checked;	
				else
					$hupso_show_pages_checked = '';									
				
				/* frontpage */
				$hupso_show_frontpage = get_option( 'hupso_show_frontpage', '1' );
				if ( $hupso_show_frontpage == 1 )
					$hupso_show_frontpage_checked = $checked;	
				else
					$hupso_show_frontpage_checked = '';	
					
				/* archive pages (categories, tags, dates, authors) */	
				$hupso_show_category = get_option( 'hupso_show_category', '1' );
				if ( $hupso_show_category == 1 )
					$hupso_show_category_checked = $checked;	
				else
					$hupso_show_category_checked = '';	
					
				/* excerpts */	
				$hupso_show_excerpts = get_option( 'hupso_show_excerpts', '1' );
				if ( $hupso_show_excerpts == 1 )
					$hupso_show_excerpts_checked = $checked;	
				else
					$hupso_show_excerpts_checked = '';							
					
				/* search pages */
				$hupso_show_search = get_option( 'hupso_show_search', '1');
				if ( $hupso_show_search == '1' )
					$hupso_show_search_checked = $checked;	
				else
					$hupso_show_search_checked = '';						
					
				/* password protected posts */
				$hupso_password_protected = get_option( 'hupso_password_protected', '0');
				if ( $hupso_password_protected == '1' )
					$hupso_password_protected_checked = $checked;	
				else
					$hupso_password_protected_checked = '';			
					
			?>
			<input type="checkbox" name="hupso_show_posts" value="1" <?php echo $hupso_show_posts_checked; ?> /> <?php _e('Posts', 'hupso'); ?><br/>
			<input type="checkbox" name="hupso_show_pages" value="1" <?php echo $hupso_show_pages_checked; ?> /> <?php _e('Pages', 'hupso'); ?><br/>
			<input type="checkbox" name="hupso_show_frontpage" value="1" <?php echo $hupso_show_frontpage_checked; ?> /> <?php _e('Front page', 'hupso'); ?><br/>
			<input type="checkbox" name="hupso_show_category" value="1" <?php echo $hupso_show_category_checked; ?> /> <?php _e('Archive pages (categories, tags, dates, authors)', 'hupso'); ?><br/>	
			<input type="checkbox" name="hupso_show_excerpts" value="1" <?php echo $hupso_show_excerpts_checked; ?> /> <?php _e('Excerpts', 'hupso'); ?><br/>			
			<input type="checkbox" name="hupso_show_search" value="1" <?php echo $hupso_show_search_checked; ?> /> <?php _e('Search pages', 'hupso'); ?><br/>				
			<input type="checkbox" name="hupso_password_protected" value="1" <?php echo $hupso_password_protected_checked; ?> /> <?php _e('Password protected posts', 'hupso'); ?><br/>	
			
			<?php 
				/* Custom post types */
				$args = array(
				   'public'   => true,
				   '_builtin' => false
				);
				$output = 'names'; // names or objects, note names is the default
				$operator = 'and'; // 'and' or 'or'
				$post_types = get_post_types( $args, $output, $operator ); 

				if ( count($post_types) > 0) {
					echo '<p>' . __('Custom post types:', 'hupso') . '</p>';
					
					foreach ( $post_types  as $post_type ) {
						$name = 'hupso_custom_post_' . $post_type;
						$val = get_option( $name, '1' );
						if ($val == '1') {
							$checked = ' checked="checked" ';
						}
						else {
							$checked = '';
						}
						echo '<input type="checkbox" name="' . $name .'" value="1" ' . $checked.' > ' . $post_type . '<br/>';
					}			
				}
			
			?>
			
			<br/><?php echo __('If you want to show share buttons just on some posts/pages do this:', 'hupso') . ' ' . __('1. Clear options for posts/pages above', 'hupso') . ', ' . __('2. Enable Add share buttons option to "Edit Post" screen - below', 'hupso') . ', ' . __('3. Edit any post or page and configure display of share buttons at the bottom of right sidebar (on "Edit Post" screen)', 'hupso') . '<br/>';
				/* add meta box */
				$checked = ' checked="checked" ';
				$hupso_meta_box = get_option( 'hupso_meta_box', '' );
				if ( $hupso_meta_box == 1 )
					$hupso_meta_box_checked = $checked;	
				else
					$hupso_meta_box_checked = '';				
			?>
			<input type="checkbox" name="hupso_meta_box" value="1" <?php echo $hupso_meta_box_checked; ?> /> <?php _e('Add share buttons option to "Edit Post" screen', 'hupso'); ?><br/>		
		</td>
	</tr>	
	<tr>
		<td style="width:100px;"><?php _e('Hide buttons for specific categories', 'hupso'); ?></td>
		<td><hr style="height:1px; width:500px;" align="left"/><table><tr><td>
			<?php
				/* hidden categories */
				$hupso_hide_categories = get_option( 'hupso_hide_categories', array() );
			?>
			<select multiple size="8" name="hupso_hide_categories[]"> 
			 <?php 
			  $categories = get_categories(); 
			  foreach ($categories as $category) {
				$option = '<option value="'.$category->category_nicename.'"';
				if ( in_array($category->category_nicename, (array) $hupso_hide_categories ) ) {
					$option .= ' selected ';
				}			
				$option .= '>';
				$option .= $category->cat_name;
				$option .= ' ('.$category->category_count.')';
				$option .= '</option>';
				echo $option;
			  }
			 ?> 
			 <option value="hupso-option-always_show">--- <?php _e('Always show', 'hupso');?> ---</option>
			</select></td><td>
			<?php _e('Select categories where you want to hide share buttons.', 'hupso'); ?><br>
			   <?php _e('To select multiple categories, you need to hold down the Control Key for each selected category after the first one.', 'hupso');?><br />
			   <?php _e('Leave all options unselected or select just the last option to show buttons inside every category.', 'hupso');?>
			</td></tr></table>
		</td>
	</tr>			
	<tr>
		<td style="width:100px;"><?php _e('Get share text from', 'hupso'); ?></td>
		<td><hr style="height:1px; width:500px;" align="left"/>
			<?php
				$checked = ' checked="checked" ';
				$hupso_title_text_page_checked = '';
				$hupso_title_text_post_checked = '';
				
				/* posts */
				$hupso_title_text = get_option( 'hupso_title_text', 'post' );
				if ( $hupso_title_text == 'page' )
					$hupso_title_text_page_checked = $checked;	
				else
					$hupso_title_text_post_checked = $checked;			
			?>
			<input type="radio" name="hupso_title_text" value="post" <?php echo $hupso_title_text_post_checked; ?> /> <?php _e('Title of post in Wordpress', 'hupso'); ?><br/>	
			<input type="radio" name="hupso_title_text" value="page" <?php echo $hupso_title_text_page_checked; ?> /> <?php _e('Title of current web page', 'hupso'); ?>
		</td>
	</tr>	
	
	<tr>
		<td style="width:100px;"><?php _e('Twitter via', 'hupso'); ?></td>
		<td><hr style="height:1px; width:500px;" align="left"/>
			<?php
				
				/* Twitter via */
				$hupso_twitter_via = get_option( 'hupso_twitter_via', '' );
			
			?>
			@<input type="text" name="hupso_twitter_via" onclick="hupso_create_code()" onchange="hupso_create_code()" onmouseout="hupso_create_code()" size="30" value="<?php echo $hupso_twitter_via; ?>" /> <span style="padding-left:30px;"><?php _e('Add "via @yourprofile" to tweets', 'hupso', 'hupso');?>.</span><br/>
		</td>
	</tr>
	
	<tr>
		<td style="width:100px;"><?php _e('Image for Facebook thumbnail', 'hupso'); ?></td>
		<td><hr style="height:1px; width:500px;" align="left"/>
			<?php
				
				$checked = ' checked="checked" ';
				
				/* Facebook image */
				$hupso_facebook_image_header_checked = '';
				$hupso_facebook_image_featured_checked = '';				
				$hupso_facebook_image_custom_checked = '';
				$hupso_facebook_image_none_checked = '';				
				$hupso_facebook_image_fch_checked = '';	
				
				$hupso_facebook_image = get_option(	 'hupso_facebook_image', 'fch' );		

				switch ( $hupso_facebook_image ) {
					case 'header':
						$hupso_facebook_image_header_checked = $checked;
						break;
					case 'featured':
						$hupso_facebook_image_featured_checked = $checked;
						break;	
					case 'custom':
						$hupso_facebook_image_custom_checked = $checked;
						break;
					case 'none': 
						$hupso_facebook_image_none_checked = $checked;
						break;
					case 'fch': /* featured, custom, header */ 
						$hupso_facebook_image_fch_checked = $checked;
						break;						
				}
			
				/* Facebook custom image */
				$hupso_facebook_custom_image = get_option( 'hupso_facebook_custom_image', '' );
				
				/* Other */
				$header_image = trim(get_header_image());
			
			?>
			<span style="font-size:10px"><?php _e('All images for Facebook should be at least 200px in both dimensions (Facebook limitation)', 'hupso');?>.<br/><?php _e('After you change settings here, please wait 24 hours (or more) for Facebook to fetch new thumbnails', 'hupso');?>.<br/><?php _e('"og:image" meta tag with image url will be added to head of HTML. Select "None" to disable this feature', 'hupso');?>.<br/></span><br/>

			<input type="radio" name="hupso_facebook_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="header" <?php echo $hupso_facebook_image_header_checked; ?>/> <?php _e('Header image', 'hupso'); ?> <?php if ( $header_image != '' ) { echo '(<a href="' . $header_image . '" title="' . __( 'Click here to see full header image', 'hupso' ) . '" target="_blank">' . __( 'preview', 'hupso' ) . '</a>)'; } ?><br/>
			<input type="radio" name="hupso_facebook_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="featured" <?php echo $hupso_facebook_image_featured_checked; ?>/> <?php _e('Featured image of post', 'hupso'); ?><br/>
			<input type="radio" name="hupso_facebook_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="custom" <?php echo $hupso_facebook_image_custom_checked; ?>/> <?php _e('Custom image from URL', 'hupso'); ?>: <input type="text" name="hupso_facebook_custom_image" onclick="hupso_create_code()" onchange="hupso_create_code()" onmouseout="hupso_create_code()" size="50" value="<?php echo $hupso_facebook_custom_image; ?>" /><br/>
			<input type="radio" name="hupso_facebook_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="none" <?php echo $hupso_facebook_image_none_checked; ?>/> <?php _e('None', 'hupso'); ?><br/>				
			<input type="radio" name="hupso_facebook_image" onclick="hupso_create_code()" onchange="hupso_create_code()" value="fch" <?php echo $hupso_facebook_image_fch_checked; ?>/> <?php _e('FCH  - use Featured image of post (if available), then use Custom image (if available), then use Header image (if available)', 'hupso'); ?><br/>
		</td>
	</tr>	
	
	<tr>
		<td style="width:100px;"><?php _e('CSS style', 'hupso'); ?></td>
		<td><hr style="height:1px; width:400px;" align="left"/>
			<?php
				
				/* CSS Style */
				$hupso_css_style = get_option( 'hupso_css_style', 'padding-bottom:20px; padding-top:10px;');
				
			?>
			<input type="text" name="hupso_css_style" style="width:400px;" value="<?php echo $hupso_css_style;?>" /><br/><span><?php _e('Use CSS to style share buttons. For example: you can increase padding to have more free space above or below the buttons', 'hupso');?>.</span><br/>
		</td>
	</tr>	
	
	<tr>
		<td style="width:100px;"><?php _e('Widget Text', 'hupso'); ?></td>
		<td><hr style="height:1px; width:400px;" align="left"/>
			<?php
				
				/* Widget Text */
				$checked = ' checked="checked" ';
				$hupso_widget_text = get_option( 'hupso_widget_text', '1');
				if ( $hupso_widget_text == '1' )
					$hupso_widget_text_checked = $checked;	
				else
					$hupso_widget_text_checked = '';							
				
			?>
			<input type="checkbox" name="hupso_widget_text" value="1" <?php echo $hupso_widget_text_checked; ?> /> <?php _e('Use shortcodes in text widgets', 'hupso'); ?><br/><?php _e('If this is checked, you can use [hupso] shortcode inside text widgets and it will be replaced by share buttons', 'hupso'); ?>.
		</td>
	</tr>		
	
	<tr>
		<td style="width:100px;"><?php _e('Custom title', 'hupso'); ?></td>
		<td><hr style="height:1px; width:400px;" align="left"/>
			<?php
				/* page_title */
				$checked = ' checked="checked" ';
				$hupso_page_title = stripslashes(get_option( 'hupso_page_title', ''));		
				$hupso_page_title = htmlentities($hupso_page_title);	
			?>
			<input type="text" name="page_title" value="<?php echo $hupso_page_title;?>" onchange="hupso_create_code()" onmouseout="hupso_create_code()" size="50" /><br/><?php _e('Enter custom text that will always be used for sharing.', 'hupso'); ?><br/><?php _e('Leave this blank to use title of current page as text for sharing. [Default]', 'hupso'); ?>
		</td>
	</tr>		
	
	<tr>
		<td style="width:100px;"><?php _e('Custom url', 'hupso'); ?></td>
		<td><hr style="height:1px; width:400px;" align="left"/>
			<?php
				/* page_url */
				$checked = ' checked="checked" ';
				$hupso_page_url = get_option( 'hupso_page_url', '');			
			?>
			<input type="text" name="page_url" value="<?php echo $hupso_page_url;?>" onchange="hupso_create_code()" onmouseout="hupso_create_code()" size="50" /><br/><?php _e('Enter custom url that will always be used for sharing. You can enter your root website here (e.g.: http://www.example.com or http://example.blogspot.com), so counters will show statistics for your whole website, not for each page individually.', 'hupso'); ?><br/><?php _e('Leave this blank to use url of current page for sharing. [Default]', 'hupso'); ?>
		</td>
	</tr>		
	
	<tr>
		<td style="width:100px;"><?php _e('Use custom social share icons', 'hupso'); ?></div></td>
		<td><hr style="height:1px; width:400px;" align="left"/>
			<?php
				/* image_folder_url */
				$checked = ' checked="checked" ';
				$hupso_custom_icons_no_checked = '';
				$hupso_custom_icons_local_checked = '';
				$hupso_custom_icons_custom_checked = '';
				$hupso_custom_icons = get_option( 'hupso_custom_icons', 'no');				
				$hupso_image_folder_url = get_option( 'hupso_image_folder_url', '');		
				switch (	$hupso_custom_icons ) {
					case 'no': 			$hupso_custom_icons_no_checked = $checked; break;
					case 'local':		$hupso_custom_icons_local_checked = $checked;	break;
					case 'custom':	$hupso_custom_icons_custom_checked = $checked;	 break;
				}
				$image_url = plugins_url('/hupso-share-buttons-for-twitter-facebook-google/img/services/');
			?>
			<input type="radio" name="hupso_custom_icons" onclick="hupso_create_code()" onchange="hupso_create_code()" value="no" <?php echo $hupso_custom_icons_no_checked; ?>/> <?php _e('No. [Default. Do not change this unless you know what you are doing.]', 'hupso'); ?><br/>
			<input type="radio" name="hupso_custom_icons" onclick="hupso_create_code()" onchange="hupso_create_code()" value="local" <?php echo $hupso_custom_icons_local_checked; ?>/> <?php _e('Yes, serve images from local Wordpress folder. ', 'hupso'); ?>		
			[<?php echo $image_url;?>]<br/>
			<input type="radio" name="hupso_custom_icons" onclick="hupso_create_code()" onchange="hupso_create_code()" value="custom" <?php echo $hupso_custom_icons_custom_checked; ?>/> <?php _e('Yes, serve images from remote URL: ', 'hupso'); ?><br/>			
			<input type="text" name="hupso_image_folder_url" value="<?php echo $hupso_image_folder_url;?>" onchange="hupso_create_code()" onmouseout="hupso_create_code()" size="50" /><br/><input type="hidden" name="hupso_image_folder_local" value="<?php echo $image_url;?>" /><?php _e('Enter URL to folder with custom social images.  Include "/" at the end of the URL. If you would like to use custom icons, make sure you <a href="http://www.hupso.com/share/custom-social-icons.php" target="_blank">read instructions</a>.', 'hupso'); ?><br/><?php _e('This setting has no effect when using Counters.', 'hupso'); ?>
		</td>
	</tr>			
	</div>
	
	</table>
	<br/><br/><input class="button-primary" name="submit" type="submit" onclick="hupso_create_code()" value="<?php _e('Save Settings', 'hupso'); ?>" />
	</form>
	</div>
	
<?php
		
		
	
	
}

function hupso_admin_settings_save() {

	global $hupso_all_services, $hupso_default_services, $hupso_plugin_url;	
	update_option( 'hupso_custom', '1' );

	if ( @$_POST[ 'button_type' ] != '' )
		$post = true;
	else
		$post = false;	

	/* save button type */
	if ( $post ) {
		$hupso_button_type = @$_POST[ 'button_type' ];
		update_option( 'hupso_button_type', $hupso_button_type );		
	} else {
		$hupso_button_type = get_option ( 'hupso_button_type', 'share_toolbar');
	}

	/* save button size */
	if ( $post ) {
		$hupso_button_size = @$_POST[ 'size' ];
		update_option( 'hupso_button_size', $hupso_button_size );		
	} else {
		$hupso_button_size = get_option ( 'hupso_button_size', 'button100x23');
	}
	$b_size = str_replace( 'button', '', $hupso_button_size);
	if ($b_size != 'custom') {
		list($width, $height) = explode('x', $b_size, 2);	
	}

	/* save share button custom URL */
	if ( $post ) {
		$hupso_button_image_custom_url = @$_POST[ 'hupso_button_image_custom_url' ];
		update_option( 'hupso_button_image_custom_url', $hupso_button_image_custom_url );	
	}
	
	/* save background & border color */
	if ( $post ) {
		$hupso_background_color = @$_POST[ 'background_color' ];
		update_option( 'hupso_background_color', $hupso_background_color );	
		
		$hupso_border_color = @$_POST[ 'border_color' ];
		update_option( 'hupso_border_color', $hupso_border_color );			
	}	
	
	/* save custom icons */
	if ( $post ) {
		$hupso_custom_icons = @$_POST[ 'hupso_custom_icons' ];
		update_option( 'hupso_custom_icons', $hupso_custom_icons );	
		
		$hupso_image_folder_url  = @$_POST[ 'hupso_image_folder_url' ];
		update_option( 'hupso_image_folder_url ', $hupso_image_folder_url );			
	}	
	
	/* save toolbar size */
	if ( $post ) {
		$hupso_toolbar_size = @$_POST[ 'select_toolbar_size' ];
		update_option( 'hupso_toolbar_size', $hupso_toolbar_size );		
	} else {
		$hupso_button_size = get_option ( 'hupso_toolbar_size', 'medium');
	}	
			
	/* save share_image */
	if ( $post ) {
		$hupso_share_image = @$_POST[ 'hupso_share_image' ];
		update_option( 'hupso_share_image', $hupso_share_image );		
	} else {
		$hupso_share_image = get_option ( 'hupso_share_image', 'normal');
	}				
	
	/* save share_image_lang */
	if ( $post ) {
		$hupso_share_image_lang = @$_POST[ 'share_image_lang' ];
		update_option( 'hupso_share_image_lang', $hupso_share_image_lang );		
	} else {
		$hupso_share_image_lang = get_option ( 'hupso_share_image_lang', '');
	}	
	
	/* save share_image_custom_url */
	if ( $post ) {
		$hupso_share_image_custom_url = @$_POST[ 'hupso_share_image_custom_url' ];
		update_option( 'hupso_share_image_custom_url', $hupso_share_image_custom_url );		
	} else {
		$hupso_share_image_custom_url = get_option ( 'hupso_share_image_custom_url', '');
	}		
		
			
	/* save services */	
	$hupso_vars = 'var hupso_services=new Array(';
	foreach ( $hupso_all_services as $service_text ) {
		$service_name = strtolower( $service_text );
		$service_name = str_replace( ' ', '', $service_name );
		if ( $post ) {
			$value = @$_POST[ $service_name ];
			update_option( 'hupso_' . $service_name, $value );
		}
		else {	
			$value = get_option ( 'hupso_' . $service_name, in_array( $service_text, (array) $hupso_default_services ) );
		}
		if ( $value == '1' ) {
			$hupso_vars .= '"' . $service_text .'",';
		}
	}	
	$hupso_vars .= ');';
	$hupso_vars = str_replace( ',)', ')', $hupso_vars );	
	
	/* save hupso_counters_lang*/
	if ( $post ) {
		$hupso_counters_lang = @$_POST[ 'hupso_counters_lang' ];	
		update_option( 'hupso_counters_lang', $hupso_counters_lang );		
	}	
	
	/* save menu type */
	if ( $post ) {
		$hupso_menu_type = @$_POST[ 'menu_type' ];	
		update_option( 'hupso_menu_type', $hupso_menu_type );		
	}
	else {	
		$hupso_menu_type = get_option ( 'hupso_menu_type', 'labels' );	
	}
	$hupso_vars .= 'var hupso_icon_type = "'.$hupso_menu_type.'";';		

	/* save button position */
	if ( $post ) {
		$hupso_button_position = @$_POST[ 'hupso_button_position' ];	
		update_option( 'hupso_button_position', $hupso_button_position );
	}
	else {
		$hupso_button_position = get_option( 'hupso_button_position', 'below' );		
	}	
	
	/* save display options */
	if ( $post ) {
		$hupso_show_posts = @$_POST[ 'hupso_show_posts' ];	
		update_option( 'hupso_show_posts', $hupso_show_posts );
		
		$hupso_show_pages = @$_POST[ 'hupso_show_pages' ];	
		update_option( 'hupso_show_pages', $hupso_show_pages );			
	
		$hupso_show_frontpage = @$_POST[ 'hupso_show_frontpage' ];	
		update_option( 'hupso_show_frontpage', $hupso_show_frontpage );
		
		$hupso_show_category = @$_POST[ 'hupso_show_category' ];	
		update_option( 'hupso_show_category', $hupso_show_category );	
		
		$hupso_show_excerpts = @$_POST[ 'hupso_show_excerpts' ];	
		update_option( 'hupso_show_excerpts', $hupso_show_excerpts );			
		
		$hupso_show_search = @$_POST[ 'hupso_show_search' ];	
		update_option( 'hupso_show_search', $hupso_show_search );			
			
	}
	
	/* save options for counters */
	if ( $post ) {
		$twitter_tweet = @$_POST[ 'twitter_tweet' ];	
		update_option( 'hupso_twitter_tweet', $twitter_tweet );	
	
		$facebook_like = @$_POST[ 'facebook_like' ];	
		update_option( 'hupso_facebook_like', $facebook_like );	
		
		$facebook_send = @$_POST[ 'facebook_send' ];	
		update_option( 'hupso_facebook_send', $facebook_send );	
	
		$google_plus_one = @$_POST[ 'google_plus_one' ];	
		update_option( 'hupso_google_plus_one', $google_plus_one );	
		
		$pinterest_pin = @$_POST[ 'pinterest_pin' ];	
		update_option( 'hupso_pinterest_pin', $pinterest_pin );		
		
		$email_button = @$_POST[ 'email_button' ];	
		update_option( 'hupso_email_button', $email_button );					
		
		$print_button = @$_POST[ 'print_button' ];	
		update_option( 'hupso_print_button', $print_button );			
		
		$linkedin_share = @$_POST[ 'linkedin_share' ];	
		update_option( 'hupso_linkedin_share', $linkedin_share );	
	}
	
	/* Get title for sharing from */
	if ( $post ) {
		$hupso_title_text = @$_POST[ 'hupso_title_text' ];	
		update_option( 'hupso_title_text', $hupso_title_text );		
	}
	
	/* Save twitter_via */
	if ( $post ) {
		$hupso_twitter_via = @$_POST[ 'hupso_twitter_via' ];	
		update_option( 'hupso_twitter_via', $hupso_twitter_via );		
	}	
	
	/* Save Facebook image */
	if ( $post ) {
		$hupso_facebook_image = @$_POST[ 'hupso_facebook_image' ];	
		update_option( 'hupso_facebook_image', $hupso_facebook_image );		
	}		
	
	/* Save Facebook custom image */
	if ( $post ) {
		$hupso_facebook_custom_image = @$_POST[ 'hupso_facebook_custom_image' ];	
		update_option( 'hupso_facebook_custom_image', $hupso_facebook_custom_image );		
	}		
	
	/* Save CSS style */
	if ( $post ) {
		$hupso_css_style = @$_POST[ 'hupso_css_style' ];	
		update_option( 'hupso_css_style', $hupso_css_style );		
	}		
	
	/* Save page_url */
	if ( $post ) {
		$hupso_page_url = @$_POST[ 'page_url' ];	
		update_option( 'hupso_page_url', $hupso_page_url );		
	}	
	
	/* Save page_title */
	if ( $post ) {
		$hupso_page_title = @$_POST[ 'page_title' ];	
		update_option( 'hupso_page_title', $hupso_page_title );		
	}			
	
	/* Save hupso_widget_text */
	if ( $post ) {
		$hupso_widget_text = @$_POST[ 'hupso_widget_text' ];	
		update_option( 'hupso_widget_text', $hupso_widget_text );		
	}
	
	/* Save hupso_password_protected */
	if ( $post ) {
		$hupso_password_protected = @$_POST[ 'hupso_password_protected' ];	
		update_option( 'hupso_password_protected', $hupso_password_protected );		
	}		
	
	/* save hupso_hide_categories */
	if ( $post ) {
		$hupso_hide_categories = @$_POST['hupso_hide_categories'];
		update_option( 'hupso_hide_categories', $hupso_hide_categories );	
	}
	
	/* save button code */
	if ( $post ) {
		$code = stripslashes(@$_POST[ 'code' ]);
		update_option( 'hupso_share_buttons_code', $code );
	}
	
	/* save hupso_meta_box */
	if ( $post ) {
		$hupso_meta_box = @$_POST[ 'hupso_meta_box' ];
		update_option( 'hupso_meta_box', $hupso_meta_box );
	}	
	
	/* save custom post types */
	$args = array(
	   'public'   => true,
	   '_builtin' => false
	);
	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $args, $output, $operator ); 
	foreach ( $post_types  as $post_type ) {
		$name = 'hupso_custom_post_' . $post_type;
		$val = @$_POST[$name];
		if ($val == '') {
			update_option ( $name, '0' );
		}
		else {
			delete_option ( $name );
		}
	}	
	
	
}


function hupso_the_widget( $content ) {
	global $hupso_state;
	$hupso_state = 'widget';
	return hupso_the_content ( $content );
}

function hupso_the_content_normal( $content ) {
	global $hupso_state;
	$hupso_state = 'normal';
	return hupso_the_content ( $content );
}

function hupso_the_excerpt( $content ) {
	global $hupso_state, $post;
	$hupso_state = 'normal';
	
	
	$hupso_show_excerpts = get_option( 'hupso_show_excerpts' , '1' );	
	if ( ( $hupso_show_excerpts == 1 )  && ( $post->post_type != 'attachment' ) ) {
		return hupso_the_content ( $content );		
	}
	else {
		return $content;
	}	
}

function hupso_the_content_shortcodes( $content ) {
	global $hupso_plugin_url, $wp_version, $hupso_dev, $hupso_state, $HUPSO_SHOW, $hupso_p, $post;
	global $post_url, $post_title, $hupso_shortcode_params;
    
	$value = '';
	$hupso_meta_box = get_option( 'hupso_meta_box', '' );
	if ($hupso_meta_box != "1") {
		$value = '';
	} else {
		$value = get_post_meta( $post->ID, 'hupso-share-buttons', true );
		if ($value == 'default') {
			$value = '';
		}
		
		if ($value == 'disabled') {
			$content = str_ireplace('[hupso_hide]', '', $content);
			$content = str_ireplace('[hupso]', '', $content);	
			if ($value != 'enabled')
				return $content;
		}
	}

	if ($HUPSO_SHOW == false) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);
		if ($value != 'enabled')
			return $content;
	}
	
	$post_url = ( isset($GLOBALS['post']) ? get_permalink($GLOBALS['post']->ID) : get_permalink() );	
	$post_title = ( isset( $GLOBALS['post'] ) ? $GLOBALS['post']->post_title : '' );
    
    if ( isset($hupso_shortcode_params['title']) ) {
        $post_title = $hupso_shortcode_params['title'];
    }	
	
    if ( isset($hupso_shortcode_params['url']) ) {
        $post_url = $hupso_shortcode_params['url'];
    }   


	/* Check if we are inside category where buttons are hidden */
	$cats = get_the_category();
	if (isset($cats[0])) {
		$current_category = @$cats[0]->slug;	
	}
	else {
		$current_category = '';
	}	
	$hupso_hide_categories = get_option( 'hupso_hide_categories' , array() );
	if ( $hupso_hide_categories == '' ) {
		$hupso_hide_categories = array();
	}

	$hupso_title_text = get_option( 'hupso_title_text' , 'post' );
	$hupso_twitter_via = get_option( 'hupso_twitter_via', '' );
	$hupso_counters_lang = get_option( 'hupso_counters_lang', 'en_US' );
	
	$hupso_page_url = get_option( 'hupso_page_url', '' );
	$hupso_page_title = stripslashes(get_option( 'hupso_page_title', '' ));	

	
	/* default code */
	$share_code = '<!-- Hupso Share Buttons - http://www.hupso.com/share/ --><a class="hupso_toolbar" href="http://www.hupso.com/share/"><img src="' . $hupso_p . '//static.hupso.com/share' . $hupso_dev . '/buttons/share-medium.png" style="border:0px; padding-top:5px; float:left;" alt="Share"/></a><script type="text/javascript">var hupso_services_t=new Array("Twitter","Facebook","Google Plus","Linkedin","StumbleUpon","Digg","Reddit","Bebo","Delicious"); var hupso_toolbar_size_t="medium";';
	
    $code = get_option( 'hupso_share_buttons_code', $share_code );		
	if ( $hupso_p == 'https:' ) {
		$code = str_replace( 'src="http://static.hupso.com', 'src="https://static.hupso.com', $code );
	}
	
	$button_type = get_option( 'hupso_button_type', 'share_toolbar' );
	
	/* Check for old saved button code, prior to version 1.3 */
	if ( get_option( 'hupso_custom', '0' ) == 0 ) {
		$old_check = strpos( $code, '</script>' );
		if ( $old_check !== false ) {
			$code = substr( $code, 0, $old_check );
			
			/* Save new code */
			update_option( 'hupso_custom', '1' );
			update_option( 'hupso_share_buttons_code', $code );
		}	
	}
	
	/* Check for old saved button code, prior to version 2.0 */
	$old_check = strpos( $code, 'hupso_pop' );
	if ( $old_check !== false ) {
		$button_type = 'share_button';
	}	
	$old_check = strpos( $code, 'hupso_toolbar' );
	if ( $old_check !== false ) {
		$button_type = 'share_toolbar';
	}	
	
	/* Check for RTL language */
	$rtl = false;
	if ( version_compare($wp_version, '3.0', '<' ) ) {
		if ( get_bloginfo('text_direction') == 'rtl' ) {
			$rtl = true;
		}	
	}
	else {
		$rtl = is_rtl();
	}

	if ( $rtl ) {
		$code = str_replace( 'float:left', 'float:right', $code );
	}

	/* Twitter via @ */
	if ( $hupso_twitter_via != '') {
		$code .= 'var hupso_twitter_via="' . $hupso_twitter_via . '";';
	}

	/* Get shortcode params (if they exist) */
	global $hupso_shortcode_params;	
	if ($hupso_shortcode_params != '') {
		if ( isset( $hupso_shortcode_params['title'] ) ) {
			$h_title = $hupso_shortcode_params['title'];
		}
		else {
			$h_title = '';
		}
		if ( isset( $hupso_shortcode_params['url'] ) ) {		
			$h_url = $hupso_shortcode_params['url'];
		}
		else {
			$h_url = '';
		}
	}
	
	
	/* Shortcode param */
	if ( ($hupso_shortcode_params != '') && ($h_url != '') ) {
		$new_url = $h_url;
	}
	else {
		$new_url = $post_url;
	}
		
	switch ( $button_type ) {
		case 'share_button':	
			$code .= 'var hupso_url="' . $new_url . '";';
			break;
		case 'share_toolbar':
			$code .= 'var hupso_url_t="' . $new_url . '";';
			break;
		case 'counters':
			$code .= 'var hupso_url_c="' . $new_url . '";';
			break;
	}
			
	
	
	if ( $hupso_title_text == 'post' ) {
		$ptitle = strip_tags($post_title);
		if ( $hupso_page_title != '' ) {
			$new_title = $hupso_page_title;
		}
		else {
			$new_title = $ptitle;
		}		
		
		/* Shortcode param */
		if ( ($hupso_shortcode_params != '') && ($h_title != '') ) {
			$new_title = $h_title;
		}		
		
		$new_title = $post_title;
		
		switch ( $button_type ) {
			case 'share_button': 
				$code .= 'var hupso_title="' . str_replace('"', '&quot;', $new_title) . '";';
				break;
			case 'share_toolbar':
				$code .= 'var hupso_title_t="' . str_replace('"', '&quot;', $new_title) . '";';
				break;
			case 'counters':
				$code .= 'var hupso_title_c="' . str_replace('"', '&quot;', $new_title) . '";';
				break;
		}	
	}

	$code .= '</script>';
	
	switch ( $button_type ) {
		case 'share_button': 
			$js_file = 'share.js';
			break;
		case 'share_toolbar':
			$js_file = 'share_toolbar.js';
			break;
		case 'counters':
			$js_file = 'counters.js';
			break;			
	}
	
	$static_server = $hupso_p . '//static.hupso.com/share' . $hupso_dev . '/js/' . $js_file;
	$code .= '<script type="text/javascript" src="' . $static_server . '"></script><!-- Hupso Share Buttons -->';	
   
    $position = get_option( 'hupso_button_position', 'below' );
	
	$hupso_css_style = get_option( 'hupso_css_style', 'padding-bottom:20px; padding-top:10px;');
	if ($hupso_css_style != '') {
		$hupso_css_out = ' style="' . $hupso_css_style . '"';
	}
	else {
		$hupso_css_out = '';
	}
	$hupso_css_out .= ' class="hupso-share-buttons"';
	
	if ( stripos($content, '[hupso]') !== false) {
		$new_content = str_ireplace('[hupso]', '<div ' . $hupso_css_out. '>' . $code . '</div>', $content);
	}
	else {
		switch ( $position ) {
			case 'below':
				$new_content = $content . '<div' . $hupso_css_out. '>' . $code . '</div>'; 
				break;
			case 'above':
				$new_content = '<div' . $hupso_css_out. '>' . $code . '</div>' . $content;
				break;
			case 'both':
				if ( $hupso_state == 'normal' ) {
					/* article */
					$new_content = '<div' . $hupso_css_out. '>' . $code . '</div>' . $content . '<div' . $hupso_css_out. '>' . $code . '</div>';
				}
				else {
					/* widget, shortcodes */
					$new_content = '<div' . $hupso_css_out. '>' . $code . '</div>' . $content;
				}
				break;
			default:
				$new_content = $content . '<div' . $hupso_css_out. '>' . $code . '</div>';			
		}
	}	
		
    $hupso_shortcode_params = '';          
	return $new_content;
}

function hupso_the_content( $content ) {

	global $hupso_plugin_url, $wp_version, $hupso_dev, $hupso_state, $HUPSO_SHOW, $hupso_p, $post;
    
    if (strpos($content, '[hupso ') !== false) {
        return $content;
    }
    
	$value = '';
	$hupso_meta_box = get_option( 'hupso_meta_box', '' );
	if ($hupso_meta_box != "1") {
		$value = '';
	} else {
		if (isset($post->ID)) {
			$value = get_post_meta( $post->ID, 'hupso-share-buttons', true );
		}
		if ($value == 'default') {
			$value = '';
		}
		
		if ($value == 'disabled') {
			$content = str_ireplace('[hupso_hide]', '', $content);
			$content = str_ireplace('[hupso]', '', $content);	
			if ($value != 'enabled')
				return $content;
		}
	}
	
	if ($HUPSO_SHOW == false) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);
		if ($value != 'enabled')
			return $content;
	}
	
	/* Check custom post types */	
	if (isset($post)) {	
		$name = 'hupso_custom_post_' . $post->post_type;
	}
	else {
		$name = '';
	}
	$val = get_option( $name, '1' );
	if ($val == '0') {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);
		if ($value != 'enabled')
			return $content;		
	}
	
	/* Do now show share buttons when [hupso_hide] is used */
	if ( ($hupso_state == 'normal') && ( stripos($content, '[hupso_hide]') !== false ) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);
		if ($value != 'enabled')
			return $content;
	}

	/* Do not show share buttons in feeds */
	if ( ($hupso_state == 'normal') && (is_feed()) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);		
		if ($value != 'enabled')
			return $content;
	}
	
	/* Do not show share buttons on password protected pages, but show it inside widget */
	$pass = ( isset( $GLOBALS['post'] ) ? $GLOBALS['post']->post_password : '' );
	$hupso_password_protected = get_option( 'hupso_password_protected', '0');
	if ( $hupso_state == 'normal' ) {
		if ($pass != '') {
			if (!$hupso_password_protected) {
					if ($value != 'enabled')
						return $content;
			}
			else {
				if (post_password_required()) {
					if ($value != 'enabled')
						return $content;
				}
			}
		}
	}
	
	$hupso_show_search = get_option( 'hupso_show_search' , '1' );
	if ( ($hupso_state == 'normal') && (is_search()) && ($hupso_show_search != 1) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);
		if ($value != 'enabled')
			return $content;
	}
	
	$hupso_show_posts = get_option( 'hupso_show_posts' , '1' );
	if ( ($hupso_state == 'normal') && (is_single()) && ($hupso_show_posts != 1) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);
		if ($value != 'enabled')
			return $content;

	}
		
	$hupso_show_pages = get_option( 'hupso_show_pages' , '1' );	
	if ( ($hupso_state == 'normal') && (is_page()) && ($hupso_show_pages != 1) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);	
		if ($value != 'enabled')
			return $content;

	}	

	$hupso_show_frontpage = get_option( 'hupso_show_frontpage' , '1' );
	$hupso_show_category = get_option( 'hupso_show_category' , '1' );	
	
	/* Do not show share buttons if option is disabled */
	if ( ($hupso_state == 'normal') && (is_home()) && ($hupso_show_frontpage != 1) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);		
		if ($value != 'enabled')
			return $content;

	}
	/* Do not show share buttons if option is disabled */
	if ( ($hupso_state == 'normal') && (is_archive()) && ($hupso_show_category != 1) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);		
		if ($value != 'enabled')
			return $content;

	}	
	
	/* Check if we are inside category where buttons are hidden */
	$cats = get_the_category();
	if (isset($cats[0])) {
		$current_category = @$cats[0]->slug;	
	}
	else {
		$current_category = '';
	}	
	$hupso_hide_categories = get_option( 'hupso_hide_categories' , array() );
	if ( $hupso_hide_categories == '' ) {
		$hupso_hide_categories = array();
	}
	if ( ($hupso_state == 'normal') && (@in_array($current_category, (array) $hupso_hide_categories)) ) {
		$content = str_ireplace('[hupso_hide]', '', $content);
		$content = str_ireplace('[hupso]', '', $content);		
		if ($value != 'enabled')
			return $content;

	}	

	$hupso_title_text = get_option( 'hupso_title_text' , 'post' );
	$hupso_twitter_via = get_option( 'hupso_twitter_via', '' );
	$hupso_counters_lang = get_option( 'hupso_counters_lang', 'en_US' );
	
	$post_url = ( isset($GLOBALS['post']) ? get_permalink($GLOBALS['post']->ID) : get_permalink() );
	$post_title = ( isset( $GLOBALS['post'] ) ? $GLOBALS['post']->post_title : '' );	
		
	if ( ( $hupso_state == 'widget' ) || ( $hupso_state == 'shortcodes' ) ) {
		if ( isset($_SERVER['HTTPS']) ) {
			$protocol = 'https://';
		}
		else {
			$protocol = 'http://';
		}
		$post_url = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		$post_title = '';
	}

	$hupso_page_url = get_option( 'hupso_page_url', '' );
	$hupso_page_title = stripslashes(get_option( 'hupso_page_title', '' ));	
	
	
	/* default code */
	$share_code = '<!-- Hupso Share Buttons - http://www.hupso.com/share/ --><a class="hupso_toolbar" href="http://www.hupso.com/share/"><img src="' . $hupso_p . '//static.hupso.com/share' . $hupso_dev . '/buttons/share-medium.png" style="border:0px; padding-top:5px; float:left;" alt="Share"/></a><script type="text/javascript">var hupso_services_t=new Array("Twitter","Facebook","Google Plus","Linkedin","StumbleUpon","Digg","Reddit","Bebo","Delicious"); var hupso_toolbar_size_t="medium";';
	
    $code = get_option( 'hupso_share_buttons_code', $share_code );		
	if ( $hupso_p == 'https:' ) {
		$code = str_replace( 'src="http://static.hupso.com', 'src="https://static.hupso.com', $code );
	}
	
	$button_type = get_option( 'hupso_button_type', 'share_toolbar' );
	
	/* Check for old saved button code, prior to version 1.3 */
	if ( get_option( 'hupso_custom', '0' ) == 0 ) {
		$old_check = strpos( $code, '</script>' );
		if ( $old_check !== false ) {
			$code = substr( $code, 0, $old_check );
			
			/* Save new code */
			update_option( 'hupso_custom', '1' );
			update_option( 'hupso_share_buttons_code', $code );
		}	
	}
	
	/* Check for old saved button code, prior to version 2.0 */
	$old_check = strpos( $code, 'hupso_pop' );
	if ( $old_check !== false ) {
		$button_type = 'share_button';
	}	
	$old_check = strpos( $code, 'hupso_toolbar' );
	if ( $old_check !== false ) {
		$button_type = 'share_toolbar';
	}	
	
	/* Check for RTL language */
	$rtl = false;
	if ( version_compare($wp_version, '3.0', '<' ) ) {
		if ( get_bloginfo('text_direction') == 'rtl' ) {
			$rtl = true;
		}	
	}
	else {
		$rtl = is_rtl();
	}

	if ( $rtl ) {
		$code = str_replace( 'float:left', 'float:right', $code );
	}

	/* Twitter via @ */
	if ( $hupso_twitter_via != '') {
		$code .= 'var hupso_twitter_via="' . $hupso_twitter_via . '";';
	}

	/* Get shortcode params (if they exist) */
	global $hupso_shortcode_params;	
	if ($hupso_shortcode_params != '') {
		if ( isset( $hupso_shortcode_params['title'] ) ) {
			$h_title = $hupso_shortcode_params['title'];
		}
		else {
			$h_title = '';
		}
		if ( isset( $hupso_shortcode_params['url'] ) ) {		
			$h_url = $hupso_shortcode_params['url'];
		}
		else {
			$h_url = '';
		}
	}
	
	$new_url = '';
	
	if ( ( is_home() && $hupso_show_frontpage == 1 ) || ( is_archive() && $hupso_show_category == 1 ) || ( $hupso_shortcode_params != '' ) )  {
		if ( $hupso_page_url != '' ) {
			$new_url = $hupso_page_url;
		}
		else {
			$new_url = $post_url;
		}
	
		/* Shortcode param */
		if ( ($hupso_shortcode_params != '') && ($h_url != '') ) {
			$new_url = $h_url;
		}
	
	}
	
	switch ( $button_type ) {
		case 'share_button':	
			$code .= 'var hupso_url="' . $new_url . '";';
			break;
		case 'share_toolbar':
			$code .= 'var hupso_url_t="' . $new_url . '";';
			break;
		case 'counters':
			$code .= 'var hupso_url_c="' . $new_url . '";';
			break;
	}
	
	
	if ( $hupso_title_text == 'post' ) {
		$ptitle = strip_tags($post_title);
		if ( $hupso_page_title != '' ) {
			$new_title = $hupso_page_title;
		}
		else {
			$new_title = $ptitle;
		}		
		
		/* Shortcode param */
		if ( ($hupso_shortcode_params != '') && ($h_title != '') ) {
			$new_title = $h_title;
		}		
		
		switch ( $button_type ) {
			case 'share_button': 
				$code .= 'var hupso_title="' . str_replace('"', '&quot;', $new_title) . '";';
				break;
			case 'share_toolbar':
				$code .= 'var hupso_title_t="' . str_replace('"', '&quot;', $new_title) . '";';
				break;
			case 'counters':
				$code .= 'var hupso_title_c="' . str_replace('"', '&quot;', $new_title) . '";';
				break;
		}	
	}

	$code .= '</script>';
	
	switch ( $button_type ) {
		case 'share_button': 
			$js_file = 'share.js';
			break;
		case 'share_toolbar':
			$js_file = 'share_toolbar.js';
			break;
		case 'counters':
			$js_file = 'counters.js';
			break;			
	}
	
	$static_server = $hupso_p . '//static.hupso.com/share' . $hupso_dev . '/js/' . $js_file;
	$code .= '<script type="text/javascript" src="' . $static_server . '"></script><!-- Hupso Share Buttons -->';	
   
    $position = get_option( 'hupso_button_position', 'below' );
	
	$hupso_css_style = get_option( 'hupso_css_style', 'padding-bottom:20px; padding-top:10px;');
	if ($hupso_css_style != '') {
		$hupso_css_out = ' style="' . $hupso_css_style . '"';
	}
	else {
		$hupso_css_out = '';
	}
	$hupso_css_out .= ' class="hupso-share-buttons"';
	
	if ( stripos($content, '[hupso]') !== false) {
		$new_content = str_ireplace('[hupso]', '<div ' . $hupso_css_out. '>' . $code . '</div>', $content);
	}
	else {
		switch ( $position ) {
			case 'below':
				$new_content = $content . '<div' . $hupso_css_out. '>' . $code . '</div>'; 
				break;
			case 'above':
				$new_content = '<div' . $hupso_css_out. '>' . $code . '</div>' . $content;
				break;
			case 'both':
				if ( $hupso_state == 'normal' ) {
					/* article */
					$new_content = '<div' . $hupso_css_out. '>' . $code . '</div>' . $content . '<div' . $hupso_css_out. '>' . $code . '</div>';
				}
				else {
					/* widget, shortcodes */
					$new_content = '<div' . $hupso_css_out. '>' . $code . '</div>' . $content;
				}
				break;
			default:
				$new_content = $content . '<div' . $hupso_css_out. '>' . $code . '</div>';			
		}
	}	
		 
    $hupso_shortcode_params = '';     
	return $new_content;
		
}  

function hupso_settings_print_services() {
	
	global $hupso_all_services, $hupso_default_services, $hupso_plugin_url;
	
	foreach ( $hupso_all_services as $service_text ) {
		$service_name = strtolower( $service_text );
		$service_name = str_replace( ' ', '', $service_name );
		
		$checked = '';
		$value = get_option( 'hupso_' . $service_name , in_array( $service_text, (array) $hupso_default_services ) );
		if ( $value == "1" ) {
			$checked = 'checked="checked"';	 
		} 
		$text =' <img src="' . $hupso_plugin_url . '/img/services/' . $service_name . '.png"/> ' . $service_text;
		echo '<input type="checkbox" name="' . $service_name . '" value="1" onclick="hupso_create_code()" ' . $checked . ' /> ' . $text . '<br/>';

	}		
}

function hupso_plugin_action_links( $links, $file ) {
    static $this_plugin;
    if ( !$this_plugin ) {
        $this_plugin = plugin_basename( __FILE__ );
    }
 
    // check to make sure we are on the correct plugin
    if ( $file == $this_plugin ) {
         $settings_link = '<a href="options-general.php?page=hupso-share-buttons-for-twitter-facebook-google/share-buttons-hupso.php">' . __('Settings', 'hupso') . '</a>';
        array_unshift( $links, $settings_link );
    }
 
    return $links;
}


function hupso_counters_lang_list() {
	$languages = array (
		'af_ZA' => 'Afrikaans',
		'ar_AR' => 'Arabic',
		'az_AZ' => 'Azerbaijani',
		'be_BY' => 'Belarusian',
		'bg_BG' => 'Bulgarian',
		'bn_IN' => 'Bengali',
		'bs_BA' => 'Bosnian',
		'ca_ES' => 'Catalan',
		'cs_CZ' => 'Czech',
		'cy_GB' => 'Welsh',
		'da_DK' => 'Danish',
	  	'de_DE' => 'German',		
	  	'el_GR' => 'Greek',
	  	'en_GB' => 'English (UK)',
	  	'eo_EO' => 'Esperanto',	
	  	'es_ES' => 'Spanish (Spain)',	
	  	'es_LA' => 'Spanish',	
	  	'et_EE' => 'Estonian',		
	  	'eu_ES' => 'Basque',
	  	'fa_IR' => 'Persian',
	  	'fi_FI' => 'Finnish',
	  	'fo_FO' => 'Faroese',
	  	'fr_CA' => 'French (Canada)',
	  	'fr_FR' => 'French (France)',
	  	'fy_NL' => 'Frisian',
	  	'ga_IE' => 'Irish',
	  	'gl_ES' => 'Galician',
	  	'he_IL' => 'Hebrew',
	  	'hi_IN' => 'Hindi',
	  	'hr_HR' => 'Croatian',
	  	'hu_HU' => 'Hungarian',
	  	'hy_AM' => 'Armenian',
	  	'id_ID' => 'Indonesian',
	  	'is_IS' => 'Icelandic',
	  	'it_IT' => 'Italian',
	  	'ja_JP' => 'Japanese',
	  	'ka_GE' => 'Georgian',
	  	'km_KH' => 'Khmer',
	  	'ko_KR' => 'Korean',
	  	'ku_TR' => 'Kurdish',
	  	'la_VA' => 'Latin',
	  	'lt_LT' => 'Lithuanian',
	  	'lv_LV' => 'Latvian',
	  	'mk_MK' => 'Macedonian',
	  	'ml_IN' => 'Malayalam',
	  	'ms_MY' => 'Malay',
	  	'nb_NO' => 'Norwegian (bokmal)',
	  	'ne_NP' => 'Nepali',
	  	'nl_NL' => 'Dutch',
	  	'nn_NO' => 'Norwegian (nynorsk)',
	  	'pa_IN' => 'Punjabi',
	  	'pl_PL' => 'Polish',
	  	'ps_AF' => 'Pashto',
	  	'pt_BR' => 'Portuguese (Brazil)',
	  	'pt_PT' => 'Portuguese (Portugal)',
	  	'ro_RO' => 'Romanian',
	  	'ru_RU' => 'Russian',
	  	'sk_SK' => 'Slovak',
	  	'sl_SI' => 'Slovenian',
	  	'sq_AL' => 'Albanian',
	  	'sr_RS' => 'Serbian',
	  	'sv_SE' => 'Swedish',
	  	'sw_KE' => 'Swahili',
	  	'ta_IN' => 'Tamil',
	  	'te_IN' => 'Telugu',
	  	'th_TH' => 'Thai',
	  	'tl_PH' => 'Filipino',
	  	'tr_TR' => 'Turkish',
	  	'uk_UA' => 'Ukrainian',
	  	'vi_VN' => 'Vietnamese',
	  	'zh_CN' => 'Chinese - Simplified (China)',
	  	'zh_HK' => 'Chinese - Traditional (Hong Kong)',
	  	'zh_TW' => 'Chinese - Traditional (Taiwan)',
	);
		
	asort($languages);
	echo '<option value="en_US">English (US)</option>';		
	$hupso_counters_lang = get_option( 'hupso_counters_lang', 'en_US' );
	if ($hupso_counters_lang == '') {
		$hupso_counters_lang = 'en_US';
	}
	
	foreach ($languages as $lang_code => $lang_name ) {
		if ($lang_code == $hupso_counters_lang)
			$sel_lang = ' selected ';
		else
			$sel_lang = '';	
		echo '<option value="' . $lang_code . '"'. $sel_lang .'>' . $lang_name . '</option>';
	}
  		  		  		  			
}	




?>