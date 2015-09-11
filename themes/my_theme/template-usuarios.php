<?php
/*
Template Name: Equipe
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
					<h1>Nossa Equipe</h1>
					<?php
					MyUsersClass::listaUsuarios((new WP_User_Query( array( 'meta_key' => MyUsersClass::USER_IS_ACTIVE, 'meta_value' => 'on' , "orderby" => 'name' ) ))->results);
					?>
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .content-left-wrap -->

	</div><!-- .container -->
<?php
get_footer();
?>