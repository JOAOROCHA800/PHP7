 <!DOCTYPE html>
 <html lang="pt-br">
 	<head>
    <meta charset = "UTF-8">
 		<title>PHP 7 - Classe DAO - MY SQL</title>
  	</head>
  	<body>
  		<h1>PDO - Classes  </h1>
  		 
  		<?php
         
        require_once("Config.php"); 
        
        // Select que consulta todos campos da tabela Usuários
        // 
      /* Utilzando as classes SQL e metodo Select
        $sql = new Sql();

        $usuarios = $sql -> select ("Select * from tb_usuarios"); 

        echo json_encode($usuarios);
      */
     
        //  Carrega um usuário por ID
        //  
      /*
        $user = new Usuario();

        $user->loadById(1);

        echo $user;
      */
     
        // Carrega uma lista de usuários 
        // 
      /*  
        $lista = Usuario::getlist();

        echo json_encode($lista);
      */ 
      // Carrega uma lista de usuarios  buscando no campo login determiada letra ou palavra 
      // 
      /*
        $search = usuario::search("re");

        echo json_encode($search);
      */
      // Carrega um usuário usando o login e senha 
      // 
      /*
        $usuario = new Usuario();
       
        $usuario -> login("Joao.Rocha","Rocha@123");
       
        echo $usuario;
      */
      
      // Inseri um novo ususuário utilizando metodo com procedure e contrutor
 			/*
        $aluno = new Usuario("Fernando.Santos","Santos@123");

        $aluno->insert();

        echo $aluno;
      */
      // Alterando dados dos Usuários 
      /*
        $usuario = new Usuario();

        $usuario->loadById(10);

        $usuario->update("Marcos.Lima","Lima@123");

        echo $usuario;
      */
        $usuario = new Usuario();
        $usuario->loadById(15);
        $usuario->delete();
        echo $usuario;
      ?>  		     
  	</body>
 <html/>
