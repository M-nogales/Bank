<?php
function getTransigir($conn, $idUsuario) {
  $consulta = "SELECT * FROM Transigir WHERE Remitente_ID = '$idUsuario' OR Destinatario_ID = '$idUsuario'";
  $resultado = mysqli_query($conn, $consulta) or die("Error en la consulta a la base de datos");

  if (mysqli_num_rows($resultado) > 0) {
      $datosTransigir = mysqli_fetch_assoc($resultado);
      return $datosTransigir;
  } else {
      echo "No se encontraron transacciones para el usuario en la base de datos";
      return null;
  }
}