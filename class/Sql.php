 <?php
        
        class Sql extends PDO {
          
          //atributos 
          private $conn;

          //construtor 
          public function __construct () {
            $this -> conn =  new PDO ("mysql:dbname=dbphp7; host=localhost","root","");
          }

          //metodos 
          
          private function setParams($statement,$parameters = array()) {
                         
                foreach ($parameters as $key => $value) {
            
                $this->setParam($statement,$key, $value);      
            }
          }
          private function setParam ($statement, $key,$value) {
                $statement->bindParam($key, $value);
          }


          public function query ($rawquery,$params= array()) 
          {
          
                $stmt = $this->conn->prepare($rawquery);
                
                $this->setParams($stmt,$params);
                
                $stmt -> execute();

                return $stmt;
          }

          public function select ($rawquery,$params= array()):array 
          {
                
                $stmt = $this->query($rawquery,$params);

               return $stmt->fetchall(PDO::FETCH_ASSOC);
          }
        }    
        
 			?> 
 