<?php

/**

 * The template for displaying Archive pages.

 *

 * Learn more: http://codex.wordpress.org/Template_Hierarchy

 *

 * @package zerif

 */



get_header();
$username = get_query_var("author_name");

$user = (new WP_User_Query(array( 'search' => $username )))->results[0];

$user_id = $user->ID;
$user = get_user_by('id',$user_id);
$user_meta = get_user_meta( $user_id );
$imageURL = explode("'",get_avatar($user_id, 300))[3];
$cont = 0;
 ?>

<div class="clear"></div>
	<script>
	paginaInicial = "equipe";
	</script>
</header> <!-- / END HOME SECTION  -->



<div id="content" class="site-content">

<div class="container author">


<div class="sidebar-wrap col-md-3 content-left-wrap">
	<div class="fotoUser" style="background-image: url('<?php echo $imageURL;?>');">
	</div>
	<h2 class="username"><?php echo @$user_meta["first_name"][0]." ".@$user_meta["last_name"][0];?></h2>
	<?php 
		if(!empty(@$user_meta['user_function'][0])){?>
		<h4 class="user_cargo"><?php echo (@$user_meta['user_function'][0]);?></h4>
	<?php
		}
	?>
	<?php 
		if(!empty(@$user_meta['description'][0])){?>
		<p class="user_desc"><?php echo (@$user_meta['description'][0]);?></p>
	<?php
		}
	?>
	<div class="user_socials social_icons">
		<ul>
			<?php MyUsersClass::listaRedesSociais($user); ?>
		</ul>
	</div>
</div><!-- .sidebar-wrap -->

<div class="content-left-wrap col-md-9">

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">
		<header class="page-header">
			<h1 class="page-title">Projetos</h1>
		</header>


		<?php
			$args = array( 'post_type' => 'post', 'cat' => get_category_by_slug('projetos')->term_id, 'order' => 'DESC');
			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) : 
		?>



			<?php /* Start the Loop */ ?>

			<?php

				while ( $loop->have_posts() ) : $loop->the_post(); 
				$participantes = explode(";", get_post_meta(get_the_ID(),'users')[0]);
				if(!in_array($user_id,$participantes))
					continue;
				$cont++;
				// exit;
			?>
				


				<?php

					/* Include the Post-Format-specific template for the content.

					 * If you want to override this in a child theme, then include a file

					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.

					 */

					get_template_part( 'content', get_post_format() );

				?>



			<?php endwhile; ?>



			<?php zerif_paging_nav(); ?>



		<?php else : 
			$cont = 1;
		?>



			<h3>Não foi encontrado nenhum projeto</h3>



		<?php endif; ?>
		<?php if($cont == 0) : ?>
			<h3>Não foi encontrado nenhum projeto</h3>
		<?php endif;?>


		</main><!-- #main -->

	</div><!-- #primary -->



</div><!-- .content-left-wrap -->






</div><!-- .container -->

<?php get_footer(); ?>