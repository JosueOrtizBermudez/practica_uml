<?php

use App\Models\Apartamento;
use App\Models\Casa;
use App\Models\Persona;
use App\Models\Vivienda;

test('las personas tienen conyuges hijos residencia y propiedades con sus roles', function () {
    $ana = new Persona('Ana Mora', new DateTimeImmutable('1990-05-12'));
    $luis = new Persona('Luis Rojas', new DateTimeImmutable('1988-02-20'));
    $sofia = new Persona('Sofía Rojas', new DateTimeImmutable('2015-08-03'));

    $casa = new Casa(
        direccion: 'Liberia, barrio Los Ángeles',
        propietario: $ana,
        superficiePrimerCuarto: 12.0,
        funcionPrimerCuarto: 'Cocina',
        tieneJardin: true,
        esIndividual: true,
    );
    $dormitorio = $casa->agregarCuarto(16.0, 'Dormitorio');

    $apartamento = new Apartamento(
        direccion: 'Liberia, edificio Central',
        propietario: $ana,
        superficiePrimerCuarto: 10.0,
        funcionPrimerCuarto: 'Dormitorio',
        piso: 3,
        tieneAscensor: true,
    );

    $ana->casarseCon($luis);
    $ana->agregarHijo($sofia);
    $luis->agregarHijo($sofia);
    
    $ana->vivirEn($casa);
    $luis->vivirEn($casa);
    $sofia->vivirEn($casa);

    expect($ana->conyuge())->toBe($luis)
        ->and($luis->conyuge())->toBe($ana)
        ->and($ana->hijos())->toContain($sofia)
        ->and($luis->hijos())->toContain($sofia)
        ->and($ana->residencia())->toBe($casa)
        ->and($luis->residencia())->toBe($casa)
        ->and($sofia->residencia())->toBe($casa)
        ->and($ana->propiedades())->toHaveCount(2)
        ->and($ana->propiedades())->toContain($casa, $apartamento)
        ->and($luis->propiedades())->toBeEmpty()
        ->and($casa->propietario())->toBe($ana)
        ->and($apartamento->propietario())->toBe($ana)
        ->and($casa)->toBeInstanceOf(Vivienda::class)
        ->and($apartamento)->toBeInstanceOf(Vivienda::class)
        ->and($casa->cuartos())->toHaveCount(2)
        ->and($dormitorio->vivienda())->toBe($casa)
        ->and($dormitorio->funcion())->toBe('Dormitorio')
        ->and($dormitorio->superficie())->toBe(16.0)
        ->and($casa->tieneJardin())->toBeTrue()
        ->and($casa->esIndividual())->toBeTrue()
        ->and($apartamento->piso())->toBe(3)
        ->and($apartamento->tieneAscensor())->toBeTrue();
});
