<?php
	/*
	Plugin Name: Projetos
	Description: Plugin necess&aacute;rio para funcionamento do sistema de servi&ccedil;os
	Version: 1.0
	Author: Vinicius Figueiredo Rodrigues*/

	//USERMETA https://developer.wordpress.org/plugins/users/working-with-user-metadata/ e http://www.paulund.co.uk/add-upload-media-library-widgets

		class MyProjectsUsersClass{

			const PROJECT_IS_ACTIVE = 'project_active_or_no';
			const PROJECT_USERS = "project_users";
			const PROJECT_META_BOX_ID = "project_meta_box";
			// const USER_IS_ACTIVE = 'user_active_or_no';
			// const USER_PROFILE_PHOTO = 'user_profile_photo';
			// const USER_FUNCTION = "user_function";


			public function __construct() {

				add_action( 'add_meta_boxes', array( $this, 'add_users_meta_boxes' ) );
				add_action( 'save_post', array( $this, 'users_box_save' ) );
			}

			//Adicionando box dos Usuarios
			function add_users_meta_boxes(){
					if(class_exists(MyUsersClass))
						add_meta_box(PROJECT_META_BOX_ID,'Usu&aacute;rios participantes:', array($this,'users_box'), 'post', 'normal', 'high');
			}

			//INSERINDO A BOX DE USUARIOS

			function users_box($post){
				$val = get_post_custom($post->ID);
				$users = isset($val['users']) ? $val['users'][0]  : '';
				$users_copy = $users;
				?>
				<p style="clear:both;">Selecione os usu&aacute;rios:</p>
				<?php

						$users_explode = explode(";",$users);
						$parametro = array();
						$query = (new WP_User_Query( array('order' => 'asc', 'orderby' => 'display_name')))->results;

						for($i = 0; $i < count($query); $i++){
							$parametro[$i] = array();
							$parametro[$i][0] = $query[$i];
							if(in_array((string) $query[$i]->ID,$users_explode)){
								$parametro[$i][1] = 'true';
							}else{
								$parametro[$i][1] = 'false';
							}
						}
						MyUsersClass::listaUsuariosParaConfs($parametro);
				?>
				<input style="" type="hidden" name="users" id="users_field" value="<?php echo $users_copy; ?>" />
				<?php
			}

			//SALVANDO A BOX DOS USUARIOS

			function users_box_save($post_id){
				if(isset($_POST['users'])){
					update_post_meta( $post_id, 'users', $_POST['users'] );
					// var_dump($_POST);
					// exit;
				}
			}




			function is_project($post){
				if(! $post instanceof WP_Post){
						return false;
				}

				if(!has_category('projetos',$post)){
					return false;
				}
				return true;
			}

			function novoProjetoListener( $status, $old, $post ) {
				if($status == 'publish' && $old == 'draft'){
					// AÇÃO DE LISTENER AQUI;
				}
			}

		}
		// CLASSE DOS POSTS
		/*class PostProjectsClass{


			const POST_PROJECT_BOX_ID = 'post_project_meta_box';
			const POST_PROJECT_REFERENCE = 'project_reference';

			public function __construct() {

				add_action( 'add_meta_boxes', array( $this, 'add_projects_meta_boxes' ) );
				add_action( 'save_post', array( $this, 'project_box_save' ) );
			}

			//ADICIONANDO BOX DE RELACIONAMENTO DE POSTS EM PROJETOS
			function add_projects_meta_boxes(){
					if(class_exists(MyUsersClass))
						add_meta_box(POST_PROJECT_BOX_ID,'Projeto do POST:', array($this,'projects_box'), 'post', 'normal', 'high');
			}

			//INSERINDO A BOX DE USUARIOS

			function projects_box($post){
				$val = get_post_custom($post->ID);
				$project = isset($val['projeto']) ? $val['projeto'][0]  : '';
				$projects = (new WP_Query(array('cat' => get_category_by_slug('projetos')->term_id)));
				// var_dump($projects);
				?>
				<p style="clear:both;">
					<span>Selecione o Projeto:</span>
					<select name='projeto'>
						<option value="0">Nenhuma</option>
						<?php
							while($projects->have_posts()): $projects->the_post();
								?><option value='<?php echo get_the_ID();?>' <?php if($project == get_the_ID()) echo "selected"; ?>><?php echo the_title();?></option><?php
							endwhile;
						?>
					</select>
				</p>
				<?php
			}

			//SALVANDO A BOX DOS USUARIOS

			function project_box_save($post_id){
				if(isset($_POST['projeto']))
					update_post_meta( $post_id, 'projeto', $_POST['projeto'] );
			}

		}*/

		class MyProjectClass{
			const POST_PROJECT_CONFS_BOX_ID = 'post_project_confs_meta_box';
			const POST_PROJECT_CONFS_ACTIVE_BOX_ID = 'project__confs_active';

			public function __construct() {

				add_action( 'add_meta_boxes', array( $this, 'add_projects_meta_boxes' ) );
				add_action( 'save_post', array( $this, 'project_box_save' ) );
			}

			//ADICIONANDO BOX DE RELACIONAMENTO DE POSTS EM PROJETOS
			function add_projects_meta_boxes(){
					if(class_exists(MyUsersClass))
						add_meta_box(POST_PROJECT_CONFS_BOX_ID,'Configura&ccedil;&otilde;es de Projetos:', array($this,'projects_confs_box'), 'post', 'normal', 'high');
			}

			//INSERINDO A BOX DE USUARIOS

			function projects_confs_box($post){
				$val = get_post_custom($post->ID);
				$tecnologias = isset($val["tecnologias"]) ? $val['tecnologias'][0] : "";
				// var_dump($projects);
				?>
				<p style="clear:both;">
					<label>Tecnologias: </label>
					<input alt='Separadas por ";"' type="text" name="tecnologias" value="<?php echo $tecnologias; ?>">
				</p>
				<?php
				$ativo = isset($val["ativo"]) ? $val['ativo'][0] : 'off';
				?>
				<p style="clear:both;">
					<label>Projeto Conclu&iacute;do: </label>
					<input alt='Separadas por ";"' type="checkbox" name="ativo" <?php echo $ativo === 'on' ? "checked" : ""; ?>>
				</p>
				<?php
			}

			//SALVANDO A BOX DOS USUARIOS

			function project_box_save($post_id){
				if(isset($_POST['tecnologias']))
					update_post_meta( $post_id, 'tecnologias', $_POST['tecnologias'] );
				update_post_meta( $post_id, 'ativo', @$_POST['ativo'] === 'on' ? 'on' : 'off' );
			}
		}


		//INICIALIZANDO AS CLASSES

		function startClass(){
			new MyProjectsUsersClass();
			new MyProjectClass();
		}

		//Carregando Scripts
		function load_admin_projects_plugin_scripts(){
			wp_enqueue_script("project_plugin_admin", plugin_dir_url(__FILE__) . 'js/projects_admin.js');
		}

		//Adicionando ações
		if ( is_admin() ) {
			add_action( 'load-post.php', 'startClass' );
			add_action( 'load-post-new.php', 'startClass' );
		}
		add_action('admin_enqueue_scripts','load_admin_projects_plugin_scripts');

		add_action( 'transition_post_status', array(MyProjectsUsersClass, 'novoProjetoListener'), 10, 3 );
		// PROJETOS
		add_action('wp_footer', 'configAjaxUrl');


		// AJAX PROJETOS

		// CARREGANDO PROJETOS

		function load_project(){

			// DEFININDO TIPO

			header('Content-Type: application/json');

			// CONSULTA

				// DEFININDO SLUG PARA CONSULTA

			$loop = $slug = null;
			if(@$_POST['slug'] != '')
				$slug = $_POST['slug'];
			else if(@$_GET['slug'] != '')
				$slug = $_GET['slug'];

				// FAZENDO A CONSULTA

			if($slug != null)
				$loop = new WP_Query(
					array(
						'name'           => $slug,
						'posts_per_page' => 1
					)
				);

			// INICIANDO ARRAY

			$toJson = array( 'status' => false, 'post' => null );

			// PEGANDO VALORES
			if( $loop != null && $loop->posts[0] != null  ){

				// POST ATTR
				$post = $loop->posts[0];
				$thumbs = explode( '"', get_the_post_thumbnail( $post->ID, 'full' ) );

				// CUSTOM ATTR
				$val = get_post_custom($post->ID);
				$val = @$val['users'][0] != "" ? $val['users'][0] : "";

				// CONFIGURACAO DO ARRAY


				$toJson = array(
					'result'    =>   true,
					'content'   =>   $post->post_content,
					'id'        =>   $post->ID,
					'slug'      =>   $slug,
					'thumbnail' =>   array(
								'title' =>   $thumbs[9],
								'src'   => 	 $thumbs[5]
						),
					'title'     => 	 $post->post_title,
					'users'     =>   class_exists(MyUsersClass) ? MyUsersClass::consultaNomeUsuarios( explode( ";", $val ) ) : ""
				);
			}

			// ESCREVENDO RESULTADO
			echo json_encode($toJson);

			// PARANDO O PROGRAMA PARA NAO IR SUJEIRA

			die();
		}

		//ADICIONANDO ACAO DE AJAX PARA PROJETOS
		add_action( 'wp_ajax_load_project', 'load_project' );
		add_action( 'wp_ajax_nopriv_load_project', 'load_project' );

		// CONFIGURANDO AJAX

		function configAjaxUrl(){
			?>
				<script language='javascript'>
					var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>" ;
				</script>
			<?php
		}

		function getIdOfTags($tags){
			$tagsId = array();
			foreach($tags as $tag){
				array_push($tagsId, $tag->term_id);
			}
			return $tagsId;
		}
?>
