<html>
	<body>
		<div class='wrap'>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class='title'>
					<?the_title(); ?>
				</div>
				<div class='content'>
					<? the_content(); ?>
				</div>
				<div class='posts'>
					<?php
						$meta = get_post_meta(get_the_ID(), 'psi-ealert-posts'); 
						$meta = $meta[0];
					?>			
					<table>
						<? foreach($meta as $id): ?>
							<? $post = get_post($id); ?>
							<tr>
								<a href="<?=get_permalink($id)?>">
									<?=$post->post_title?>
								</a>
							</tr>
						<? endforeach ?>
					</table>
				</div>
			<?endwhile?>
		</div>
	</body>
</html>