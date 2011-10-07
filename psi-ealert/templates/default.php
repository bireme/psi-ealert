<? // O array com o id dos posts já está setado, e chama-se $psi_ealert_posts ?>
<html>
	<body>
		<div class='wrap'>
			<div class='title'>
				<?the_title(); ?>
			</div>
			<div class='content'>
				<? the_content(); ?>
			</div>
			<div class='posts'>
				<table>
					<? foreach($psi_ealert_posts as $id): ?>
						<? $post = get_post($id); ?>
						<tr>
							<td>
								<a href="<?=get_permalink($id)?>">
									<?=$post->post_title?>
								</a>
							<td>
						</tr>
					<? endforeach ?>
				</table>
			</div>
		</div>
	</body>
</html>