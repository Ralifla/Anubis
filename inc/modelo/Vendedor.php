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
		
		// salva arquivos
		function SaveFiles($cpf,$file){
			$dir = "../files/";
			
			// verifica se ocorreu um erro ao enviar imagens
			$error = $file['error'];
			foreach ($error as $key => $value){
				if($val != 0){
					$this->mensagem['tipo'] = "error";
					$this->mensagem['descricao'] = "Ocorreu um erro ao enviar os arquivos";
				}
			}
			
			// verifica tipo de arquivo enviado
			$tipo = $file['type'];
			foreach ($tipo as $key => $value){
				if(strpos($value, "image") !== false){
					// redimencionar 
				}else{
					// salvar
				}
			}
			die();
		}
		/*
			name
			type
			tmp_name
			error
			size
		 */
	}
?>