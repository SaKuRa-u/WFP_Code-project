<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'General Consultation',
                'image' => 'general_consultation.jpg'
            ],
            [
                'category_name' => 'Specialist Consultation',
                'image' => 'specialist_consultation.jpg'
            ],
            [
                'category_name' => 'Medical Check-up',
                'image' => 'medical_check.jpg'
            ],
            [
                'category_name' => 'Laboratory Tests',
                'image' => 'lab_test.jpg'
            ],
            [
                'category_name' => 'Telemedicine',
                'image' => 'telemedicine.jpg'
            ],
        ]);
    }
}
