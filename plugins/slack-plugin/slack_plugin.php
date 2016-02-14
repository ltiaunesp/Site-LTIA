<?php
  /*
    Plugin Name: LTIA - Slack Plugin
    Description: Plugin necess&aacute;rio para o sistema de envio de notificações do slack
    Version: 1.0
    Author: LTIA - Laboratório de Tecnologia da Informação Aplicada
  */
  include 'config.php';

  function sendSlackMessage($id, $message, $icon = ":ghost:") {
		$permission = get_option( 'SLACK_PERMISSION', '' );
		$url = get_option(SLACK_URL_JSONP, '');
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
		$result = !!curl_exec($curl);
		curl_close($curl);
		return result;
	}


?>
