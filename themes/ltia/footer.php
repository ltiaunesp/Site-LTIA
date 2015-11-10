<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package zerif

 */

?>



<footer id="footer">

<div class="container">
	<img class="col-md-2" id="logoFooter" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png">
	<div class="col-md-8" id="dataFooter">
		<p><a href="<?php echo get_site_url();?>">LTIA - Laboratório de Tecnologia da Informação Aplicada</a></p>
		<span>Telefone: +55 14 3103-6000 | Ramal: 7523</span><br>
		<span>Todos os direitos reservados</span>
	</div>
	<div class="col-md-2" id="socialFooter">
		<a href="http://fb.com/LTIA.UNESP"><i class="fa fa-facebook-official"></i></a>
		<a href="http://instagram.com/ltiaunesp"><i class="fa fa-instagram"></i></a>
		<a href="https://github.com/ltiaunesp"><i class="fa fa-github"></i></a>
		<a href="https://www.youtube.com/channel/UCSRT-la5hkhiUTuU6RlbhNw"><i class="fa fa-youtube-play"></i></a>
		<a href="https://www.linkedin.com/company/ltia---laborat-rio-de-tecnologia-da-informa-o-aplicada"><i class="fa fa-linkedin"></i></a><br>
		<a href="<?php echo admin_url();?>" alt="Painel de Controle"><i class="fa fa-lock"></i></a>
		<!--<a href="http://fb.com/LTIA.UNESP"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook_rod.png"></a>
		<a href="http://instagram.com/ltiaunesp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/instagram_rod.png"></a>-->
	</div>
</div> <!-- / END CONTAINER -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=165669613620052";
  fjs.parentNode.insertBefore(js, fjs);
  console.log("carregando");
}(document, 'script', 'facebook-jssdk'));</script>
<script language="javascript" class="remove">
	jQuery(document).ready(function(){
		var menuItens, itemHREF;
		(menuItens = jQuery(".menu-item")).removeClass("current");
		if(paginaInicial === true){
			menuItens[1].querySelector("a").setAttribute("href", pathWordpress + "/#sobre");
			menuItens[2].querySelector("a").setAttribute("href", pathWordpress + "/#projetos");
			menuItens[3].querySelector("a").setAttribute("href", pathWordpress + "/#equipe");
			//menuItens[5].querySelector("a").setAttribute("href", pathWordpress + "#blog");
			if(jQuery(window).scrollTop() < jQuery("#inicio").height() / 2){
				jQuery("#main-nav").addClass("fonteBranca");
				jQuery("#main-nav").css("-webkit-box-shadow", "0px 5px 11px 0px rgba(60,60,60, 0)");
				jQuery("#main-nav").css("box-shadow", "0px 5px 11px 0px rgba(60,60,60, 0)");
			}

			jQuery(window).scroll(scrolled);
		}
		else{
			
			switch(paginaInicial){
				case 'sobre':
					jQuery(".menu-item:nth-child(2)").addClass("currentItem");
					break;
				case 'projetos' :
					jQuery(".menu-item:nth-child(3)").addClass("currentItem");
					break;
				case 'equipe' :
					jQuery(".menu-item:nth-child(4)").addClass("currentItem");
					break;
				case 'blog' :
					jQuery(".menu-item:nth-child(7)").addClass("currentItem");
					break;
				default :
					jQuery(".menu-item:nth-child(6)").addClass("currentItem");
					break;
			}
		}
	});
	jQuery(".remove").remove();
</script>

</footer> <!-- / END FOOOTER  -->


<?php wp_footer(); ?>



</body>

</html>
