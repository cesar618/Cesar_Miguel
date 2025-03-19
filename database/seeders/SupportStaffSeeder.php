<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupportStaff; // Asegúrate de importar el modelo correcto

class SupportStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = [
            ['first_name' => 'Hugo', 'last_name' => '.', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'David', 'last_name' => 'León', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Edwin', 'last_name' => '.', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Salva', 'last_name' => 'Martínez', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Miquel', 'last_name' => 'Tur', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Antoni', 'last_name' => 'Font', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Diseño luces'],
            ['first_name' => 'Elisabet', 'last_name' => 'Molet', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => true, 'can_drive' => true, 'active' => true, 'notes' => 'Road Manager'],
            ['first_name' => 'Cristofer', 'last_name' => '.', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Jaime', 'last_name' => '.', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Juan', 'last_name' => '.', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Hugo', 'last_name' => '.', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Daniel', 'last_name' => 'Romero', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
            ['first_name' => 'Gerald', 'last_name' => 'Gimeno', 'phone' => '', 'email' => '', 'city' => '', 'has_car' => false, 'can_drive' => false, 'active' => true, 'notes' => 'Técnico'],
        ];

        foreach ($staff as $member) {
            SupportStaff::firstOrCreate(
                ['first_name' => $member['first_name'], 'last_name' => $member['last_name']], // Evita duplicados basándose en nombre y apellido
                $member
            );
        }
    }
}
