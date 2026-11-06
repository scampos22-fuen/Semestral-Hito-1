<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/funciones.php";
$titulo = $titulo ?? "CafeTrack UTP";
$descripcion = $descripcion ?? "CafeTrack - Gestión de pedidos de la cafetería universitaria.";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo htmlspecialchars($descripcion); ?>">
  <title><?php echo htmlspecialchars($titulo); ?></title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header class="eq04-header">
    <h1 class="eq04-titulo-sitio">CafeTrack UTP</h1>
    <?php require_once __DIR__ . "/menu.php"; ?>
  </header>