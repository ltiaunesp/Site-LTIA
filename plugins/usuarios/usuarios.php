<?php
	/*
	Plugin Name: Usu&aacute;rios
	Plugin URI: 
	Description:  Plugin necess&aacute;rio para funcionamento do sistema de usu&aacute;rios e de projetos assim como para a foto de perfil de usu&aacute;rio.
	Version: 1.0
	Author: Vinicius Figueiredo Rodrigues
	Author URI:*/		
	
	
		//Adicionando ações
		add_action('show_user_profile','my_user_fields');
		add_action('edit_user_profile','my_user_fields');
		add_action('personal_options_update','my_user_save');
		add_action('edit_user_profile_update','my_user_save');
		
		//Carregando Scripts
		function load_admin_usuarios_plugin_scripts(){
			wp_enqueue_media();		
			wp_enqueue_script('media-upload');
			wp_enqueue_script('upload_media_widget', plugin_dir_url(__FILE__) . 'js/upload-media.js', array('jquery'));
		}
		add_action('admin_enqueue_scripts','load_admin_usuarios_plugin_scripts');
		wp_enqueue_style('plugin_styles',plugin_dir_url(__FILE__) . 'css/style.css');
		
		//CLASSES
		
		class MyUsersClass{
			
			const USER_IS_ACTIVE = 'user_active_or_no';
			const USER_PROFILE_PHOTO = 'user_profile_photo';
			const USER_FUNCTION = "user_function";
			const USER_BIRTHDAY = "user_birthday";
			const USER_GENDER = "user_gender";
			
			const USER_FACEBOOK = "user_facebook";
			const USER_GITHUB = "user_git_hub";
			const USER_BEHANCE = "user_behance";
			const USER_LINKEDIN = "user_linkedin";
			const USER_TWITTER = "user_twitter";

			const SLACK_URL_JSONP = 'url_slack_jsonp';
			
			function getIdade($user){
				if(empty($idade = get_user_meta($user->ID,MyUsersClass::USER_BIRTHDAY,true)))
					return 0;
				return (new DateTime($idade))->diff(new DateTime())->y;
			}
			
			function getUserProfilePhoto($user){
			    $avatar_url = get_avatar($user->ID);
			    return explode("'", explode("src", $avatar_url)[1])[1];
			}

			function getUsersNames($users_id){
				if(!is_array($users_id))
					$users_id = array($users_id);
				$users = (new WP_User_Query( array( "include" => $users_id) ))->get_results();
				$nomes = array( "names" => array(), "urls" => array());
				foreach($users as $user){
					array_push($nomes["names"], $user->data->display_name);
					array_push($nomes["urls"], get_author_posts_url($user->ID));
				}
				return $nomes;
			}

			function listaRedesSociais($user){
				if($user == false)
					return;
				if ( !empty(($fb_link = $user->get(MyUsersClass::USER_FACEBOOK))  )): ?>
            <li>
            	<a href="<?php echo $fb_link; ?>">
            		<i class="fa fa-facebook"></i>
          		</a>
        		</li>
				<?php endif;

				if ( !empty(($fb_link = $user->get(MyUsersClass::USER_TWITTER))  )): ?>
            <li>
            	<a href="<?php echo $fb_link; ?>">
            		<i class="fa fa-twitter"></i>
          		</a>
        		</li>
				<?php endif;

				if ( !empty(($fb_link = $user->get(MyUsersClass::USER_GITHUB))  )): ?>
            <li>
            	<a href="<?php echo $fb_link; ?>">
            		<i class="fa fa-github"></i>
          		</a>
        		</li>
				<?php endif;

				if ( !empty(($fb_link = $user->get(MyUsersClass::USER_LINKEDIN))  )): ?>
            <li>
            	<a href="<?php echo $fb_link; ?>">
            		<i class="fa fa-linkedin"></i>
          		</a>
        		</li>
				<?php endif;

				if ( !empty(($fb_link = $user->get(MyUsersClass::USER_BEHANCE))  )): ?>
            <li>
            	<a href="<?php echo $fb_link; ?>">
            		<i class="fa fa-behance"></i>
          		</a>
        		</li>
				<?php endif;
			}

			//My functions
			function listaUsuarios($users){
				$cont = 0;
				if(!is_array($users))
					return "Parametro deve ser um array";
				if(!empty($users))
					foreach($users as $user){
						if($user->ID == 1)
							continue;
						if($cont == 0) :
						?>
							<div class="row">
						<?php
							endif;
						?>

						<div class="col-lg-3 col-sm-3 team-box">


	            <div class="team-member">

								<a href="<?php echo get_author_posts_url($user->ID); ?>">
									<figure class="profile-pic">
										<div class="profile-pic-image" style="background-image: url('<?php echo MyUsersClass::getUserProfilePhoto($user); ?>')"></div>
									</figure>
								</a>
								<div class="member-details">
								<a href="<?php echo get_author_posts_url($user->ID); ?>">
									<h5 class="dark-text red-border-bottom"><?php echo $user->first_name . " " . $user->last_name;?></h5>
								</a>	
									<div class="position"><?php echo $user->get(MyUsersClass::USER_GENDER) == 1 ? str_replace(array("Desenvolvedor", "Coordenador"), array("Desenvolvedora","Coordenadora"), $user->get(MyUsersClass::USER_FUNCTION)) : $user->get(MyUsersClass::USER_FUNCTION); ?></div>

				                </div>


				                <div class="social-icons">


				                    <ul>


				                        <?php MyUsersClass::listaRedesSociais($user); ?>

				                        


				                    </ul>


				                </div>

		            </div>


				        </div>
						<!-- Formato de exibi&ccedil;&atilde;o dos usuários aqui -->
						<?php
						if($cont == 3) :
							$cont=0;
						?>
							</div>
						<?php
						else:
							$cont++;
						endif;
					}
				else
					echo "Sem resultados encontrados";
			}
			

			function listaUsuariosParaConfs($users){
				if(!(is_array($users) && is_array($users[0]) && !empty($users)))
					return "Sem resultados encontrados";
				foreach($users as $user){
					?>
					<div class="users_block users_selectable" userid="<?php echo ($user[0]->ID);?>" onclick="user_click_event(this)" selecionado="<?php echo $user[1];?>" style="background-image:url('<?php echo esc_url($user[0]->get(MyUsersClass::USER_PROFILE_PHOTO)); ?>')">
						<h3 class="users_title"><?php echo ($user[0]->first_name);?></h3>
					</div>
					<?php
				}
			}
			
			function consultaNomeUsuarios($ids){
				$users = array();
				$aux = self::consultaUsuarios($ids);
				$i = 0;
				foreach($aux as $user){
					$users[$i++] = array(
						'nome' => $user->first_name,
						'sobrenome' => $user->last_name
					);
				}
				return $users;
				// return $aux;
			}
			
			function consultaAvatarUsuario($id){
				$id += 0;
				if($id == 0){
					return false;
				}
				$q = (new WP_User_Query( array( 'include' => $id)))->results;
				if(count($q) != 1)
					return false;
				$url = esc_url(get_user_meta($id,self::USER_PROFILE_PHOTO,true));
				return $url == "" ? false : $url;
			}
			
			function consultaUsuarios($ids){
				if(!is_array($ids))
					$ids = array($ids + 0);
				return ( new WP_User_Query( array( 'include' => $ids ) ) )->results;
			}
			
			function slackMessage($id, $message, $icon = ":ghost:") {
				$permission = get_option( 'slack_notify', '' );
				$url = get_option(self::SLACK_URL_JSONP, '');
				if($permission == '' || $url == '')
					return false;
				$data = "payload=" . json_encode(array(                
                "text"          =>  utf8_encode($message),
                "icon_emoji"    =>  $icon
            ));
	
				$curl = curl_init(esc_url($url));
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($curl);
				curl_close($curl);
				return $result;
			}
			
		}
		
		function my_user_fields($user){
			$socialNetworks = array( "Facebook" => MyUsersClass::USER_FACEBOOK, "GitHub" => MyUsersClass::USER_GITHUB, "Behance" => MyUsersClass::USER_BEHANCE, "LinkedIn" => MyUsersClass::USER_LINKEDIN, "Twitter" => MyUsersClass::USER_TWITTER );
			?>
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Atualizar perfil">
			<br/>
			<br/>
			<br/>
			<br/>
			<h2>Informa&ccedil;&otilde;es Adicionais</h2>
			<?php
			if ( current_user_can( 'manage_options' ) ) :
			?>
			<p>
				<label for="<?php echo MyUsersClass::USER_IS_ACTIVE;?>">Ainda &eacute; funcion&aacute;rio:</label>
				<input type="checkbox" id="<?php echo MyUsersClass::USER_IS_ACTIVE;?>" name=<?php echo "'".MyUsersClass::USER_IS_ACTIVE."' ";
					if(get_user_meta($user->ID,MyUsersClass::USER_IS_ACTIVE,true) == "on")
						echo 'checked';
				?>>
			</p>
			<?php
			else :
			?>
				<input type="hidden" id="<?php echo MyUsersClass::USER_IS_ACTIVE;?>" name=<?php echo "'".MyUsersClass::USER_IS_ACTIVE."' ";?>
				value="<?php 
					echo get_user_meta($user->ID,MyUsersClass::USER_IS_ACTIVE,true);
					?>">
			<?php
			endif;
			?>
			<p>
				<label for="<?php echo MyUsersClass::USER_BIRTHDAY?>">Data de Nascimento:</label>
				<input name="<?php echo MyUsersClass::USER_BIRTHDAY; ?>" id="<?php echo MyUsersClass::USER_BIRTHDAY; ?>" class="widefat" type="date" size="36"  value="<?php echo get_user_meta($user->ID,MyUsersClass::USER_BIRTHDAY,true); ?>" />
			</p>		
			<p>
				<?php $genero = get_user_meta($user->ID,MyUsersClass::USER_GENDER,true); ?>
				<label for="<?php echo MyUsersClass::USER_GENDER;?>">Identidade de Genero:</label>
				<select required name="<?php echo MyUsersClass::USER_GENDER; ?>" id="<?php echo MyUsersClass::USER_GENDER; ?>" >
					<option value="1" <?php echo $genero == "1" ? "selected" : "" ?>>Mulher</option>
					<option value="2" <?php echo $genero == "2" ? "selected" : "" ?>>Homem</option>
				</select>
			</p>		
			<p>
				<?php 
					$cargo = get_user_meta($user->ID,MyUsersClass::USER_FUNCTION,true); 
					$cargos = array("Coordenador Geral", "Coordenador de Aplicativos e Sistemas", "Coordenador de Jogos",
						"Designer", "Desenvolvedor")
				?>
				<label for="<?php echo MyUsersClass::USER_FUNCTION;?>">Cargo do Usuario:</label>
				<select required name="<?php echo MyUsersClass::USER_FUNCTION; ?>" id="<?php echo MyUsersClass::USER_FUNCTION; ?>" class="widefat">
					<?php
						foreach($cargos as $c){
							?>
								<option value="<?php echo $c; ?>" <?php echo $cargo == $c ? "selected" : "" ?>><?php echo $c; ?></option>
							<?php
						}
					?>
				</select>
			</p>		
			<p>
				<label for="<?php echo MyUsersClass::USER_PROFILE_PHOTO;?>">Foto do Usuario:</label>
				<input readonly="readonly" name="<?php echo MyUsersClass::USER_PROFILE_PHOTO; ?>" id="<?php echo MyUsersClass::USER_PROFILE_PHOTO; ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url(get_user_meta($user->ID,MyUsersClass::USER_PROFILE_PHOTO,true)); ?>" /><br /><br />
				<img width='300' id="<?php echo MyUsersClass::USER_PROFILE_PHOTO;?>_image" <?php if(esc_url(get_user_meta($user->ID,MyUsersClass::USER_PROFILE_PHOTO,true)) == "") echo 'style="visibility:hidden"'?> src='<?php echo get_user_meta($user->ID,MyUsersClass::USER_PROFILE_PHOTO,true);?>' /><br />
				<input id="<?php echo MyUsersClass::USER_PROFILE_PHOTO;?>_button" name="<?php echo MyUsersClass::USER_PROFILE_PHOTO;?>" class="upload_image_button button button-primary" type="button" value="Escolher Imagem" />
			</p>
			<br /><br />
			<h3>Redes Sociais:</h3>
			<?php
				foreach($socialNetworks as $key => $socialNetwork){
					?>
					<p>
						<label for="<?php echo $socialNetwork; ?>"><?php echo $key;?></label>
						<input name="<?php echo $socialNetwork; ?>" id="<?php echo $socialNetwork; ?>" class="widefat" type="text" size="36"  value="<?php echo get_user_meta( $user->ID, $socialNetwork, true ); ?>" />
					</p>
					<?php
				}
		}
		
		function my_user_save($user_id){
			if(!current_user_can('edit_user',$user_id))
				return false;
			
			update_usermeta(absint($user_id),MyUsersClass::USER_PROFILE_PHOTO,esc_url($_POST[MyUsersClass::USER_PROFILE_PHOTO]));
			update_usermeta(absint($user_id),MyUsersClass::USER_IS_ACTIVE,wp_kses_post($_POST[MyUsersClass::USER_IS_ACTIVE]));
			update_usermeta(absint($user_id),MyUsersClass::USER_GENDER,wp_kses_post($_POST[MyUsersClass::USER_GENDER]));
			update_usermeta(absint($user_id),MyUsersClass::USER_FUNCTION,wp_kses_post($_POST[MyUsersClass::USER_FUNCTION]));
			update_usermeta(absint($user_id),MyUsersClass::USER_BIRTHDAY,wp_kses_post($_POST[MyUsersClass::USER_BIRTHDAY]));
			update_usermeta(absint($user_id),MyUsersClass::USER_FACEBOOK,wp_kses_post($_POST[MyUsersClass::USER_FACEBOOK]));
			update_usermeta(absint($user_id),MyUsersClass::USER_GITHUB,wp_kses_post($_POST[MyUsersClass::USER_GITHUB]));
			update_usermeta(absint($user_id),MyUsersClass::USER_BEHANCE,wp_kses_post($_POST[MyUsersClass::USER_BEHANCE]));
			update_usermeta(absint($user_id),MyUsersClass::USER_LINKEDIN,wp_kses_post($_POST[MyUsersClass::USER_LINKEDIN]));
			update_usermeta(absint($user_id),MyUsersClass::USER_TWITTER,wp_kses_post($_POST[MyUsersClass::USER_TWITTER]));
		}
		
		// ADICIONANDO CONFIGURAÇÕES
		
		
		class userDefaultSettings {
			
			// ADICIONANDO FILTER PARA QUANDO INICIAR A PÁGINA
			function __construct() {
				add_filter( 'admin_init' , array( $this , 'register_fields' ) );
			}
			
			// REGISTRANDO OS CAMPOS
			function register_fields() {
				// NOTIFICACAO DO SLACK
				register_setting( 'general', 'default_avatar', 'esc_attr' ); // CAMPO DA URL
				register_setting( 'general', 'default_avatar', 'esc_attr' ); // CAMPO DA PERMISSAO
				add_settings_field('default_avatar', '<label for="default_avatar">Avatar Geral: </label>' , array($this, 'fields_html') , 'general' );
			}
			
			// FUNCAO DOS CAMPOS
			function fields_html() {
				?>
				<input readonly="readonly" name="default_avatar" id="default_avatar" class="large-text" type="text" size="36"  value="<?php echo esc_url(get_option('default_avatar','')); ?>" /><br /><br />
				<input id="default_avatar_button" name="default_avatar_button" class="upload_image_button button button-primary" type="button" value="Escolher Imagem" />
				<?php
			}
			
		}
		new userDefaultSettings();


		class notifySettings {
			
			// ADICIONANDO FILTER PARA QUANDO INICIAR A PÁGINA
			function __construct() {
				add_filter( 'admin_init' , array( $this , 'register_fields' ) );
			}
			
			// REGISTRANDO OS CAMPOS
			function register_fields() {
				// NOTIFICACAO DO SLACK
				register_setting( 'general', MyUsersClass::SLACK_URL_JSONP, 'esc_attr' ); // CAMPO DA URL
				register_setting( 'general', 'slack_notify', 'esc_attr' ); // CAMPO DA PERMISSAO
				add_settings_field('slack', '<label for="slack_notify">Slack: </label>' , array($this, 'fields_html') , 'general' );
			}
			
			// FUNCAO DOS CAMPOS
			function fields_html() {
				//CAMPO DA URL
				$value = get_option(MyUsersClass::SLACK_URL_JSONP , '');
				echo "<input class='large-text' type='url' id='". MyUsersClass::SLACK_URL_JSONP ."' name='". MyUsersClass::SLACK_URL_JSONP ."' value='{$value}' />";
				echo '<p class="description" id="slack_notify_url-description">URL disponibilizada na configura&ccedil;&atilde;o da IncomingWebHook.</p>';
				
				echo "<br>";
				//CAMPO DA PERMISSAO
				$value = get_option( 'slack_notify', '' );
				$value = ($value == 'on' ? 'checked' : $value );
				
				echo "<input type='checkbox' id='slack_notify' name='slack_notify' {$value} />";
				echo '<label for="slack_notify">Enviar mensagens ao canal do Slack.</label>';
			}
			
		}
		new notifySettings();

		
		// MAXIMO DE USUARIOS NA PAGINA INICIAL
		
		class listagemDeUsuarios {
			
			// ADICIONANDO FILTER PARA QUANDO INICIAR A PÁGINA
			function __construct() {
				add_filter( 'admin_init' , array( $this , 'register_fields' ) );
			}
			
			// REGISTRANDO OS CAMPOS
			function register_fields() {
				// NOTIFICACAO DO SLACK
				register_setting( 'general', 'number_users', 'esc_attr' ); // CAMPO DA PERMISSAO
				add_settings_field('users', '<label for="number_users">Usu&aacute;rios: </label>' , array($this, 'fields_html') , 'general' );
			}
			
			// FUNCAO DOS CAMPOS
			function fields_html() {
				//CAMPO DA URL
				$value = get_option('number_users', '5');
				echo "<input class='small-text' type='number' id='number_users' name='number_users' value='{$value}' />";
				echo '<p class="description" id="number_users-description">Numero m&aacute;ximo de Usu&aacute;rios na P&aacute;gina Inicial.</p>';
			}
			
		}
		new listagemDeUsuarios();
		
		// ADICIONANDO SISTEMA DE FILTRAGEM DE IMAGEM DE USUARIO
		
		function get_avatar_personalizado( $avatar, $id_or_email, $size = 96 ) {
			// INSERÇÃO DE BUSCA DE IMAGENS DE USUARIOS PERSONALIZADAS
			$url = "";
			$name = "default";
			if(class_exists("MyUsersClass")){
				if(!(($consulta = MyUsersClass::consultaAvatarUsuario($id_or_email)) === false)){
					$url = $consulta;
					$args = MyUsersClass::consultaUsuarios($id_or_email)[0];
					$name = $args->data->display_name;
				}		
				else 
					$url = get_option("default_avatar", "");
			}
			else
				$url = get_option("default_avatar", "");
			
			if($url != ""){
				$avatar = sprintf(
					"<img alt='%s' src='%s' srcset='%s'  height='%d' width='%d' class='%s'/>",
					esc_attr( $name ),
					esc_url( $url ),
					esc_attr( "{$url} 2x" ),
					(int) $size,
					(int) $size,
					esc_attr('avatar avatar-64 photo')
				);
			}

			// FIM DA BUSCA DE USUARIOS
			
			return $avatar;
		}
		add_filter( 'get_avatar', 'get_avatar_personalizado', 10, 3 );



		function change_author_permalinks() {
		    global $wp_rewrite;
		    $wp_rewrite->author_base = get_option("author_base_url", "integrante");
		    $wp_rewrite->flush_rules();
		}
		add_action('init','change_author_permalinks');
		
		
?>