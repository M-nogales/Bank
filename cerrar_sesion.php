<?php
session_start();
session_destroy(); // Cierra todas las sesiones

header("Location: inicio_sesion.html");
exit();