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
        // Schema::table('players', function (Blueprint $table) {
        //     $table
        //         ->foreign('id')
        //         ->references('id')
        //         ->on('fights')
        //         ->onUpdate('CASCADE')
        //         ->onDelete('CASCADE');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('players', function (Blueprint $table) {
        //     $table->dropForeign(['id']);
        // });
    }
};
