<?php
require('../Model/Conexion.php');
require('Constants.php');



if (!isset($_SESSION)) {
    session_start();
}

$usuarioLogin = $_POST['usuarioLogin'];
$passwordLogin = $_POST['passwordLogin'];

$con = new conexion();

$allUsuarios = $con->getAllUserData();
$menuMain = $con->getMenuMain();



if (isset($_POST['nuevo_usuario'])) {

    $usuario = $_POST['login'];
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    $mensaje = "Se Añadio un nuevo Usuario";
    $alerta = "alert alert-success";

    
    $updateMensaje = $con->updateMensajeAlert($mensaje, $alerta);



    if ($_FILES['userfile']['name'] != "") {

        $ruta = "fotoproducto/";
        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $imagenUsuario = $ruta  . basename($_FILES['userfile']['name']);
    
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
        print("No entro dentro del IF.");
    }



    $registerNewUser=$con->getRegisterNewUser($nombre, $tipo, $usuario, $password, $imagenUsuario);




    }


    if (isset($_GET['idborrar'])) {

        $idUsuario = $_GET['idborrar'];
        $usuarioLogin = $_GET['usuarioLogin'];
        $passwordLogin = $_GET['passwordLogin'];

        $mensaje = "Se Elimino un usuario";
        $alerta = "alert alert-danger";

        $updateMensaje = $con->updateMensajeAlert($mensaje, $alerta);

        $deleteUser = $con->deleteUsuario($idUsuario);



    }

    if (isset($_POST['update_usuario'])) {

        $idUsuarioData = $_POST['idUsuario'];
        $login = $_POST['login'];
        $tipo = $_POST['tipo'];
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $imagen = $_POST['imagen'];

        $usuarioLogin = $_POST['usuarioLogin'];
        $passwordLogin = $_POST['passwordLogin'];

        $mensaje = "Se Edito los datos de  un usuario";
        $alerta = "alert alert-info";

        $updateMensaje = $con->updateMensajeAlert($mensaje, $alerta);


        if ($_FILES['userfileEdit']['name'] != "") {

            $ruta = "fotoproducto/";
            opendir($ruta);

            $imagenUsuario = $ruta . $_FILES['userfileEdit']['name'];

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
            $imagenUsuario = $imagen;
        }

        $updateUser = $con->updateUsuario($login, $tipo, $nombre, $password, $imagenUsuario, $idUsuarioData);


    }


    header("Location: Usuario.php?usuario=$usuarioLogin&password=$passwordLogin&estado='Activo'");



    
    
    