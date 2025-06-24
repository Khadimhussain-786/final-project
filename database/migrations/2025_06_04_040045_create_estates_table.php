<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->string('area')->nullable();
            $table->string('deposite')->nullable();
            $table->string('rent')->nullable();
            $table->string('number')->nullable();
            $table->unsignedBigInteger('advert_id');
            $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade');   
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
