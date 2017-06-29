<?php 
include "Connection.php";

class VendedorDAO{
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
	
	// retorna listagem ordenada de acordo com os argumentos recebidos
	function Listar($dt_args){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT COUNT(id) total FROM `an_vendedor`";
		$request = $mysqli->query($query);
		$recordsTotal = $this->serialize_request($request);
		$recordsTotal = $recordsTotal[0][0];
		
		$data = array(
				"data" => [],
				"recordsTotal" => $recordsTotal,
				"recordsFiltered" => sizeof($data_list)
		);
		
		$query = "SELECT id,nome,cpf,email FROM `an_vendedor`
				  WHERE cpf   LIKE ?
				  OR 	nome  LIKE ?
				  OR	email LIKE ?
				  ORDER BY ".$dt_args['key']." ". $dt_args['order']." LIMIT ".$dt_args['start']. " ," . $dt_args['length']. " ";

		if($stmt = $mysqli->prepare($query)){
			$search = "%".$dt_args['search']."%";
			$stmt->bind_param(
					"sss", 
					$search,$search,$search
			);
			$stmt->execute();
			$stmt->bind_result($id, $cpf, $nome, $email);
			$result = array();
			while ($stmt->fetch()) {
				$aux = array(
						"0"	=>	$id,
						"1"	=>	$cpf,
						"2"	=>	$nome,
						"3"	=>	$email
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
	
	// retorna vendedor baseado no id
	function getVendedor($id){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT meta_key, meta_value FROM `an_vendedormeta`
				  WHERE meta_id = ". $id ." ORDER BY ID ASC";
		
		$request = $mysqli->query($query);
		$data = $this->serialize_request($request);
		return $data;
	}
	
}
?>