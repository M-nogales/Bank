<?php
function getAllUsers($conn) {
  $query = "SELECT * FROM Users";
  $resultado = mysqli_query($conn, $query);
  return $resultado;
}
function getAllLoans($conn) {
  $query = "SELECT U.DNI, U.Email, P.*  FROM Prestamos P
            LEFT JOIN Users U ON P.User_ID = U.ID";
  
  $resultado = mysqli_query($conn, $query);
  return $resultado;
}