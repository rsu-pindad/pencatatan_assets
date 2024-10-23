<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->dropForeign('aset_pivot_tipe_merek_id_foreign');
            $table->unsignedBigInteger('pivot_tipe_merek_id')->nullable()->default(null)->change();
            $table
                ->foreign('pivot_tipe_merek_id')
                ->references('id')
                ->on('pivot_tipe_merek')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->dropForeign('aset_pivot_tipe_merek_id_foreign');
            $table->unsignedBigInteger('pivot_tipe_merek_id')->change();
            $table
                ->foreign('pivot_tipe_merek_id')
                ->references('id')
                ->on('pivot_tipe_merek')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
};
