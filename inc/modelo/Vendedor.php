<?php 
	include("../persistencia/VendedorDAO.php");
	class Vendedor{
		function Listar($key, $perm){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->Listar($key, $perm);
			return $data;
		}
	}
?>