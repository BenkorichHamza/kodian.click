<?php

use App\Models\Wilaya;
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
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("nameAr");
            $table->string("img")->nullable();
            $table->double("latitude")->nullable();
            $table->double("longitude")->nullable();
            $table->foreignIdFor(Wilaya::class,'wilaya_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
