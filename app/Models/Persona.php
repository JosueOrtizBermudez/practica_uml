<?php

namespace App\Models;

use DateTimeImmutable;
use InvalidArgumentException;
use LogicException;

class Persona
{
    private ?Persona $conyuge = null;

    /** @var Persona[] */
    private array $hijos = [];

    private ?Vivienda $residencia = null;

    /** @var Vivienda[] */
    private array $propiedades = [];

    public function __construct(
        private string $nombre,
        private DateTimeImmutable $fechaNacimiento,
    ) {}

    public function casarseCon(Persona $persona): void
    {
        if ($persona === $this) {
            throw new InvalidArgumentException('Una persona no puede ser su propio cónyuge.');
        }

        if (($this->conyuge !== null && $this->conyuge !== $persona)
            || ($persona->conyuge !== null && $persona->conyuge !== $this)) {
            throw new LogicException('Alguna de las personas ya tiene cónyuge.');
        }

       
        $this->conyuge = $persona;
        $persona->conyuge = $this;
    }

    public function agregarHijo(Persona $hijo): void
    {
        if ($hijo === $this) {
            throw new InvalidArgumentException('Una persona no puede ser su propio hijo.');
        }

        if (! in_array($hijo, $this->hijos, true)) {
            $this->hijos[] = $hijo;
        }
    }

    public function vivirEn(Vivienda $vivienda): void
    {
        
        $this->residencia = $vivienda;
    }

   
    public function registrarPropiedad(Vivienda $vivienda): void
    {
        if ($vivienda->propietario() !== $this) {
            throw new InvalidArgumentException('La vivienda pertenece a otra persona.');
        }

        if (! in_array($vivienda, $this->propiedades, true)) {
            $this->propiedades[] = $vivienda;
        }
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function fechaNacimiento(): DateTimeImmutable
    {
        return $this->fechaNacimiento;
    }

    public function conyuge(): ?Persona
    {
        return $this->conyuge;
    }

    /** @return Persona[] */
    public function hijos(): array
    {
        return $this->hijos;
    }

    public function residencia(): Vivienda
    {
        if ($this->residencia === null) {
            throw new LogicException('Debe completar la persona con vivirEn().');
        }

        return $this->residencia;
    }

    /** @return Vivienda[] */
    public function propiedades(): array
    {
        return $this->propiedades;
    }
}
