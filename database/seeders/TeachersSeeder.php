<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            [
                'identity_document' => 12345678,
                'subject_id'        => 1,
                'names'             => 'José Joaquín ',
                'lastnames'         => 'Ávila Portalatín',
                'gender'            => 'M',
                'slug'              => 'jose-joaquin-avila-portalatin-12345678',
                'created_at'        => now(),
            ],
            [
                'identity_document' => 15987456,
                'subject_id'        => 2,
                'names'             => 'María Alejandra',
                'lastnames'         => 'Bracho Silva',
                'gender'            => 'F',
                'slug'              => 'maria-alejandra-bracho-silva-15987456',
                'created_at'        => now(),
            ],
            [
                'identity_document' => 14223564,
                'subject_id'        => 3,
                'names'             => 'José Gregorio',
                'lastnames'         => 'Urdaneta Marín',
                'gender'            => 'M',
                'slug'              => 'jose-gregorio-urdaneta-marin-14223564',
                'created_at'        => now(),
            ],
            [
                'identity_document' => 18556231,
                'subject_id'        => null,
                'names'             => 'Ana Karina',
                'lastnames'         => 'Villalobos Ferrer',
                'gender'            => 'F',
                'slug'              => 'ana-karina-villalabos-ferrer-18556231',
                'created_at'        => now(),
            ],
            [
                'identity_document' => 11223445,
                'subject_id'        => 4,
                'names'             => 'Luis Alberto',
                'lastnames'         => 'Chacín Rincón',
                'gender'            => 'M',
                'slug'              => 'luis-alberto-chacin-rincon-11223445',
                'created_at'        => now(),
            ],
            [
                'identity_document' => 20112334,
                'subject_id'        => null,
                'names'             => 'Elena del Carmen',
                'lastnames'         => 'Prieto Rosales',
                'gender'            => 'F',
                'slug'              => 'elena-del-carmen-prieto-rosales-20112334',
                'created_at'        => now(),
            ],
            [
                'identity_document' => 16778990,
                'subject_id'        => 5,
                'names'             => 'Ricardo Javier',
                'lastnames'         => 'Colina Méndez',
                'gender'            => 'M',
                'slug'              => 'ricardo-javier-colina-mendez-16778990',
                'created_at'        => now(),
            ],
        ]);
    }
}
