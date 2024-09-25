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
        Schema::create('data_card_alert', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('card_id', 100);
            $table->unsignedBigInteger(column: 'data_card_id')->nullable();
            $table->foreign(columns: 'data_card_id')->references('id')->on(table: 'data_card')->cascadeOnDelete();
            $table->enum('status', ['terdaftar', 'tidak terdaftar'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_card_alert');
    }
};
