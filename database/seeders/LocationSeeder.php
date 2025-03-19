<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location; // Asegúrate de tener este modelo en tu aplicación
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'city' => 'Madrid', 
                'province' => 'Madrid', 
                'region' => 'Comunidad de Madrid', 
                'street_type' => 'Calle', 
                'street_name' => 'Gran Vía', 
                'street_number' => '66', 
                'postal_code' => '28013', 
                'url_map' => 'hhttps://g.co/kgs/27HTpsY', 
                'phone' => '915415569', 
                'active' => 1,
                'notes' => 'Teatro EDP Madrid' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Arroyomolinos', 
                'province' => 'Madrid', 
                'region' => 'Comunidad de Madrid', 
                'street_type' => 'Calle', 
                'street_name' => 'Madrid', 
                'street_number' => '25', 
                'postal_code' => '28939', 
                'url_map' => 'https://maps.app.goo.gl/dxrK6fXbGq53xeBi6', 
                'phone' => '916899862', 
                'active' => 1,
                'notes' => 'Auditorium Municipal de Arroyomolinos' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Tres Cantos', 
                'province' => 'Madrid', 
                'region' => 'Comunidad de Madrid', 
                'street_type' => 'Avenida', 
                'street_name' => 'de los Labradores', 
                'street_number' => '9', 
                'postal_code' => '28760', 
                'url_map' => 'https://g.co/kgs/moRZbyq', 
                'phone' => '918038828', 
                'active' => 1,
                'notes' => 'Odeon Multicines ' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Aranjuez', 
                'province' => 'Madrid', 
                'region' => 'Comunidad de Madrid', 
                'street_type' => 'Calle', 
                'street_name' => 'San Antonio', 
                'street_number' => '68', 
                'postal_code' => '28300', 
                'url_map' => 'https://maps.app.goo.gl/cKGg9cvSg4pxXm869?g_st=com.google.maps.preview.copy', 
                'phone' => '918929111', 
                'active' => 1,
                'notes' => 'Teatro Real Carlos III de Aranjuez' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Trasona', 
                'province' => 'Asturias', 
                'region' => 'Asturias', 
                'street_type' => 'Calle', 
                'street_name' => 'Pedrero', 
                'street_number' => '50', 
                'postal_code' => '33468', 
                'url_map' => 'https://maps.app.goo.gl/frtbTQr7oWnN1GGS8?g_st=com.google.maps.preview.copy', 
                'phone' => '985514612', 
                'active' => 1,
                'notes' => 'Odeón Multicies Trasona (C.C. Parque Astur)' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Palma del Río', 
                'province' => 'Córdoba', 
                'region' => 'Andalucía', 
                'street_type' => 'Avenida', 
                'street_name' => 'Pío XII', 
                'street_number' => '21', 
                'postal_code' => '14700', 
                'url_map' => 'https://maps.app.goo.gl/dqXu3dg5nqmuDK6cA?g_st=com.google.maps.preview.copy', 
                'phone' => '957710245', 
                'active' => 1,
                'notes' => 'Teatro Coliseo Palma del Río' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Peñarroya-Pueblonuevo', 
                'province' => 'Córdoba', 
                'region' => 'Andalucía', 
                'street_type' => 'Calle', 
                'street_name' => 'Peñas Rojas', 
                'street_number' => '34', 
                'postal_code' => '14200', 
                'url_map' => 'https://maps.app.goo.gl/fmUc3g9cbzxazPbb7?g_st=com.google.maps.preview.copy', 
                'phone' => '', 
                'active' => 1,
                'notes' => 'Casa de la Cultura Peñarroya' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Aznalcóllar', 
                'province' => 'Sevilla', 
                'region' => 'Andalucía', 
                'street_type' => 'Calle', 
                'street_name' => 'Sevilla', 
                'street_number' => '17', 
                'postal_code' => '41870', 
                'url_map' => 'https://maps.app.goo.gl/4PQFXnuZECV76bJz6?g_st=com.google.maps.preview.copy', 
                'phone' => '954133015', 
                'active' => 1,
                'notes' => 'Teatro Municipal Aznalcóllar' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Sevilla', 
                'province' => 'Sevilla', 
                'region' => 'Andalucía', 
                'street_type' => 'Calle', 
                'street_name' => 'Juan Ramón Jiménez', 
                'street_number' => '22', 
                'postal_code' => '41011', 
                'url_map' => 'https://maps.app.goo.gl/HU16gdzmTuSSJGUU9?g_st=com.google.maps.preview.copy', 
                'phone' => '747856387', 
                'active' => 1,
                'notes' => 'Teatro los Remedios' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Almería', 
                'province' => 'Almería', 
                'region' => 'Andalucía', 
                'street_type' => 'Calle', 
                'street_name' => 'Poeta Villaespesa', 
                'street_number' => '1', 
                'postal_code' => '04001', 
                'url_map' => 'https://maps.app.goo.gl/msbEx2FjP36uECp89?g_st=com.google.maps.preview.copy', 
                'phone' => '650030303', 
                'active' => 1,
                'notes' => 'Teatro Cervantes Almería' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Cádiz', 
                'province' => 'Cádiz', 
                'region' => 'Andalucía', 
                'street_type' => 'Paseo', 
                'street_name' => 'Almirante Pascual Pery', 
                'street_number' => '25', 
                'postal_code' => '11004', 
                'url_map' => 'https://maps.app.goo.gl/8Ta87vq8KewdUwc69?g_st=com.google.maps.preview.copy', 
                'phone' => '660580486', 
                'active' => 1,
                'notes' => 'Momart Theatre Cádiz' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Los Barrios', 
                'province' => 'Cádiz', 
                'region' => 'Andalucía', 
                'street_type' => 'Plaza', 
                'street_name' => 'Palomones N-340', 
                'street_number' => 's/n', 
                'postal_code' => '11379', 
                'url_map' => 'https://maps.app.goo.gl/HU16gdzmTuSSJGUU9?g_st=com.google.maps.preview.copy', 
                'phone' => '956676401', 
                'active' => 1,
                'notes' => 'Odeón Multicines C.C. Bahía Plaza' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'León', 
                'province' => 'León', 
                'region' => 'Castilla y León', 
                'street_type' => 'Avenida', 
                'street_name' => 'País Leones', 
                'street_number' => 's/n', 
                'postal_code' => '24010', 
                'url_map' => 'https://maps.app.goo.gl/5USKP8SLjavVDkT99?g_st=com.google.maps.preview.copy', 
                'phone' => '987228182', 
                'active' => 1,
                'notes' => 'Odeón Multicines León' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Vilanova i la Geltrú', 
                'province' => 'Barcelona', 
                'region' => 'Cataluña', 
                'street_type' => 'Carrer', 
                'street_name' => 'de la Calç', 
                'street_number' => 's/n', 
                'postal_code' => '08800', 
                'url_map' => 'https://maps.app.goo.gl/rn8KKfBVtNkgo1FV9?g_st=com.google.maps.preview.copy', 
                'phone' => '934846614', 
                'active' => 1,
                'notes' => 'Odeón Multicines Vilanova' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Barcelona', 
                'province' => 'Barcelona', 
                'region' => 'Cataluña', 
                'street_type' => 'Avenida', 
                'street_name' => 'del Paral·le', 
                'street_number' => '59', 
                'postal_code' => '08004', 
                'url_map' => 'https://g.co/kgs/Bw8a4CQ', 
                'phone' => '934599939', 
                'active' => 1,
                'notes' => 'Teatro Apolo Barcelona' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Salt', 
                'province' => 'Girona', 
                'region' => 'Cataluña', 
                'street_type' => 'Camí', 
                'street_name' => 'dels Carlins', 
                'street_number' => '10', 
                'postal_code' => '17190', 
                'url_map' => 'https://maps.app.goo.gl/2VtfNJPoGitrnUoP9?g_st=com.google.maps.preview.copy', 
                'phone' => '', 
                'active' => 1,
                'notes' => 'Odeón Multicines Girona (C.C. Espai Gironés)' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Guadix', 
                'province' => 'Granada', 
                'region' => 'Andalucía', 
                'street_type' => 'Plaza', 
                'street_name' => 'la Constitución', 
                'street_number' => 's/n', 
                'postal_code' => '18500', 
                'url_map' => 'https://maps.app.goo.gl/ss7kszAg9PXM2SN4A?g_st=com.google.maps.preview.copy', 
                'phone' => '958662995', 
                'active' => 1,
                'notes' => 'Teatro Municipal Mira de Amescua' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Pulianas', 
                'province' => 'Granada', 
                'region' => 'Andalucía', 
                'street_type' => 'Calle', 
                'street_name' => 'Billy Wilder', 
                'street_number' => 's/n', 
                'postal_code' => '18197', 
                'url_map' => 'https://maps.app.goo.gl/yQ7vGN8XvTcDfMA56?g_st=com.google.maps.preview.copy', 
                'phone' => '958189000', 
                'active' => 1,
                'notes' => 'Kinepolis C.C Granaita' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Verín', 
                'province' => 'Ourense', 
                'region' => 'Galicia', 
                'street_type' => 'Camino', 
                'street_name' => 'Balneario de Sousas', 
                'street_number' => 's/n', 
                'postal_code' => '32600', 
                'url_map' => 'https://maps.app.goo.gl/gJg7V6pBonYuC85D9?g_st=com.google.maps.preview.copy', 
                'phone' => '988305157', 
                'active' => 1,
                'notes' => 'Auditorio de Verín' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Narón', 
                'province' => 'A Coruña', 
                'region' => 'Galicia', 
                'street_type' => 'Rúa', 
                'street_name' => 'Cataluña', 
                'street_number' => 's/n', 
                'postal_code' => '15570', 
                'url_map' => 'https://maps.app.goo.gl/gJg7V6pBonYuC85D9?g_st=com.google.maps.preview.copy', 
                'phone' => '', 
                'active' => 1,
                'notes' => 'Oeon Multicines C.C. Odeón' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Carballiño', 
                'province' => 'Ourense', 
                'region' => 'Galicia', 
                'street_type' => 'Avenida', 
                'street_name' => 'Balneario', 
                'street_number' => '28', 
                'postal_code' => '32500', 
                'url_map' => 'https://maps.app.goo.gl/mu8PUFuEAxdvk1z48?g_st=com.google.maps.preview.copy', 
                'phone' => '', 
                'active' => 1,
                'notes' => 'Auditorio Municipal de Carballño' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Alicante', 
                'province' => 'Alicante', 
                'region' => 'Comunidad Valenciana', 
                'street_type' => 'Avenida', 
                'street_name' => 'de Denia', 
                'street_number' => 's/n', 
                'postal_code' => '03016', 
                'url_map' => 'https://maps.app.goo.gl/75yXSrs7BuYwJK6s8?g_st=com.google.maps.preview.copy', 
                'phone' => '', 
                'active' => 1,
                'notes' => 'Kinepolis C.C. Plaza Mar 2' // Aquí asignamos un valor a 'notes'
            ],
            [
                'city' => 'Cuenca', 
                'province' => 'Cuenca', 
                'region' => 'Castilla La Mancha', 
                'street_type' => 'Calle', 
                'street_name' => 'Tarancón', 
                'street_number' => 's/n', 
                'postal_code' => '16003', 
                'url_map' => 'https://maps.app.goo.gl/dFKL2VVZa4XymodV9', 
                'phone' => '', 
                'active' => 1,
                'notes' => 'Odeon Multicines Cuenca' // Aquí asignamos un valor a 'notes'
            ],
                        // Añadir más ubicaciones según sea necesario
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate(
                ['street_name' => $location['street_name'], 'street_number' => $location['street_number']], // Evita duplicados basándose en la calle y número
                [
                    'city' => $location['city'],
                    'province' => $location['province'],
                    'region' => $location['region'],
                    'street_type' => $location['street_type'],
                    'postal_code' => $location['postal_code'],
                    'url_map' => $location['url_map'],
                    'phone' => $location['phone'],
                    'active' => $location['active'],
                    'notes' => $location['notes'],  // Asignamos el valor a 'notes'
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
