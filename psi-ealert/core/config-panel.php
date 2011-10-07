<?

$config = get_option('ealert-config');

if(isset($_POST['controller']) && $_POST['controller'] == 'send') {

	$config = array(
		'qtd-post' => $_POST['ealert-qtd-post'],
		'template' => $_POST['ealert-template'],
		'smtp' => array(
			'host' => $_POST['ealert-smtp-host'],
			'user' => $_POST['ealert-smtp-user'],
			'pass' => $_POST['ealert-smtp-pass'],
		),
	);
	update_option('ealert-config', $config);
}

if($config == "") {
	$config = array(
		'qtd-post' => 20,
		'template' => 'default',
		'smtp' => array(
			'host' => 'smtp.example.com',
			'user' => 'username@example.com',
			'pass' => '123',
		),
	);
}

// pega o endereço do diretório
$diretorio = TEMPLATES; 
// abre o diretório
$ponteiro  = opendir($diretorio);

$templates = array();
// monta os vetores com os itens encontrados na pasta
while ($files = readdir($ponteiro)) {
    $file = explode('.', $files);
	if($file[count($file)-1] == "php") {
		$templates[] = str_replace(".php", "", $files);
	}
}

?>
<div class='wrap'>
	<div id="icon-options-general" class="icon32"><br></div>
	<h2>Configurações de e-Alert</h2>
	<form method="post" action="<?=$_SERVER['REQUEST_URI']?>">
		<input type='hidden' name='controller' value='send' />
		<table class="form-table">
			<thead>
			</thead>
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="ealert-qtd-post">Quantidade de posts</label>
					</th>
					<td>
						<input name="ealert-qtd-post" type="text" id="ealert-qtd-post" value="<?=$config['qtd-post']?>" class="small-text">
						(quantidade de posts carregado no formulário de e-Alert)
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ealert-theme">Tema do e-Alert</label>
					</th>
					<td>
						<select name='ealert-template'>
							<option></option>
							<? foreach($templates as $template): ?>
								<? if($config['template'] == $template): ?>
									<option value='<?=$template?>' selected><?=$template?></option>
								<? else: ?>
									<option value='<?=$template?>'><?=$template?></option>
								<? endif ?>
							<? endforeach ?>
						<select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ealert-smtp-host">Hostname do SMTP</label>
					</th>
					<td>
						<input name="ealert-smtp-host" type="text" id="ealert-smtp-host" value="<?=$config['smtp']['host']?>" class="text">						
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ealert-smtp-user">Usuário de acesso do SMTP</label>
					</th>
					<td>
						<input name="ealert-smtp-user" type="text" id="ealert-smtp-user" value="<?=$config['smtp']['user']?>" class="text">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="ealert-smtp-pass">Senha do SMTP</label>
					</th>
					<td>
						<input name="ealert-smtp-pass" type="password" id="ealert-smtp-pass" value="<?=$config['smtp']['pass']?>" class="text">				
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Salvar Alterações"></p>
	</form>
</div>