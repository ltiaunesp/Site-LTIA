<?php

/**

 * The template part for displaying a message that posts cannot be found.

 *

 * Learn more: http://codex.wordpress.org/Template_Hierarchy

 *

 * @package zerif

 */

?>



<section class="no-results not-found">

	<header class="page-header">

		<h1 class="page-title">Nada encontrado</h1>

	</header><!-- .page-header -->



	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>



			<p>Por favor, publique algo.</p>



		<?php elseif ( is_search() ) : ?>



			<p>Desculpa, mas não encontramos o que você desejava</p>

			<?php get_search_form(); ?>



		<?php else : ?>



			<p>Se não encontrou o que desejava, tente pesquisar com outras palavras-chave:</p>

			<?php get_search_form(); ?>



		<?php endif;?>

	</div><!-- .page-content -->

</section><!-- .no-results -->