<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function wilaya(){
        return $this->belongsTo(Wilaya::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }
}
