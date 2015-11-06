<?php
/*
Template Name: Equipe
*/

get_header();
?>
<section style="background:rgba(0,0,0,0.4); width:100vw; height:80vh;"></section>
<style>
	<?php
		$image_id = get_post_thumbnail_id();
		$image_url_big = wp_get_attachment_image_src($image_id,'post-thumbnail-large', true);
	?>
	body{
		background-image: url("<?php echo get_template_directory_uri(); ?>/images/bg.jpg") ;
		background-size: 120vw ;
		background-position: center center;
		background-attachment: fixed !important;
		background-repeat: no-repeat;
	}
	.site-content{
		background:transparent;
	}
	
</style>

</header> <!-- / END HOME SECTION  -->

<div class="white-block">
<div id="content" class="site-content">

	<div class="container">

		<div class="content-left-wrap">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<div class="section-header">
						<h2 class="dark-text">Equipe</h2>
						<h6 class="dark-text">Quem faz parte do LTIA?</h6>
					</div>
					<div class="section-header-description"><?php
						MyUsersClass::listaUsuarios((new WP_User_Query( array( 'meta_key' => MyUsersClass::USER_IS_ACTIVE, 'meta_value' => 'on' , "orderby" => 'name' ) ))->results);
					?>
					</div>
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->

	</div><!-- .container -->
	<?php			
		get_footer();
	?>