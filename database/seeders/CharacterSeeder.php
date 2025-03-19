<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;
use App\Models\Play;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $characters = [
            ['name' => 'Espinete', 'play' => 'Generación Sésamo', 'image' => 'assets/media/photos/ESPINETE.jpg'],
            ['name' => 'Chema', 'play' => 'Generación Sésamo', 'image' => ''],
            ['name' => 'Ana', 'play' => 'Generación Sésamo', 'image' => ''],
            ['name' => 'Clara', 'play' => 'Generación Sésamo', 'image' => ''],
            ['name' => 'Gema', 'play' => 'Generación Sésamo', 'image' => ''],
            ['name' => 'Amanda', 'play' => 'Generación Sésamo', 'image' => ''],
            ['name' => 'Jose', 'play' => 'Musical 80/90', 'image' => ''],
            ['name' => 'Ismael', 'play' => 'Musical 80/90', 'image' => ''],
            ['name' => 'Quique', 'play' => 'Musical 80/90', 'image' => ''],
            ['name' => 'Tania', 'play' => 'Musical 80/90', 'image' => ''],
            ['name' => 'Sofia', 'play' => 'Musical 80/90', 'image' => ''],
            ['name' => 'Lola', 'play' => 'Musical 80/90', 'image' => ''],
            ['name' => 'Nieves', 'play' => 'Frozen', 'image' => ''],
            ['name' => 'Blanca', 'play' => 'Frozen', 'image' => ''],
            ['name' => 'Molaf', 'play' => 'Frozen', 'image' => ''],
            ['name' => 'Tomás', 'play' => 'Frozen', 'image' => ''],
            ['name' => 'Cristobal', 'play' => 'Frozen', 'image' => ''],
            ['name' => 'Bailarina1', 'play' => 'Frozen', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarina2', 'play' => 'Frozen', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Maui', 'play' => 'Vaiana', 'image' => 'assets/media/photos/MAUI.webp'],
            ['name' => 'Moana', 'play' => 'Vaiana', 'image' => 'assets/media/photos/MOANA.jpg'],
            ['name' => 'Abuela', 'play' => 'Vaiana', 'image' => 'assets/media/photos/ABUELA_MOANA.jpg'],
            ['name' => 'Diosa Nat/Van', 'play' => 'Vaiana', 'image' => 'assets/media/photos/DIOSA.webp'],
            ['name' => 'Bailarina1', 'play' => 'Vaiana', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarina2', 'play' => 'Vaiana', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Jueves', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Madre', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Padre', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Directora', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Marina', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Serena', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Rosa', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Drapaudi', 'play' => 'Jueves y Familia', 'image' => ''],
            ['name' => 'Profesor', 'play' => 'Teatro de los Retos', 'image' => ''],
            ['name' => 'Ayudante P', 'play' => 'Teatro de los Retos', 'image' => ''],
            ['name' => 'Cantante', 'play' => 'Teatro de los Retos', 'image' => ''],
            ['name' => 'Risis', 'play' => 'Teatro de los Retos', 'image' => ''],
            ['name' => 'Simba', 'play' => 'Rey León', 'image' => 'assets/media/photos/SIMBA.webp'],
            ['name' => 'Nala', 'play' => 'Rey León', 'image' => 'assets/media/photos/SIMBA.webp'],
            ['name' => 'Scar', 'play' => 'Rey León', 'image' => 'assets/media/photos/SIMBA.webp'],
            ['name' => 'Flo', 'play' => 'Rey León', 'image' => 'assets/media/photos/SIMBA.webp'],
            ['name' => 'Dilla', 'play' => 'Rey León', 'image' => 'assets/media/photos/SIMBA.webp'],
            ['name' => 'Bailarina1', 'play' => 'Rey León', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarina2', 'play' => 'Rey León', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarina3', 'play' => 'Rey León', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Jirafa', 'play' => 'Rey León', 'image' => 'assets/media/photos/jirafa.jpg'],
            ['name' => 'Tadeo', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/TADEO.webp'],
            ['name' => 'Sara', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/TADEO.webp'],
            ['name' => 'Momia', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/Sara.webp'],
            ['name' => 'Ramona', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/RAMONA.jpg'],
            ['name' => 'Victoria', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/VICTORIA.jpg'],
            ['name' => 'Bailarina1', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarina2', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarín1', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/BAILARIN.png'],
            ['name' => 'Bailarín2', 'play' => 'Tadeo Jones', 'image' => 'assets/media/photos/BAILARIN.png'],
            ['name' => 'Aladdin', 'play' => 'Aladdin', 'image' => 'assets/media/photos/ALADDIN.jpg'],
            ['name' => 'Genio', 'play' => 'Aladdin', 'image' => 'assets/media/photos/GENIO.webp'],
            ['name' => 'Jasmin', 'play' => 'Aladdin', 'image' => 'assets/media/photos/JASMIN.webp'],
            ['name' => 'Bailarina1', 'play' => 'Aladdin', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarina2', 'play' => 'Aladdin', 'image' => 'assets/media/photos/BAILARINA.png'],
            ['name' => 'Bailarín1', 'play' => 'Aladdin', 'image' => 'assets/media/photos/BAILARIN.png'],
            ['name' => 'Bailarín2', 'play' => 'Aladdin', 'image' => 'assets/media/photos/BAILARIN.png'],
        ];

        foreach ($characters as $character) {
            $play = Play::where('name', $character['play'])->first();

            if ($play) {
                Character::firstOrCreate(
                    ['name' => $character['name'], 'play_id' => $play->id],
                    ['notes' => '', 'image' => $character['image'], 'created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }
}

