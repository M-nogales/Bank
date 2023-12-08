<?php
include_once('conex.php');
// Recupera los datos de la dirección
$provincia = $_POST["provincia"];
$cod_postal = $_POST["CP"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];

// Recupera los datos personales
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$email = $_POST["email"];
$pais_nacimiento = $_POST["pais"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];

$saldo = $_POST["saldo_inicial"];

//! 7 numeros + letra en mayus (no ñ) en posi aleatoria
function createClave() {
  // Generar 7 números aleatorios
  $numeros = '';
  for ($i = 0; $i < 7; $i++) {
      $numeros .= mt_rand(0, 9);
  }

  // Elegir una posición aleatoria para la letra
  $posicionLetra = mt_rand(0, 6);

  $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $letra = $letras[mt_rand(0, strlen($letras) - 1)];

  // Insertar la letra en la posición aleatoria
  $clave = substr_replace($numeros, $letra, $posicionLetra, 0);

  return $clave;
}

// $clave = createClave();
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
$iban = calcIBAN($conn,$nombre);
//?insert de usuario y direcciones
function insertUsersDirecciones($conn, $provincia, $cod_postal, $direccion, $ciudad, $nombre, $apellidos, $dni, $email, $pais_nacimiento, $fecha_nacimiento, $saldo, $iban, $foto)
{
    // Insert data into Direcciones table
    $insertDirecciones = "INSERT INTO Direcciones (Pais, Direccion, Provincia, Cod_Postal, Ciudad)
    VALUES ('$pais_nacimiento', '$direccion','$provincia', '$cod_postal', '$ciudad')";
    mysqli_query($conn, $insertDirecciones);

    // Get the ID of the last inserted row in Direcciones table
    $direccionID = mysqli_insert_id($conn);

    // Insert data into Users table
    $insertUsers = "INSERT INTO Users (Nombre, Apellidos, DNI, Email, IBAN, Foto, Saldo_total, Fecha_Nacimiento, Direcciones_ID)
    VALUES ('$nombre', '$apellidos', '$dni', '$email', '$iban', '$foto', $saldo, '$fecha_nacimiento', $direccionID)";
    mysqli_query($conn, $insertUsers);
}
//?
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $uploadedFile = $_FILES["foto"];
  $file_dir = "FotosPerfil/";

  // Verifica si se subió un archivo
  if (isset($uploadedFile) && $uploadedFile["error"] === UPLOAD_ERR_OK) {
    $fileName = $uploadedFile["name"];
    $fileTmpName = $uploadedFile["tmp_name"];
    // Comprueba que el tipo de archivo sea permitido
    $allowedExtensions = array("jpg", "png", "jpeg");
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if (!file_exists($file_dir)) {
      mkdir($file_dir);
    }
    $destination = $file_dir . $fileName;
    move_uploaded_file($fileTmpName, $destination);
    if (in_array($fileExtension, $allowedExtensions)) {
      // Muestra información del archivo
      echo "Nombre del archivo: $fileName<br>";

      // echo '<img src="' . $destination . '" alt="Imagen subida"">';
    } else {
      echo "El tipo de archivo no es válido. Solo se permiten archivos jpg, png y jpeg.";
      //glob() busca ficheros cuyo nombre sigue un patron empezado por $file_dir,que contengan jpg,png,jpeg y los guarda en un array
      $defaultImages = glob($file_dir . 'default_*.{jpg,png,jpeg}', GLOB_BRACE);
      if (!empty($defaultImages)) {
        // coge un valor aleatorio del array
          $destination = $defaultImages[array_rand($defaultImages)];
      }
      echo '<img src="' . $destination . '" alt="Imagen subida"">';
    }
  } else {
    echo "Error al subir el archivo.";
    $defaultImages = glob($file_dir . 'default_*.{jpg,png,jpeg}', GLOB_BRACE);
    if (!empty($defaultImages)) {
        $destination = $defaultImages[array_rand($defaultImages)];
    }
    echo '<img src="' . $destination . '" alt="Imagen subida"">';

  }
}
//! comentado evitar subir a ddbb
// insertUsersDirecciones($conn, $provincia, $cod_postal, $direccion,
//  $ciudad, $nombre, $apellidos, $dni, $email, $pais_nacimiento, $fecha_nacimiento,
//   $saldo, $iban, $destination);
  //https://www.php.net/manual/es/function.glob.php
