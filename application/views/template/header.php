<html>
<head>
	<title>SIGPROG</title>
	<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.indigo-pink.min.css">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo asset_url();?>/css/materialize.css">
	<link rel="stylesheet" href="<?php echo asset_url();?>/css/sigprog.css">
	<script type="text/javascript" src="<?php echo asset_url();?>/js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>/js/materialize.min.js"></script>
</head>

<body>
	<aside>
		<ul class="side-nav fixed leftside-navigation ps-container ps-active-y" style="width: 240px">
			<li class="professor-details center-align li-no-hover" style="padding-bottom: 0">
				<div class="row">
					<div class="col s8 offset-s2">
						<img src="<?php echo profile_foto_url().'/'.$professor['foto']; ?>" alt="" class="circle responsive-img profile-picture">
					</div>
					<div class="col s2"></div>
					<div class="col s12">
						<a href=""><?php echo $professor['nome']; ?></a>
					</div>
					<div class="col s12">
						<span>Nível Atual</span>
					</div>
				</div>
				<div>
					
				</div>
				<hr style="margin: 0">
			</li>

			<li>Minhas Atividades</li>
			<li>Minhas Progressões</li>
			<li><a href="<?php echo base_url(); ?>/index.php/usuario/logout">Logout</a></li>
<?php if ($admin) {?>
			<li><a href="admin">Administrador</a></li>
<?php } ?>

		</ul>
	</aside>
</body>