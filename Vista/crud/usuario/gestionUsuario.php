<?php
require_once("../../../db/Conexion.php");
require_once("../../../Modelo/Usuario.php");
//require_once("../../../Modelo/Bitacora.php");
require_once("../../../Controlador/ControladorUsuario.php");
//require_once("../../../Controlador/ControladorBitacora.php");
session_start(); //Reanudamos la sesion


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" >
  <!-- Boostrap5 -->
  <link href='../../../Recursos/boostrap5/bootstrap.min.css' rel='stylesheet'>
  <!-- DataTables -->
  <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
  <!-- Boxicons CSS -->
  <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <!-- Estilos personalizados -->
  <link href="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/css/gestionUsuario.css" rel="stylesheet" />
  <link href="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/css/modalNuevoUsuario.css" rel="stylesheet">
  <link href='http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/css/layout/sidebar.css' rel='stylesheet'>
  <title> Mantenimiento Usuario </title>
</head>

<body>
  <div class="conteiner">
    <div class="row">
      <div class="columna1 col-2">
        <?php
          require_once '../../layout/sidebar.html';
        ?>
      </div>

      <div class="columna2 col-10">
      <H1>Mantenimiento de Usuarios</H1>
        <div class="table-conteiner">
          <div>
            <a href="#" class="btn_nuevoRegistro btn btn-primary" id="btn_nuevoRegistro" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
          </div>
          <table class="table" id="table-Usuarios">
            <thead>
              <tr>
                <th scope="col"> ID </th>
                <th scope="col"> USUARIO </th>
                <th scope="col"> NOMBRE </th>
                <th scope="col"> CORREO </th>
                <th scope="col"> ESTADO </th>
                <th scope="col"> ROL </th>
                <th scope="col"> OPCIONES </th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              
            </tbody>
          </table>
        </div>
      </div>
      
    </div>
  </div>
  <?php
  require('modalNuevoUsuario.html');
  require('modalEditarUsuario.html');
  require('modalVerUsuario.html');
  ?>
  <script src="https://kit.fontawesome.com/2317ff25a4.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
  <script src="../../../Recursos/js/librerias//jQuery-3.7.0.min.js"></script>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <!-- Scripts propios -->
  <script src="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/js/dataTable.js" type="module"></script>
  <script src="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/js/librerias/jquery.inputlimiter.1.3.1.min.js"></script>
  <script src="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/js/validacionesModalNuevoUsuario.js" type="module"></script>
  <script src="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/js/validacionesModalEditarUsuario.js" type="module"></script>
  <script src="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/boostrap5/bootstrap.min.js"></script>
  <script src="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/js/index.js"></script>
</body>
</html>