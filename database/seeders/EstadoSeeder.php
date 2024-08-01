<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['nombre' => 'Por atender', 'created_at' => now()],
            ['nombre' => 'En proceso', 'created_at' => now()],
            ['nombre' => 'En delivery', 'created_at' => now()],
            ['nombre' => 'Recibido', 'created_at' => now()],
        ];

        Estado::insert($estados);
    }
}
