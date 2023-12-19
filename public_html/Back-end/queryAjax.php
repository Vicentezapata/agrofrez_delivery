<?php
/**
 * Description of llamadaAjax
 *
 * @author Tiburon
 */
include ("Conexion DB.php"); // copiar el codigo de la clase en el codigo actual.
$link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.

if(isset($_GET['variable'])){
    $variable=$_GET['variable'];
};
if(isset($_GET['consulta'])){
    $consulta=$_GET['consulta'];
};
$fechaActual=date("Y")."-".date("m")."-".date("d");
switch ($consulta){
    case "verificarCorreoNoExistente":
        $Query = 'SELECT COUNT(`tblUsuarioCorreo`) as cantidad FROM `tblusuario` WHERE `tblUsuarioCorreo` ="'.$variable.'"';// ESCRIBIMOS LA QUERY
        break;
    case "verificarCorreoExistente":
        $Query = 'SELECT COUNT(`tblUsuarioCorreo`) as cantidad FROM `tblusuario` WHERE `tblUsuarioCorreo` ="'.$variable.'"';// ESCRIBIMOS LA QUERY
        break;
     case "verificarCorreoNoExistenteRecordar":
        $Query = 'SELECT COUNT(`tblUsuarioCorreo`) as cantidad FROM `tblusuario` WHERE `tblUsuarioCorreo` ="'.$variable.'"';// ESCRIBIMOS LA QUERY
        break;
    case "verificarSKUExistente":
        $Query = 'SELECT COUNT(tblProductosCodigoDeBarra) as cantidad FROM `tblproductos` WHERE `tblProductosCodigoDeBarra`="'.$variable.'"';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerCategorias":
        $Query = 'SELECT tblTipoId,tblTipoNombre FROM tbltipo';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerTemporada":
        $Query = 'SELECT tblTemporadaId,tblTemporadaNombre FROM tbltemporada';// ESCRIBIMOS LA QUERY
        break;

    case "obtenerSubCategorias":
        $Query = 'SELECT tblSubTipoId,tblSubTipoNombre  FROM tblsubtipo where tblTipoId ='.$variable;// ESCRIBIMOS LA QUERY
        break;
    case "obtenerUnidades":
        $Query = 'SELECT tblMedidaId,tblMedidaNombre  FROM tblmedida ORDER BY tblMedidaNombre ';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerEspecificacion":
        $Query = 'SELECT tblProductosCodigoDeBarra,tblProductosEspecificacion FROM tblproductos where tblSubTipoId='.$variable.'';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerProducto":
        $Query = 'SELECT p.`tblProductosCodigoDeBarra`,p.tblProductosEspecificacion,p.tblProductosImagen, sub.tblSubTipoNombre, temp.tblTemporadaNombre,p.tblProductosStock,med.tblMedidaNombre,p.tblProductosCantidad,p.tblProductosPrecio,p.tblProductosDescuento,tipo.tblTipoNombre FROM tblproductos AS p, tblsubtipo as sub , tbltemporada as temp , tblmedida as med,tbltipo as tipo WHERE p.tblProductosCodigoDeBarra = '.$variable.' and p.tblSubTipoId=sub.tblSubTipoId and p.tblTemporadaId=temp.tblTemporadaId and p.tblMedidaId=med.tblMedidaId and sub.tblTipoId=tipo.tblTipoId';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerRegion":
        $Query = 'SELECT * FROM `tblregion` ';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerCiudad":
        $Query = 'SELECT * FROM `tblciudad` WHERE `tblRegionId`='.$variable.'';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerComuna":
        $Query = 'SELECT * FROM `tblcomuna` WHERE `tblCiudadId`='.$variable.' ORDER BY tblcomuna.tblComunaNombre';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerGenero":
        $Query = 'SELECT * FROM `tblgenero`';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerLogProducto":
        $Query = 'SELECT * FROM `tbllogproductos` where CAST(`tblLogProductosFecha` AS DATE)="'.$variable.'"';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerDiasCambiosProductos":
        $Query = 'SELECT DISTINCT CAST(`tblLogProductosFecha` AS DATE) AS fecha FROM `tbllogproductos`';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerDiasPedidos":
        $Query = 'SELECT DISTINCT CAST(`tblPedidoFecha` AS DATE) AS fecha FROM tblpedido ORDER BY tblPedidoFecha DESC';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerPedidosDelDia":
        $Query = 'SELECT ped.tblPedidoId,per.tblPersonaNombre,per.tblPersonaApellido,us.tblUsuarioCorreo,per.tblPersonaFono,ped.tblPedidoComentario,ped.tblPedidoFecha,est.tblEstadoNombre,medio.tblMedioPagoNombre,pago.tblPagoId,pago.tblPagoEstado,ped.tblPedidoBolsa,ped.tblPedidoCaja FROM `tblpedido` AS ped,tblpersona as per,tblestado as est,tblmediopago as medio,tblpago as pago,tblusuario as us where CAST(`tblPedidoFecha` AS DATE)="'.$variable.'"AND per.tblPersonaId=ped.tblPersonaId AND est.tblEstadoId=ped.tblPedidoEstado AND medio.tblMedioPagoId=ped.tblMedioPagoId AND pago.tblPagoId=ped.tblPagoId AND per.tblUsuarioCorreo=us.tblUsuarioCorreo ORDER BY ped.tblPedidoId ASC';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerProductosCarro":
        session_start();
        $variable=$_SESSION["correoAgrofrez"];
        $Query = "SELECT C.`tblProductosCodigoDeBarra`,C.`tblCarroId`,C.`tblCarroCantidad`,P.`tblProductosImagen`,P.`tblProductosPrecio`,P.`tblProductosDescuento`,IFNULL(C.`descuento`, 0) as cuponDesc FROM `tblcarro` AS C, `tblproductos` AS P WHERE `tblUsuarioCorreo`='".$variable."' AND C.tblProductosCodigoDeBarra=P.tblProductosCodigoDeBarra";// ESCRIBIMOS LA QUERY
        break;
    case "obtenerTopProductos":
        $Query = 'SELECT p.`tblProductosCodigoDeBarra`,p.tblProductosEspecificacion,p.tblProductosImagen, sub.tblSubTipoNombre, temp.tblTemporadaNombre,p.tblProductosStock,med.tblMedidaNombre,p.tblProductosCantidad,p.tblProductosPrecio,p.tblProductosDescuento,tipo.tblTipoNombre FROM tblproductos AS p, tblsubtipo as sub , tbltemporada as temp , tblmedida as med,tbltipo as tipo,tbllogcarro as top WHERE p.tblSubTipoId=sub.tblSubTipoId and p.tblTemporadaId=temp.tblTemporadaId and p.tblMedidaId=med.tblMedidaId and sub.tblTipoId=tipo.tblTipoId and top.`tblProductosCodigoDeBarra`=p.`tblProductosCodigoDeBarra` and p.tblProductosStock=1 ORDER BY top.tblLogCarroCantidad DESC LIMIT 16';// ESCRIBIMOS LA QUERY
        break;
    case "obtenerProductosPedidosDia":
        //fecha debe ser recibida como 2019-01-01,12:00,2019-01-17,14:00
        $rangos = explode(",", $variable);
        $Query = "SELECT DISTINCT(prod.tblProductosCodigoDeBarra) FROM `tblpedido` AS ped, tblpedidoproductos AS prod WHERE ped.`tblPedidoFecha` BETWEEN '".$rangos[0]." ".$rangos[1]."' AND '".$rangos[2]." ".$rangos[3]."' AND ped.tblPedidoId=prod.tblPedidoId";// ESCRIBIMOS LA QUERY
        break;
    case "obtenerSumaProductosPedidosDia":
        //fecha debe ser recibida como 2019-01-01,12:00,2019-01-17,14:00;sku
        $fechaSku = explode(";", $variable);
        $fecha=$fechaSku[0];
        $sku=$fechaSku[1];
        $rangos = explode(",", $fecha);
        //echo($rangos[0]." ".$rangos[1]." ".$rangos[2]." ".$rangos[3]." ".$sku);
        $Query = "SELECT SUM(prod.tblCarroCantidad),prod.tblProductosCodigoDeBarra,infoprod.tblProductosImagen,infoprod.tblProductosEspecificacion,sub.tblSubTipoNombre,tipo.tblTipoNombre,infoprod.tblProductosCantidad,med.tblMedidaNombre FROM `tblpedido` AS ped, tblpedidoproductos AS prod,tblproductos AS infoprod,tblsubtipo as sub,tbltipo as tipo,tblmedida as med WHERE med.tblMedidaId=infoprod.tblMedidaId AND sub.tblSubTipoId=infoprod.tblSubTipoId AND tipo.tblTipoId=sub.tblTipoId AND infoprod.tblProductosCodigoDeBarra=prod.tblProductosCodigoDeBarra AND ped.`tblPedidoFecha` BETWEEN '".$rangos[0]." ".$rangos[1]."' AND '".$rangos[2]." ".$rangos[3]."' AND ped.tblPedidoId=prod.tblPedidoId AND prod.tblProductosCodigoDeBarra=".$sku;// ESCRIBIMOS LA QUERY
        break;
    case "obtenerDatosUsuario":
        session_start();
        $variable=$_SESSION["correoAgrofrez"];
        $Query = 'SELECT COUNT(direc.tblDireccionNombre),direc.tblDireccionNombre,direc.tblDireccionNumero,com.tblComunaNombre,ciu.tblCiudadNombre,reg.tblRegionNombre,us.tblUsuarioCorreo,us.tblUsuarioContrasennia,per.tblPersonaNombre,per.tblPersonaApellido,per.tblPersonaFechaNacimiento,gen.tblGeneroNombre,per.tblPersonaFono FROM tbldireccion as direc,tblpersona as per,tblregion as reg, tblciudad as ciu,tblcomuna as com,tblusuario as us,tblgenero as gen WHERE us.tblUsuarioCorreo="'.$variable.'" and per.tblPersonaId=direc.tblPersonaId and reg.tblRegionId=ciu.tblRegionId and ciu.tblCiudadId=com.tblCiudadId and direc.tblComunaId=com.tblComunaId and gen.tblGeneroId=per.tblPersonaGeneroId and per.tblUsuarioCorreo=us.tblUsuarioCorreo';
        break;
    case "obtenerDatosPersonalesUsuario":
        session_start();
        $variable=$_SESSION["correoAgrofrez"];
        $Query = 'SELECT COUNT(per.tblPersonaId) AS cantRegistros,us.tblUsuarioCorreo,us.tblUsuarioContrasennia,per.tblPersonaNombre,per.tblPersonaApellido,per.tblPersonaFechaNacimiento,gen.tblGeneroNombre,per.tblPersonaFono FROM tblpersona as per,tblusuario as us,tblgenero as gen WHERE us.tblUsuarioCorreo="'.$variable.'" and gen.tblGeneroId=per.tblPersonaGeneroId and per.tblUsuarioCorreo=us.tblUsuarioCorreo';
        break;
    case "obtenerDatosUsuarioDireccion":
        session_start();
        $variable=$_SESSION["correoAgrofrez"];
        $Query = 'SELECT COUNT(direc.tblDireccionNombre) AS cantRegistros,direc.tblDireccionNombre,direc.tblDireccionNumero,com.tblComunaNombre,ciu.tblCiudadNombre,reg.tblRegionNombre FROM tbldireccion as direc,tblpersona as per,tblregion as reg, tblciudad as ciu,tblcomuna as com,tblusuario as us WHERE per.tblPersonaId=(SELECT p.tblPersonaId FROM tblpersona AS p WHERE p.tblUsuarioCorreo="'.$variable.'") and per.tblPersonaId=direc.tblPersonaId and reg.tblRegionId=ciu.tblRegionId and ciu.tblCiudadId=com.tblCiudadId and direc.tblComunaId=com.tblComunaId';
        break;
    case "obtenerPedidosDelDiaPorValidar":
        session_start();
        $variable=$_SESSION["correoAgrofrez"];
        $Query = 'SELECT tblpersona.tblPersonaNombre as nombre ,tblpersona.tblPersonaApellido as apellido ,tblcarro.tblUsuarioCorreo as correo, sum(tblcarro.tblCarroCantidad * (tblproductos.tblProductosPrecio - ((tblproductos.tblProductosPrecio * tblproductos.tblProductosDescuento)/100 ))) as total, sum(tblcarro.tblCarroCantidad * (tblproductos.tblProductosPrecio - (ROUND(((tblproductos.tblProductosPrecio * tblproductos.tblProductosDescuento)/100 ) + (tblproductos.tblProductosPrecio * IFNULL(tblcarro.descuento, 0))/100)))) as totalDesc from tblcarro, tblproductos,tblpersona where tblcarro.tblProductosCodigoDeBarra = tblproductos.tblProductosCodigoDeBarra and tblpersona.tblUsuarioCorreo = tblcarro.tblUsuarioCorreo GROUP by tblcarro.tblUsuarioCorreo';
        break;
}

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

//echo $Query;
// Nombre de clase cuando es otra clase.
$resultado=mysqli_query($link, $Query);
//obtenemos el numero de filas afectadas
$nfilas = mysqli_affected_rows($link);
//Recorremos la tabla como un vector
$fila=mysqli_fetch_all($resultado,MYSQLI_ASSOC);
//codificamos en formato Json
$json=json_encode(utf8ize($fila));
echo($json);
//mysqli_free_result() — Libera la memoria del resultado (devuelve un booleano)
mysqli_free_result($resultado);
//cerramos la conexion
mysqli_close($link);
return $nfilas; // devuelve el numero de filas insertadas.