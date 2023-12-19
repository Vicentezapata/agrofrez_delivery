<?php
	include("Conexion DB.php");
	$link = conexion::conectar();
	//Metodo que obtienen la imagen y la convierte en bits
	// el signo $ es para crear una variable
	//Metodo que obtienen el valor en sku
	$sku = $_POST['SKU'];
	//Metodo que obtienen el valor en sku
	$temporada = $_POST['temporada'];
	//Metodo que obtienen el valor en talla
	$categoria = $_POST['categoria'];
	//Metodo que obtienen el valor en sku
	$subCat = $_POST['subCategoria'];
	//Metodo que obtienen el valor en genero
	$especificacion = utf8_decode($_POST['especificacion']);
	//Metodo que obtienen el valor en color
	$disponibilidad = $_POST['disponibilidad'];
	//Metodo que obtienen el valor en maerial
	$uMedida = $_POST['uMedida'];
	//Metodo que obtienen el valor en marca
	$cantidad = $_POST['cantidad'];
	//Metodo que obtienen el valor en tipo
	$precio = $_POST['precio'];
	//Metodo que obtienen el valor en tipo
	$descuento = $_POST['descuento'];

	/*PROCEDIMIENTO PARA OBTENER EL NOMBRE DE LA SUB CATEGORIA*/
	$queryNombreSubCat="SELECT 	tblSubTipoNombre,tblTipoId FROM tblsubtipo WHERE 	tblSubTipoId='$subCat'";
	$resultadoNombreSubCat=mysqli_query($link,$queryNombreSubCat);
	$vector=$resultadoNombreSubCat->fetch_assoc();
  	$subCatNombre=utf8_decode($vector['tblSubTipoNombre']);
  	//PARCHE TEMPORAL;
  	if ($subCatNombre=="Todo el A?o") {
  		$subCatNombre=="Todo el Año";
  	}
  	$idTipo=$vector['tblTipoId'];

  	/*PROCEDIMIENTO PARA OBTENER EL NOMBRE DE LA CATEGORIA*/
  	$queryNombreCat="SELECT tblTipoNombre FROM tbltipo WHERE tblTipoId='$idTipo'";
	$resultadoNombreCat=mysqli_query($link,$queryNombreCat);
	$vector=$resultadoNombreCat->fetch_assoc();
  	$catNombre=utf8_decode($vector['tblTipoNombre']);

  	//VARIABLES PARA GENERAR LA IMAGEN
	$imgOriginal=$_FILES['imagen']['tmp_name'];
	$destino=''.$_FILES['imagen']['tmp_name'];
	$ruta = '../Imagenes/Productos/'.utf8_decode($catNombre).'/';
	//VERIFICAMOS LA EXISTENCIA DE LA CARPETA CATEGORIA
	if(!file_exists($ruta)){
		mkdir($ruta);
		$ruta = '../Imagenes/Productos/'.utf8_decode($catNombre).'/'.utf8_decode($subCatNombre).'/';
		//VERIFICAMOS LA EXISTENCIA DE LA CARPETA SUBCATEGORIA
		if(!file_exists($ruta)){
			mkdir($ruta);	
		}
	}else{
		$ruta = '../Imagenes/Productos/'.utf8_decode($catNombre).'/'.utf8_decode($subCatNombre).'/';
		//VERIFICAMOS LA EXISTENCIA DE LA CARPETA SUBCATEGORIA
		if(!file_exists($ruta)){
			mkdir($ruta);	
		}

	}
	$archivo = $ruta.$_FILES["imagen"]["name"];
	//VERIFICAMOS LA EXISTENCIA DE LA IMAGEN
	if(!file_exists($archivo)){
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo);
		if($resultado){
			echo "Archivo Guardado";
			}
			else {
			echo "Error al guardar archivo";
			}
		} else {
		echo "Archivo ya existe";
	}
			//ALMACENAMOS EL PRODUCTO EN LA BASE DE DATOS
	$query="INSERT INTO tblproductos (tblProductosCodigoDeBarra,tblProductosEspecificacion,tblProductosImagen,tblTemporadaId,tblSubTipoId,tblProductosStock,tblMedidaId,tblProductosCantidad,tblProductosPrecio,tblProductosDescuento) VALUES ('$sku','$especificacion','$archivo','$temporada','$subCat','$disponibilidad','$uMedida','$cantidad','$precio','$descuento')";
	$productoExistente="SELECT tblProductosCodigoDeBarra FROM tblproductos WHERE tblProductosCodigoDeBarra='$sku'";
	$resultadoProductoExistente=mysqli_num_rows(mysqli_query($link,$productoExistente));
	if($resultadoProductoExistente==0){
		$resultadoConsulta=mysqli_query($link,$query);
		if($resultadoConsulta){
		//$resultado="Producto almacenado";
			header('Location: ../Paginas/respuesta.php?resultado="IProductoExitoso"');

			}
		else{
				//$resultado="No se pudo almacenar el producto";
			header('Location: ../Paginas/respuesta.php?resultado="NoProducto"');
		}	
	}
	else{
		//$resultado="Producto existente";
		header('Location: ../Paginas/respuesta.php?resultado="existeProducto"');
	}
?>
