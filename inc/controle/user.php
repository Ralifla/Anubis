<?php 
	class User{
		private $nome;
		private $username;
		private $password;
		private $permission;
		
		function getNome(){
			return $this->nome;
		}
		
		function setNome($nome){
			$this->nome = $nome;
		}
		
		function getUsername(){
			return $this->username;
		}
		
		function setUsername($username){
			$this->username = $username;
		}
		
		function getPassworld(){
			return $this->passworld;
		}
		
		function setPassworld($password){
			$this->passworld = $password;
		}
		
		function getPermission(){
			return $this->permission;
		}
		
		function getPermission($permission){
			$this->permission = $permission;
		}
		
		function setUser($nome, $username, $password, $permission){
			$this->nome = $nome;
			$this->username = $username;
			$this->passworld = $password;
			$this->permission = $permission;
		}
		
	}
?>