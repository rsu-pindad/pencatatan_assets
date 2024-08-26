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
        Schema::create('pivot_tipe_merek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipe_id');
            $table->unsignedBigInteger('merek_id');
            $table
                ->foreign('tipe_id')
                ->references('id')
                ->on('tipe')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('merek_id')
                ->references('id')
                ->on('merek')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_tipe_merek');
    }
};
