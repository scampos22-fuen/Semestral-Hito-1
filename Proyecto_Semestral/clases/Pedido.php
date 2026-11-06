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
    private string $cedula;
    private int $cantidad;
    private string $horaRetiro;
    private string $alergias;

        public function __construct(
        string $id,
        string $fecha,
        string $plato,
        string $modalidad,
        string $cedula,
        int $cantidad,
        string $horaRetiro,
        string $estado = "En Preparación",
        string $alergias = ""
    ) {
        $this->setId($id);
        $this->setFecha($fecha);
        $this->setPlato($plato);
        $this->setModalidad($modalidad);
        $this->setCedula($cedula);
        $this->setCantidad($cantidad);
        $this->setHoraRetiro($horaRetiro);
        $this->setEstado($estado);
        $this->setAlergias($alergias);
    }

    public function getId(): string         { return $this->id; }
    public function getFecha(): string      { return $this->fecha; }
    public function getPlato(): string      { return $this->plato; }
    public function getModalidad(): string  { return $this->modalidad; }
    public function getEstado(): string     { return $this->estado; }
    public function getCedula(): string     { return $this->cedula; }
    public function getCantidad(): int      { return $this->cantidad; }
    public function getHoraRetiro(): string { return $this->horaRetiro; }
    public function getAlergias(): string   { return $this->alergias; }

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

    public function setCedula(string $cedula): void
    {
        $cedula = trim($cedula);
        if (!preg_match('/^[0-9]{1,2}-[0-9]{3,4}-[0-9]{4}$/', $cedula)) {
            throw new InvalidArgumentException("La cédula debe tener el formato 8-888-8888.");
        }
        $this->cedula = $cedula;
    }

    public function setCantidad(int $cantidad): void
    {
        if ($cantidad < 1 || $cantidad > 5) {
            throw new InvalidArgumentException("La cantidad debe estar entre 1 y 5.");
        }
        $this->cantidad = $cantidad;
    }

    public function setHoraRetiro(string $hora): void
    {
        if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $hora) || $hora < "07:00" || $hora > "16:00") {
            throw new InvalidArgumentException("La hora de retiro debe estar entre 07:00 y 16:00.");
        }
        $this->horaRetiro = $hora;
    }

    public function setAlergias(string $alergias): void
    {
        $alergias = trim($alergias);
        if (mb_strlen($alergias) > 200) {
            throw new InvalidArgumentException("Las alergias no pueden superar 200 caracteres.");
        }
        $this->alergias = $alergias;
    }
}