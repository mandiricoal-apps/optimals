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
        Schema::create('progress_issue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->nullable()->constrained('issue', 'id');
            $table->dateTime('progress_at')->nullable();
            $table->foreignId('progress_by')->nullable()->constrained('users', 'id');
            $table->text('progress_reason')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->foreignId('closed_by')->nullable()->constrained('users', 'id');
            $table->string('closed_file')->nullable();
            $table->text('closed_reason')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users', 'id');
            $table->text('rejected_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_issue');
    }
};
