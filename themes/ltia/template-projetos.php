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
						<h6 class="dark-text">O que fazemos?</h6>
					</div>
					<p class="section-header-description">Nossos projetos tem como foco o aprofundamento técnico, profissional e/ou acadêmico de nossos integrantes, por meio de parcerias com empresas e organizações locais ou multinacionais, como Microsoft e Motorola. À seguir, alguns de nossos projetos e parceiros:</p>
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
		<p class="section-header-description" style="margin-bottom:2px;">
			<?php
				if(is_active_sidebar('parceiros_sidebar'))
					dynamic_sidebar('parceiros_sidebar');	
			?>
		</p>
		<p style="font-size:0.6rem;margin-bottom:20;font-style:italic">Todas as logos e marcas são propriedade de suas respectivas empresas</p>
	</div>
	<?php			
		wp_reset_postdata();				
		get_footer();
	?>