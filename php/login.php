<?php

session_start();
//guardamos en sesiones el nombre y clave del usuario
$_SESSION["usuario"]=$_POST["usuario"];
$nombre=$_SESSION["usuario"];
$_SESSION["clave"]=$_POST["clave"];
$clave=$_SESSION["clave"];
$_SESSION["acceso"]=false;

$nombre=$_SESSION["usuario"];
$clave=$_SESSION["clave"];

//con esas sesiones buscamos si hay algun usuario con ese nombre o clave
$admin = "Select * from admins where nombre ='$nombre' AND clave ='$clave'";
$result_admin = mysqli_query($conn, $admin) or die("Has hecho una mala consulta a la bbdd");

$usuario ="SELECT * from Users where clave='$clave'";

$result_user = mysqli_query($conn, $usuario) or die("Has hecho una mala consulta a la bbdd");

//si existe 1 admin con ese nombre le lleva a la vista de admins,si no comprueba users y si no da error
if(mysqli_num_rows($result_admin)>0){
  $_SESSION["acceso"]=true;
  echo "admin detectado";
  // header("Location: admin_view.html");
}elseif(mysqli_num_rows($result_user)>0){
  $_SESSION["acceso"]=true;
  echo "user detectado";
  // header("Location: bienvenida.html");
}else{
  $_SESSION["acceso"]=false;
  echo "no registrado";
  // header("Location: login.html");
}
