<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model
{
    use SoftDeletes;

    protected $fillable = ['service_name', 'description', 'availability', 'price', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
