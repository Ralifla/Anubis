<?php 
include "../persistencia/UserDAO.php";
class userFacade{
	private $mensagem;
	
	function getMensagem(){
		return $this->mensagem;
	}
	
	function get_user_image($permission){
		switch($permission){
			case 100:
				return "img/root.png";
			default:
				return "img/guest.png";
		}
	}
	
	function Logar($login, $senha){
		$userDAO = new UserDAO();
		$request = $userDAO->Logar($login, $senha);
		$this->mensagem = $userDAO->getMensagem();
		return $request;
	}
}
?>