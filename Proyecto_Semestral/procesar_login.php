<?php
session_start();
require_once __DIR__ . "/includes/funciones.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigir("login.php");
}

$usuarios = require __DIR__ . "/config/usuarios_demo.php";

$correo = limpiar($_POST["correo_login"] ?? "");
$clave  = $_POST["clave_login"] ?? "";
$errores = [];
$encontrado = null;

if ($correo === "" || $clave === "") {
    $errores[] = "Correo y contraseña son obligatorios.";
} else {
    foreach ($usuarios as $u) {
        if ($u["correo"] === $correo) { $encontrado = $u; break; }
    }
    if (!$encontrado || !password_verify($clave, $encontrado["hash"])) {
        $errores[] = "Credenciales incorrectas.";
    }
}

if ($errores) {
    $_SESSION["errores"]    = $errores;
    $_SESSION["old_correo"] = $correo;
    redirigir("login.php");
}

session_regenerate_id(true);
$_SESSION["usuario"] = $encontrado["nombre"];
$_SESSION["rol"]     = $encontrado["rol"];
redirigir("index.php");