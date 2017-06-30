<?php 
	include "../persistencia/UserDAO.php";
	class User{
		private $mensagem = array();
		
		// imagem de acordo com permissao
		function get_user_image($permission){
			switch($permission){
				case 100:
					return "img/root.png";
				default:
					return "img/guest.png";
			}
		}

		// key de ordenação para datatable
		function getDataTableKey($id){
			switch ($id){
				case "0":
					return "id";
				case "1":
					return "user_login";
				case "2":
					return "user_name";
				case "3":
					return "user_permission";
				default:
					return "id";
			}
		}
		
		// retorna array mensagem
		function getMensagem(){
			return $this->mensagem;
		}
		
		// grava dados do usuário na sessão 
		function Login($username, $password){
			$location = "Location: /anubis";
			
			if(strcmp($username,'') == 0 || strcmp($password,'') == 0){
				$location ;
				$this->mensagem['tipo'] = "error";
				$this->mensagem['descricao'] = "Informe o nome de usuário e a senha";
			}else{
				$userDAO = new UserDAO();
				$data = $userDAO->Login($username, $password);
				if($data){
					session_destroy();
					session_start();
					$_SESSION['user_id'] = $data['ID'];
					$_SESSION['user_name'] = $data['user_name'];
					$_SESSION['user_permission'] = $data['user_permission'];
					$_SESSION['user_img_url'] = $this->get_user_image($data['user_permission']);
					$location = 'Location: /anubis/dashboard.php';
				}
				$this->mensagem = $userDAO->getMensagem();
			}
			
			return $location;
		}
		
		// saida do sistema
		function Logout(){
			session_start();
			session_destroy();
			die();
		}
		
		// controi menu de acordo com permissao
		function Build_Menu($perm){
			$userDAO = new UserDAO();
			$data = $userDAO->Build_Menu($perm);
			
			include "Util.php";
			$menu = new Menu();
			$menu = $menu->Sort($data);
			
			return $menu;
		}
		
		// cria listagem de usuários
		function Listar($dt_args){
			$userDAO = new UserDAO();
			$data = $userDAO->Listar($dt_args);
			$this->mensagem = $userDAO->getMensagem();
			return $data;
		}
		
		// verfica se usuário tem acesso à determinada página
		function RequestAccess($page, $perm){
			$userDAO = new UserDAO();
			$access = $userDAO->RequestAccess($page, $perm);
			return $access;
		}
		
		//  dados dos componentes .dashboard-card
		function getDashboard(){
			$userDAO = new UserDAO();
			$data = $userDAO->getDashboard();
			return $data;
		}
		
		// retorna usuário baseado no ID
		function getUser($id){
			$userDAO = new UserDAO();
			$data = $userDAO->getUser($id);
			return $data;
		}
		
		// atualisa usuário
		function updateUser($user_data){
			$userDAO = new UserDAO();
			$userDAO->updateUser($user_data);
			$data = $userDAO->getMensagem();
			return $data;
		}
		
		// atualiza senha do usuário
		function UpdatePassword($id, $old, $new){
			$userDAO = new UserDAO();
			$userDAO->UpdatePassword($id, $old, $new);
			$this->mensagem = $userDAO->getMensagem();
		}
	}
?>