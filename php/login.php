<?php
session_start();

$_SESSION["usuario"]=$_POST["usuario"];
$nombre=$_SESSION["usuario"];
$_SESSION["clave"]=$_POST["clave"];
$clave=$_SESSION["clave"];
$_SESSION["acceso"]=false;

include("../sql/consults/login_consult.php");

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
