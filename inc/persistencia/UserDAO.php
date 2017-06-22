<?php 
include "Connection.php";

class UserDAO{
	private $mensagem = array();
	
	function get_mensagem(){
		return $this->mensagem;
	}

	function serialize_request($request){
		$data = array();
		while ($row = mysqli_fetch_assoc($request))
			$data[] = $row;
		return $data;
	}
	
	function Login($username, $password){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT * FROM an_users WHERE user_login ='". $username."'AND user_pass ='".$password."'";
		$request = $mysqli->query($query);
		if(!request){
			$this->mensagem['tipo'] = "error";
			$this->mensagem['location'] = "Location: /anubis";
			$this->mensagem['descricao'] = "Ocorreu um erro ao estabelecer uma conexão com banco de dados";
		}else{
			if(mysqli_num_rows($request) == 0){
				$this->mensagem['tipo'] = "warning";
				$this->mensagem['location'] = "Location: /anubis";
				$this->mensagem['descricao'] = "Usuário não cadastrado";
			}else{
				$this->mensagem['tipo'] = "success";
				$this->mensagem['location'] = "Location: /anubis/dashboard.php";
				$this->mensagem['descricao'] = "Bem vindo ao sistema administrativo Ralifla";
			}
		}
		return $this->serialize_request($request);
	}
	
	function Build_Menu($perm){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT * FROM `an_menu` WHERE permissao < ".$perm . " ORDER BY order_item ASC";
		$request = $mysqli->query($query);
		
		return $this->serialize_request($request);
	}
}
?>