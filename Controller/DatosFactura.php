
<?php
require('../Model/Conexion.php');
require('Constants.php');

if (!isset($_SESSION)) 
{
    session_start();
}

$usuario = $_GET['usuario'];
$password = $_GET['password'];


$con = new conexion();
$searchUser = $con->getUser($usuario, $password);
$allUsuarios = $con->getAllUserData();

foreach ($searchUser as $user) 
{

    $tipo = $user['tipo'];
    $id_usuario = $user['id_usu'];
    $nombres = $user['nombre'];
    $password = $user['password'];
    $foto = $user['foto'];
}

// Llamada a la alerta de mensaje
$tipoAlerta = $con->getMensajeAlerta();

foreach ($tipoAlerta as $alertaR) 
{

    $alerta = $alertaR['tipoAlerta'];
    $mensaje = $alertaR['mensaje'];

}


$urlViews = URL_VIEWS;
$imageUser = $foto;
$userLogueado = $nombres;
$datafactura= $con->getDataFactura();
$menuMain = $con->getMenuMain();
require("../Views/DatosFacturaViews.php")

?>