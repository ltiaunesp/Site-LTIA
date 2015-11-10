<?php
/*
Template Name: Blog
*/
get_header();
?>
<div class="clear"></div>
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
<div id="content" class="site-content blog-template">

	<div class="container">

		<div class="sidebar-wrap col-md-3 content-left-wrap">

			<?php get_sidebar(); ?>

		</div><!-- .sidebar-wrap -->

		<div class="content-left-wrap col-md-9">

			<div id="primary" class="content-area">


				<main id="main" class="site-main" role="main">
					<header class="page-header">
						<h1 class="page-title">Blog</h1>
					</header>
					<?php 
				
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;			
					query_posts( array('post_type' => 'post', 'cat' => '-' . get_category_by_slug('projetos')->term_id, 'posts_per_page' => get_option('posts_per_page',10), 'order' => 'DESC', 'paged' => $paged ));
				
					if ( have_posts() ) :

						while ( have_posts() ) : the_post();
						
							get_template_part( 'content', get_post_format() );
						
						endwhile; 
						
						zerif_paging_nav();
					
					else : 
					
						get_template_part( 'content', 'none' );
						
					endif;
					
					wp_reset_postdata(); 
					
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->


<script>
	paginaInicial = "blog";
</script>
		



	</div><!-- .container -->
<?php get_footer(); ?>