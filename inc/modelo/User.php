<?php 
	include "../persistencia/UserDAO.php";
	class User{
		function get_user_image($permission){
			switch($permission){
				case 100:
					return "img/root.png";
				default:
					return "img/guest.png";
			}
		}
		
		function setUser($nome, $username, $password, $permission){
			$this->nome = $nome;
			$this->username = $username;
			$this->passworld = $password;
			$this->permission = $permission;
		}
		
		function Login($username, $password){
			$descricao; $location; $tipo;
			
			if(strcmp($username,'') == 0 || strcmp($password,'') == 0){
				$tipo = "error";
				$location = "Location: /anubis";
				$descricao = "Informe o nome de usuário e a senha";
			}else{
				$userDAO = new UserDAO();
				$data = $userDAO->Login($username, $password);
				$data = $data[0];
				
				if($data){
					session_destroy();
					session_start();
					$_SESSION['user_id'] = $data['ID'];
					$_SESSION['user_name'] = $data['user_name'];
					$_SESSION['user_permission'] = $data['user_permission'];
					$_SESSION['user_img_url'] = $this->get_user_image($data['user_permission']);
				}
				
				$action = $userDAO->get_mensagem();
				$tipo = $action['tipo'];
				$location = $action['location'];
				$descricao = $action['descricao'];
			}
			session_start();
			$_SESSION['tipo'] = $tipo;
			$_SESSION['descricao'] = $descricao;
			return $location;
		}
		
		function Logout(){
			session_start();
			session_destroy();
			die();
		}
		
		function Build_Menu($perm){
			$userDAO = new UserDAO();
			$data = $userDAO->Build_Menu($perm);
			
			include "Util.php";
			$menu = new Menu();
			$menu = $menu->Sort($data);
			
			return $menu;
		}
	}
?>