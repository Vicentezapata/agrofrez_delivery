<?php
  include("../Back-end/Conexion DB.php");
  $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
  //CONSULTA QUE OBTIENE LOS PRODUCTOS POR TIPO
  if(isset($_GET['tipo'])){
      if ($_GET['tipo']==0) {
        $query="SELECT p.`tblProductosCodigoDeBarra`,p.tblProductosEspecificacion,p.tblProductosImagen, sub.tblSubTipoNombre, temp.tblTemporadaNombre,p.tblProductosStock,med.tblMedidaNombre,p.tblProductosCantidad,p.tblProductosPrecio,p.tblProductosDescuento,tipo.tblTipoNombre FROM tblproductos AS p, tblsubtipo as sub , tbltemporada as temp , tblmedida as med,tbltipo as tipo WHERE  p.tblSubTipoId=sub.tblSubTipoId and p.tblTemporadaId=temp.tblTemporadaId and p.tblMedidaId=med.tblMedidaId and sub.tblTipoId=tipo.tblTipoId ORDER BY p.tblProductosEspecificacion";
      }
      else{
      $tipo=$_GET['tipo'];
      $query="SELECT p.`tblProductosCodigoDeBarra`,p.tblProductosEspecificacion,p.tblProductosImagen, sub.tblSubTipoNombre, temp.tblTemporadaNombre,p.tblProductosStock,med.tblMedidaNombre,p.tblProductosCantidad,p.tblProductosPrecio,p.tblProductosDescuento,tipo.tblTipoNombre FROM tblproductos AS p, tblsubtipo as sub , tbltemporada as temp , tblmedida as med,tbltipo as tipo WHERE tipo.tblTipoId = $tipo and p.tblSubTipoId=sub.tblSubTipoId and p.tblTemporadaId=temp.tblTemporadaId and p.tblMedidaId=med.tblMedidaId and sub.tblTipoId=tipo.tblTipoId ORDER BY p.tblProductosEspecificacion";
      }
  }
  //CONSULTA QUE OBTIENE LOS PRODUCTOS ESCRITOS EN EL BUSCADOR
    if(isset($_POST['especificacion'])){
      $especificacion=$_POST['especificacion'];
      $especificacion=ucwords($especificacion);
    $query="SELECT p.`tblProductosCodigoDeBarra`,p.tblProductosEspecificacion,p.tblProductosImagen, sub.tblSubTipoNombre, temp.tblTemporadaNombre,p.tblProductosStock,med.tblMedidaNombre,p.tblProductosCantidad,p.tblProductosPrecio,p.tblProductosDescuento,tipo.tblTipoNombre FROM tblproductos AS p, tblsubtipo as sub , tbltemporada as temp , tblmedida as med,tbltipo as tipo WHERE  (p.tblProductosEspecificacion LIKE '$especificacion%' or sub.tblSubTipoNombre LIKE '$especificacion%') and p.tblSubTipoId=sub.tblSubTipoId and p.tblTemporadaId=temp.tblTemporadaId and p.tblMedidaId=med.tblMedidaId and sub.tblTipoId=tipo.tblTipoId ORDER BY p.tblProductosEspecificacion";
  }
  //CONSULTA QUE OBTIENE LOS PRODUCTOS EN DESCUENTO
  if(isset($_GET['Descuento'])){
      $query="SELECT p.`tblProductosCodigoDeBarra`,p.tblProductosEspecificacion,p.tblProductosImagen, sub.tblSubTipoNombre, temp.tblTemporadaNombre,p.tblProductosStock,med.tblMedidaNombre,p.tblProductosCantidad,p.tblProductosPrecio,p.tblProductosDescuento,tipo.tblTipoNombre FROM tblproductos AS p, tblsubtipo as sub , tbltemporada as temp , tblmedida as med,tbltipo as tipo WHERE p.tblProductosDescuento > 0 and p.tblSubTipoId=sub.tblSubTipoId and p.tblTemporadaId=temp.tblTemporadaId and p.tblMedidaId=med.tblMedidaId and sub.tblTipoId=tipo.tblTipoId ORDER BY p.tblProductosEspecificacion";
  }
  //CONSULTA QUE OBTIENE LOS ELEMENTOS SELECCIONADOS EN EL CHECKBOX
  if(!empty($_POST['check_list'])) {
        $query="SELECT p.`tblProductosCodigoDeBarra`,p.tblProductosEspecificacion,p.tblProductosImagen, sub.tblSubTipoNombre, temp.tblTemporadaNombre,p.tblProductosStock,med.tblMedidaNombre,p.tblProductosCantidad,p.tblProductosPrecio,p.tblProductosDescuento,tipo.tblTipoNombre,sub.tblSubTipoId FROM tblproductos AS p, tblsubtipo as sub , tbltemporada as temp , tblmedida as med,tbltipo as tipo WHERE p.tblSubTipoId=sub.tblSubTipoId and p.tblTemporadaId=temp.tblTemporadaId and p.tblMedidaId=med.tblMedidaId and sub.tblTipoId=tipo.tblTipoId and p.tblSubTipoId IN (" ;
        $contador=0;
    foreach($_POST['check_list'] as $check) {
      $contador=$contador+1;
    }
    foreach($_POST['check_list'] as $check) {
            $variable="'$check'";
            $query=$query.$variable;
            if($contador>1){
             $query=$query.",";
             $contador=$contador-1;
            }
    }
    $query=$query.") ORDER BY p.tblProductosEspecificacion";
  }
  $resulatdoConsulta=mysqli_query($link,$query);
  include("../Back-end/opcionesIndex.php");
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
?>
<!DOCTYPE html>
<style type="text/css">
  .error{
    display: none;
  }
</style>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Agrofrez Delivery</title>
    <link rel="shortcut icon" href="../Imagenes/logo.ico">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="../Estilos/shop-homepage.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Estilos/style.css">
    <link rel="stylesheet" href="../Estilos/estilos carousel.css">
</head>

        <!-- _________________________________________________________________
            |                                                                 |
            |                            NAVEGADOR                            |
            |_________________________________________________________________|-->

  <nav class="h5 navbar navbar-expand-lg navbar-dark bg-dark-primary fixed-top shadow " id="myNavbar">
    <a class="navbar-brand" href="../index.php"><img src="../Imagenes\logo.png" class="nav-img img-fluid" alt=""></a>

    <!-- BOTON RESPONSIVE-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Catalogo.php?tipo=1" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
            Frutas
          </a>

        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="Catalogo.php?tipo=2" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Verduras
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Catalogo.php?tipo=3" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Congelados
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Catalogo.php?tipo=4" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Tostaduría
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Catalogo.php?tipo=5" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">
            Emporio
          </a>
        </li>
      </ul>

      
      <ul class="navbar-nav">
          <li class="nav-item dropdown" style="display: <?php echo $opciones; ?>">
          <a  class="nav-link text-light dropdown-toggle" data-toggle="dropdown" href="Login.php" class="caret">
          <i class="fa fa-user-circle"></i>
          </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="usuario.php" >Ajustes</a>
              <a class="dropdown-item" href="portalAdmin.php" style="display: <?php echo $privilegio; ?>">Mi portal de administrador</a>
              <a class="dropdown-item" id="enlace_logout">Cerrar sesion</a>
            </div>
          </li>
          <li class="nav-item " style="display: <?php echo $login; ?>">
          <button type="button" class="btn btn-success text-light" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> Ingresar</button>
          </li>
        </ul>
      <form  class="form-inline my-2 my-lg-0"  action="Catalogo.php" method="POST">
            <input type="text" class="form-control mr-sm-2" name="especificacion" REQUIRED placeholder="Buscar">
            <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
      </form>
      <!--BOTON CARRITO-->
      <div class="form-inline ml-2 my-lg-0" id="Carrito" style="display: <?php echo $opciones; ?>">
        <a class="btn btn-success my-2 my-sm-0 text-light" id="carritoBoton" data-toggle="modal" data-target="#modalCarrito">
        <i class="fa fa-shopping-cart" id="iconCarro"></i>
        </a>
      </div>
    </div>
  </nav>
 
<body onload="cargarCarrito(),llamarAjaxConsultaVarible('obtenerTopProductos','#carouselTop','<?php echo $opciones; ?>');">


    <!-- Page Content -->
    <div class="wrapper">

        <div class="row">

            <nav id="sidebar" >
              <div class="container m-3">
                <div>
                  <img src="../Imagenes\logo.png" class="img-responsive img-fluid" alt="">
                </div>

                <div class="list-group" >
                  <?php

                    $buscarClasificacion="SELECT tblTipoId,tblTipoNombre FROM `tbltipo`";
                    $resulatdoBuscarClasificacion=mysqli_query($link,$buscarClasificacion);
                    $cantidadClasificaciones=mysqli_num_rows($resulatdoBuscarClasificacion);

                    for ($i=0; $i < $cantidadClasificaciones; $i++) { 
                      $vector=$resulatdoBuscarClasificacion->fetch_assoc();
                      $tipoNombre=utf8_encode($vector['tblTipoNombre']);
                      $tipoid=$vector['tblTipoId'];
                    ?>
                    <a href="Catalogo.php?tipo=<?php echo $tipoid?>" class="list-group-item btn-outline-success"><?php echo $tipoNombre?></a>
                    <?php
                    }
                    ?>
                    <a href="Catalogo.php?tipo=0" class="list-group-item btn-outline-success">Ver todo</a>
                    <a href="Catalogo.php?Descuento=0" class="list-group-item btn-outline-success">Ver ofertas</a>
                </div>
                <div class="list-group" >
                <form  action="#" method="POST">
                  <div class="form-group">
                    <div class="list-group mt-2" >
                    <p class="m-0">Filtrar por clasificacion: </p>
                  <?php
                    $tipo=$_GET['tipo'];
                    if ($tipo!=0) {
                      $buscarClasificacion="SELECT tblSubTipoId,tblSubTipoNombre FROM `tblsubtipo` where tblTipoId=$tipo";
                    }
                    else{
                      $buscarClasificacion="SELECT tblSubTipoId,tblSubTipoNombre FROM `tblsubtipo`";
                    }
                    $resulatdoBuscarClasificacion=mysqli_query($link,$buscarClasificacion);
                    $cantidadClasificaciones=mysqli_num_rows($resulatdoBuscarClasificacion);

                    for ($i=0; $i < $cantidadClasificaciones; $i++) { 
                      $vector=$resulatdoBuscarClasificacion->fetch_assoc();
                      $subtipo=utf8_encode($vector['tblSubTipoNombre']);
                      $subtipoid=$vector['tblSubTipoId'];
                    ?>
                    <div class="checkbox">
                      <label><input type="checkbox" name="check_list[]" value="<?php echo $subtipoid?>"><?php echo $subtipo?></label>
                    </div>
                    <?php
                    }
                    ?>
                     </div>
                  </div>
                    <button type="submit"  class="btn btn-outline-success"  >Buscar</button>
                </div>
                </form>

            </div>
              </div>
              
            </nav>
            <div id="content">


            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">

                    <button class="btn "  id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                </div>
            </nav>
              

                <div class="card-group">
                  <?php
                  while($fila=$resulatdoConsulta->fetch_assoc()){
                  $sku=$fila['tblProductosCodigoDeBarra'];
                  $especificacion=utf8_encode($fila['tblProductosEspecificacion']);
                  $subtipo=utf8_encode($fila['tblSubTipoNombre']);
                  $imagen=utf8_encode($fila['tblProductosImagen']);
                  $temporada=$fila['tblTemporadaNombre'];
                  $stock=$fila['tblProductosStock'];
                  $medida=$fila['tblMedidaNombre'];
                  $cantidad=$fila['tblProductosCantidad'];
                  $precio=$fila['tblProductosPrecio'];
                  $descuento=$fila['tblProductosDescuento'];
                  $tipo=$fila['tblTipoNombre'];
                  $decimalDescuento=floatval($descuento)/100;
                  if($decimalDescuento>0){
                    $mostrarDescuento="block";
                    $mostrarPrecioNormal="none";
                  }
                  else{
                    $mostrarDescuento="none";
                    $mostrarPrecioNormal="block";
                  }
                  if($stock=="1"){
                    $colorTexto="green";
                    $texto="Disponible";
                    $mostrarCantidad="block";
                  }
                  else{
                    $colorTexto="Red";
                    $texto="Agotado";
                    $mostrarCantidad="none";
                  }
                  $montoDescontar=$precio*$decimalDescuento;
                  $montoFinal=round($precio-$montoDescontar);
                  ?>


                    <div class="col-sm-3 mt-5">
                      <div class="card card-small-shadow ">
                       <form  onsubmit="ingresarCarro(<?php echo $sku?>);return false">       
                        <!--IMAGEN-->
                              <div class="row align-items-center justify-content-center">
                                <div class="col-sm-8 ">
                                  <img class="card-img-top w-100  img-responsive img-fluid p-1"  src="<?php echo $imagen?>" alt="">
                                </div>
                              </div>
                                    
                              <div class="card-body justify-content-center">
                                <!--MODELO-->
                                <h5 class="text-center"><strong><?php echo utf8_decode($especificacion) ?></strong> <!--<strong><?php echo $subtipo?></strong>--></h5> 
                                <p class="text-center m-0">SKU: <?php echo $sku?> </p>
                                <!--CANTIDAD-->
                                <p class="text-center"><?php echo $cantidad?> (<?php echo $medida?>) </p>
                                  <!--PRECIO-->
                                  <h5 class="text-center"> <strong style="display: <?php echo $mostrarPrecioNormal ?>"><?php echo moneda_chilena("$precio")?></strong>
                                  <!--PRECIO TACHADO-->
                                  <strike class="text-center" style="display: <?php echo $mostrarDescuento ?>"><?php echo moneda_chilena("$precio")?></strike>
                                  <!--PRECIO CON DESCUENTO-->
                                  <strong class="text-center" style="display: <?php echo $mostrarDescuento ?>;color:red"><?php echo moneda_chilena("$montoFinal")?></strong></h5>


                                <strong class="text-center" style="display: <?php echo $mostrarDescuento ?>;color:red">Descuento: <?php echo $descuento?>% </strong>
                                
                                
                                <p class="text-center"><strong style="color: <?php echo $colorTexto ?>" > <?php echo $texto ?> </strong> </p>
                                
                                <div  class="text-center"style="display: <?php echo $opciones; ?>">
                                  <div class="form-group " style="display:<?php echo $mostrarCantidad ?>">
                                     Cantidad: 
                                     <input  name="cantidad" type="number" class="form-control text-center" min="1" value="1" id="<?php echo $sku?>" />
                                  </div>
                                  <!--Agregar-->
                                  <div >
                                      <p class="col-auto"> <button onclick="agregadoToast()" type="submit" class="btn btn-outline-success w-100" style="display:<?php echo $mostrarCantidad ?>"><i class="fa fa-plus"></i><i class="fa fa-shopping-cart"></i></button></p>
                                  </div>
                                </div>
                              
                            </div>
                          </form>
                      </div>
                    </div>
                    <?php
                    }
                    ?>

                </div>
                <!--
                <div class="mt-3">
                  <ul class="pagination justify-content-center">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </div>
                -->

            </div>

        </div>

            <div class="container">
                  <div class="row ">
                  <div class="col-md-12">
                    <h2 id="favoritos">Los <b>Favoritos</b></h2>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Carousel indicators 
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>   -->
                    <!-- Wrapper for carousel items -->
                    <div class="carousel-inner" id="carouselTop">
                    </div>
                    <!-- Carousel controls -->
                    <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                      <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                  </div>

                </div>
    </div>

        <!-- _________________________________________________________________
            |                                                                 |
            |                               FOOTER                            |
            |_________________________________________________________________|-->
<!-- Footer -->
    <footer class="footer text-center mt-5 bg-dark-primary shadow-sm" id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class=" mb-4">Ubicación</h4>
            <p class="lead mb-0">Santiago<br>Región Metropolitana</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class=" mb-4">Encuentranos en</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.instagram.com/agrofrezdelivery/" target="_blank">
                  <i class="fa fa-fw fa-instagram"></i>
                </a>
              </li>
               <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://api.whatsapp.com/send?phone=56942582353&text=Hola%2C%20deseo%20conocer mas información sobre los productos ofrecidos." target="_blank">
                  <i class="fa fa-fw fa-whatsapp"></i><img src="../Imagenes/botones/WhatsApp_icon.png" border="0" style="position: fixed ; right: 15px; bottom:3%; z-index:3">
                </a>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class=" mb-4">Informaciones</h4>
            <i class="fa fa-envelope text-white"></i><i class="lead m-2"><a class="text-white" href="mailto:contacto@agrofrez.cl">agrofrezdelivery@gmail.com</a></i><br>
            <i class="fa fa-phone text-white"></i><i class="lead m-2 text-white">+56942582353</i>
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>&copy; Agrofrez 2015</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>



        <!-- _________________________________________________________________
            |                                                                 |
            |                               MODALS                            |
            |_________________________________________________________________|-->
    <!-- MODAL  LOGIN -->
    <div class="modal fade" id="modalLogin">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <!-- HEADER -->
              <div class="modal-header">
                <h4 class="modal-title">Iniciar sesión</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- BODY -->
              <div class="modal-body">
            <form method="POST" onsubmit="return false"  >
                <div class="form-group">
                    <div class="col-auto">
                      <label for="usr">Correo:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>
                        <input type="text" class="form-control" name="mail-log" id="mail-log" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" placeholder="example@example.com" title="Debe ser un correo válido" onchange="llamarAjaxIndex(this.value,'verificarCorreoNoExistente',null)" required> 
                      </div>
                      <label class="text-danger error" id="errorUser">*El Email no existe, verifique que esté correcto</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-auto">
                      <label for="pwd">Clave:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        </div>
                        <input type="password" class="form-control" name="pass-log" id="pass-log" minlength="6" maxlength="15" required>
                      </div>
                      <label class="text-danger error" id="errorPass">*Clave incorrecta </label>
                      <button type="button" id="btnForgot" class="btn btn-light mt-2">¿Olvidaste tu contraseña?</button>
                    </div>
                </div>
              <!-- FOOTER -->
              <div class="modal-footer">
                <button type="button" id="btnRegistro" class="btn btn-primary" >Deseo registrarme</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" id="btn_login">Iniciar sesión</button>
              </div>
              </form>

            </div>
          </div>
        </div>
    </div>
  </div>
    <!-- MODAL QUIENES REGISTRARSE-->
    <div class="modal fade" id="modalRegistrarme">
          <div class="modal-dialog modal-lg">
            <div class="modal-content modalRegistro">

              <!-- HEADER -->
              <div class="modal-header">
                <h4 class="modal-title">Registrarme</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- BODY -->
              <div class="modal-body modalRegistroBody">
            <form method="POST"  onsubmit="return false" >
                <div class="form-group">
                    <div class="col-auto">
                      <label for="usr">Correo:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>
                        <input type="text" class="form-control" name="mail" id="mail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" placeholder="example@example.com" title="Debe ser un correo válido" onchange="llamarAjaxIndex(this.value,'verificarCorreoExistente',null)" required> 
                    </div>
                    <label class="text-danger error" id="errorUser2">*Ya existe un usuario con éste correo, verifique que este correcto</label>
                </div>
                <div class="form-group">
                    <div class="col-auto">
                      <label for="pwd">Clave:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        </div>
                        <input type="password" class="form-control" name="clave1_reg" id="clave1_reg" minlength="6" maxlength="15" required>
                      </div>
                    </div>
                    <div class="col-auto">
                      <label  for="pwd">Ingrese su clave nuevamente:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        </div>
                        <input type="password" class="form-control" name="clave2_reg" id="clave2_reg" minlength="6" maxlength="15" required>
                      </div>
                      <label class="text-danger error" id="errorPass_reg">*Las claves deben ser identicas </label>
                      <br>
                    </div>
                  </div>
              <!-- FOOTER -->
              <div class="modal-footer modalRegistroFooter">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" id="btn_registrar">Registrarme</button>
              </div>
              </form>

            </div>
          </div>
        </div>
    </div>


     </div>
     <!-- MODAL QUIENES FORGOT-->
    <div class="modal fade" id="modalForgot">
          <div class="modal-dialog modal-lg">
            <div class="modal-content modalOlvide">

              <!-- HEADER -->
              <div class="modal-header">
                <h4 class="modal-title">Recuperar contraseña</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- BODY -->
              <div class="modal-body modalForgotBody">
            <form method="POST"  onsubmit="return false" >
                <div class="form-group">
                    <div class="col-auto mb-5">
                      <label for="usr">Correo:</label>
                      <div class="input-group ">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>
                        <input type="text" class="form-control " name="mailForgot" id="mailForgot" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" placeholder="example@example.com" title="Debe ser un correo válido" onchange="llamarAjaxIndex(this.value,'verificarCorreoNoExistenteRecordar',null)" required> 
                    </div>
                    <label class="text-danger error" id="errorUserForgot">*No existe un usuario con éste correo, verifique que este correcto</label>
                </div>
              <!-- FOOTER -->
              <div class="modal-footer modalForgotFooter">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" id="btn_forgot">Enviar</button>
              </div>
              </div>
              </form>

            </div>
          </div>
        </div>
    </div>
    <!-- MODAL CARRITO DE COMPRA -->
    <div class="modal fade" id="modalCarrito">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" >

          <!-- HEADER -->
          <div class="modal-header">
            <h4 class="modal-title">Mi carro de compra.</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- BODY -->
            <div class="modal-body"> 
              <div class="table-responsive">                  
                  <table class="table">
                    <thead>
                      <tr>
                        <th>SKU</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                      </tr>
                    </thead>    
                    <tbody id="detalleCarro" class="scrollbar-success bg-light">  
                    </tbody>              
                  </table>
              </div>
              </div>         
            <!-- FOOTER -->
            <div class="modal-footer">
              
              <button type="button" class="btn btn-danger" id="btnCerrar" data-dismiss="modal" >Cerrar</button>
            </div>

          </div>
        <!--</div>-->
      </div>
    </div>


  <!-- Bootstrap Core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <!-- Carousel Core JavaScript -->
  <script src="../JScript/carousel.js"></script>
  <script src="../JScript/Funciones.js"></script>
  <script src="../JScript/AJAX.js"></script>

</body>

</html>
