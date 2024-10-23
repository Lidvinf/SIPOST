<?php 

class conexion {
    private $user;
    private $password;
    private $server;
    private $database;
    private $con;

    public function __construct(){
        $this->user = 'root';
        $this->password = '';
        $this->server = 'localhost';
        $this->database = 'sipost';


    $this->con = new mysqli($this->server, $this->user, $this->password, $this->database);
   
    if ($this->con->connect_error) {
        die("Conexión fallida: " . $this->con->connect_error);
    }
    
}

    public function getUser($usuario,$password){


 $stmt = $this->con->prepare("SELECT * FROM usuarios WHERE login = ? AND password = ?");
 $stmt->bind_param("ss",$usuario, $password);
 $stmt->execute();
 $result = $stmt->get_result();

$retorno =[];
while ($fila = $result->fetch_assoc()) {
$retorno[] = $fila;
}
return $retorno;
    }

 
   
}

?>