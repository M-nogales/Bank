<?php
include("../php/conex.php");
$nombre=$_SESSION["usuario"];
$clave=$_SESSION["clave"];


$admin = "Select * from admins where nombre ='$nombre' AND clave ='$clave'";
$result_admin = mysqli_query($conn, $admin) or die("Has hecho una mala consulta a la bbdd");

$usuario ="SELECT * from Users where clave='$clave'";

$result_user = mysqli_query($conn, $usuario) or die("Has hecho una mala consulta a la bbdd");




//admins
if (mysqli_num_rows($result_admin) > 0) {
  echo "<table>";
  echo "<tr>";
  // Mostrar encabezados de las columnas
  while ($field_info = mysqli_fetch_field($result_admin)) {
      echo "<th>{$field_info->name}</th>";
  }
  echo "</tr>";

  // Mostrar datos de la tabla
  while ($row = mysqli_fetch_assoc($result_admin)) {
      echo "<tr>";
      foreach ($row as $value) {
          echo "<td>{$value}</td>";
      }
      echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No se encontraron resultados para la consulta de Admins.";
}
//users
if (mysqli_num_rows($result_user) > 0) {
  echo "<table>";
  echo "<tr>";
  // Mostrar encabezados de las columnas
  while ($field_info = mysqli_fetch_field($result_user)) {
      echo "<th>{$field_info->name}</th>";
  }
  echo "</tr>";

  // Mostrar datos de la tabla
  while ($row = mysqli_fetch_assoc($result_user)) {
      echo "<tr>";
      foreach ($row as $value) {
          echo "<td>{$value}</td>";
      }
      echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No se encontraron resultados para la consulta de Usuarios.";
}