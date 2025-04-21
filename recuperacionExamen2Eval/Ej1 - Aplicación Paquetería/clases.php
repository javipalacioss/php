<?php

class Paquete{
// Clase base para paquetes
        public $id;
        public $peso;
        public $destino;
        public $fecha_envio;

public function __construct($id, $peso, $destino, $fecha_envio) {
        $this->id = $id;
        $this->peso = $peso;
        $this->destino = $destino;
        $this->fecha_envio = $fecha_envio;
}

public function calcularCoste(){
        // Cálculo básico: 5€ por kg
        $coste = 5 * $this -> peso;
        return $coste;
}

public function mostrarInfo() {
        return "Id: {$this->id} | Peso: {$this->peso} | Destino: {$this->destino} | Fecha De Envio: {$this->fecha_envio}";
    }

}

class Urgente extends Paquete{
// Clase para paquetes urgentes
        public $tiempo_garantizado;

        public function __construct($id, $peso, $destino, $fecha_envio, $tiempo_garantizado) {
                parent::__construct($id, $peso, $destino, $fecha_envio);
                $this -> tiempo_garantizado = $tiempo_garantizado;
        }

        public function calcularCoste(){
                // Coste base + 10€ por cada hora de garantía 
                $coste = parent::calcularCoste() + (10 * ($this -> tiempo_garantizado));
                return $coste;
        }

        public function mostrarInfo(){
                return "PAQUETE URGENTE | " . parent::mostrarInfo() . " | Tiempo garantizado: {$this -> tiempo_garantizado}";
        }
     
}




class Fragil extends Paquete{
// Clase para paquetes frágiles
        public $instrucciones_especiales;

        public function __construct($id, $peso, $destino, $fecha_envio, $instrucciones_especiales) {
                parent::__construct($id, $peso, $destino, $fecha_envio);
                $this -> instrucciones_especiales = $instrucciones_especiales;
        }
        public function calcularCoste(){
                // Coste base + 50% extra por manipulación especial
                $coste = (1.5 * parent::calcularCoste());
                return $coste;

        }
        


        public function mostrarInfo(){
                return "PAQUETE FRAGIL | " . parent::mostrarInfo() . " | Instrucciones especiales: {$this -> instrucciones_especiales}";
        }

}
?>