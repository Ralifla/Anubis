<?php 
	$url = $_SERVER['DOCUMENT_ROOT'] . '/anubis/inc/';
	
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
			$data;
			$search = $_POST['search_aux'];
			if($search == '')
				$search = $_POST['search']['value'];
			$start = $_POST['start'];
			$length = $_POST['length'];
			$i = $_POST['order'][0]['column'];
			$order = $_POST['order'][0]['dir'];
			$id = $_POST['columns'][$i]['data'];
				
			switch ($_POST['listagem']){
				case '':
				case 'vendedor':
					require $url . "modelo/Vendedor.php";
					$vendedor = new Vendedor();
					$key = $vendedor->getDataTableKey($id);
					$data = $vendedor->Listar($key, $order, $search, $start, $length);
					break;
				case 'webmaster':
					require $url . "modelo/User.php";
					$user = new User();
					$key = $user->getDataTableKey($id);
					$data = $user->Listar($key, $order, $search, $start, $length);
					break;
			}
			print_r(json_encode($data));
			break;
	}
	die();
?>