<?php
include_once('conex.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Obtener los valores del formulario
    $cantidad = $_POST["cantidad"];
    $cuota = $_POST["cuota"];
    $motivo = $_POST["motivo"];
    applyForLoan($conn,$_SESSION["id"],$cantidad,$cuota,$motivo);
}
function applyForLoan($conn, $idUsuario, $cantidadSolicitada, $cuota, $motivo) {
    // Insertar nuevo préstamo en la tabla Prestamos
    $insertPrestamo = "INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Cuota, Motivo, Aceptada, Deuda, Vencimiento) 
                       VALUES ('$idUsuario', '$cantidadSolicitada', '$cuota', '$motivo', null, '$cantidadSolicitada', null)";
    mysqli_query($conn, $insertPrestamo) or die("Error al insertar préstamo en la base de datos");

    // Obtener el ID del préstamo recién insertado
    $idPrestamo = mysqli_insert_id($conn);

    // Insertar en la tabla Solicitud la relación
    $insertarSolicitud = "INSERT INTO Solicitar (Usuario_ID, Prestamo_ID) 
                          VALUES ('$idUsuario', '$idPrestamo')";
    mysqli_query($conn, $insertarSolicitud) or die("Error al insertar solicitud en la base de datos");

    echo "Solicitud de préstamo realizada con éxito.";
}
