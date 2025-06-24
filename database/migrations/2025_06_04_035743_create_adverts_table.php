<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('price')->nullable();
            $table->string('email')->nullable();
            $table->boolean('chat')->default(false);
            $table->boolean('noemail')->default(false);
            $table->string('subject')->nullable();
            $table->string('text')->nullable();
            $table->boolean('type')->default(false);
            $table->string('maker')->nullable();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('category_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
