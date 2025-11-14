<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Puesto;

class PuestoSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            Puesto::updateOrCreate(
                ['id' => $i],
                [
                    'codigo' => "M$i",
                    'nombre' => "Módulo $i"
                ]
            );
        }
    }
}
