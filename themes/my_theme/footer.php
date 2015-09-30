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
		<span>Todos os direitos reservados | <a href="mailto:contato@ltia.fc.unesp.br">Contato</a></span>
	</div>
	<div class="col-md-2" id="socialFooter">
		<a href="http://fb.com/LTIA.UNESP"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook_rod.png"></a>
		<a href="http://instagram.com/ltiaunesp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/instagram_rod.png"></a>
		<a href="<?php echo admin_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cadeado_rod.png"></a>
	</div>


<!--
	<?php
		$footer_sections = 0;
		$zerif_address = get_theme_mod('zerif_address',__('Company address','zerif-lite'));
		$zerif_address_icon = get_theme_mod('zerif_address_icon',get_template_directory_uri().'/images/map25-redish.png');
		
		$zerif_email = get_theme_mod('zerif_email','<a href="mailto:contact@site.com">contact@site.com</a>');
		$zerif_email_icon = get_theme_mod('zerif_email_icon',get_template_directory_uri().'/images/envelope4-green.png');
		
		$zerif_phone = get_theme_mod('zerif_phone','<a href="tel:0 332 548 954">0 332 548 954</a>');
		$zerif_phone_icon = get_theme_mod('zerif_phone_icon',get_template_directory_uri().'/images/telephone65-blue.png');

		$zerif_socials_facebook = get_theme_mod('zerif_socials_facebook','#');
		$zerif_socials_twitter = get_theme_mod('zerif_socials_twitter','#');
		$zerif_socials_linkedin = get_theme_mod('zerif_socials_linkedin','#');
		$zerif_socials_behance = get_theme_mod('zerif_socials_behance','#');
		$zerif_socials_dribbble = get_theme_mod('zerif_socials_dribbble','#');
			
		$zerif_copyright = get_theme_mod('zerif_copyright');

		if(!empty($zerif_address) || !empty($zerif_address_icon)):
			$footer_sections++;
		endif;
		
		if(!empty($zerif_email) || !empty($zerif_email_icon)):
			$footer_sections++;
		endif;
		
		if(!empty($zerif_phone) || !empty($zerif_phone_icon)):
			$footer_sections++;
		endif;
		if(!empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble) || 
		!empty($zerif_copyright)):
			$footer_sections++;
		endif;
		
		if( $footer_sections == 1 ):
			$footer_class = 'col-md-12';
		elseif( $footer_sections == 2 ):
			$footer_class = 'col-md-6';
		elseif( $footer_sections == 3 ):
			$footer_class = 'col-md-4';
		elseif( $footer_sections == 4 ):
			$footer_class = 'col-md-3';
		else:
			$footer_class = 'col-md-3';
		endif;
		
		/* COMPANY ADDRESS */
		if( !empty($zerif_address) ):
			echo '<div class="'.$footer_class.' company-details">';
				echo '<div class="icon-top red-text">';
					if( !empty($zerif_address_icon) ) echo '<img src="'.esc_url(__($zerif_address_icon,'zerif-lite')).'">';
				echo '</div>';
				echo $zerif_address;
			echo '</div>';
		endif;
		
		/* COMPANY EMAIL */
		
		
		if( !empty($zerif_email) ):
			echo '<div class="'.$footer_class.' company-details">';
				echo '<div class="icon-top green-text">';
					
					if( !empty($zerif_email_icon) ) echo '<img src="'.esc_url(__($zerif_email_icon,'zerif-lite')).'">';
				echo '</div>';
				echo $zerif_email;
			echo '</div>';
		endif;
		
		/* COMPANY PHONE NUMBER */
		
		
		if( !empty($zerif_phone) ):
			echo '<div class="'.$footer_class.' company-details">';
				echo '<div class="icon-top blue-text">';
					if( !empty($zerif_phone_icon) ) echo '<img src="'.esc_url(__($zerif_phone_icon,'zerif-lite')).'">';
				echo '</div>';
				echo $zerif_phone;
			echo '</div>';
		endif;
		
		if( !empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble) || 
		!empty($zerif_copyright)):
		
					echo '<div class="'.$footer_class.' copyright">';
					if(!empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble)):
						echo '<ul class="social">';
						
						/* facebook */
						if( !empty($zerif_socials_facebook) ):
							echo '<li><a target="_blank" href="'.esc_url(__($zerif_socials_facebook,'zerif-lite')).'"><i class="fa fa-facebook"></i></a></li>';
						endif;
						/* twitter */
						if( !empty($zerif_socials_twitter) ):
							echo '<li><a target="_blank" href="'.esc_url(__($zerif_socials_twitter,'zerif-lite')).'"><i class="fa fa-twitter"></i></a></li>';
						endif;
						/* linkedin */
						if( !empty($zerif_socials_linkedin) ):
							echo '<li><a target="_blank" href="'.esc_url(__($zerif_socials_linkedin,'zerif-lite')).'"><i class="fa fa-linkedin"></i></a></li>';
						endif;
						/* behance */
						if( !empty($zerif_socials_behance) ):
							echo '<li><a target="_blank" href="'.esc_url(__($zerif_socials_behance,'zerif-lite')).'"><i class="fa fa-behance"></i></a></li>';
						endif;
						/* dribbble */
						if( !empty($zerif_socials_dribbble) ):
							echo '<li><a target="_blank" href="'.esc_url(__($zerif_socials_dribbble,'zerif-lite')).'"><i class="fa fa-dribbble"></i></a></li>';
						endif;
						echo '</ul>';
					endif;	
			
			
					if( !empty($zerif_copyright) ):
						echo esc_attr($zerif_copyright);
					endif;
					
					echo '<div class="zerif-copyright-box"><a class="zerif-copyright" href="http://themeisle.com/themes/zerif-lite/" target="_blank" rel="nofollow">Zerif Lite </a>'.__('powered by','zerif-lite').'<a class="zerif-copyright" href="http://wordpress.org/" target="_blank" rel="nofollow"> WordPress</a></div>';
					
					echo '</div>';
			
		endif;
	?>
-->
</div> <!-- / END CONTAINER -->
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
				case 'ideastream' :
					jQuery(".menu-item:nth-child(8)").addClass("currentItem");
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
