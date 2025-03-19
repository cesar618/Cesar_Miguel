<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importar DB
use App\Models\Play; // Si usas el modelo Play

class PlaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos a insertar
        $plays = [
            [
                'image'       => 'assets/media/photos/GENERACION-SESAMO.jpg',
                'name'        => 'Generación Sésamo',
                'active'      => true,
                'notes'       => 'el musical original que recupera la figura de Espinete',
                'producer_id' => 1, 
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/EL-ORIGEN-DEL-HIELO.jpg',
                'name'        => 'Frozen',
                'active'      => true,
                'notes'       => 'EL ORIGEN DEL HIELO- TRIBUTO A FROZEN',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/MUSICAL80-90.jpg',
                'name'        => 'Musical 80/90',
                'active'      => true,
                'notes'       => 'El Gran Musical de los 80s 90s',
                'producer_id' => 1, 
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/LA-ISLA-DE-MAUI-POSTER-scaled.jpg',
                'name'        => 'Vaiana',
                'active'      => true,
                'notes'       => 'La Isla de MAUI- Tributo a Vaiana',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/JUEVES-Y-FAMILIA_A3-1-scaled.jpg',
                'name'        => 'Jueves y Familia',
                'active'      => true,
                'notes'       => 'Una Parodia Musical Terrorífica',
                'producer_id' => 1, 
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/EL-TEATRO.DE-LOS-RETOS_POSTER-scaled-jpg',
                'name'        => 'Teatro de los Retos',
                'active'      => true,
                'notes'       => 'El Primer Teatro Interactivo para Jugar en Familia y Guiar a los Personajes con Pruebas en Vivo',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/DE-SIMBA-A-KIARA.jpg',
                'name'        => 'Rey León',
                'active'      => true,
                'notes'       => 'El Rey León – Tributo',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/POSTER-TADEO-JONES-EL-MUSICAL-scaled.jpg',
                'name'        => 'Tadeo Jones',
                'active'      => true,
                'notes'       => 'Tadeo Jones. La Tabla Esmeralda. El Musical',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/ALADDIN.jpg',
                'name'        => 'Aladdin',
                'active'      => true,
                'notes'       => 'La Lámpara Maravillosa-Tributo Aladdin',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/EL-FANTASMA-DE-LA-OPERA-CONCIERTO-MUSICAL-scaled.jpg',
                'name'        => 'Fantasma de la Ópera',
                'active'      => true,
                'notes'       => 'El Fastama de la Ópera–Concierto Musical',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/UNA-OPERA-DE-PELICULA-baja-res-scaled.jpg',
                'name'        => 'Ópera de Película',
                'active'      => true,
                'notes'       => 'Una Ópera de Película-La Mejor Antología de la ópera y de temas líricos conocidos en todo el mundo',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/POSTER-HOTNIGHT-nuevo-scaled.jpg',
                'name'        => 'Hotnight',
                'active'      => true,
                'notes'       => 'Nace en España, el show más picante con las canciones más importantes de la historia del cabaret en Broadway',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'image'       => 'assets/media/photos/RUMBO-A-LOS-2000-2-scaled.jpg',
                'name'        => 'Musical 2000',
                'active'      => true,
                'notes'       => 'El Musical de los 80s 90s 2- Rumbo a los 2000 ',
                'producer_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
        ];

        // Insertar o actualizar datos
        foreach ($plays as $play) {
            // Usamos firstOrCreate para asegurarnos de no duplicar entradas con el mismo 'name'
            Play::firstOrCreate(
                ['name' => $play['name']], // Condición para verificar si ya existe
                $play // Si no existe, creará el registro
            );
        }
    }
}
