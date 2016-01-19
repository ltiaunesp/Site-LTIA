<?php
/*
Template Name: Equipe
*/


get_header();
global $post;
$sub_page = $post->post_parent;
the_post();
?>
<section style="background:rgba(0,0,0,0.4); width:100vw; height:80vh;"></section>
<style>
	<?php
		$image_id = get_post_thumbnail_id();
		$image_url_big = wp_get_attachment_image_src($image_id,'post-thumbnail-large', true);
	?>
	body{
		background-image: url("<?php echo $image_url_big; ?>") ;
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
						<h2 class="dark-text"><?php the_title(); ?></h2>
						<h6 class="dark-text">Quem faz parte do LTIA?</h6>
					</div>
					<p class="section-header-description"><?php echo get_the_content(); ?></p>
					
					<div class="section-header-description"><?php
						if($sub_page)
							$args = array("orderby" => 'name' );
						else
							$args = array('meta_key' => MyUsersClass::USER_IS_ACTIVE, 'meta_value' => 'on' , "orderby" => 'name' );
                        MyUsersClass::listaUsuarios(MyUsersClass::consultaUsuariosCoronel($args));
                        
					?>
					</div>
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->
		<script>
			paginaInicial = "equipe";
		</script>
	</div><!-- .container -->
	<?php			
		get_footer();
	?>