<?php
$titulo = "CafeTrack - Buscar Pedidos";
$descripcion = "Búsqueda de pedidos por plato o número en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";

$datos = require __DIR__ . "/config/datos_demo.php";

// Leer y limpiar el texto (puede no venir, o venir como arreglo si manipulan la URL)
$texto = (isset($_GET["texto"]) && is_string($_GET["texto"])) ? trim($_GET["texto"]) : "";
$texto = mb_substr($texto, 0, 50);

$resultados = $datos["pedidos"];
if ($texto !== "") {
    $resultados = array_values(array_filter($datos["pedidos"], function ($p) use ($texto) {
        return stripos($p["plato"], $texto) !== false
            || stripos($p["id"], $texto) !== false;
    }));
}

$paginaPedida = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT) ?: 1;
$resultado = paginar($resultados, $paginaPedida, 5);
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Buscar Pedidos</h2>

      <form action="buscar.php" method="get" class="eq04-formulario">
        <fieldset class="eq04-fieldset">
          <legend class="eq04-legend">Búsqueda por plato o número de pedido</legend>
          <div class="eq04-grupo-campo">
            <label for="texto" class="eq04-label">Texto a buscar:</label>
            <input type="text" id="texto" name="texto" class="eq04-input"
                   maxlength="50" placeholder="Ej: pollo, ORD-102"
                   value="<?php echo htmlspecialchars($texto); ?>">
          </div>
        </fieldset>
        <button type="submit" class="eq04-boton-primario">Buscar</button>
      </form>

<?php if ($texto !== ""): ?>
      <p>Resultados para: <strong><?php echo htmlspecialchars($texto); ?></strong>
         (<?php echo $resultado["total"]; ?> encontrados)</p>
<?php endif; ?>

<?php if ($resultado["total"] === 0): ?>
      <p>Sin resultados.</p>
<?php else: ?>
      <table class="eq04-tabla">
        <caption>Resultados de la búsqueda</caption>
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
        <a href="buscar.php?<?php echo htmlspecialchars(http_build_query(["texto" => $texto, "pagina" => $i])); ?>"><?php echo $i; ?></a>
<?php endif; ?>
<?php endfor; ?>
      </nav>
<?php endif; ?>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>