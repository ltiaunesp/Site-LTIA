<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="content">

 *

 * @package zerif

 */
 // var_dump($_SERVER); exit;
 // var_dump(explode('/', $_SERVER["REDIRECT_URL"])[1]); exit;

 // $pathWordpress = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER["REQUEST_URI"];
$pathWordpress = get_site_url();
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=2">

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . "/favicon.ico" ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/ie.css" type="text/css">
<![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(is_front_page() ? array("custom-background", "overflowHidden") : array("custom-background"));?>  >




<!-- =========================

   PRE LOADER

============================== -->
<?php

 global $wp_customize;

 if(is_front_page() && !isset( $wp_customize ) && get_option( 'show_on_front' ) != 'page' ):

	$zerif_disable_preloader = get_theme_mod('zerif_disable_preloader');

	if( isset($zerif_disable_preloader) && ($zerif_disable_preloader != 1)):
		?>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.parallax-scroll.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
		<div class="preloader">
		<div class="status">&nbsp;</div>
		</div>
		<?php
	endif;

endif; ?>

<header id="inicio" class="header blockSection">

	<div id="main-nav" class="navbar navbar-inverse bs-docs-nav" role="banner">

		<div class="container">

			<div class="navbar-header responsive-logo">

				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">

				<span class="sr-only"><?php _e('Toggle navigation','zerif-lite'); ?></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				</button>



				<?php

					$zerif_logo = get_theme_mod('zerif_logo');

					if(isset($zerif_logo) && $zerif_logo != ""):

						echo '<a href="'.esc_url( home_url( '/' ) ).'" class="navbar-brand">';

							echo '<img id="logoLtia" src="'.$zerif_logo.'" alt="'.get_bloginfo('title').'">';

						echo '</a>';

					else:

						echo '<a href="'.esc_url( home_url( '/' ) ).'" class="navbar-brand">';

							if( file_exists(get_stylesheet_directory()."/images/logoCinza.png")):

								echo '<img id="logoLtia" src="'.get_stylesheet_directory_uri().'/images/logoCinza.png" alt="'.get_bloginfo('title').'">';

							else:

								echo '<img id="logoLtia" src="'.get_template_directory_uri().'/images/logoCinza.png" alt="'.get_bloginfo('title').'">';

							endif;

						echo '</a>';

					endif;

				?>



			</div>

			<nav class="navbar-collapse bs-navbar-collapse collapse" role="navigation"   id="site-navigation">
				<?php
						wp_nav_menu(
							array(
								'theme_location' => is_user_logged_in() ? 'logged-nav' : 'primary',
								'container' => false,
								'menu_class' => 'nav navbar-nav navbar-right responsive-nav main-nav-list',
								'fallback_cb'     => 'zerif_wp_page_menu'
							)
						);
						?>
						<script language="javascript" class="remover">
							jQuery(document).ready(function(){
							  setTimeout(function(){
							    jQuery(".overflowHidden").each(function(){
							      jQuery(this).removeClass("overflowHidden");
							    })
							  }, 1000)
							})
							var paginaInicial = <?php
								global $post;
								if(is_front_page())
									echo 'true';
								else if(is_page()){
									echo "'".$post->post_name."'";
								}
								else if(is_single()){
									if( has_category("projetos", $post) )
										echo "'projetos'";
									else if($post->post_type == 'ideas')
										echo "'ideastream'";
									else
										echo "'blog'";
								}
								else if(is_author())
									echo "'blog'";
								else
									echo "'ideastream'";
						?>;
							var pathWordpress = "<?php echo $pathWordpress;?>";
							var x = document.querySelector(".remover");
							x.remove();
						</script>
			</nav>

		</div>
	</div>

	<!-- / END TOP BAR -->
