<? // O array com o id dos posts já está setado, e chama-se $psi_ealert_posts ?>
<html>

	<head>
		<title><? the_title(); ?></title>
		<style>
			* {
				margin: 0;
				padding: 0;
			}

			body {
				background: #f0f0f0;
			}

			.wrap {
				background: #fff;
				margin: 0 auto;
				width: 80%;
				padding: 15px;
			}

			h1 {
				padding: 10px 0 5px 10px;
				font-size: 24pt;
				border-bottom: 1px solid #000;
			}

			.content {
				margin: 30px 0 40px 0;
				line-height: 150%;
			}

			.posts {
				margin: 10px 0 0 0;	
			}

			.posts li {
				margin: 5px 0 0 25px;
			}
		</style>
	</head>

	<body>
		<div class='wrap'>
			<div class='title'>
				<h1><?the_title(); ?></h1>
			</div>
			<div class='content'>
				<? the_content(); ?>
			</div>
			<div class='posts'>
				<h2>Destaques da semana</h2>
				<ul>
					<? foreach($psi_ealert_posts as $id): ?>
						<? $post = get_post($id); ?>
						<li><a href="<?=get_permalink($id)?>"><?=$post->post_title?></a></li>
					<? endforeach ?>
				</ul>
			</div>
		</div>
	</body>
</html>