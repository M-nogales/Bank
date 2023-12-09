<?php
function applyForLoan($conn, $idUsuario, $cantidadSolicitada, $mensualidad, $motivo) {
    // Meter nuevo préstamos en la tabla Prestamos
    $insertPrestamos = "INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Mensualidad, Motivo, Aceptada) 
                        VALUES ($idUsuario, $cantidadSolicitada, $mensualidad,'$motivo', null)";
                        echo $insertPrestamos;
    mysqli_query($conn, $insertPrestamos) or die("Error al insertar préstamo en la base de datos");

    // Obtener el ID del préstamo recién insertado
    $idPrestamo = mysqli_insert_id($conn);

    // Crear en la tabla solicitud la relación
    $insertarSolicitud = "INSERT INTO Solicitar (Usuario_ID, Prestamo_ID) 
                          VALUES ('$idUsuario', '$idPrestamo')";
    mysqli_query($conn, $insertarSolicitud) or die("Error al insertar solicitud en la base de datos");

    echo "Solicitud de préstamo realizada con éxito.";
}