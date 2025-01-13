<?php

class vehiculo
{

    // Declaración de atributos
    private $marca;
    private $color;
    private $plazas;
    private $aparcado = true;

    /**
     * Constructor: Inicializa variables
     * @return void
     */
    public function __construct()
    {
        $plazas = 0;
    }

    // Funciones GET
    public function getMarca(): string
    {
        return $this->marca;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getPlazas(): int
    {
        return $this->plazas;
    }

    // Funciones GET
    public function setMarca(string $mar): void
    {
        $this->marca = $mar;
    }

    public function setColor(string $col): void
    {
        $this->color = $col;
    }

    /**
     * @param int $pla Nuevo número de plazas. Debe ser número positivo.
     */
    public function setPlazas(int $pla): void
    {
        $pla > 0 ? $this->plazas = $pla : $this->plazas = 0;
    }

    // Funciones Auxiliares

    /**
     * Aparca el coche
     * @return void
     */
    public function aparcar()
    {
        $this->aparcado = true;
    }

    /**
     * Arranca el coche
     * @return void
     */
    public function arrancar()
    {
        $this->aparcado = false;
    }

    /**
     * Devuelve bool, estado del coche
     * @return bool
     */
    public function isAparcado(): bool
    {
        return $this->aparcado;
    }

    /**
     * Devuelve string con información
     *  @return string
     */
    public function __toString(): string
    {
        if ($this->isAparcado()) {

            // Si está aparcado
            $mensaje = "<p>Este vehículo es de la marca $this->marca, de color $this->color, tiene $this->plazas plazas... y está aparcado.";
        } else {
            // Si está arrancado
            $mensaje = "<p>Este vehículo es de la marca $this->marca, de color $this->color, tiene $this->plazas plazas... y está arrancado.";
        }
        return $mensaje;
    }
}
