<?php
define('ACCESO' , true);
$titulo = "CafeTrack - Filtrar Pedidos";
$descripcion = "Filtro combinado de pedidos por modalidad y estado en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";

$datos = require __DIR__ . "/config/datos_demo.php";

// Listas blancas: los únicos valores permitidos
$modalidadesValidas = ["Para llevar", "Local"];
$estadosValidos = ["En Preparación", "Listo para Retirar", "Entregado"];

$errores = [];
$modalidad = "";
$estado = "";

if (isset($_GET["modalidad"]) && is_string($_GET["modalidad"]) && $_GET["modalidad"] !== "") {
    if (in_array($_GET["modalidad"], $modalidadesValidas, true)) {
        $modalidad = $_GET["modalidad"];
    } else {
        $errores[] = "La modalidad seleccionada no es válida.";
    }
}

if (isset($_GET["estado"]) && is_string($_GET["estado"]) && $_GET["estado"] !== "") {
    if (in_array($_GET["estado"], $estadosValidos, true)) {
        $estado = $_GET["estado"];
    } else {
        $errores[] = "El estado seleccionado no es válido.";
    }
}

// Criterio vacío = no filtrar por ese campo (se combinan con AND)
$resultados = array_values(array_filter($datos["pedidos"], function ($p) use ($modalidad, $estado) {
    if ($modalidad !== "" && $p["modalidad"] !== $modalidad) {
        return false;
    }
    if ($estado !== "" && $p["estado"] !== $estado) {
        return false;
    }
    return true;
}));

$paginaPedida = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT) ?: 1;
$resultado = paginar($resultados, $paginaPedida, 5);
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Filtrar Pedidos</h2>

<?php mostrar_errores($errores); ?>

      <form action="filtrar.php" method="get" class="eq04-formulario">
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Filtro combinado</legend>

          <div class="eq04-grupo-campo">
            <label for="modalidad" class="eq04-label">Modalidad:</label>
            <select id="modalidad" name="modalidad" class="eq04-select">
              <option value="">-- Todas --</option>
<?php foreach ($modalidadesValidas as $op): ?>
              <option value="<?php echo htmlspecialchars($op); ?>"<?php echo $op === $modalidad ? " selected" : ""; ?>><?php echo htmlspecialchars($op); ?></option>
<?php endforeach; ?>
            </select>
          </div>

          <div class="eq04-grupo-campo">
            <label for="estado" class="eq04-label">Estado:</label>
            <select id="estado" name="estado" class="eq04-select">
              <option value="">-- Todos --</option>
<?php foreach ($estadosValidos as $op): ?>
              <option value="<?php echo htmlspecialchars($op); ?>"<?php echo $op === $estado ? " selected" : ""; ?>><?php echo htmlspecialchars($op); ?></option>
<?php endforeach; ?>
            </select>
          </div>
        </fieldset>
        <button type="submit" class="eq04-boton-primario">Aplicar filtros</button>
        <a href="filtrar.php">Limpiar</a>
      </form>

      <p><?php echo $resultado["total"]; ?> pedidos encontrados.</p>

<?php if ($resultado["total"] === 0): ?>
      <p>Sin resultados.</p>
<?php else: ?>
      <table class="eq04-tabla">
        <caption>Pedidos filtrados</caption>
        <thead>
          <tr>
            <th scope="col"># Pedido</th>
            <th scope="col">Fecha / Hora</th>
            <th scope="col">Plato</th>
            <th scope="col">Modalidad</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
<?php foreach ($resultado["items"] as $pedido): ?>
          <tr>
            <td>#<?php echo htmlspecialchars($pedido["id"]); ?></td>
            <td><?php echo htmlspecialchars(formatear_fecha($pedido["fecha"])); ?></td>
            <td><?php echo htmlspecialchars($pedido["plato"]); ?></td>
            <td><?php echo htmlspecialchars($pedido["modalidad"]); ?></td>
            <td><?php echo htmlspecialchars($pedido["estado"]); ?></td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>

      <nav aria-label="Paginación">
        <p>Página <?php echo $resultado["pagina"]; ?> de <?php echo $resultado["total_paginas"]; ?></p>
<?php for ($i = 1; $i <= $resultado["total_paginas"]; $i++): ?>
<?php if ($i === $resultado["pagina"]): ?>
        <strong><?php echo $i; ?></strong>
<?php else: ?>
        <a href="filtrar.php?<?php echo htmlspecialchars(http_build_query(["modalidad" => $modalidad, "estado" => $estado, "pagina" => $i])); ?>"><?php echo $i; ?></a>
<?php endif; ?>
<?php endfor; ?>
      </nav>
<?php endif; ?>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>