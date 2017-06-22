<?php 
	session_start(); 
	if(!isset($_SESSION['user_permission']))
		header("location:/anubis");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ralifla</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="css/lib/font-awesome.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/color.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/toastr.min.css"></link>
	
	<link rel="stylesheet" type="text/css" href="css/topo.css"></link>
	<link rel="stylesheet" type="text/css" href="css/geral.css"></link>
	
	<script type="text/javascript" src="js/lib/jquery.min.js"></script>
	<script type="text/javascript" src="js/lib/toastr.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/geral.js"></script>
</head>
<body>
<header id="container-topo" class="col-xs-12 bg-dark">
	<section class="col-md-3 col-xs-6">
		<div class="content-logo">
			<a href="dashboard.php"><img src="img/ralifla.png"></a>
		</div>
	</section>
	<section id="container-user-menu" class="col-xs-12">
		<div class="notification-content">
			<div id="notification" class="btn-group bg-red-ralifla">
				<i class="fa fa-bell-o" aria-hidden="true"></i>
				<span class="badge">0</span>
			</div>
		</div>
		<div class="user-content pull-right">
			<button id="user-info" class="reset-button">
				<span class="font-blue-madison">Olá, <?php echo $_SESSION['user_name']?></span>
				<img src="<?php echo $_SESSION['user_img_url']?>">
			</button>
			<div class="btn-group bg-green-haze" id="logout"><i class="fa fa-sign-out font-white" aria-hidden="true"></i></div>
		</div>
	</section>
	<section id="container-search" class="col-xs-12">
		<div class="content-search">
			<form action="inc/controle/VendedorAtendimento.php?acao=listar" method="POST">
				<div class="search-content">
					<input type="text" class="search-box bg-dark col-xs-12" name="key">
					<button type="submit" id="search" class="reset-button"><i class="fa fa-search" aria-hidden="true"></i></button>
				</div>
			</form>
			<i id="open-search" class="fa fa-search" aria-hidden="true"></i>
		</div>
	</section>
</header>
<div id="menu" class="col-md-3 col-lg-2">
	<nav class="page-sidebar">
		<ul id="container-menu"></ul>
	</nav>
</div>