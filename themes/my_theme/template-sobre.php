<?php
/*
Template Name: Sobre
*/

get_header();
?>
<div class="clear"></div>

</header> <!-- / END HOME SECTION  -->

<div id="content" class="site-content">

	<div class="container">

		<div class="content-left-wrap">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<h1><?php echo get_option('sobre_title','Sobre'); ?></h1>
					<section class="description">
						<p><?php
							echo get_option('sobre_content','Bacon ipsum dolor amet short loin kielbasa jerky landjaeger sausage, short ribs ribeye filet mignon. Pork belly porchetta beef ribs kielbasa sirloin tail corned beef ribeye ground round, pork rump tongue flank boudin.

Biltong shank beef ribs, meatball sirloin jerky tongue ham hock turkey hamburger alcatra shoulder tail. Capicola fatback short ribs ribeye brisket pork chop shankle tri-tip flank prosciutto.');
						?></p>
					</section>
					<div data-scrollreveal="enter left after 0.15s over 1s" id="videoOurFocus">
						<?php masterslider(2); ?>
					</div>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->

	</div><!-- .container -->
<?php
get_footer();
?>