<?php

/*
Plugin Name: Psi e-Alert
Plugin URI: https://github.com/bireme/psi-ealert
Description: Plugin Wordpress that makes a newsletter's system that sends emails with checked posts.
Version: 0.1
Author: BIREME/PAHO/WHO
Author URI: https://github.com/bireme
*/

define('TEMPLATES', dirname(__FILE__) . "/templates");
define('CORE', dirname(__FILE__) . "/core");

// arquivo que recebe as requisições ajax
define('REQUESTS_FILE', WP_PLUGIN_URL . '/psi-ealert/core/meta-box-posts-ajax.php');

// cria o post-type
function type_post_ealert() {
	$labels = array(
			'name' => _x('e-Alerts', 'post type general name'),
		    'singular_name' => _x('e-Alert', 'post type singular name'),
		    'add_new' => _x('Adicionar Novo', 'Novo item'),
		    'add_new_item' => __('Nova e-Alert'),
		    'edit_item' => __('Editar e-Alert'),
		    'new_item' => __('Novo e-Alert'),
		    'view_item' => __('Ver e-Alert'),
		    'search_items' => __('Procurar e-Alerts'),
		    'not_found' =>  __('Nenhum registro encontrado'),
		    'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
		    'parent_item_colon' => '',
		    'menu_name' => 'e-Alert'	
		);

	$args = array(
        'labels' => $labels,
        'public' => true,
        'public_queryable' => true,
        'show_ui' => true,          
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 25,
		'register_meta_box_cb' => 'posts_meta_box',      
        'supports' => array('title','editor', 'revisions')
      );
 
	register_post_type( 'ealert' , $args );
	flush_rewrite_rules();
}
// ativa o post type
add_action('init', 'type_post_ealert');

// cria um metabox chamado 'posts'
// Este metabox é responsável por selecionar os posts que irão no corpo do e-alert
function posts_meta_box(){        
	add_meta_box('meta_box_posts', __('Posts'), 'meta_box_posts', 'ealert', 'normal', 'high');
}

// conteúdo dentro do metabox
function meta_box_posts(){
	require_once(CORE . "/meta-box-posts.php");
}


// cria a funcao que salva o metabox junto com o post-type
function save_ealert_post(){
    global $post;        
    update_post_meta($post->ID, 'valor_meta', $_POST['valor_meta']);
}
// ativa o salvar
add_action('save_post', 'save_ealert_post');

?>