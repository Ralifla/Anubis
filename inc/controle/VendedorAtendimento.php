<?php 
	include("../modelo/Vendedor.php");
	include("../modelo/Util.php");
	
	$acao = $_GET["acao"];
	switch ($acao){
		// retorna vendedor baseado no id
		case "getVendedor":
			$descricao;$tipo; 
			
			$d_control = new DataControl();
			$id = $d_control->validate_int($_POST['id']);
			
			$data = null;
			if($id != null){
				$vendedor = new Vendedor();
				$data = $vendedor->getVendedor($id);
				$mensagem = $vendedor->getMensagem();
				
				$tipo = $mensagem['tipo'];
				$descricao = $mensagem['descricao'];
			}else{
				$tipo = "warning";
				$descricao = "Formato de id inválido";
			}
			print_r(json_encode($data));
			
			$mensagem = new Mensagem();
			$mensagem->push($descricao, $tipo);
			
			break;
		// exception para acao desconhecida
		default:
			$tipo = "error";
			$descricao = "Ocorreu um erro ao efetuar o atendimento";
			$mensagem->push($descricao, $tipo);
	}
	die();
?>