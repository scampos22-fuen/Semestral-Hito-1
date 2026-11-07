<?php
define('ACCESO' , true);
require_once __DIR__ . '/includes/csrf.php';
$titulo = "CafeTrack - Registrar Producto";
$descripcion = "Formulario para registrar un nuevo plato o producto en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Registro de Nuevo Producto / Plato</h2>

      <form action="#" method="post" class="eq04-formulario">
        <?= csrf_campo() ?>
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Datos del Producto (Segunda Entidad)</legend>

          <div class="eq04-grupo-campo">
            <label for="nombre_producto" class="eq04-label">Nombre del Plato:</label>
            <input type="text" id="nombre_producto" name="nombre_producto" class="eq04-input"
                   required minlength="3" maxlength="100" placeholder="Sancocho con Arroz">
          </div>

          <div class="eq04-grupo-campo">
            <label for="categoria" class="eq04-label">Categoría:</label>
            <select id="categoria" name="categoria" class="eq04-select" required>
              <option value="">-- Seleccione categoría --</option>
              <option value="ejecutivo">Ejecutivo</option>
              <option value="sopa">Sopa del Día</option>
              <option value="bebida">Bebida</option>
            </select>
          </div>

          <div class="eq04-grupo-campo">
            <label for="precio" class="eq04-label">Precio ($):</label>
            <input type="number" id="precio" name="precio" class="eq04-input"
                   required min="0.50" max="20.00" step="0.05" placeholder="2.50">
          </div>

          <div class="eq04-grupo-campo">
            <label for="stock_inicial" class="eq04-label">Stock Inicial:</label>
            <input type="number" id="stock_inicial" name="stock_inicial" class="eq04-input"
                   required min="1" max="200" value="20">
          </div>

          <div class="eq04-grupo-campo">
            <label for="info_alergenos" class="eq04-label">Información de Alérgenos:</label>
            <input type="text" id="info_alergenos" name="info_alergenos" class="eq04-input"
                   required maxlength="150" placeholder="Ej: Contiene mariscos, gluten, lácteos...">
          </div>
        </fieldset>

        <button type="submit" class="eq04-boton-primario">Guardar Producto</button>
      </form>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>