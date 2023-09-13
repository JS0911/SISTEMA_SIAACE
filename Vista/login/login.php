<?php
  require_once('validacionesLogin.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="http://localhost:90/APP_COOPERATIVA_SISTEMAWEB/Recursos/css/login.css" rel="stylesheet" >
    
    <title>Iniciar sesión</title>
</head>
<body id="body">
    <div class="ancho">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="formLogin">
            <div class="logo-empresa"  style="text-align: center">
                <img src="../../Recursos/imagenes/logo_siaace.jpg" height="250px">
            </div>
            <?php 
              if(!$alerta == ''){
                echo '<h2 class="mensaje-error">'. $alerta. '</h2>';
              }
              ?>
            <div class="wrap-input mb-3">
              <span class="conteiner-icon">
                <i class="icon fa-solid fa-user"></i>
              </span>
              <input type="text" class="form-control" name="userName" id="userName" placeholder="Usuario">
              <p class="mensaje"></p>
            </div>
            <div class="wrap-input mb-3">
              <span class="lock conteiner-icon">
              <i class="icon  type-lock fa fa-eye-solid  fa fa-eye-slash"></i>
              </span>
              <input type="password" class="form-control" id="userPassword" name="userPassword" maxlength="20" placeholder="Contraseña" >
              <p class="mensaje"></p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" id="btn-submit">Ingresar</button>
            <label class="btn-cuenta">¿Aún no tienes cuenta? </label><a href = "registro.php">Regístrate</a>
            <a href="../recuperacionContrasenia/v_recuperarContrasena.html">¿Olvidaste tu usuario y/o contraseña?</a>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2317ff25a4.js" crossorigin="anonymous"></script>
    <script src="../../Recursos/js/librerias/jQuery-3.7.0.min.js"></script>
    <script src="../../Recursos/js/librerias/jquery.inputlimiter.1.3.1.min.js"></script>
    <script src="../../Recursos/js/validacionesLogin.js" type="module"></script>
</body>
</html>