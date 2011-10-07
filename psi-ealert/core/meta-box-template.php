<?php

$config = get_option($config);
$template_config = $config['template'];

global $post;

// pega os posts desse elaert
$template_in_ealert = get_post_meta($post->ID, "psi-ealert-template");
$template_in_ealert = $template_in_ealert[0];

$templates = array();
$handle = opendir(TEMPLATES);
while($file = readdir($handle)) {
	$explode = explode(".",$file);
	if($explode[count($explode)-1] == "php") {
		$templates[] = str_replace(".php", "", $file);
	}
}

?>

<select name='psi-ealert-template'>
	<? foreach($templates as $item): ?>
		<? if($template_in_ealert == $item): ?>
			<option value="<?=$item?>" selected="selected"><?=$item?></option>
		<?else:?>
			<option value="<?=$item?>"><?=$item?></option>
		<?endif?>
	<? endforeach ?>
</select>