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
        Schema::create('data_card', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('card_id', 100);
            $table->unsignedBigInteger(column: 'tendik_id')->nullable();
            $table->unsignedBigInteger(column: 'siswa_id')->nullable();
            $table->foreign(columns: 'siswa_id')->references('id')->on(table: 'siswa')->cascadeOnDelete();
            $table->foreign(columns: 'tendik_id')->references('id')->on(table: 'tendik')->cascadeOnDelete();
            $table->enum('status', ['tendik', 'siswa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_card');
    }
};
