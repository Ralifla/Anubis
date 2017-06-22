<?php 
	include("../modelo/Vendedor.php");
	$acao = $_GET["acao"];
	switch ($acao){
		// exibe lista de vendedores cadastrados
		case "listar":
			session_start();
			$key  = $_POST['key'];
			$perm = $_SESSION['user_permission'];
			
			$vendedor = new Vendedor();
			$data = $vendedor->Listar($key, $perm);
			session_start();
			$_SESSION['lista'] = $data;
			header("Location: /anubis/listagem.php");
			die();
			break;
		default:
			$_SESSION['descricao']  = "Ocorreu um erro ao efetuar o atendimento";
			$_SESSION['tipo'] = "error";
			die();
	}
?>