<?php
include 'ClaseCrud.php';

//CONDICION PARA REGISTRAR AL USUARIO EN LAS TABLAS PERSONA Y USUARIO;
if(isset($_POST['mail'],$_POST['clave1'])){
    $email = $_POST['mail'];
    $clave = $_POST['clave1'];
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarDatosUsuario($email,$clave);
    if($filasinsertadas >0){
        echo $filasinsertadas;
    }else
        {
        echo "Error al insertar";
        }
}
//CONDICION PARA REGISTRAR AL USUARIO EN LAS TABLAS PERSONA Y USUARIO;
else if(isset($_POST['mail'],$_POST['claveRemplazo'])){
    $email = $_POST['mail'];
    $clave = $_POST['claveRemplazo'];
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->restablecerClaveUser($email,$clave);
    if($filasinsertadas >0){
        echo $filasinsertadas;
    }else
        {
        echo "Error al insertar";
        }
}
//CONDICION PARA CERRAR SESION
else if(isset($_POST['logout'])){
    session_start();
    if(session_destroy()){
        echo '1';
    }
    
}
//CONDICION PARA INICIAR SESION Y ALMACENAR EL RUT EN CACHE;
else if(isset($_POST['user'],$_POST['pass'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    $filasinsertadas = $clasecrud->buscarLogin($user, $pass);
    if($filasinsertadas >0){
         echo "1";
    }
    else{
        //echo "USUARIO INCORRECTO";
    }
}



else if(isset($_GET["flag"])){
$flag=$_GET["flag"]; 
if ($flag='user') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fechaNac = $_POST['fechaNac'];
        $fono = $_POST['fono'];
        $genero = $_POST['genero'];
        $clave = $_POST['clave'];
        $num = $_POST['num'];
        $calle = $_POST['calle'];
        $comuna = $_POST['comuna'];
        //echo $nombre." ".$apellido." ".$fechaNac." ".$fono." ".$genero." ".$num." ".$calle." ".$comuna;
        $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
        // objeto = new clase();
        $filasinsertadas = $clasecrud->ingresarDatosUsuario($nombre,$clave,$apellido,$fechaNac,$fono,$genero,$num,$calle,$comuna);
        if($filasinsertadas >0){
            echo $filasinsertadas;
            header('location:../Paginas/usuario.php');
        }else
            {
            header('location:../Paginas/usuario.php');
            }
   }   
}

//CONDICION PARA REGISTRAR LOS DATOS PERSONALES DEL USUARIO;
else if(isset($_POST['nombre'],$_POST['apellido'],$_POST['fechaNac'],$_POST['fono'],$_POST['genero'],$_POST['num'],$_POST['calle'],$_POST['comuna'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNac = $_POST['fechaNac'];
    $fono = $_POST['fono'];
    $genero = $_POST['genero'];
    
    $num = $_POST['num'];
    $calle = $_POST['calle'];
    $comuna = $_POST['comuna'];
    $clave="";
    //echo $nombre." ".$apellido." ".$fechaNac." ".$fono." ".$genero." ".$num." ".$calle." ".$comuna;
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->ingresarDatosUsuario($nombre,$clave,$apellido,$fechaNac,$fono,$genero,$num,$calle,$comuna);
    if($filasinsertadas >0){
        echo $filasinsertadas;
        //header('location:../Paginas/usuario.php');
    }else
        {
        //header('location:../Paginas/usuario.php');
            //echo "ERORR AL INGRESAR".$filasinsertadas;
        }
}

//CONDICION PARA ACTUALIZAR UN PROUCTO sku:sku,stock:stock,especificacion:especificacion,precio:precio,descuento:descuento;
else if(isset($_POST['sku'],$_POST['stock'],$_POST['especificacion'],$_POST['precio'],$_POST['descuento'])){
    $sku = $_POST['sku'];
    $stock = $_POST['stock'];
    $especificacion = $_POST['especificacion'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->actualizarProducto($sku,$stock,$especificacion,$precio,$descuento);
    if($filasinsertadas >0){
        $filasinsertadas = $clasecrud->insertarLogProductos($sku,'U');
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}



//CONDICION PARA BORRAR UN PROUCTO 
else if(isset($_POST['sku'],$_POST['borrar'])){
    $sku = $_POST['sku'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->eliminarProducto($sku);
    if($filasinsertadas >0){
        $filasinsertadas = $clasecrud->insertarLogProductos($sku,'B');
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}


//CONDICION PARA AÑADIR UNA CATEGORIA
else if(isset($_POST['nombreCat'])){
    $nombreCat = $_POST['nombreCat'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarCategoria($nombreCat);
    if($filasinsertadas >0){
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}


//CONDICION PARA ELIMINAR UNA CATEGORIA
else if(isset($_POST['tipo'],$_POST['categoriaId'])){
    $tipo = $_POST['tipo'];
    if ($_POST['tipo']=="BORRAR") {
        $categoriaId = $_POST['categoriaId'];
        /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
        $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
        // objeto = new clase();
        $filasinsertadas = $clasecrud->eliminarCategoria($categoriaId);
        if($filasinsertadas >0){
            echo $filasinsertadas;

        }else
            {
                echo $filasinsertadas;
            }
    }
    else if ($_POST['tipo']=="BORRARSUBCAT") {
        $categoriaId = $_POST['categoriaId'];
        /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
        $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
        // objeto = new clase();
        $filasinsertadas = $clasecrud->eliminarSubCategoria($categoriaId);
        if($filasinsertadas >0){
            echo $filasinsertadas;

        }else
            {
                echo $filasinsertadas;
            }
    }
    
}

//CONDICION PARA AÑADIR UNA SUBCATEGORIA
else if(isset($_POST['nombSubCat'],$_POST['categoriaId'])){
    $nombSubCat = $_POST['nombSubCat'];
    $categoriaId = $_POST['categoriaId'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarSubCategoria($nombSubCat,$categoriaId);
    if($filasinsertadas >0){
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}
//CONDICION PARA VACIAR CARRO
else if(isset($_POST['tipo'],$_POST['idPedido'])&&$_POST['tipo']=="vaciarCarroValidado"){
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->vaciarCarroValidado($_POST['idPedido']);
    if($filasinsertadas >0){
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}
//CONDICION PARA VACIAR CARRO
else if(isset($_POST['tipo'])&&$_POST['tipo']=="vaciarCarro"){
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->vaciarCarro();
    if($filasinsertadas >0){
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}
//CONDICION PARA VALIDAR CODIGO
else if(isset($_POST['tipo'])&&$_POST['tipo']=="validarDescuento"){
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $codigo = $_POST['codigo'];
    $codigo = sanear_string($codigo);
    $filasinsertadas = $clasecrud->validarDescuento($codigo);
    echo $filasinsertadas;

}

//CONDICION PARA QUITAR PRODCUTOS AL CARRO DESDE EL CARRO
else if(isset($_POST['respuestaRestar'])){
    $sku = $_POST['sku_c'];
    $cantidad = $_POST['cantidad_c'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarEnCarro($sku,-1);
    if($filasinsertadas >0){
        $clasecrud->insertarLogCarro($sku); 
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}

//CONDICION PARA AÑADIR PRODCUTOS AL CARRO DESDE EL CARRO
else if(isset($_POST['respuestaSumar'])){
    $sku = $_POST['sku_c'];
    $cantidad = $_POST['cantidad_c'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarEnCarro($sku,1);
    if($filasinsertadas >0){
        $clasecrud->insertarLogCarro($sku); 
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}

//CONDICION PARA AÑADIR PRODCUTOS AL CARRO
else if(isset($_POST['sku'],$_POST['cantidad'])){
    $sku = $_POST['sku'];
    $cantidad = $_POST['cantidad'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarEnCarro($sku,$cantidad);
    if($filasinsertadas >0){
        $clasecrud->insertarLogCarro($sku); 
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}


//CONDICION PARA QUITAR UN PRODCUTO AL CARRO
else if(isset($_POST['sku'],$_POST['tipo']) && $_POST['tipo']=="QuitarDelCarro"){
    $sku = $_POST['sku'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->eliminarDelCarro($sku);
    if($filasinsertadas >0){
        echo $filasinsertadas;

    }else
        {
            echo $filasinsertadas;
        }
}
//CONDICION PARA INGRESAR UN PEDIDO
else if(isset($_POST['caja'],$_POST['bolsa'],$_POST['metodoPago'],$_POST['comment'])){
    $caja = $_POST['caja'];
    $metodoPago = $_POST['metodoPago'];
    $bolsa = $_POST['bolsa'];
    $comment = $_POST['comment'];
    /*echo $sku." ".$stock." ".$especificacion." ".$precio." ".$descuento;*/
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarPedido($caja,$bolsa,$metodoPago,$comment);
    if($filasinsertadas >0){

        echo $filasinsertadas;
        

    }else
        {
            echo $filasinsertadas;

        }
}
//CONDICION PARA INGRESAR UN PEDIDO POR EL ADMINISTRADOR
else if(isset($_POST['correo'],$_POST['tipo'])  && $_POST['tipo']=="pedidoValidado" ){
    
    $correo = $_POST['correo'];
    //echo ($correo);
    $clasecrud = new ClaseCrud(); // instanciar, es decir crear un objeto de la clase CRUD
    // objeto = new clase();
    $filasinsertadas = $clasecrud->insertarPedidoValidado($correo);
    if($filasinsertadas >0){

        echo $filasinsertadas;
        

    }else
        {
            echo $filasinsertadas;

        }
}



else{
    //print "te pasate";
}


function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
 
    return $string;
}



