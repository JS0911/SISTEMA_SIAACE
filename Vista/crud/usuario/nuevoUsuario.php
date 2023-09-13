<?php
    require_once ("../../../db/Conexion.php");
    require_once ("../../../Modelo/Usuario.php");
    require_once ("../../../Modelo/Bitacora.php");
    require_once("../../../Controlador/ControladorUsuario.php");
    require_once("../../../Controlador/ControladorBitacora.php");
    require_once('enviarCorreoNuevoUsuario.php');
    $user = '';
    session_start(); //Reanudamos session
    if(isset($_SESSION['usuario'])){
        $user = $_SESSION['usuario'];
        $nuevoUsuario = new Usuario();
        $nuevoUsuario->usuario = $_POST['usuario'];
        $nuevoUsuario->nombreUsuario= $_POST['nombreUsuario'];
        $nuevoUsuario->idempleado= 1;
        $nuevoUsuario->contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        $nuevoUsuario->correo_electronico = $_POST['correo'];
        $nuevoUsuario->idRol = $_POST['idRol'];
        $nuevoUsuario->idestado_usuario = 1;
        $nuevoUsuario->preguntas_Contestadas = 0;
        $nuevoUsuario->creado_por = $user;
        ControladorUsuario::registroUsuario($nuevoUsuario);
        // enviarCorreoNuevoUsuario($nuevoUsuario->correo, $nuevoUsuario->usuario, $_POST['contrasena']);
        /* ========================= Evento Creacion nuevo Usuario. ======================*/
        // $newBitacora = new Bitacora();
        // $accion = ControladorBitacora::accion_Evento();
        // date_default_timezone_set('America/Tegucigalpa');
        // $newBitacora->fecha = date("Y-m-d h:i:s"); 
        // $newBitacora->idObjeto = ControladorBitacora:: obtenerIdObjeto('gestionUsuario.php');
        // $newBitacora->idUsuario = ControladorUsuario::obtenerIdUsuario($_SESSION['usuario']);
        // $newBitacora->accion = $accion['Insert'];
        // $newBitacora->descripcion = 'El usuario '.$_SESSION['usuario'].' creo usuario '.$_POST['usuario'];
        // ControladorBitacora::SAVE_EVENT_BITACORA($newBitacora);
        $respuesta = array();
        $respuesta = [
            'res' => 'resp'
        ];
        print json_encode($respuesta, JSON_UNESCAPE_UNICODE);
        
        /* =======================================================================================*/
    }
?>
