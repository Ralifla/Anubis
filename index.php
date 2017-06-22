<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/lib/font-awesome.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/color.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/toastr.min.css"></link>
	
	<link rel="stylesheet" type="text/css" href="css/geral.css"></link>
	<link rel="stylesheet" type="text/css" href="css/login.css"></link>
	
	<script type="text/javascript" src="js/lib/jquery.min.js"></script>
	<script type="text/javascript" src="js/lib/toastr.min.js"></script>
	<script type="text/javascript" src="js/geral.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body class="bg-dark">
	<section class="container">
		<article id="content-login" class="bg-dark bg-font-dark col-md-8 col-md-offset-2 col-xs-12">
			<header>
				<div class="content-img text-center"><img src="img/ralifla.png"></div>
			</header>
			<form id="form-login" method="POST" action="inc/controle/UserAtendimento.php?acao=login">
				<div class="form-group">
					<input type="text" class="col-xs-12 font-dark" name="username" placeholder="Usuario">
				</div>
				<div class="form-group">
					<input type="password" class="col-xs-12 font-dark" name="password"  placeholder="Senha">
				</div>
				<div class="form-group content-submit text-center">
					<button type="submit" id="btn-login" class="btn-primary"><span>Entrar</span></button>
				</div>
			</form>
			<footer>
				<p>2017 | © Ralifla </p>
			</footer>
		</article>
	</section>
</body>
</html>