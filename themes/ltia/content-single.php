<?php/** * @package zerif */?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	<header class="entry-header">		<h1 class="entry-title"><?php the_title(); ?></h1>		<div class="entry-meta">			<?php zerif_posted_on(); ?>		</div><!-- .entry-meta -->	</header><!-- .entry-header -->	<div class="entry-content">		<?php the_content(); ?>		<?php			wp_link_pages( array(				'before' => '<div class="page-links">' . __( 'Pages:', 'zerif-lite' ),				'after'  => '</div>',			) );		?>	</div><!-- .entry-content --><script>	paginaInicial = "blog";</script>	</article><!-- #post-## -->