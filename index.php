 <!DOCTYPE html>
 <html lang="pt-br">
 	<head>
    <meta charset = "UTF-8">
 		<title>PHP 7 - Classe DAO - MY SQL</title>
  	</head>
  	<body>
  		<h1>PDO - Classes  </h1>
  		<pre>
  		<?php
         
        require_once("Config.php"); 
        
        $sql = new Sql();

        $usuarios = $sql -> select ("Select * from tb_usuarios"); 

        echo json_encode($usuarios);
        

 			?> 
  		</pre>
      
  	</body>
 <html/>
