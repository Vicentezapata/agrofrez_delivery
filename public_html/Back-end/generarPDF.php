<?php
include ("Conexion DB.php"); // copiar el codigo de la clase en el codigo actual.
require('../Librerias/fpdf/cellfit.php');
require('../Librerias/PHPMailer/class.phpmailer.php');

session_start();


if(isset($_GET["correo"])){
$correo=$_GET["correo"];	
}
else if(isset($_SESSION["correoAgrofrez"])){
$correo=$_SESSION["correoAgrofrez"];	
}
if(isset($_GET['idPedido'])){
    $idPedido=$_GET['idPedido'];

$queryUser = 'SELECT direc.tblDireccionNombre,direc.tblDireccionNumero,com.tblComunaNombre,ciu.tblCiudadNombre,reg.tblRegionNombre,us.tblUsuarioCorreo,us.tblUsuarioContrasennia,per.tblPersonaNombre,per.tblPersonaApellido,per.tblPersonaFechaNacimiento,gen.tblGeneroNombre,per.tblPersonaFono FROM tbldireccion as direc,tblpersona as per,tblregion as reg, tblciudad as ciu,tblcomuna as com,tblusuario as us,tblgenero as gen WHERE us.tblUsuarioCorreo="'.$correo.'" and per.tblPersonaId=direc.tblPersonaId and reg.tblRegionId=ciu.tblRegionId and ciu.tblCiudadId=com.tblCiudadId and direc.tblComunaId=com.tblComunaId and gen.tblGeneroId=per.tblPersonaGeneroId and per.tblUsuarioCorreo=us.tblUsuarioCorreo';
$queryPedido ="SELECT P.`tblPedidoComentario`,P.`tblPedidoFecha`,P.`tblPedidoBolsa`,P.`tblPedidoCaja`,MP.tblMedioPagoNombre FROM `tblpedido` AS P,`tblmediopago` AS MP WHERE `tblPersonaId`=(SELECT tblPersonaId FROM tblpersona WHERE tblUsuarioCorreo='".$correo."') AND P.tblMedioPagoId=MP.tblMedioPagoId AND tblPedidoId=$idPedido";
$queryProductos ="SELECT P.tblProductosImagen,P.tblProductosEspecificacion,P.tblProductosCantidad,S.tblSubTipoNombre,M.tblMedidaNombre, PD.`tblProductosCodigoDeBarra`,PD.`tblpedidoproductosPrecio`,PD.`tblCarroCantidad`,PD.`tblpedidoproductosDescuento`,PD.`tblPedidoProductoCupon` FROM `tblpedidoproductos` AS PD,tblproductos AS P,tblmedida AS M,tblsubtipo AS S WHERE `tblPedidoId`=$idPedido and PD.`tblProductosCodigoDeBarra`=P.tblProductosCodigoDeBarra and P.tblMedidaId=M.tblMedidaId AND P.tblSubTipoId=S.tblSubTipoId";
$link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
// Nombre de clase cuando es otra clase.
$consultaUser=mysqli_query($link, $queryUser);
$consultaPedido=mysqli_query($link, $queryPedido);
$consultaDetalleProductos=mysqli_query($link, $queryProductos);
$nfilas = mysqli_affected_rows($link);
while($fila=$consultaUser->fetch_assoc()){
  $nombre=$fila['tblPersonaNombre'];
  $apellido=$fila['tblPersonaApellido'];
  $fechaNac=$fila['tblPersonaFechaNacimiento'];
  $telefono=$fila['tblPersonaFono'];
  $region=$fila['tblRegionNombre'];
  $ciudad=$fila['tblCiudadNombre'];
  $comuna=$fila['tblComunaNombre'];
  $calle=$fila['tblDireccionNombre'];
  $numero=$fila['tblDireccionNumero'];

}
while($fila=$consultaPedido->fetch_assoc()){
  $bolsa=$fila['tblPedidoBolsa'];
  $caja=$fila['tblPedidoCaja'];
  $coment=$fila['tblPedidoComentario'];
  $fecha=$fila['tblPedidoFecha'];
  $medioPago=$fila['tblMedioPagoNombre'];


}
mysqli_close($link);

function moneda_chilena($numero){
$numero = (string)$numero;
$puntos = floor((strlen($numero)-1)/3);
$tmp = "";
$pos = 1;
for($i=strlen($numero)-1; $i>=0; $i--){
$tmp = $tmp.substr($numero, $i, 1);
if($pos%3==0 && $pos!=strlen($numero))
$tmp = $tmp.".";
$pos = $pos + 1;
}
$formateado = "$ ".strrev($tmp);
return $formateado;
}



/*_____________________________________________________________________
 |                                                                     |
 |								PDF 								   |
 |_____________________________________________________________________|*/
//Se genera el objeto FPDF usando los parametros para una hoja tamaño A4
$pdf = new FPDF_CellFit();
//Incluye una hoja
$pdf->AddPage();
//Define el tipo de letra a usar B--> Bold (negrita)
$pdf->SetFont('Arial','',12);
$pdf->Image("../Imagenes/logo.png",10,8,25,25,'png');//("RUTA",X,Y,ANCHO,ALTO,EXTENSION)
$pdf->Cell(30,10,'',0);
//Se escribe una linea donde los dos primeros parametros son separacion ancho,alto,"texto"
$pdf->Cell(110,10,'',0);
$pdf->Cell(50,10,'Fecha:'.date('d-m-Y').'',0);
$pdf->Ln(15);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(65,8,'',0);
$pdf->Cell(90,8,'Comprobante de pedido.',0);
$pdf->Ln(23);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(6,8,utf8_decode('N°'),1);
$pdf->Cell(9,8,'Item',1);
$pdf->Cell(40,8,'Nombre',1);
$pdf->Cell(58,8,utf8_decode('Especificación'),1);
$pdf->Cell(16,8,'Precio',1);
$pdf->Cell(12,8,'Desc.',1);
$pdf->Cell(16,8,'$ final.',1);
$pdf->Cell(11,8,'Cant.',1);
$pdf->Cell(20,8,'Subtotal',1);
$pdf->Ln(8);
$pdf->SetFont('Arial','',9);
//CONSULTA
$total=0;
$totalCupon =0;
$indice=0;
$despacho=0;

while($fila=$consultaDetalleProductos->fetch_assoc()){
	$sku=$fila['tblProductosCodigoDeBarra'];
	$especificacion=utf8_decode($fila['tblProductosEspecificacion']);
	$imagen=$fila['tblProductosImagen'];
	$subtipo=utf8_encode($fila['tblSubTipoNombre']);
	$medida=$fila['tblMedidaNombre'];
	$cantmedida=$fila['tblProductosCantidad'];
	$precio=$fila['tblpedidoproductosPrecio'];
	$cantidad=$fila['tblCarroCantidad'];
	
	$descuento=$fila['tblpedidoproductosDescuento'];
	$descuentoCupon=$fila['tblPedidoProductoCupon'];
	
	//var descuentoCupon = Math.round(parseInt(array[i].tblProductosPrecio) - ((parseInt(array[i].tblProductosPrecio) * (parseInt(array[i].tblProductosDescuento)/100.0))+(parseInt(array[i].tblProductosPrecio) * (parseInt(array[i].cuponDesc)/100.0)) ));
	$precioConDec=round($precio*(1.0-($descuento/100.0)));
	$precioPagar = $precio - (round($precio*($descuento/100.0))+round($precioConDec*($descuentoCupon/100.0)));
	//$precioConDec=round($precio*(1.0-($descuento/100.0)));
	//$precioConCupon=round($precio*(1.0-($descuentoCupon/100.0)));
	//$total=$total+($precioConDec*$cantidad);
	//$totalCupon=$totalCupon+($precioConCupon*$cantidad);
	$total=$total+($precioPagar*$cantidad);
	$indice=$indice+1;
	$pdf->Cell(6,8,utf8_decode($indice),1);
	$pdf->Cell(9,8,utf8_decode($sku),1);
	try {
			$pdf->Cell(10,8,$pdf->Image($imagen,$pdf->GetX(), $pdf->GetY(),8,8,'jpg'),1);
	} catch (Exception $e) {
			$pdf->Cell(10,8,$pdf->Image("../Imagenes/logo.png",$pdf->GetX(), $pdf->GetY(),8,8,'png'),1);
	}


	$pdf->CellFitScale(30,8,utf8_decode($subtipo),1);
	$pdf->CellFitScale(58,8,$especificacion.' ('.$cantmedida.' '.$medida.')',1);
	$pdf->Cell(16,8,moneda_chilena($precio),1);
	$pdf->Cell(12,8,$descuento.'%',1);
	$pdf->Cell(16,8,moneda_chilena($precioPagar),1);
	$pdf->Cell(11,8,$cantidad,1);
	$pdf->Cell(20,8,moneda_chilena($precioPagar*$cantidad),1);
	$pdf->Ln(8);
	

}	if($total<25000){
		$despacho=round($total*0.1);
		$pdf->Cell(147,8,'',0);
		$pdf->Cell(21,8,'SUBTOTAL',0);
		$pdf->Cell(20,8,moneda_chilena($total),1);
		$pdf->Ln(8);
		$pdf->Cell(147,8,'',0);
		$pdf->Cell(21,8,'DESPACHO',0);
		$pdf->Cell(20,8,moneda_chilena($despacho),1);
		$pdf->Ln(8);
	
	}
	$pdf->Cell(151,8,'',0);
	$pdf->Cell(17,8,'TOTAL',0);
	$pdf->Cell(20,8,moneda_chilena($total+$despacho),1);
	$pdf->Ln(25);
$pdf->AddPage();
//Define el tipo de letra a usar B--> Bold (negrita)
$pdf->SetFont('Arial','',12);
$pdf->Image("../Imagenes/logo.png",10,8,25,25,'png');//("RUTA",X,Y,ANCHO,ALTO,EXTENSION)
$pdf->Cell(30,10,'',0);
//Se escribe una linea donde los dos primeros parametros son separacion ancho,alto,"texto"
$pdf->Cell(110,10,'',0);
$pdf->Cell(50,10,'Fecha:'.date('d-m-Y').'',0);
$pdf->Ln(15);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(65,8,'',0);
$pdf->Cell(90,8,'Comprobante de pedido.',0);
$pdf->Ln(23);
	$pdf->SetFont('Arial','B',18);
	$pdf->Cell(10,8,'',0);
	$pdf->Cell(0,8,'Detalles del pedido.',0);
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,8,'Bolsa'.utf8_decode(' plástica: '),0);	
	$pdf->Cell(150,8,utf8_decode($bolsa),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Caja de: ',0);	
	$pdf->Cell(150,8,utf8_decode($caja),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Comentarios: ',0);	
	$pdf->CellFitScale(150,8,utf8_decode($coment),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,utf8_decode('Método de pago: '),0);	
	$pdf->Cell(150,8,utf8_decode($medioPago),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,utf8_decode('Emisión del pedido: '),0);	
	
	$pdf->Cell(150,8,utf8_decode($fecha),0);
	$pdf->Ln(15);

	$pdf->SetFont('Arial','B',18);
	$pdf->Cell(10,8,'',0);
	$pdf->Cell(0,8,'Datos del comprador.',0);
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,8,'Nombre: ',0);
	$pdf->Cell(150,8,utf8_decode($nombre),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Apellido: ',0);
	$pdf->Cell(150,8,utf8_decode($apellido),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Correo: ',0);
	$pdf->Cell(150,8,utf8_decode($correo),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,utf8_decode('Teléfono: '),0);
	$pdf->Cell(150,8,utf8_decode($telefono),0);
	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',18);
	$pdf->Cell(10,8,'',0);
	$pdf->Cell(0,8,utf8_decode('Dirección de comprador.'),0);
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,8,'Calle: ',0);
	$pdf->Cell(150,8,utf8_decode($calle),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,utf8_decode('Número: '),0);
	$pdf->Cell(150,8,utf8_decode('#'.$numero),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Comuna: ',0);
	$pdf->Cell(150,8,utf8_decode($comuna),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Ciudad: ',0);
	$pdf->Cell(150,8,utf8_decode($ciudad),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,utf8_decode('Región: '),0);
	$pdf->Cell(150,8,utf8_decode($region),0);
	$pdf->Ln(8);
	
	$pdf->SetFont('Arial','',12);

	$archivoPdf = $pdf->Output('','S'); 
	$pdf->Output();

	/*if(empty($_SESSION["correoAgrofrez"]),empty($_SESSION["correoAgrofrez"]) || !filter_var($_SESSION["correoAgrofrez"], FILTER_VALIDATE_EMAIL)) {
  		http_response_code(500);
  		exit();
	}*/
/*
	// Create the email and send the message
	$to = "vicentezapatac@gmail.com"; // Add your email address inbetween the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
	$subject = "Emision de pedido Agrofrez del cliente:  $name";
	$body = "Has recibido un nuevo mensaje del formulario de tu sitio web Capacitatec.\n\n"."Aquí estan los detalles:\n\nNombre: $nombre\n\nEmail: $correo\n\nContacto: $telefono\n\nComentarios:\n$coment";
	$header = "De: noreply@agrofrez.cl\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
	$header .= "Contestar a: $correo";	

	if(!mail($to, $subject, $body, $header))
	  http_response_code(500);*/
	/*_____________________________________________________________________
	 |                                                                     |
	 |								CORREO								   |
	 |_____________________________________________________________________|*/
/*
	 	$asunto="Haleluya venta realizada";
	 	$cuerpo="Se acaba de realizar una venta a continuacion podras revisar eñ detalle de la compra para coordinar el envio y cobro.";
		$mail = new PHPMailer;
	    $mail->isSMTP();                                // Set mailer to use SMTP
	    $mail->SMTPSecure = 'SSL';                      // Enable TLS encryption, `ssl` also 
	    $mail->Host = 'mail.agrofrezdelivery.cl';                       // SMTP server
	    $mail->SMTPAuth = true;                         // Enable SMTP authentication
	    $mail->Username = 'admin@agrofrezdelivery.cl';                 // SMTP username
	    $mail->Password = '2t7i0b8u9r5on';               // SMTP password
	    $mail->From = 'admin@agrofrezdelivery.cl';
	    $mail->Port = 587;                              // SMTP Port
	    $mail->FromName  = 'Agrofrez';

	    $mail->Subject   = $asunto;
	    $mail->Body      = $cuerpo;
	    $mail->AddAddress($correo, $nombre);
	    $mail->AddBCC('vicentezapatac@gmail.com', 'Agrofrez');
	    $mail->AddStringAttachment($archivoPdf,'Comprobante.pdf','base64');
	    $mail->Send();
*/if(!isset($_GET["correo"])){
	$correo=$_SESSION["correoAgrofrez"];	
	$mail = new PHPMailer;
	$mail->setFrom('admin@agrofrezdelivery.cl', 'Agrofrez ventas');
	$mail->AddAddress($correo, $nombre);
	$mail->AddBCC('agrofrezdelivery@gmail.com', 'Agrofrez');
	$mail->Subject  = 'No respondas este correo, Comprobante de pedido de ventas';
	$mail->Body     = nl2br('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body> Se acaba de realizar un pedido a continuacion podras revisar el detalle del pedido aquí estan los detalles:<br><strong>N° de pedido: </strong>'.$idPedido.'<br><strong>Nombre: </strong>'.$nombre.'<br><strong>Apellido: </strong>'.$apellido.'<br><strong>Email: </strong>'.$correo.'<br><strong>Contacto: </strong>'.$telefono.'<br><strong>Comentarios:</strong><br>'.$coment.'</body> </html>');
	$mail->IsHTML(true);       // <=== call IsHTML() after $mail->Body has been set.
	$mail->AddStringAttachment($archivoPdf,'Comprobante.pdf','base64');
	if(!$mail->send()) {
	  echo 'Message was not sent.';
	  echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {
	  echo 'Message has been sent.';
	}
}









};
/*_____________________________________________________________________
 |                                                                     |
 |								CORREO								   |
 |_____________________________________________________________________|

 	$asunto="Haleluya venta realizada";
 	$cuerpo="Se acaba de realizar una venta a continuacion podras revisar eñ detalle de la compra para coordinar el envio y cobro.";
 	$emails="vicentezapatac@gmail.com";
	$mail = new PHPMailer;
    $mail->isSMTP();                                // Set mailer to use SMTP
    $mail->Host = 'SmtpServer';                       // SMTP server
    $mail->SMTPAuth = true;                         // Enable SMTP authentication
    $mail->Username = 'SmtpUsername';                 // SMTP username
    $mail->Password = 'SmtpPassword';                 // SMTP password
    $mail->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
    $mail->From = 'FromEmail';
    $mail->Port = 587;                              // SMTP Port
    $mail->FromName  = 'testing';

    $mail->Subject   = $asunto;
    $mail->Body      = $cuerpo;
    $mail->AddAddress($emails);
    $mail->addStringAttachment($pdf->Output("S",'Detalle de compra.pdf'), 'Detalle de compra.pdf', $encoding = 'base64', $type = 'application/pdf');
    $mail->Send();*/
?>