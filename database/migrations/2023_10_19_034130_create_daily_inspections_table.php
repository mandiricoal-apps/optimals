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
            $table->float('total_score');
            $table->text('reason_score')->nullable();
            $table->foreignId('score_update_by')->nullable()->constrained('users', 'id');
            $table->foreignId('approved_by')->nullable()->constrained('users', 'id');
            $table->dateTime('approved_at')->nullable();
            $table->softDeletes();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('daily_inspections');
        Schema::enableForeignKeyConstraints();
    }
};
