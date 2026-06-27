<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;


class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Transaksi dari data lama
        // user_id 1-7 di DB lama = admin1,admin2 + 5 member
        // Di DB baru: admin(id=1,2), doctor(id=3-9), member(id=10-14)
        // Mapping user lama -> pakai email sebagai acuan
        $userMap = [
            1 => User::where('email', 'admin1@staff.com')->first()->id,
            2 => User::where('email', 'admin2@staff.com')->first()->id,
            3 => User::where('email', 'stehr.rasheed@example.org')->first()->id,
            4 => User::where('email', 'gussie.brakus@example.net')->first()->id,
            5 => User::where('email', 'kailyn50@example.net')->first()->id,
            6 => User::where('email', 'pbotsford@example.net')->first()->id,
            7 => User::where('email', 'cayla.rippin@example.com')->first()->id,
        ];

        $doctors = User::where('role', 'doctor')->get();

        $transactions = [
            ['user_id' => 5, 'doctor_id' => $doctors[0]->id, 'total' => 2150000, 'status' => 'completed', 'scheduled_at' => '2025-01-10 09:00:00', 'services' => [1, 6]],
            ['user_id' => 5, 'doctor_id' => $doctors[1]->id, 'total' => 600000, 'status' => 'completed', 'scheduled_at' => '2025-01-12 10:00:00', 'services' => [2, 8]],
            ['user_id' => 4, 'doctor_id' => $doctors[2]->id, 'total' => 1650000, 'status' => 'active',   'scheduled_at' => '2026-06-26 09:00:00', 'services' => [4, 5]],
            ['user_id' => 7, 'doctor_id' => $doctors[0]->id, 'total' => 375000, 'status' => 'active',   'scheduled_at' => '2026-06-26 13:00:00', 'services' => [2, 9]],
            ['user_id' => 3, 'doctor_id' => $doctors[3]->id, 'total' => 300000, 'status' => 'pending',  'scheduled_at' => '2026-06-27 08:00:00', 'services' => [7]],
            ['user_id' => 2, 'doctor_id' => $doctors[1]->id, 'total' => 150000, 'status' => 'pending',  'scheduled_at' => '2026-06-27 10:00:00', 'services' => [1]],
            ['user_id' => 6, 'doctor_id' => $doctors[4]->id, 'total' => 100000, 'status' => 'completed', 'scheduled_at' => '2025-03-05 14:00:00', 'services' => [2]],
            ['user_id' => 7, 'doctor_id' => $doctors[2]->id, 'total' => 3400000, 'status' => 'completed', 'scheduled_at' => '2025-04-01 09:00:00', 'services' => [4, 6, 8]],
            ['user_id' => 4, 'doctor_id' => $doctors[5]->id, 'total' => 750000, 'status' => 'completed', 'scheduled_at' => '2025-05-10 11:00:00', 'services' => [5]],
            ['user_id' => 1, 'doctor_id' => $doctors[6]->id, 'total' => 3350000, 'status' => 'completed', 'scheduled_at' => '2025-06-01 08:00:00', 'services' => [1, 3, 6]],
        ];

        foreach ($transactions as $t) {
            $trx = Transaction::create([
                'user_id'      => $userMap[$t['user_id']],
                'doctor_id'    => $t['doctor_id'],
                'total'        => $t['total'],
                'status'       => $t['status'],
                'scheduled_at' => $t['scheduled_at'],
            ]);
            $trx->services()->attach($t['services']);
        }
    }
}
