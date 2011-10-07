<?php 

global $post;

// pega os posts desse elaert
$posts_in_ealert = get_post_meta($post->ID, "psi-ealert-posts");
$posts_in_ealert = $posts_in_ealert[0];

// caso seja um new post, ele seta vazio para não quebrar a tabela de posts
if($posts_in_ealert == "") {
	$posts_in_ealert = array();
}

// chama os ultimos 50 posts
$config = get_option('ealert-config');
$posts = get_posts("posts_per_page=" . $config['qtd-post']);

?>

<style>
	.ealert-posts { height: 300px; overflow: auto;  }
</style>

<div class='ealert-posts'>
	<form name='ealert-posts' method='POST' action="" >
		<input type='hidden' name='controller' value='send' />
		<table id="posts">
			<thead>
				<tr>
					<td></td>
					<td>Post</td>
					<td>Data</td>
				</tr>
			</thead>
			<tbody>
				<?php if(count($posts) > 0): ?>
					<?php foreach($posts as $unique): ?>
						<tr>
							<? if(in_array($unique->ID, $posts_in_ealert)): ?>
								<td><input type="checkbox" name="psi-ealert-posts[]" value="<?=$unique->ID?>" checked="checked"/></td>
							<? else: ?>
								<td><input type="checkbox" name="psi-ealert-posts[]" value="<?=$unique->ID?>" /></td>
							<? endif ?>
							<td><?=$unique->post_title?></td>
							<td><?=$unique->post_date?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</form>
</div>