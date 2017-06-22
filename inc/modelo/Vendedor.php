<?php 
	include("../persistencia/VendedorDAO.php");
	class Vendedor{
		
		function Listar($key, $perm){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->Listar($key, $perm);
			return $data;
		}
		
		function getVendedor($id){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->getVendedor($id);
			return $data[0];
		}
		
	}
?>