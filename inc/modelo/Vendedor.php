<?php 
	include("../persistencia/VendedorDAO.php");
	class Vendedor{
		private $mensagem = array();
		
		// key de ordenação para datatable
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
		
		function getMensagem(){
			return $this->mensagem;
		}
		
		// retorna lista para o datatable
		function Listar($dt_args){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->Listar($dt_args);
			$this->mensagem = $vendedorDAO->getMensagem();
			return $data;
		}
		
		// retorna vendedor baseado no id
		function getVendedor($id){
			$vendedorDAO = new VendedorDAO();
			$data = $vendedorDAO->getVendedor($id);
			return $data;
		}
		
	}
?>