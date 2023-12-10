<?php
// modificar ddbb, operaciones idem enviar, relación-tabla reflexiva
function send_msg($conn,$id_user,$id_destino,$fechaEnvio,$contenido){
  // Insertar mensaje en la tabla Enviar
  $insertEnviar = "INSERT INTO Enviar (Contenido, FechaEnvio, RemitenteID, DestinatarioID) 
                   VALUES ('$contenido', '$fechaEnvio', $id_user, $id_destino)";

  mysqli_query($conn, $insertEnviar) or die("Error al insertar mensaje en la base de datos");
  echo "Mensaje enviado con éxito.";
}

function getMensajesUsers($conn, $remitenteID, $destinatarioID) {
  $consultaMensajes = "SELECT Contenido, FechaEnvio, Leido FROM Enviar 
  WHERE (RemitenteID = $remitenteID AND DestinatarioID = $destinatarioID) 
  OR (RemitenteID = $destinatarioID AND DestinatarioID = $remitenteID) ORDER BY FechaEnvio";
  $resultadoMensajes = mysqli_query($conn, $consultaMensajes);

  if ($resultadoMensajes) {
    while ($rowMensaje = mysqli_fetch_assoc($resultadoMensajes)) {
      $mensajes[] = array(
        'contenido' => $rowMensaje['Contenido'],
        'fechaEnvio' => $rowMensaje['FechaEnvio'],
        'leido' => $rowMensaje['Leido']
      );
    }
  }

  return $mensajes;
}

function getUsersExcept($conn, $excluirID) {
  $consultaUsuarios = "SELECT ID, Nombre FROM Users WHERE ID != $excluirID";
  $resultadoUsuarios = mysqli_query($conn, $consultaUsuarios);
  
  if ($resultadoUsuarios) {
    while ($rowUsuario = mysqli_fetch_assoc($resultadoUsuarios)) {
      $usuarios[] = array(
        'id' => $rowUsuario['ID'],
        'nombre' => $rowUsuario['Nombre']
      );
    }
  }

  return $usuarios;
}