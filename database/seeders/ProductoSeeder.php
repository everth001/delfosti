<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'sku' => 'SK15974T1T',
            'nombre' => 'Arroz',
            'tipo' => 'Grano',
            'etiqueta' => 'Alimento Básico',
            'precio' => '5',
            'unidad_medida' => 'kg'
        ]);

        Producto::create([
            'sku' => 'SK15974T2T',
            'nombre' => 'Lentejas',
            'tipo' => 'Grano',
            'etiqueta' => 'Alimento Básico',
            'precio' => '15',
            'unidad_medida' => 'kg'
        ]);

        Producto::create([
            'sku' => 'SK64894T2T',
            'nombre' => 'Atún',
            'tipo' => 'Conserva',
            'etiqueta' => 'Pescado',
            'precio' => '3',
            'unidad_medida' => 'lata'
        ]);

        Producto::create([
            'sku' => 'SK78941T3T',
            'nombre' => 'Aceite',
            'tipo' => 'Aceite',
            'etiqueta' => 'Condimento',
            'precio' => '12',
            'unidad_medida' => 'ltr'
        ]);
    }
}
