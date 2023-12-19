<?php
  include("../Back-end/conexion.php");
  include("../Back-end/opcionesIndex.php");
  include("../Back-end/datosPersonas.php");
  include("../Back-end/carrito_de_compra.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
       <link href="../Estilos/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Iconos/Icomoon/iconos.css">
  <link rel="stylesheet" type="text/css" href="../Estilos/login.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <title>Pagliaccio il shark</title>
</head>
        <!-- _________________________________________________________________
            |                                                                 |
            |                            NAVEGADOR                            |
            |_________________________________________________________________|-->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="../index.php"><span class="glyphicon glyphicon-home"></span></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hombres <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="Catalogo.php?clasificacion=Ropa&genero=M">Ropa</a></li>
              <li><a href="Catalogo.php?clasificacion=Accesorios&genero=M">Accesorios</a></li>
              <li><a href="Catalogo.php?clasificacion=Calzado&genero=M">Calzado</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Mujeres<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="Catalogo.php?clasificacion=Ropa&genero=F">Ropa</a></li>
              <li><a href="Catalogo.php?clasificacion=Accesorios&genero=F">Accesorios</a></li>
              <li><a href="Catalogo.php?clasificacion=Calzado&genero=F">Calzado</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Niños<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="Catalogo.php?clasificacion=Ropa&genero=N">Ropa</a></li>
              <li><a href="Catalogo.php?clasificacion=Accesorios&genero=N">Accesorios</a></li>
              <li><a href="Catalogo.php?clasificacion=Calzado&genero=N">Calzado</a></li>
            </ul>
          </li>
        </ul>
        <!--BOTON CARRITO-->
        <div class="navbar-form navbar-right" id="Carrito" style="display: <?php echo $opciones; ?>">
          <a type="button" class="btn btn-info " style="background-color: #333" id="carritoBoton" href="carritoDeCompra.php"><?php echo $cantidadDeElementos ?>
          <span class="glyphicon glyphicon-shopping-cart"></span>
          </a>
        </div>
        <form class="navbar-form navbar-right"  action="Catalogo.php" method="POST">
          <div class="input-group">
            <input type="text" class="form-control" name="especificacion" REQUIRED placeholder="Buscar">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown" style="display: <?php echo $opciones; ?>">
          <a  class="dropdown-toggle" data-toggle="dropdown" href="Login.php" class="caret">
          <span class="glyphicon glyphicon-user"></span>
          
           <?php echo $usuario;?>
           <span class="caret"></span>
          </a>
            <ul class="dropdown-menu">
              <li><a href="Usuario.php">Ajustes</a></li>
              <li><a href="Ingresar productos.php" style="display: <?php echo $privilegio; ?>">Ingresar Productos</a></li>
              <li><a href="Consultar stock.php" style="display: <?php echo $privilegio; ?>">Consultar stock</a></li>
              <li><a href="Buscar_inventario.php" style="display: <?php echo $privilegio; ?>">Modificar inventario</a></li>
              <li><a href=../Back-end/cerrarSesion.php>Cerrar sesion</a></li>
            </ul>
          </li>
          <li style="display: <?php echo $login; ?>"><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Ingresar</a></li>
        </ul>
      </div>
    </div>
  </nav>
<body>
<br>
<br>
<br>
<br>
<body>
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
                  <div class="panel-body">
                      <h5 class="text-center">
                          Ingresar</h5>
                      <form class="form form-signup" role="form" action="#" method="POST">
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                              <input type="email" class="form-control" REQUIRED name="correo"  placeholder="Correo: ejemplo@mail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <div>
                            <center id=errorInicio style="display: <?php echo $error_login; ?>">Usuario o clave incorrecto</center>
                          </div>
                      </div>
                  </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-block" >Enviar Solicitud</button></form>
                    <a href=login.php class="btn btn-sm btn-primary btn-block" role="button">
                        Atras</a>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div> 
</body>
      <!-- _________________________________________________________________
            |                                                                 |
            |                               FOOTER                            |
            |_________________________________________________________________|-->
<footer class="footer-distributed">
  <div class="footer-left">
    <h3>P.I.S<span> Shop</span></h3>
    <p class="footer-company-name">P.I.S &copy; 2017</p>
  </div>
  <div class="footer-center">
    <div>
      <i class="fa fa-map-marker"></i>
      <p><span>Del Rodeo #0193</span> Quilicura, Santiago</p>
    </div>
    <div>
      <i class="fa fa-phone"></i>
      <p>+569 94372359</p>
    </div>
    <div>
      <i class="fa fa-envelope"></i>
      <p><a href="mailto:Pagliaccioilshark@Gmail.com">Pagliaccioilshark@Gmail.com</a></p>
    </div>
  </div>
  <div class="footer-right">
    <p class="footer-company-about">
      <span>Acerca de nosotros</span>
      Pagliaccio il shark es una compañia ficticia para el desarrollo de webs de tiendas,este uso es solo para el aprendisaje.
    </p>
    <div class="footer-icons">
      <a href="http://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
      <a href="http://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
      <a href="http://www.instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
    </div>
  </div>
  </footer>

</html>