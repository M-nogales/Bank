<?php

include_once ('conex.php');

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
$idUser = getIdUsersWithKey($conn, $clave);

// Inserta la dirección
$sql_insert_direccion = "INSERT INTO Direcciones (Provincia, Cod_Postal, Ciudad, Direccion) VALUES ('$provincia', '$cod_postal', '$ciudad', '$direccion')";


function applyForLoan($conn, $idUsuario, $cantidadSolicitada, $mensualidad, $motivo) {
    // Meter nuevo préstamos en la tabla Prestamos
    $insertPrestamos = "INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Mensualidad, Motivo, Aceptada) 
                        VALUES ('$idUsuario', '$cantidadSolicitada', '$mensualidad', '$motivo', null)";
    mysqli_query($conn, $insertPrestamos) or die("Error al insertar préstamo en la base de datos");

    // Obtener el ID del préstamo recién insertado
    $idPrestamo = mysqli_insert_id($conn);

    // Crear en la tabla solicitud la relación
    $insertarSolicitud = "INSERT INTO Solicitar (Usuario_ID, Prestamo_ID) 
                          VALUES ('$idUsuario', '$idPrestamo')";
    mysqli_query($conn, $insertarSolicitud) or die("Error al insertar solicitud en la base de datos");

    echo "Solicitud de préstamo realizada con éxito.";
}

// debugging poner getter y setters
$idUsuario = 1;
$cantidadSolicitada = 1000.00;
$mensualidad = 150.00;
$motivo = "Gastos médicos";

//!sin conectar con func anterior
applyForLoan($con, $idUsuario, $cantidadSolicitada, $mensualidad, $motivo);


