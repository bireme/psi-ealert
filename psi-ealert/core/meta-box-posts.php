<?php

$posts = get_posts("posts_per_page=50");

?>

<style>
	.ealert-posts table {
		width: 100%;
		border: 1px solid #000;
	}

	.ealert-posts table .header {
		font-weight: bold;
	}
	.ealert-posts .button-bar {
		margin: 10px;
	}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

<div class='ealert-posts' id='ealert-posts'>
	<div class='button-bar'>
		<select id='order_by'>
			<option value=''>- Ordenar por -</option>
			<option value='desc'>Mais novo</option>
			<option value='asc'>Mais Velho</option>
		</select>
	</div>
	<form name='ealert-posts' method='POST' action="">
		<table>
			<tr class='header'>
				<td>Selecionar</td>
				<td>Post</td>
				<td>Data</td>
			</tr>
			<tbody>
				<?php if(count($posts) > 0): ?>
					<?php foreach($posts as $post): ?>
						<tr>
							<td><input type="checkbox" name="post-check[]" /></td>
							<td><?=$post->post_title?></td>
							<td><?=$post->post_date?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</form>
</div>