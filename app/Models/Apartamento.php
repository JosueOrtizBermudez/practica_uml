<?php

namespace App\Models;

class Apartamento extends Vivienda
{
    public function __construct(
        string $direccion,
        Persona $propietario,
        float $superficiePrimerCuarto,
        string $funcionPrimerCuarto,
        private int $piso,
        private bool $tieneAscensor,
    ) {
        parent::__construct(
            $direccion,
            $propietario,
            $superficiePrimerCuarto,
            $funcionPrimerCuarto,
        );
    }

    public function piso(): int
    {
        return $this->piso;
    }

    public function tieneAscensor(): bool
    {
        return $this->tieneAscensor;
    }
}
