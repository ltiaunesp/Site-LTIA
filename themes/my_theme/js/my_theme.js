var projectIsOpen = false;
var lastScrollPos;
var descendo = undefined;
var movimentando = false;
function mostraScrollBar(){
	document.documentElement.style.overflow = 'auto';
}

function escondeScrollBar(){
	document.documentElement.style.overflow = 'hidden';
}

function fechaProjeto(){
	var $ = jQuery.noConflict();
	if(!projectIsOpen)
		return;
	$('.lightBox').animate({
		height: "0"
	},1000, function(){
		$(this).remove();
		mostraScrollBar();
		history.back();
	});
	
}

function carregaProjeto(post){
	projectIsOpen = true;
	escondeScrollBar();
	var $ = jQuery.noConflict();
	
	// CRIANDO LIGHTBOX
	var lightBox = document.createElement("div");
	$(lightBox).addClass("lightBox");
	
	// CRIANDO CLOSE BUTTON
	var closeButton = document.createElement("span");
	$(closeButton).addClass("exitButton");
	$(closeButton).append("Fechar - X");
	$(closeButton).click(fechaProjeto);
		
	// CRIANDO THUMBNAIL IMAGE
	var thumbProject = document.createElement("img");
	$(thumbProject).addClass("thumbnailProject");
	$(thumbProject).attr("src", post.thumbnail.src);
	$(thumbProject).attr("title", post.title.title);
	
	
	// CRIANDO TITLE 
	var projectTitle = document.createElement("h1"); 
	$(projectTitle).addClass("titleProject");
	$(projectTitle).append(post.title);
	
	// CRIANDO CONTENT
	var contentProject = document.createElement("div");
	$(contentProject).addClass("contentProject");
	$(contentProject).append(post.content);
	
	
	// ADICIONANDO TODOS AO LIGHTBOX
	$(lightBox).append(closeButton);
	$(lightBox).append(thumbProject);
	$(lightBox).append(projectTitle);
	$(lightBox).append(contentProject);
	
	// INSERINDO O LIGHTBOX NA PAGINA
	
	$('body').append(lightBox);
	// MOSTRANDO O LIGHTBOX
	$(lightBox).animate({
		height: "100vh"
	},2000);
}

function mostraProjeto(response){
	// post = (request = response).post;
	post = request = response;
	if(post.result === true){	
		var url = pathWordpress + "index.php/projetos#" + post.slug;
		history.pushState(url, post.title + " | Projetos | LTIA – Laboratório de Tecnologia da Informação Aplicada", url);
		carregaProjeto(post);
	}else{
		alert("Falha ao carregar projeto");
	}
}

function buscaProjeto(slug){
	jQuery.ajax({
		url: encodeURI( ajaxUrl + "?action=load_project" + "&slug=" + slug),
		type: 'POST',
		data: {
			'action' : 'load_project',
			'slug' : slug
		},
		// PARA GET DIRETO USAR http://127.0.0.1/ltiaEstudo/wordpress/wp-admin/admin-ajax.php?action=load_project&slug=slug
		success: mostraProjeto,
		
		error: function(){
			alert("Não foi possível carregar a página. Tente novamente mais tarde");
		}
		
	});
}

jQuery(window).load(function() {
	if(paginaInicial){
		$(".navbar").addClass("normal");
	}
  /*jQuery("#projetos .carousel-inner a").click(
		function(e){
			e.preventDefault();
			var slug = this.href.split('/');
			slug = slug[slug.length - 2];
			buscaProjeto(slug);
		}
	);*/
	
});
jQuery(document).ready(function(){
	if(paginaInicial){
		jQuery("#down-button").click(function(){
			jQuery("#site-navigation > ul > li > a")[1].click();
		});
// 		lastScrollPos = jQuery(window).scrollTop();
// 		jQuery(window).scroll(function(){
// 			if(lastScrollPos < jQuery(window).scrollTop())
// 				descendo = true;
// 			else
// 				descendo = false;
// 			jQuery.each( jQuery(".blockSection"), function(index, el){
// 				if(movimentando)
// 					return;
// 				try{
// 					var inicio = $(el).offset().top,
// 					 fim = $(el).outerHeight();
// 					 atualPos = jQuery(window).scrollTop() - inicio;
// 					if(atualPos <= 0 || atualPos >= fim)
// 						return;
// 					if(descendo){
// 						switch(el.getAttribute("id")){
// 							case "inicio": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim / 20 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index+1].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "sobre": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim * 6 / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index+1].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "projetos": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim * 4 / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index+1].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "equipe": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index+1].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "local": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index+1].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "contato": // CADA UMA DAS SEÇÕES
// 								//NAO FAZ NADA EH A ULTIMA
// 								break;
// 						}
// 					}
// 					else{
// 						switch(el.getAttribute("id")){
// 							case "inicio": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim * 9 / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "sobre": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim * 9 / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "projetos": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim * 9 / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "equipe": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim * 9 / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "local": // CADA UMA DAS SEÇÕES
// 								if(atualPos > fim * 9 / 10 && atualPos < fim ){ // CONDIÇÃO PARA AVANÇAR
// 									movimentando = true;
// 									jQuery("#site-navigation > ul > li > a")[index].click();
// 									setTimeout(function(){movimentando = false}, 1200);
// 								}	
// 								break;

// 							case "contato": // CADA UMA DAS SEÇÕES
// 								//NAO FAZ NADA EH A ULTIMA
// 								break;
// 						}

// 					}
// 				}catch(e){}
// 			});
// 			lastScrollPos = jQuery(window).scrollTop();
// 		});
	}
});

var request;
var post;

