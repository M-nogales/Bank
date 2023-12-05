<?php
include_once('conex.php');
// modificar ddbb, operaciones idem enviar, relación-tabla reflexiva
function insertOperation($conn, $id_remitente, $id_destinatario, $motivo, $cantidad, $tipo,$fecha){
  // Insertar operación en la tabla Transigir
  $insertTransigir = "INSERT INTO Transigir (Remitente_ID, Destinatario_ID, Motivo, Cantidad, Tipo, Fecha_operacion) 
      VALUES ($id_remitente, $id_destinatario, '$motivo', $cantidad, '$tipo', '$fecha')";

  mysqli_query($conn, $insertTransigir) or die("Error al insertar operación en la base de datos");

  echo "Operación registrada con éxito.";
}
$id_user=1;
$id_destinatario =2;
$motivo="testsetstsetse123123";
$cantidad="102.3";
$tipo="Bizum";
$fecha=date("Y-m-d H:i:s");
//$id_user de func en prestamo - conn de conex ddbb - resto post
insertOperation($conn, $id_user, $id_destinatario, $motivo, $cantidad, $tipo,$fecha);
