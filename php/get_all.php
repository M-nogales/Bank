<?php
function getUserData($conn, $clave) {
  $idUsuario = getIdUsersWithKey($conn, $clave);

  if ($idUsuario !== null) {
      $consulta = "SELECT * FROM Users WHERE ID = '$idUsuario'";
      $resultado = mysqli_query($conn, $consulta) or die("Error en la consulta a la base de datos");

      if (mysqli_num_rows($resultado) > 0) {
          $datosUsuario = mysqli_fetch_assoc($resultado);
          return $datosUsuario;
      } else {
          echo "No se encontraron datos del usuario en la base de datos";
          return null;
      }
  } else {
      echo "ID de usuario no válido";
      return null;
  }
}