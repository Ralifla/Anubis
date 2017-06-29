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
				
				$action = $userDAO->getMensagem();
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
		
		
		function Listar($key, $order, $search, $start, $length){
			$userDAO = new UserDAO();
			$data = $userDAO->Listar($key, $order, $search, $start, $length);
			return $data;
		}
		
		function RequestAccess($page, $perm){
			$userDAO = new UserDAO();
			$access = $userDAO->RequestAccess($page, $perm);
			return $access;
		}
		
		function getDashboard(){
			$userDAO = new UserDAO();
			$data = $userDAO->getDashboard();
			return $data;
		}
		
		function getUser($id){
			$userDAO = new UserDAO();
			$data = $userDAO->getUser($id);
			return $data;
		}
		
		function updateUser($user_data){
			$userDAO = new UserDAO();
			$userDAO->updateUser($user_data);
			$data = $userDAO->getMensagem();
			return $data;
		}
		
	}
?>