<?php
include_once('php/conex.php');
// send_msg($conn,$id_user,$id_destino,$fechaEnvio,$contenido)
// getMensajesUsers($conn, $remitenteID, $destinatarioID)
// getUsersExcept($conn, $excluirID)
include_once('php/mensajes.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Procesar los datos del formulario
  $mensaje = $_POST["Mensaje"] ?? "";
  $id_destino = $_POST["id"] ?? "";
  $fechaEnvio = date("Y-m-d H:i:s");
  $id_remitente=$_SESSION["id"];
  $mensaje != "" && $id_destino !=""?send_msg($conn, $id_remitente, $id_destino, $fechaEnvio, $mensaje):null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensajes</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <script defer src="js/bootstrap.bundle.js"></script>
  <script defer src="js/manipulacion.js"></script>
</head>

<body>
  <header>
    <nav class="top-nav">
      <a class="logo" href=""><svg fill="url(#grad)" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
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
        <li class="li-pc"><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
              <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
            </svg>
            <p>Inicio</p>
          </a></li>
        <li class="li-pc"><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5" />
            </svg>
            <p>Operaciones</p>
          </a></li>
        <li class="li-pc"><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0
       .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z" />
            </svg>
            <p>Tarjetas</p>
          </a></li>
        <li class="li-pc li-pc-extra"><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
              <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
            </svg>
            <p>Prestamos</p>
          </a></li>
        <li class="top-li"><a class="top-a" href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <circle cx="8" cy="8" r="8" />
            </svg></a></li>
        <li class="top-li"><a class="top-a" href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
            </svg></a></li>
        <li class="top-li"><a class="top-a" href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
              <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
            </svg></a></li>
      </ul>
    </nav>
  </header>
  <!-- bottom navbar-->
  <nav>
    <ul>

      <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
          </svg>
          <p>Inicio</p>
        </a></li>
      <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5" />
          </svg>
          <p>Operaciones</p>
        </a></li>
      <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0
         .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z" />
          </svg>
          <p>Tarjetas</p>
        </a></li>
      <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
            <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
          </svg>
          <p>Prestamos</p>
        </a></li>

    </ul>
  </nav>
  <?php

  $remitenteID = 1;
  $destinatarioID = 2;
  $mensajes = getMensajesUsers($conn, $remitenteID, $destinatarioID);

  foreach ($mensajes as $mensaje) {
    echo "Contenido: " . $mensaje['contenido'] . "<br>";
    echo "Fecha de envío: " . $mensaje['fechaEnvio'] . "<br>";
    echo "Leído: " . ($mensaje['leido'] ? 'Sí' : 'No') . "<br>";
    echo "<hr>";
  }
  $usuarios = getUsersExcept($conn, $_SESSION["id"]);

  // Mostrar la lista de usuarios
  foreach ($usuarios as $usuario) {
    echo 'ID: ' . $usuario['id'] . ', Nombre: ' . $usuario['nombre'] . '<br>';
  }
  ?>
  <section class="msg_section">
    <div class="msg_card">
      <p>Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí</p>
      <div class="msg_date">
        <p>fecha</p>
        <p>Leido</p>
      </div>
    </div>
    <div class="msg_card_me">
      <p>Mensaje en sí</p>
      <div class="msg_date">
        <p>fecha</p>
        <p>Leido</p>
      </div>
    </div>
    <div class="msg_card">
      <p>Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí</p>
      <div class="msg_date">
        <p>fecha</p>
        <p>Leido</p>
      </div>
    </div>
    <div class="msg_card">
      <p>Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí Mensaje en sí</p>
      <div class="msg_date">
        <p>fecha</p>
        <p>Leido</p>
      </div>
    </div>

  </section>
  <!-- col se fumó un porro -->
  <section class="d-flex justify-content-center align-items-center ">
    <form action="" method="post" class="w-100 row g-3">
      <div class="col-md-8 col-sm-8  col-lg-8 mt-0">
        <div class="form-floating">
          <input type="text" class="form-control" id="Mensaje" name="Mensaje" placeholder="Mensaje">
          <label for="Mensaje">Mensaje</label>
        </div>
      </div>

      <div class="col-md-2 col-sm-2 col-lg-2 mt-0">
        <div class="form-floating">
          <input type="text" class="form-control" id="id" name="id" placeholder="id">
          <label for="id">id</label>
        </div>
      </div>

      <div class="col-md-2 col-sm-2  col-lg-2 mt-0 d-flex align-items-center">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </form>

  </section>
</body>

</html>