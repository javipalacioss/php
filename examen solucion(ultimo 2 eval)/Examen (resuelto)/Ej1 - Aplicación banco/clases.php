<?php
// Clase base para movimientos
class Movimiento {
    public $fecha;
    public $concepto;
    public $cantidad;
    
    public function __construct($fecha, $concepto, $cantidad) {
        $this->fecha = $fecha;
        $this->concepto = $concepto;
        $this->cantidad = $cantidad;
    }
    
    public function mostrarInfo() {
        return "Fecha: {$this->fecha} | Concepto: {$this->concepto} | Cantidad: {$this->cantidad}€";
    }
}

// Clase para gastos
class Gasto extends Movimiento {
    public $destinatario;
    
    public function __construct($fecha, $concepto, $cantidad, $destinatario) {
        parent::__construct($fecha, $concepto, $cantidad);
        $this->destinatario = $destinatario;
    }
    
    public function mostrarInfo() {
        return "GASTO | " . parent::mostrarInfo() . " | Destinatario: {$this->destinatario}";
    }
}

// Clase para ingresos
class Ingreso extends Movimiento {
    public $origen;
    
    public function __construct($fecha, $concepto, $cantidad, $origen) {
        parent::__construct($fecha, $concepto, $cantidad);
        $this->origen = $origen;
    }
    
    public function mostrarInfo() {
        return "INGRESO | " . parent::mostrarInfo() . " | Origen: {$this->origen}";
    }
}
?>