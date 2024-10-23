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
        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_id');
            $table->string('prefix_aset');
            $table->string('nama_aset');
            $table->date('tanggal_perolehan');
            $table->double('nilai_perolehan', 12, 2);
            $table->unsignedBigInteger('satuan_id');
            $table->decimal('jumlah', 4, 0);
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('pivot_tipe_merek_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('image_aset')->nullable();
            $table
                ->foreign('kode_id')
                ->references('id')
                ->on('kode')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('satuan_id')
                ->references('id')
                ->on('satuan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('vendor_id')
                ->references('id')
                ->on('vendor')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('pivot_tipe_merek_id')
                ->references('id')
                ->on('pivot_tipe_merek')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('unit_id')
                ->references('id')
                ->on('unit')
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
        Schema::dropIfExists('aset');
    }
};
