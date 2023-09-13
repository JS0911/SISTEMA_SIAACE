<?php
require_once("../db/Conexion.php");
require_once("../Modelo/Usuario.php");
require_once("../Modelo/Bitacora.php");
require_once("../Controlador/ControladorUsuario.php");
require_once("../Controlador/ControladorBitacora.php");
session_start(); //Reanudamos la sesion
if (isset($_SESSION['usuario'])) {
  /* ========================= Capturar evento inicio sesión. =============================*/
 
  /* =======================================================================================*/
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon">
  <link href='../Recursos/boostrap5/bootstrap.min.css' rel='stylesheet'>
  <!-- Boxicons CSS -->
  <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href='http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/css/layout/sidebar.css' rel='stylesheet'>
  <title>Dashboard</title>
</head>

<body>
  <div class="conteiner">
    <div class="row gx-0">
      <!-- Menu lateral principal -->
      <div class="sb-conteiner col-2">
        <?php
        require_once 'layout/sidebar.html';
        ?>
      </div>
      <div class="content col-10">
        <div class="cards">
        </div>
      </div>
    </div>
  </div>
  <script src="../Recursos/boostrap5/bootstrap.min.js"></script>
  <script src="../Recursos/js/index.js"></script>
</body>
</html>