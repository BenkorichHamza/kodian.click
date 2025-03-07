<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
}
