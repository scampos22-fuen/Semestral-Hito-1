<?php
define('ACCESO' , true);
$titulo = "CafeTrack - Perfil de Usuario";
$descripcion = "Perfil de usuario en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Perfil del Usuario</h2>

      <article>
        <h3>Datos de la Cuenta</h3>
        <p><strong>Nombre:</strong> Sergio Ceballos</p>
        <p><strong>Cédula:</strong> 7-715-876</p>
        <p><strong>Correo Electrónico:</strong> sergio.ceballos@utp.ac.pa</p>
        <p><strong>Rol:</strong> Administrador</p>
      </article>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>