<?php
  /*
    Plugin Name: LTIA - Message Plugin
    Description: Plugin necess&aacute;rio para funcionamento do sistema de mensagens do contato
    Version: 1.0
    Author: LTIA - Laboratório de Tecnologia da Informação Aplicada
  */
  include 'config.php';


  abstract class MessagePlugin{

    private $name, $email, $subject, $content;
    private $template;
    private $messageStatus;

    // PRIVATE METHODS

    private function buildMessage(){
      return str_replace(
        array('{{name}}', '{{email}}', '{{subject}}', '{{content}}'),
        array($this->name, $this->email, $this->subject, $this->content),
        $this->template
      );
    }

    private function getSlug(){ // Subject slug + data
      return str_replace(" ", "-", $this->subject) . "-" . date("j-n-y--H-i-s");
    }

    // PUBLIC METHODS

    public function sendMessage(){
      $postid = -1;
      $postid = array(
      	'comment_status'	=>	'closed',
      	'ping_status'		  =>	'closed',
        'post_author'		  =>	1,                  // ADMIN ID
      	'post_name'		    =>	$this->getSlug(),
      	'post_title'	  	=>	$this->subject,
        'post_content'    =>  $this->content,
      	'post_status'	  	=>	'publish',
      	'post_type'		    =>	'message'
      );

      return ($this->messageStatus = $postid != -1);
    }

  }

  class LTIAMessage extends MessagePlugin{
    function __construct($name = '', $email = '', $subject = '', $content = '', $template = ''){
      $this->name    = $nome;
      $this->email   = $email;
      $this->subject = $subject;
      $this->content = $content;

      if($template == '')
        $template = file_get_contents('ltia_message_template.tpl');

      $this->messageStatus = false;
    }
  }

?>
