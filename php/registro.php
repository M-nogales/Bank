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
//? awd
// if ($_SERVER["REQUEST_METHOD"] === "POST") {

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $uploadedFile = $_FILES["archivo"];

  // Verifica si se subió un archivo
  if (isset($uploadedFile) && $uploadedFile["error"] === UPLOAD_ERR_OK) {
    $fileName = $uploadedFile["name"];
    $fileType = $uploadedFile["type"];
    $fileSize = $uploadedFile["size"];
    $fileTmpName = $uploadedFile["tmp_name"];
    // echo $fileTmpName."<br/>";
    // Comprueba que el tipo de archivo sea permitido
    $allowedExtensions = array("jpg", "png", "jpeg");
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $file_dir = "FotosPerfil/";
    if (!file_exists("FotosPerfil")) {
      mkdir("FotosPerfil");
    }
    $destination = $file_dir . $fileName;
    // echo $destination."<br/>";
    move_uploaded_file($fileTmpName, $destination);
    if (in_array($fileExtension, $allowedExtensions)) {
      // Muestra información del archivo
      echo "Nombre del archivo: $fileName<br>";
      echo "Tipo de archivo: $fileType<br>";
      echo "Tamaño del archivo: $fileSize bytes<br>";

      // Mueve el archivo a una ubicación deseada (por ejemplo, al directorio de carga)
      echo '<img src="' . $destination . '" alt="Imagen subida"">';
    } else {
      echo "El tipo de archivo no es válido. Solo se permiten archivos jpg, png y jpeg.";
    }
  } else {
    echo "Error al subir el archivo.";
  }
}
