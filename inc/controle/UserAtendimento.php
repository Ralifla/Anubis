<?php 
include("../modelo/User.php");
$acao = $_GET["acao"];
switch ($acao){
	// login
	case "login": 
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$user = new User();
		$location = $user->Login($username, $password);
		
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
	default:
		$_SESSION['descricao']  = "Ocorreu um erro ao efetuar o atendimento";
		$_SESSION['tipo'] = "error";
		break;	
	die();
}


?>