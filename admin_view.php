<?php
include_once('php/conex.php');
//getAllUsers($conn);
//getAllLoans($conn);
include_once('php/admin.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista administrador</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script defer src="js/bootstrap.bundle.js"></script>
</head>

<body>
  <div class="table-responsive">
    <?php
    $resultado1 = getAllUsers($conn);

    $resultado_allusers = "<table class=\"table table-bordered table-hover Main-table-border mb-0\">";
    $resultado_allusers .= "<thead><tr>";

    while ($columna = mysqli_fetch_field($resultado1)) {
      $resultado_allusers .= "<th scope=" . "col" . ">{$columna->name}</th>";
    }
    $resultado_allusers .= "</tr></thead><tbody>";

    while ($fila = mysqli_fetch_assoc($resultado1)) {
      $resultado_allusers .= "<tr>";
      foreach ($fila as $value) {
        $resultado_allusers .= "<td scope=" . "row" . ">$value</td>";
      }
      $resultado_allusers .= "</tr>";
    }
    $resultado_allusers .= "</tbody></table>";

    echo $resultado_allusers;
    ?>
  </div>
  <div class="table-responsive">
    <?php
    $resultado1  = getAllLoans($conn);

    echo "<form method='post' action='php/actualizar_datos.php'>"; // Formulario para actualizar datos

    echo "<table class=\"table table-bordered table-hover Main-table-border mt-5\">";
    echo "<thead><tr>";
    
    // Obtenemos los nombres de las columnas
    while ($columna = mysqli_fetch_field($resultado1)) {
      echo "<th scope="."col".">{$columna->name}</th>";
    }
    echo "<th scope='col'>Actualizar</th>";
    echo "</tr></thead><tbody>";
    
    while ($fila = mysqli_fetch_assoc($resultado1)) {
      echo "<tr>";
      foreach ($fila as $key => $value) {
        // si existe una columna de vencimiento con un valor null inserta un input
        // de nombre columna_ID de la fila
        if ($key == "Vencimiento" && $value === null) {
          echo "<td><input type='date' name='Vencimiento_{$fila["ID"]}' value=''></td>";
          // en caso de que no se cumpla verifica aceptada, igual que antes
        } elseif ($key == "Aceptada" && $value === null) {
          echo "<td>";
          echo "<label><input type='radio' name='aceptada_{$fila["ID"]}' value='1'> Aceptar</label><br>";
          echo "<label><input type='radio' name='aceptada_{$fila["ID"]}' value='0'> Rechazar</label>";
          echo "</td>";
        } else {
          echo "<td>$value</td>";
        }
      }
      //finalmente se crea el boton con EL VALOR DEL ID
      echo "<td><button type='submit' name='actualizar' value='{$fila["ID"]}'>Actualizar</button></td>";
      echo "</tr>";
    }
    
    echo "</tbody></table>";
    echo "</form>";

    ?>
  </div>
</body>

</html>