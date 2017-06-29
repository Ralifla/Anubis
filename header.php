<?php 
	session_start(); 
	if(!isset($_SESSION['user_permission']))
		header("location:/anubis");
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ralifla</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="css/lib/font-awesome.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/color.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/toastr.min.css"></link>
	
	<link rel="stylesheet" type="text/css" href="css/topo.css"></link>
	<link rel="stylesheet" type="text/css" href="css/geral.css"></link>
	<link rel="stylesheet" type="text/css" href="css/ring.css"></link>
	
	<script type="text/javascript" src="js/lib/jquery.min.js"></script>
	<script>
	// var para cecar permissao
	var perm = <?php echo $_SESSION['user_permission'].";\n"?>
	var page = document.URL;
	page = page.split(/anubis\/|&/gi);
	var id = page[1].search("id");
	page = id != -1 ? page[1].substr(0,page[1].search("id")-1) : page[1];
	
	// controla permissão de acesso as telas e exibe menssagens pendentes na sessão
	$.ajax({
		url: "inc/controle/UserAtendimento.php?acao=requestAccess",
		data: {
			"perm":perm,
			"page":page
		},type :"POST",
		datatype:"json",
		success:function(data){
			if(data != "true"){
				window.location = "/anubis/dashboard.php";
			}else{
				// carrega mensagem pendente ao usuário
				setTimeout(function(){ 
					var userData = getSessionData(["descricao","tipo"]);
					userData.done(function (data) {
						if(data.value.descricao != null)
								showToastr(data.value.tipo, data.value.descricao, true);
					});
				},1000);
				
			}
		}
	});
	</script>
	<script type="text/javascript" src="js/lib/toastr.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/geral.js"></script>
</head>
<body class="status-loading">
<div id="loading-gif"><div class="uil-ring-css" style="transform:scale(0.84);"><div></div></div></div>
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
			<a id="user-info" class="reset-button" href="perfil.php">
				<span class="font-blue-madison">Olá, <?php echo $_SESSION['user_name']?></span>
				<img src="<?php echo $_SESSION['user_img_url']?>">
			</a>
			<div class="btn-group bg-green-haze" id="logout"><i class="fa fa-sign-out font-white" aria-hidden="true"></i></div>
		</div>
	</section>
	<section id="container-search" class="col-xs-12">
		<div class="content-search">
			<form action="listagem.php?tipo=vendedor" method="GET">
				<div class="search-content">
					<input type="hidden" name="tipo" value="vendedor">
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