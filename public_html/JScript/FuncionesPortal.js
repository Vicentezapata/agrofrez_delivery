$(document).ready(function () {
            $('#ingresarProductos').on('click', function () {
                $('.frame').load('./Frames/ingresarProductos.html');
            
            });
            $('#consultarProductos').on('click', function () {
                $('.frame').load('./Frames/consultarProductos.html');
            
            });
            $('#modificarProductos').on('click', function () {
                $('.frame').load('./Frames/modificarProductos.html');
            
            });
            $('#cambiosProductos').on('click', function () {
                $('.frame').load('./Frames/logProductos.html');
            
            });
            $('#adminCategoria').on('click', function () {
                $('.frame').load('./Frames/adminCategoria.html');
            
            });
            $('#adminSubCategoria').on('click', function () {
                $('.frame').load('./Frames/adminSubCategoria.html');
            
            });
            $('#verPedidos').on('click', function () {
                $('.frame').load('./Frames/pedidosEmitidos.html');
            
            });
            $('#verResumenPedidoProd').on('click', function () {
                $('.frame').load('./Frames/resumenPedidosEmitidos.html');
            
            });
            $('#validarPago').on('click', function () {
                $('.frame').load('./Frames/validarPago.html');
            
            });
        });
    function verificar()
    {         
        var flag=true;
        var temporada=$('#temporada').val();
        var categoria=$('#categoria').val();
        var subCategoria=$('#subCategoria').val();
        var disponibilidad=$('#disponibilidad').val();
        var uMedida=$('#uMedida').val();
        //alert (clave1+clave2+prevision+comuna+region);
        if (temporada==="0") {
            $("#errorTemporada").css("display","block");
            flag=false;
        }
        else{
            $("#errorTemporada").css("display","none");
        }
        if (categoria==="0") {
            $("#errorCategoria").css("display","block");
            flag=false;
        }
        else{
            $("#errorCategoria").css("display","none");
        }
         if (subCategoria==="0") {
            $("#errorSubCategoria").css("display","block");
            flag=false;
        }
        else{
            $("#errorSubCategoria").css("display","none");
        }
        if (disponibilidad==="0") {
            $("#errorDisponibilidad").css("display","block");
            flag=false;
        }
        else{
            $("#errorDisponibilidad").css("display","none");
        }
        if (uMedida==="0") {
            $("#erroruMedida").css("display","block");
            flag=false;
        }
        else{
            $("#erroruMedida").css("display","none");
        }
        return flag;
        
    }