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
	
	function serialize_list($request){
		$data = array();
		while ($row = mysqli_fetch_assoc($request)){
			if(is_array($row)){
				$aux = array();
				foreach($row as $key => $value){
					array_push($aux, $value);
				}
				array_push($data, $aux);
			}else{
				array_push($data, $row);
			}
		}
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
		
		$query = "SELECT * FROM `an_menu` WHERE permissao <= ".$perm . " ORDER BY order_item ASC";
		$request = $mysqli->query($query);
		
		return $this->serialize_request($request);
	}
	
	function Listar($key, $order, $search, $start, $length){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT COUNT(id) total FROM `an_users`";
		$request = $mysqli->query($query);
		$recordsTotal = $this->serialize_request($request);
		$recordsTotal = $recordsTotal[0]['total'];
		
		$query = "SELECT id,user_login,user_name,user_permission FROM `an_users`
				  WHERE user_name   LIKE '%".$search."%'
				  OR 	user_login  LIKE '%".$search."%'
				  ORDER BY ".$key." ". $order ." LIMIT ".$start . " ," . $length . " ";
		$request = $mysqli->query($query);
		$data_list= $this->serialize_list($request);
		$data = array(
				"recordsTotal" => $recordsTotal,
				"recordsFiltered" => sizeof($data_list),
				"data"	=> $data_list
		);
		return $data;
	}
	
}
?>