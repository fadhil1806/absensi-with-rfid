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
        Schema::create('pramuka', function (Blueprint $table) {
            $table->id();
            $table->string('pelatih');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->string('kelas');
            $table->string('materi');
            $table->string('hadir');
            $table->string('sakit');
            $table->string('izin');
            $table->string('alpa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pramuka');
    }
};
