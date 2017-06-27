<?php 
	include("../modelo/Vendedor.php");
	include("../modelo/Util.php");
	
	$acao = $_GET["acao"];
	switch ($acao){
		case "getVendedor":
			$d_control = new DataControl();
			$id = $d_control->validate_injectior($_POST['id']);
			
			$vendedor = new Vendedor();
			$data = $vendedor->getVendedor($id);
			print_r(json_encode($data));
			break;
		default:
			$_SESSION['descricao']  = "Ocorreu um erro ao efetuar o atendimento";
			$_SESSION['tipo'] = "error";
	}
	die();
?>