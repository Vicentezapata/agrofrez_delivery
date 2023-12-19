<?php
  include("../Back-end/opcionesIndex.php");
  /*SELECT count(*)FROM tbldirecciones where tblUsuarioCorreo='vzc'
  SELECT count(*) FROM `tbldireccion` WHERE `tblPersonaId`=(select `tblPersonaId` from tblpersona where `tblUsuarioCorreo`='vicho@usach.cl')
  SELECT count(*) FROM `tblpersona` WHERE`tblUsuarioCorreo`='vicho@usach.cl'*/
  include("../Back-end/Conexion DB.php");
  $link = conexion::conectar(); // lamamos a un metodo de otro metodo, SELF, llama a un metodo dentro de la misma clase.
  $query = 'SELECT direc.tblDireccionNombre,direc.tblDireccionNumero,com.tblComunaNombre,ciu.tblCiudadNombre,reg.tblRegionNombre,us.tblUsuarioCorreo,us.tblUsuarioContrasennia,per.tblPersonaNombre,per.tblPersonaApellido,per.tblPersonaFechaNacimiento,gen.tblGeneroNombre,per.tblPersonaFono FROM tbldireccion as direc,tblpersona as per,tblregion as reg, tblciudad as ciu,tblcomuna as com,tblusuario as us,tblgenero as gen WHERE us.tblUsuarioCorreo="'.$correo.'" and per.tblPersonaId=direc.tblPersonaId and reg.tblRegionId=ciu.tblRegionId and ciu.tblCiudadId=com.tblCiudadId and direc.tblComunaId=com.tblComunaId and gen.tblGeneroId=per.tblPersonaGeneroId and per.tblUsuarioCorreo=us.tblUsuarioCorreo';
  $resulatdoConsulta=mysqli_query($link,$query);
  $cantidadDeRegistros=mysqli_num_rows($resulatdoConsulta);
  if ($cantidadDeRegistros>0) {
    while($fila=$resulatdoConsulta->fetch_assoc()){
    $direccionNumero=utf8_encode($fila['tblDireccionNumero']);
    $direccionNombre=utf8_encode($fila['tblDireccionNombre']);
    $comuna=utf8_encode($fila['tblComunaNombre']);
    $ciudad=utf8_encode($fila['tblCiudadNombre']);
    $region=utf8_encode($fila['tblRegionNombre']);

    $nombre=$fila['tblPersonaNombre'];
    $apellido=$fila['tblPersonaApellido'];
    $fechaNac=date( "d-m-Y",strtotime($fila['tblPersonaFechaNacimiento']));
    $fono=$fila['tblPersonaFono'];
    $genero=$fila['tblGeneroNombre'];

    $pass=$fila['tblUsuarioContrasennia'];
    
    }
  }
  else{
    $direccionNumero="";
    $direccionNombre="";
    $comuna="";
    $ciudad="";
    $region="";

    $nombre="";
    $apellido="";
    $fechaNac="";
    $fono="";
    $genero="";
    $query = 'SELECT us.tblUsuarioContrasennia FROM tblusuario as us WHERE us.tblUsuarioCorreo="'.$correo.'"';
    $resulatdoConsulta=mysqli_query($link,$query);
    while($fila=$resulatdoConsulta->fetch_assoc()){
      $pass=$fila['tblUsuarioContrasennia'];
    }
  }
  conexion::cerrar($link);
  
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Agrofrez Delivery</title>
    <link rel="shortcut icon" href="../Imagenes/logo.ico">    <!-- Bootstrap Core CSS -->
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
          <a class="nav-link text-light" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> Ingresar</a>
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





        <!-- _________________________________________________________________
            |                                                                 |
            |                               BODY                              |
            |_________________________________________________________________|-->
<body onload="cargarCarrito();">
  <br>
  <br>
  <form action="../Back-end/Controlador.php?flag='user'" method="POST">  
    <div class="container mb-5 mt-5">
      <div class="col-md ">
        <div class="card  text-center shadow">
          <div class="card-header">
            <h5 >Ajustes</h5>
          </div>
          <div class="panel-body">
            <div class="container ">
              <h3 class="card-title"><i class="fa fa-users"></i> Datos</h3>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><span class="fa fa-envelope"></span></div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="mail" id="mail" value="<?php echo $correo;?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Contraseña</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><span class="fa fa-lock"></span></div>
                    </div>
                    <input type="password" class="form-control justify-content-center" name="clave" id="clave" value="<?php echo $pass;?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="input-group-append ">
                <button class="btn btn-outline-secondary" type="button"  onclick="habilitarCampo('#usuario')">Editar <span class="fa fa-edit"></span></button>
              </div>
              <!--__________________________INFORMACION DATOS PERSONALES_________________-->
              <h3 class="card-title"><i class="fa fa-address-card"></i> Datos personales</h3>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Nombre</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="nombre" id="nombre" value="<?php echo $nombre?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Apellido</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="apellido" id="apellido" value="<?php echo $apellido;?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Fecha nacimiento</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="fechaNac" id="fechaNac" value="<?php echo $fechaNac;?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Telefono</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="fono" id="fono" value="<?php echo $fono;?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Genero</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="genero" id="genero" value="<?php echo $genero;?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="input-group-append ">
                <button class="btn btn-outline-secondary" type="button"  onclick="habilitarCampo('#persona')">Editar <span class="fa fa-edit"></span></button>
              </div>
              <!--__________________________INFORMACION DE DIRECCION PERSONAL_________________-->
              <h3 class="card-title"><i class="fa fa-building"></i> Direccion personal</h3>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Region</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="region" id="region" value="<?php echo $region;?>" readonly required>
                  

                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Ciudad</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="ciudad" id="ciudad" value="<?php echo $ciudad;?>" readonly required>
                    
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Comuna</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="comuna" id="comuna" value="<?php echo $comuna;?>" readonly required>
                    
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Calle</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="calle" id="calle" value="<?php echo $direccionNombre;?>" readonly required>
                  
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <label class="sr-only" for="inlineFormInputGroup">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Numero</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="num" id="num" value="<?php echo $direccionNumero;?>" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="input-group-append mb-2">
                <button class="btn btn-outline-secondary" type="button"  onclick="habilitarCampo('#direccion')">Editar <span class="fa fa-edit"></span></button>
              </div>

            </div>        
          </div>
          <div class="card-footer text-muted">
              <button type="submit" class="btn btn-success" type="button" id="p">Guardar</button>
              <a href="../index.php" class="btn btn-outline-success" role="button">Atras</a>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- MODAL REGISTRO -->
        <div class="modal fade" id="modalGuardar">
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
                  <i class="fa fa-fw fa-whatsapp"></i><img src="../Imagenes/botones/WhatsApp_icon.png" border="0" style="position: fixed ; left: 15px; bottom:3%; z-index:3">
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

    <!-- MODAL CARRITO DE COMPRA -->
    <div class="modal fade" id="modalCarrito">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 880px;">

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
              <button type="button" class="btn btn-danger"  id="btnCerrar" data-dismiss="modal" >Cerrar</button>
            </div>

          </div>
        </div>
      </div>
    </div>

      <!-- Bootstrap Core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- Carousel Core JavaScript -->
  <script src="../JScript/Funciones.js"></script>
  <script src="../JScript/AJAX.js"></script>

</html>