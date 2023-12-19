function empty(v) {
        let type = typeof v;
        if(type === 'undefined') {
            return true;
        }
        if(type=== 'boolean') {
            return !v;
        }
        if(v === null) {
            return true;
        }
        if(v === undefined) {
            return true;
        }
        if(v instanceof Array) {
            if(v.length < 1) {
                return true;
            }
        }
        else if(type === 'string') {
            if(v.length < 1) {
                return true;
            }
            if(v==='0') {
                return true;
            }
        }
        else if(type === 'object') {
            if(Object.keys(v).length < 1) {
                return true;
            }
        }
        else if(type === 'number') {
            if(v===0) {
                return true;
            }
        }
        return false;
    }


function generarPass(longitud)
{
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<longitud; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  return contraseña;
}
function encode_utf8(s) {
    var response;
  try {
    response=unescape(encodeURIComponent(s));
    }
  catch(err){
    response=s;
  }

  return response;
}

function decode_utf8(s) {
  var response;
  try {
    response=decodeURIComponent(escape(s));
  }
  catch(err){
    response=s;
  }

  return response;
}


function obtenerPost(){
  var url = location.href;
  var pathname=window.location.pathname;
  var res = pathname.split("/");
  var referencia=res[1];
  //alert(referencia);
  var post;
    if (empty(referencia)) {
    post="././Back-end/Controlador.php";
  }
  else{
    post="../Back-end/Controlador.php";
  }
  //alert(post);
  /*
  switch(referencia){
      case "":
        post="././Back-end/Controlador.php";
        break;
      case "Paginas":
        post="../Back-end/Controlador.php";
        break;
  }*/
  //alert(post);
  return post;
}
function obtenerPostQueryAjax(){
  var url = location.href;
  var pathname=window.location.pathname;
  var res = pathname.split("/");
  var referencia=res[1];
  //alert(referencia);
  var post;
  if (empty(referencia)) {
    post="././Back-end/queryAjax.php";
  }
  else{
    post="../Back-end/queryAjax.php";
  }
  //alert(post);
  /*
  switch(referencia){
      case "":
        post="././Back-end/queryAjax.php";
        break;
      case "Paginas":
        post="../Back-end/queryAjax.php";
        break;
  }*/
  return post;
}
function obtenerPathForFile(){
  var url = location.href;
  var pathname=window.location.pathname;
  var res = pathname.split("/");
  var referencia=res[1];
  //alert(referencia);
  var post;
  if (empty(referencia)) {
    post="././";
  }
  else{
    post="../";
  }
  //alert(post);
  /*
  switch(referencia){
      case "":
        post="././Back-end/queryAjax.php";
        break;
      case "Paginas":
        post="../Back-end/queryAjax.php";
        break;
  }*/
  return post;
}
//Funcion para dar formato a moneda
var fNumber = {
sepMil: ".", // separador para los miles
sepDec: ',', // separador para los decimales
formatear:function (num){
num +='';
var splitStr = num.split('.');
var splitLeft = splitStr[0];
var splitRight = splitStr.length > 1 ? this.sepDec + splitStr[1] : '';
var regx = /(\d+)(\d{3})/;
while (regx.test(splitLeft)) {
splitLeft = splitLeft.replace(regx, '$1' + this.sepMil + '$2');
}
return this.simbol + splitLeft + splitRight;
},
go:function(num, simbol){
this.simbol = simbol ||'';
return this.formatear(num);
}
}


function dirigirA(){
  var url = location.href;
  var pathname=window.location.pathname;
  var res = pathname.split("/");
  var url;
  if (res[2]=="Paginas") {
    var pagina=res[3];
    if (pagina==="usuario.php"||pagina==="portalAdmin.php") {
      url="../index.php";
    }
  }
  else{
    url=location.href;
  }
  return url;
}


//FUNCION QUE VERIFICA USUARIO Y CLAVE CORRECTA, REALIZA UNA CONSULTA EN AJAX Y ATRAVEZ DE LO OBTENIDO, MUESTRA UN MENSAJE POR PANTALLA
$(document).ready(function(){
    //EVENTO CLICK
    $('#btn_login').click(function(){
    var user = $('#mail-log').val();
    var pass = $('#pass-log').val();
    if($.trim(user).length >0 && $.trim(pass).length >0){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{user:user,pass:pass},
           cache:"false",
           beforeSend:function(){
               $('#btn_login').val("Conectando...");
           },
           success:function(data){
              //alert(data);
               $('#btn_login').val("Login");
               if(data=="1"){
                   location.replace(location.href);
               }else{
                   $('#errorPass').css('display','block');
                   $('#pass-log').focus();
                    $("#pass-log").removeClass("is-valid");
                    $("#pass-log").addClass("is-invalid");
               }
           }
       });
    };
    });
});







//FUNCION QUE REGISTRA A UN NUEVO USUARIO Y MUESTRA UN MENSAJE POR PANTALLA
$(document).ready(function(){
    //EVENTO CLICK
    $('#btn_registrar').click(function(){
    var mail = $('#mail').val();
    var clave1 = $('#clave1_reg').val();
    var clave2 = $('#clave2_reg').val();
    //alert(clave1+clave2);
    var validador=true;
    $('#btn_registrar').attr( 'data-toggle',"null" );
    if (clave1==clave2) {
      $('#errorPass_reg').css("display","none");
          validador=true;
    }
    else if (clave1!=clave2) {
      //alert(clave1+clave2);
          $('#errorPass_reg').css("display","block");
          validador=false;
         }
    if(validador){
        if($.trim(mail).length >0 && $.trim(clave1).length >0 && clave1==clave2){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server variable:dato),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{mail:mail,clave1:clave1},
           cache:"false",
           beforeSend:function(){
               $('#btn_registrar').val("Conectando...");
           },
           success:function(data){
              //alert(data);
               $('#btn_registrar').val("Registrar");
               if(data==="1"){
                   $(".modalRegistroBody").remove(); 
                   $(".modalRegistroFooter").remove();  
                   $(".modalRegistro").append('<div class="modal-body"><h2 class="text-center">Usuario registrado con exito</h2><p class="text-center"><i class="fa fa-check-circle" style="font-size:55px;color:green"></i></p></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div>');
               }else{
                   $('#btn_registrar').attr( 'data-toggle',"popover" );
                   $('#btn_registrar').attr( 'data-placement',"top" );
                   $('#btn_registrar').attr( 'title',"Lo sentimos.." );
                   $('#btn_registrar').attr( 'data-content',"No se pudo procesar su solicitud, verifique sus datos" );
                   $('#btn_registrar').attr( 'data-trigger',"focus" );
                   $('[data-toggle="popover"]').popover();
                    };
                 }
            });
         }
         
        }
    });
});




//FUNCION QUE RESTABLECE LA CLAVE DE UN USUARIO
$(document).ready(function(){
    //EVENTO CLICK
    $('#btn_forgot').click(function(){
    var mail = $('#mailForgot').val();
    var claveRemplazo = "agrofrez"+generarPass(6);
    //alert(claveRemplazo);
    $('#btn_registrar').attr( 'data-toggle',"null" );
        if($.trim(mail).length >0 && $.trim(claveRemplazo).length >0 ){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server variable:dato),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{mail:mail,claveRemplazo:claveRemplazo},
           cache:"false",
           beforeSend:function(){
               $('#btn_registrar').val("Conectando...");
           },
           success:function(data){
              //alert(data);
               $('#btn_registrar').val("Registrar");
               if(data==="1"){
                   $(".modalForgotBody").remove(); 
                   $(".modalForgotFooter").remove();  
                   $(".modalOlvide").append('<div class="modal-body"><h4 class="text-center">Tu solicitud fue aprobada con éxito, revisa en tu e-mail, te llegara un correo donde estará tu clave temporal (Recuerda revisar tu bandeja de spam).</h4><p class="text-center"><i class="fa fa-check-circle" style="font-size:55px;color:green"></i></p></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div>');
               }else{
                   $('#btn_forgot').attr( 'data-toggle',"popover" );
                   $('#btn_forgot').attr( 'data-placement',"top" );
                   $('#btn_forgot').attr( 'title',"Lo sentimos.." );
                   $('#btn_forgot').attr( 'data-content',"No se pudo procesar su solicitud, verifique sus datos" );
                   $('#btn_forgot').attr( 'data-trigger',"focus" );
                   $('[data-toggle="popover"]').popover();
                    };
                 }
            });
         }
         
    });
});
/*
//FUNCION QUE REGISTRA LOS DATOS DE UN USUARIO
$(document).ready(function(){
    //EVENTO CLICK
    $('#btn_guardar_perfil').click(function(){
    var mail = $('#mail').val();
    var clave = $('#clave').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var fechaNac = $('#fechaNac').val();
    var fono = $('#fono').val();
    var genero = $('#genero').val();
    var num = $('#num').val();
    var calle = $('#calle').val();
    var comuna = $('#comuna').val();
    //alert("mail:"+mail+"clave:"+clave+"nombre:"+nombre+"apellido:"+apellido+"Fecha-nac"+fechaNac+"fono:"+fono+"genero"+genero+"num:"+num+"calle:"+calle+"comuna:"+comuna);
    $('#btn_guardar_perfil').attr( 'data-toggle',"null" );
        if($.trim(mail).length >0 && $.trim(clave).length >0 && $.trim(nombre).length >0 && $.trim(apellido).length >0 && $.trim(fechaNac).length >0 && $.trim(fono).length >0 && $.trim(genero).length >0 && $.trim(num).length >0 && $.trim(calle).length >0 && $.trim(comuna).length >0) {
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server variable:dato),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{mail:mail,clave:clave,nombre:nombre,apellido:apellido,fechaNac:fechaNac,fono:fono,genero:genero,num:num,calle:calle,comuna:comuna},
           cache:"false",
           beforeSend:function(){
               $('#btn_guardar_perfil').val("Conectando...");
           },
           success:function(data){
              alert(data);
               $('#btn_guardar_perfil').val("Guardar");
               if(data==="0"){
                  $("body").append('<div class="modal" id="myModal"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Estado de solicitud</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><h2 class="text-center">Datos almacenados exitosamente.</h2><p class="text-center"><i class="fa fa-check-circle" style="font-size:55px;color:green"></i></p></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div></div></div></div>');
                  $("#myModal").modal("show");
             }else{
                   $('#btn_guardar_perfil').attr( 'data-toggle',"popover" );
                   $('#btn_guardar_perfil').attr( 'data-placement',"top" );
                   $('#btn_guardar_perfil').attr( 'title',"Lo sentimos.." );
                   $('#btn_guardar_perfil').attr( 'data-content',"No se pudo procesar su solicitud, verifique sus datos" );
                   $('#btn_guardar_perfil').attr( 'data-trigger',"focus" );
                   $('[data-toggle="popover"]').popover(); 
                    }
                }
            });
         }
         else{
            $("body").append('<div class="modal" id="myModal"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Estado de solicitud</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><h2 class="text-center">Debes llenar todos los campos para continuar.</h2><p class="text-center"><i class="fa fa-warning" style="font-size:55px;color:orange"></i></p></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div></div></div></div>');
            $("#myModal").modal("show");
         }
    })
});
*/
//FUNCION QUE NOS PERMITE CERRAR LA SESION Y NOS ENVIA A LA PAGINA PRINCIPAL
$(document).ready(function(){
    //EVENTO CLICK
    $('#enlace_logout').attr( 'data-toggle',"null" );
    $('#enlace_logout').click(function(){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{logout:"logout"},
           cache:"false",
           beforeSend:function(){
               $('#enlace_logout').val("Conectando...");
           },
           success:function(data){
               $('#enlace_logout').val("Cerrar sesion");
               //alert(data);
                if(data==="1"){
                  location.replace(dirigirA());
                }else{
                   $('#btn_agendar_esp').attr( 'data-toggle',"popover" );
                   $('#btn_agendar_esp').attr( 'data-placement',"top" );
                   $('#btn_agendar_esp').attr( 'title',"Lo sentimos.." );
                   $('#btn_agendar_esp').attr( 'data-content',"No se pudo procesar su solicitud, verifique los datos" );
                   $('#btn_agendar_esp').attr( 'data-trigger',"focus" );
                   $('[data-toggle="popover"]').popover(); 
                }
           }
       });
    });
});


//FUNCION QUE REGISTRA LA INFO DE USUARIO POR FLOW
$(document).ready(function(){
    //EVENTO CLICK
    $('#btn_flow').on('click',function(){
      alert("flagUser+flagAddress");
      var flag=false;
      var caja = $('input:radio[name=caja]:checked').val()
      var bolsa = $('input:radio[name=bolsa]:checked').val()
      var comment = $("#comment").val();
      var flagUser=$("#flagUser").text();
      var flagAddress=$("#flagAddress").text();
      //DROPDOWN 
      var metodoPago = $("#metodoPago").val();
      var genero = $("#genero").val();
      var region = $("#region").val();
      var ciudad = $("#ciudad").val();
      var comuna = $("#comuna").val();
      
      if (metodoPago==0) {
        $("#metodoPago").removeClass("is-valid");
        $("#metodoPago").addClass("is-invalid");
        $("#metodoPago").focus();
      }
      else{
        $("#metodoPago").removeClass("is-invalid");
        $("#metodoPago").addClass("is-valid");
      }

      if (comuna==0) {
        $("#comuna").removeClass("is-valid");
        $("#comuna").addClass("is-invalid");
        $("#comuna").focus();
      }
      else{
        $("#comuna").removeClass("is-invalid");
        $("#comuna").addClass("is-valid");
      }

      if (ciudad==0) {
        $("#ciudad").removeClass("is-valid");
        $("#ciudad").addClass("is-invalid");
        $("#ciudad").focus();
      }
      else{
        $("#ciudad").removeClass("is-invalid");
        $("#ciudad").addClass("is-valid");
      }


      if (region==0) {
        $("#region").removeClass("is-valid");
        $("#region").addClass("is-invalid");
        $("#region").focus();
      }
      else{
        $("#region").removeClass("is-invalid");
        $("#region").addClass("is-valid");
      }

      if (genero==0) {
        $("#genero").removeClass("is-valid");
        $("#genero").addClass("is-invalid");
        $("#genero").focus();
      }
      else{
        $("#genero").removeClass("is-invalid");
        $("#genero").addClass("is-valid");
      }
alert("flagUser+flagAddress");
      alert(flagUser+flagAddress);
      if (flagUser==="Modificar" || flagAddress==="Modificar" || flagAddress==="Registrar" || flagAddress==="Registrar") {
        flag=registrarDatosPersonales();
        //alert(flag);
      }
      if (flag) {
        var url="https://www.flow.cl/btn.php?token=1p7sgqe";
        location.assign(url);
      }
         
    });
});

//FUNCION QUE NOS PERMITE INSERTAR NUEVAS CATEGORIAS
function insertarCat() {
        var nombreCat = $('#nombCat').val();
        //alert(nombre);
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        if($.trim(nombreCat).length >0 ){
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{nombreCat:nombreCat},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
               //alert(data);
                if(data==="1"){
                  $('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>La categoria '+nombreCat+' se registro exitosamente.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
                  llamarAjaxConsulta("obtenerCategorias","#categoria");
                }else{
                   $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>La categoria '+nombreCat+' no se pudo registrar.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               
                }
           }
       });
      }
    };


//FUNCION QUE NOS PERMITE ELIMINAR UNA CATEGORIA
function borrarCat() {
        var categoriaId = $('#categoria').val();
        //alert(nombre);
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        if($.trim(categoriaId).length >0 && categoriaId>0 ){
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{categoriaId:categoriaId,tipo:"BORRAR"},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
               //alert(data);
                if(data==="1"){
                  $('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>La categoria se elimino exitosamente.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
                  llamarAjaxConsulta("obtenerCategorias","#categoria");
                }else{
                   $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>La categoria no se pudo eliminar.</strong><p>Revise que no existan subcategorias o productos asociadas a esta.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               
                }
           }
       });
      }
    };




  //FUNCION QUE NOS PERMITE INSERTAR NUEVAS CATEGORIAS
function insertarSubCat() {
        var nombSubCat = $('#nombSubCat').val();
        var categoriaId = $('#categoria').val();
        //alert(nombre);
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        if($.trim(nombSubCat).length >0 && categoriaId>0){
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{nombSubCat:nombSubCat,categoriaId:categoriaId},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
               //alert(data);
                if(data==="1"){
                  $('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>La subcategoria '+nombSubCat+' se registro exitosamente.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               
                }else{
                   $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>La subcategoria '+nombSubCat+' no se pudo registrar.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               
                }
           }
       });
      }
    };


//FUNCION QUE NOS PERMITE INSERTAR NUEVAS CATEGORIAS
function borrarSubCat() {
        var subCategoriaId = $('#subCategoria').val();
        var categoriaId = $('#categoria').val();
        //alert(subCategoriaId);
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        if($.trim(subCategoriaId).length >0 && subCategoriaId>0 ){
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{categoriaId:subCategoriaId,tipo:"BORRARSUBCAT"},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
               //alert(data);
                if(data==="1"){
                  $('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>La subcategoria se elimino exitosamente.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
                  llamarAjaxConsultaVarible('obtenerSubCategorias','#subCategoria',categoriaId)
                }else{
                   $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>La subcategoria no se pudo eliminar.</strong><p>Revise que no existan productos asociadas a esta.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               
                }
           }
       });
      }
    };


//FUNCION QUE NOS PERMITE INSERTAR NUEVAS CATEGORIAS
function registrarDatosPersonales() {
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var fechaNac = $('#fechaNac').val();
        var fono = $('#fono').val();
        var genero = $('#genero').val();
        var num = $('#num').val();
        var calle = $('#calle').val();
        var comuna = $('#comuna').val();
        var flag=false;

        //alert("nombre:"+nombre+"apellido:"+apellido+"fechaNac"+fechaNac+"fono:"+fono+"genero"+genero+"num:"+num+"calle:"+calle+"comuna:"+comuna);
    
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        if($.trim(nombre).length >0   && $.trim(apellido).length >0 && $.trim(fechaNac).length >0 && $.trim(fono).length >0){
        //alert("nombre:"+obtenerPost())
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{nombre:nombre,apellido:apellido,fechaNac:fechaNac,fono:fono,genero:genero,num:num,calle:calle,comuna:comuna},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
              
               //alert(data);
               
                if(data==="1" || data==="2"){
                    flag=true;  
                }else{
                   flag=false;
                }
                //alert(flag);
           }
       });
      }
      return flag;
    };









//FUNCION QUE ACTUALIZA LA INFORMACION DE UN PRODUCTO
function actualizarProducto() {
      var sku = $('#skuAct').val();
      var stock = $('#stockAct').val();
      var especificacion = $('#especificacionAct').val(); 
      var precio =  $('#precioAct').val();
      var descuento = $('#descuentoAct').val();
      //alert ("sku:"+sku+"stock: "+stock+"esp: "+especificacion+"prec: "+precio+"desc: "+descuento);
      if($.trim(sku).length >0 && $.trim(stock).length >0 && $.trim(descuento).length >0  && $.trim(precio).length >0 && $.trim(especificacion).length >0){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{sku:sku,stock:stock,especificacion:especificacion,precio:precio,descuento:descuento},
           cache:"false",
           beforeSend:function(){
               $('#btnActualizar').val("Conectando...");
           },
           success:function(data){
            //alert(data);
               $('#btnActualizar').val("Guardar");
               if(data=="1"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Producto actualizado exitosamente.</strong> Producto:'+sku+' Especificacion:'+decode_utf8(especificacion)+'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }
               else if(data=="0"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> Producto:'+sku+' Especificacion:'+decode_utf8(especificacion)+'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }else{
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>No se pudo actualizar el producto.</strong> Producto:'+sku+' Especificacion:'+decode_utf8(especificacion)+'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }
           }
       });
    };
      
}

//FUNCION QUE ELIMINA LA INFORMACION DE UN PRODUCTO
function eliminarProducto() {
      var sku = $('#skuAct').val();
      //alert ("sku:"+sku+"stock: "+stock+"esp: "+especificacion+"prec: "+precio+"desc: "+descuento);
      if($.trim(sku).length >0 ){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{sku:sku,borrar:true},
           cache:"false",
           beforeSend:function(){
               $('#btnActualizar').val("Conectando...");
           },
           success:function(data){
            //alert(data);
               if(data=="1"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Producto eliminado exitosamente.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }
               else if(data=="0"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }else{
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>No se pudo eliminar el producto.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }
           }
       });
    };
      
}

//FUNCION QUE INGRESA UN PRODUCTO A EL CARRO DE COMPRA
function ingresarCarro(id) {
      var idCantidad='#'+id;
      var cantidad = $(idCantidad).val();
      var sku=id;
      //alert ("sku:"+id+"cantidad: "+cantidad);
      if($.trim(sku).length >0 && $.trim(cantidad).length >0 ){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{sku:sku,cantidad,cantidad},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
            //alert(data);
            if(data=="1"){
                cargarCarrito();
              }
               else if(data=="0"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }else{
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>No se pudo eliminar el producto.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }
           }
       });
    };
      
}
function ingresarCarroRapido(id) {
      var cantidad = 1;
      var sku=id;
      //alert ("sku:"+id+"cantidad: "+cantidad);
      if($.trim(sku).length >0 && $.trim(cantidad).length >0 ){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{sku:sku,cantidad,cantidad},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
            //alert(data);
            if(data=="1"){
                cargarCarrito();
              }
               else if(data=="0"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }else{
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>No se pudo eliminar el producto.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }
           }
       });
    };
      
}

//FUNCION QUE ELIMINA UN PRODUCTO DEL CARRO DE COMPRA
function quitarDelCarro(sku) {
      var sku=sku;
      //alert ("sku:"+sku);
      if($.trim(sku).length >0){
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{sku:sku,tipo:"QuitarDelCarro"},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
            //alert(data);
            cargarCarrito();/*
            if(data=="1"){
                cargarCarrito();
              }
               else if(data=="0"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }else{
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>No se pudo eliminar el producto.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }*/
           }
       });
    };
      
}
//FUNCION QUE ELIMINA EL CARRO DE COMPRA
function vaciarCarro() {
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{tipo:"vaciarCarro"},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
            //alert(data);
            cargarCarrito();/*
            if(data=="1"){
                cargarCarrito();
              }
               else if(data=="0"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }else{
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>No se pudo eliminar el producto.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }*/
           }
       });
}
//FUNCION QUE ELIMINA EL CARRO DE COMPRA
function vaciarCarroValidado(idPedido) {
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:obtenerPost(),
           method:"POST",
           data:{tipo:"vaciarCarroValidado",idPedido:idPedido},
           cache:"false",
           beforeSend:function(){
           },
           success:function(data){
            //console.log(data);
            //alert(data);
            return data;
            //cargarCarrito();
            /*
            if(data=="1"){
                cargarCarrito();
              }
               else if(data=="0"){
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }else{
                $('#modalRespuesta').modal('hide')
                $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>No se pudo eliminar el producto.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
               }*/
           },
           error: function (jqXHR, textStatus, errorThrown) { 
                            //SI FALLA (RESPONSE 500) MOSTRAR ALERT DE FALLO
                            console.log(errorThrown)
                        }
       });
}
function agregadoToast(){
  toastr["success"]("Producto agregado al carrito!")

  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
}

function validarDescuento(){
  $( document ).ready(function() {
    var codigo = $("#input_desc").val();

    var parametros = {
      codigo: codigo,
      tipo:"validarDescuento"
    };
    $.ajax({
      data:  parametros, //datos que se envian a traves de ajax454815
      url:   obtenerPost(), //archivo que recibe la peticion
      type:  'post', //método de envio
     beforeSend:function(){
    },
    success:function(data){
        array = JSON.parse(data);
        if(array.length > 0){
            $('#cupones').remove();
            Swal.fire({
              icon: 'success',
              title: 'Codigo aceptado',
              text: 'Hemos procesado tu codigo exitosamente!',
            })
            array.forEach(function(entry) {
                desppagar = 0;
                subtpagar = parseInt($('#subtpagar').val());
                totalSinDesc = parseInt($('#tpagar').val());
                descuento = Math.round(totalSinDesc*(parseInt(entry.porcentaje)/100));
                total=(totalSinDesc-descuento)+desppagar
                if($('#desppagar').length){
                    desppagar = parseInt($('#desppagar').val());
                    descuento = Math.round(subtpagar*(parseInt(entry.porcentaje)/100));
                    total=(subtpagar-descuento)+desppagar
                }
                

                $('<tr><td></td><td></td><td><input type="text" class="form-control d-none" id="tpagar" name = "totalDesc" readonly="" required="" value="'+total+'"></td><td><h5 class="text-center text-danger">Desc. ('+entry.porcentaje+'%):</h5></td><td><h5 class="text-center text-danger">-'+fNumber.go(descuento,"$")+'</h5></td><td></td></tr>').insertBefore("#total");
                $('#totalValor').text(fNumber.go(total,"$"));
                //console.log(entry)
            }, this);
        }
        else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Codigo ingresado invalido!',
            })
        }
    }
    });
  });
}

function sumarCant(codigo){
  $( document ).ready(function() {
    var valor_inicial = parseInt($("#spanCant-"+codigo).text());
    var nueva_cantidad = valor_inicial+=1;
    $("#spanCant-"+codigo).text(nueva_cantidad);

    var parametros = {
      "respuestaSumar": "AñadirDesdeCarro",
      "sku_c" : codigo,
      "cantidad_c" : nueva_cantidad
    };

    $.ajax({
      data:  parametros, //datos que se envian a traves de ajax
      url:   obtenerPost(), //archivo que recibe la peticion
      type:  'post', //método de envio
    });
    if(nueva_cantidad >1 ){
      $("#btnRestar-"+codigo).removeAttr('disabled');
    }
    cargarCarrito();
  });
}

function restarCant(codigo){
  $( document ).ready(function() {
    var valor_inicial = parseInt($("#spanCant-"+codigo).text());
    var nueva_cantidad = valor_inicial-=1;

    $("#spanCant-"+codigo).text(nueva_cantidad);

    var parametros = {
      "respuestaRestar": "AñadirDesdeCarro",
      "sku_c" : codigo,
      "cantidad_c" : nueva_cantidad
    };
    

    $.ajax({
      data:  parametros, //datos que se envian a traves de ajax
      url:   obtenerPost(), //archivo que recibe la peticion
      type:  'post', //método de envio
    });

    if(nueva_cantidad <= 1){
      $("#btnRestar-"+codigo).attr("disabled", true);
    }
    cargarCarrito();
  });
}


function cargarCarrito() {
var xmlhttp = new XMLHttpRequest();
var url  = obtenerPostQueryAjax()+"?consulta=obtenerProductosCarro";
var post=obtenerPathForFile();
xmlhttp.onreadystatechange=function() {
    console.log(xmlhttp.responseText)
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        var array = JSON.parse(xmlhttp.responseText);
        var i;
        var totalPagar=0;
        var totalPagarCupon = 0;
        var cantProductos=0;
        var out='';
        for(i=0; i<array.length;i++) {
            var descuento=Math.round(array[i].tblProductosPrecio*(1.0-(array[i].tblProductosDescuento/100.0)));
            var descuentoCupon = Math.round(parseInt(array[i].tblProductosPrecio) - ((parseInt(array[i].tblProductosPrecio) * (parseInt(array[i].tblProductosDescuento)/100.0))+(parseInt(array[i].tblProductosPrecio) * (parseInt(array[i].cuponDesc)/100.0)) ));
            totalPagar+=descuento*array[i].tblCarroCantidad;
            totalPagarCupon+=descuentoCupon*array[i].tblCarroCantidad;
            cantProductos+=1; 
            console.log(parseInt(array[i].cuponDesc));
            if(parseInt(array[i].cuponDesc) > 0 ){
                totalDesctos =  parseInt((parseInt(array[i].tblProductosPrecio) * (parseInt(array[i].tblProductosDescuento)/100.0))+(parseInt(array[i].tblProductosPrecio) * (parseInt(array[i].cuponDesc)/100.0)))
               
                //console.log((parseInt(array[i].tblProductosPrecio) ))
                //console.log((parseInt(array[i].tblProductosDescuento)))
                //console.log(((parseInt(array[i].cuponDesc)/100.0)))
                tagDscto = '<h5 class="text-center text-danger">-'+totalDesctos+' ('+array[i].cuponDesc+'%)</br>'+'</h5>'
            }
            else{
                tagDscto = ''
            }
            
            var sumar_p = '<button type="button" id="btnSumar" class="btn btn-success btn-sm" onclick="sumarCant('+array[i].tblProductosCodigoDeBarra+')">+</button>';
            var restar_p = '<button type="submit" id="btnRestar-'+array[i].tblProductosCodigoDeBarra+'" class="btn btn-danger btn-sm" onclick="restarCant('+array[i].tblProductosCodigoDeBarra+')">-</button>';
            
            if(array[i].tblCarroCantidad == 1){
            var restar_p = '<button type="submit" id="btnRestar-'+array[i].tblProductosCodigoDeBarra+'" class="btn btn-danger btn-sm" onclick="restarCant('+array[i].tblProductosCodigoDeBarra+')" disabled>-</button>';
            }

            var input_cant = '<span id="spanCant-'+array[i].tblProductosCodigoDeBarra+'">'+array[i].tblCarroCantidad+'</span>';

            var boton='<button class="btn btn-danger my-2 my-sm-0" type="button" onclick="quitarDelCarro('+array[i].tblProductosCodigoDeBarra+')"><i class="fa fa-close"></i></button>';
            
            out+='<tr><td><h5 class="text-center">'+array[i].tblProductosCodigoDeBarra+'</h5></td><td style="width: 20%"><img class="card-img-top img-responsive img-fluid p-1"  src="'+(array[i].tblProductosImagen).replace('../',post)+'" alt=""></td><td><h5 class="text-center">'+fNumber.go( Math.round(parseInt(array[i].tblProductosPrecio) - (parseInt(array[i].tblProductosPrecio) * (parseInt(array[i].tblProductosDescuento)/100.0))), "$")+tagDscto+'</h5></td>'+'<td><h5 class="text-center">'+restar_p+' '+input_cant+' '+sumar_p+'</h5></td><td><h5 class="text-center"><span id="subtotalProducto">'+fNumber.go((array[i].tblCarroCantidad*descuentoCupon), "$")+'</span></h5></td><td><h5 class="text-center">'+boton+'</h5></td></tr>';          

               
        } 
        if (totalPagar<=25000) {
          out+='<tr><td></td><td></td><td><input type="text" class="form-control d-none" id="subtpagar" readonly="" required="" value="'+totalPagar+'"></td><td><h5 class="text-center">Subtotal:</h5></td><td><h5 class="text-center">'+fNumber.go(totalPagar,"$")+'</h5></td><td></td></tr>';
          valorDespacho=Math.round(totalPagar*0.1);
          out+='<tr ><td></td><td></td><td><input type="text" class="form-control d-none" id="desppagar" readonly="" required="" value="'+valorDespacho+'"></td><td><h5 class="text-center">Despacho:</h5></td><td><h5 class="text-center">'+fNumber.go(valorDespacho,"$")+'</h5></td><td></td></tr>';
          totalPagarSinDesp = totalPagar;
          totalPagar=totalPagar+valorDespacho;
          totalPagarCupon=totalPagarCupon+valorDespacho;
        }
        out+='<tr id = "total"><td></td><td></td><td><input type="text" class="form-control d-none" id="tpagar" readonly="" required="" value="'+totalPagar+'"></td><td><h5 class="text-center">Total:</h5></td><td><h5  id = "totalValor" class="text-center">'+fNumber.go(totalPagarCupon,"$")+'</h5></td><td></td></tr>';
        $('#detalleCarro').html(out);
        if (totalPagar>=20000) {
          if ( $("#btnPagar") ) {
            $("#btnPagar").remove();
          }
          btnPagar='<a  class="btn btn-success text-white" href="formularioDePago.php" id="btnPagar">Ir a pagar</a>';
          $(btnPagar).insertBefore( "#btnCerrar" );
          if ( $("#mensajeCompra") ) {
            $("#mensajeCompra").remove();
          }
        }
        else{
          if ( $("#btnPagar") ) {
            $("#btnPagar").remove();
          }
          if ( $("#mensajeCompra") ) {
            $("#mensajeCompra").remove();
          }
          mensaje='<p id="mensajeCompra">El total de su compra debe ser mayor o igual a $20.000 para prodecer a pagar (mínimo de compra), cualquier duda o consulta revisar términos y condiciones.</p>';
          $(mensaje).insertBefore( "#btnCerrar" );

        }
        out+='<table>';
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send(); 
}


 
function obtenerDatosUsuarioDireccion() {
var xmlhttp = new XMLHttpRequest();
var url  = obtenerPostQueryAjax()+"?consulta=obtenerDatosUsuarioDireccion";
xmlhttp.onreadystatechange=function() {
        
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        var array = JSON.parse(xmlhttp.responseText);
        var i;
        for(i=0; i<array.length;i++) {
          if (array[i].cantRegistros==="0") {
            habilitarCampo("#direccion");
            $('#flagAddress').text("Registrar");
            $('#btnEditDirecc').css("display","none");
          }
          else{
            $('#region').val(array[i].tblRegionNombre);
            $('#ciudad').val(array[i].tblCiudadNombre);
            $('#comuna').val(array[i].tblComunaNombre);
            $('#calle').val(array[i].tblDireccionNombre);
            $('#num').val(array[i].tblDireccionNumero);

          }
        }

    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send(); 
}

function obtenerDatosPersonalesUsuario() {
var xmlhttp = new XMLHttpRequest();
var url  = obtenerPostQueryAjax()+"?consulta=obtenerDatosPersonalesUsuario";
xmlhttp.onreadystatechange=function() {
        
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        var array = JSON.parse(xmlhttp.responseText);
        var i;
        for(i=0; i<array.length;i++) {
          if (array[i].cantRegistros==="0") {
            habilitarCampo("#persona");
            $('#flagUser').text("Registrar");
            $('#btnEditInfoUser').css("display","none");
          }
          else{
            $('#nombre').val(array[i].tblPersonaNombre);
            $('#apellido').val(array[i].tblPersonaApellido);
            $('#fechaNac').val((array[i].tblPersonaFechaNacimiento).replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1'));
             $('#fono').val(array[i].tblPersonaFono);
            $('#genero').val(array[i].tblGeneroNombre);
        }
      }
    }
  }
xmlhttp.open("GET", url, true);
xmlhttp.send(); 
}

function obtenerDatosUsuario() {
  obtenerDatosPersonalesUsuario();
  obtenerDatosUsuarioDireccion();
}


//FUNCION QUE NOS PERMITE CONSULTAR EL PRODUCTO
$(document).ready(function(){
    //EVENTO CLICK
    $('#btnConsultar').attr( 'data-toggle',"null" );
    $('#btnConsultar').click(function(){
        var especificacion = $('#especificacion').val();
        //alert(especificacion)
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:"../Back-end/queryAjax.php",
           method:"GET",
           data:{"variable":especificacion,"consulta":"obtenerProducto"},
           cache:"false",
           beforeSend:function(){
               $('#btnConsultar').val("Conectando...");
           },
           success:function(data){
               $('#btnConsultar').val("Cerrar sesion");
               //alert(data);
               var array = JSON.parse(data);
               var i;
               for(i=0; i<array.length;i++) {
                if (array.length>0) {
                    var imagen=array[i].tblProductosImagen;
                    var especificacion= array[i].tblProductosEspecificacion;
                    var sku=array[i].tblProductosCodigoDeBarra;
                    var temporada=array[i].tblTemporadaNombre;
                    var tipo=array[i].tblTipoNombre;
                    var subtipo=array[i].tblSubTipoNombre;
                    var productoStock=array[i].tblProductosStock;
                    if (productoStock==1) {
                        productoStock="Disponible";
                    }
                    else{
                        productoStock="Agotado";
                    }
                    var medida=array[i].tblMedidaNombre;
                    var cantidad=array[i].tblProductosCantidad;
                    var precio=array[i].tblProductosPrecio;
                    var descuento=array[i].tblProductosDescuento;
                    var precioFinal=precio-(precio*(descuento/100))
                    $(".modal-body").remove(); 
                    $(".modal-footer").remove();  
                    $(".modal-content").append('<div class="modal-body"><div class="row"><div class="col-md-6"><img class="img-fluid" src="'+imagen+'" alt="Foto producto"></div><div class="col-md-6"><p class="text-dark"><b class="font-weight-bold">Tipo:</b> '+tipo+'</p><p class="text-dark"><b class="font-weight-bold">Categoria:</b> '+subtipo+'</p><p class="text-dark"><b class="font-weight-bold">Especificacion:</b> '+decode_utf8(especificacion)+'</p><p class="text-dark"><b class="font-weight-bold">SKU:</b> '+sku+'</p><p class="text-dark"><b class="font-weight-bold">Temporada: </b>'+temporada+'</p><p class="text-dark"><b class="font-weight-bold">Disponibilidad: </b>'+productoStock+'</p><p class="text-dark"><b class="font-weight-bold">Cantidad: </b>'+cantidad+" ("+medida+')</p><p class="text-dark"><b class="font-weight-bold">Precio: </b>$'+precio+'</p><p class="text-dark"><b class="font-weight-bold">Descuento: </b>'+descuento+'%</p><p class="text-dark"><b class="font-weight-bold">Precio final: </b>$'+precioFinal+'</p></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div>');
                    $('#modalRespuesta').modal('show');   
                    }
                else{
                        $('#btnConsultar').attr( 'data-toggle',"popover" );
                        $('#btnConsultar').attr( 'data-placement',"top" );
                        $('#btnConsultar').attr( 'title',"Lo sentimos.." );
                        $('#btnConsultar').attr( 'data-content',"No se pudo procesar su solicitud, verifique sus datos" );
                        $('#btnConsultar').attr( 'data-trigger',"focus" );
                        $('[data-toggle="popover"]').popover();
                   }
               }
           }
       });
    });
});




//FUNCION QUE NOS PERMITE CONSULTAR EL PRODUCTO POR SKU
$(document).ready(function(){
    //EVENTO CLICK
    $('#btnConsultarSku').attr( 'data-toggle',"null" );
    $('#btnConsultarSku').click(function(){
        var sku = $('#SKU').val();
        //alert(sku)
        if ($.trim(sku).length >0) {
             //alert(especificacion)
             //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
             $.ajax({
               url:"../Back-end/queryAjax.php",
               method:"GET",
               data:{"variable":sku,"consulta":"obtenerProducto"},
               cache:"false",
               beforeSend:function(){
                   $('#btnConsultar').val("Conectando...");
               },
               success:function(data){
                   $('#btnConsultar').val("Cerrar sesion");
                   //alert(data);
                   var array = JSON.parse(data);
                   var i;
                   //alert (array.length)
                   for(i=0; i<array.length;i++) {
                    if (array.length>0) {
                        var imagen=array[i].tblProductosImagen;
                        var especificacion= array[i].tblProductosEspecificacion;
                        var sku=array[i].tblProductosCodigoDeBarra;
                        var temporada=array[i].tblTemporadaNombre;
                        var tipo=array[i].tblTipoNombre;
                        var subtipo=array[i].tblSubTipoNombre;
                        var productoStock=array[i].tblProductosStock;
                        if (productoStock==1) {
                            productoStock="Disponible";
                        }
                        else{
                            productoStock="Agotado";
                        }
                        var medida=array[i].tblMedidaNombre;
                        var cantidad=array[i].tblProductosCantidad;
                        var precio=array[i].tblProductosPrecio;
                        var descuento=array[i].tblProductosDescuento;
                        var precioFinal=precio-(precio*(descuento/100))
                        $(".modal-body").remove(); 
                        $(".modal-footer").remove();  
                        $(".modal-content").append('<div class="modal-body"><div class="row"><div class="col-md-6"><img class="img-fluid" src="'+imagen+'" alt="Foto producto"></div><div class="col-md-6"><p class="text-dark"><b class="font-weight-bold">Tipo:</b> '+tipo+'</p><p class="text-dark"><b class="font-weight-bold">Categoria:</b> '+subtipo+'</p><p class="text-dark"><b class="font-weight-bold">Especificacion:</b> '+decode_utf8(especificacion)+'</p><p class="text-dark"><b class="font-weight-bold">SKU:</b> '+sku+'</p><p class="text-dark"><b class="font-weight-bold">Temporada: </b>'+temporada+'</p><p class="text-dark"><b class="font-weight-bold">Disponibilidad: </b>'+productoStock+'</p><p class="text-dark"><b class="font-weight-bold">Cantidad: </b>'+cantidad+" ("+medida+')</p><p class="text-dark"><b class="font-weight-bold">Precio: </b>$'+precio+'</p><p class="text-dark"><b class="font-weight-bold">Descuento: </b>'+descuento+'%</p><p class="text-dark"><b class="font-weight-bold">Precio final: </b>$'+precioFinal+'</p></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div>');
                        $('#modalRespuesta').modal('show');   
                        }
                    else{
                            $('#btnConsultarSku').attr( 'data-toggle',"popover" );
                            $('#btnConsultarSku').attr( 'data-placement',"top" );
                            $('#btnConsultarSku').attr( 'title',"Lo sentimos.." );
                            $('#btnConsultarSku').attr( 'data-content',"No se pudo procesar su solicitud, verifique sus datos" );
                            $('#btnConsultarSku').attr( 'data-trigger',"focus" );
                            $('[data-toggle="popover"]').popover();
                       }
                   }
                   if (array.length==0) {
                        $('#btnConsultarSku').attr( 'data-toggle',"popover" );
                            $('#btnConsultarSku').attr( 'data-placement',"top" );
                            $('#btnConsultarSku').attr( 'title',"Lo sentimos.." );
                            $('#btnConsultarSku').attr( 'data-content',"No existe un producto con esas especificaciones" );
                            $('#btnConsultarSku').attr( 'data-trigger',"focus" );
                            $('[data-toggle="popover"]').popover();
                          }
               }
           });    
        }

    
    });
});

//FUNCION QUE NOS PERMITE CONSULTAR EL PRODUCTO POR SKU PARA DESPUES MODIFICARLO
$(document).ready(function(){
    //EVENTO CLICK
    $('#btnConsultarSkuAct').attr( 'data-toggle',"null" );
    $('#btnConsultarSkuAct').click(function(){
        var sku = $('#SKU').val();
        //alert(sku)
        if ($.trim(sku).length >0) {
             //alert(especificacion)
             //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
             $.ajax({
               url:"../Back-end/queryAjax.php",
               method:"GET",
               data:{"variable":sku,"consulta":"obtenerProducto"},
               cache:"false",
               beforeSend:function(){
                   $('#btnConsultar').val("Conectando...");
               },
               success:function(data){
                   //alert(data);
                   var array = JSON.parse(data);
                   var i;
                   //alert (array.length)
                   for(i=0; i<array.length;i++) {
                    if (array.length>0) {
                        var imagen=array[i].tblProductosImagen;
                        var especificacion= array[i].tblProductosEspecificacion;
                        var sku=array[i].tblProductosCodigoDeBarra;
                        var temporada=array[i].tblTemporadaNombre;
                        var tipo=array[i].tblTipoNombre;
                        var subtipo=array[i].tblSubTipoNombre;
                        var productoStock=array[i].tblProductosStock;
                        if (productoStock==1) {
                            productoStock="Disponible";
                            productoSelect='<option value="1">Disponible</option><option value="2">Agotado</option>'
                        }
                        else{
                            productoStock="Agotado";
                            productoSelect='<option value="2">Agotado</option><option value="1">Disponible</option>'
                        
                        }
                        var medida=array[i].tblMedidaNombre;
                        var cantidad=array[i].tblProductosCantidad;
                        var precio=array[i].tblProductosPrecio;
                        var descuento=array[i].tblProductosDescuento;
                        var precioFinal=precio-(precio*(descuento/100))
                        $(".modal-body").remove(); 
                        $(".modal-footer").remove();  
                        $(".modal-content").append('<div class="modal-body"><div class="row"><div class="col-md-6"><img class="img-fluid" src="'+imagen+'" alt="Foto producto"></div><div class="col-md-6"><p class="text-dark"><b class="font-weight-bold">Tipo:</b></p><input type="text" class="form-control col-sm-6" value="'+tipo+'" readonly><p class="text-dark"><b class="font-weight-bold">Categoria:</b></p><input type="text" class="form-control col-sm-6" value="'+subtipo+'" readonly> <p class="text-dark"><b class="font-weight-bold">Especificacion:</b></p><input type="text" id="especificacionAct" class="form-control col-sm-6" value="'+decode_utf8(especificacion)+'" required> <p class="text-dark"><b class="font-weight-bold">SKU:</b></p><input type="text" id="skuAct" class="form-control col-sm-6" value="'+sku+'" readonly> <p class="text-dark"><b class="font-weight-bold">Temporada: </b><input type="text" class="form-control col-sm-6" value="'+temporada+'" readonly><p class="text-dark"><b class="font-weight-bold">Disponibilidad: </b></p><select type="text" name="stock" class="form-control col-sm-6" id="stockAct">'+productoSelect+'</select><p class="text-dark"><b class="font-weight-bold">Cantidad: </b></p><input type="text" class="form-control col-sm-6" value="'+cantidad+" ("+medida+')" readonly><p class="text-dark"><b class="font-weight-bold">Precio: </b></p><input type="text" id="precioAct" class="form-control col-sm-6" value="'+precio+'" onkeyup="mostrarDescuento()" required><p class="text-dark"><b class="font-weight-bold">Descuento: </b></p><input type="text" id="descuentoAct" class="form-control col-sm-6" onkeyup="mostrarDescuento()" value="'+descuento+'" max="100" required><p class="text-dark"><b class="font-weight-bold">Precio final: </b></p><input type="text" class="form-control col-sm-6" id="pfinal" value="$'+Math.round(precioFinal)+'" readonly></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger" onclick="eliminarProducto()" id="btnBorrar">Borrar</button><button type="button" class="btn btn-primary" id="btnActualizar" onclick="actualizarProducto()">Guardar</button></div>');
                        $('#modalRespuesta').modal('show');   
                        }
                    else{
                            $('#btnConsultarSku').attr( 'data-toggle',"popover" );
                            $('#btnConsultarSku').attr( 'data-placement',"top" );
                            $('#btnConsultarSku').attr( 'title',"Lo sentimos.." );
                            $('#btnConsultarSku').attr( 'data-content',"No se pudo procesar su solicitud, verifique sus datos" );
                            $('#btnConsultarSku').attr( 'data-trigger',"focus" );
                            $('[data-toggle="popover"]').popover();
                       }
                   }
                   if (array.length==0) {
                        $('#btnConsultarSku').attr( 'data-toggle',"popover" );
                            $('#btnConsultarSku').attr( 'data-placement',"top" );
                            $('#btnConsultarSku').attr( 'title',"Lo sentimos.." );
                            $('#btnConsultarSku').attr( 'data-content',"No existe un producto con esas especificaciones" );
                            $('#btnConsultarSku').attr( 'data-trigger',"focus" );
                            $('[data-toggle="popover"]').popover();
                          }
               }
           });    
        }

    
    });
});

//FUNCION QUE NOS PERMITE CONSULTAR EL PRODUCTO
$(document).ready(function(){
    //EVENTO CLICK
    $('#btnConsultarAct').attr( 'data-toggle',"null" );
    $('#btnConsultarAct').click(function(){
        var especificacion = $('#especificacion').val();
        //alert(especificacion)
        //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
        $.ajax({
           url:"../Back-end/queryAjax.php",
           method:"GET",
           data:{"variable":especificacion,"consulta":"obtenerProducto"},
           cache:"false",
           beforeSend:function(){
               $('#btnConsultar').val("Conectando...");
           },
           success:function(data){
               $('#btnConsultar').val("Cerrar sesion");
               //alert(data);
               var array = JSON.parse(data);
               var i;
               for(i=0; i<array.length;i++) {
                if (array.length>0) {
                    var imagen=array[i].tblProductosImagen;
                    var especificacion= array[i].tblProductosEspecificacion;
                    var sku=array[i].tblProductosCodigoDeBarra;
                    var temporada=array[i].tblTemporadaNombre;
                    var tipo=array[i].tblTipoNombre;
                    var subtipo=array[i].tblSubTipoNombre;
                    var productoStock=array[i].tblProductosStock;
                    if (productoStock==1) {
                        productoStock="Disponible";
                        productoSelect='<option value="1">Disponible</option><option value="2">Agotado</option>'
                    }
                    else{
                        productoStock="Agotado";
                        productoSelect='<option value="2">Agotado</option><option value="1">Disponible</option>'
                    
                    }
                    var medida=array[i].tblMedidaNombre;
                    var cantidad=array[i].tblProductosCantidad;
                    var precio=array[i].tblProductosPrecio;
                    var descuento=array[i].tblProductosDescuento;
                    var precioFinal=precio-(precio*(descuento/100))
                    $(".modal-body").remove(); 
                    $(".modal-footer").remove();  
                    $(".modal-content").append('<div class="modal-body"><div class="row"><div class="col-md-6"><img class="img-fluid" src="'+imagen+'" alt="Foto producto"></div><div class="col-md-6"><p class="text-dark"><b class="font-weight-bold">Tipo:</b></p><input type="text" class="form-control col-sm-6" value="'+tipo+'" readonly><p class="text-dark"><b class="font-weight-bold">Categoria:</b></p><input type="text" class="form-control col-sm-6" value="'+subtipo+'" readonly> <p class="text-dark"><b class="font-weight-bold">Especificacion:</b></p><input type="text" id="especificacionAct" class="form-control col-sm-6" value="'+decode_utf8(especificacion)+'" required> <p class="text-dark"><b class="font-weight-bold">SKU:</b></p><input type="text" id="skuAct" class="form-control col-sm-6" value="'+sku+'" readonly> <p class="text-dark"><b class="font-weight-bold">Temporada: </b><input type="text" class="form-control col-sm-6" value="'+temporada+'" readonly><p class="text-dark"><b class="font-weight-bold">Disponibilidad: </b></p><select type="text" name="stock" class="form-control col-sm-6" id="stockAct">'+productoSelect+'</select><p class="text-dark"><b class="font-weight-bold">Cantidad: </b></p><input type="text" class="form-control col-sm-6" value="'+cantidad+" ("+medida+')" readonly><p class="text-dark"><b class="font-weight-bold">Precio: </b></p><input type="text" id="precioAct" class="form-control col-sm-6" value="'+precio+'" onkeyup="mostrarDescuento()" required><p class="text-dark"><b class="font-weight-bold">Descuento: </b></p><input type="text" id="descuentoAct" class="form-control col-sm-6" onkeyup="mostrarDescuento()" value="'+descuento+'" max="100" required><p class="text-dark"><b class="font-weight-bold">Precio final: </b></p><input type="text" class="form-control col-sm-6" id="pfinal" value="$'+Math.round(precioFinal)+'" readonly></div></div></div><div class="modal-footer"><button type="button" class="btn btn-danger" onclick="eliminarProducto()" id="btnBorrar">Borrar</button><button type="button" class="btn btn-primary" id="btnActualizar" onclick="actualizarProducto()">Guardar</button></div>');
                    $('#modalRespuesta').modal('show');   
                    }
                else{
                        $('#btnConsultar').attr( 'data-toggle',"popover" );
                        $('#btnConsultar').attr( 'data-placement',"top" );
                        $('#btnConsultar').attr( 'title',"Lo sentimos.." );
                        $('#btnConsultar').attr( 'data-content',"No se pudo procesar su solicitud, verifique sus datos" );
                        $('#btnConsultar').attr( 'data-trigger',"focus" );
                        $('[data-toggle="popover"]').popover();
                   }
               }
           }
       });
    });
});


//FUNCION QUE ELIMINA LA INFORMACION DE UN PRODUCTO
function ingresarPedido() {
      var caja = $('input:radio[name=caja]:checked').val()
      var bolsa = $('input:radio[name=bolsa]:checked').val()
      var comment = $("#comment").val();
      var resultRegistro;
      var flagUser=$("#flagUser").text();
      var flagAddress=$("#flagAddress").text();
      var flag=true;
      //DROPDOWN 
      var metodoPago = $("#metodoPago").val();
      var genero = $("#genero").val();
      var region = $("#region").val();
      var ciudad = $("#ciudad").val();
      var comuna = $("#comuna").val();
      var btnPagoValue = $("#btn_pago").val();
      
      if (metodoPago==0) {
        $("#metodoPago").removeClass("is-valid");
        $("#metodoPago").addClass("is-invalid");
        $("#metodoPago").focus();
        flag=false;
        }
        else{
          $("#metodoPago").removeClass("is-invalid");
          $("#metodoPago").addClass("is-valid");
        }


      if (flagAddress==="Registrar" || flagAddress==="Registrar" || flagAddress==="Modificar" || flagUser==="Modificar" ) {
        

        if (comuna==0) {
          $("#comuna").removeClass("is-valid");
          $("#comuna").addClass("is-invalid");
          $("#comuna").focus();
          flag=false;
        }
        else{
          $("#comuna").removeClass("is-invalid");
          $("#comuna").addClass("is-valid");
        }

        if (ciudad==0) {
          $("#ciudad").removeClass("is-valid");
          $("#ciudad").addClass("is-invalid");
          $("#ciudad").focus();
          flag=false;
        }
        else{
          $("#ciudad").removeClass("is-invalid");
          $("#ciudad").addClass("is-valid");
        }


        if (region==0) {
          $("#region").removeClass("is-valid");
          $("#region").addClass("is-invalid");
          $("#region").focus();
          flag=false;
        }
        else{
          $("#region").removeClass("is-invalid");
          $("#region").addClass("is-valid");
        }

        if (genero==0) {
          $("#genero").removeClass("is-valid");
          $("#genero").addClass("is-invalid");
          $("#genero").focus();
          flag=false;
        }
        else{
          $("#genero").removeClass("is-invalid");
          $("#genero").addClass("is-valid");
        }
      }
      /*else if (flagAddress==="Modificar" || flagUser==="Modificar"  ) {
        if ($.trim(caja).length >0 ) {
          flag=false;
        }
        if ($.trim(bolsa).length >0 ) {
          flag=false;
        }
        if ($.trim(metodoPago).length >0 ) {
          flag=false;
        }
        if ($.trim(comuna).length >0 ) {flag=false;}
        if ($.trim(genero).length >0 ) {flag=false;}
        if ($.trim(bolsa).length >0 ) {flag=false;}
        if ($.trim(ciudad).length >0 ) {flag=false;}
        if ($.trim(region).length >0 ) {flag=false;}
      }*/
      


      //alert(flagUser+flagAddress+" "+flag);
      if(flag){
          if (flagUser==="Modificar" || flagAddress==="Modificar" || flagAddress==="Registrar" || flagAddress==="Registrar") {
            resultRegistro=registrarDatosPersonales();
          }
          if (btnPagoValue==="flow") {
            var url="https://www.flow.cl/btn.php?token=1p7sgqe";
            location.assign(url);
          }
          if (btnPagoValue==="convencional") {
                
                //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
                $.ajax({
                   url:obtenerPost(),
                   method:"POST",
                   data:{caja:caja,bolsa:bolsa,metodoPago:metodoPago,comment:comment},
                   cache:"false",
                   success:function(data){
                    //alert(data);
                   
                      if(parseInt(data)>0){
                       var urlpdf="../Back-end/generarPDF.php?idPedido="+data;
                       location.assign(urlpdf);
                       vaciarCarro();
                       }
                       else if(data=="0"){
                        $('#modalRespuesta').modal('hide')
                        $('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>No se realizaron cambios.</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore(".frame");
                       }
                  } 
               });
            };
          
      }//alert ("caja:"+caja+"bolsa: "+bolsa+"metodoPago: "+metodoPago+"comment: "+comment);
      
      
}


//FUNCION QUE GENERA PEDIDO AUTOMATICO
function ingresarPedidoValidado(correo) {
    //ESTRUCTURA AJAX: URL,METODO DE ENVIO,CACHE,DATA (Specifies data to be sent to the server),FUNCIONES DE ENVIO Y FINALIZADO
    $.ajax({  
       url:obtenerPost(),
       method:"POST",
       data:{correo:correo,tipo:'pedidoValidado'},
       cache:"false",
       success:function(data){
        //console.log(data);
       
          if(parseInt(data)>0){
           //var urlpdf="../Back-end/generarPDF.php?idPedido="+data;
            nDeleted = vaciarCarroValidado(data);
            console.log(parseInt(nDeleted));
            
           // window.open(urlpdf, '_blank');
           }
           else if(data=="0"){
            alert('No se pudo generar el pedido')
           }
      } 
   });
   $('#validar_'+(correo.replace('@','_')).replace('.','_')).remove();
      
      
}

/*_______________________________CONSULTAR DATOS_________________________*/
function llamarAjaxIndex(variable,consulta,id) {
var xmlhttp = new XMLHttpRequest();
var url  = obtenerPostQueryAjax()+"?variable="+variable+"&consulta="+consulta;
xmlhttp.onreadystatechange=function(oEvent) {
        
    if (xmlhttp.readyState === 4)
    {
      if(xmlhttp.status === 200) {
        var array = JSON.parse(xmlhttp.responseText);
        var i;
        if(consulta==="verificarCorreoExistente"){
            for(i=0; i<array.length;i++) {
                    if (array[i].cantidad==="0") {
                        $('#errorUser2').css("display","none");
                        $("#mail").removeClass("is-invalid");
                        $("#mail").addClass("is-valid");
                    }
                    else if (array[i].cantidad==="1") {
                        
                        $('#errorUser2').css("display","block");
                        $('#mail').focus();
                        $("#mail").removeClass("is-valid");
                        $("#mail").addClass("is-invalid");
                    }
            }
        }
        else if(consulta==="verificarCorreoNoExistente" ){
            for(i=0; i<array.length;i++) {
                    if (array[i].cantidad==="0") {
                        $('#errorUser').css("display","block");
                        $('#mail-log').focus();
                        $("#mail-log").removeClass("is-valid");
                        $("#mail-log").addClass("is-invalid");
                    }
                    else if (array[i].cantidad==="1") {
                        $('#errorUser').css("display","none");
                        $("#mail-log").removeClass("is-invalid");
                        $("#mail-log").addClass("is-valid");
                    }
                    
            }
        }
        else if(consulta==="verificarCorreoNoExistenteRecordar" ){
            for(i=0; i<array.length;i++) {
                    if (array[i].cantidad==="0") {
                        $('#errorUserForgot').css("display","block");
                        $('#mailForgot').focus();
                        $("#mailForgot").removeClass("is-valid");
                        $("#mailForgot").addClass("is-invalid");
                    }
                    else if (array[i].cantidad==="1") {
                        $('#errorUserForgot').css("display","none");
                        $("#mailForgot").removeClass("is-invalid");
                        $("#mailForgot").addClass("is-valid");
                    }
                    
            }
        }
        else if(consulta==="verificarSKUExistente" ){
            for(i=0; i<array.length;i++) {
                    if (array[i].cantidad==="1") {
                        $('#errorSKU').css("display","block");
                        $('#SKU').focus();
                        $("#SKU").removeClass("is-valid");
                        $("#SKU").addClass("is-invalid");
                    }
                    else if (array[i].cantidad==="0") {
                        $('#errorSKU').css("display","none");
                        $("#SKU").removeClass("is-invalid");
                        $("#SKU").addClass("is-valid");
                    }
                    
            }
        }
    }
        
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send(); 
}



function llamarAjaxConsulta(consulta,idElemento) {
  var xmlhttp = new XMLHttpRequest();
  var url  = "../Back-end/queryAjax.php?consulta="+consulta;
  xmlhttp.onreadystatechange=function() {        
      if (xmlhttp.readyState === 4 ) {
        if (xmlhttp.status === 200){

        
          var array = JSON.parse(xmlhttp.responseText);
          var i;
          if(consulta==="obtenerCategorias"){
              var limpiar="<option value=0>Selecciona una opcion</option>";
              var out = "<option value=0>Selecciona una opcion</option>";
              for(i=0; i<array.length;i++) {
                  out+="<option value="+array[i].tblTipoId+">"+array[i].tblTipoNombre +"</option>";
              $(idElemento).text(out);
              }
          }
          else if(consulta==="obtenerTemporada"){
              var limpiar="<option value=0>Selecciona una opcion</option>";
              var out = "<option value=0>Selecciona una opcion</option>";
              for(i=0; i<array.length;i++) {
                  out+="<option value="+array[i].tblTemporadaId+">"+array[i].tblTemporadaNombre +"</option>";
              $(idElemento).text(out);
              }
          }
          else if(consulta==="obtenerUnidades"){
              var limpiar="<option value=0>Selecciona una opcion</option>";
              var out = "<option value=0>Selecciona una opcion</option>";
              for(i=0; i<array.length;i++) {
                  out+="<option value="+array[i].tblMedidaId+">"+array[i].tblMedidaNombre +"</option>";
              $(idElemento).text(out);
              }
          }
          else if(consulta==="obtenerRegion"){
              var limpiar="<option value=0>Selecciona una opcion</option>";
              var out = "<option value=0>Selecciona una opcion</option>";
              for(i=0; i<array.length;i++) {
                  out+="<option value="+array[i].tblRegionId+">"+array[i].tblRegionNombre +"</option>";
              $(idElemento).text(out);
              }
          }
          else if(consulta==="obtenerGenero"){
              var limpiar="<option value=0>Selecciona una opcion</option>";
              var out = "<option value=0>Selecciona una opcion</option>";
              for(i=0; i<array.length;i++) {
                  out+="<option value="+array[i].tblGeneroId+">"+array[i].tblGeneroNombre +"</option>";
              $(idElemento).text(out);
              }
          }
          else if(consulta==="obtenerDiasCambiosProductos"){
              var limpiar="<option value=0>Selecciona una opcion</option>";
              var out = "<option value=0>Selecciona una opcion</option>";
              for(i=0; i<array.length;i++) {
                  out+="<option value="+array[i].fecha+">"+array[i].fecha +"</option>";
              $(idElemento).text(out);
              }
          }
          else if(consulta==="obtenerDiasPedidos"){
              var limpiar="<option value=0>Selecciona una opcion</option>";
              var out = "<option value=0>Selecciona una opcion</option>";
              for(i=0; i<array.length;i++) {
                  out+="<option value="+array[i].fecha+">"+array[i].fecha +"</option>";
              $(idElemento).text(out);
              }
          }
          else if(consulta==="obtenerPedidosDelDiaPorValidar"){
              var out = "";
              for(i=0; i<array.length;i++) {
                  console.log(array[i]);
                  if(parseInt(array[i].total) >= 25000){
                      despacho = 0;
                  }
                  else{
                      despacho = Math.round(array[i].total *0.1);
                  }
                  total = parseInt(array[i].totalDesc)  + despacho
                  out+='<div id="validar_'+(array[i].correo.replace('@','_')).replace('.','_')+'" class="card text-center  shadow mb-2"><div class="card-header"></div><div class="card-body"><p class="lead">Cliente: '+array[i].nombre+' '+array[i].apellido+'</p><p class="lead"> Correo: '+array[i].correo+'</p><p class="lead"> Total: '+fNumber.go(total,"$")+'</p></div><div class="card-footer text-muted"><button class="btn btn-success" onclick = "ingresarPedidoValidado(\''+array[i].correo+'\')">Validar</button></div></div>'
              $(idElemento).text(out);
              }
          }

          $(idElemento).html(out);
      }
    }
    }
  xmlhttp.open("GET", url, true);
  xmlhttp.send(); 
}





function llamarAjaxConsultaVarible(consulta,idElemento,variable) {
var xmlhttp = new XMLHttpRequest();
var url  = "../Back-end/queryAjax.php?consulta="+consulta+"&variable="+variable;
xmlhttp.onreadystatechange=function() {
        
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        var array = JSON.parse(xmlhttp.responseText);
        var i;
        if(consulta==="obtenerSubCategorias"){
            var limpiar="<option value=0>Selecciona una opcion</option>";
            var out = "<option value=0>Selecciona una opcion</option>";
            for(i=0; i<array.length;i++) {
                out+="<option value="+array[i].tblSubTipoId+">"+array[i].tblSubTipoNombre +"</option>";
            $(idElemento).text(out);
            }
        }
        else if(consulta==="obtenerEspecificacion"){
            var limpiar="<option value=0>Selecciona una opcion</option>";
            var out = "<option value=0>Selecciona una opcion</option>";
            for(i=0; i<array.length;i++) {
                out+="<option value="+array[i].tblProductosCodigoDeBarra+">"+decode_utf8(array[i].tblProductosEspecificacion)+"</option>";
            $(idElemento).text(out);
            }
        }
        else if(consulta==="obtenerProducto"){
            for(i=0; i<array.length;i++) {
                $(".modal-body").remove(); 
                $(".modal-footer").remove();  
                $(".modal-content").append('<div class="modal-body"><img src='+array[i].tblProductosImagen+' alt="Foto producto" width="1100" height="500"><p class="text-center">'+'</p></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div>');
                $('#modalRegistro').modal('show'); 
            }
        }
        else if(consulta==="obtenerCiudad"){
            var limpiar="<option value=0>Selecciona una opcion</option>";
            var out = "<option value=0>Selecciona una opcion</option>";
            for(i=0; i<array.length;i++) {
                out+="<option value="+array[i].tblCiudadId+">"+array[i].tblCiudadNombre +"</option>";
            $(idElemento).text(out);
            }
        }
        else if(consulta==="obtenerComuna"){
            var limpiar="<option value=0>Selecciona una opcion</option>";
            var out = "<option value=0>Selecciona una opcion</option>";
            for(i=0; i<array.length;i++) {
                out+="<option value="+array[i].tblComunaId+">"+array[i].tblComunaNombre +"</option>";
            $(idElemento).text(out);
            }
        }
        else if(consulta==="obtenerLogProducto"){
              var out='';
              for(i=0; i<array.length;i++) {
                    var dataTime = array[i].tblLogProductosFecha;
                    var dataTimeVector = dataTime.split(" ");
                    var estado=array[i].tblLogProductosEstado;
                    switch(estado) {
                      case 'I':
                        estado='<p class="text-success">Insertado</p>';
                        break;
                      case 'U':
                        estado='<p class="text-warning">Actualizado</p>';
                        break;
                      case 'B':
                        estado='<p class="text-danger">Eliminado</p>';
                        break;
                    }
                    out+='<div class=" '+dataTimeVector[0]+'"><div class="card text-center  shadow "><div class="card-header"><h5>'+ dataTimeVector[0]+'</h5></div><div class="card-body"><p class="lead">Hora: '+dataTimeVector[1]+'</p><p class="lead"> Codigo del producto: '+array[i].tblProductosCodigoDeBarra+'</p>'+estado+' </div><div class="card-footer text-muted"></div></div><div class="line"></div></div>';
              $(idElemento).append(out);
              }
          }
          else if(consulta==="obtenerPedidosDelDia"){
              var out='';
              for(i=0; i<array.length;i++) {
                    var dataTime = array[i].tblPedidoFecha;
                    var dataTimeVector = dataTime.split(" ");
                    var numPedido=array[i].tblPedidoId;
                    out+='<div ><div class="card text-center  shadow "><div class="card-header"><h5>N°'+numPedido+'</h5></div><div class="card-body"><p class="lead">Cliente: '+array[i].tblPersonaNombre+' '+array[i].tblPersonaApellido+'</p><p class="lead"> Correo: '+array[i].tblUsuarioCorreo+' Fono: '+array[i].tblPersonaFono+'</p><p class="lead"> Hora: '+dataTimeVector[1]+'</p><p class="lead"> Metodo de pago: '+array[i].tblMedioPagoNombre+'</p><p class="lead"> Estado de pago: '+array[i].tblPagoEstado+'</p> </div><div class="card-footer text-muted"><a href="../Back-end/generarPDF.php?idPedido='+numPedido+'&correo='+array[i].tblUsuarioCorreo+'" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o" style="font-size:36px"></i></a></div></div><div class="line"></div></div>';
              $(idElemento).append(out);
              }
          }
                    else if(consulta==="obtenerTopProductos"){
              var post=obtenerPathForFile();
              var estado='active';
              var j=0;
              var k=0;
              var i=0;
              var out = "";
                for (j=0; j < 4 ; j++) { 
                  out+='<div class="item carousel-item '+estado+'">';
                  out+='<div class="row">';
                      var estado=''; 
                      for (k=0; k < 4 ; k++) { 
                        var descuento=Math.round(array[i].tblProductosPrecio*(1.0-(array[i].tblProductosDescuento/100.0)));
                        out+='<div class="col-sm-3">';
                          out+='<div class="thumb-wrapper card"><form  onsubmit="ingresarCarroRapido('+array[i].tblProductosCodigoDeBarra+');return false">';
                            out+='<div class="img-box">';
                              out+='<img src="'+(array[i].tblProductosImagen).replace('../',post)+'"  class="img-responsive img-fluid" alt="">';
                            out+='</div>';
                            out+='<div class="thumb-content">';
                              out+='<h4>'+decode_utf8(array[i].tblProductosEspecificacion)+'</h4>';
                              out+='<p class="item-price"><b>('+array[i].tblProductosCantidad+' '+array[i].tblMedidaNombre+')</b></p>' ;               
                              out+='<p class="item-price"><b>'+fNumber.go(descuento, "$")+'</b></p>';
                              out+='<button onclick="agregadoToast()" type="submit" class="btn btn-outline-success w-100" style="display:'+variable+'"><i class="fa fa-plus"></i><i class="fa fa-shopping-cart"></i></button>';
                            out+='</div>';            
                          out+='</div> </form>';
                        out+='</div>';
                       i+=1; }
                        
                    out+='</div>';
                  out+='</div>';
                }

              $(idElemento).append(out);
          }
        

        $(idElemento).html(out);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send(); 
}

