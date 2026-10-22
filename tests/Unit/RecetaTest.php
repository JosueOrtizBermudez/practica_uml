<?php

use App\Models\Ingrediente;
use App\Models\Receta;

test('una receta contiene ingredientes con su cantidad y unidad de medida', function () {
    $harina = new Ingrediente('Harina');
    $leche = new Ingrediente('Leche');

   
    $receta = new Receta(
        titulo: 'Panqueques',
        porciones: 4,
        instrucciones: 'Mezclar los ingredientes y cocinar en una sartén.',
        primerIngrediente: $harina,
        cantidad: 200.0,
        unidadMedida: 'gramos',
    );

    $detalleLeche = $receta->agregarIngrediente($leche, 250.0, 'mililitros');

    expect($receta->titulo())->toBe('Panqueques')
        ->and($receta->porciones())->toBe(4)
        ->and($receta->ingredientes())->toHaveCount(2)
        ->and($receta->ingredientes()[0]->ingrediente())->toBe($harina)
        ->and($receta->ingredientes()[0]->cantidad())->toBe(200.0)
        ->and($receta->ingredientes()[0]->unidadMedida())->toBe('gramos')
        ->and($detalleLeche->receta())->toBe($receta)
        ->and($detalleLeche->ingrediente())->toBe($leche)
        ->and($detalleLeche->cantidad())->toBe(250.0)
        ->and($detalleLeche->unidadMedida())->toBe('mililitros');
});

test('el mismo ingrediente admite distintas cantidades en distintas recetas', function () {
    $harina = new Ingrediente('Harina');

    $pan = new Receta('Pan', 6, 'Amasar y hornear.', $harina, 500.0, 'gramos');
    $galletas = new Receta('Galletas', 8, 'Mezclar y hornear.', $harina, 300.0, 'gramos');

    expect($pan->ingredientes()[0]->ingrediente())->toBe($harina)
        ->and($galletas->ingredientes()[0]->ingrediente())->toBe($harina)
        ->and($pan->ingredientes()[0]->cantidad())->toBe(500.0)
        ->and($galletas->ingredientes()[0]->cantidad())->toBe(300.0);
});
