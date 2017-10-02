<?php

class Usuario {
	
	// Atributos 
	// 
	Private $usario;
	Private $deslogin;
	Private $dessenha;
	Private $dtcadastro;

	// Metodo Gets /Sets 
	//  
	
	public function getUsuario()
	{
	    return $this->usuario;
	}
	
	public function setUsuario($value)
	{
	    $this->usuario = $value;
	}

	public function getDeslogin()
	{
	    return $this->deslogin;
	}
	
	public function setDeslogin($value)
	{
	    $this->deslogin = $value;
	}

	public function getDessenha()
	{
	    return $this->dessenha;
	}
	
	public function setDessenha($value)
	{
	    $this->dessenha = $value;
	}

	public function getDtcadastro()
	{
	    return $this->dtcadastro;
	}
	
	public function setDtcadastro($value)
	{
	    $this->dtcadastro = $value;
	}

	// Metodos contrutor 
	// 
	

	// Metodos de trabalho
	// Metodo para trazer todos dados de um determinado ID (Somente um usuário)
	public function loadById($id) {
		$sql = new Sql();

		$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
			
			if (count($results) > 0) {
				
				$this->setData($results[0]);
								
			}
	}  
	/////////Metodos especiais Nativos / Magicos 
	
	//  Metodo constutor passando login e senha 
	public function __construct ($login = "",$password = "") {
		
		$this-> setDeslogin($login);
		$this-> setDessenha($password);
	}
	
	//  Metodo que gera as informações em Strings 
	public function __toString () {
		
		return json_encode(array(
				"idusuario"=>$this->getUsuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s"),
		));
	}
	
	//Metodo para gerar todos Usuário da tabela (lista te todos)
	public static function getList() {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	// Metodo para busca de usuário
	public static function search($login) {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
	));
	}	

	// Metodo que buscar informações de um usuario autenticado no banco
	public function login ($login, $password) {
		$sql = new Sql();

		$results = $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha=:PASSWORD", array(

			":LOGIN"=>$login,
			":PASSWORD"=>$password,
		)); 
			
			if (count($results) > 0) {
				
				$this->setData($results[0]);
								
			} else {
				throw new Exception("Login e/ou senha inválido.", 1);
				
			}
	} 

	// METODO PARA CARREGAR OS SETERS  
	public function setData($data){
			
			$this -> setUsuario($data['idusuario']);
			$this -> setDeslogin($data['deslogin']);
			$this -> setDessenha($data['dessenha']);
			$this -> setDtcadastro(new DateTime($data['dtcadastro']));
	}

	// Metodo para dar insert usuario utilizando procedure no banco
	public function insert () {

		$sql = new Sql();

		$results = $sql -> select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",
			array
			(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()
			)
		);

		If (count($results) > 0 ) {

			$this->setData($results[0]);
		}
	}

	// Metodo para fazer alterações em usuários 
	public function upDate($login, $password) {
		
		$this->setDeslogin($login);
		$this->setDessenha($password);
		
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin =:LOGIN, dessenha=:PASSWORD WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin($login),
				':PASSWORD'=>$this->getDessenha($password),
				':ID'=>$this->getUsuario()
			) 
		);  

	}

}
?>