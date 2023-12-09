<?php
function getTransigir($conn, $userID) {
  $consult = "SELECT * FROM Transigir WHERE Remitente_ID = $userID OR Destinatario_ID = $userID";
  $resultado = mysqli_query($conn, $consult);
  return $resultado;
}
function getNombreUser($conn, $userID) {
  $consult = "SELECT Nombre FROM Users WHERE ID = $userID";
  $resultado = mysqli_query($conn, $consult);
  
  if ($resultado && mysqli_num_rows($resultado) > 0) {
      $row = mysqli_fetch_assoc($resultado);
      return $row['Nombre'];
  }

  return 'Usuario Desconocido';
}