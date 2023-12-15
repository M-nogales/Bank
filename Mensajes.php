<?php
include_once('php/conex.php');
// send_msg($conn,$id_user,$id_destino,$fechaEnvio,$contenido)
// getMensajesUsers($conn, $remitenteID, $destinatarioID)
// updateMensajesLeidos($conn, $remitenteID, $destinatarioID)
// getUsersExcept($conn, $excluirID)
include_once('php/mensajes.php');
session_start();
// if ($_SESSION["accesoUser"] !== true) {
//   // Redirigir a inicio_sesion.html si no tiene acceso
//   header("Location: inicio_sesion.html");
//   exit();
// }
//! ruta img perfil, en todos
$urlperfil = "php/" . $_SESSION['Foto'];

$usuarios = getUsersExcept($conn, $_SESSION["id"]);

// cogemos el primer usuario de la lista
$primerUser = reset($usuarios);
$id_destino = isset($_GET['userId']) ? $_GET['userId'] : $primerUser["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $mensaje = $_POST["Mensaje"] ?? "";
  $id_remitente = $_SESSION["id"];
  $fechaEnvio = date("Y-m-d H:i:s");

  if ($mensaje != "" && $id_destino != "") {
    send_msg($conn, $id_remitente, $id_destino, $fechaEnvio, $mensaje);
    // ponemos el id de destino para no tener que escribir manualmente a donde enviamos el mensaje
    header("Location: mensajes.php?userId=$id_destino");
    exit(); // evitamos que se envie el mismo mensaje una y otra vez al recargar,limpiamos post
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensajes</title>
  <link rel="icon" type="image/png" sizes="32x32" href="resources/imgs/Logo.png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script defer src="js/bootstrap.bundle.js"></script>
  <script defer src="js/manipulacion.js"></script>
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
  <section class="msg_section">
    <?php

    // por cada uno de los usuarios crea una url a la que enviamos el id de ese user
    // $usuarios procede de la linea (9) para evitar error al entrar en mensajes.php por primera vez
    echo '<div class="msg_profiles">';
    foreach ($usuarios as $usuario) {
      echo '<a href="?userId=' . $usuario['id'] . '">ID: ' . $usuario['id'] . ', Nombre: ' . $usuario['nombre'] . '</a>';
    }
    echo '</div>';
    //coge el id del destinatario de la url, en caso de que entres por primera vez coge el url del primer user
    $destinatarioID = isset($_GET['userId']) ? $_GET['userId'] : $primerUser["id"];
    $mensajes = getMensajesUsers($conn, $_SESSION["id"], $destinatarioID);

    // marca los mensajes como leidos en caso de que el otro usuario los vea
    updateMensajesLeidos($conn, $destinatarioID, $_SESSION["id"]);

    // imprime los mensajes como tal, les aplica un estilo dependiendo de quien los haya enviado y cual sea el user actual
    // el mensaje se muestra como leido si de la base de datos sale como true
    foreach ($mensajes as $mensaje) {
      echo '<div class="mensaje' . ($mensaje['remitenteID'] == $_SESSION["id"] ? ' msg_card_me' : ' msg_card') . '" data-usuario="' . $_SESSION["id"] . '">';
      echo '<p>' . $mensaje['contenido'] . '</p>';
      echo '<div class="msg_date">';
      echo '<p>Fecha de envío: ' . $mensaje['fechaEnvio'] . '</p>';
      echo '<p>Leído: ' . ($mensaje['leido'] ? 'Sí' : 'No') . '</p>';
      echo '</div>';
      echo '</div>';
    }
    ?>

  </section>
  <!-- col se fumó un porro -->
  <section class="d-flex justify-content-center align-items-center msg_enviar">
    <form action="" method="post" class="w-100 row g-3">
      <div class="col-md-10 col-sm-10 col-lg-10 ps-0 mt-0">
        <div class="form-floating">
          <input type="text" class="form-control" id="Mensaje" name="Mensaje" placeholder="Mensaje">
          <label for="Mensaje">Mensaje</label>
        </div>
      </div>

      <div class="col-md-2 col-sm-2 col-lg-2 mt-0 d-flex justify-content-center align-items-center">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </form>

  </section>
  <!-- No puedo hacerlo a traves de js debido a que no funcionaría el codigo php -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // pasamos el id del usuario del que queremos mostrar los mensajes con php
      var userId = <?php echo isset($_GET['userId']) ? $_GET['userId'] : 0; ?>;


      if (userId > 0) {
        // Oculta todos los mensajes que tengan de clase mensaje
        var mensajes = document.querySelectorAll('.mensaje');
        mensajes.forEach(function(mensaje) {
          mensaje.style.display = 'none';
        });

        // Muestra solo los mensajes del usuario seleccionado gracias al atributo que 
        // hemos asignado a la hora de mostrar los mensajes
        var mensajesUsuario = document.querySelectorAll('.mensaje[data-usuario="' + <?php echo $_SESSION["id"]; ?> + '"]');
        mensajesUsuario.forEach(function(mensajeUsuario) {
          mensajeUsuario.style.display = 'block';
        });
      }
    });
  </script>


</body>

</html>