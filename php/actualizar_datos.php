<?php

include_once('conex.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
  $prestamoID = $_POST['actualizar'];

  // comprobamos que esté seleccionado un estado aceptado/rechazado
  if (isset($_POST['aceptada_' . $prestamoID])) {
    $estado = $_POST['aceptada_' . $prestamoID];

    // si hemos aceptado (value=1)
    if ($estado == '1') {
      // Recoge la fecha de vencimiento
      if (isset($_POST['Vencimiento_' . $prestamoID])) {
        $nuevaFechaVencimiento = $_POST['Vencimiento_' . $prestamoID];

        // Validación: Si la fecha de vencimiento es null o vacía, no permite la actualización
        if ($nuevaFechaVencimiento === null || $nuevaFechaVencimiento === '') {
          //mostrar alert con error,pero falta tiempo
          header("Location: ../admin_view.php?error=1");
          exit;
        }

        // Comparamos la fecha de vencimiento con la fecha actual
        $fechaVencimiento = new DateTime($nuevaFechaVencimiento);
        $fechaActual = new DateTime();

        if ($fechaVencimiento < $fechaActual) {
          // Si la fecha de vencimiento es menor que la fecha actual, actualizamos el Saldo_Total del usuario
          $sqlGetLoanInfo = "SELECT User_ID, Deuda FROM Prestamos WHERE ID = $prestamoID";
          $resultLoanInfo = mysqli_query($conn, $sqlGetLoanInfo);
          $rowLoanInfo = mysqli_fetch_assoc($resultLoanInfo);

          if ($rowLoanInfo) {
            $userID = $rowLoanInfo['User_ID'];
            $deuda = $rowLoanInfo['Deuda'];
            //restamos al saldo del usuario la deuda que tiene del prestamo(la puede reducir pagando manualmente en prestamos.php)
            $update1 = "UPDATE Users SET Saldo_total = Saldo_total - $deuda WHERE ID = $userID";
            mysqli_query($conn, $update1);

            // Establecemos la deuda del préstamo a 0
            $update2 = "UPDATE Prestamos SET Deuda = 0 WHERE ID = $prestamoID";
            mysqli_query($conn, $update2);
            //debuging
            echo "Saldo_Total del usuario $userID actualizado después de vencimiento. <br>";
            echo "Deuda del préstamo $prestamoID establecida a 0. <br>";
          }
        }

        // Actualizamos la fecha de vencimiento
        $update3 = "UPDATE Prestamos SET Vencimiento = '$nuevaFechaVencimiento' WHERE ID = $prestamoID";
        mysqli_query($conn, $update3);
        //debuging
        echo "Nueva fecha de vencimiento para el préstamo $prestamoID: $nuevaFechaVencimiento <br>";

      }
    } else {
      // Si hemos rechazado (value=0), actualizamos la fecha de vencimiento a '0000-00-00'
      $update4 = "UPDATE Prestamos SET Vencimiento = '0000-00-00' WHERE ID = $prestamoID";
      mysqli_query($conn, $update4);
      //debuging
      echo "Préstamo $prestamoID Rechazado. Fecha de vencimiento actualizada a '0000-00-00'<br>";

      // Establecemos la deuda del préstamo a 0
      $update5 = "UPDATE Prestamos SET Deuda = 0 WHERE ID = $prestamoID";
      mysqli_query($conn, $update5);
      //debuging
      echo "Deuda del préstamo $prestamoID establecida a 0. <br>";
    }

    // Actualizamos el estado del prestamo a aceptado o rechazado(1/0)
    $update6 = "UPDATE Prestamos SET Aceptada = $estado WHERE ID = $prestamoID";
    mysqli_query($conn, $update6);
    //debuging
    echo "Préstamo $prestamoID ";
    echo ($estado == '1') ? "Aceptado" : "Rechazado";
    echo "<br>";
    header("Location: ../admin_view.php");
  } else {
    // mostrar alert con el error pero falta de tiempo
    header("Location: ../admin_view.php?error=2");
    exit;
  }
}
