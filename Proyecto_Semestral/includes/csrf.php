<?php
defined('ACCESO') or die('Acceso denegado');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_campo(): string
{
    return '<input type="hidden" name="csrf" value="'
        . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

function csrf_valido($token): bool
{
    return is_string($token) && isset($_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $token);
}