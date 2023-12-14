<?php
include_once('php/conex.php');
//getAllUsers($conn);
//getAllLoans($conn);
include_once('php/admin.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['loan_id'], $_POST['accion'])) {
    $loanID = $_POST['loan_id'];
    $accion = $_POST['accion'];
    echo $loanID;
    echo $accion;
    if ($accion === 'aceptar') {
      $query = "UPDATE Prestamos SET Aceptada = 1 WHERE ID = $loanID";
      mysqli_query($conn, $query);
    } elseif ($accion === 'rechazar') {
      $query = "UPDATE Prestamos SET Aceptada = 0 WHERE ID = $loanID";
      mysqli_query($conn, $query);
    } elseif ($accion === 'actualizar') {
      // Obtener la nueva fecha de vencimiento
      $nuevaFechaVencimiento = isset($_POST['vencimiento_input']) ? $_POST['vencimiento_input'] : null;

      // Actualizar la fecha de vencimiento en la tabla Prestamos
      $query_update_vencimiento = "UPDATE Prestamos SET Vencimiento = '$nuevaFechaVencimiento' WHERE ID = $loanID";
      mysqli_query($conn, $query_update_vencimiento);

      // Continuar con la lógica anterior
      $query = "SELECT U.ID AS user_ID, P.ID AS loan_ID, P.Deuda, U.Saldo_total, P.Vencimiento FROM Prestamos P
                LEFT JOIN Users U ON P.User_ID = U.ID
                WHERE P.ID = $loanID";

      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      $user_ID = $row['user_ID'];
      $loan_ID = $row['loan_ID'];
      $deuda = $row['Deuda'];
      $saldo_total = $row['Saldo_total'];
      $vencimiento = strtotime($row['Vencimiento']);
      $fecha_actual = time();

      if ($vencimiento < $fecha_actual) {
          $saldo_actualizado = $saldo_total - $deuda;
          $query_update_user = "UPDATE Users SET Saldo_total = $saldo_actualizado WHERE ID = $user_ID";
          mysqli_query($conn, $query_update_user);

          $query_update_loan = "UPDATE Prestamos SET Deuda = 0 WHERE ID = $loanID";
          mysqli_query($conn, $query_update_loan);
      }
  }
  }
}
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

    $resultado_allloans = "<form method='post' action=''>";
    $resultado_allloans .= "<table class='table table-bordered table-striped table-hover Main-table-border mt-5'>";
    $resultado_allloans .= "<thead><tr>";

    while ($columna = mysqli_fetch_field($resultado_loans)) {
      $resultado_allloans .= "<th scope='col'>{$columna->name}</th>";
    }
    $resultado_allloans .= "<th scope='col'>Acciones</th>";
    $resultado_allloans .= "</tr></thead><tbody>";

    while ($fila = mysqli_fetch_assoc($resultado_loans)) {
      $resultado_allloans .= "<tr>";
      foreach ($fila as $key => $value) {
          $resultado_allloans .= "<td scope='row'>";
  
          if ($key === 'Vencimiento' && $value === null) {
              $resultado_allloans .= "<input type='date' name='vencimiento_input'>";

          }
          if ($key === 'Aceptada' && $value === null) {
              $resultado_allloans .= "<button type='submit' name='accion' value='aceptar' class='btn btn-success'>Aceptar</button>";
              $resultado_allloans .= "<button type='submit' name='accion' value='rechazar' class='btn btn-danger'>Rechazar</button>";
              $resultado_allloans .= "<input type='hidden' name='loan_id' value='{$fila['ID']}'>";
          } else {
              $resultado_allloans .= $value;
          }
  
          $resultado_allloans .= "</td>";
      }
      $resultado_allloans .= "<td>";
      $resultado_allloans .= "<button type='submit' name='accion' value='actualizar' class='btn btn-primary'>Actualizar</button>";
      $resultado_allloans .= "<input type='hidden' name='loan_id' value='{$fila['ID']}'>";
      echo $fila['ID'];
      $resultado_allloans .= "</td>";
  
      $resultado_allloans .= "</tr>";
  }
    $resultado_allloans .= "</tbody></table>";
    $resultado_allloans .= "</form>";

    echo $resultado_allloans;
    ?>
  </div>
</body>

</html>