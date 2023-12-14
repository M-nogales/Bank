<?php
include_once('php/conex.php');
//getAllUsers($conn);
//getAllLoans($conn);
include_once('php/admin.php');
session_start();

// if ($_SESSION["accesoAdmin"] !== true) {
//     // Redirigir a inicio_sesion.html si no tiene acceso
//     header("Location: inicio_sesion.html");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista administrador</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script defer src="js/bootstrap.bundle.js"></script>
</head>

<body>
<header>
    <nav class="top-nav">
      <a class="logo" href="user_view.php"><svg fill="url(#grad)" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="grad" x1="0%" y1="100%" x2="100%" y2="0%">
              <stop offset="0%" style="stop-color:#3457C8" />
              <stop offset="100%" style="stop-color:#5AC75E" />
            </linearGradient>
          </defs>
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path d="M31.835 9.233l-4.371-8.358c-0.255-0.487-0.915-0.886-1.464-0.886h-10.060c-0.011-0.001-0.022-0.003-0.033-0.004-0.009 0-0.018 0.003-0.027 0.004h-9.88c-0.55 0-1.211 0.398-1.47 0.883l-4.359 8.197c-0.259 0.486-0.207 1.248 0.113 1.696l15.001 20.911c0.161 0.224 0.375 0.338 0.588 0.338 0.212 0 0.424-0.11 0.587-0.331l15.247-20.758c0.325-0.444 0.383-1.204 0.128-1.691zM29.449 8.988h-5.358l2.146-6.144zM17.979 1.99h6.436l-1.997 5.716zM20.882 8.988h-9.301l4.396-6.316zM9.809 8.034l-2.006-6.044h6.213zM21.273 10.988l-5.376 15.392-5.108-15.392h10.484zM13.654 25.971l-10.748-14.983h5.776zM23.392 10.988h5.787l-11.030 15.018zM5.89 2.575l2.128 6.413h-5.539z" style="fill: url(#grad)"></path>
          </g>
        </svg>
        <h1>Clear Bank</h1>
      </a>
      <ul class="top-ul">
          <!-- funciona sin round circle -->
        <li class="top-li"><a class="top-a" href=""><img src="php/FotosPerfil/Admin.jpg" alt="foto de perfil" class="rounded-circle">
          </a></li>
        <li class="top-li"><a class="top-a" href="cerrar_sesion.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
            </svg></a></li>
      </ul>
    </nav>
  </header>
  <!-- bottom navbar-->

  <div class="table-responsive">
    <?php
    $resultado1 = getAllUsers($conn);

    $resultado_allusers = "<table class=\"table table-bordered table-hover Main-table-border mb-0\">";
    $resultado_allusers .= "<thead><tr>";

    while ($columna = mysqli_fetch_field($resultado1)) {
      $resultado_allusers .= "<th scope=" . "col" . ">{$columna->name}</th>";
    }
    $resultado_allusers .= "</tr></thead><tbody>";

    while ($fila = mysqli_fetch_assoc($resultado1)) {
      $resultado_allusers .= "<tr>";
      foreach ($fila as $value) {
        $resultado_allusers .= "<td scope=" . "row" . ">$value</td>";
      }
      $resultado_allusers .= "</tr>";
    }
    $resultado_allusers .= "</tbody></table>";

    echo $resultado_allusers;
    ?>
  </div>
  <div class="table-responsive">
    <?php
    $resultado1  = getAllLoans($conn);

    echo "<form method='post' action='php/actualizar_datos.php'>"; // Formulario para actualizar datos

    echo "<table class=\"table table-bordered table-hover Main-table-border mt-5\">";
    echo "<thead><tr>";
    
    // Obtenemos los nombres de las columnas
    while ($columna = mysqli_fetch_field($resultado1)) {
      echo "<th scope="."col".">{$columna->name}</th>";
    }
    echo "<th scope='col'>Actualizar</th>";
    echo "</tr></thead><tbody>";
    
    while ($fila = mysqli_fetch_assoc($resultado1)) {
      echo "<tr>";
      foreach ($fila as $key => $value) {
        // si existe una columna de vencimiento con un valor null inserta un input
        // de nombre columna_ID de la fila
        if ($key == "Vencimiento" && $value === null) {
          echo "<td><input type='date' name='Vencimiento_{$fila["ID"]}' value=''></td>";
          // en caso de que no se cumpla verifica aceptada, igual que antes
        } elseif ($key == "Aceptada" && $value === null) {
          echo "<td>";
          echo "<label><input type='radio' name='aceptada_{$fila["ID"]}' value='1'> Aceptar</label><br>";
          echo "<label><input type='radio' name='aceptada_{$fila["ID"]}' value='0'> Rechazar</label>";
          echo "</td>";
        } else {
          echo "<td>$value</td>";
        }
      }
      //finalmente se crea el boton con EL VALOR DEL ID
      echo "<td><button type='submit' name='actualizar' value='{$fila["ID"]}'>Actualizar</button></td>";
      echo "</tr>";
    }
    
    echo "</tbody></table>";
    echo "</form>";

    ?>
  </div>
</body>

</html>