<?php
require('../Model/Conexion.php');
require('Constants.php');

if (!isset($_SESSION)) {
    session_start();
}

$usuarioLogin = $_POST['usuarioLogin'];
$passwordLogin = $_POST['passwordLogin'];

$con = new conexion();


if (isset($_POST['nuevo_Producto'])) {

    $codigo= $_POST['codigo'];
    $nombreProducto= $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $fechaRegistro = $_POST['fechaRegistro'];
    $proveedor =null;

    if($_FILES['userfile']['name']!=""){
        $ruta = "fotoproducto/";
        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $destino = $ruta  . basename($_FILES['userfile']['name']);

        $nombre_archivo = ADDRESS . basename($_FILES['userfile']['name']);
        $tipo_archivo = $_FILES['userfile']['type'];
        $tamano_archivo = $_FILES['userfile']['size'];

        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 5000000))) {
            printf("La extensión o el tamaño de los archivos no es correcta, Se permiten archivos .gif, .jpeg o .png de 5 Mb máximo");
        } else {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $nombre_archivo)) {
                // Se subió correctamente
                printf("El archivo se subió correctamente.");
            } else {
                printf("Ocurrió algún error al subir el archivo. No pudo guardarse");
            }
        }
    } else {
        $imagenUsuario = "fotoUsuario/user.png";
        $destino = "fotoUsuario/user.png";
        print("No entro dentro del IF.");
    }

 

    $mensaje = "Se registro un nuevo Activo  correctamente !!!";
    $alerta = "alert alert-success";

    $updateMensaje = $con->updateMensajeAlert($mensaje, $alerta);
    $registerActivo = $con->registerNewActivo($destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro);


}



if (isset($_GET['idborrar'])) {
    $usuarioLogin = $_GET['usuarioLogin'];
    $passwordLogin = $_GET['passwordLogin'];
    $idborrar = $_GET['idborrar'];

    $mensaje = "Se elimino  los datos del producto correctamente !!!";
    $alerta = "alert alert-danger";
    $updateMensaje = $con->updateMensajeAlert($mensaje, $alerta);

    $deleteActivo = $con->deleteActivo($idborrar);


}


if (isset($_POST['update_producto'])) {

    $idproducto = $_POST['idactivo'];
    $imagen = $_POST['imagen'];
    $codigo= $_POST['codigo'];
    $nombreProducto= $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $fechaRegistro = date("Y-m-d");
    $proveedor =null;


    if($_FILES['userfileEdit']['name']!=""){
        $ruta = "fotoproducto/";
        opendir($ruta);

        $destino = $ruta . $_FILES['userfileEdit']['name'];

        $nombre_archivo = ADDRESS . $_FILES['userfileEdit']['name'];
        $tipo_archivo = $_FILES['userfileEdit']['type'];
        $tamano_archivo = $_FILES['userfileEdit']['size'];

        $nuevo_archivo = "fotoproducto/" . substr($tipo_archivo, 6, 4);

        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) )) {
       //     cuadro_error("La extensión o el tamaño de los archivos no es correcta, Se permiten archivos .gif o .jpg de 5 Mb máximo");

        }else {
            if (move_uploaded_file($_FILES['userfileEdit']['tmp_name'], $nombre_archivo)) {
             //   rename($nombre_archivo, $nuevo_archivo);
            } else {
       //         cuadro_error("Ocurrió algún error al subir el archivo. No pudo guardarse");
            }
        }

    }else {
        $destino = $imagen;
    }

    $mensaje = "Se Actualizo  los datos del Producto correctamente !!!";
    $alerta = "alert alert-info";

    $updateMensaje = $con->updateMensajeAlert($mensaje, $alerta);

    $updateActivoData = $con->updateActivo($destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro,$idproducto);




}




$menuMain = $con->getMenuMain();
header("Location: Inventario.php?usuario=$usuarioLogin&password=$passwordLogin&estado='Activo'");
