<?php
include('../../php/conex.php');

$usuarios ="SELECT * from Users ";
$result_users = mysqli_query($conn, $usuarios) or die("Has hecho una mala consulta a la bbdd");

if (mysqli_num_rows($result_users) > 0) {
  echo "<table>";
  echo "<tr>";
  // Mostrar encabezados de las columnas
  while ($field_info = mysqli_fetch_field($result_users)) {
      echo "<th>{$field_info->name}</th>";
  }
  echo "</tr>";

  // Mostrar datos de la tabla
  while ($row = mysqli_fetch_assoc($result_users)) {
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