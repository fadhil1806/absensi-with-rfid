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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tendik_id')->index()->nullable()->constrained('tendik')->cascadeOnDelete();
            $table->foreignId('siswa_id')->index()->nullable()->constrained('siswa')->cascadeOnDelete();
            $table->dateTime('jam_masuk')->nullable();
            $table->dateTime('jam_pulang')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
