<?php
include_once('conex.php');
include_once('prestamos_validation.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $cantidad = $_POST["cantidad"];
    $cuota = $_POST["cuota"];
    $motivo = $_POST["motivo"];
    $userId=$_SESSION["id"];
    // Validación 1: No tener un préstamo pendiente de aprobar/rechazar por parte del administrador
    $checkLoan = checkLoan($conn, $userId);

    // Validación 2: Ser mayor de edad (18 años o más)
    $fechaNacimiento = $_SESSION['Fecha_Nacimiento'];
    // $fechaNacimiento = "2015-02-01";
    $checkEdad = checkEdad($fechaNacimiento);

    // Validación 3: Tener al menos el 15% de la cantidad que se quiere pedir en el saldo de la cuenta
    $saldoTotal = $_SESSION["Saldo_total"];
    $porcentajeRequerido = 15;
    $montoRequerido = ($porcentajeRequerido / 100) * $cantidad;
    // $montoRequerido.= + 3000;
    echo $montoRequerido."monto";
    if (!$checkLoan && $checkEdad && $saldoTotal >= $montoRequerido) {
        // solicitud de préstamo
        applyForLoan($conn, $userId, $cantidad, $cuota, $motivo);
        header("Location: ../prestamos.php");
        exit;
    } else {
        // redirigimos al la pag en caso de que no se cumplan las validaciones
        echo "No se puede procesar la solicitud de préstamo debido a restricciones de validación.";
        header("Location: ../prestamos.php");
        exit;
    }
}
function applyForLoan($conn, $idUsuario, $cantidadSolicitada, $cuota, $motivo)
{
    $fechaCreacion = date("Y-m-d H:i:s");
    // Insertarmos un nuevo préstamo en la tabla Prestamos
    // valores null los pone el admin
    $insertPrestamo = "INSERT INTO Prestamos (User_ID, Cantidada_solicitada, Cuota, Motivo, Aceptada, Deuda, Vencimiento, fecha_de_creacion) 
                       VALUES ('$idUsuario', '$cantidadSolicitada', '$cuota', '$motivo', null, '$cantidadSolicitada', null, '$fechaCreacion')";

    mysqli_query($conn, $insertPrestamo) or die("Error al insertar préstamo en la base de datos");

    // Obtenemos el ID del préstamo recién insertado
    $idPrestamo = mysqli_insert_id($conn);

    $insertarSolicitud = "INSERT INTO Solicitar (Usuario_ID, Prestamo_ID) 
                          VALUES ('$idUsuario', '$idPrestamo')";
    mysqli_query($conn, $insertarSolicitud) or die("Error al insertar solicitud en la base de datos");

    echo "Solicitud de préstamo realizada con éxito.";
}
