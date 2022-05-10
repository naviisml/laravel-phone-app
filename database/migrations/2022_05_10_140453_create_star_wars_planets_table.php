<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_wars_planets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('climate');
            $table->string('diameter');
            $table->string('gravity');
            $table->string('orbital_period');
            $table->string('population');
            $table->string('rotation_period');
            $table->string('surface_water');
            $table->string('terrain');
            $table->string('url')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('star_wars_planets');
    }
};
