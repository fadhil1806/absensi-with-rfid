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
        Schema::create('jurnal_agenda_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tendik_id')->index()->nullable()->constrained('tendik')->cascadeOnDelete();
            $table->string('mapel');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->string('kelas');
            $table->string('materi');
            $table->string('hadir');
            $table->string('sakit');
            $table->string('izin');
            $table->string('alpa');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_agenda_kelas');
    }
};
