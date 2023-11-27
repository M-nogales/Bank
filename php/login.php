<?php
session_start();

$_SESSION["usuario"]=$_POST["usuario"];
$nombre=$_SESSION["usuario"];
$_SESSION["clave"]=$_POST["clave"];
$clave=$_SESSION["clave"];
$_SESSION["acceso"]=false;

$consult8 ="Select * from Users where nombre ='$nombre' AND clave ='$clave'";

if(mysqli_num_rows($result8)>0){
  $_SESSION["acceso"]=true;
  header("Location: bienvenida.html");
}else{
  $_SESSION["acceso"]=false;
  header("Location: inicio_sesion.html");
};