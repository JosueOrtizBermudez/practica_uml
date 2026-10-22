<?php

namespace App\Models;

abstract class Vivienda
{
    /** @var Cuarto[] */
    private array $cuartos = [];

    public function __construct(
        private string $direccion,
        private Persona $propietario,
        float $superficiePrimerCuarto,
        string $funcionPrimerCuarto,
    ) {
        $this->agregarCuarto($superficiePrimerCuarto, $funcionPrimerCuarto);
        $propietario->registrarPropiedad($this);
    }

    
    public function agregarCuarto(float $superficie, string $funcion): Cuarto
    {
        $cuarto = new Cuarto($this, $superficie, $funcion);
        $this->cuartos[] = $cuarto;

        return $cuarto;
    }

    public function direccion(): string
    {
        return $this->direccion;
    }

    public function propietario(): Persona
    {
        return $this->propietario;
    }

    /** @return Cuarto[] */
    public function cuartos(): array
    {
        return $this->cuartos;
    }
}
