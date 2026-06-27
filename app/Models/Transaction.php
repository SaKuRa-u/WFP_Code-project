<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'doctor_id', 'total', 'status', 'scheduled_at'];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // Member yang booking
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Dokter yang menangani
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Layanan yang dipilih
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    // Pesan konsultasi
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
