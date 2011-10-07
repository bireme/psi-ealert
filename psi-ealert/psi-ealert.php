<?php

/*
Plugin Name: Psi e-Alert
Plugin URI: https://github.com/bireme/psi-ealert
Description: Plugin Wordpress that makes a newsletter's system that sends emails with checked posts.
Version: 0.1
Author: BIREME/PAHO/WHO
Author URI: https://github.com/bireme
*/

define('PLUGIN_DIRNAME', 'psi-ealert');
define('PLUGIN_SLUG', 'ealert');

define('PLUGIN_URL', WP_PLUGIN_URL . '/' . PLUGIN_DIRNAME);

define('TEMPLATES', dirname(__FILE__) . "/templates");
define('CORE', dirname(__FILE__) . "/core");
define('JS', PLUGIN_URL . "/js");

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
 
	register_post_type( PLUGIN_SLUG , $args );
	flush_rewrite_rules();
}
// ativa o post type
add_action('init', 'type_post_ealert');

function posts_meta_box(){        
	add_meta_box('meta_box_posts', __('Posts'), 'meta_box_posts', 'ealert', 'normal', 'high');
	add_meta_box('meta_box_template', 'Template', 'meta_box_template', 'ealert', 'side', 'high');
}

// cria um metabox chamado 'posts'
// Este metabox é responsável por selecionar os posts que irão no corpo do e-alert
function meta_box_posts(){
	require_once(CORE . "/meta-box-posts.php");
}

// cria um metabox chamado 'template'
// Metabox responsável por definir o template atual
function meta_box_template(){
	require_once(CORE . "/meta-box-template.php");
}

// cria a funcao que salva os metaboxes junto com o post-type
function save_ealert_post(){
    global $post;        
    update_post_meta($post->ID, 'psi-ealert-posts', $_POST['psi-ealert-posts']);
    update_post_meta($post->ID, 'psi-ealert-template', $_POST['psi-ealert-template']);
}
// ativa o salvar
add_action('save_post', 'save_ealert_post');


// função que chama a criação do menu de configurações
function ealert_menu() {
	add_options_page('Configurações de e-Alert', 'e-Alert', 'manage_options', 'ealert-config', 'ealert_options');
}

// função que chama a página de config
function ealert_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('Você não tem permissões suficientes para acessar esta página.') );
	}
	require_once(CORE . "/config-panel.php");
}

// ativando page
add_action('admin_menu', 'ealert_menu');

// adicionando options de config
add_option('ealert-config', '', '', 'yes');

// adicionando nosso próprio tema para ealert-type
add_action("template_redirect", 'ealert_redirect');

function ealert_redirect() {
	global $wp;
	if ($wp->query_vars["post_type"] == 'ealert') {
		$templatefilename = 'single-ealert.php';
		if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
		    $return_template = TEMPLATEPATH . '/' . $templatefilename;
		} else {
		    $return_template = CORE . '/' . $templatefilename;
		}
		do_theme_redirect($return_template);
	}
}

function do_theme_redirect($url) {
    global $post, $wp_query;
    if (have_posts()) {
        include($url);
        die();
    } else {
        $wp_query->is_404 = true;
    }
}

?>