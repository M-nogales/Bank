<?php
include_once('conex.php');
// modificar ddbb, operaciones idem enviar, relación-tabla reflexiva
function send_msg($conn,$id_user,$id_destino,$fechaEnvio,$contenido){
  // Insertar mensaje en la tabla Enviar
  $insertEnviar = "INSERT INTO Enviar (Contenido, FechaEnvio, RemitenteID, DestinatarioID) 
                   VALUES ('$contenido', '$fechaEnvio', $id_user, $id_destino)";

  mysqli_query($conn, $insertEnviar) or die("Error al insertar mensaje en la base de datos");
  echo "Mensaje enviado con éxito.";
}
//!$id_user coger de funcion - resto de Post
$id_user=1;
$id_destino=2;
$fechaEnvio=date("Y-m-d H:i:s");
$contenido="que dise niño";
send_msg($conn,$id_user,$id_destino,$fechaEnvio,$contenido);
