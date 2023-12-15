<?php
function checkLoan($conn, $userId) {
    $query = "SELECT COUNT(*) as count FROM Prestamos WHERE User_ID = $userId AND Aceptada IS NULL";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

// Función para verificar si el usuario es mayor de edad
function checkEdad($fechaNacimiento) {
    // Obtener la fecha actual en formato timestamp
    $fechaActual = time();

    // Convertir la fecha de nacimiento a formato timestamp
    $fechaNacimientoTimestamp = strtotime($fechaNacimiento);

    // Calcular la diferencia en segundos entre la fecha actual y la fecha de nacimiento
    $diferenciaSegundos = $fechaActual - $fechaNacimientoTimestamp;

    // Calcular la edad dividiendo la diferencia en segundos por el número de segundos en un año (aproximadamente 31536000 segundos)
    $edad = floor($diferenciaSegundos / 31536000);

    // Comparar la edad con la mayoría de edad (18 años)
    return $edad >= 18;
}

