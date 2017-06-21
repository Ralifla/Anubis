<?php 
class Menu{
	private $menu = array();
	private $subMenu = array();
	
	function getMenu($perm){
		if(!$perm)
			return null;
		$conection = new Connection();
		$mysqli = $conection->getConnection();

		$query = "SELECT * FROM `an_menu`";
		$request = $mysqli->query($query);
		
		while($row = mysqli_fetch_assoc($request)){
			if($perm >= $row['permissao']){
				if($row['parent'] == "0")
					array_push($this->menu, $row);
				else
					array_push($this->subMenu, $row);
			}
		}
		
		$this->menu = $this->merge_arrays();
		
		return $this->menu;
	}
	
	function merge_arrays(){
		$this->menu = $this->order_item($this->menu);
		$this->subMenu = $this->order_item($this->subMenu);
		$menu = array();
		foreach($this->menu as $k => $item){
			$menu[] = $item;
			foreach($this->subMenu as $key => $subItem){
				if($item['id'] == $subItem['parent']){
					$menu[] = $subItem;
				}
			}
		}
		
		return $menu;
	}

	// ordena os itens do menu
	function order_item($obj){
		$menu = $obj;
		$length = count($this->menu);
		
		for($j=1; $j<$length; $j++){
			$key = $menu[$j];
			$i = $j-1;

			while( $i>=0 && $menu[$i]['order_item']> $key['order_item']){
				// elemento pai
				$menu[$i+1] = $menu[$i];
				$menu[$i] = $key;
				$i--;
			}
		}
		
		return $menu;
	}
}

?>