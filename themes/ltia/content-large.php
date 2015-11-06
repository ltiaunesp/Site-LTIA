<?php

/**

 * @package zerif

 */

?>



<article class="large-container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_search() ) : ?>

		<?php if ( has_post_thumbnail()) : ?>

		<div class="post-img-wrap-large">

			 	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

					<?php 
						$image_id = get_post_thumbnail_id();
						$image_url_big = wp_get_attachment_image_src($image_id,'post-thumbnail-large', true);
						$image_url_tablet = wp_get_attachment_image_src($image_id,'post-thumbnail-large-table', true);
						$image_url_mobile = wp_get_attachment_image_src($image_id,'post-thumbnail-large-mobile', true);
					?>

			 		<picture>
						<source media="(max-width: 600px)" srcset="<?php echo $image_url_mobile[0]; ?>">
						<source media="(max-width: 768px)" srcset="<?php echo $image_url_tablet[0]; ?>">
						<img src="<?php echo $image_url_big[0]; ?>" alt="<?php the_title_attribute(); ?>">
					</picture>

				</a>

		</div>

		<div class="listpost-content-wrap-large">

		<?php else: ?>

		<div class="listpost-content-wrap-full">

		<?php endif; ?>

	<?php else:  ?>

			<div class="listpost-content-wrap-full">

	<?php endif; ?>

	<div class="list-post-top">

	<header class="entry-header">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>



		

	</header><!-- .entry-header -->



	<?php if ( is_search() ) : /* Only display Excerpts for Search */ ?>

	<div class="entry-summary">

		<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->

	<?php else : ?>

	<div class="entry-content">

		<?php 

			the_excerpt();

			wp_link_pages( array(

				'before' => '<div class="page-links">' . __( 'Pages:', 'zerif' ),

				'after'  => '</div>',

			) );

		?>

	</div><!-- .entry-content -->

	<?php endif; ?>

	</div><!-- .list-post-top -->

	

</div><!-- .listpost-content-wrap -->

</article><!-- #post-## -->