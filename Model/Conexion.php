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

    public function getDataFactura()
    {
        $stmt = $this->con->prepare("SELECT * FROM datos ");
        $stmt->execute();
        $result = $stmt->get_result();

        $retorno = [];
        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;
    }


    public function updateDataFactura($iddatos, $propietario, $razon, $direccion, $nro, $telefono)
    {
        $stmt = $this->con->prepare("UPDATE datos SET propietario = ?,  razon= ?, direccion = ?, nro = ?, telefono = ? WHERE iddatos = ?");
        $stmt->bind_param("sssssi", $propietario, $razon, $direccion, $nro, $telefono, $iddatos);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getMoneda()
    {
        $stmt = $this->con->prepare("SELECT * FROM moneda ");
        $stmt->execute();
        $result = $stmt->get_result();

        $retorno = [];
        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;
    }

    public function updateDataMoneda($idMoneda, $pais, $tipoMoneda, $contexto)
    {
        $stmt = $this->con->prepare("UPDATE moneda SET pais = ?,  tipoMoneda= ?, contexto = ? WHERE idMoneda = ?");
        $stmt->bind_param("sssi", $pais, $tipoMoneda, $contexto, $idMoneda);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /* Modulo Idioma */

    public function getIdioma()
    {
        $stmt = $this->con->prepare("SELECT * FROM idioma ");

        $stmt->execute();
        $result = $stmt->get_result();

        $retorno = [];
        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;
    }

    public function updateDataIdioma($idioma, $idIdiomaSytem)
    {

        $stmt = $this->con->prepare("UPDATE idioma SET idioma = ? where idIdioma = ?");
        $stmt->bind_param("si", $idioma, $idIdiomaSytem);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function updateIdiomaSistem($opcionMenu, $idIdioma)
    {

        $stmt = $this->con->prepare("UPDATE menu SET opcion = ? where idmenu = ?");
        $stmt->bind_param("si", $opcionMenu, $idIdioma);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /* Modulo de proveedores */
    public function getAllProveedor()
    {
        $stmt = $this->con->prepare("SELECT * FROM proveedor ");
        $stmt->execute();
        $result = $stmt->get_result();
        $retorno = [];

        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;
    }

    public function deleteProveedor($idproveedor)
    {

        $stmt = $this->con->prepare("DELETE FROM proveedor  WHERE idproveedor = ?");
        $stmt->bind_param("s", $idproveedor);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function registerNewProveedor($proveedor, $responsable, $direccion, $telefono, $fechaRegistro)
    {

        $estado = "A";
        $fechaAviso = "2024-01-01";
        $valor = 0;
        $valorCobrado = 0;
        $saldo = 0;

        $stmt = $this->con->prepare("INSERT INTO proveedor (`proveedor`, `responsable`, `fechaRegistro`, `direccion`, `telefono`,`estado`,`fechaAviso`,`valor`,`valorCobrado`,`saldo`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");
        $stmt->bind_param("ssssssssss", $proveedor, $responsable, $fechaRegistro, $direccion, $telefono, $estado, $fechaAviso, $valor, $valorCobrado, $saldo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function updateProveedor($idProveedor, $proveedor, $responsable, $direccion, $telefono, $fechaRegistro){


        $stmt = $this->con->prepare("UPDATE proveedor SET proveedor = ?,  responsable= ?, fechaRegistro = ?, direccion = ?, telefono = ?, fechaRegistro = ? 
        WHERE idproveedor = ?");
        $stmt->bind_param("ssssssi", $proveedor, $responsable, $fechaRegistro, $direccion, $telefono, $fechaRegistro, $idProveedor);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    /* Modulo de Clientes */

    public function getAllCliente(){
        $stmt = $this->con->prepare("SELECT * FROM cliente ");

        $stmt->execute();
        $result = $stmt->get_result();

        $retorno = [];
        while ($fila = $result->fetch_assoc()) {
            $retorno[] = $fila;
        }
        return $retorno;

    }

    public function deleteClient($idcliente){

        $stmt = $this->con->prepare("DELETE FROM cliente WHERE idcliente = ?");
        $stmt->bind_param("s", $idcliente);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function registerNewCliente($destino,$nombre,$apellido,$direccion,$telefonoFijo,$telefonoCelular,$email,$fechaRegistro,$ci){
       
        $contactoReferencia = 4533;
        $telefonoReferencia = 1111;
        $observaciones = "Ninguna";
        $stmt = $this->con->prepare("INSERT INTO cliente(`foto`,`nombre`,`apellido`,`direccion`,`telefonoFijo`,`telefonoCelular`,`email`,`contactoReferencia`,`telefonoReferencia`,`observaciones`,`fechaRegistro`,`ci`)
                                                  VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssss", $destino,$nombre,$apellido,$direccion,$telefonoFijo,$telefonoCelular,$email,$contactoReferencia,$telefonoReferencia,$observaciones,$fechaRegistro,$ci);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

 public function updateClient($idcliente, $destino, $nombre, $apellido, $direccion, $telefonoFijo, $telefonoCelular, $email, $fechaRegistro, $ci){

    $stmt = $this->con->prepare("UPDATE cliente SET foto = ?, nombre = ?, apellido = ?,direccion = ?, telefonoFijo = ?, telefonoCelular = ?, email = ?, fechaRegistro = ?, ci = ? WHERE idcliente = ?");
    $stmt->bind_param("sssssssssi", $destino, $nombre, $apellido, $direccion, $telefonoFijo, $telefonoCelular,$email,$fechaRegistro,$ci,$idcliente);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
 }

 /* Modulo de productos*/

 public function getAllProducto(){
    $stmt = $this->con->prepare("SELECT * FROM producto ");

    $stmt->execute();
    $result = $stmt->get_result();

    $retorno = [];
    while ($fila = $result->fetch_assoc()) {
        $retorno[] = $fila;
    }
    return $retorno;

 }


 public function deleteProduct($idproducto){
    $stmt = $this->con->prepare("DELETE FROM producto WHERE idproducto = ?");
    $stmt->bind_param("s", $idproducto);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
 }


 public function registerNewProducto($destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro,$precioVenta,$tipoproducto,$proveedor,$precioCompra){


      $stmt = $this->con->prepare("  INSERT INTO producto
(imagen, codigo, nombreProducto, cantidad, fechaRegistro, precioVenta, tipo, proveedor, precioCompra)
 VALUES(?,?,?,?,?,?,?,?,?)");
   
    $stmt->bind_param("sssssssss",$destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro,$precioVenta,$tipoproducto,$proveedor,$precioCompra);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }

 }


 public function updateProduct($destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro,$precioVenta,$tipoproducto,$proveedor,$precioCompra,$idproducto)
{

    $proveedor = 6;
    
    $stmt = $this->con->prepare("UPDATE producto
SET imagen=?, codigo= ?, nombreProducto=?, cantidad=?, fechaRegistro=?, precioVenta=?, tipo=?, proveedor=?, precioCompra=?
WHERE idproducto=?");
    $stmt->bind_param("sssssssssi",$destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro,$precioVenta,$tipoproducto,$proveedor,$precioCompra,$idproducto);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}







 /* Modulo tipo de producto */

 public function getAllTipoProducto(){
    $stmt = $this->con->prepare("SELECT * FROM tipoproducto ");

    $stmt->execute();
    $result = $stmt->get_result();

    $retorno = [];
    while ($fila = $result->fetch_assoc()) {
        $retorno[] = $fila;
    }
    return $retorno;

    
 }


 /* Modulo de Activos*/
 public function getAllActivos()   {
    $stmt = $this->con->prepare("SELECT * FROM activos ");

    $stmt->execute();
    $result = $stmt->get_result();

    $retorno = [];
    while ($fila = $result->fetch_assoc()) {
        $retorno[] = $fila;
    }
    return $retorno;

 } 

 public function deleteActivo($idactivo){
    $stmt = $this->con->prepare("DELETE FROM activos WHERE idactivo = ?");
    $stmt->bind_param("s", $idactivo);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
 }


 public function registerNewActivo($destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro){
    $stmt = $this->con->prepare("INSERT INTO activos(imagen, codigo, nombreProducto, cantidad, fechaRegistro)
     VALUES(?,?,?,?,?)");
       
        $stmt->bind_param("sssss",$destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
 }


 public function updateActivo($destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro,$idactivo)
 {

    $stmt = $this->con->prepare("  UPDATE activos
SET imagen=?, codigo=?, nombreProducto=?, cantidad=?, fechaRegistro=?
WHERE idactivo=?");
        $stmt->bind_param("sssssi",$destino,$codigo,$nombreProducto,$cantidad,$fechaRegistro,$idactivo);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

 }

}
