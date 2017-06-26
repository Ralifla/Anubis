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
		
	}
?>