<?php 
	$url = $_SERVER['DOCUMENT_ROOT'] . '/anubis/inc/';
	require $url . "modelo/Util.php";
	
	session_start();
	$action = $_GET["acao"];
	switch ($action){
		// pega um dado da sessao baseado em um key
		case "getSessionData":
			$data = array();
			$data['error'] = null;
			try{
				$val;
				foreach($_POST as $key => $value){
					$val[$value] = $_SESSION[$value];
				}
				$data['value'] = $val;
				$data['tipo']  = 'success';
			}catch (Exception $e){
				$data['tipo']  = 'error';
				$data['msg']   = 'Ocorreu um erro ao carregar dados da sessão';
				session_destroy();
			}
			print_r(json_encode($data));
			break;
		// remove mensagem da sessao
		case "deleteSessionMsg":
			$_SESSION['descricao'] = null;
			break;
		// cria uma listagem para o datatables
		case "listar":
			$data;$msg_array;
			
			$search = $_POST['search_aux'];
			$id = $_POST['columns'][$i]['data'];
			if($search == '') $search = $_POST['search']['value'];
				
			// dados para realizar filtragem data_table
			$dt_args = array(
					"search" 	=> $search,
					"start" 	=> $_POST['start'],
					"length" 	=> $_POST['length'],
					"order" 	=> $_POST['order'][0]['dir'],
			);
			
			switch ($_POST['listagem']){
				case '':
				case 'vendedor':
					require $url . "modelo/Vendedor.php";
					$vendedor = new Vendedor();
					$dt_args['key'] = $vendedor->getDataTableKey($id);
					$data = $vendedor->Listar($dt_args);
					$msg_array = $vendedor->getMensagem();
					break;
				case 'webmaster':
					require $url . "modelo/User.php";
					$user = new User();
					$dt_args['key'] = $user->getDataTableKey($id);
					$data = $user->Listar($dt_args);
					$msg_array = $user->getMensagem();
					break;
			}
			print_r(json_encode($data));
			
			// envia mensagem
			$tipo = $msg_array['tipo'];
			$descricao = $msg_array['descricao'];
			$mensagem = new Mensagem();
			$mensagem->push($descricao,$tipo);
			
			break;
		// exception para acao desconhecida
		default:
			$tipo = "error";
			$descricao = "Ocorreu um erro ao efetuar o atendimento";
			$mensagem = new Mensagem();
			$mensagem->push($descricao, $tipo);
	}
	die();
?>