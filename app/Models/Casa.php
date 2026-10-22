<?php

namespace App\Models;

class Casa extends Vivienda
{
    public function __construct(
        string $direccion,
        Persona $propietario,
        float $superficiePrimerCuarto,
        string $funcionPrimerCuarto,
        private bool $tieneJardin,
        private bool $esIndividual,
    ) {
        parent::__construct(
            $direccion,
            $propietario,
            $superficiePrimerCuarto,
            $funcionPrimerCuarto,
        );
    }

    public function tieneJardin(): bool
    {
        return $this->tieneJardin;
    }

    public function esIndividual(): bool
    {
        return $this->esIndividual;
    }
}
