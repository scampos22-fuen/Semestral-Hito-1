<?php
define('ACCESO' , true);
$titulo = "CafeTrack - Mis Pedidos";
$descripcion = "Listado e historial de pedidos del usuario en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Historial de Mis Pedidos</h2>

      <table class="eq04-tabla">
        <caption>Listado Personal de Solicitudes</caption>
        <thead>
          <tr>
            <th scope="col"># Pedido</th>
            <th scope="col">Fecha / Hora</th>
            <th scope="col">Plato</th>
            <th scope="col">Modalidad</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#ORD-101</td>
            <td>19/10/2026 12:00 PM</td>
            <td>Arroz con Pollo</td>
            <td>Para llevar</td>
            <td><span class="eq04-insignia-alerta">En Preparación</span></td>
            <td><a href="principal-detalle.php">Ver Detalle</a></td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>