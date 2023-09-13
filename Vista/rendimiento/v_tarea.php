<?php
  require_once('validacionesTarea.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1862/1862358.png">
  <!-- Boxicons CSS -->
  <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../Recursos/boostrap5/bootstrap.min.css">
  <link rel="stylesheet" href="../../Recursos/css/layout/sidebar.css">
  <link rel="stylesheet" href="../../Recursos/css/tarea.css">
  <title>Tareas</title>
</head>
<body>
  <div class="conteiner">
    <div class="row gx-0">
      <div class="col-2">
        <?php
          require_once '../layout/sidebar.html';
        ?>
      </div>
      <div class="col-10">
        <div class="row gx-0 encabezado">
          <h2>Tus tareas</h2>
        </div>
        <div class="row gx-0 conteiner_col">
          <!-- LLamadas -->
          <div class="col-3">
            <span>
              <p class="title-task">Llamada</p>
            </span>
            <div class="container_llamada" >
                <?php 
                  foreach($tareas as $tarea){
                    echo '<div class="card_task"><p>'.$tarea['tituloTarea'].'</p>';
                    echo '<p>'.$tarea['fechaInicio'].'</p></div>';
                  }
                ?>
            </div>
          </div>
          <!-- Leads -->
          <div class="col-3">
            <span>
              <p class="title-task">Lead</p>
            </span>
          </div>
          <!-- Cotizaciones -->
          <div class="col-3">
            <span>
              <p class="title-task">Cotización</p>
            </span>
          </div>
          <!-- Venta -->
          <div class="col-3"> 
            <span>
              <p class="title-task">Venta</p>
            </span> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../Recursos/boostrap5/bootstrap.min.js "></script>
  <script src="../../Recursos/js/index.js"></script>
</body>
</html>