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
        Schema::table('daily_inspections', function (Blueprint $table) {
            $table->text('reason_score')->nullable();
            $table->foreignId('score_update_by')->nullable()->constrained('users', 'id');
            $table->foreignId('approved_by')->nullable()->constrained('users', 'id');
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
        Schema::table('daily_inspections', function (Blueprint $table) {
            $table->dropColumn('reason_score');
            $table->dropColumn('score_update_by');
            $table->dropColumn('approved_by');
        });
        Schema::enableForeignKeyConstraints();
    }
};
