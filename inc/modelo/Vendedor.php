<?php 
	include("../persistencia/VendedorDAO.php");
	class Vendedor{
		
		function Listar($key, $order, $search, $start, $length){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->Listar($key, $order, $search, $start, $length);
			return $data;
		}
		
		function getVendedor($id){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->getVendedor($id);
			return $data;
		}
		
		function getDataTableKey($id){
			switch ($id){
				case "0":
					return "id";
				case "1":
					return "cpf";
				case "2":
					return "nome";
				case "3":
					return "email";
				default:
					return "id";
			}
		}
		
	}
?>