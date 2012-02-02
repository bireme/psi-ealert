<?php

if (have_posts()) {
	the_post();

	$psi_ealert_posts = get_post_meta(get_the_ID(), 'psi-ealert-posts'); 
	$psi_ealert_posts = $psi_ealert_posts[0];
	if($psi_ealert_posts == "") $psi_ealert_posts = array();

	$psi_ealert_template = get_post_meta(get_the_ID(), 'psi-ealert-template'); 
	$psi_ealert_template = $psi_ealert_template[0];

	$template_file = TEMPLATES . '/' . $psi_ealert_template . '.php';
	if(file_exists($template_file)) {
		
		require_once($template_file);
	} else {
		
		require_once(TEMPLATES . '/default.php');
	}

} else {

	global $wp_query;
	$wp_query->is_404 = true;
	die;

}

?>