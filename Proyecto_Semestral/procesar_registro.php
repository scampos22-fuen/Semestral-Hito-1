<?php
session_start();
require_once __DIR__ . "/includes/funciones.php";
require_once __DIR__ . "/clases/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigir("registro.php");
}

$nombre = limpiar($_POST["nombre_completo"] ?? "");
$cedula = limpiar($_POST["cedula_registro"] ?? "");
$correo = limpiar($_POST["correo_registro"] ?? "");
$rol_id = limpiar($_POST["rol_id"] ?? "");
$clave  = $_POST["clave_registro"] ?? "";   // la clave no se limpia ni se devuelve al formulario

// Lista blanca: número del formulario => rol del sistema
$roles = ["1" => "usuario", "2" => "cocina", "3" => "admin"];
$errores = [];

if (!preg_match('/^[0-9]{1,2}-[0-9]{3,4}-[0-9]{4}$/', $cedula)) {
    $errores[] = "La cédula debe tener el formato 8-888-8888.";
}
if (!isset($roles[$rol_id])) {
    $errores[] = "Selecciona un tipo de usuario válido.";
}
if (strlen($clave) < 8 || strlen($clave) > 50) {
    $errores[] = "La contraseña debe tener entre 8 y 50 caracteres.";
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