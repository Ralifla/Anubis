<?php 
include "Connection.php";

class VendedorDAO{
	private $mensagem = array();
	
	function get_mensagem(){
		return $this->mensagem;
	}
	
	function serialize_request($request){
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
	
	function Listar($key, $order, $search, $start, $length){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$query = "SELECT COUNT(id) total FROM `an_vendedor`";
		$request = $mysqli->query($query);
		$recordsTotal = $this->serialize_request($request);
		$recordsTotal = $recordsTotal[0][0];
		
		$query = "SELECT * FROM `an_vendedor` 
				  WHERE cpf   LIKE '%".$search."%'
				  OR 	nome  LIKE '%".$search."%'
				  OR	email LIKE '%".$search."%'
				  ORDER BY ".$key." ". $order ." LIMIT ".$start . " ," . $length . " ";
		$request = $mysqli->query($query);
		$data_list= $this->serialize_request($request);
		$data = array(
				"recordsTotal" => $recordsTotal,
				"recordsFiltered" => sizeof($data_list),
				"data"	=> $data_list
		);
		return $data;
	}
	
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