<?php
session_start();
require_once __DIR__ . "/includes/funciones.php";
require_once __DIR__ . "/clases/Pedido.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigir("principal-formulario.php");
}

$datos = require __DIR__ . "/config/datos_demo.php";

$cedula       = limpiar($_POST["cedula_estudiante"] ?? "");
$producto_id  = limpiar($_POST["producto_id"] ?? "");
$cantidad_txt = limpiar($_POST["cantidad"] ?? "");
$modalidad_id = limpiar($_POST["modalidad_consumo"] ?? "");
$hora         = limpiar($_POST["hora_retiro"] ?? "");
$alergias     = limpiar($_POST["alergias_restricciones"] ?? "");

// Listas blancas: código del formulario => valor del sistema
$platos      = ["1" => "Arroz con Pollo", "2" => "Sancocho"];
$modalidades = ["para_llevar" => "Para llevar", "comer_en_local" => "Local"];

$cantidad = filter_var($cantidad_txt, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 5]]);
$errores = [];

if (!isset($platos[$producto_id])) {
    $errores[] = "Selecciona un plato válido.";
}
if (!isset($modalidades[$modalidad_id])) {
    $errores[] = "Selecciona una modalidad válida.";
}
if ($cantidad === false) {
    $errores[] = "La cantidad debe ser un número entre 1 y 5.";
}

// Segunda capa: la clase Pedido valida el resto (cédula, hora, alergias)
if (!$errores) {
    try {
        $numero = count($datos["pedidos"] ?? []) + 101;   // ORD-108 si hay 7 pedidos
        $pedido = new Pedido(
            "ORD-" . str_pad((string) $numero, 3, "0", STR_PAD_LEFT),
            date("Y-m-d H:i"),
            $platos[$producto_id],
            $modalidades[$modalidad_id],
            "En Preparación",
            $cedula,
            $cantidad,
            $hora,
            $alergias
        );
    } catch (InvalidArgumentException $e) {
        $errores[] = $e->getMessage();
    }
}

if ($errores) {
    $_SESSION["errores"] = $errores;
    $_SESSION["old"] = [
        "cedula_estudiante"      => $cedula,
        "producto_id"            => $producto_id,
        "cantidad"               => $cantidad_txt,
        "modalidad_consumo"      => $modalidad_id,
        "hora_retiro"            => $hora,
        "alergias_restricciones" => $alergias,
    ];
    redirigir("principal-formulario.php");
}

// Simulado: sin base de datos, el pedido no se guarda
$_SESSION["mensaje"] = "Pedido " . $pedido->getId() . " registrado (simulado).";
redirigir("principal-listado.php");