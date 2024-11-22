<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    protected $fillable = [
        'name',
        'nameAr',
        "code",
        "longitude",
        "latitude",
        'img'
    ];
    use HasFactory;

    public function communes(){
        return $this->hasMany(Commune::class);
    }
}
