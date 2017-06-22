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
						email LIKE '%".$key."%'";
		$request = $mysqli->query($query);
		return $this->serialize_request($request);
	}
	
}
?>