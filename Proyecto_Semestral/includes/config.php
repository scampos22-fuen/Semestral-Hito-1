<?php
// Rol simulado: "visitante", "usuario" o "admin"
// Se lee de la sesión que guarda procesar_login.php
$rol = $_SESSION["rol"] ?? "visitante";