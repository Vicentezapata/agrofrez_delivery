//F
$(document).ready(function(){
    //EVENTO CLICK
    $('#btnRegistro').click(function(){
    	$('#modalLogin').modal('hide');
    	$('#modalRegistrarme').modal('show')
    })
    $('#btnForgot').click(function(){
        $('#modalLogin').modal('hide');
        $('#modalForgot').modal('show')
    })
});
$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

function mostrarInfoPago(indice){
    var btn='<button class="btn btn-success my-2 my-sm-0" value="convencional" id="btn_pago" type="submit">Realizar pedido</button>'
    var btn_flow='<button class="btn p-0" id="btn_pago" value="flow" type="submit"><img src="https://www.flow.cl/img/botones/btn-pagar-negro.png"></button>'
    var info;
        switch(indice){
            case "1":
                info='<div id="metodoPagP"><h5>Realizar abono.</h5><p>Haz click en el botón de pagar ingresa el monto que deseas abonar o pagar el pedido en su totalidad, sigue los pasos y volverás para poder emitir tu solicitud,de quedar una diferencia de saldo deberá ser informada en los comentarios como será regularizada, (Si no deseas perder la información ingresada, puedes cerrar la pestaña emergente), cualquier duda o consulta contáctanos.</p></div>';
                $( "#btn_pago" ).replaceWith( btn_flow );
            break;
            case "2":
                info='<div id="metodoPagP"><h5>Datos de trasferencia.</h5><p>Nombre: AGROFREZ DELIVERY SPA.</p><p>Rut: 76.935.374-7 </p><p>Banco: ITAU</p><p>Cuenta (CORRIENTE): 0214361766</p><p>Mail: agrofrezdelivery@gmail.com</p><p>Comentario: Debes mencionar tu nombre</p></div>';
                $( "#btn_pago" ).replaceWith(btn);
            break;
            case "3":
                info='<div  id="metodoPagP"><h5>Informacion importante:</h5><p>Al momento de llegar el despacho debes contar con el monto exacto, debido que no manejamos vuelto.</p></div>';
                $( "#btn_pago" ).replaceWith(btn);
            break;
        }
        //alert(info);
        $("#metodoPagP").remove();
        $(info).insertBefore( "#metodoPago" );
}












function habilitarCampo(id) {
        var idhtml;
        var variableConsulta;
        var variableId;
    if (id==="#direccion") {
        variableConsulta="'obtenerCiudad'";
        variableId="'#ciudad'";
        $('#calle').prop('readonly', false);
        $('#num').prop('readonly', false);
        $('#ciudad').prop('readonly', false);
        //$('#ciudad').replaceWith('<select type="text" class="form-control"  name="ciudad" id="ciudad"  onclick="llamarAjaxConsultaVarible(\'obtenerComuna\',\'#comuna\',this.value)"><option value="0">Debes seleccionar una region</option></select>'); 
        $('#ciudad').replaceWith('<select type="text" class="form-control" name="ciudad" id="ciudad" ><option value="0">Selecciona una opcion</option><option value="1301">Santiago</option></select>'); 
        $('#comuna').prop('readonly', false);
        //$('#comuna').replaceWith('<select type="text" class="form-control"  name="comuna" id="comuna" ><option value="0">Debes seleccionar una ciudad</option></select>'); 
        $('#comuna').replaceWith('<select type="text" class="form-control" name="comuna" id="comuna"><option value="0">Selecciona una opcion</option><option value="13134">Chicureo</option><option value="13107">Huechuraba</option><option value="13133">La Dehesa</option><option value="13113">La Reina</option><option value="13135">Las Condes</option><option value="13115">Lo Barnechea</option><option value="13123">Providencia</option><option value="13125">Quilicura</option><option value="13132">Vitacura</option></select>'); 
        idhtml="region";
        
        var url = "../JScript/AJAX.js";
        //$('#region').replaceWith('<select type="text" class="form-control"  name="'+idhtml+'" id="'+idhtml+'"  onclick="llamarAjaxConsultaVarible('+variableConsulta+','+variableId+',this.value)"><option value="0">Seleccione una opcion</option></select>'); 
        $('#region').replaceWith('<select type="text" class="form-control" name="region" id="region" ><option value="0">Selecciona una opcion</option><option value="13">Metropolitana</option></select>'); 
        $.getScript(url).done(function() {
                /* yay, all good, do something */
                llamarAjaxConsulta('obtenerRegion','#region');
        });
        $('#flagAddress').text("Modificar");
        $('#btnEditDirecc').css("display","none");

    }
    else if (id==="#persona") {
        idhtml="genero";
        var url = "../JScript/AJAX.js";
        $('#genero').replaceWith('<select type="text" class="form-control"  name="'+idhtml+'" id="'+idhtml+'"  ><option value="0">Seleccione una opcion</option></select>'); 
        $.getScript(url).done(function() {
                /* yay, all good, do something */
                llamarAjaxConsulta('obtenerGenero','#genero');
        });
        $('#fechaNac').attr('type', 'date');
        $('#fechaNac').prop('readonly', false);
        $('#fono').attr('type', 'number');
        $('#fono').prop('readonly', false);
        $('#apellido').prop('readonly', false);
        $('#nombre').prop('readonly', false);
        $('#flagUser').text("Modificar");
        $('#btnEditInfoUser').css("display","none");
    }
    else if (id==="#usuario") {

        $('#clave').prop('readonly', false);
        //$('#mail').prop('readonly', false);
    }    
}
    