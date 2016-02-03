<html>
<head>
	<title>SIGPROG</title>
	<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.indigo-pink.min.css">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo asset_url();?>/css/materialize.css">
	<link rel="stylesheet" href="<?php echo asset_url();?>/css/sigprog.css">
	<script type="text/javascript" src="<?php echo asset_url();?>/js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>/js/jquery.timeago.min.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>/js/prism.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>/js/materialize.min.js"></script>
</head>

<body class="grey lighten-4">
	<div class="container">
		<div class="row">
			<h5 class="center-align">SIGPROG</h5>
			<h4 class="center-align">Sistema de Gestão de Progressão Docente</h4>
		</div>
		<div class="row">
			<div class="col s4 offset-s4 white">
				<ul class="tabs">
					<li class="tab col s2"><a class="<?php echo $login_tab; ?>" href="#login-panel">Login</a>
					<li class="tab col s2"><a class="<?php echo $register_tab; ?>" href="#register-panel">Cadastro</a>
				</ul>

				<div id="login-panel">
					<?php echo form_open("login/verifyLogin"); ?>
					<div class="input-field col s12">
						<input id="siape" name="siapel" type="text" class="validate" maxlength="8">
          				<label for="siape">SIAPE</label>
          				<?php echo form_error('siapel', '<div class="error-form">', '</div>'); ?>
					</div>
					<div class="input-field col s12">
						<input id="senha" name="senhal" type="password" class="validate">
          				<label for="senha">Senha</label>
          				<?php echo form_error('senhal', '<div class="error-form">', '</div>'); ?>
					</div>
					<div class="col s12">
						<button class="btn waves-effect waves-light" style="width: 100%" type="submit" name="action">Login
							<i class="material-icons right">send</i>
				  		</button>
				  	</div>
					<?php echo form_close(); ?>
				</div>

				<div id="register-panel">
					<?php echo form_open("login/register"); ?>
					<div class="input-field col s12">
						<input id="siape" name="siape" type="text" class="validate <?php if (form_error('siape')) echo 'invalid'; ?>" maxlength="8">
          				<label for="siape">SIAPE</label>
          				<?php echo form_error('siape', '<div class="error-form">', '</div>'); ?>
					</div>
					<div class="input-field col s12">
						<input id="nome" name="nome" type="text" class="validate">
          				<label for="nome">Nome</label>
          				<?php echo form_error('nome', '<div class="error-form">', '</div>'); ?>
					</div>
					<div class="input-field col s12">
						<input id="email" name="email" type="text" class="validate">
          				<label for="email">E-mail</label>
          				<?php echo form_error('email', '<div class="error-form">', '</div>'); ?>
					</div>
					<div class="input-field col s12">
						<input id="senha" name="senha" type="password" class="validate">
          				<label for="senha">Senha</label>
					</div>
					<div class="input-field col s12">
						<input id="confirmasenha" name="confirmasenha" type="password" class="validate">
          				<label for="confirmasenha">Confirmação de senha</label>
          				<?php echo form_error('senha', '<div class="error-form">', '</div>'); ?>
					</div>
					<div class="col s12">
						<button class="btn waves-effect waves-light" style="width: 100%" type="submit" name="action">Cadastrar
							<i class="material-icons right">send</i>
				  		</button>
				  	</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>