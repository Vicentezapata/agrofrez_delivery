<?php
/**
 * Description of Consultas
 *
 * @author Tiburon
 */
  // copiar el codigo de la clase en el codigo actual.
include 'Conexion DB.php';
class ClaseCrud {
    public function insertarDatosUsuario($email,$clave) // parametros de la funcion.
    {
        $query = "insert into tblusuario (tblUsuarioCorreo,tblUsuarioContrasennia,tblUsuarioPrivilegio) values ('$email','$clave', 0)";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }
    public function restablecerClaveUser($email,$clave) // parametros de la funcion.
    {
        $query = "UPDATE `tblusuario` SET `tblUsuarioContrasennia` = '$clave' WHERE `tblusuario`.`tblUsuarioCorreo` = '$email';";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        $from = "admin@agrofrezdelivery.cl";
        $to = $email;
        $subject = "Cambio de contraseña";
        $message = "La contraseña de tu cuenta de Agrofrez delivery a sido restablecida, debes usar esta de manera temporal:".$clave." , cambiar tu contraseña inicia sesión y luego ve a la sección de ajustes y podrás colocar la que gustes";
        $headers = "De:" . $from;
        mail($to,$subject,$message, $headers);
        return $nfilas; // devuelve el numero de filas insertadas.

        mysqli_close($link);
    }

    public function buscarLogin($correo,$clave)
            {
        $query = "select tblUsuarioCorreo,tblUsuarioContrasennia,tblUsuarioPrivilegio  from tblusuario where tblUsuarioCorreo='".$correo."' and tblUsuarioContrasennia='".$clave."'";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        $consulta=mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        if($nfilas==1){
        session_start();
        $fila=$consulta->fetch_assoc();
        $privilegio=$fila['tblUsuarioPrivilegio'];
        $correo=$fila['tblUsuarioCorreo'];
        $_SESSION["correoAgrofrez"]=$correo;
        $_SESSION["tipoAgrofrez"]=$privilegio;
       }
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
        
        
    }   
    public function cantidadProductosCarro()
            {
        $correo=$_SESSION["correoAgrofrez"];
        $query = "SELECT COUNT(`tblProductosCodigoDeBarra`)  AS cantidad FROM `tblcarro` WHERE `tblUsuarioCorreo` = '".$correo."'";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        $consulta=mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        if($nfilas==1){
        $fila=$consulta->fetch_assoc();
        $privilegio=$fila['cantidad'];
       }
        return $privilegio; // devuelve el numero productos encontrados
        mysqli_close($link);
        
        
    }   
    public function insetarDetalleProductosCarro($idPedido)
            {
        $correo=$_SESSION["correoAgrofrez"];
        $query = "SELECT`tblProductosCodigoDeBarra` as SKU,`tblCarroCantidad` AS cantidad,IFNULL(tblcarro.descuento, 0) as descuentoCupon FROM `tblcarro` WHERE `tblUsuarioCorreo` = '".$correo."'";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        $consulta=mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        $registro=0;
        while($fila=$consulta->fetch_assoc()){
                  $sku=$fila['SKU'];
                  $cantidad=$fila['cantidad'];
                  $cuponDesc=$fila['descuentoCupon'];
                  $clasecrud = new ClaseCrud();
                  
                  $registro=$registro+$clasecrud->insertarDetallePedido($sku,$cantidad,$idPedido,$cuponDesc);

       }
        return $registro; // devuelve el numero productos encontrados
        mysqli_close($link);
        
        
    }
    
    public function insetarDetalleProductosCarroValidado($idPedido,$correo)
            {
        $query = "SELECT`tblProductosCodigoDeBarra` as SKU,`tblCarroCantidad` AS cantidad,IFNULL(tblcarro.descuento, 0) as descuentoCupon FROM `tblcarro` WHERE `tblUsuarioCorreo` = '".$correo."'";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        $consulta=mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        $registro=0;
        while($fila=$consulta->fetch_assoc()){
                  $sku=$fila['SKU'];
                  $cantidad=$fila['cantidad'];
                  $cuponDesc=$fila['descuentoCupon'];
                  $clasecrud = new ClaseCrud();
                  
                  $registro=$registro+$clasecrud->insertarDetallePedido($sku,$cantidad,$idPedido,$cuponDesc);

       }
        return $registro; // devuelve el numero productos encontrados
        mysqli_close($link);
        
        
    }






    public function insertarCategoria($categoria) // parametros de la funcion.
    {
        $categoriaNombre=utf8_decode($categoria);
        $query = "insert into tbltipo ( tblTipoNombre) values ('$categoriaNombre')";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }


    public function insertarSubCategoria($subcategoria,$categoriaId) // parametros de la funcion.
    {
        $subcategoriaNombre=utf8_decode($subcategoria);
        $query = "insert into  tblsubtipo (tblSubTipoNombre,tblTipoId) values ('$subcategoriaNombre',$categoriaId)";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }





    public function ingresarDatosUsuario($nombre,$clave,$apellido,$fechaNac,$fono,$genero,$num,$calle,$comuna) // parametros de la funcion.
    {
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        session_start();
        $email=$_SESSION["correoAgrofrez"];
        $queryPersona = 'SELECT tblUsuarioCorreo FROM `tblpersona` WHERE `tblUsuarioCorreo`="'.$email.'"';
        $queryDireccion = 'SELECT tblPersonaId FROM `tbldireccion` WHERE `tblPersonaId`=(select `tblPersonaId` from tblpersona where tblUsuarioCorreo="'.$email.'")';

        $resulatdoConsultaPersona=mysqli_query($link,$queryPersona);
        $cantidadDeRegistrosExistentesPer=mysqli_num_rows($resulatdoConsultaPersona);

        $resulatdoConsultaDireccion=mysqli_query($link,$queryDireccion);
        $cantidadDeRegistrosExistentesDirec=mysqli_num_rows($resulatdoConsultaDireccion);

        if ($clave!=="") {
                $queryActUser  = "UPDATE `tblusuario` SET `tblUsuarioContrasennia` = '$clave' WHERE `tblusuario`.`tblUsuarioCorreo` = '$email';";
                 $resulatdoConsultaActUser=mysqli_query($link,$queryActUser);
                 $afectados= mysqli_affected_rows($resulatdoConsultaActUser);
        }
         

        if ($cantidadDeRegistrosExistentesPer==1) {
             $queryId="SELECT tblPersonaId FROM tblpersona where tblUsuarioCorreo='$email'";
             $consulta=mysqli_query($link, $queryId);
             $cantidadDeRegistrosExistentes=mysqli_num_rows($consulta);
             $fila=$consulta->fetch_assoc();
             $idPersona=$fila['tblPersonaId'];
             $afectados=ClaseCrud::actualizarDatosPersonales($email,$nombre,$apellido,$fechaNac,$fono,$genero,$idPersona);
        }
        if($cantidadDeRegistrosExistentesPer==0){
            $afectados=ClaseCrud::ingresarDatosPersonales($email,$nombre,$apellido,$fechaNac,$fono,$genero);
        }
        if ($cantidadDeRegistrosExistentesDirec==1) {
             $afectados=ClaseCrud::actualizarDatosDireccion($num,$calle,$comuna,$email);
        }
        if($cantidadDeRegistrosExistentesDirec==0){
            $afectados=ClaseCrud::ingresarDatosDireccion($num,$calle,$comuna,$email);
        }

        return $afectados; // devuelve el numero de filas insertadas.
        mysqli_close($link);
        
    }




    public function ingresarDatosPersonales($email,$nombre,$apellido,$fechaNac,$fono,$genero) // parametros de la funcion.
    {
        $query = "INSERT INTO `tblpersona` (`tblUsuarioCorreo`, `tblPersonaNombre`, `tblPersonaApellido`, `tblPersonaFechaNacimiento`, `tblPersonaFono`, `tblPersonaGeneroId`) VALUES ('$email', '$nombre', '$apellido', '$fechaNac', $fono, $genero);";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }




    public function ingresarDatosDireccion($num,$calle,$comuna,$email) // parametros de la funcion.
    {
        $query = "INSERT INTO `tbldireccion` (`tblDireccionId`, `tblDireccionNombre`, `tblDireccionNumero`, `tblComunaId`, `tblPersonaId`) VALUES (NULL, '$calle', '$num', '$comuna', (SELECT `tblPersonaId` FROM `tblpersona` WHERE `tblUsuarioCorreo`='$email'))";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }


    public function insertarLogProductos($sku,$estado) // parametros de la funcion.
    {
        $query = "INSERT INTO `tbllogproductos` (`tblProductosCodigoDeBarra`, `tblLogProductosFecha`, `tblLogProductosEstado`) VALUES ('$sku', NOW(), '$estado' )";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }

    public function insertarEnCarro($sku,$cantidad) // parametros de la funcion.
    {
        session_start();
        $correo=$_SESSION["correoAgrofrez"];
         $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.

        $queryProductoExistenteEnCarro = "SELECT `tblProductosCodigoDeBarra`, `tblCarroCantidad` FROM `tblcarro` WHERE `tblProductosCodigoDeBarra`=$sku AND `tblUsuarioCorreo`='$correo'";
        $resulatdoConsultaProductoExistenteEnCarro=mysqli_query($link,$queryProductoExistenteEnCarro);
        $cantidadDeRegistrosExistentesPer=mysqli_num_rows($resulatdoConsultaProductoExistenteEnCarro);
        if ($cantidadDeRegistrosExistentesPer==0) {
            $date = date("Y-m-d H:i:s");
            $query = "INSERT INTO `tblcarro` (`tblUsuarioCorreo`, `tblProductosCodigoDeBarra`, `tblCarroCantidad`,Fecha) VALUES ('$correo',$sku,$cantidad,'$date')";
            $queryHistorial = "INSERT INTO `tblhistorialcarro` (`tblUsuarioCorreo`, `tblProductosCodigoDeBarra`, `tblCarroCantidad`,Fecha) VALUES ('$correo',$sku,$cantidad,'$date')";
            // Nombre de clase cuando es otra clase.
            mysqli_query($link, $queryHistorial);
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
        }
        else{
            $fila=$resulatdoConsultaProductoExistenteEnCarro->fetch_assoc();
            $cantidadEnCarro=$fila['tblCarroCantidad'];
            $queryHistorial = "UPDATE `tblhistorialcarro` SET `tblCarroCantidad` = $cantidadEnCarro+$cantidad WHERE `tblhistorialcarro`.`tblUsuarioCorreo` = '$correo' and `tblhistorialcarro`.`tblProductosCodigoDeBarra`=$sku";
            $query = "UPDATE `tblcarro` SET `tblCarroCantidad` = $cantidadEnCarro+$cantidad WHERE `tblcarro`.`tblUsuarioCorreo` = '$correo' and `tblcarro`.`tblProductosCodigoDeBarra`=$sku";
            // Nombre de clase cuando es otra clase.
            mysqli_query($link, $queryHistorial);
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
        }

        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }
     public function insertarLogCarro($sku) // parametros de la funcion.
    {
         $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.

        $queryProductoExistenteEnCarro = "SELECT `tblProductosCodigoDeBarra`, `tblLogCarroCantidad` FROM `tbllogcarro` WHERE `tblProductosCodigoDeBarra`='$sku' ";
        $resulatdoConsultaProductoExistenteEnCarro=mysqli_query($link,$queryProductoExistenteEnCarro);
        $cantidadDeRegistrosExistentesCarro=mysqli_num_rows($resulatdoConsultaProductoExistenteEnCarro);
        if ($cantidadDeRegistrosExistentesCarro==0) {
            $query = "INSERT INTO `tbllogcarro` (`tblProductosCodigoDeBarra`, `tblLogCarroCantidad`) VALUES ('$sku',1)";
            // Nombre de clase cuando es otra clase.
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
        }
        else{
            $fila=$resulatdoConsultaProductoExistenteEnCarro->fetch_assoc();
            $cantidadEnCarro=$fila['tblLogCarroCantidad'];
            $query = "UPDATE `tbllogcarro` SET `tblLogCarroCantidad` = $cantidadEnCarro+1 WHERE `tbllogcarro`.`tblProductosCodigoDeBarra` = '$sku'";
           
            // Nombre de clase cuando es otra clase.
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
        }

        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }
    public function insertarPedido($caja,$bolsa,$metodoPago,$comment) // parametros de la funcion.
    {
        session_start();
        $correo=$_SESSION["correoAgrofrez"];
        $query = "INSERT INTO tblpedido (tblPersonaId,tblPedidoComentario,tblPedidoFecha,tblPedidoEstado,tblMedioPagoId,tblPagoId,tblPedidoBolsa,tblPedidoCaja) VALUES ((SELECT tblPersonaId FROM tblpersona WHERE tblUsuarioCorreo='".$correo."'),'$comment',NOW(),1,$metodoPago,1,'$bolsa','$caja')";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        $cantProductos=0;
        if($nfilas >0){
            $clasecrud = new ClaseCrud(); 
            $idPedido=mysqli_insert_id($link);
            $cantProductos=$clasecrud->insetarDetalleProductosCarro($idPedido);

            

        }
        return $idPedido; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }
    
    
    public function insertarPedidoValidado($correo) // parametros de la funcion.
    {
        $query = "INSERT INTO tblpedido (tblPersonaId,tblPedidoComentario,tblPedidoFecha,tblPedidoEstado,tblMedioPagoId,tblPagoId,tblPedidoBolsa,tblPedidoCaja) VALUES ((SELECT tblPersonaId FROM tblpersona WHERE tblUsuarioCorreo='".$correo."'),'Pedido validado por el administrador',NOW(),1,1,1,'Sin esp.','Sin esp.')";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        $cantProductos=0;
        if($nfilas >0){
            $clasecrud = new ClaseCrud(); 
            $idPedido=mysqli_insert_id($link);
            $cantProductos=$clasecrud->insetarDetalleProductosCarroValidado($idPedido,$correo);

            

        }
        return $idPedido; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }

    public function insertarDetallePedido($sku,$cantidad,$idPedido,$cuponDesc) // parametros de la funcion.
    {
        $correo=$_SESSION["correoAgrofrez"];

        $query = "INSERT INTO tblpedidoproductos (tblPedidoId,tblProductosCodigoDeBarra,tblCarroCantidad,tblpedidoproductosPrecio,tblpedidoproductosDescuento,tblPedidoProductoCupon) VALUES (".$idPedido.",$sku,$cantidad,(SELECT tblProductosPrecio FROM tblproductos WHERE tblProductosCodigoDeBarra=$sku),(SELECT tblProductosDescuento FROM tblproductos WHERE tblProductosCodigoDeBarra=$sku),$cuponDesc)";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }




    public function actualizarDatosPersonales($email,$nombre,$apellido,$fechaNac,$fono,$genero,$idPersona) // parametros de la funcion.
    {
        $query = "UPDATE `tblpersona` SET `tblPersonaNombre` = '$nombre', `tblPersonaApellido` = '$apellido', `tblPersonaFechaNacimiento` = ' $fechaNac', `tblPersonaFono` = '$fono', `tblPersonaGeneroId` = '$genero' WHERE `tblpersona`.`tblPersonaId` = $idPersona";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }




    public function actualizarDatosDireccion($num,$calle,$comuna,$email) // parametros de la funcion.
    {
        $query = "UPDATE `tbldireccion` SET `tblDireccionNombre` = '$calle', `tblDireccionNumero` = '$num', `tblComunaId` = '$comuna' WHERE `tblPersonaId` = (SELECT `tblPersonaId` FROM tblpersona where tblUsuarioCorreo='$email')";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }
    
    public function actualizarProducto($sku,$stock,$especificacion,$precio,$descuento) // parametros de la funcion.
    {
        $query = "UPDATE `tblproductos` SET `tblProductosEspecificacion` = '$especificacion', `tblProductosStock` = $stock, `tblProductosPrecio` = $precio, `tblProductosDescuento` = $descuento WHERE `tblProductosCodigoDeBarra` = $sku";
        $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
        // Nombre de clase cuando es otra clase.
        mysqli_query($link, $query);
        $nfilas = mysqli_affected_rows($link);
        return $nfilas; // devuelve el numero de filas insertadas.
        mysqli_close($link);
    }


    public function eliminarProducto($sku) // parametros de la funcion.
        {
            $query = "DELETE FROM `tblproductos` WHERE `tblproductos`.`tblProductosCodigoDeBarra` = $sku";
            $pathImagenQuery="SELECT `tblProductosImagen` FROM `tblproductos` WHERE `tblProductosCodigoDeBarra`=$sku";
            $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
                // Nombre de clase cuando es otra clase.
            $pathImagenQueryResultado=mysqli_query($link, $pathImagenQuery);
            $fila = mysqli_fetch_row($pathImagenQueryResultado);
            $pathImagen = $fila[0];
            if (!unlink($pathImagen)){
            //si no puede ser muestro un mensaje 🙂
            echo "no se pudo borrar el archivo :".$pathImagen;
            }
            else{
                mysqli_query($link, $query);
                $nfilas = mysqli_affected_rows($link);
                return $nfilas; // devuelve el numero de filas insertadas.
                
            }
            mysqli_close($link);
        }


        public function eliminarCategoria($categoriaId) // parametros de la funcion.
        {
            $query = "DELETE FROM `tbltipo` WHERE `tbltipo`.`tblTipoId` = $categoriaId";
            $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
                // Nombre de clase cuando es otra clase.
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
            return $nfilas; // devuelve el numero de filas insertadas.
                
            
            mysqli_close($link);
        }
        public function eliminarSubCategoria($categoriaId) // parametros de la funcion.
        {
            $query = "DELETE FROM `tblsubtipo` WHERE `tblsubtipo`.`tblSubTipoId` = $categoriaId";
            $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
                // Nombre de clase cuando es otra clase.
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
            return $nfilas; // devuelve el numero de filas insertadas.
                
            
            mysqli_close($link);
        }

        public function eliminarDelCarro($sku) // parametros de la funcion.
        {
            session_start();
            $correo=$_SESSION["correoAgrofrez"];
            $query = "DELETE FROM `tblcarro` WHERE `tblcarro`.`tblUsuarioCorreo` = '$correo' and `tblcarro`.`tblProductosCodigoDeBarra` = $sku";
            $queryHistorial = "DELETE FROM `tblhistorialcarro` WHERE `tblhistorialcarro`.`tblUsuarioCorreo` = '$correo' and `tblhistorialcarro`.`tblProductosCodigoDeBarra` = $sku";
            $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
                // Nombre de clase cuando es otra clase.
            mysqli_query($link, $queryHistorial);
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
            return $nfilas; // devuelve el numero de filas insertadas.
                
            
            mysqli_close($link);
        }
         public function vaciarCarro($sku) // parametros de la funcion.
        {
            session_start();
            $correo=$_SESSION["correoAgrofrez"];
            $query = "DELETE FROM `tblcarro` WHERE `tblcarro`.`tblUsuarioCorreo` = '$correo'";
            $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
                // Nombre de clase cuando es otra clase.
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
            return $nfilas; // devuelve el numero de filas insertadas.
                
            
            mysqli_close($link);
        }
        public function vaciarCarroValidado($idPedido) // parametros de la funcion.
        {
            $query = "DELETE FROM `tblcarro` WHERE `tblcarro`.`tblUsuarioCorreo` = (SELECT tblpersona.tblUsuarioCorreo FROM `tblpedido`,tblpersona WHERE tblpedido.tblPedidoId = $idPedido and tblpedido.tblPersonaId = tblpersona.tblPersonaId)";
            $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
                // Nombre de clase cuando es otra clase.
            mysqli_query($link, $query);
            $nfilas = mysqli_affected_rows($link);
            return $nfilas; // devuelve el numero de filas insertadas.
                
            
            mysqli_close($link);
        }
        
        public function validarDescuento($codigo) // parametros de la funcion.
        {
            session_start();
            $correo=$_SESSION["correoAgrofrez"];
            $query = "SELECT * FROM `tblCupones` WHERE codigo = '$codigo' and estado = 1";
            $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
            //echo $Query;
            // Nombre de clase cuando es otra clase.
            $resultado=mysqli_query($link, $query);
            //obtenemos el numero de filas afectadas
            $nfilas = mysqli_affected_rows($link);
            if($nfilas = 1){
                $queryCarro ="UPDATE tblcarro SET descuento = (SELECT porcentaje FROM `tblCupones` WHERE codigo = '$codigo' and estado = 1) WHERE tblcarro.tblUsuarioCorreo = '$correo'";
                $resulatdoActcarro=mysqli_query($link,$queryCarro);
                //ACTUALIZAMOS USO DE CUPON
                $queryActCupon ="UPDATE `tblCupones` SET `iteraciones` = iteraciones +1 WHERE `tblCupones`.`codigo` = '$codigo'";
                $resulatdoActcarro=mysqli_query($link,$queryActCupon);
            }
            //Recorremos la tabla como un vector
            $fila=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
            //codificamos en formato Json
            $json=json_encode($fila);
            echo($json);
        }




}