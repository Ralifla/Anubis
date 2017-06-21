<?php 
include "../modelo/userFacade.php";
include "../util/menu.php";
session_start();

// atendimento
if(strcmp($_GET["acao"], "getSessionData") == 0){
	getSessionData();
}else if(strcmp($_GET["acao"], "deleteSessionMsg") == 0){
	deleteSessionMsg();
}else if(strcmp($_GET["acao"], "getMenu") == 0){
	getMenu();
}else if(strcmp($_GET["acao"], "logar") == 0){
	logar();
}
	
// retorna dados da sessão
function getSessionData(){
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
}

// retorna menu de acordo com nivel de permissão
function getMenu(){
	$menu = new Menu();
	$perm = $_SESSION['user_permission'];
	$html = $menu->getMenu($perm);
	print_r(json_encode($html));
	die();
}

// remove msg da sessão
function deleteSessionMsg(){
	$_SESSION['msg'] = null;
}

// controle de login	
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
		
		try{
			// add dados do usuário na sessão
			if($data){
				$tipo = "success";
				$location = "Location: /anubis/dashboard.php";
				$_SESSION['user_id'] = $data['ID'];
				$_SESSION['user_name'] = $data['user_name'];
				$_SESSION['user_permission'] = $data['user_permission'];
				$_SESSION['user_img_url'] = $userFacade->get_user_image($data['user_permission']);
			}
		}catch (Exception $e){
			$data['tipo']  = 'error';
			$data['msg']   = 'Ocorreu um erro ao salvar dados da sessão';
			session_destroy();
		}
	}
	header($location);
	$_SESSION['tipo'] = $tipo;
	$_SESSION['msg'] = $msg;
	die();
}
?>