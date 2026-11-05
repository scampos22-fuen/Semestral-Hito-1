<?php
$titulo = "CafeTrack - Panel de Despacho Cocina";
$descripcion = "Panel de control de cocina y despacho para CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Gestión de Pedidos Recibidos</h2>

      <table class="eq04-tabla">
        <caption>Cola de Preparación y Despacho</caption>
        <thead>
          <tr>
            <th scope="col"># Orden</th>
            <th scope="col">Cliente ID</th>
            <th scope="col">Plato</th>
            <th scope="col">Modalidad</th>
            <th scope="col">Hora Retiro</th>
            <th scope="col">Restricciones</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#ORD-101</td>
            <td>8-952-1234</td>
            <td>Arroz con Pollo</td>
            <td>Para llevar</td>
            <td>12:15 PM</td>
            <td>Sin cebolla</td>
            <td><span class="eq04-insignia-alerta">En Preparación</span></td>
          </tr>
          <tr>
            <td>#ORD-102</td>
            <td>9-740-5678</td>
            <td>Sancocho</td>
            <td>Local</td>
            <td>12:30 PM</td>
            <td>Ninguna</td>
            <td><span class="eq04-insignia-disponible">Listo para Retirar</span></td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>