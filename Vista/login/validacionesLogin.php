<?php
    require_once ("../../db/Conexion.php");
    require_once ("../../Modelo/Usuario.php");
    require_once ("../../Modelo/Bitacora.php");
    require_once("../../Controlador/ControladorUsuario.php");
    require_once("../../Controlador/ControladorBitacora.php");

    $alerta = null;
    $usuario = false;
    $nuevoEstado = false;
    $estadoUsuario = null;
    //$intentosMax = intval(ControladorUsuario::intentosLogin());
    
   
    if(isset($_POST["submit"])){
        $nombreUsuario = $_POST["userName"];
        session_start(); //iniciamos seccion session
        $_SESSION["usuario"]=$nombreUsuario;
        $contrasena=$_POST["userPassword"];
        $existeUsuario=ControladorUsuario::login($nombreUsuario,$contrasena);
        if($existeUsuario==true)
        {
            header('location:../index.php ');
        }else{
          $alerta='Usuario y/o contraseña incorrecta';
        }
      
    }