<?php
include_once('php/conex.php');
//getAllUsers($conn);
//getAllLoans($conn);
include_once('php/admin.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'aceptar' || $accion === 'rechazar') {
      $loanID = $_POST['loan_id_' . $accion];

      // Resto de la lógica para aceptar o rechazar
      $query = "UPDATE Prestamos SET Aceptada = " . ($accion === 'aceptar' ? 1 : 0) . " WHERE ID = $loanID";
      mysqli_query($conn, $query);
    } elseif ($accion === 'actualizar') {
      $loanID = $_POST['loan_id']; // Cambio aquí
      // Lógica para actualizar la fecha de vencimiento y continuar con la lógica original
      // Obtener la nueva fecha de vencimiento
      $nuevaFechaVencimiento = isset($_POST['vencimiento_input']) ? $_POST['vencimiento_input'] : null;

      // Actualizar la fecha de vencimiento en la tabla Prestamos
      $query_update_vencimiento = "UPDATE Prestamos SET Vencimiento = '$nuevaFechaVencimiento' WHERE ID = $loanID";
      mysqli_query($conn, $query_update_vencimiento);

      // Continuar con la lógica original
      $query = "SELECT U.ID AS user_ID, P.ID AS loan_ID, P.Deuda, U.Saldo_total, P.Vencimiento FROM Prestamos P
                    LEFT JOIN Users U ON P.User_ID = U.ID
                    WHERE P.ID = $loanID";

      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      $user_ID = $row['user_ID'];
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

    // Nombres de las columnas
    while ($columna = mysqli_fetch_field($resultado_loans)) {
      $resultado_allloans .= "<th scope='col'>{$columna->name}</th>";
    }
    $resultado_allloans .= "<th scope='col'>Acciones</th>";
    $resultado_allloans .= "</tr></thead><tbody>";

    // Bucle while que recorre cada registro y muestra cada campo en la tabla.
    while ($fila = mysqli_fetch_assoc($resultado_loans)) {
      $resultado_allloans .= "<tr>";
      foreach ($fila as $key => $value) {
        $resultado_allloans .= "<td scope='row'>";

        if ($key === 'Vencimiento' && $value === null) {
          $resultado_allloans .= "<input type='date' name='vencimiento_input'>";
        } elseif ($key === 'Aceptada' && $value === null) {
          // Añadir botones de acción si la columna 'Aceptada' es null
          $resultado_allloans .= "<button type='submit' name='accion' value='aceptar' class='btn btn-success'>Aceptar</button>";
          $resultado_allloans .= "<button type='submit' name='accion' value='rechazar' class='btn btn-danger'>Rechazar</button>";
          $resultado_allloans .= "<input type='hidden' name='loan_id_aceptar' value='{$fila['ID']}'>";
          $resultado_allloans .= "<input type='hidden' name='loan_id_rechazar' value='{$fila['ID']}'>";
        } else {
          $resultado_allloans .= $value;
        }

        $resultado_allloans .= "</td>";
      }

      $resultado_allloans .= "<td>";
      $resultado_allloans .= "<button type='submit' name='accion' value='actualizar' class='btn btn-primary'>Actualizar</button>";
      $resultado_allloans .= "<input type='hidden' name='loan_id' value='{$fila['ID']}'>";
      $resultado_allloans .= "</td>";


      $resultado_allloans .= "</tr>";
    }
    $resultado_allloans .= "</tbody></table>";
    $resultado_allloans .= "</form>";

    // Imprimir la tabla
    echo $resultado_allloans;
    ?>
  </div>
</body>

</html>