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
//! revisar 
  function calcIBAN($conn, $nombre)
{
    //primeras 4 letras del nombre
    $primeras_letras = substr($nombre, 0, 4);

    // str_pad concatena hasta que un strg tenga la length X añadiendo en este caso "z"
    $primeras_letras = str_pad($primeras_letras, 4, "z");

    // Convertir las letras a binario y concatenarlas
    //ord pasas las letras a int entre 0 y 255,decbin de decimal a binario,str_pad igual que antes
    //STR_PAD_LEFT añade los 0 a la izquierda del strg
    $iban = '';
    for ($i = 0; $i < 4; $i++) {
      $iban .= str_pad(decbin(ord($primeras_letras[$i])), 10, "0", STR_PAD_LEFT);
    }

    // Verificar si el IBAN ya existe en la base de datos LIKE '$IBAN%'busca los ibans que empiezen por x...
    $exist_iban = "SELECT IBAN FROM Users WHERE IBAN LIKE '$iban%'";
    $result_iban = mysqli_query($conn, $exist_iban);

    $contador = 0;
    while (mysqli_num_rows($result_iban) > 0) {
      $iban .= ($contador % 2 == 0) ? "0" : "1"; // 1 o 0 según sea par o impar
      $result_iban = mysqli_query($conn, $exist_iban);
      $contador++;
  }

    return $iban;
}

//? awd
// if ($_SERVER["REQUEST_METHOD"] === "POST") {

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $uploadedFile = $_FILES["archivo"];

  // Verifica si se subió un archivo
  if (isset($uploadedFile) && $uploadedFile["error"] === UPLOAD_ERR_OK) {
    $fileName = $uploadedFile["name"];
    $fileTmpName = $uploadedFile["tmp_name"];
    // Comprueba que el tipo de archivo sea permitido
    $allowedExtensions = array("jpg", "png", "jpeg");
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $file_dir = "FotosPerfil/";
    if (!file_exists("FotosPerfil")) {
      mkdir("FotosPerfil");
    }
    $destination = $file_dir . $fileName;
    move_uploaded_file($fileTmpName, $destination);
    if (in_array($fileExtension, $allowedExtensions)) {
      // Muestra información del archivo
      echo "Nombre del archivo: $fileName<br>";

      // Mueve el archivo a la carpeta de imagenes
      echo '<img src="' . $destination . '" alt="Imagen subida"">';
    } else {
      echo "El tipo de archivo no es válido. Solo se permiten archivos jpg, png y jpeg.";
    }
  } else {
    echo "Error al subir el archivo.";
  }
}
