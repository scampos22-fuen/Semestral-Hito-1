<?php
define('ACCESO' , true);
$titulo = "CafeTrack - Menú en Vivo e Inicio";
$descripcion = "CafeTrack - Menú en tiempo real y gestión de pedidos de la cafetería universitaria.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Disponibilidad de Almuerzos en Tiempo Real</h2>
      <p>Evita filas revisando el inventario actualizado al instante por el personal de cocina.</p>

      <article>
        <h3>Menú del Día - Turno Almuerzo</h3>
        <p><strong>Horario de atención:</strong> <time datetime="07:00">07:00 AM</time> a <time datetime="19:00">07:00 PM</time></p>

        <table class="eq04-tabla">
          <caption>Platos Disponibles e Inventario en Vivo</caption>
          <thead>
            <tr>
              <th scope="col">Plato / Combo</th>
              <th scope="col">Categoría</th>
              <th scope="col">Precio ($)</th>
              <th scope="col">Disponibles</th>
              <th scope="col">Alergenos (Req. Semana 5)</th>
              <th scope="col">Estado</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Arroz con Pollo y Ensalada Rusa</td>
              <td>Ejecutivo</td>
              <td>2.75</td>
              <td>14 raciones</td>
              <td>Contiene mayonesa (huevo)</td>
              <td><span class="eq04-insignia-disponible">Disponible</span></td>
            </tr>
            <tr>
              <td>Sancocho con Arroz Blanco</td>
              <td>Sopa del Día</td>
              <td>2.25</td>
              <td>3 raciones</td>
              <td>Libre de gluten</td>
              <td><span class="eq04-insignia-alerta">Últimas Unidades</span></td>
            </tr>
          </tbody>
        </table>
      </article>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>