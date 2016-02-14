<?php
  const SLACK_URL_JSONP = 'url_slack_jsonp';
  const SLACK_PERMISSION = 'SLACK_PERMISSION';

  class notifySettings {

    // ADICIONANDO FILTER PARA QUANDO INICIAR A P�GINA
    function __construct() {
      add_filter( 'admin_init' , array( $this , 'register_fields' ) );
    }

    // REGISTRANDO OS CAMPOS
    function register_fields() {
      // NOTIFICACAO DO SLACK
      register_setting( 'general', SLACK_URL_JSONP, 'esc_attr' ); // CAMPO DA URL
      register_setting( 'general', 'SLACK_PERMISSION', 'esc_attr' ); // CAMPO DA PERMISSAO
      add_settings_field('slack', '<label for="SLACK_PERMISSION">Slack: </label>' , array($this, 'fields_html') , 'general' );
    }

    // FUNCAO DOS CAMPOS
    function fields_html() {
      //CAMPO DA URL
      $value = get_option(SLACK_URL_JSONP , '');
      echo "<input class='large-text' type='url' id='". SLACK_URL_JSONP ."' name='". SLACK_URL_JSONP ."' value='{$value}' />";
      echo '<p class="description" id="SLACK_PERMISSION_url-description">URL disponibilizada na configura&ccedil;&atilde;o da IncomingWebHook.</p>';

      echo "<br>";
      //CAMPO DA PERMISSAO
      $value = get_option( 'SLACK_PERMISSION', '' );
      $value = ($value == 'on' ? 'checked' : $value );

      echo "<input type='checkbox' id='SLACK_PERMISSION' name='SLACK_PERMISSION' {$value} />";
      echo '<label for="SLACK_PERMISSION">Enviar mensagens ao canal do Slack.</label>';
    }

  }
  new notifySettings();

?>
