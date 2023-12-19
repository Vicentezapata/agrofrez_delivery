<?php
  session_start();
  if(isset($_SESSION["tipoAgrofrez"],$_SESSION["correoAgrofrez"])){
    $opciones='block';
    $login='none';
    $privilegio=$_SESSION["tipoAgrofrez"];
    $correo=$_SESSION["correoAgrofrez"];
    if($privilegio==1){
      $privilegio='block';

    }
    else{
      $privilegio='none';
    }
  }
  else{
    $login='block';
    $opciones='none';
    $usuario=" ";
    $privilegio='none';
  }
  
?>