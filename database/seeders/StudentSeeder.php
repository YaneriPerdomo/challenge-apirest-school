<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'name'                       => 'Yaneri Paola',
                'lastname'                   => 'Perdomo Barrios',
                'gender'                     => 'F',
                'identity_document'          => 31048726,
                'mother_s_identity_document' => 12345678,
                'birth'                      => '2021-06-26',
                'slug'                       => 'yaneri-paola-perdomo-barrios-31048726',
                'created_at'                 => now(),
            ],
            [
                'name'                       => 'Erika Andreina',
                'lastname'                   => 'Salcedo Ochoa',
                'gender'                     => 'F',
                'identity_document'          => 232234,
                'mother_s_identity_document' => 87654321,
                'birth'                      => '2022-02-09',
                'slug'                       => 'erika-andreina-salcedo-ochoa-232234',
                'created_at'                 => now(),
            ],
            [
                'name'                       => 'Maikol José',
                'lastname'                   => 'Bracho Mendoza',
                'gender'                     => 'M',
                'identity_document'          => null,
                'mother_s_identity_document' => 15223445,
                'birth'                      => '2020-11-15',
                'slug'                       => 'maikol-bracho-bracho-mendoza-15223445',
                'created_at'                 => now(),
            ],
        ]);
    }
}
