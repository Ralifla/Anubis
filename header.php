<!DOCTYPE html>
<html>
<head>
	<title>Ralifla</title>
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
	<section class="col-md-3 col-xs-12">
		<div class="content-img col-md-6"><img src="img/ralifla.png"></div>
	</section>
	<section class="col-md-6 col-xs-12">
		<div class="content-img col-md-6">
			<form action="inc/controle/atendimento.php?acao=logar" method="POST">
				<div class="search-content">
					<input type="text" name="key" placeholder="Digite o nome ou o CPF">
					<button type="submit" id="search"></button>
				</div>
			</form>
		</div>
	</section>
	<section class="col-md-3 col-xs-12">
	
	</section>
</header>