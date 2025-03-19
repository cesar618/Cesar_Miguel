<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor; // Asegúrate de tener este modelo en tu aplicación
use Illuminate\Support\Facades\DB;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actors = [
            ['first_name' => 'Celia', 'last_name' => 'Juarez', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Paula', 'last_name' => 'Cuesta', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Fran', 'last_name' => 'Caparrós', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Jose Carlos', 'last_name' => 'Palao', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Rodrigo', 'last_name' => 'Domínguez', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Clara', 'last_name' => 'Herrera', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Mimi', 'last_name' => 'Muelas', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Tábata', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Mireia', 'last_name' => 'Coma', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Jose', 'last_name' => 'Tejado', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Pedro', 'last_name' => 'Ordoñez', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Gabriela', 'last_name' => 'Mutti', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Ángeles', 'last_name' => 'Vela', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Ana', 'last_name' => 'González', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Lucía', 'last_name' => 'Guzmán', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Luna', 'last_name' => 'Ramol', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Cristina', 'last_name' => 'López', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Marcos', 'last_name' => 'Horcajo', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Rachel', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Ariadna', 'last_name' => 'Figuero', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Ana', 'last_name' => 'Aquino', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Estela', 'last_name' => 'Lluch', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'María', 'last_name' => 'Ortega', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Guille', 'last_name' => 'Guillado', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Albert', 'last_name' => 'Artigas', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Adria', 'last_name' => 'Andreu', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Ana', 'last_name' => 'Extremera', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Nerea', 'last_name' => 'Royo', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Elena', 'last_name' => 'Moreno', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Elisabet', 'last_name' => 'Molet', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Nize', 'last_name' => 'Crespo', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Laia', 'last_name' => 'Sors', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Carla', 'last_name' => 'Zafra', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Txell', 'last_name' => 'Gilabert', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Paula', 'last_name' => 'Parada', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Max', 'last_name' => 'Navarro', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Nacho', 'last_name' => 'Escudero', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Alba', 'last_name' => 'Solsona', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Samantha', 'last_name' => 'Sánchez', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Ione', 'last_name' => 'Díaz', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Sergio', 'last_name' => 'Peiró', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Yeifren', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Melanie', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Ángel', 'last_name' => 'Morales', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Mario', 'last_name' => 'Leiva', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Diana', 'last_name' => 'Tobar', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Daniel', 'last_name' => 'Romero', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Elena', 'last_name' => 'Cencerrado', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Marta', 'last_name' => 'Sango', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Lucía', 'last_name' => 'Lozano', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Carla', 'last_name' => 'Herrera', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Alma', 'last_name' => 'Reyk', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Helena', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Gina', 'last_name' => 'Daniela', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Alexandra', 'last_name' => 'Argelaguer', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Renato', 'last_name' => 'Cortina', 'has_car' => 1, 'can_drive' => 1, 'active' => 1],
            ['first_name' => 'Berta', 'last_name' => 'Mola', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Celia', 'last_name' => 'Saldaña', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Denise', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Cristina', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Sergio', 'last_name' => 'Lobo', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Daniel', 'last_name' => 'Reiz Borrero', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
            ['first_name' => 'Imanol', 'last_name' => '.', 'has_car' => 0, 'can_drive' => 0, 'active' => 1],
     
            // Agrega más actores según sea necesario
        ];

        foreach ($actors as $actor) {
            Actor::firstOrCreate(
                ['first_name' => $actor['first_name'], 'last_name' => $actor['last_name']], // Condición para evitar duplicados
                [
                    'phone'      => '',    // Lo dejamos vacío como pediste
                    'email'      => '',    // Lo dejamos vacío
                    'city'       => '',    // Lo dejamos vacío
                    'notes'      => '',    // Lo dejamos vacío
                    'has_car'    => $actor['has_car'],
                    'can_drive'  => $actor['can_drive'],
                    'active'     => $actor['active'],
                    'image'      => '',    // Lo dejamos vacío
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
