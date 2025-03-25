<?php
// Clase base para movimientos
class Movimiento
{
    //atributos
    public $fecha;
    public $concepto;
    public $cantidad;

    //constructor
    public function __construct($fecha, $concepto, $cantidad)
    {
        $this->fecha = $fecha;
        $this->concepto = $concepto;
        $this->cantidad = $cantidad;
    }

    public function mostrarInfo()
    {
        return ("Movimiento: Fecha: " . $this->fecha . ", Concepto: " . $this->concepto .  ", Cantidad: " . $this->cantidad);
    }
}

// Clase para gastos
class Gasto extends Movimiento
{
    //atributos
    public $destinatario;

    //constructor
    public function __construct($fecha, $concepto, $cantidad, $destinatario)
    {
        parent::__construct($fecha, $concepto, $cantidad);
        $this->destinatario = $destinatario;
    }

    public function mostrarInfo()
    {
        return "Informacion del Gasto= " . parent::mostrarInfo() . ", Destinatario: " . $this->destinatario;
    }
}

// Clase para ingresos
class Ingreso extends Movimiento
{
    //atributos
    public $origen;

    //constructor
    public function __construct($fecha, $concepto, $cantidad, $origen)
    {
        parent::__construct($fecha, $concepto, $cantidad);
        $this->origen = $origen;
    }

    public function mostrarInfo()
    {
        return "Informacion del Ingreso= " . parent::mostrarInfo() . ", Ingreso:" . $this->origen;
    }
}
