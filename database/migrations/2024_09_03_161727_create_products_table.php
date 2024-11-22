<?php

use App\Models\Brand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("nameAr")->unique();
            $table->foreignIdFor(Brand::class)->nullOnDelete();
            $table->text("description");
            $table->text("descriptionAr");
            $table->integer("price");
            $table->integer("discount")->nullable();
            $table->double("max")->nullable();
            $table->double("min")->nullable();
            $table->double("step")->nullable();
            $table->string("unit")->nullable();
            $table->boolean("isInteger");
            $table->boolean("isFeatured")->nullable();
            $table->boolean("isAvailable")->nullable();
            $table->boolean("isSponsored")->nullable();
            $table->boolean("isNew")->nullable();
            $table->boolean("isRelated")->nullable();
            $table->boolean("inputPrice");
            $table->string("img")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
