<html>
<head>
	<title>SIGPROG</title>
	<link href="<?php echo asset_url();?>/css/icons.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo asset_url();?>/css/materialize.css">
	<link rel="stylesheet" href="<?php echo asset_url();?>/css/sigprog.css">
	<script type="text/javascript" src="<?php echo asset_url();?>/js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>/js/materialize.min.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>/js/sigprog.js"></script>
</head>

<body>
	<header>
				<ul class="side-nav fixed " id="slide-out">
<?php foreach ($itensMenu as $item) {?>
					<li><a href="<?php echo base_url().'index.php/admin/'.$item['url']; ?>">
						<p class="truncate"><?php echo $item['nome']; ?></p>
					</a></li>
<?php } ?>
					<li><a href="<?php echo base_url().'index.php/usuario'; ?>">Sair</a></li>
				</ul>
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
	</header>
