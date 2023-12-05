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
        Schema::create('data_location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_id')->constrained('daily_inspections', 'id');
            $table->string('image');
            $table->string('pit', 20)->nullable();
            $table->integer('blok_start')->nullable();
            $table->integer('blok_end')->nullable();
            $table->integer('strip_start')->nullable();
            $table->integer('strip_end')->nullable();
            $table->text('seam')->nullable();
            $table->integer('rl')->nullable();
            $table->text('no_unit')->nullable();
            $table->text('disposal')->nullable();
            $table->text('sump')->nullable();
            $table->string('nama_jalan')->nullable();
            $table->text('segmen')->nullable();
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
        Schema::dropIfExists('data_location');
    }
};
