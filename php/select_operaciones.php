<?php
function getTransigir($conn, $userID)
{
  $consult = "SELECT * FROM Transigir WHERE Remitente_ID = $userID OR Destinatario_ID = $userID ORDER BY Fecha_operacion DESC
  LIMIT 10";
  $resultado = mysqli_query($conn, $consult);
  return $resultado;
}
function getNombreUser($conn, $userID)
{
  $consult = "SELECT Nombre FROM Users WHERE ID = $userID";
  $resultado = mysqli_query($conn, $consult);

  if (mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
    return $row['Nombre'];
  }

  return 'Usuario Desconocido';
}
function getSaldoUser($conn, $userID)
{
  $consultaSaldo = "SELECT Saldo_total FROM Users WHERE ID = $userID";
  $resultadoSaldo = mysqli_query($conn, $consultaSaldo);

  if (mysqli_num_rows($resultadoSaldo) > 0) {
    $rowSaldo = mysqli_fetch_assoc($resultadoSaldo);
    return $rowSaldo['Saldo_total'];
  }

  return 0; // Retorna 0 si el usuario no existe o no tiene saldo registrado
}
