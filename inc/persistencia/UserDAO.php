<?php 

include "../persistencia/Connection.php";

class UserDAO{
	private $mensagem;
	
	function getMensagem(){
		return $this->mensagem;
	}
	
	function Logar($login, $senha){
		$conection = new Connection();
		$mysqli = $conection->getConnection();
		
		$request = $mysqli->query("SELECT * FROM an_users WHERE user_login ='". $login ."'AND user_pass ='".$senha."'");
		
		if(!request){
			$this->mensagem = "Ocorreu um erro ao estabelecer uma conexão com banco de dados";
		}else{
			if(mysqli_num_rows($request) == 0)
				$this->mensagem = "Usuário não cadastrado";
			else 
				$this->mensagem = "Bem vindo ao sistema administrativo Ralifla";
		}
		return $request;
	}
}
?>