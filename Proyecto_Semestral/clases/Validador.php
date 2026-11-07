<?php
defined('ACCESO') or die('Acceso denegado');

class Validador
{
    private array $errores = [];

    // Lee un campo de $_POST/$_GET de forma segura (evita arreglos manipulados)
    public static function texto(array $origen, string $clave): string
    {
        $valor = $origen[$clave] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }

    // Guarda solo el primer error de cada campo
    private function falla(string $campo, string $mensaje): void
    {
        if (!isset($this->errores[$campo])) {
            $this->errores[$campo] = $mensaje;
        }
    }

    public function requerido(string $campo, string $valor): self
    {
        if (trim($valor) === '') {
            $this->falla($campo, "$campo es obligatorio.");
        }
        return $this;
    }

    public function longitud(string $campo, string $valor, int $min, int $max): self
    {
        $n = mb_strlen($valor);
        if ($n < $min || $n > $max) {
            $this->falla($campo, "$campo debe tener entre $min y $max caracteres.");
        }
        return $this;
    }

    public function correo(string $campo, string $valor): self
    {
        if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->falla($campo, "$campo no es un correo válido.");
        }
        return $this;
    }

    public function cedula(string $campo, string $valor): self
    {
        if (!preg_match('/^[0-9]{1,2}-[0-9]{3,4}-[0-9]{4}$/', $valor)) {
            $this->falla($campo, "La cédula debe tener el formato 8-888-8888.");
        }
        return $this;
    }

    public function rango(string $campo, string $valor, int $min, int $max): self
    {
        $ok = filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]);
        if ($ok === false) {
            $this->falla($campo, "$campo debe ser un número entre $min y $max.");
        }
        return $this;
    }

    public function fecha(string $campo, string $valor, string $formato = 'Y-m-d'): self
    {
        $d = DateTime::createFromFormat($formato, $valor);
        if (!$d || $d->format($formato) !== $valor) {
            $this->falla($campo, "$campo no es una fecha válida.");
        }
        return $this;
    }

    public function listaBlanca(string $campo, string $valor, array $permitidos): self
    {
        if (!in_array($valor, array_map('strval', $permitidos), true)) {
            $this->falla($campo, "Selecciona un valor válido en $campo.");
        }
        return $this;
    }

    // Para la regla de negocio asignada: $cumple = condición que debe ser true
    public function regla(string $campo, bool $cumple, string $mensaje): self
    {
        if (!$cumple) {
            $this->falla($campo, $mensaje);
        }
        return $this;
    }

    public function esValido(): bool
    {
        return empty($this->errores);
    }

    // Devuelve lista plana, compatible con mostrar_errores()
    public function errores(): array
    {
        return array_values($this->errores);
    }
}