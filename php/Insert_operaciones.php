<?php
include_once('conex.php');
//getIdUsersWithKey($conn, $clave)
$destinatario = $_POST["Destinatario"];
$motivo = $_POST["motivo"];
$cantidad = $_POST["Cantidad"];

// busca en la base de datos el id con el email introducido
function getIdUsersWithEmail($conn, $email) {
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
function insertOperation($conn, $id_remitente, $id_destinatario, $motivo, $cantidad,  $fecha)
{
  // Insertar operación en la tabla Transigir
  $insertTransigir = "INSERT INTO Transigir (Remitente_ID, Destinatario_ID, Motivo, Cantidad, Fecha_operacion) 
      VALUES ($id_remitente, $id_destinatario, '$motivo', $cantidad, '$fecha')";

  mysqli_query($conn, $insertTransigir) or die("Error al insertar operación en la base de datos");

  echo "Operación registrada con éxito.";
}
$id_user = getIdUsersWithKey($conn, $clave);
$destinatario == $id_user ||$destinatario =="yo" || $destinatario=="me" ? $id_destinatario=$id_user : $id_destinatario=getIdUsersWithEmail($conn,$destinatario);

$fecha = date("Y-m-d H:i:s");
//$id_user de func en prestamo - conn de conex ddbb - resto post
insertOperation($conn, $id_user, $id_destinatario, $motivo, $cantidad, $fecha);
