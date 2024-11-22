<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
$inputPrice=$this->faker->boolean(20);
$min=$inputPrice?$this->faker->numberBetween(1,20)*5:$this->faker->numberBetween(1,10)*0.2;
        return [
            "name"=>$this->faker->sentence(3),
            "nameAr"=>$this->faker->sentence(3),
            "description"=>$this->faker->paragraph(3),
            "descriptionAr"=>$this->faker->paragraph(3),
            "price"=>$this->faker->numberBetween(1,500)*5,
            "step"=>$inputPrice?$this->faker->numberBetween(1,4)*10:1,
            "max"=>$min+$this->faker->numberBetween(1,$inputPrice? 200:20)*5,
            "min"=>$min,
            "discount"=>$this->faker->numberBetween(0,10)*5,
            "unit"=>$this->faker->randomElement(["kg","g","ml","l","units"]),
            "isInteger"=>$inputPrice?true:$this->faker->boolean(),
            "isAvailable"=>$this->faker->boolean(),
            "isFeatured"=>$this->faker->boolean(30),
            "isRelated"=>$this->faker->boolean(30),
            "inputPrice"=>$inputPrice,
            "img"=>'https://picsum.photos/200/200?image='.rand(1,100),
            "brand_id"=>Brand::pluck('id')->random(),        ];
    }
}


