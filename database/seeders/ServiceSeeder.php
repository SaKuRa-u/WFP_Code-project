<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['service_name' => 'Konsultasi Dokter Umum (Offline)', 'description' => 'Pemeriksaan langsung dengan dokter umum di klinik', 'availability' => '09.00 - 17.00', 'price' => 150000, 'category_id' => 1],
            ['service_name' => 'Konsultasi Kesehatan Ringan', 'description' => 'Konsultasi untuk keluhan ringan seperti flu dan demam', 'availability' => '08.00 - 20.00', 'price' => 100000, 'category_id' => 1],
            ['service_name' => 'Konsultasi Spesialis Jantung', 'description' => 'Pemeriksaan dan konsultasi dengan dokter spesialis jantung', 'availability' => '10.00 - 14.00', 'price' => 1200000, 'category_id' => 2],
            ['service_name' => 'Konsultasi Spesialis Anak', 'description' => 'Layanan kesehatan khusus untuk anak', 'availability' => '09.00 - 13.00', 'price' => 900000, 'category_id' => 2],
            ['service_name' => 'Medical Check-up Basic', 'description' => 'Paket pemeriksaan kesehatan dasar', 'availability' => '07.00 - 12.00', 'price' => 750000, 'category_id' => 3],
            ['service_name' => 'Medical Check-up Lengkap', 'description' => 'Pemeriksaan kesehatan menyeluruh dengan berbagai parameter', 'availability' => '07.00 - 11.00', 'price' => 2000000, 'category_id' => 3],
            ['service_name' => 'Tes Darah Lengkap', 'description' => 'Pemeriksaan darah lengkap untuk diagnosis', 'availability' => '08.00 - 15.00', 'price' => 300000, 'category_id' => 4],
            ['service_name' => 'Tes COVID-19 PCR', 'description' => 'Tes PCR untuk deteksi virus COVID-19', 'availability' => '09.00 - 16.00', 'price' => 500000, 'category_id' => 4],
            ['service_name' => 'Chat Dokter 24 Jam', 'description' => 'Layanan chat dengan dokter kapan saja', 'availability' => '24 Jam', 'price' => 75000, 'category_id' => 5],
            ['service_name' => 'Video Call Dokter', 'description' => 'Konsultasi dokter melalui video call', 'availability' => '08.00 - 22.00', 'price' => 200000, 'category_id' => 5],
        ];

        foreach ($services as $s) {
            Service::create($s);
        }
    }
}
