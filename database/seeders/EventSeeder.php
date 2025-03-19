<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Play;
use App\Models\Location;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name'        => 'Gira Musical 80/90',
                'play_name'   => 'Musical 80/90', // Se usará para buscar el play_id
                'date'        => '2025-03-28',
                'start_time'  => '21:30:00',
                'end_time'    => '23:00:00',
                'description' => 'Los mejores éxitos internacionales y el mejor pop español de los años 80 y 90',
                'url_info'    => 'https://www.taquilla.com/entradas/el-musical-de-los-80s-90s',
                'url_tickets' => 'https://www.taquilla.com/entradas/el-musical-de-los-80s-90s',
                'city'        => 'Cádiz', // Se usará para buscar el location_id
                'street_name' => 'Almirante Pascual Pery', // Se usará para buscar el location_id
                'street_number' => '25', 
            ],
            [
                'name'        => 'Gira Musical 80/90',
                'play_name'   => 'Musical 80/90', // Se usará para buscar el play_id
                'date'        => '2025-03-28',
                'start_time'  => '22:30:00',
                'end_time'    => '00:00:00',
                'description' => 'Los mejores éxitos internacionales y el mejor pop español de los años 80 y 90',
                'url_info'    => 'https://teatreapolo.com/cartelera/el-musical-de-los-80s-90s/',
                'url_tickets' => 'https://teatreapolo.com/cartelera/el-musical-de-los-80s-90s/',
                'city'        => 'Barcelona', // Se usará para buscar el location_id
                'street_name' => 'del Paral·le', // Se usará para buscar el location_id
                'street_number' => '59', 
            ],
            [
                'name'        => 'Gira Musical 80/90',
                'play_name'   => 'Musical 80/90', // Se usará para buscar el play_id
                'date'        => '2025-03-29',
                'start_time'  => '22:30:00',
                'end_time'    => '00:00:00',
                'description' => 'Los mejores éxitos internacionales y el mejor pop español de los años 80 y 90',
                'url_info'    => 'https://teatreapolo.com/cartelera/el-musical-de-los-80s-90s/',
                'url_tickets' => 'https://teatreapolo.com/cartelera/el-musical-de-los-80s-90s/',
                'city'        => 'Barcelona', // Se usará para buscar el location_id
                'street_name' => 'del Paral·le', // Se usará para buscar el location_id
                'street_number' => '59', 
            ],
            [
                'name'        => 'Gira Vaiana',
                'play_name'   => 'Vaiana', // Se usará para buscar el play_id
                'date'        => '2025-03-29',
                'start_time'  => '17:00:00',
                'end_time'    => '19:00:00',
                'description' => 'Un encantador musical familiar que rinde homenaje a la película Vaiana. ',
                'url_info'    => 'https://www.onbeatproducciones.com/project/la-isla-de-maui-tributo-a-vaiana/',
                'url_tickets' => 'https://www.tomaticket.es/es-es/entradas-la-isla-de-maui-tributo-a-vaiana-en-penarroya',
                'city'        => 'Peñarroya-Pueblonuevo', // Se usará para buscar el location_id
                'street_name' => 'Peñas Rojas', // Se usará para buscar el location_id
                'street_number' => '34', 
            ],
            [
                'name'        => 'Gira Vaiana',
                'play_name'   => 'Vaiana', // Se usará para buscar el play_id
                'date'        => '2025-03-30',
                'start_time'  => '17:00:00',
                'end_time'    => '19:00:00',
                'description' => 'Un encantador musical familiar que rinde homenaje a la película Vaiana. ',
                'url_info'    => 'https://www.onbeatproducciones.com/project/la-isla-de-maui-tributo-a-vaiana/',
                'url_tickets' => 'https://www.giglon.com/todos?idEvent=la-isla-de-maui-tributo-a-vaiana-guadix',
                'city'        => 'Guadix', // Se usará para buscar el location_id
                'street_name' => 'la Constitución', // Se usará para buscar el location_id
                'street_number' => 's/n', 
            ],
            [
                'name'        => 'Gira Teatro de los Retos',
                'play_name'   => 'Teatro de los Retos', // Se usará para buscar el play_id
                'date'        => '2025-03-29',
                'start_time'  => '18:00:00',
                'end_time'    => '20:00:00',
                'description' => 'El Primer Teatro Interactivo para Jugar en Familia y Guiar a los Personajes con Pruebas en Vivo',
                'url_info'    => 'https://www.onbeatproducciones.com/project/el-teatro-de-los-retos/',
                'url_tickets' => 'https://odeonmulticines.com/odeon-leon/producto/el-teatro-de-los-retos-teatro-musical',
                'city'        => 'León', // Se usará para buscar el location_id
                'street_name' => 'País Leonés', // Se usará para buscar el location_id
                'street_number' => 's/n', 
            ],
            [
                'name'        => 'Gira Teatro de los Retos',
                'play_name'   => 'Teatro de los Retos', // Se usará para buscar el play_id
                'date'        => '2025-03-30',
                'start_time'  => '18:00:00',
                'end_time'    => '20:00:00',
                'description' => 'El Primer Teatro Interactivo para Jugar en Familia y Guiar a los Personajes con Pruebas en Vivo',
                'url_info'    => 'https://www.onbeatproducciones.com/project/el-teatro-de-los-retos/',
                'url_tickets' => 'https://odeonmulticines.com/odeon-cuenca/producto/el-teatro-de-los-retos-teatro-musical',
                'city'        => 'Cuenca', // Se usará para buscar el location_id
                'street_name' => 'Tarancón', // Se usará para buscar el location_id
                'street_number' => 's/n', 
            ],
            [
                'name'        => 'Gira Generación Sésamo',
                'play_name'   => 'Generación Sésamo', // Se usará para buscar el play_id
                'date'        => '2025-03-29',
                'start_time'  => '18:00:00',
                'end_time'    => '20:00:00',
                'description' => 'el musical original que recupera la figura de Espinete',
                'url_info'    => 'https://www.onbeatproducciones.com/project/generacion-sesamo/',
                'url_tickets' => 'https://odeonmulticines.com/odeon-girona/producto/generacion-sesamo-teatro-musical',
                'city'        => 'Salt', // Se usará para buscar el location_id
                'street_name' => 'del Cralins', // Se usará para buscar el location_id
                'street_number' => '10', 
            ],
            [
                'name'        => 'Gira Generación Sésamo',
                'play_name'   => 'Generación Sésamo', // Se usará para buscar el play_id
                'date'        => '2025-03-30',
                'start_time'  => '18:00:00',
                'end_time'    => '20:00:00',
                'description' => 'el musical original que recupera la figura de Espinete',
                'url_info'    => 'https://www.onbeatproducciones.com/project/generacion-sesamo/',
                'url_tickets' => 'https://odeonmulticines.com/odeon-vilanova/producto/generacion-sesamo-teatro-musical',
                'city'        => 'Vilanova i la Geltrú', // Se usará para buscar el location_id
                'street_name' => 'de la Calç', // Se usará para buscar el location_id
                'street_number' => 's/n', 
            ],
            [
                'name'        => 'Gira Temporada Jueves',
                'play_name'   => 'Jueves y Familia', // Se usará para buscar el play_id
                'date'        => '2025-03-29',
                'start_time'  => '12:00:00',
                'end_time'    => '14:00:00',
                'description' => 'Una Parodia Musical Terrorífica',
                'url_info'    => 'https://www.onbeatproducciones.com/project/jueves-y-familia-un-musical-terrorifico/',
                'url_tickets' => 'https://gruposmedia.com/cartelera/jueves-y-familia-el-musical/',
                'city'        => 'Madrid', // Se usará para buscar el location_id
                'street_name' => 'Gran Vía', // Se usará para buscar el location_id
                'street_number' => '66', 
            ],
            [
                'name'        => 'Gira Temporada Jueves',
                'play_name'   => 'Jueves y Familia', // Se usará para buscar el play_id
                'date'        => '2025-03-30',
                'start_time'  => '12:00:00',
                'end_time'    => '14:00:00',
                'description' => 'Una Parodia Musical Terrorífica',
                'url_info'    => 'https://www.onbeatproducciones.com/project/jueves-y-familia-un-musical-terrorifico/',
                'url_tickets' => 'https://gruposmedia.com/cartelera/jueves-y-familia-el-musical/',
                'city'        => 'Madrid', // Se usará para buscar el location_id
                'street_name' => 'Gran Vía', // Se usará para buscar el location_id
                'street_number' => '66', 
            ],
            [
                'name'        => 'Gira Rey León',
                'play_name'   => 'Rey León', // Se usará para buscar el play_id
                'date'        => '2025-03-29',
                'start_time'  => '19:00:00',
                'end_time'    => '21:00:00',
                'description' => 'El Rey León – Tributo',
                'url_info'    => 'https://www.onbeatproducciones.com/project/el-rey-leon-el-tributo/',
                'url_tickets' => 'https://donticket.com/entradas/tributo-al-rey-leon-177',
                'city'        => 'Palma del Río', // Se usará para buscar el location_id
                'street_name' => 'Pío XII',
                'street_number' => '21', 
            ],
            [
                'name'        => 'Gira Tadeo Jones',
                'play_name'   => 'Tadeo Jones', // Se usará para buscar el play_id
                'date'        => '2025-03-30',
                'start_time'  => '20:00:00',
                'end_time'    => '22:00:00',
                'description' => 'Tadeo Jones. La Tabla Esmeralda. El Musical',
                'url_info'    => 'https://www.onbeatproducciones.com/project/tadeojones-elmusical/#tadeoinfo',
                'url_tickets' => 'https://www.onbeatproducciones.com/project/tadeojones-elmusical/',
                'city'        => 'Aznalcóllar', // Se usará para buscar el location_id
                'street_name' => 'Sevilla', 
                'street_number' => '17', 
            ],
        ];

        foreach ($events as $event) {
            // Buscar el play_id por nombre
            $play = Play::where('name', $event['play_name'])->first();
            $play_id = $play ? $play->id : null;
        
            // Buscar el location_id por ciudad, nombre de la calle y número de calle
            $location = Location::where('city', $event['city'])
                                ->where('street_name', $event['street_name'])
                                ->where('street_number', $event['street_number'])
                                ->first();
            $location_id = $location ? $location->id : null;
        
            // Insertar el evento evitando duplicados
            Event::firstOrCreate(
                ['name' => $event['name'], 'date' => Carbon::parse($event['date'])],
                [
                    'play_id'     => $play_id,
                    'date'        => Carbon::parse($event['date']),
                    'start_time'  => $event['start_time'],
                    'end_time'    => $event['end_time'],
                    'description' => $event['description'],
                    'url_info'    => $event['url_info'],
                    'url_tickets' => $event['url_tickets'],
                    'location_id' => $location_id,
                ]
            );
        }
        
    }
}

