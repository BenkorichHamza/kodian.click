<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'percent',
        'amount',
        'startAt',
        'endAt',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
