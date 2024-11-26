<?php

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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('titleAr')->nullable();
            $table->text('description')->nullable();
            $table->text('descriptionAr')->nullable();
            $table->integer('percent')->nullable();
            $table->integer('amount')->nullable();
            $table->date('startAt')->nullable();
            $table->date('endAt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
