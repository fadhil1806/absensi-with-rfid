<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tendik_id')->index()->nullable()->constrained('tendik')->cascadeOnDelete();
            $table->foreignId('siswa_id')->index()->nullable()->constrained('siswa')->cascadeOnDelete();
            $table->string('jenis_izin');
            $table->time('jam_mulai')->nullable();
            $table->time('jam_berakhir')->nullable();
            $table->text('keterangan');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin');
    }
};
