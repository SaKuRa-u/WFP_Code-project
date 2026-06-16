<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_name',
        'image'
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'id');
    }
}
