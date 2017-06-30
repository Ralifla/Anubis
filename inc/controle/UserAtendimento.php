<?php 
	$url = $_SERVER['DOCUMENT_ROOT'] . '/anubis/inc/';
	include($url. "modelo/User.php");

$acao = $_GET["acao"];
switch ($acao){
	// login
	case "login": 
		require "../modelo/Util.php";
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$user = new User();
		$location = $user->Login($username, $password);
		
		$mensagem = $user->getMensagem();
		$tipo = $mensagem['tipo'];
		$descricao = $mensagem['descricao'];
		
		$mensagem = new Mensagem();
		$mensagem->push($descricao, $tipo);
		header($location);
		break;
	// logout
	case "logout":
		$user = new User();
		$user->Logout();
		break;
	// construção do menu de acordo com permissao 	
	case "build_menu":
		$user = new User();
		session_start();
		$pemission = $_SESSION['user_permission'];
		$menu = $user->Build_Menu($pemission);
		print_r(json_encode($menu));
		break;
	// controla acesso as páginas
	case "requestAccess":
		$page = $_POST['page'];
		$perm = $_POST['perm'];
		
		$user = new User();
		$access = $user->RequestAccess($page, $perm);
		if(!$access){
			session_start();
			$_SESSION['descricao']  = "Você não tem permissão para acessar esta àrea do sistema";
			$_SESSION['tipo'] = "error";
		}
		
		print_r(json_encode($access));
		break;
	// retorna dados dos componentes .dashboard-card
	case "dashboardData":
		$user = new User();
		$data = $user->getDashboard();
		print_r(json_encode($data));
		break;
	// retorna meta_dados do usuário
	case "getUser":
		$id = $_POST['id'];
		$user = new User();
		$data = $user->getUser($id);
		print_r(json_encode($data));
		break;
	// atualiza usuário
	case "updateUser":
		$user_data = $_POST;
		$user = new User();
		$data = $user->updateUser($user_data);
		print_r(json_encode($data));
		break;
	// atualiza senha do usuário
	case "updatePassword":
		$id = $_POST['id'];
		$new = $_POST['new'];
		$old = $_POST['old'];
		
		$user = new User();
		$user->UpdatePassword($id, $old, $new);
		
		$mensagem = $user->getMensagem();
		$data = array(
				"tipo" => $mensagem['tipo'],
				"descricao" => $mensagem['descricao']
		);
		print_r(json_encode($data));
		
		break;
	default:
		$descricao  = "Ocorreu um erro ao efetuar o atendimento";
		$tipo = "error";
		
		require "../modelo/Util.php";
		$mensagem = new Mensagem();
		$mensagem->push($descricao, $tipo);
		break;	
	die();
}


?>