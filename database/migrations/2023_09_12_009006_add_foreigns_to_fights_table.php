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
        Schema::table('fights', function (Blueprint $table) {
            $table
                ->foreign('stage_id')
                ->references('id')
                ->on('stages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('round_id')
                ->references('id')
                ->on('rounds')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('opponent1_id')
                ->references('id')
                ->on('participants')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('opponent2_id')
                ->references('id')
                ->on('participants')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fights', function (Blueprint $table) {
            $table->dropForeign(['stage_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['round_id']);
            $table->dropForeign(['opponent1_id']);
            $table->dropForeign(['opponent2_id']);
        });
    }
};
