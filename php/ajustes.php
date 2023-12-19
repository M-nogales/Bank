<?php
include_once('conex.php');
session_start();
function updateNombre($conn, $id_user, $nombre)
{
    $updateNombre = "UPDATE Users SET Nombre = '$nombre' WHERE ID = $id_user";
    mysqli_query($conn, $updateNombre) or die("Error al actualizar el nombre en Users");
    //actualizamos sesiones para que no tengamos que pasar por login para que se actualicen los valores
    $_SESSION["usuario"] = $nombre;
}

function updateApellidos($conn, $id_user, $apellidos)
{
    $updateApellidos = "UPDATE Users SET Apellidos = '$apellidos' WHERE ID = $id_user";
    mysqli_query($conn, $updateApellidos) or die("Error al actualizar los apellidos en Users");
    $_SESSION['Apellidos'] = $apellidos;

}

function updateFechaNacimiento($conn, $id_user, $fecha_nacimiento)
{
    $updateFechaNacimiento = "UPDATE Users SET Fecha_Nacimiento = '$fecha_nacimiento' WHERE ID = $id_user";
    mysqli_query($conn, $updateFechaNacimiento) or die("Error al actualizar la fecha de nacimiento en Users");
    $_SESSION['Fecha_Nacimiento'] = $fecha_nacimiento;

}

function updateDireccion($conn, $id_user, $direccion)
{
    $updateDireccion = "UPDATE Direcciones SET Direccion = '$direccion' WHERE ID = (SELECT Direcciones_ID FROM Users WHERE ID = $id_user)";
    mysqli_query($conn, $updateDireccion) or die("Error al actualizar la dirección en Direcciones");
}

function updateProvincia($conn, $id_user, $provincia)
{
    $updateProvincia = "UPDATE Direcciones SET Provincia = '$provincia' WHERE ID = (SELECT Direcciones_ID FROM Users WHERE ID = $id_user)";
    mysqli_query($conn, $updateProvincia) or die("Error al actualizar la provincia en Direcciones");
}

function updateCiudad($conn, $id_user, $ciudad)
{
    $updateCiudad = "UPDATE Direcciones SET Ciudad = '$ciudad' WHERE ID = (SELECT Direcciones_ID FROM Users WHERE ID = $id_user)";
    mysqli_query($conn, $updateCiudad) or die("Error al actualizar la ciudad en Direcciones");
}

function updatePais($conn, $id_user, $pais)
{
    $updatePais = "UPDATE Direcciones SET Pais = '$pais' WHERE ID = (SELECT Direcciones_ID FROM Users WHERE ID = $id_user)";
    mysqli_query($conn, $updatePais) or die("Error al actualizar el país en Direcciones");
}

function updateCodigoPostal($conn, $id_user, $codigoPostal)
{
    $updateCodigoPostal = "UPDATE Direcciones SET Cod_Postal = '$codigoPostal' WHERE ID = (SELECT Direcciones_ID FROM Users WHERE ID = $id_user)";
    mysqli_query($conn, $updateCodigoPostal) or die("Error al actualizar el código postal en Direcciones");
}

function updateFoto($conn, $id_user, $foto)
{
    //explicado en php/registro.php
    $file_dir = "FotosPerfil/";

    if (!empty($foto["name"])) {
        $fileName = $foto["name"];
        $fileTmpName = $foto["tmp_name"];

        $allowedExtensions = array("jpg", "png", "jpeg");
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!file_exists($file_dir)) {
            mkdir($file_dir);
        }

        $destination = $file_dir . $fileName;

        move_uploaded_file($fileTmpName, $destination);

        if (in_array($fileExtension, $allowedExtensions)) {
            echo "Nombre del archivo: $fileName<br>";
            $updateFoto = "UPDATE Users SET Foto = '$destination' WHERE ID = $id_user";
            mysqli_query($conn, $updateFoto) or die("Error al actualizar foto en Users");
            $_SESSION['Foto'] = $destination;

        } else {
            echo "El tipo de archivo no es válido. Solo se permiten archivos jpg, png y jpeg.";

            echo '<img src="' . $destination . '" alt="Imagen predeterminada">';
        }
    } else {
        echo "No se seleccionó ninguna imagen para subir.";
    }
}
//!sacar de funcion
$nombre = $_POST["usuario"];
$apellidos = $_POST["apellidos"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$direccion = $_POST["direccion"];
$provincia = $_POST["provincia"];
$ciudad = $_POST["ciudad"];
$pais = $_POST["pais"];
$codigoPostal = $_POST["CP"];
$foto = $_FILES["foto"];

$id_user = $_SESSION["id"];
if ($nombre !== "") {
    updateNombre($conn, $id_user, $nombre);
}

if ($apellidos !== "") {
    updateApellidos($conn, $id_user, $apellidos);
}

if ($fecha_nacimiento !== "") {
    updateFechaNacimiento($conn, $id_user, $fecha_nacimiento);
}

if ($direccion !== "") {
    updateDireccion($conn, $id_user, $direccion);
}

if ($provincia !== "") {
    updateProvincia($conn, $id_user, $provincia);
}

if ($ciudad !== "") {
    updateCiudad($conn, $id_user, $ciudad);
}

if ($pais !== "") {
    updatePais($conn, $id_user, $pais);
}

if ($codigoPostal !== "") {
    updateCodigoPostal($conn, $id_user, $codigoPostal);
}

if ($foto !== "") {
    updateFoto($conn, $id_user, $foto);
}

header("Location: ../ajustes.php");
