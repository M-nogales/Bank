<?php
function getLoanUsers($conn, $userID) {
    $query = "SELECT * FROM Prestamos WHERE User_ID = $userID";
    $resultado = mysqli_query($conn, $query);
    return $resultado;
}
function payLoan($conn, $userId, $loanId) {
    // Obtener información del préstamo
    $query = "SELECT * FROM Prestamos WHERE ID = $loanId AND User_ID = $userId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $loan = mysqli_fetch_assoc($result);
        $cuota = $loan['Cuota'];
        $deudaActual = $loan['Deuda'];

        // Realizar el pago
        if ($deudaActual > 0) {
            // resta cant actual a la deuda sin ser nunca neg
            $nuevaDeuda = max(0, $deudaActual - $cuota);

            // Actualizar la deuda del préstamo
            $updateQuery = "UPDATE Prestamos SET Deuda = $nuevaDeuda WHERE ID = $loanId";
            mysqli_query($conn, $updateQuery);
        }
    }

    // Obtener el saldo actual del usuario
    $saldoQuery = "SELECT Saldo_total FROM Users WHERE ID = $userId";
    $saldoResult = mysqli_query($conn, $saldoQuery);
    
    if ($saldoResult && mysqli_num_rows($saldoResult) > 0) {
        $saldoActual = mysqli_fetch_assoc($saldoResult)['Saldo_total'];

        // Actualizar el saldo del usuario
        $nuevoSaldo = $saldoActual - $cuota;
        $updateSaldoQuery = "UPDATE Users SET Saldo_total = $nuevoSaldo WHERE ID = $userId";
        mysqli_query($conn, $updateSaldoQuery);
    }
}
