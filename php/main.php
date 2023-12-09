<?php
include_once('conex.php');
// modificar ddbb, operaciones idem enviar, relación-tabla reflexiva
function changeSettings($conn, $id_user, $fecha_nacimiento, $foto, $direccion, $codigoPostal, $ciudad, $provincia, $pais)
{
  // Actualizar datos en la tabla Users
  $updateUsers = "UPDATE Users SET Fecha_Nacimiento = '$fecha_nacimiento', Foto = '$foto'WHERE ID = $id_user";

  mysqli_query($conn, $updateUsers) or die("Error al actualizar datos en Users");

  // Obtener el ID de la dirección actual del usuario
  $selectDireccionID = "SELECT Direcciones_ID FROM Users WHERE ID = $id_user";
  $resultDireccionID = mysqli_query($conn, $selectDireccionID) or die("Error al obtener ID de dirección");
  $rowDireccionID = mysqli_fetch_assoc($resultDireccionID);
  $direccionID = $rowDireccionID['Direcciones_ID'];

  // Actualizar datos en la tabla Direcciones
  $updateDirecciones = "UPDATE Direcciones SET Pais = '$pais', Direccion= '$direccion' ,
   Provincia = '$provincia', Cod_Postal = '$codigoPostal', Ciudad = '$ciudad'WHERE ID = $direccionID";

  mysqli_query($conn, $updateDirecciones) or die("Error al actualizar datos en Direcciones");

  echo "Datos actualizados con éxito.";
}
