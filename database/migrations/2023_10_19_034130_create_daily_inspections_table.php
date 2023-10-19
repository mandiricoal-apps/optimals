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
        Schema::create('daily_inspections', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->foreignId('create_by')->constrained('users', 'id');
            $table->foreignId('area_id')->constrained('area', 'id');
            $table->integer('total_score');
            $table->dateTime('approved_at')->nullable();
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
        Schema::dropIfExists('daily_inspections');
    }
};
