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
	// controla qual tabela do banco sera listada
	case "requestAccess":
		$page = $_POST['page'];
		$perm = $_POST['perm'];
		
		$user = new User();
		$access = $user->RequestAccess($page, $perm);
		print_r(json_encode($access));
		
		if(!$access){
			session_start();
			session_destroy();	
		}
		break;
	default:
		$_SESSION['descricao']  = "Ocorreu um erro ao efetuar o atendimento";
		$_SESSION['tipo'] = "error";
		break;	
	die();
}


?>