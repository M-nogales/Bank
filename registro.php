<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Registro</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script defer src="js/bootstrap.bundle.js"></script>
</head>

<body>
  <div class="gradient_bg">
    <main class="w-100 m-auto log_width">
      <form class="row g-3" action="php/registro.php" method="POST" enctype="multipart/form-data">
        <h1 class="h3 text-center">Formulario de registro</h1>
        <div class="col-6">
          <label for="nombre" class="form-label label-text">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-6">
          <label for="apellidos" class="form-label label-text">Apellidos</label>
          <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>
        <!-- requerido por que es necesario para saber edad en prestamos -->
        <div class="col-6">
          <label for="fecha_nacimiento" class="form-label label-text">Fecha de nacimiento</label>
          <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>
        <div class="col-6">
          <label for="saldo_inicial" class="form-label label-text">Saldo inicial</label>
          <input type="number" class="form-control" id="saldo_inicial" name="saldo_inicial" min="0">
        </div>
        <div class="col-12">
          <label for="email" class="form-label label-text">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo123@gmail.com" required>
        </div>
        <div class="col-12">
          <label for="dni" class="form-label label-text">DNI</label>
          <input type="text" class="form-control" id="dni" name="dni" placeholder="29431510 X" required>
        </div>
        <div class="col-6">
          <label for="direccion" class="form-label label-text">Dirección</label>
          <input type="text" class="form-control" id="direccion" name="direccion"
            placeholder="Calle Europa, Edificio Portugal">
        </div>
        <div class="col-6">
          <label for="provincia" class="form-label label-text">Provincia</label>
          <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Cuenca">
        </div>
        <div class="col-6">
          <label for="ciudad" class="form-label label-text">Ciudad</label>
          <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Sevilla">
        </div>
        <div class="col-4">
          <label for="pais" class="form-label label-text">País de nacimiento</label>
          <select id="pais" name="pais" class="form-select" required>
            <option selected>España</option>
            <option>Alemania</option>
            <option>Argentina</option>
            <option>Australia</option>
            <option>Brasil</option>
            <option>Canadá</option>
            <option>China</option>
            <option>Corea del Sur</option>
            <option>Egipto</option>
            <option>Estados Unidos</option>
            <option>Francia</option>
            <option>India</option>
            <option>Italia</option>
            <option>Japón</option>
            <option>México</option>
            <option>Portugal</option>
            <option>Reino Unido</option>
            <option>Rusia</option>
            <option>Sudáfrica</option>
            <option>Turquía</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="CP" class="form-label label-text">CP</label>
          <input type="text" class="form-control" id="CP" name="CP">
        </div>
        <div class="col-12">
          <label for="foto" class="form-label label-text">Foto</label>
          <input type="file" class="form-control" id="foto" name="foto" >
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </form>
    </main>
  </div>
</body>

</html>