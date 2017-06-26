<?php 
	include("../modelo/Vendedor.php");
	include("../modelo/Util.php");
	
	$acao = $_GET["acao"];
	switch ($acao){
		// busca vendedores cadastrados baseado em um $key
		case "listar":
			session_start();
			
			$search = $_POST['search_aux'];
			if($search == '')
				$search = $_POST['search']['value'];
			$start = $_POST['start'];
			$length = $_POST['length'];
			$i = $_POST['order'][0]['column'];
			$key = $_POST['columns'][$i]['data'];
			$order = $_POST['order'][0]['dir'];
			
			$vendedor = new Vendedor();
			$data = $vendedor->Listar($key, $order, $search, $start, $length);
			print_r(json_encode($data));
			break;
			
		// retorna dados de um vendedor baseado no ID
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