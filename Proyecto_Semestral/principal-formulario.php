<?php
$titulo = "CafeTrack - Realizar Pedido";
$descripcion = "Formulario para realizar un nuevo pedido en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Formulario de Solicitud de Pedido</h2>

      <form action="#" method="post" class="eq04-formulario">
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Datos del Pedido y Cliente</legend>

          <div class="eq04-grupo-campo">
            <label for="cedula_estudiante" class="eq04-label">Cédula o ID Estudiantil:</label>
            <input type="text" id="cedula_estudiante" name="cedula_estudiante" class="eq04-input"
                   required pattern="[0-9]{1,2}-[0-9]{3,4}-[0-9]{4}" placeholder="8-999-9999" autocomplete="off">
          </div>

          <div class="eq04-grupo-campo">
            <label for="producto_id" class="eq04-label">Plato Seleccionado:</label>
            <select id="producto_id" name="producto_id" class="eq04-select" required>
              <option value="">-- Seleccione un plato --</option>
              <option value="1">Arroz con Pollo ($2.75)</option>
              <option value="2">Sancocho con Arroz ($2.25)</option>
            </select>
          </div>

          <div class="eq04-grupo-campo">
            <label for="cantidad" class="eq04-label">Cantidad (Máximo 5):</label>
            <input type="number" id="cantidad" name="cantidad" class="eq04-input"
                   required min="1" max="5" value="1">
          </div>

          <!-- CAMPO ESPECIAL ASIGNADO -->
          <div class="eq04-grupo-campo">
            <label for="modalidad_consumo" class="eq04-label">Modalidad de Consumo (Campo Especial):</label>
            <select id="modalidad_consumo" name="modalidad_consumo" class="eq04-select" required>
              <option value="para_llevar">Para llevar (Empaque compostable)</option>
              <option value="comer_en_local">Comer en el local</option>
            </select>
          </div>

          <!-- REGLA DE NEGOCIO EN CAMPO DE HORA -->
          <div class="eq04-grupo-campo">
            <label for="hora_retiro" class="eq04-label">Hora Programada de Retiro (07:00 a 16:00):</label>
            <input type="time" id="hora_retiro" name="hora_retiro" class="eq04-input"
                   required min="07:00" max="16:00">
          </div>

          <!-- CAMBIO DE REQUERIMIENTO (SEMANA 5) -->
          <div class="eq04-grupo-campo">
            <label for="alergias_restricciones" class="eq04-label">Alergias o Restricciones Alimentarias:</label>
            <textarea id="alergias_restricciones" name="alergias_restricciones" class="eq04-textarea"
                      maxlength="200" placeholder="Ejemplo: Intolerancia a la lactosa, alergia al maní..."></textarea>
          </div>
        </fieldset>

        <button type="submit" class="eq04-boton-primario">Confirmar y Guardar Pedido</button>
      </form>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>