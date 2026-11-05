<?php
class Pedido
{
    public const MODALIDADES = ["Local", "Para llevar"];
    public const ESTADOS = ["En Preparación", "Listo para Retirar", "Entregado"];

    private string $id;
    private string $fecha;
    private string $plato;
    private string $modalidad;
    private string $estado;

    public function __construct(string $id, string $fecha, string $plato, string $modalidad, string $estado = "En Preparación")
    {
        $this->setId($id);
        $this->setFecha($fecha);
        $this->setPlato($plato);
        $this->setModalidad($modalidad);
        $this->setEstado($estado);
    }

    public function getId(): string        { return $this->id; }
    public function getFecha(): string     { return $this->fecha; }
    public function getPlato(): string     { return $this->plato; }
    public function getModalidad(): string { return $this->modalidad; }
    public function getEstado(): string    { return $this->estado; }

    public function setId(string $id): void
    {
        $id = trim($id);
        if (!preg_match('/^ORD-\d{3,6}$/', $id)) {
            throw new InvalidArgumentException("El código del pedido debe tener el formato ORD-123.");
        }
        $this->id = $id;
    }

    public function setFecha(string $fecha): void
    {
        $fecha = trim($fecha);
        if ($fecha === "" || strtotime($fecha) === false) {
            throw new InvalidArgumentException("La fecha del pedido no es válida.");
        }
        $this->fecha = $fecha;
    }

    public function setPlato(string $plato): void
    {
        $plato = trim($plato);
        if (mb_strlen($plato) < 3 || mb_strlen($plato) > 60) {
            throw new InvalidArgumentException("El plato debe tener entre 3 y 60 caracteres.");
        }
        $this->plato = $plato;
    }

    public function setModalidad(string $modalidad): void
    {
        if (!in_array($modalidad, self::MODALIDADES, true)) {
            throw new InvalidArgumentException("Modalidad no permitida.");
        }
        $this->modalidad = $modalidad;
    }

    public function setEstado(string $estado): void
    {
        if (!in_array($estado, self::ESTADOS, true)) {
            throw new InvalidArgumentException("Estado no permitido.");
        }
        $this->estado = $estado;
    }
}