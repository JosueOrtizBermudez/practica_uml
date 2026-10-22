<?php

namespace App\Models;

use InvalidArgumentException;

class Receta
{
    /** @var DetalleReceta[] */
    private array $ingredientes = [];

   
    public function __construct(
        private string $titulo,
        private int $porciones,
        private string $instrucciones,
        Ingrediente $primerIngrediente,
        float $cantidad,
        string $unidadMedida,
    ) {
        if ($porciones <= 0) {
            throw new InvalidArgumentException('Las porciones deben ser positivas.');
        }

        $this->agregarIngrediente($primerIngrediente, $cantidad, $unidadMedida);
    }

    public function agregarIngrediente(
        Ingrediente $ingrediente,
        float $cantidad,
        string $unidadMedida,
    ): DetalleReceta {
        foreach ($this->ingredientes as $detalle) {
            if ($detalle->ingrediente() === $ingrediente) {
                throw new InvalidArgumentException('El ingrediente ya pertenece a la receta.');
            }
        }

        $detalle = new DetalleReceta($this, $ingrediente, $cantidad, $unidadMedida);
        $this->ingredientes[] = $detalle;

        return $detalle;
    }

    public function titulo(): string
    {
        return $this->titulo;
    }

    public function porciones(): int
    {
        return $this->porciones;
    }

    public function instrucciones(): string
    {
        return $this->instrucciones;
    }

    /** @return DetalleReceta[] */
    public function ingredientes(): array
    {
        return $this->ingredientes;
    }
}
