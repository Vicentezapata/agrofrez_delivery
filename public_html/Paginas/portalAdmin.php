<?php
include("../Back-end/opcionesIndex.php");
if(isset($_SESSION["correoAgrofrez"])){
$correo=$_SESSION["correoAgrofrez"];	
}
if($privilegio == 'block'){
?>
<!DOCTYPE html>
<html lang="es">

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
    <link rel="stylesheet" href="../Estilos/style5.css">

</head>
<style type="text/css">
  .error{
    display: none;
  }
</style>
<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="container">
                    <img src="../Imagenes\logo.png" class="img-responsive img-fluid" alt="">
                </div>
            
            </div>

            <ul class="list-unstyled components">
                <li >
                    <a href="#ProductosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Productos <?php echo $correo; ?></a>
                    <ul class="collapse list-unstyled" id="ProductosSubmenu">
                        <li>
                            <a  id="ingresarProductos">Ingresar producto.</a>
                        </li>
                        <li>
                            <a  id="consultarProductos">Consultar producto</a>
                        </li>
                        <li>
                            <a  id="modificarProductos">Actualizar/Eliminar producto</a>
                        </li>
                    </ul>
                </li>
                <li >
                    <a href="#pedidosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Mis pedidos</a>
                    <ul class="collapse list-unstyled" id="pedidosSubmenu">
                        <li>
                            <a id="verPedidos">Pedidos agendados.</a>
                        </li>
                        <li>
                            <a id="verResumenPedidoProd">Resumen del día.</a>
                        </li>
                        <li>
                            <a id="validarPago">Validar pago.</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#EstadisticasSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Estadisticas</a>
                    <ul class="collapse list-unstyled" id="EstadisticasSubmenu">
                        <li>
                            <a id="cambiosProductos">Ver historial de cambios en productos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#ajustesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ajustes</a>
                    <ul class="collapse list-unstyled" id="ajustesSubmenu">
                        <li>
                            <a  id="adminCategoria"">Administrar categoria</a>
                        </li>
                        <li>
                            <a  id="adminSubCategoria"">Administrar subcategoria</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#ayudaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ayuda</a>
                    <ul class="collapse list-unstyled" id="ayudaSubmenu">
                        <li>
                            <a href="https://api.whatsapp.com/send?phone=56994372359&text=Hola Vicente, necesito ayuda tecnica." target="_blank">Contactar con servicio tecnico vía Whatsapp</a>
                        </li>
                        <!--<li>
                            <a   href="mailto:vicentezapatac@gmail.com">Contactar con servicio tecnico via e-mail</a>
                        </li>-->
                    </ul>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                 <li>
                    <a id="enlace_logout" class="article">Cerrar sesion</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link"  href="././Catalogo.php?tipo=0">Ver catalogo</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link"  href="../index.php" >Ver pagina principal</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="frame">
                
            </div>


        </div>
    </div>
            <!-- MODAL REGISTRO -->
            <div class="modal fade" id="modalRespuesta">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- HEADER -->
                        <div class="modal-header">
                        <h4 class="modal-title">Respuesta</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- BODY -->
                        <div class="modal-body">

                        </div>

                        <!-- FOOTER -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>
            </div>
</body>
   <!-- Bootstrap Core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- Carousel Core JavaScript -->
  <script src="../JScript/Funciones.js"></script>
  <script src="../JScript/FuncionesPortal.js"></script>
  <script src="../JScript/AJAX.js"></script>
<?php
}
else{
    header("Location: Catalogo.php?tipo=0");
    die();
}
?>