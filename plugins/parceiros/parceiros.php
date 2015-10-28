<?php
	/*
	Plugin Name: Parceiros
	Description: Plugin necess&aacute;rio para funcionamento do sistema de parceiros
	Version: 1.0
	Author: LTIA*/


	/* WIDGET */
	class Parceiros_Widget extends WP_Widget
	{


	    function __construct()
	    {

	        $widget_ops = array('classname' => 'Parceiros_Widget');
	        $this->WP_Widget('parceiros-widget', 'Parceiros', $widget_ops);
	        // $this->WP_Widget('zerif_clients-widget', 'Zerif - Clients widget', $widget_ops);


	    }


	    function widget($args, $instance)
	    {

	        extract($args);


	        echo $before_widget;

	        ?>

	        <a href="<?php if( !empty($instance['link']) ): echo apply_filters('widget_title', $instance['link']); endif; ?>"><img class="parceiroImg"
	                src="<?php if( !empty($instance['image_uri']) ): echo esc_url($instance['image_uri']); endif; ?>" alt="<?php echo !empty(@$instance['titulo']) ? $instance['titulo'] : '' ; ?>"></a>



	        <?php

	        echo $after_widget;


	    }


	    function update($new_instance, $old_instance)
	    {

	        $instance = $old_instance;

	        $instance['link'] = strip_tags($new_instance['link']);

	        $instance['titulo'] = strip_tags($new_instance['titulo']);

	        $instance['image_uri'] = strip_tags($new_instance['image_uri']);

	        return $instance;

	    }


	    function form($instance)
	    {

	        ?>


	        <p>
	        	<label for="<?php echo $this->get_field_id("titulo"); ?>">T&iacute;tulo:</label><br/>

	            <input type="text" name="<?php echo $this->get_field_name('titulo'); ?>"
	                   id="<?php echo $this->get_field_id('titulo'); ?>" value="<?php if( !empty($instance['titulo']) ): echo $instance['titulo']; endif; ?>" class="widefat"/>
	        </p>

	        <p>

	            <label for="<?php echo $this->get_field_id('link'); ?>">URL</label><br/>



	            
	            <input type="text" name="<?php echo $this->get_field_name('link'); ?>"
	                   id="<?php echo $this->get_field_id('link'); ?>" value="<?php if( !empty($instance['link']) ): echo $instance['link']; endif; ?>"
	                   class="widefat"/>

	        </p>


	        <p>

	            <label for="<?php echo $this->get_field_id('image_uri'); ?>">Imagem</label><br/>



	            <?php

	            if ( !empty($instance['image_uri']) ) :

	                echo '<img class="custom_media_image_clients" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';

	            endif;

	            ?>



	            <input type="text" class="widefat custom_media_url_clients"
	                   name="<?php echo $this->get_field_name('image_uri'); ?>"
	                   id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>"
	                   style="margin-top:5px;">



	            <input type="button" class="button button-primary custom_media_button upload_image_button" id="<?php echo $this->get_field_id('image_uri'); ?>_button"
	                   name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php _e('Upload Image','zerif-lite'); ?>"
	                   style="margin-top:5px;"/>
	            <script id="removerScript" language=javascript>
	                jQuery("#<?php echo $this->get_field_id('image_uri'); ?>").click(galleryMedia(jQuery.noConflict()));
	                document.querySelector("#removerScript").remove();
	            </script>


	        </p>



	    <?php

	    }

	}


	class Parceiros{
		function init(){
			register_sidebar(array(
				'id' => 'parceiros_sidebar',
				'name' => 'Seção de Parceiros',
				'description' => 'Sidebar da seção de parceiros, abaixo dos projetos'
				));
			register_widget("Parceiros_Widget");
		}
	}

	add_action('widgets_init', "Parceiros::init");
?>