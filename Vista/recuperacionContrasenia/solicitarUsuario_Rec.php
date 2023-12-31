<?php
    require_once("validacionesRecuperacion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="/Recursos/css/login.css" rel="stylesheet" />
    <!-- <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1862/1862358.png"> -->
    <title>Solicitar el usuario</title>
</head>
<body class="container" style = "margin-top: 5.5rem; background: linear-gradient(85deg, #5ff3da 20%, #6c83d6 80%);">
    <div class="ancho">
       
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" id="formcorreo"
                style=" border-radius:8px; 
                box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2); 
                background-color: #f8fbfd; 
                width:700px; 
                height:200px;
                padding-top:40px;
                padding-left: 40px;
                padding-right: 40px;
                margin: auto;">
                <!-- <div class="logo-empresa">
                    <img src="../../Recursos/imagenes/LOGO-HD-transparente.jpg" height="180px">
                </div> -->
                <div>
                    <h2 style="font-size: 1.6rem;">Nombre de usuario</h2>
                    <div class="wrap-input mb-3">
                        <!-- <span class="conteiner-icon">
                            <i class="icon fa-solid fa-user"></i>
                        </span> -->
                        <input input type="text"  style="text-transform:uppercase" class="form-control" id="user" required="" name="userName" maxlength="15" placeholder="Usuario">
                    </div>
                </div>
                <div class="wrap-input">
                    <?php
                        $opcion = '';
                        if(isset($_SESSION['metodo']) || isset($_POST['radioOption'])){
                            if(isset($_SESSION['metodo'])){
                                $opcion = $_SESSION['metodo'];
                            }else if(isset($_POST['radioOption'])){
                                $opcion = $_POST['radioOption'];
                            }
                            if($opcion == 'correo'){
                                $texto = 'Enviar correo';
                            } else {
                                $texto = 'Continuar';
                            }
                        }
                        echo '<button type="submit" class="btn btn-primary btn-block" name="submit">'.$texto.'</button>';            
                    ?>
                    <a href="v_recuperarContrasena.html" class="btn btn-danger"  >Regresar</a>
                </div>
                <?php
                if($mensaje != ''){
                    echo '<p>'.$mensaje.'</p>';
                }
                ?>
            </form>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2317ff25a4.js" crossorigin="anonymous"></script>
</body>
</html>

