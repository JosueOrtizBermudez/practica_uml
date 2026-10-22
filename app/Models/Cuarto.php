<?php

namespace App\Models;

use InvalidArgumentException;

class Cuarto
{
    
    public function __construct(
        private Vivienda $vivienda,
        private float $superficie,
        private string $funcion,
    ) {
        if ($superficie <= 0) {
            throw new InvalidArgumentException('La superficie debe ser positiva.');
        }
    }

    public function vivienda(): Vivienda
    {
        return $this->vivienda;
    }

    public function superficie(): float
    {
        return $this->superficie;
    }

    public function funcion(): string
    {
        return $this->funcion;
    }
}
