<?php
define('ACCESO' , true);
session_start();
require_once __DIR__ . "/includes/funciones.php";
require_once __DIR__ . "/includes/csrf.php";
require_once __DIR__ . "/clases/Validador.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigir("login.php");
}


if (!csrf_valido($_POST["csrf"] ?? null)) {
    $_SESSION["errores"] = ["Solicitud no válida. Recarga la página e intenta de nuevo."];
    redirigir("login.php");
}

$usuarios = require __DIR__ . "/config/usuarios_demo.php";

$correo = Validador::texto($_POST, "correo_login");
$clave  = is_string($_POST["clave_login"] ?? null) ? $_POST["clave_login"] : "";
$encontrado = null;

$v = new Validador();
$v->requerido("Correo", $correo)->correo("Correo", $correo);
$v->requerido("Contraseña", $clave)->longitud("Contraseña", $clave, 1, 50);
$errores = $v->errores();

if (!$errores) {
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