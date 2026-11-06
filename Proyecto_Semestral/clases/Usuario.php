<?php
defined('ACCESO') or die('Acceso denegado');
class Usuario
{
    private string $nombre;
    private string $correo;
    private string $hash;
    private string $rol;

    public function __construct(string $nombre, string $correo, string $hash, string $rol = "usuario")
    {
        $this->setNombre($nombre);
        $this->setCorreo($correo);
        $this->hash = $hash;
        $this->setRol($rol);
    }

    public function getNombre(): string { return $this->nombre; }
    public function getCorreo(): string { return $this->correo; }
    public function getHash(): string   { return $this->hash; }
    public function getRol(): string    { return $this->rol; }

    public function setNombre(string $nombre): void
    {
        $nombre = trim($nombre);
       if (mb_strlen($nombre) < 3 || mb_strlen($nombre) > 100) {
      throw new InvalidArgumentException("El nombre debe tener entre 3 y 100 caracteres.");
}
        $this->nombre = $nombre;
    }

    public function setCorreo(string $correo): void
    {
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Correo no válido.");
        }
        $this->correo = $correo;
    }

    public function setRol(string $rol): void
    {
        if (!in_array($rol, ["usuario", "cocina", "admin"], true)) {
            throw new InvalidArgumentException("Rol no permitido.");
        }
        $this->rol = $rol;
    }

    public function verificarClave(string $clave): bool
    {
        return password_verify($clave, $this->hash);
    }
}