<?php 
include "../persistencia/UserDAO.php";
class userFacade{
	private $mensagem;
	
	function getMensagem(){
		return $this->mensagem;
	}
	
	function Logar($login, $senha){
		$userDAO = new UserDAO();
		$request = $userDAO->Logar($login, $senha);
		$this->mensagem = $userDAO->getMensagem();
		return $request;
	}
}
?>