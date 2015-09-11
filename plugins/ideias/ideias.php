<?php
	/*
	Plugin Name: Ideias 
	Plugin URI: 
	Description:  Plugin necess&aacute;rio para funcionamento do sistema de ideias.
	Version: 1.0
	Author: Vinicius Figueiredo Rodrigues
	Author URI:*/		
?>
<?php
	
	class Comentarios{
		// COD COMENTARIO, COD USUARIO, COMENTARIO
		private $codComent;
		private $codUsuario;
		private $comentario;
		
		function __construct($cod = 0){
			if($cod > 0){
				
			}
			if($cod < 0){
				throw new InvalidArgumentException("O c&oacute;digo do comentário deve ser maior ou igual &agrave; zero.");
			}
		}
		
		function criarComentario($codUsuario, $comentario){
			
		}
		
	}
	class Ideia{
		// COD IDEIA, NOME IDEIA, COD USUARIO IDEIA, DESCRIÇÃO IDEIA, FOTO IDEIA(TALVEZ), VOTOS POSITIVOS IDEIA, VOTOS NEGATIVOS IDEIA, COMENTÁRIOS IDEIA, INSCRIÇÕES IDEIA.
		
		function __construct($cod = 0){
			if($cod > 0){
				
			}
			if($cod < 0){
				throw new InvalidArgumentException("O c&oacute;digo do usuário deve ser maior ou igual &agrave; zero.");
			}
		}
	}
	
	class MenuIdeia{
		const IDMENU = 'menu_ideias';
		const CLASSNAME = "MenuIdeia";
		
		function __construct(){
			add_action('admin_menu', array($this, 'criarMenu'));
		}
		
		function criarMenu(){
			// var_dump( plugin_dir_path(__FILE__) );
			add_options_page('Todas as Ideias', 'Ideias', 11, plugin_dir_path(__FILE__) . 'menu/menu.php');
			add_menu_page('Todas as Ideias', 'Ideias', 11, plugin_dir_path(__FILE__) . 'menu/menu.php', '' ,'dashicons-lightbulb');
			add_submenu_page(plugin_dir_path(__FILE__) . 'menu/menu.php', 'Ideias', 'Todas as Ideias', 10, plugin_dir_path(__FILE__) . 'menu/main.php');
			add_submenu_page(plugin_dir_path(__FILE__) . 'menu/menu.php', 'Ideias', 'Nova ideia', 10, plugin_dir_path(__FILE__) . 'menu/addIdeia.php');
			// add_options_page('Ideias','Todas as ideias', self::IDMENU, 10, array("MenuIdeia", 'criarMainPage'));
		}
		
	}
	new MenuIdeia();
	
?>