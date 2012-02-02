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
$posts = get_posts("numberposts=" . $config['qtd-post']);

?>

<script type="text/javascript">
	$ = jQuery.noConflict();
	$(document).ready(function(){
		$('#id_search').quicksearch('table tbody tr');
	});
</script>

<style>
	.ealert-posts { height: 300px; overflow: auto; }

	thead tr {
		font-weight: bold;
		font-size: 110%;
		text-align: center;
		padding: 10px;
		background: #efefef;
	}

	#id_search {
		width: 100%;
		margin: 1px 0 10px 0;
	}
</style>
Buscar posts: 
<input type="text" name="" id="id_search" value="">

<div class='ealert-posts'>	
	<form name='ealert-posts' method='POST' action="" >	
		<input type='hidden' name='controller' value='send' />
		<table id="posts">
			<thead>
				<tr>
					<td width="10%"></td>
					<td width="60%">Post</td>
					<td width="30%">Data</td>
				</tr>
			</thead>
			<tbody>
				<?php if(count($posts) > 0): ?>
					<?php foreach($posts as $unique): ?>
						<tr>
							<? if(in_array($unique->ID, $posts_in_ealert)): ?>
								<td width="10%"><input type="checkbox" name="psi-ealert-posts[]" value="<?=$unique->ID?>" checked="checked"/></td>
							<? else: ?>
								<td width="10%"><input type="checkbox" name="psi-ealert-posts[]" value="<?=$unique->ID?>" /></td>
							<? endif ?>
							<td width="60%"><?=$unique->post_title?></td>
							<? $date = $unique->post_date; ?>
							<? //$date = split(" ", $date); $date = $date[0]; ?>
							<td width="30%" style="text-align: center"><?=$date?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</form>
</div>