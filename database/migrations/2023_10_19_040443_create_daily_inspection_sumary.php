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
        Schema::create('daily_inspection_summary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_id')->constrained('daily_inspections', 'id');
            $table->foreignId('question_id')->constrained('question', 'id');
            $table->foreignId('answer_id')->constrained('question', 'id');
            $table->integer('score');
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
        Schema::dropIfExists('daily_inspection_summary');
    }
};
