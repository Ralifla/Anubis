<?php 

// manipulação do menu
class Menu{
	function Sort($menu){
		$pai = array();
		$filho = array();
		foreach ($menu as $key => $value){
			$elem = &$pai;
			if($value['parent'] != "0")
				$elem = &$filho;
			array_push($elem,$value);
		}

		$menu = array();
		foreach ($pai as $key => $value){
			array_push($menu, $value);
			foreach ($filho as $k => $val){
				if($value["id"] == $val['parent']){
					array_push($menu,$val);
				}
			}
		}
		
		return $menu;
	}
}

// classe para validação dos dados
Class DataControl{
	function validate_int($val){
		$val = intval($val, 0);
		if(is_int($val))
			return $val;
		return null;
	}
}

// classe para controle de mensagens na sessão
Class Mensagem{
	function push($descricao, $tipo){
		if(strcmp($descricao, "") != "0"){
			session_start();
			$_SESSION['tipo'] = $tipo;
			$_SESSION['descricao'] = $descricao;
		}
	}
}

?>