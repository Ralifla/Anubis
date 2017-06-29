<?php 
	include("../persistencia/VendedorDAO.php");
	class Vendedor{
		private $mensagem = array();
		
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
		
		function Listar($dt_args){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->Listar($dt_args);
			$this->mensagem = $vendedorDAO->getMensagem();
			return $data;
		}
		
		function getVendedor($id){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->getVendedor($id);
			return $data;
		}
		
	}
?>