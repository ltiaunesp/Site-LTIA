<?php
/*
Template Name: Sobre
*/

get_header();
?>
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
<div id="content" class="site-content">

	<div class="container">

		<div class="content-left-wrap">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<div class="section-header">
				<?php 
					the_post();
					$sobre_titulo = get_option("sobre_title","Sobre");
					$sobre_subtitulo = get_option("sobre_subtitle","O que é o LTIA?");
					$sobre_conteudo = explode("\n", get_the_content());
				?>
				<h2 class="dark=text" data-scrollreveal="enter left after 0s over 1s"><?php the_title(); ?></h2>
					</div>
			<?php 
				if($sobre_conteudo[0] == ""){
			?>
				<p class="section-header-description" data-scrollreveal="enter left after 0s over 1s">Em 1995, nascia o Laboratório de Tecnologia da Informação Aplicada - LTIA, com intuito de instigar a curiosidade acerca de novas tecnologias e incentivar o desenvolvimento das habilidades dos alunos que compõe o time LTIA, esse laboratório - com cara de startup - oferece uma estrutura propícia para execução de ideias inovadoras, aprendizado de novas tecnologias e desenvolvimento de habilidades técnicas e interpessoais de alunos dos cursos de computação e design da Unesp,  Câmpus de Bauru. </p>
				<p class="section-header-description" data-scrollreveal="enter left after 0s over 1s">Ao trazer para a graduação uma experência semelhante a vivenciada pelos profissionais no mercado, sem deixar de lado a liberdade para desenvolver os mais variados projetos na área de tecnologia, a fisilosofia LTIAna incentiva a pró-atividade, o aprendizado e a propagação do conhecimento, trabalho em equipe, o aperfeiçoamento das habilidades técnicas e o comprometimento.</p>
				<p class="section-header-description" data-scrollreveal="enter left after 0s over 1s">Cheio de pessoas talentosas e graças à essa abordagem, ao longo desses anos já realizamos diversos projetos em parceria com empresas como Motorola, Intel e Microsoft. Em meio a projetos grandes e pequenos, sempre buscamos fazer o nosso melhor para que esses projetos impactem o mundo de uma maneira positiva!</p>
				<p class="section-header-description" data-scrollreveal="enter left after 0s over 1s">Atualmente, dividimos os projetos em grandes áreas: Aplicativos e Sistemas, Internet das Coisas (IoT) e Games. Dividimos as equipes de acordo com os projetos dentro dessas grandes áreas e também de acordo com o interesse de cada membro, para que todos se sintam motivados e comprometidos com o projeto que estão desenvolvendo. </p>
				<p class="section-header-description" data-scrollreveal="enter left after 0s over 1s">Sinta-se à vontade para conhecer nossos projetos, nossa equipe, nos seguir nas redes sociais e acompanhar nossos projetos no GitHub e Behance! </p>
			<?php
				}else foreach($sobre_conteudo as $paragrafo)
					echo 	'<p class="section-header-description" data-scrollreveal="enter left after 0s over 1s">'.$paragrafo.'</p>';
			?>
			<?php 
				// masterslider(1); 
			?>
				<div class="fb-like" data-href="https://www.facebook.com/LTIA.UNESP" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
			</main>
		</div>
		
	</div>
	</div>
<?php
get_footer();
?>