<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            'Jantung',
            'Umum',
            'Kulit dan Kelamin',
            'Saraf',
            'Anak',
            'Tulang dan Ortopedi',
            'Penyakit Dalam',
            'Mata',
            'THT',
            'Kandungan dan Kebidanan',
            'Bedah Umum',
            'Paru',
            'Gigi',
            'Urologi',
            'Rehabilitasi Medik',
            'Kedokteran Jiwa',
        ];

        foreach ($specializations as $name) {
            Specialization::create([
                'name' => $name,
            ]);
        }
    }
}
