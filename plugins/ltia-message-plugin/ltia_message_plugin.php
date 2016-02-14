<?php
  /*
    Plugin Name: LTIA - Message Plugin
    Description: Plugin necess&aacute;rio para funcionamento do sistema de mensagens do contato
    Version: 1.0
    Author: LTIA - Laboratório de Tecnologia da Informação Aplicada
  */
  include 'config.php';


  class LTIAMessage{

    // PRIVATE PROPERTIES

    private $name, $email, $subject, $content;
    private $template;
    private $messageStatus;

    // PUBLIC PROPERTIES

    public $post_id;

    // CONSTRUTOR
    function __construct($name = '', $email = '', $subject = '', $content = '', $template = ''){
      $this->name    = $name;
      $this->email   = $email;
      $this->subject = $subject;
      $this->content = $content;

      if($template == '')
        $template = "{{name}} <{{email}}> enviou uma mensagem com o assunto \"{{subject}}\".\n\n{{content}}";

      $this->template = $template;

      $this->messageStatus = false;
      $this->post_id = -1;
    }

    // PRIVATE METHODS

    private function buildTitle(){
      return $this->subject . " - " . $this->name;
    }

    private function buildSlug(){ // Subject slug + data
      return str_replace(" ", "-", $this->subject) . "-" . date("j-n-y--H-i-s");
    }

    private function buildMessage(){
      return str_replace(
        array('{{name}}', '{{email}}', '{{subject}}', '{{content}}'),
        array($this->name, $this->email, $this->subject, $this->content),
        $this->template
      );
    }

    private function slackNotification($slug){
      if(function_exists('sendSlackMessage'))
        sendSlackMessage("Nova mensagem de: " . $this->name .
                        "\nAssunto: " . $this->subject .
                        "\nVer: " . get_site_url() . "?message=" . $slug);
    }

    // PUBLIC METHODS

    public function sendMessage(){
      $slug = $this->buildSlug();
      $this->post_id = wp_insert_post(array(
      	'comment_status'	=>	'closed',
      	'ping_status'		  =>	'closed',
        'post_author'		  =>	1,                  // ADMIN ID
      	'post_name'		    =>	$slug,
      	'post_title'	  	=>	$this->buildTitle(),
        'post_content'    =>  $this->buildMessage(),
      	'post_status'	  	=>	'publish',
      	'post_type'		    =>	'message'
      ));
      $this->messageStatus =  ($this->post_id != -1);
      $this->slackNotification($slug);
      return $this->messageStatus;
    }

    // GET SET

    public function getStatus(){
      return $this->messageStatus;
    }

    // ...


  }

?>
