<?php 
include_once ('conex.php');
$consult5 = "SELECT * FROM Users";

// $conn procede de conex, es la ruta de la bbdd
$result1 = mysqli_query($conn, $consult1) or die("Has hecho una mala consulta a la bbdd");


// Motrar el resultado de los registro de la base de datos
// Encabezado de la tabla
//! mostrar primera consulta
$resultado_conex1 = "<table class=\"table table-bordered table-striped table-hover Main-table-border mb-0\">";
$resultado_conex1 .= "<tr class='Main-Orange'>";

// nombres de las columnas
while ($columna = mysqli_fetch_field($result1)) {
  $resultado_conex1 .= "<th scope=" . "col" . ">{$columna->name}</th>";
}
if (mysqli_num_rows($result1) > 0) {
  // Bucle while que recorre cada registro y muestra cada campo en la tabla.
  while ($fila = mysqli_fetch_assoc($result1)) {
    $resultado_conex1 .= "<tr>";
    foreach ($fila as $value) {
      $resultado_conex1 .= "<td  scope=" . "row" . ">$value</td>";
    }
    $resultado_conex1 .= "</tr>";
  }
} else {
  // en caso de no encontrar resultados en la consulta dejamos una fila con lo siguiente
  $resultado_conex1 .= "<tr><td colspan='" . mysqli_num_fields($result1) . "'>No se encontraron resultados</td></tr>";
}
$resultado_conex1 .= "</table>";?>