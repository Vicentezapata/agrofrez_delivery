<?php
  include("Back-end/opcionesIndex.php");
  include("../Back-end/Conexion DB.php");
  //include("Back-end/carrito_de_compra.php");
?>
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Carousel CSS -->
  <link rel="stylesheet" href="Estilos/estilos carousel.css">
  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="Estilos/style.css">
  <title>Agrofrez Delivery</title>
  <link rel="shortcut icon" href="Imagenes/logo.ico">
</head>
<style type="text/css">
  .error{
    display: none;
  }
</style>
<body onload="cargarCarrito(),llamarAjaxConsultaVarible('obtenerTopProductos','#carouselTop','<?php echo $opciones; ?>');">

        <!-- _________________________________________________________________
            |                                                                 |
            |                            NAVEGADOR                            |
            |_________________________________________________________________|-->

  <nav class="h5 navbar navbar-expand-lg navbar-dark bg-dark-primary fixed-top shadow " id="myNavbar">
    <a class="navbar-brand" href="#"><img src="Imagenes\logo.png" class="nav-img img-fluid" alt=""></a>

    <!-- BOTON RESPONSIVE-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Paginas/Catalogo.php?tipo=1" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
            Frutas
          </a>

        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="Paginas/Catalogo.php?tipo=2" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Verduras
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Paginas/Catalogo.php?tipo=3" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Congelados
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Paginas/Catalogo.php?tipo=4" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Tostaduría
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-light" href="Paginas/Catalogo.php?tipo=5" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">
            Emporio
          </a>
        </li>
      </ul>

      
      <ul class="navbar-nav">
          <li class="nav-item dropdown" style="display: <?php echo $opciones; ?>">
          <a  class="nav-link text-light dropdown-toggle" data-toggle="dropdown" href="Paginas/Login.php" class="caret">
          <i class="fa fa-user-circle"></i>
          </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="Paginas/usuario.php" >Ajustes</a>
              <a class="dropdown-item" href="Paginas/portalAdmin.php" style="display: <?php echo $privilegio; ?>">Mi portal de administrador</a>
              <a class="dropdown-item" id="enlace_logout">Cerrar sesion</a>
            </div>
          </li>
          <li class="nav-item " style="display: <?php echo $login; ?>">
          <button type="button" class="btn btn-success text-light" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> Ingresar</button>
          </li>
        </ul>
      <form  class="form-inline my-2 my-lg-0"  action="Paginas/Catalogo.php" method="POST">
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
  <div class="container mt-5 pt-5">
    <div class="container text-center">
      <img src="Imagenes\logo.png" class="img-responsive img-fluid" alt="">
      <br>
      <a class="btn btn-outline-success" data-toggle="modal" data-target="#modalQuienesSomos">¿Quiénes somos?</a>
      <a class="btn btn-outline-success" data-toggle="modal" data-target="#modalTerminos">Términos y condiciones de compra</a>
    </div>
     
  </div>
  <div class="m-4">
    <img src="/Imagenes/AgroFrez_web.png" class="img-fluid"  alt="Cinque Terre">
  </div>

  <div class="container  pt-2">
    <div class="row ">
    <div class="col-md-12">
      <h2 id="favoritos">Los <b>Favoritos</b></h2>
      <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
      <!-- Carousel indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>   
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


  <section class="mt-5" id="categorias">
  <div class="container mt-5">
      <div class="card-group">
        <div class="col-sm-4">
          <div class="card shadow-sm">
            <a class="card-link" href="Paginas/Catalogo.php?tipo=1">
              <img class="card-img-top img-thumbnail" src="Imagenes\Publicidad\frutas.png" alt="Ropa">
              <p class="h5 text-center text-muted">Frutas</p>
            </a>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card shadow-sm">
            <a class="card-link" href="Paginas/Catalogo.php?tipo=2">
                <img class="card-img-top img-thumbnail" src="Imagenes\Publicidad\verduras.jpg" alt="Accesorios">
                <p class="h5 text-center text-muted">Verduras </p>
            </a>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card shadow-sm">
            <a class="card-link" href="Paginas/Catalogo.php?tipo=3">
              <img class="card-img-top img-thumbnail" src="Imagenes\Publicidad\congelados.jpg" alt="Calzado">
              <p class="h5 text-center text-muted">Congelados</p>
            </a>
          </div>
        </div>
        <div class="col-sm-4  mt-3">
          <div class="card shadow-sm">
            <a class="card-link" href="Paginas/Catalogo.php?tipo=4">
              <img class="card-img-top img-thumbnail" src="Imagenes\Publicidad\tostaduria.jpg" alt="Packs">
              <p class="h5 text-center text-muted">Tostaduría</p>
            </a>
          </div>
        </div>
        <div class="col-sm-4 mt-3">
          <div class="card shadow-sm">
            <a class="card-link" href="Paginas/Catalogo.php?tipo=5">
              <img class="card-img-top img-thumbnail"  src="Imagenes\Publicidad\emporio.jpg" alt="Temporada">
              <p class="h5 text-center text-muted">Emporio</p>
            </a>
          </div>
        </div>
        <div class="col-sm-4  mt-3">
          <div class="card shadow-sm">
            <a class="card-link" href="Paginas/Catalogo.php?Descuento=0">
              <img class="card-img-top img-thumbnail"  src="Imagenes\Publicidad\ofertas.jpg" alt="Ofertas">
              <p class="h5 text-center text-muted">Ofertas</p>
            </a>
          </div>
        </div>
      </div>
    </div>
    
    
      
    </div>

  </section>

</body>
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
            <h4 class=" mb-4">Encuéntranos en</h4>
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
                  <i class="fa fa-fw fa-whatsapp"></i><img src="Imagenes/botones/WhatsApp_icon.png" border="0" style="position: fixed ; right: 15px; bottom:3%; z-index:3">
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




         <!-- MODAL QUIENES SOMOS -->
        <div class="modal fade" id="modalQuienesSomos">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <!-- HEADER -->
              <div class="modal-header">
                <h4 class="modal-title">¿Quiénes somos?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- BODY -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <h5>Historia</h5>
                    <p>AgroFrez SPA nació hace más de 10 años como una empresa familiar enfocada en la distribución de frutas, verduras, tostaduría y huevos para casinos, restaurantes y cafeterías, ahora en su segunda generación ha nacido AgroFrez Delivey SPA, con el mismo empeño y determinación para llevar productos frescos y saludables de todos estos años ahora a domicilio.</p>
                  </div>
                  <div class="col-md-6">
                    <h5>Valores y Misión</h5>
                    <p>Con un compromiso absoluto para facilitar una forma de vida más saludable AgroFrez Delivery busca incansablemente reconciliar los beneficios de una dieta saludable con comida deliciosa. Hemos hecho la salud y felicidad de nuestros clientes nuestra meta. Nuestro sello personal son productos de primera calidad y atención personalizada en un 100% .</p>
                  </div>
                </div>
              <!-- FOOTER -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
          </div>
        </div>
    </div>



         <!-- MODAL TERMINOS DE COMPRA -->
        <div class="modal fade" id="modalTerminos">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <!-- HEADER -->
              <div class="modal-header">
                <h4 class="modal-title">Términos y condiciones de compra</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- BODY -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <h5>Política de Recepción y Despacho.</h5>
                    <p>Todos los pedidos recibidos y reconocidos antes de las 21:00 horas serán procesados para ser despachados en la siguiente jornada laborable, los pedidos recibidos después de dicha hora serán sujetos al corte del sistema de distribución y será procesados a la mañana siguiente para ser despachados al otro día con status prioritario (Excepciones aplican únicamente si son aprobadas por AgroFrez Delivery Spa.)<p>
                    <h5>Política de Devolución, Reemplazo y Compensaciones.</h5>
                    <p>Todos los productos entregados por AgroFrez Delivery SPA que no cumplan con el estándar establecido o no sean lo previamente acordado con el cliente tienen un índice de cambio o devolución de dinero en un plazo de 24hs post entrega. Dichos productos deben ser conservados para poder realizar un cambio.</p>
                    <h5>Políticas de Entregas.</h5>
                    <p>Todos los pedidos que fueran recibidos y despachados por acuerdo previo con el cliente que no puedan ser recibidos por razones asociadas al cliente podrán ser entregados el mismo día en un horario diferente o día posterior bajo el coste extra de 3.500 del pedido total como costos extras asociados a un nuevo despacho.</p>
                  </div>
                </div>
              <!-- FOOTER -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
          </div>
        </div>
    </div>
         <!-- MODAL CARRITO DE COMPRA -->
    <div class="modal fade" id="modalCarrito">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

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



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <script src="JScript/carousel.js"></script>
  <script src="JScript/Funciones.js"></script>
  <script src="JScript/AJAX.js"></script>
    <script >
    $( "#carritoBoton" ).click(function() {
        $('#btnPagar').attr("href", '/Paginas/formularioDePago.php'); // Set herf value
    });
    </script>

</html>