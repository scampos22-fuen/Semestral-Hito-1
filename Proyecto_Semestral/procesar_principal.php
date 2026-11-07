<?php
define('ACCESO' , true);
session_start();
require_once __DIR__ . "/includes/funciones.php";
require_once __DIR__ . "/clases/Pedido.php";
require_once __DIR__ . "/includes/csrf.php";
require_once __DIR__ . "/clases/Validador.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigir("principal-formulario.php");
}

if (!csrf_valido($_POST["csrf"] ?? null)) {
    $_SESSION["errores"] = ["Solicitud no válida. Recarga la página e intenta de nuevo."];
    redirigir("principal-formulario.php");
}
$datos = require __DIR__ . "/config/datos_demo.php";

$cedula       = Validador::texto($_POST, "cedula_estudiante");
$producto_id  = Validador::texto($_POST, "producto_id");
$cantidad_txt = Validador::texto($_POST, "cantidad");
$modalidad_id = Validador::texto($_POST, "modalidad_consumo");
$hora         = Validador::texto($_POST, "hora_retiro");
$alergias     = Validador::texto($_POST, "alergias_restricciones");

// Listas blancas: código del formulario => valor del sistema
$platos      = ["1" => "Arroz con Pollo", "2" => "Sancocho"];
$modalidades = ["para_llevar" => "Para llevar", "comer_en_local" => "Local"];

$v = new Validador();
$v->cedula("Cédula", $cedula);
$v->listaBlanca("Plato", $producto_id, array_keys($platos));
$v->listaBlanca("Modalidad", $modalidad_id, array_keys($modalidades));
$v->rango("Cantidad", $cantidad_txt, 1, 5);
$v->regla(
    "Hora",
    preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $hora) === 1
        && $hora >= "07:00" && $hora <= "16:00",
    "La hora de retiro debe estar entre 07:00 y 16:00."
);
$v->longitud("Alergias", $alergias, 0, 200);
$errores = $v->errores();
$cantidad = (int) $cantidad_txt;
// Segunda capa: la clase Pedido valida el resto (cédula, hora, alergias)
if (!$errores) {
    try {
        $numero = count($datos["pedidos"] ?? []) + 101;   // ORD-108 si hay 7 pedidos
                $pedido = new Pedido(
            "ORD-" . str_pad((string) $numero, 3, "0", STR_PAD_LEFT),
            date("Y-m-d H:i"),
            $platos[$producto_id],
            $modalidades[$modalidad_id],
            $cedula,
            $cantidad,
            $hora,
            "En Preparación",
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