<?php
define('ACCESO', true);
session_start();
require_once __DIR__ . "/includes/funciones.php";
require_once __DIR__ . "/includes/csrf.php";
require_once __DIR__ . "/clases/Validador.php";
require_once __DIR__ . "/clases/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigir("registro.php");
}
if (!csrf_valido($_POST["csrf"] ?? null)) {
    $_SESSION["errores"] = ["Solicitud no válida. Recarga la página e intenta de nuevo."];
    redirigir("registro.php");
}

$nombre = Validador::texto($_POST, "nombre_completo");
$cedula = Validador::texto($_POST, "cedula_registro");
$correo = Validador::texto($_POST, "correo_registro");
$rol_id = Validador::texto($_POST, "rol_id");
$clave  = is_string($_POST["clave_registro"] ?? null) ? $_POST["clave_registro"] : "";

// Lista blanca: número del formulario => rol del sistema
$roles = ["1" => "usuario", "2" => "cocina", "3" => "admin"];

$v = new Validador();
$v->requerido("Nombre", $nombre)->longitud("Nombre", $nombre, 3, 80);
$v->requerido("Correo", $correo)->correo("Correo", $correo);
$v->cedula("Cédula", $cedula);
$v->listaBlanca("Tipo de usuario", $rol_id, array_keys($roles));
$v->requerido("Contraseña", $clave)->longitud("Contraseña", $clave, 8, 50);
// Aquí va tu regla de negocio con $v->regla(...)

$errores = $v->errores();
}

try {
    $hash    = password_hash($clave, PASSWORD_DEFAULT);
    $usuario = new Usuario($nombre, $correo, $hash, $roles[$rol_id] ?? "usuario");
} catch (InvalidArgumentException $e) {
    $errores[] = $e->getMessage();
}

if ($errores) {
    $_SESSION["errores"] = $errores;
    $_SESSION["old"] = [
        "nombre_completo" => $nombre,
        "cedula_registro" => $cedula,
        "correo_registro" => $correo,
        "rol_id"          => $rol_id,
    ];
    redirigir("registro.php");
}

// Simulado: sin base de datos, el usuario no se guarda
$_SESSION["mensaje"] = "Registro exitoso (simulado). Ya puedes iniciar sesión.";
redirigir("login.php");