<?php
$titulo = "CafeTrack - Registro de Usuario";
$descripcion = "Formulario de registro de nuevos usuarios en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Registro de Nuevo Usuario</h2>

      <form action="#" method="post" class="eq04-formulario">
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Datos Personales y Rol</legend>

          <div class="eq04-grupo-campo">
            <label for="nombre_completo" class="eq04-label">Nombre Completo:</label>
            <input type="text" id="nombre_completo" name="nombre_completo" class="eq04-input"
                   required minlength="3" maxlength="100" autocomplete="name" placeholder="Juan Pérez">
          </div>

          <div class="eq04-grupo-campo">
            <label for="cedula_registro" class="eq04-label">Cédula o Identificación:</label>
            <input type="text" id="cedula_registro" name="cedula_registro" class="eq04-input"
                   required pattern="[0-9]{1,2}-[0-9]{3,4}-[0-9]{4}" placeholder="8-888-8888">
          </div>

          <div class="eq04-grupo-campo">
            <label for="correo_registro" class="eq04-label">Correo Electrónico:</label>
            <input type="email" id="correo_registro" name="correo_registro" class="eq04-input"
                   required maxlength="100" autocomplete="email" placeholder="usuario@utp.ac.pa">
          </div>

          <div class="eq04-grupo-campo">
            <label for="rol_id" class="eq04-label">Tipo de Usuario:</label>
            <select id="rol_id" name="rol_id" class="eq04-select" required>
              <option value="">-- Seleccione un rol --</option>
              <option value="1">Cliente (Estudiante / Administrativo)</option>
              <option value="2">Cocina / Personal de Despacho</option>
              <option value="3">Administrador de Cafetería</option>
            </select>
          </div>

          <div class="eq04-grupo-campo">
            <label for="clave_registro" class="eq04-label">Contraseña:</label>
            <input type="password" id="clave_registro" name="clave_registro" class="eq04-input"
                   required minlength="8" maxlength="50" autocomplete="new-password">
          </div>
        </fieldset>

        <button type="submit" class="eq04-boton-primario">Completar Registro</button>
      </form>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>