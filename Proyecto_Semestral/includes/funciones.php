<?php
defined('ACCESO') or die('Acceso denegado');
function formatear_fecha(string $fecha): string
{
    $t = strtotime($fecha);
    return $t === false ? "Fecha inválida" : date("d/m/Y h:i A", $t);
}

function mostrar_errores(array $errores): void
{
    if (empty($errores)) {
        return;
    }
    echo '<ul class="eq04-errores">';
    foreach ($errores as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul>';
}

function paginar(array $datos, int $pagina, int $porPagina = 5): array
{
    $total = count($datos);
    $totalPaginas = max(1, (int) ceil($total / $porPagina));
    $pagina = min(max($pagina, 1), $totalPaginas);

    return [
        "items"         => array_slice($datos, ($pagina - 1) * $porPagina, $porPagina),
        "pagina"        => $pagina,
        "total_paginas" => $totalPaginas,
        "total"         => $total,
    ];
}


// --- Funciones del Integrante 3 ---
function limpiar(string $valor): string
{
    return trim($valor);
}

function sanear(string $valor): string
{
    return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
}

function redirigir(string $destino): void
{
    header("Location: " . $destino);
    exit;
}
