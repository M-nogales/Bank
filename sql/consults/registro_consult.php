<?php
include("../../php/conex.php");
//datos
$provincia = $_POST["provincia"];
$cod_postal = $_POST["cod_postal"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];

// Recupera los datos personales
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$email = $_POST["email"];
$pais = $_POST["pais_nacimiento"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];

// Manejo de la foto
$foto_nombre = $_FILES["foto"]["name"];
$foto_temp = $_FILES["foto"]["tmp_name"];
$ruta_foto = "carpeta_destino/" . $foto_nombre;
move_uploaded_file($foto_temp, $ruta_foto);

// Otros datos
$saldo_total = $_POST["saldo"];



$registro_user ="INSERT INTO Users (Nombre, Apellidos, 
DNI, Email, Pais, Fecha_Nacimiento, Foto, Saldo_total, Direccion_ID)
 VALUES ('$nombre', '$apellidos', '$dni', '$email',
 '$pais', '$fecha_nacimiento', '$ruta_foto',
  $saldo_total, $direccion_id)";

$result_regist = mysqli_query($conn, $registro_user) or die("Has hecho una mala consulta a la bbdd");

$registro_direcc ="INSERT INTO Direcciones (Provincia, 
Cod_Postal, Ciudad) VALUES ('$provincia', '$cod_postal', '$ciudad')";
$result_regist_direcc = mysqli_query($conn, $registro_direcc) or die("Has hecho una mala consulta a la bbdd");
