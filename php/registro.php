<?php
// Recupera los datos de la dirección
$provincia = $_POST["provincia"];
$cod_postal = $_POST["cod_postal"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];

// Recupera los datos personales
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$email = $_POST["email"];
$pais_nacimiento = $_POST["pais_nacimiento"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];

// Manejo de la foto
$foto_nombre = $_FILES["foto"]["name"];
$foto_temp = $_FILES["foto"]["tmp_name"];
$ruta_foto = "carpeta_destino/" . $foto_nombre;
move_uploaded_file($foto_temp, $ruta_foto);

// Otros datos
$saldo = $_POST["saldo"];


// Inserta la dirección
$sql_insert_direccion = "INSERT INTO Direcciones (Provincia, Cod_Postal, Ciudad, Direccion) VALUES ('$provincia', '$cod_postal', '$ciudad', '$direccion')";

// Inserta los datos del usuario
$sql_insert_usuario = "INSERT INTO Users (Nombre, Apellidos, DNI, Email, Pais, Fecha_Nacimiento, Foto, Saldo, Direccion_ID) VALUES ('$nombre', '$apellidos', '$dni', '$email', '$pais_nacimiento', '$fecha_nacimiento', '$ruta_foto', $saldo, $direccion_id)";

/*IBAN (obligatorio, único, autogenerado. Se calcula pasando a binario la posición 
en el alfabeto de cada una de las primeras cuatro letras del nombre del usuario y concatenándolas.
 En caso de tener menos de 4 letras el nombre se añadirán “z”s hasta llegar a las 4 requeridas.
  En caso existir uno ya en base de datos se añadirá “1”s o “0”s a hasta que sea único)*/