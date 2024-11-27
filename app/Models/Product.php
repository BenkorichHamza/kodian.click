<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "name","nameAr","description","descriptionAr","price","discount",'img','unit','isInteger','isAvailable',"isFeatured","isSponsored","brand_id","inputPrice","max","min","step","code","barcode"
    ];




    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }



}
