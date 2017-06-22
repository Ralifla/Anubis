<?php 
	session_start();
	$action = $_GET["acao"];
	switch ($action){
		// pega um dado da sessao baseado em um key
		case "getSessionData":
			$data = array();
			$data['error'] = null;
			try{
				$val;
				foreach($_POST as $key => $value)
					$val[$value] = $_SESSION[$value];
					$data['value'] = $val;
					$data['tipo']  = 'success';
			}catch (Exception $e){
				$data['tipo']  = 'error';
				$data['msg']   = 'Ocorreu um erro ao carregar dados da sessão';
				session_destroy();
			}
			print_r(json_encode($data));
			die();
			break;
		// remove mensagem da sessao
		case "deleteSessionMsg":
			$_SESSION['descricao'] = null;
			die();
			break;
	}
?>