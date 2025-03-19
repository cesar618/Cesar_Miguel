<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Producer; // Importar el modelo Producer

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos a insertar
        $producers = [
            [
                'name'       => 'On Beat Producciones',
                'cif'        => 'B09837055',
                'image'      => 'assets/media/photos/OnbeatNegativo.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Insertar solo si no existe un productor con el mismo 'cif' usando Eloquent
        foreach ($producers as $producer) {
            Producer::firstOrCreate(
                ['cif' => $producer['cif']], // Condición de búsqueda por el campo 'cif'
                $producer // Datos a insertar si no existe
            );
        }
    }
}


