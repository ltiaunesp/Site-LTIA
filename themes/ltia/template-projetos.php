<?php
/*
Template Name: Projetos
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
						<h2 class="dark-text">Projetos</h2>
						<h6 class="dark-text">Lorem ipsum solem dolor sit amet. bacon dedeise solem</h6>
					</div>
					<p class="section-header-description">Nulla facilisi. Vestibulum vestibulum magna consequat nisi bibendum ullamcorper. Sed iaculis id nibh eget tincidunt. Nam laoreet lectus at dui ornare, ultricies euismod lacus porttitor. Nullam fringilla volutpat tortor, in iaculis purus gravida id. </p>
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->

	</div><!-- .container -->
	<div class="container-projetos projs-full-width">
		<?php 
				$args = array( 'post_type' => 'post', 'cat' => get_category_by_slug('projetos')->term_id,'order' => 'DESC');
				$loop = new WP_Query( $args );
				$i= 0;
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<a href="<?php the_permalink();?>" class="projeto"  title="<?php the_title(); ?>">
			<div class="projectBackground" style="background-image:url('<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>')"></div>
			<h6 class="projeto-titulo"><?php the_title(); ?></h6>
		</a>
		<?php
				endwhile;
		?>
	</div>
	<div class="container-parceiros">
		<div class="section-header">
			<h2 class="dark-text">Parceiros</h2>
			<h6 class="dark-text">Lorem ipsum solem dolor sit amet. bacon dedeise solem</h6>
		</div>
		<p class="section-header-description">
			<img src="http://127.0.0.1/wordpress/wp-content/uploads/2015/09/samsung.png" class="parceiroImg">
			<img src="http://127.0.0.1/wordpress/wp-content/uploads/2015/09/android.png" class="parceiroImg">
			<img src="http://127.0.0.1/wordpress/wp-content/uploads/2015/09/microsoft.png" class="parceiroImg">
		</p>
		<p style="font-size:0.6rem;margin-bottom:20;font-style:italic">Todas as logos e marcas são propriedade de suas respectivas empresas</p>
	</div>
	<?php			
		wp_reset_postdata();				
		get_footer();
	?>