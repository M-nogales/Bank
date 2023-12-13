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
    $resultado_loans = getAllLoans($conn);

    $resultado_allloans = "<table class=\"table table-bordered table-striped table-hover Main-table-border mt-5\">";
    $resultado_allloans .= "<thead><tr>";
    
    while ($columna = mysqli_fetch_field($resultado_loans)) {
        $resultado_allloans .= "<th scope=" . "col" . ">{$columna->name}</th>";
    }
    $resultado_allloans .= "</tr></thead><tbody>";
    

    while ($fila = mysqli_fetch_assoc($resultado_loans)) {
      $resultado_allloans .= "<tr>";
      foreach ($fila as $key => $value) {
          $resultado_allloans .= "<td scope=" . "row" . ">";

          if ($key === 'Vencimiento' && $value === null) {
              $resultado_allloans .= "<input type='date' name='vencimiento_input'>";
            } else {
              $resultado_allloans .= $value;
          }
          if ($key === 'Aceptada' && $value === null) {
            $resultado_allloans .= "<button type='button' class='btn btn-success'>Aceptar</button>";
            $resultado_allloans .= "<button type='button' class='btn btn-danger'>Rechazar</button>";
        }

          $resultado_allloans .= "</td>";
      }
      $resultado_allloans .= "</tr>";
    }
    $resultado_allloans .= "</tbody></table>";
    
    echo $resultado_allloans;
    ?>
  </div>
</body>

</html>