<?php
define('ACCESO' , true);
require_once __DIR__ . '/includes/csrf.php';
$titulo = "CafeTrack - Recuperar Contraseña";
$descripcion = "Recuperación de contraseña de CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Restablecimiento de Contraseña</h2>
      <p>Ingresa tu correo registrado para recibir un enlace de recuperación.</p>

      <form action="#" method="post" class="eq04-formulario">
        <?= csrf_campo() ?>
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Verificación de Cuenta</legend>

          <div class="eq04-grupo-campo">
            <label for="correo_recuperar" class="eq04-label">Correo Electrónico:</label>
            <input type="email" id="correo_recuperar" name="correo_recuperar" class="eq04-input"
                   required maxlength="100" autocomplete="email" placeholder="usuario@utp.ac.pa">
          </div>
        </fieldset>

        <button type="submit" class="eq04-boton-primario">Enviar Enlace</button>
      </form>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>