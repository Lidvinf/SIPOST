<?php

class conexion
{
    private $user;
    private $password;
    private $server;
    private $database;
    private $con;

    public function __construct()
    {
        $this->user = 'root';
        $this->password = '';
        $this->server = 'localhost';
        $this->database = 'sipost';

        $this->con = new mysqli($this->server, $this->user, $this->password, $this->database);

        if ($this->con->connect_error) {
            die("Conexión fallida: " . $this->con->connect_error);
        }
    }

    public function getUser($usuario, $password)
    {

        $stmt = $this->con->prepare("SELECT * FROM usuarios WHERE login = ? AND password = ?");
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        $retorno = [];
        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;
    }


    public function getMenuMain()
    {
        $stmt = $this->con->prepare("SELECT * FROM menu ");
        //    $stmt->bind_param("ss",'', '');
        $stmt->execute();
        $result = $stmt->get_result();
        $retorno = [];
        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;
    }

    public function getAllUserData()
    {
        $stmt = $this->con->prepare("SELECT * FROM usuarios ");
        //    $stmt->bind_param("ss",'', '');
        $stmt->execute();
        $result = $stmt->get_result();
        $retorno = [];
        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;
    }

    public function getRegisterNewUser($usuario, $tipo, $nombre, $password, $imageUsuario)
    {
        $stmt = $this->con->prepare("INSERT INTO usuarios (`login`, `tipo`, `nombre`, `password`, `foto`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $usuario, $tipo, $nombre, $password, $imageUsuario);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateMensajeAlert($mensaje, $alerta)
    {

        $stmt = $this->con->prepare("UPDATE alerta SET tipoAlerta = ?,
                                            mensaje = ?  WHERE alertaId = 1");
        $stmt->bind_param("ss", $alerta, $mensaje,);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUsuario($login, $tipo, $nombre, $password, $foto, $idUsuario)
    {
        $stmt = $this->con->prepare("UPDATE usuarios SET login = ?, tipo = ?, nombre = ?, password = ?, foto = ? WHERE id_usu = ?");
        $stmt->bind_param("sssssi", $login, $tipo, $nombre, $password, $foto, $idUsuario);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    


    public function deleteUsuario($idusuario)
    {

        $stmt = $this->con->prepare("DELETE FROM USUARIOS  WHERE id_usu = ?");
        $stmt->bind_param("s", $idusuario);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

public function getMensajeAlerta()
{
    $stmt = $this->con->prepare("SELECT * FROM alerta ");
 //   $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $retorno = [];
    while ($fila = $result->fetch_assoc()) {
        $retorno[] = $fila;
    }
    return $retorno;
}

}
