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

if (isset($_POST['update_data_idioma'])) {

    $usuarioLogin = $_POST['usuarioLogin'];
    $passwordLogin = $_POST['passwordLogin'];
    $idIdiomaSytem = $_POST['idIdioma'];
    $idioma = $_POST['idioma'];

    if ($idioma == "Espaniol") {
        $idiomaConfiguration = array(
            array('1', 'Principal'),
            array('2', 'Configuracion'),
            array('3', 'Proveedores'),
            array('4', 'Clientes'),
            array('5', 'Productos'),
            array('6', 'Inventario'),
            array('7', 'Ventas'),
            array('8', 'Cuentas'),
            array('9', 'Pedidos'),
            array('10', 'Consolidar'),
            array('11', 'Reporte'),
            array('12', 'Reportes Graficos')
        );

        foreach ($idiomaConfiguration as $idiomaElegido) {
            list($idIdioma, $opcionMenu) = $idiomaElegido;
            $updateIdiomaMenu = $con->updateIdiomaSistem($opcionMenu, $idIdioma);
        }


    }

    if ($idioma == "Portugues") {

        $idiomaConfiguration = array(
            array('1', 'Diretor'),
            array('2', 'Configuração'),
            array('3', 'Vendedores'),
            array('4', 'Clientes'),
            array('5', 'Produtos'),
            array('6', 'Inventário'),
            array('7', 'Vendas'),
            array('8', 'Contas'),
            array('9', 'Pedidos'),
            array('10', 'Consolidar'),
            array('11', 'Relatório'),
            array('12', 'Relatórios Gráficos')
        );

        foreach ($idiomaConfiguration as $idiomaElegido) {
            list($idIdioma, $opcionMenu) = $idiomaElegido;
            $updateIdiomaMenu = $con->updateIdiomaSistem($opcionMenu, $idIdioma);
        }


    }

    if ($idioma == "Ingles") {

        $idiomaConfiguration = array(
            array('1', 'Main'),
            array('2', 'Setting'),
            array('3', 'vendors'),
            array('4', 'Customers'),
            array('5', 'Products'),
            array('6', 'Inventory'),
            array('7', 'Sales'),
            array('8', 'Accounts'),
            array('9', 'Orders'),
            array('10', 'Consolidate'),
            array('11', 'Report'),
            array('12', 'Graphic Reports')
        );

        foreach ($idiomaConfiguration as $idiomaElegido) {
            list($idIdioma, $opcionMenu) = $idiomaElegido;
            $updateIdiomaMenu = $con->updateIdiomaSistem($opcionMenu, $idIdioma);
        }
    }


    $mensaje = "Se Actualizo  los datos del Idioma correctamente !!!";
    $alerta = "alert alert-info";

    $updateMensaje = $con->updateMensajeAlert($mensaje, $alerta);
    $updateDatosIdioma = $con->updateDataIdioma($idioma, $idIdiomaSytem);



}

header("Location: Languaje.php?usuario=$usuarioLogin&password=$passwordLogin&estado='Activo'");
