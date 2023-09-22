<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('round_id')->nullable();
            $table->unsignedBigInteger('opponent1_id')->nullable();
            $table->unsignedBigInteger('opponent2_id')->nullable();
            $table->unsignedBigInteger('opponent1_score')->nullable();
            $table->string('opponent1_result')->nullable();
            $table->unsignedBigInteger('opponent2_score')->nullable();
            $table->string('opponent2_result')->nullable();
            $table->unsignedInteger('bracket_position')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fights');
    }
};
