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
	// 
	public function loadById($id) {
		$sql = new Sql();

		$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
			
			if (count($results) > 0) {
				
				$row = $results[0];

				$this -> setUsuario($row['idusuario']);
				$this -> setDeslogin($row['deslogin']);
				$this -> setDessenha($row['dessenha']);
				$this -> setDtcadastro(new DateTime($row['dtcadastro']));
								
			}
	}  

	public function __toString () {
		
		return json_encode(array(
				"idusuario"=>$this->getUsuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s"),
		));
	}
}
 ?>