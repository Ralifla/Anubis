<?php 
include("../modelo/User.php");
$acao = $_GET["acao"];
switch ($acao){
	// login
	case "login": 
		$username = validate_injectior($_POST['username']);
		$password = validate_injectior($_POST['password']);
		
		$user = new User();
		$location = $user->Login($username, $password);
		
		header($location);
		die();
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
		die();
		break;
	default:
		$_SESSION['descricao']  = "Ocorreu um erro ao efetuar o atendimento";
		$_SESSION['tipo'] = "error";
		die();
}

function validate_injectior($string){
	return $string;
}
?>