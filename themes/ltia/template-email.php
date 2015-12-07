<?php
/*
Template Name: Teste de email
*/
the_post();
mail("vinifig@hotmail.com", get_the_title(), get_the_content());

?>