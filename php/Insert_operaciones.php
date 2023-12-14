<?php
include_once('conex.php');
//getIdUsersWithKey($conn, $clave)
include_once('get_id.php');
$destinatario = $_POST["Destinatario"];
$motivo = $_POST["motivo"];
$cantidad = $_POST["Cantidad"];

// busca en la base de datos el id con el email introducido
function getIdUsersWithEmail($conn, $email)
{
  $consulta = "SELECT ID FROM Users WHERE Email = '$email'";
  $resultado = mysqli_query($conn, $consulta) or die("Error en la consulta a la base de datos");

  if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $idUsuario = $fila['ID'];
    return $idUsuario;
  } else {
    echo "No hay resultados en la base de datos para el correo proporcionado.";
    return null;
  }
}

// modificar ddbb, operaciones idem enviar, relación-tabla reflexiva
function insertOperation($conn, $id_remitente, $id_destinatario, $motivo, $cantidad, $fecha)
{
  // Insertar operación en la tabla Transigir
  $insertTransigir = "INSERT INTO Transigir (Remitente_ID, Destinatario_ID, Motivo, Cantidad, Fecha_operacion) 
            VALUES ($id_remitente, $id_destinatario, '$motivo', $cantidad, '$fecha')";
  mysqli_query($conn, $insertTransigir) or die("Error al insertar operación en la base de datos");


  // Verificar si el remitente y el destinatario son iguales para que solamente sume
  if ($id_remitente === $id_destinatario) {
    // Actualizar saldo del remitente sumando $cantidad
    $updateSaldoRemitente = "UPDATE Users SET Saldo_total = Saldo_total + $cantidad WHERE ID = $id_remitente";
    mysqli_query($conn, $updateSaldoRemitente) or die("Error al actualizar saldo del remitente");
  } else {

    // Actualizar saldo del remitente restando $cantidad
    $updateSaldoRemitente = "UPDATE Users SET Saldo_total = Saldo_total - $cantidad WHERE ID = $id_remitente";
    mysqli_query($conn, $updateSaldoRemitente) or die("Error al actualizar saldo del remitente");

    // Actualizar saldo del destinatario sumando $cantidad
    $updateSaldoDestinatario = "UPDATE Users SET Saldo_total = Saldo_total + $cantidad WHERE ID = $id_destinatario";
    mysqli_query($conn, $updateSaldoDestinatario) or die("Error al actualizar saldo del destinatario");
  }

  echo "Operación registrada con éxito. Saldo actualizado.";
}

session_start();
$id_user = getIdUsersWithKey($conn, $_SESSION["clave"]);
$destinatario == $id_user || $destinatario == "yo" || $destinatario == "me" ? $id_destinatario = $id_user : $id_destinatario = getIdUsersWithEmail($conn, $destinatario);

$fecha = date("Y-m-d H:i:s");

// Función para obtener el saldo actual del remitente
function getSaldoRemitente($conn, $id_remitente)
{
  $consultaSaldo = "SELECT Saldo_total FROM Users WHERE ID = $id_remitente";
  $resultadoSaldo = mysqli_query($conn, $consultaSaldo) or die("Error al obtener el saldo del remitente");

  if (mysqli_num_rows($resultadoSaldo) > 0) {
    $filaSaldo = mysqli_fetch_assoc($resultadoSaldo);
    return $filaSaldo['Saldo_total'];
  } else {
    return null;
  }
}

// Validar si el remitente tiene suficiente saldo antes de realizar la operación
$saldo_remitente = getSaldoRemitente($conn, $id_user);
echo $saldo_remitente;
if ($cantidad >= 0 || ($cantidad < 0 && abs($cantidad) <= $saldo_remitente)) {
  // Retirar la cantidad del remitente y actualizar el saldo del destinatario
  insertOperation($conn, $id_user, $id_destinatario, $motivo, $cantidad, $fecha);
  header("Location: ../user_view.php");
} else {
  echo "Error: No hay saldo suficiente para realizar la operación.";
  header("Location: ../user_view.php");
}
