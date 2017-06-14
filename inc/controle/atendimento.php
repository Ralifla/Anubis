<?php 
include "../modelo/userFacade.php";


session_start();
$_SESSION['error'] = '';
if(strcmp($_GET["acao"], "logar") == 0){
	logar();
}
	
		
function logar(){
	$msg; $location; $tipo;
	$login = $_POST['username'];
	$senha = $_POST['password'];
	
	// campos vazios
	if(strcmp($login,'') == 0 || strcmp($login,'') == 0){
		$tipo = "error";
		$location = "Location: /anubis";
		$msg = "Informe o nome de usuário e a senha";
	}else{
		$tipo = "warning";
		$location = "Location: /anubis";
		
		// seleciona usuário no banco
		$userFacade = new UserFacade();
		$request = $userFacade->Logar($login, $senha);
		$msg = $userFacade->getMensagem();
		
		$data = array();
		while ($row = mysqli_fetch_assoc($request))
			$data[] = $row;
		$data = $data[0];
		
		// add dados do usuário na sessão
		if($data){
			$tipo = "success";
			$location = "Location: /anubis/dashboard.php";
			$_SESSION['user_id'] = $data['ID'];
			$_SESSION['user_name'] = $data['user_name'];
			$_SESSION['user_permission'] = $data['user_permission'];
		}
	}
	header($location);
	$_SESSION['tipo'] = $tipo;
	$_SESSION['msg'] = $msg;
}

?>