<?php
$titulo = "CafeTrack - Iniciar Sesión";
$descripcion = "Inicio de sesión para usuarios de CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Acceso a la Plataforma</h2>

      <form action="procesar_login.php" method="post" class="eq04-formulario">
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Credenciales de Usuario</legend>

          <div class="eq04-grupo-campo">
            <label for="correo_login" class="eq04-label">Correo Institucional:</label>
            <input type="email" id="correo_login" name="correo_login" class="eq04-input"
                   required maxlength="100" autocomplete="email" placeholder="estudiante@utp.ac.pa">
          </div>

          <div class="eq04-grupo-campo">
            <label for="clave_login" class="eq04-label">Contraseña:</label>
            <input type="password" id="clave_login" name="clave_login" class="eq04-input"
                   required minlength="8" maxlength="50" autocomplete="current-password">
          </div>
        </fieldset>

        <button type="submit" class="eq04-boton-primario">Ingresar</button>
        <p><a href="recuperar.php">¿Olvidaste tu contraseña?</a> | <a href="registro.php">Crear cuenta nueva</a></p>
      </form>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>