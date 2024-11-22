<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = [
        'name',
        'nameAr',
        'wilaya_id',
        'img'
    ];
    use HasFactory;

    public function wilaya(){
        return $this->belongsTo(Wilaya::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }
}
