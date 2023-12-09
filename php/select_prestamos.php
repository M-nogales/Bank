<?php
function getLoanUsers($conn, $userID) {
    $query = "SELECT * FROM Prestamos WHERE User_ID = $userID";
    $resultado = mysqli_query($conn, $query);
    return $resultado;
}