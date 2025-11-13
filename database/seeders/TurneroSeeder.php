<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Servicio, Puesto};

class TurneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Servicios disponibles ---
        $servicios = [
            ['codigo' => 'AFI', 'nombre' => 'Afiliaciones', 'tiempo_estimado_seg' => 180],
            ['codigo' => 'ATC', 'nombre' => 'Atención Clientes', 'tiempo_estimado_seg' => 200],
            ['codigo' => 'EM',  'nombre' => 'Emergencias', 'tiempo_estimado_seg' => 120],
            ['codigo' => 'FAC', 'nombre' => 'Facturación', 'tiempo_estimado_seg' => 240],
            ['codigo' => 'REM', 'nombre' => 'Remedios', 'tiempo_estimado_seg' => 150],
        ];

        foreach ($servicios as $s) {
            Servicio::firstOrCreate(['codigo' => $s['codigo']], $s);
        }

        // --- Puestos de atención ---
        Puesto::firstOrCreate([
            'nombre' => 'Módulo 1',
            'servicio_id' => Servicio::where('codigo', 'AFI')->first()->id
        ]);

        Puesto::firstOrCreate([
            'nombre' => 'Módulo 2',
            'servicio_id' => Servicio::where('codigo', 'ATC')->first()->id
        ]);

        // --- Usuarios ---
        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('secret123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'agente@demo.com'],
            [
                'name' => 'Agente de Atención',
                'password' => Hash::make('secret123'),
                'role' => 'agente',
            ]
        );

        User::updateOrCreate(
            ['email' => 'cliente@demo.com'],
            [
                'name' => 'Cliente de Prueba',
                'password' => Hash::make('secret123'),
                'role' => 'publico',
            ]
        );
    }
}
