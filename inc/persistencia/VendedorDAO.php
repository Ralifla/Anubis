<?php 
include "Connection.php";

class VendedorDAO{
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
	
	function Listar($key, $perm){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
	
		$query = "SELECT * FROM `an_vendedor`
				  WHERE cpf   LIKE '%".$key."%' OR
						nome  LIKE '%".$key."%' OR
						email LIKE '%".$key."%'
				  ORDER BY ID LIMIT 20";
		$request = $mysqli->query($query);
		return $this->serialize_request($request);
	}
	
	function getVendedor($id){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT meta_key, meta_value FROM `an_vendedormeta`
				  WHERE meta_id = ". $id ." ORDER BY ID ASC";
		$request = $mysqli->query($query);
		return $this->serialize_request($request);
	}
	
}
?>