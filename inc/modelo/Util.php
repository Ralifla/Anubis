<?php 

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

Class DataControl{
	function validate_injectior($string){
		return $string;
	}
}
?>