<?php
/**
 * The Template for displaying all single posts.
 *
 * @package zerif
 */
get_header(); ?>
<div class="clear"></div>
</header> <!-- / END HOME SECTION  -->
<section style="background:rgba(0,0,0,0.4); width:100vw; height:60vh;"></section>
	<?php
		// GET DATA
		$image_id = get_post_thumbnail_id();
		$image_url_big = wp_get_attachment_image_src($image_id,'post-thumbnail-large', true);
		$meta = get_post_meta(get_the_ID());

		// GET PARTICIPANTES
		$users = MyUsersClass::getUsersNames(explode(";", $meta['users'][0]));
		$participantes = array();
		foreach($users['names'] as $key => $username)
			array_push($participantes, "<a href=\"".$users['urls'][$key]."\">". $username ."</a>" );
		$participantes = implode(", ", $participantes);
	?>
<style>
	body{
		background-image: url('<?php echo $image_url_big[0];?>') !important;
		background-size: 100vw 100vh;
		background-position: center 0;
		background-attachment: fixed !important;
		background-repeat: no-repeat;
	}
	.site-content{
		background:transparent;
	}
	
</style>
<div class="white-block">
<div id="content" class="site-content">
<div class="container">
<div class="content-left-wrap col-md-9">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php 
			while ( have_posts() ) : the_post(); 
					$t = "single";
					foreach( (array) get_the_category() as $cat ) {
						if ( file_exists(TEMPLATEPATH . "/content-".$cat->slug.".php") )
							$t = TEMPLATEPATH . "/content-".$cat->slug.".php"; 
					} 
				 get_template_part( 'content', $t );
				 
				 // removido para parar de exibir proximo ou anterior zerif_post_nav(); 
			 
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template('');
				endif;
			endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<div class="sidebar-wrap col-md-3 content-left-wrap">
	<?php get_sidebar(); ?>
</div><!-- .sidebar-wrap -->
</div>
<?php get_footer(); ?>