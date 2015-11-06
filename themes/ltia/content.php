<?php

/**

 * @package zerif

 */

?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! is_search() ) : ?>

		<?php if ( has_post_thumbnail()) : ?>

		<div class="post-img-wrap">

			 	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

				<?php the_post_thumbnail("post-thumbnail"); ?>

				</a>

		</div>

		<div class="listpost-content-wrap">

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



	<?php if ( is_search() ) : // Only display Excerpts for Search ?>

	<div class="entry-summary">

		<?php the_excerpt(); ?>



	<?php else : ?>

	<div class="entry-content">

		<?php 

			the_excerpt()

			//the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'zerif-lite' ) ); 

		?>

		<?php

			wp_link_pages( array(

				'before' => '<div class="page-links">' . __( 'Pages:', 'zerif-lite' ),

				'after'  => '</div>',

			) );

		?>


	<?php endif; ?>


	</div><!-- .entry-content --><!-- .entry-summary -->

	</div><!-- .list-post-top -->


</div><!-- .listpost-content-wrap -->

</article><!-- #post-## -->







