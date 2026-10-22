<?php

namespace App\Models;

class Ingrediente
{
    public function __construct(private string $nombre) {}

    public function nombre(): string
    {
        return $this->nombre;
    }
}
