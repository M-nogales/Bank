<?php
include("../../php/conex.php");

$prestamos ="SELECT * from Prestamos ";
$result_prestamos = mysqli_query($conn, $prestamos) or die("Has hecho una mala consulta a la bbdd");

if (mysqli_num_rows($result_prestamos) > 0) {
  echo "<table>";
  echo "<tr>";
  // Mostrar encabezados de las columnas
  while ($field_info = mysqli_fetch_field($result_prestamos)) {
      echo "<th>{$field_info->name}</th>";
  }
  echo "</tr>";

  // Mostrar datos de la tabla
  while ($row = mysqli_fetch_assoc($result_prestamos)) {
      echo "<tr>";
      foreach ($row as $value) {
          echo "<td>{$value}</td>";
      }
      echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No se encontraron resultados para la consulta de Prestamos.";
}