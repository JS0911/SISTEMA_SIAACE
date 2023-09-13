
<?php
 class Conexion {
    private $hostName = 'localhost';
    private $dbName = 'siaace';
    private $userName = 'root';
    private $password = 'lunamar123';

    #Abrir conexión al servidor de MySQL
    public function abrirConexionDB(){
        $conn = mysqli_connect($this->hostName, $this->userName, $this->password, $this->dbName);
        return $conn;
    }
 }
?>