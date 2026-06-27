<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SpecializationSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ArticleSeeder::class); // kosong dulu, siap diisi

        // Admin (dari data lama)
        User::factory()->admin()->create(['name' => 'admin1', 'email' => 'admin1@staff.com']);
        User::factory()->admin()->create(['name' => 'admin2', 'email' => 'admin2@staff.com']);

        // Dokter (gabungan dari tabel doctors lama)
        $specializations = Specialization::all()->keyBy('name');

        $doctorsData = [
            ['name' => 'Dr. Andi Saputra',  'email' => 'andi@hospital.com',  'phone' => '081234567001', 'spec' => 'Umum'],
            ['name' => 'Dr. Budi Santoso',  'email' => 'budi@hospital.com',  'phone' => '081234567002', 'spec' => 'Jantung'],
            ['name' => 'Dr. Citra Lestari', 'email' => 'citra@hospital.com', 'phone' => '081234567003', 'spec' => 'Anak'],
            ['name' => 'Dr. Dedi Pratama',  'email' => 'dedi@hospital.com',  'phone' => '081234567004', 'spec' => 'Kulit dan Kelamin'],
            ['name' => 'Dr. Eka Wijaya',    'email' => 'eka@hospital.com',   'phone' => '081234567005', 'spec' => 'Saraf'],
            ['name' => 'Dr. Farah Nabila',  'email' => 'farah@hospital.com', 'phone' => '081234567006', 'spec' => 'Gigi'],
            ['name' => 'Dr. Galih Prakoso', 'email' => 'galih@hospital.com', 'phone' => '081234567007', 'spec' => 'Tulang dan Ortopedi'],
        ];

        foreach ($doctorsData as $d) {
            $doctor = User::factory()->doctor()->create([
                'name'  => $d['name'],
                'email' => $d['email'],
                'phone' => $d['phone'],
            ]);
            $doctor->specializations()->attach($specializations[$d['spec']]->id);
        }

        // Member (dari data lama)
        $members = [
            ['name' => 'Lou Hamill Jr.',    'email' => 'stehr.rasheed@example.org'],
            ['name' => 'Ashtyn Bartoletti', 'email' => 'gussie.brakus@example.net'],
            ['name' => 'Prof. Nichole Hoeger', 'email' => 'kailyn50@example.net'],
            ['name' => 'Mazie Miller',      'email' => 'pbotsford@example.net'],
            ['name' => 'Will Rice',         'email' => 'cayla.rippin@example.com'],
        ];

        foreach ($members as $m) {
            User::factory()->create(['name' => $m['name'], 'email' => $m['email']]);
        }

        $this->call(TransactionSeeder::class);
    }
}
