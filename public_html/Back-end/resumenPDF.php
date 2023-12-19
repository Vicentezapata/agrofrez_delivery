<?php
include ("Conexion DB.php"); // copiar el codigo de la clase en el codigo actual.
require('../Librerias/fpdf/cellfit.php');

$fechaIni=$_POST["fechaIni"];
$fechaTerm=$_POST["fechaTerm"];
$horaIni=$_POST["horaIni"];
$horaTerm=$_POST["horaTerm"];

//echo($rangos[0]." ".$rangos[1]." ".$rangos[2]." ".$rangos[3]." ".$sku);


$QueryVariedadProducto = "SELECT DISTINCT(prod.tblProductosCodigoDeBarra) FROM `tblpedido` AS ped, tblpedidoproductos AS prod WHERE ped.`tblPedidoFecha` BETWEEN '".$fechaIni." ".$horaIni."' AND '".$fechaTerm." ".$horaTerm."' AND ped.tblPedidoId=prod.tblPedidoId";// ESCRIBIMOS LA QUERY

$link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
// Nombre de clase cuando es otra clase.
$consultaVariedadProducto=mysqli_query($link, $QueryVariedadProducto);
$nfilas = mysqli_affected_rows($link);




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
$pdf->Cell(50,10,'Fecha: '.date('d-m-Y').'',0);
$pdf->Ln(15);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(65,8,'',0);
$pdf->Cell(90,8,'Resumen de productos.',0);
$pdf->Ln(15);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(8,8,utf8_decode('N°'),1);
$pdf->Cell(20,8,utf8_decode('Ítem'),1);
$pdf->Cell(45,8,'Nombre',1);
$pdf->Cell(80,8,utf8_decode('Especificación'),1);
$pdf->Cell(15,8,'Cant.',1);
$pdf->Cell(23,8,'Total und.',1);
$pdf->Ln(8);
$pdf->SetFont('Arial','',10);
//CONSULTA
$indice=0;
while($fila=$consultaVariedadProducto->fetch_assoc()){
	$sku=$fila['tblProductosCodigoDeBarra'];
	
	$QueryPorProducto = "SELECT SUM(prod.tblCarroCantidad) as cantidad,prod.tblProductosCodigoDeBarra,infoprod.tblProductosImagen,infoprod.tblProductosEspecificacion,sub.tblSubTipoNombre,tipo.tblTipoNombre,infoprod.tblProductosCantidad,med.tblMedidaNombre FROM `tblpedido` AS ped, tblpedidoproductos AS prod,tblproductos AS infoprod,tblsubtipo as sub,tbltipo as tipo,tblmedida as med WHERE med.tblMedidaId=infoprod.tblMedidaId AND sub.tblSubTipoId=infoprod.tblSubTipoId AND tipo.tblTipoId=sub.tblTipoId AND infoprod.tblProductosCodigoDeBarra=prod.tblProductosCodigoDeBarra AND ped.`tblPedidoFecha` BETWEEN '".$fechaIni." ".$horaIni."' AND '".$fechaTerm." ".$horaTerm."' AND ped.tblPedidoId=prod.tblPedidoId AND prod.tblProductosCodigoDeBarra=".$sku;// ESCRIBIMOS LA QUERY
	$consultaPorProducto=mysqli_query($link, $QueryPorProducto);

	while($fila=$consultaPorProducto->fetch_assoc()){
		$sku=$fila['tblProductosCodigoDeBarra'];
		$especificacion=$fila['tblProductosEspecificacion'];
		$imagen=$fila['tblProductosImagen'];
		$subtipo=$fila['tblSubTipoNombre'];
		$medida=$fila['tblMedidaNombre'];
		$cantmedida=$fila['tblProductosCantidad'];
		$cantidad=$fila['cantidad'];
		$indice=$indice+1;
		$pdf->Cell(8,8,utf8_decode($indice),1);
		$pdf->Cell(20,8,utf8_decode($sku),1);
		try {
				$pdf->Cell(10,8,$pdf->Image($imagen,$pdf->GetX(), $pdf->GetY(),8,8,'jpg'),1);
		} catch (Exception $e) {
				$pdf->Cell(10,8,$pdf->Image("../Imagenes/logo.png",$pdf->GetX(), $pdf->GetY(),8,8,'png'),1);
		}
		$pdf->CellFitScale(35,8,$subtipo,1);
		$pdf->CellFitScale(80,8,utf8_decode($especificacion).' ('.$cantmedida.' '.$medida.')',1);
		$pdf->CellFitScale(15,8,$cantidad,1);
		$pdf->CellFitScale(23,8,$cantmedida*$cantidad.' '.$medida,1);

		$pdf->Ln(8);
	

	}
}


	$pdf->Ln(15);

	$pdf->SetFont('Arial','B',18);
	$pdf->Cell(0,8,'Detalles del resumen.',0);
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,8,'Fecha de inicio: ',0);	
	$pdf->Cell(150,8,utf8_decode($fechaIni),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Hora de inicio: ',0);	
	$pdf->Cell(150,8,utf8_decode($horaIni),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Fecha de termino: ',0);	
	$pdf->Cell(150,8,utf8_decode($fechaTerm),0);
	$pdf->Ln(8);
	$pdf->Cell(40,8,'Hora de termino: ',0);	
	$pdf->Cell(150,8,utf8_decode($horaTerm),0);
	$pdf->Ln(15);
	mysqli_close($link);
	$pdf->Output();

?>