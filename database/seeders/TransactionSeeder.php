<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $services = Service::all();

        foreach (range(1, 10) as $i) {

            $user = $users->random();

            // pilih random service
            $randomServices = $services->random(rand(1, 3));

            // hitung total
            $total = $randomServices->sum('price');

            // buat transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total' => $total,
            ]);

            // attach services ke pivot
            $transaction->services()->attach(
                $randomServices->pluck('id')->toArray()
            );
        }
    }
}