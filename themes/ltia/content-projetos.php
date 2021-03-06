<?php

/**

 * @package zerif

 */

?>



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
<div class="container">
	<div class="content-left-wrap">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
					<header class="entry-header">

						<h1 class="entry-title"><?php the_title(); ?></h1>


						<div class="entry-meta">
							<?php 
								if(!empty($participantes)){ ?>
									<h2>Envolvidos: <?php echo $participantes; ?></h2><?php
								} ?>
							<?php 
								if(!empty($meta["tecnologias"][0])){ ?>
									<h3>Tecnologias: <?php echo implode(", ",$meta["tecnologias"]); ?></h3><?php
								}
                                if(!empty($meta["ativo"][0])){ ?>
									<h3>Status: <?php echo $meta['ativo'][0] == 'on' ? 'Conclu&iacute;do' : 'Em andamento' ?></h3><?php
								}
							    $ativo = isset($val["ativo"]) ? $val['ativo'][0] : 'off';
                            ?>
							<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
						</div><!-- .entry-meta -->

					</header><!-- .entry-header -->






					<div class="entry-content">

						<?php the_content(); ?>
						
						
						<?php
							wp_link_pages( array(

								'before' => '<div class="page-links">' . __( 'Pages:', 'zerif-lite' ),

								'after'  => '</div>',

							) );

						?>
					</div><!-- .entry-content -->



						<p class="parceirosDireitos">Todas as eventuais logos e marcas, que possam ser encontradas nesta página, são propriedade de suas respectivas organizações</p>						
					<footer class="entry-footer">
						
						<?php edit_post_link( __( 'Edit', 'zerif-lite' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-footer -->
				

		</article><!-- #post-## -->

