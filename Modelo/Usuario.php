<?php

class Usuario {
    public $idUsuario;
    public $idempleado;
    public $usuario;
    public $nombreUsuario;
    public $idestado_usuario;
    public $contrasena;
    public $fecha_Ultima_Conexion;
    public $preguntas_Contestadas;
    public $primer_ingreso;
    public $fecha_vencimiento;
    public $correo_electronico;
    public $idRol;
    public $creado_por;
    public $modificado_por;
    public $fecha_creacion;
    public $fecha_modificacion;
    public $reseteoClave;

    //Método para obtener todos los usuarios que existen.
    public static function obtenerTodosLosUsuarios(){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $listaUsuarios = 
            $consulta->query("SELECT u.ID_USUARIO, u.USUARIO, u.NOMBRE_USUARIO,
                u.CORREO_ELECTRONICO, e.DESCRIPCION, r.ROL
                FROM tbl_ms_usuario AS u
                INNER JOIN tbl_ms_estadousuario AS e ON u.ID_ESTADO_USUARIO = e.ID_ESTADO_USUARIO 
                INNER JOIN tbl_ms_roles AS r ON u.ID_ROL = r.ID_ROL;
            ");
        $usuarios = array();
        //Recorremos la consulta y obtenemos los registros en un arreglo asociativo
        while($fila = $listaUsuarios->fetch_assoc()){
            $usuarios [] = [
                'idUsuario' => $fila["ID_USUARIO"],
                'usuario' => $fila["USUARIO"],
                'nombreUsuario'=> $fila["NOMBRE_USUARIO"],
                'correo_electronico' => $fila["CORREO_ELECTRONICO"],
                'Estado' => $fila["DESCRIPCION"],
                'Rol' => $fila["ROL"]
            ];
        }
        mysqli_close($consulta); #Cerramos la conexión.
        return $usuarios;
    }
    //Método para crear nuevo usuario desde Autoregistro.
   public static function registroNuevoUsuario($nuevoUsuario){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
       
        $consulta->query("INSERT INTO tbl_ms_usuario (USUARIO,ID_EMPLEADO,NOMBRE_USUARIO,ID_ESTADO_USUARIO, CONTRASENA, 
                                    CORREO_ELECTRONICO,ID_ROL,CREADO_POR) 
                        VALUES ('$nuevoUsuario->usuario','$nuevoUsuario->idempleado','$nuevoUsuario->nombreUsuario','$nuevoUsuario->idestado_usuario',
                        '$nuevoUsuario->contrasena','$nuevoUsuario->correo_electronico','$nuevoUsuario->idRol','$nuevoUsuario->creado_por')");
        mysqli_close($consulta); #Cerramos la conexión.
        return $nuevoUsuario;
    }
    //Hace la búsqueda del usuario en login para saber si es válido
    public static function existeUsuario($userName, $userPassword){
        $passwordValida = false;
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $usuario = $consulta->query("SELECT CONTRASENA FROM tbl_ms_usuario WHERE USUARIO = '$userName'");
        $existe = $usuario->num_rows;
        if ($existe > 0) {
            $user = $usuario->fetch_assoc();
            $Password = $user['CONTRASENA'];
            $passwordValida = password_verify($userPassword, $Password);
        }
        mysqli_close($consulta); #Cerramos la conexión.
        return $passwordValida; //Si se encuentra un usuario válido/existente retorna un entero mayor a 0.
    }/*
    //Obtener intentos permitidos de la tabla parámetro
    public static function intentosPermitidos(){
        $intentos = null;
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $resultado = $conexion->query("SELECT valor  FROM tbl_ms_Parametro WHERE parametro = 'ADMIN_INTENTOS'");
        //Obtenemos el valor de Intentos que viene de la DB
        $fila = $resultado->fetch_assoc();
        if(isset($fila["valor"])){
            $intentos = $fila["valor"];
        }
        mysqli_close($conexion); #Cerramos la conexión.
        return $intentos;
    }
    //Obtener número de intentos falllidos del usuario en el login.
    public static function intentosInvalidos($usuario){
        $intentosFallidos = null;
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $existeUsuario = $conexion->query("SELECT usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'");
        if($existeUsuario){
            $resultado = $conexion->query("SELECT intentos_fallidos FROM tbl_ms_Usuario WHERE usuario = '$usuario'");
            //Obtenemos el valor de Intentos que viene de la DB
            $fila = $resultado->fetch_assoc();
            if(isset($fila["intentos_fallidos"])){
                $intentosFallidos = $fila["intentos_fallidos"]; 
            } 
        } 
        mysqli_close($conexion); #Cerramos la conexión.
        return $intentosFallidos;
    }
    public static function bloquearUsuario($intentosMax, $intentosFallidos, $user){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $estadoUser = false;
        if($intentosFallidos > $intentosMax){
            $nuevoEstado = 4;
            $estadoUser = $conexion->query("UPDATE tbl_ms_usuario SET `id_Estado_Usuario`= '$nuevoEstado' WHERE `usuario` = '$user'");
        }
        mysqli_close($conexion); #Cerramos la conexión.
        return $estadoUser;
    }
    public static function aumentarIntentosFallidos($usuario, $intentosFallidos){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $incremento = 0;
        if($intentosFallidos<=3){
            $incremento = ($intentosFallidos + 1);
            $conexion->query("UPDATE tbl_ms_Usuario SET `intentos_fallidos` = '$incremento' WHERE `usuario` = '$usuario'");
        }
        mysqli_close($conexion); #Cerramos la conexión.
        return $incremento;
    }
    //Obtener cantidad de preguntas desde el parámetro.
    public static function parametroPreguntas(){
        $cantPreguntas=0;
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $paramPreguntas = $consulta->query("SELECT valor FROM tbl_ms_Parametro WHERE parametro = 'ADMIN_PREGUNTAS'");
        $row = $paramPreguntas->fetch_assoc();
        if(isset($row["valor"])){
            $cantPreguntas = $row["valor"];
        }
        mysqli_close($consulta); #Cerramos la conexión.
        return $cantPreguntas;
    }
    public static function resetearIntentosFallidos($usuario){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $resetear = 0;
        $conexion->query("UPDATE tbl_ms_Usuario SET `intentos_fallidos` = '$resetear' WHERE `usuario` = '$usuario'");
        mysqli_close($conexion); #Cerramos la conexión.
     }*/
    public static function obtenerEstadoUsuario($usuario){
        $estado = null;
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $consultaEstado = $conexion->query("SELECT id_Estado_Usuario FROM tbl_MS_Usuario WHERE usuario = '$usuario'");
        $fila = $consultaEstado->fetch_assoc(); 
        if(isset($fila["id_Estado_Usuario"])){
            $estado = $fila["id_Estado_Usuario"];
        }
        mysqli_close($conexion); #Cerramos la conexión.
        return $estado;
     }
     /*
    public static function guardarPreguntas($usuario, $preguntas){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        foreach($preguntas as $pregunta){
            $conexion->query("INSERT INTO tbl_ms_preguntas (pregunta, Creado_por) VALUES ('$pregunta','$usuario');");
        }
        mysqli_close($conexion); #Cerramos la conexión.
    }


    public static function obtenerPreguntasUsuario(){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $preguntasUsuario = $conexion->query("SELECT id_pregunta, pregunta FROM tbl_ms_preguntas;");
        $preguntas = array();
        while($fila = $preguntasUsuario->fetch_assoc()){
            $preguntas [] = [
                'id_pregunta' => $fila["id_pregunta"],
                'pregunta' => $fila["pregunta"]
            ];
        }
        mysqli_close($conexion); #Cerramos la conexión.
        return $preguntas;
    }
/*
    public static function guardarRespuestasUsuario($usuario, $idPregunta, $respuesta){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $consultaIdUsuario = $conexion->query("SELECT id_usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'");
        $fila = $consultaIdUsuario->fetch_assoc();
        $idUsuario = $fila["id_usuario"];
        $conexion->query("INSERT INTO tbl_ms_Preguntas_X_Usuario (id_pregunta, id_usuario, respuesta)
            VALUES ('$idPregunta','$idUsuario','$respuesta');");
        mysqli_close($conexion); #Cerramos la conexión.
    }*/
    //===================== METODO REPETIDO, REVISAR==========================
    public static function obEstadoUsuario(){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB();
        $obtenerEstado = $conexion->query("SELECT id_Estado_Usuario, descripcion FROM tbl_ms_estadousuario;");
        $estados = array();
        while($fila = $obtenerEstado->fetch_assoc()){
            $estados [] = [
                'id_Estado_Usuario' => $fila["id_Estado_Usuario"],
                'descripcion' => $fila["descripcion"]
            ];
        }
        mysqli_close($conexion); #Cerramos la conexión.
        return $estados;

    }
    // ========================================================================
    public static function eliminarUsuario($usuario){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB();
        $consultaIdUsuario= $conexion->query("SELECT id_Usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'");
        $fila = $consultaIdUsuario->fetch_assoc();
        $idUsuario = $fila['id_Usuario'];
        //Eliminamos el usuario
        $estadoEliminado = $conexion->query("DELETE FROM tbl_ms_usuario WHERE id_Usuario = $idUsuario;");
        mysqli_close($conexion); #Cerramos la conexión.
        return $estadoEliminado;
    }
    public static function editarUsuario($nuevoUsuario){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB();
        $idUsuario = $nuevoUsuario->idUsuario;
        $usuario =$nuevoUsuario->usuario;
        $nombre = $nuevoUsuario->nombre;
        $correo =$nuevoUsuario->correo;
        $idestado = $nuevoUsuario->idestado;
        $idRol = $nuevoUsuario->idRol;
        $nuevoUsuario = $conexion->query("UPDATE tbl_ms_usuario SET usuario='$usuario', nombre_usuario='$nombreUsuario', correo_electronico='$correo_electronico', id_Estado_Usuario='$idestado_usuario', id_Rol='$idRol' WHERE id_Usuario='$idUsuario' ");
        mysqli_close($conexion); #Cerramos la conexión.
    }
    public static function obtenerRolUsuario($usuario){
        $rolUsuario = null;
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB(); #Abrimos la conexión a la DB.
        $consultaRol = $conexion->query("SELECT ID_ROL FROM tbl_ms_usuario WHERE usuario = '$usuario'");
        $fila = $consultaRol->fetch_assoc(); 
        if(isset($fila["id_Rol"])){
            $rolUsuario = $fila["id_Rol"];
        }
        mysqli_close($conexion); #Cerramos la conexión.
        
        return intval($rolUsuario);
    }/*
    public static function obtenerPreguntas($usuario){//método para obtener preguntas
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); 
        $listaPreguntas =  $consulta->query("SELECT p.id_Pregunta, p.pregunta
            FROM  tbl_ms_preguntas_x_usuario AS pu
            INNER JOIN tbl_ms_preguntas AS p ON p.id_Pregunta = pu.id_Pregunta
            INNER JOIN tbl_ms_usuario AS u ON pu.id_Usuario = u.id_Usuario WHERE u.usuario = '$usuario'");
        $preguntas = array();
        //Recorremos la consulta y obtenemos los registros en un arreglo asociativo
        while($fila = $listaPreguntas->fetch_assoc()){
            $preguntas [] = [
                'id_Pregunta' => $fila["id_Pregunta"],
                'pregunta' => $fila["pregunta"]
            ];
        }
        mysqli_close($consulta); #Cerramos la conexión.
        return $preguntas;
    }
    public static function validarUsuario($userName){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $usuario = $consulta->query("SELECT id_Usuario FROM tbl_MS_Usuario WHERE usuario = '$userName'");
        $existe = $usuario->num_rows;
        mysqli_close($consulta); #Cerrar la conexión.
        return $existe; //Si se encuentra un usuario válido/existente retorna un entero mayor a 0.
    }
    public static function obtenerRespuestaPregunta($idPregunta){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $respuesta = $consulta->query("SELECT respuesta FROM tbl_ms_preguntas_x_usuario WHERE id_Pregunta = '$idPregunta';");
        $fila = $respuesta->fetch_assoc();
        $res = $fila['respuesta'];
        mysqli_close($consulta); #Cerrar la conexión.
        return $res; 
    }
    public static function correoUsuario($usuario){
        $correo = '';
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $usuario = $consulta->query("SELECT correo_Electronico FROM tbl_MS_Usuario WHERE usuario = '$usuario'");
        $existe = $usuario->num_rows;
        if($existe > 0){
            $fila = $usuario->fetch_assoc();
            $correo = $fila['correo_Electronico'];
        }
        mysqli_close($consulta); #Cerrar la conexión.
        return $correo;
    }
    public static function guardarToken($user, $token){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $usuario = $consulta->query("SELECT id_Usuario FROM tbl_MS_Usuario WHERE usuario = '$user'");
        $fila = $usuario->fetch_assoc();
        $idUsuario = $fila['id_Usuario'];
        $resultado = $consulta->query ("INSERT INTO tbl_token (id_usuario, Token)
                    VALUES ('$idUsuario','$token')");
        mysqli_close($consulta); #Cerrar la conexión.           
        return $resultado;
    }
    //Nos dice si existe o no un usuario
    public static function usuarioExistente($usuario){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $user =  $consulta->query("SELECT usuario FROM tbl_MS_Usuario WHERE usuario = '$usuario'");
        $existe = $user->num_rows;
        mysqli_close($consulta); #Cerrar la conexión.
        return $existe;
    } 
    public static function obtenerCantPreguntasContestadas($usuario){
        $cantPreguntas = '';
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $userCantPreguntas =  $consulta->query("SELECT preguntas_Contestadas FROM tbl_MS_Usuario WHERE usuario = '$usuario';");
        $row = $userCantPreguntas->fetch_assoc();
        if(isset($row["preguntas_Contestadas"])){
            $cantPreguntas = $row["preguntas_Contestadas"];
        }
        mysqli_close($consulta); #Cerramos la conexión.
        return $cantPreguntas;
    }
    public static function incrementarPreguntasContestadas($usuario, $valorActual){
        $incremento = $valorActual+1;
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $consulta->query("UPDATE tbl_MS_Usuario  SET `preguntas_Contestadas`= '$incremento' WHERE `usuario` = '$usuario';");
        mysqli_close($consulta); #Cerramos la conexión.
    }
    public static function cambiarEstadoNuevo($usuario){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $consulta->query("UPDATE tbl_MS_Usuario  SET `id_Estado_Usuario`= 2 WHERE `usuario` = '$usuario';");
        mysqli_close($consulta); #Cerramos la conexión.
    }
    //Obtener contraseña actual y guardar en tbl_MS_historial_Contraseña
    public static function respaldarContraseniaAnterior($usuario){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $usuario = $consulta->query("SELECT id_Usuario, contrasenia FROM tbl_MS_Usuario WHERE usuario = '$usuario'");
        $existe = $usuario->fetch_assoc();
        $idUser = $existe['id_Usuario'];
        $contraseniaActual = $existe['contrasenia'];
        //Guardamos contraseña
       $guardar = $consulta->query("INSERT INTO tbl_ms_hist_contrasenia (id_Usuario, contrasenia) VALUES ('$idUser','$contraseniaActual');");
        mysqli_close($consulta); #Cerrar la conexión.
        return $guardar; //Si se guardo retorna true.
    }
    public static function actualizaRContrasenia($usuario, $contrasenia){
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $actualizar = $consulta->query("UPDATE tbl_MS_Usuario  SET `contrasenia`= '$contrasenia' WHERE `usuario` = '$usuario';");
        mysqli_close($consulta); #Cerrar la conexión.
        return $actualizar;
    }
    public static function origenNuevoUsuario($usuario){
        $creado = null;
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $obtCreadoPor = $consulta->query("SELECT Creado_Por FROM tbl_MS_Usuario WHERE usuario = '$usuario';");
        $fila = $obtCreadoPor->fetch_assoc();
        $user = $fila['Creado_Por'];
        if($usuario == $user){
           $creado = true;
        }else {
            $creado = false;
        }
        mysqli_close($consulta); #Cerramos la conexión.
        return $creado;
    }
    public static function validarToken($usuario, $tokenUsuario){
        $existe = false;
        $conn = new Conexion();
        $consulta = $conn->abrirConexionDB(); #Conexión a la DB.
        $user =  $consulta->query("SELECT id_Usuario FROM tbl_MS_Usuario WHERE usuario = '$usuario'");
        $fila = $user->fetch_assoc();
        $idUser = $fila['id_Usuario'];
        $validar = $consulta->query("SELECT token FROM tbl_token WHERE id_usuario='$idUser'");
        while($row = $validar->fetch_assoc()){
            if($tokenUsuario == $row['token']){
                $existe = true;
                break;
            }
        }
        mysqli_close($consulta); #Cerramos la conexión.
        return $existe;
    }*/
    //Recibe un usuario y devuelve un id de usuario.
    public static function obtenerIdUsuario($usuario){
        $conn = new Conexion();
        $conexion = $conn->abrirConexionDB();
        $resultado= $conexion->query("SELECT id_Usuario FROM tbl_ms_usuario WHERE usuario = '$usuario'");
        $fila = $resultado->fetch_assoc();
        $id = $fila['id_Usuario'];
        mysqli_close($conexion); #Cerramos la conexión.
        return $id;
    }
}#Fin de la clase