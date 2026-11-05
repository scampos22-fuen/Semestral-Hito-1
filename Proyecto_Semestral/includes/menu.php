<nav aria-label="Navegación principal">
  <ul class="eq04-nav-lista">
    <li><a href="index.php" class="eq04-nav-enlace">Menú en Vivo</a></li>
<?php if ($rol === "visitante"): ?>
    <li><a href="buscar.php" class="eq04-nav-enlace">Buscar</a></li>
    <li><a href="filtrar.php" class="eq04-nav-enlace">Filtrar</a></li>
    <li><a href="registro.php" class="eq04-nav-enlace">Registrarse</a></li>
    <li><a href="login.php" class="eq04-nav-enlace">Iniciar Sesión</a></li>
<?php endif; ?>
<?php if ($rol === "usuario" || $rol === "admin"): ?>
    <li><a href="principal-formulario.php" class="eq04-nav-enlace">Realizar Pedido</a></li>
    <li><a href="principal-listado.php" class="eq04-nav-enlace">Mis Pedidos</a></li>
    <li><a href="perfil.php" class="eq04-nav-enlace">Perfil</a></li>
<?php endif; ?>
<?php if ($rol === "admin"): ?>
    <li><a href="secundaria-formulario.php" class="eq04-nav-enlace">Registrar Producto</a></li>
    <li><a href="panel.php" class="eq04-nav-enlace">Panel Cocina</a></li>
<?php endif; ?>
  </ul>
</nav>