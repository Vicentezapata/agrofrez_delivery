<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conexion
 *
 * @author Tiburon
 */
class conexion {
    
    public static function conectar() {
        
        $server = "localhost";
        $user = "agrofrez_admin";
        $pass = "2t7i0b8u9r5on";
        $bd = "agrofrez_ventas"; //debemos escribir el nombre de nuestra base de datos.*/
        
        //$server = "localhost";
        //$user = "root";
        //$pass = "";
        //$bd = "agrofrez"; // debemos escribir el nombre de nuestra base de datos.*/
        
        // manejar excepciones.
        try{            
            $conexion = mysqli_connect($server, $user, $pass, $bd);
            if(!$conexion){
                echo("Error... ");
                echo("Error n: ") . mysqli_connect_errno() . PHP_EOL;
                echo "error de depuraci贸n: " . mysqli_connect_error() . PHP_EOL;
            }
            else{
                return $conexion;
            }
        }
        catch (mysqli_sql_exception $error)
        {
            print_r($error->getMessage());
            exit();            
        }
    }
    public function cerrar($link) { 
        // manejar excepciones.     
        mysqli_close($link); 
    }  
}