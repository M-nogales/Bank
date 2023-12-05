<?php
function getIdUsersWithKey($conn, $clave) {
  $consulta = "SELECT ID FROM Users WHERE Clave = '$clave'";
  $resultado = mysqli_query($conn, $consulta) or die("Error en la consulta a la base de datos");

  if (mysqli_num_rows($resultado) > 0) {
      $fila = mysqli_fetch_assoc($resultado);
      $idUsuario = $fila['ID'];
      return $idUsuario;
  } else {
     echo "no resultado ddbb id where clave";
      return null;
  }
}
$clave=123;
$idUser = getIdUsersWithKey($conn, $clave);