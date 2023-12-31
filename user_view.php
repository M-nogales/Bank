<?php
include_once('php/conex.php');
// getTransigir($conn, $userID)
// getNombreUser($conn, $userID)
// getSaldoUser($conn, $userID)
include_once('php/select_operaciones.php');
session_start();
//! ruta img perfil, en todos
$urlperfil = "php/".$_SESSION['Foto'];
// if ($_SESSION["accesoUser"] !== true) {
//   // Redirigir a inicio_sesion.html si no tiene acceso
//   header("Location: inicio_sesion.html");
//   exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="icon" type="image/png" sizes="32x32" href="resources/imgs/Logo.png">

  <script defer src="js/bootstrap.bundle.js"></script>
  <script defer src="js/localStorage.js"></script> 
  <title>Welcome</title>
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
        <h1 class="font-roboto-h1">Clear Bank</h1>
      </a>
      <ul class="top-ul">
        <li class="li-pc"><a href="user_view.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
              <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
            </svg>
            <p>Inicio</p>
          </a></li>
        <li class="li-pc"><a href="operaciones.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5" />
            </svg>
            <p>Operaciones</p>
          </a></li>
        <li class="li-pc"><a href="Mensajes.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
            </svg>
            <p>Mensajes</p>
          </a></li>
        <li class="li-pc li-pc-extra"><a href="prestamos.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
              <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
            </svg>
            <p>Prestamos</p>
          </a></li>
          <!-- funciona sin round circle -->
        <li class="top-li"><a class="top-a" href="ajustes.php"><img src="<?php echo $urlperfil; ?>" alt="foto de perfil" class="rounded-circle">
          </a></li>
        <li class="top-li"><a class="top-a" href="ajustes.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
            </svg></a></li>
        <li class="top-li"><a class="top-a" href="cerrar_sesion.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
            </svg></a></li>
      </ul>
    </nav>
  </header>
  <!-- bottom navbar-->
  <nav>
    <ul>
      <li><a href="user_view.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
          </svg>
          <p>Inicio</p>
        </a></li>
      <li><a href="operaciones.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5" />
          </svg>
          <p>Operaciones</p>
        </a></li>
      <li><a href="Mensajes.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
          </svg>
          <p>Mensajes</p>
        </a></li>
      <li><a href="prestamos.php"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
            <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
          </svg>
          <p>Prestamos</p>
        </a></li>

    </ul>
  </nav>
  <main>
    <section class="welcome_banner">
      <img src="resources/imgs/Clear_Bank_more_resoluc.png" alt="banner clear bank">
    </section>
    <section class="welcome_text">
<?php
$nombre = strtoupper($_SESSION["usuario"]);

// Mapeo de días de la semana en inglés a español
$diasSemana = array(
    'Monday'    => 'Lunes',
    'Tuesday'   => 'Martes',
    'Wednesday' => 'Miércoles',
    'Thursday'  => 'Jueves',
    'Friday'    => 'Viernes',
    'Saturday'  => 'Sábado',
    'Sunday'    => 'Domingo'
);

$diaSemana = date("l");
$diaSemanaEsp = $diasSemana[$diaSemana];
$fecha = date("d/m/Y");

echo "<h2>Hola $nombre, hoy es $diaSemanaEsp $fecha </h2>"; ?>
    </section>
    <section class="saldo">
      <h2 id="saldoTotal"><?php
          $_SESSION["Saldo_total"] = getSaldoUser($conn, $_SESSION["id"]);
          echo $_SESSION["Saldo_total"];
          ?></h2>
      <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
        <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
      </svg>
      <div class="select_moneda">
        <label for="moneda" class="form-label label-text">Divisa</label>
        <select id="moneda" name="moneda" class="form_select" onchange="cambiarMoneda()">
          <option selected>Euros</option>
          <option>Dólares</option>
          <option>Libras</option>
          <option>Yenes</option>
          <option>Rublos</option>
        </select>
      </div>
    </section>
    <section class="operaciones">
      <?php

      $resultado = getTransigir($conn, $_SESSION["id"]);

      // Verifica si hay resultados
      if (mysqli_num_rows($resultado) > 0) {
        // Recorre los resultados y genera el código HTML
        while ($row = mysqli_fetch_assoc($resultado)) {
          $nombreUser = getNombreUser($conn, $row['Destinatario_ID']);
          $idUser = $row['Destinatario_ID'];
          $cantidad = $row['Cantidad'];
          $date = $row['Fecha_operacion'];

          // Genera el código HTML
          echo '<div class="card position-static">';
          echo '  <div class="benef_cant">';
          echo '    <p class="card_beneficiario">' . $nombreUser . '</p>';
          echo '    <p class="card_cant">' . $cantidad ."€". '</p>';
          echo '  </div>';
          echo '  <p class="card_date">' . $date . '</p>';
          echo '</div>';
        }
      } else {
        // Mensaje si no hay transacciones
        echo '<p>No hay transacciones para este usuario.</p>';
      }
      ?>
    </section>
    <section class="video">
      <h2>Importancia de la transparencia</h2>
      <!-- lo intenté con un video pero github tiene un limite de 50mb para los videos -->
      <iframe  src="https://www.youtube.com/embed/cz2cS0ltl1c?start=55" frameborder="0" allowfullscreen></iframe>
    </section>
    <section class="section_card">
    <h2>Tu Tarjeta personal</h2>
    <div class="credit_card">
      <div class="card_logo">
        <svg class="logo_svg" fill="url(#grad)" viewBox="0 0 32 32" version="1.1"
          xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="grad" x1="0%" y1="100%" x2="100%" y2="0%">
              <stop offset="0%" style="stop-color:#3457C8" />
              <stop offset="100%" style="stop-color:#5AC75E" />
            </linearGradient>
          </defs>
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path
              d="M31.835 9.233l-4.371-8.358c-0.255-0.487-0.915-0.886-1.464-0.886h-10.060c-0.011-0.001-0.022-0.003-0.033-0.004-0.009 0-0.018 0.003-0.027 0.004h-9.88c-0.55 0-1.211 0.398-1.47 0.883l-4.359 8.197c-0.259 0.486-0.207 1.248 0.113 1.696l15.001 20.911c0.161 0.224 0.375 0.338 0.588 0.338 0.212 0 0.424-0.11 0.587-0.331l15.247-20.758c0.325-0.444 0.383-1.204 0.128-1.691zM29.449 8.988h-5.358l2.146-6.144zM17.979 1.99h6.436l-1.997 5.716zM20.882 8.988h-9.301l4.396-6.316zM9.809 8.034l-2.006-6.044h6.213zM21.273 10.988l-5.376 15.392-5.108-15.392h10.484zM13.654 25.971l-10.748-14.983h5.776zM23.392 10.988h5.787l-11.030 15.018zM5.89 2.575l2.128 6.413h-5.539z"
              style="fill: url(#grad)"></path>
          </g>
        </svg>
        <h2>ClearBank</h2>
      </div>
      <div class="card_chip">
        <img class="chip" src="resources/imgs/chip.png" alt="chip tarjeta de credito">
        <svg class="card_wifi" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
          <path d="M13.229 8.271c.216-.216.194-.578-.063-.745A9.456 9.456 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.577 1.336c.205.132.48.108.652-.065m-2.183 2.183c.226-.226.185-.605-.1-.75A6.473 6.473 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.408.19.611.09A5.478 5.478 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.611-.091l.015-.015zM9.06 12.44c.196-.196.198-.52-.04-.66A1.99 1.99 0 0 0 8 11.5a1.99 1.99 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .708 0l.707-.707z"/>
        </svg>
      </div>
      <div class="card_num">
      <!-- 1234 1234 1234 1234 -->
        <p><?php echo $_SESSION["IBAN"]; ?></p>
      </div>
      <div class="card_cvv">
        <p>Válido hasta: 07/08</p>
        <p>033</p>
      </div>
      <div class="card_nom">
        <p><?php echo $_SESSION["usuario"]." ".$_SESSION["Apellidos"]; ?></p>
      </div>
    </div>
  </section>
  </main>
</body>

</html>