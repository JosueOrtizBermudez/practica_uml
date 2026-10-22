<?php

namespace App\Models;

use InvalidArgumentException;

class DetalleReceta
{
    public function __construct(
        private Receta $receta,
        private Ingrediente $ingrediente,
        private float $cantidad,
        private string $unidadMedida,
    ) {
        if ($cantidad <= 0) {
            throw new InvalidArgumentException('La cantidad debe ser positiva.');
        }
    }

    public function receta(): Receta
    {
        return $this->receta;
    }

    public function ingrediente(): Ingrediente
    {
        return $this->ingrediente;
    }

    public function cantidad(): float
    {
        return $this->cantidad;
    }

    public function unidadMedida(): string
    {
        return $this->unidadMedida;
    }
}
