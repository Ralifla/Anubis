<!DOCTYPE html>
<html>
<head>
	<title>Ralifla</title>
	<link rel="stylesheet" type="text/css" href="css/lib/font-awesome.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/color.min.css"></link>
	<link rel="stylesheet" type="text/css" href="css/lib/toastr.min.css"></link>
	
	<link rel="stylesheet" type="text/css" href="css/geral.css"></link>
	
	<script type="text/javascript" src="js/lib/jquery.min.js"></script>
	<script type="text/javascript" src="js/lib/toastr.min.js"></script>
	<script type="text/javascript" src="js/geral.js"></script>
	
	<script>
	$(document).ready(function($) {
		<?php 
			session_start(); 
			echo 'var msg  = "'.$_SESSION["msg"].'";'; 
			echo 'var tipo = "'.$_SESSION["tipo"].'";'; 
			$_SESSION["msg"] = '';
		?>
		if(msg) showToastr(tipo ,msg);
	});
	</script>
</head>
<body>
<header>
	<
</header>