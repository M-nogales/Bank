<?php
include_once('php/conex.php');
//getIdUsersWithKey($conn, $clave)
include_once('php/get_id.php');
//getUserData($conn, $clave)
include_once('php/get_all.php');

session_start();

//guardamos en sesiones el nombre y clave del usuario
$_SESSION["usuario"]=$_POST["usuario"];
$nombre=$_SESSION["usuario"];
$_SESSION["clave"]=$_POST["clave"];
$clave=$_SESSION["clave"];
$_SESSION["accesoAdmin"]=false;
$_SESSION["accesoUser"]=false;

$nombre=$_SESSION["usuario"];
$clave=$_SESSION["clave"];

//con esas sesiones buscamos si hay algun usuario con ese nombre o clave
$admin = "Select * from admins where nombre ='$nombre' AND clave ='$clave'";
$result_admin = mysqli_query($conn, $admin) or die("Has hecho una mala consulta a la bbdd");

$usuario ="SELECT * from Users where clave='$clave'";

$result_user = mysqli_query($conn, $usuario) or die("Has hecho una mala consulta a la bbdd");

//si existe 1 admin con ese nombre le lleva a la vista de admins,si no comprueba users y si no da error
if(mysqli_num_rows($result_admin)>0){
  $_SESSION["accesoAdmin"]=true;
  $_SESSION["id"]=getIdUsersWithKey($conn, $clave);
  
  echo "admin detectado";
  // header("Location: admin_view.html");
}elseif(mysqli_num_rows($result_user)>0){
  $_SESSION["accesoUser"]=true;
  $_SESSION["id"]=getIdUsersWithKey($conn, $clave);
  $datosUser = getUserData($conn, $clave);
  if ($datosUser !== null) {
    // Almacena todos los datos en sesiones individuales
    $_SESSION['Apellidos'] = $datosUser['Apellidos'];
    $_SESSION['DNI'] = $datosUser['DNI'];
    $_SESSION['Email'] = $datosUser['Email'];
    $_SESSION['IBAN'] = $datosUser['IBAN'];
    $_SESSION['Foto'] = $datosUser['Foto'];
    $_SESSION['Saldo_total'] = $datosUser['Saldo_total'];
    $_SESSION['Fecha_Nacimiento'] = $datosUser['Fecha_Nacimiento'];
    $_SESSION['Direcciones_ID'] = $datosUser['Direcciones_ID'];
    echo "Datos del usuario almacenados en sesiones";
} else {
    echo "Error al obtener los datos del usuario";
}
  echo "user detectado";
  // header("Location: bienvenida.html");
}else{
  $_SESSION["accesoUser"]=false;
  $_SESSION["accesoAdmin"]=false;
  echo "no registrado";
  // header("Location: login.html");
}
