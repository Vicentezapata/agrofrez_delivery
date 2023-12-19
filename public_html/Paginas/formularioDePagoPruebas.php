<?php
  include("../Back-end/opcionesIndex.php");
  //include("../Back-end/carrito_de_compra.php")
?>
<!DOCTYPE html>
<style type="text/css">
  .error{
    display: none;
  }
</style>
<html lang="en">
<head>
    <meta charset="utf-8">
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
 
 
<body onload="cargarCarrito(),obtenerDatosUsuario();">
 <!-- <form onsubmit="ingresarPedido();return false;">-->
  <form action="../Librerias/Flow/examples/payments/create.php" method="POST">
  <div class="col-auto mt-5">
      <div class="card text-center shadow">
    <div class="card-header">
      <h2>Solicitud de pedido</h2>
    </div>
    <div class="card-body">
      <div class="card-group mb-4">
        <div class="row">

          <div class="col-sm-6">
            <div class="card shadow">
              <div class="card-header">
                  <h4>Datos del usuario</h4>
                </div>
                <div class="card-body">
                  <!--__________________________INFORMACION DATOS PERSONALES_________________-->
              <h3 class="card-title"><i class="fa fa-address-card"></i> Datos personales</h3>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Nombre</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="nombre" id="nombre"  readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Apellido</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="apellido" id="apellido"  readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Fecha nacimiento</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="fechaNac" id="fechaNac"  readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Teléfono</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="fono" id="fono" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Género</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="genero" id="genero"  readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="input-group-append ">
                <button class="btn btn-outline-secondary" type="button" id="btnEditInfoUser"   onclick="habilitarCampo('#persona')">Editar <span class="fa fa-edit"></span></button><p id="flagUser" class="d-none">Sin modificaciones</p>
              </div>
              <!--__________________________INFORMACION DE DIRECCION PERSONAL_________________-->
              <h3 class="card-title"><i class="fa fa-building"></i> Dirección de despacho</h3>
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Región</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="region" id="region"  readonly required>
                  

                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Ciudad</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="ciudad" id="ciudad" readonly required>
                    
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Comuna</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="comuna" id="comuna" readonly required>
                    
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Calle</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="calle" id="calle" readonly required>
                  
                  </div>
                </div>
              </div>

              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Número</div>
                    </div>
                    <input type="text" class="form-control justify-content-center" name="num" id="num" readonly required>
                    
                  </div>
                </div>
              </div>
              <div class="input-group-append mb-2">
                <button class="btn btn-outline-secondary" type="button" id="btnEditDirecc"  onclick="habilitarCampo('#direccion')">Editar <span class="fa fa-edit"></span></button><p id="flagAddress" class="d-none">Sin modificaciones</p>
              </div>
                </div>
              </div>
            </div>
          

          <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header">
                  <h4>Listado de productos</h4>
                </div>
                  <div class="table-responsive ">          
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
                    <tbody id="detalleCarro">
                    </tbody>
                  </table>
                </div> 
                </div>
          </div>
        </div>
        
      </div>

       <div class="card-group ">
          <div class="col-sm-6">
              <div class="card shadow mt-3">
                <div class="card-header">
                  <h4>Comentarios</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                      <label for="sel1">Escríbenos tus comentarios</label>
                      <textarea class="form-control" rows="5" id="comment"></textarea>
                    </div>
                </div>
              </div>

          </div>

          <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-header">
                  <h4>Información de envío</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                      
                      <div class="row">
                        <div class="col">
                          <h6 for="sel1">Recibir en caja de:</h6>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="caja" value="Plastico" checked>Plástico
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="caja" value="Carton">Cartón
                          </label>
                        </div>
                        </div>
                        
                      </div>
                      
                      <div class="row mt-3">
                        <div class="col">
                          <h6 for="sel1">Recibir en bolsa de plástico:</h6>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="bolsa" value="Si" checked>Si
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="bolsa" value="No">No
                          </label>
                        </div>
                        </div>
                        
                      </div>
                    </div>
                </div>
              </div>
              <div class="card shadow mt-3">
                <div class="card-header">
                  <h4>Métodos de pago</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                      <label for="sel1">Seleccione el método de pago</label>
                      <select type="text" name="metodoPago" class="form-control" id="metodoPago" onchange="mostrarInfoPago(this.value)">
                        <option value="0">Seleccione una opción</option>
                        <option value="1">Abonar dinero vía webpay</option>
                        <option value="2">Transferencia (previa al despacho)</option>
                        <option value="3">Efectivo (Total de la compra)</option>
                      </select>
                    </div>
                </div>
              </div>
 
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Realizar pedido</button>
      </div>
    </div>
   
  </div>
   </form>
  <div class="line"></div>
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
                <h4 class="modal-title">Iniciar sesion</h4>
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


    <!-- Bootstrap Core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- Carousel Core JavaScript -->
  <script src="../JScript/carousel.js"></script>
  <script src="../JScript/Funciones.js"></script>
  <script src="../JScript/AJAX.js"></script>



</html>
