<?php
define('ACCESO' , true);
$titulo = "CafeTrack - Detalle de Pedido";
$descripcion = "Detalle de un pedido individual en CafeTrack.";
require_once __DIR__ . "/includes/encabezado.php";
?>

  <main class="eq04-contenedor">
    <section class="eq04-seccion">
      <h2>Ficha Detallada del Pedido #ORD-101</h2>

      <article>
        <h3>Información General</h3>
        <p><strong>Cliente:</strong> Sergio Ceballos</p>
        <p><strong>Cédula:</strong> 8-952-1234</p>
        <p><strong>Plato Solicitado:</strong> Arroz con Pollo y Ensalada Rusa</p>
        <p><strong>Cantidad:</strong> 1 ración</p>
        <p><strong>Modalidad:</strong> Para llevar</p>
        <p><strong>Hora Programada de Retiro:</strong> 12:15 PM</p>
        <p><strong>Alergias / Restricciones:</strong> Sin mayonesa</p>
        <p><strong>Total a Pagar:</strong> $2.75</p>
      </article>
    </section>
  </main>

<?php require_once __DIR__ . "/includes/pie.php"; ?>