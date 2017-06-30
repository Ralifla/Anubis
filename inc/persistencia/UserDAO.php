<?php 
include "Connection.php";

class UserDAO{
	private $mensagem = array();
	
	// array com dados da operação realizada
	function getMensagem(){
		return $this->mensagem;
	}

	// recebe $mysqly->query  e retorna uma lista
	function serialize_request($request){
		$data = array();
		while ($row = mysqli_fetch_assoc($request))
			$data[] = $row;
		return $data;
	}
	
	function Login($username, $password){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT * FROM an_users WHERE user_login ='".$username."' AND user_pass ='".$password."'";
		if($stmt = $mysqli->prepare($query)){
			$request = $mysqli->query($query);
			if(!request){
				$this->mensagem['tipo'] = "error";
				$this->mensagem['descricao'] = "Ocorreu um erro ao estabelecer uma conexão com banco de dados";
			}else{
				if(mysqli_num_rows($request) == 0){
					$this->mensagem['tipo'] = "warning";
					$this->mensagem['descricao'] = "Usuário não cadastrado ou senha não confere";
				}else{
					$this->mensagem['tipo'] = "success";
					$this->mensagem['descricao'] = "Bem vindo ao sistema administrativo Ralifla";
				}
			}
		}
		$data = $this->serialize_request($request);
		return $data[0];
	}
	
	function RequestAccess($page, $perm){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT * FROM `an_page_permission` WHERE nome = '".$page. "' AND permissao <= " . $perm. "";
		$request = $mysqli->query($query);
		$access = $this->serialize_request($request);
		
		if($access)
			$access = true;
		else
			$access = false;
		return $access;
	}
	
	function Build_Menu($perm){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT * FROM `an_menu` WHERE permissao <= ".$perm . " ORDER BY order_item ASC";
		$request = $mysqli->query($query);
		
		return $this->serialize_request($request);
	}
	
	/*
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
	*/
	// retorna listagem ordenada de acordo com os argumentos recebidos
	function Listar($dt_args){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT COUNT(id) total FROM `an_users`";
		$request = $mysqli->query($query);
		$recordsTotal = $this->serialize_request($request);
		$recordsTotal = $recordsTotal[0][0];
		
		
		$data = array(
				"data" => [],
				"recordsTotal" => $recordsTotal,
				"recordsFiltered" => sizeof($data_list)
		);
		$query = "SELECT id,user_login,user_name,user_permission FROM `an_users`
				  WHERE user_name   LIKE ?
				  OR 	user_login  LIKE ?
				  ORDER BY ".$dt_args['key']." ". $dt_args['order']." LIMIT ".$dt_args['start']. " ," . $dt_args['length']. " ";
		
		if($stmt = $mysqli->prepare($query)){
			$search = "%".$dt_args['search']."%";
			$stmt->bind_param(
					"ss",
					$search,$search
					);
			$stmt->execute();
			$stmt->bind_result($id, $user_login, $user_name, $user_permission);
			$result = array();
			while ($stmt->fetch()) {
				$aux = array(
						"0"	=>	$id,
						"1"	=>	$user_login,
						"2"	=>	$user_name,
						"3"	=>	$user_permission
				);
				array_push($result, $aux);
			}
			$data["data"] = $result;
			$this->mensagem = null;
		}else{
			echo "else";
			$this->mensagem['descricao'] = "Foram encontrados entradas de má fé em seu código, por isso a requisição foi cancelada";
			$this->mensagem['tipo'] = "error";
		}
		return $data;
	}
	
	function getDashboard(){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT COUNT(id) total from `an_vendedor`";
		$request = $mysqli->query($query);
		$qtdVendedor = $this->serialize_request($request);
		$qtdVendedor = $qtdVendedor[0]['total'];

		$query = "SELECT COUNT(id) total from `an_users`";
		$request = $mysqli->query($query);
		$qtdUser = $this->serialize_request($request);
		$qtdUser = $qtdUser[0]['total'];
		
		$data = array(
			"users" => $qtdUser,
			"vendedores" => $qtdVendedor
		);
		return $data;
	}
	
	// seleciona metadados do usuário
	function getUser($id){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		$query = "SELECT meta_key,meta_value from `an_usermeta` WHERE meta_id = ".$id;
		$request = $mysqli->query($query);
		$data = $this->serialize_request($request);
		
		return $data;
	}
	
	// atualiza os dados do usuário
	function updateUser($user_data){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "UPDATE `an_usermeta`";
		$query .= "SET meta_value = CASE meta_key";
		$show;
		foreach($user_data as $key => $value){
			if(strcmp($key,"id") != "0")
				$query.= " WHEN '".$key."' THEN '".$value."'";
		}
		$query .= " END WHERE meta_id = ".$user_data['id'];

		$error = false;
		try{
			$request = $mysqli->query($query);
		}catch (Exception $e) {
			$this->mensagem['descricao'] = "Ocorreu um erro ao realizar a atualização";
			$this->mensagem['tipo'] = "alert";
			$error = true;
		}
		if(!$error){
			$this->mensagem['descricao'] = "Atualização realizada com sucesso!";
			$this->mensagem['tipo'] = "success";
		}
	}
	
	// atualiza senha do usuário
	function UpdatePassword($id, $old, $new){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "UPDATE `an_users` SET user_pass = '".$new."' WHERE user_pass = '".$old."' AND id = ".$id."";
		$request = $mysqli->query($query);
		
		if($mysqli->affected_rows == 1){
			$this->mensagem['descricao'] = "Atualização realizada com sucesso!";
			$this->mensagem['tipo'] = "success";
		}else{
			$this->mensagem['descricao'] = "Erro ao confirmar senha antiga!";
			$this->mensagem['tipo'] = "error";
		}
	}
	
}
?>