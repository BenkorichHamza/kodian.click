<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


protected $fillable = [
    'name',
    'nameAr',
    'description',
    'descriptionAr',
    'img',
    'order',
    'parentId'
];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parentId');
    }



}
