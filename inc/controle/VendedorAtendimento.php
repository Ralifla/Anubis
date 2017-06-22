<?php 
	include("../modelo/Vendedor.php");
	include("../modelo/Util.php");
	
	$acao = $_GET["acao"];
	switch ($acao){
		// busca vendedores cadastrados baseado em um $key
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
			
		// retorna dados de um vendedor baseado no ID
		case "getVendedor":
			$d_control = new DataControl();
			$id = $d_control->validate_injectior($_POST['id']);
			
			$vendedor = new Vendedor();
			$data = $vendedor->getVendedor($id);
			print_r(json_encode($data));
			die();
			break;
		default:
			$_SESSION['descricao']  = "Ocorreu um erro ao efetuar o atendimento";
			$_SESSION['tipo'] = "error";
			die();
	}
?>