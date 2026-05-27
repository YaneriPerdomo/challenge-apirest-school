<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            [
                'name'        => 'Matemáticas',
                'description' => 'Álgebra, geometría y resolución de problemas logicos.',
                'slug'        => 'matematicas',
                'created_at'  => now(),
            ],
            [
                'name'        => 'Castellano',
                'description' => 'Gramática, literatura, comprensión lectora y ortografía.',
                'slug'        => 'castellano',
                'created_at'  => now(),
            ],
            [
                'name'        => 'Ciencias Naturales',
                'description' => 'Estudio de la naturaleza, biología celular y ecosistemas.',
                'slug'        => 'ciencias',
                'created_at'  => now(),
            ],
            [
                'name'        => 'Ciencias Sociales',
                'description' => 'Historia, geografía nacional y formación ciudadana.',
                'slug'        => 'ciencias-sociales',
                'created_at'  => now(),
            ],
            [
                'name'        => 'Inglés',
                'description' => 'Vocabulario básico, gramática y expresiones conversacionales.',
                'slug'        => 'ingles',
                'created_at'  => now(),
            ],
        ]);
    }
}
