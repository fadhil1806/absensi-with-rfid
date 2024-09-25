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
        Schema::create('platform_merdeka_mengajar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tendik_id')->index()->nullable()->constrained('tendik')->cascadeOnDelete();
            $table->string('topik');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->text('hasil');
            $table->string('sertifikat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_merdeka_mengajar');
    }
};
