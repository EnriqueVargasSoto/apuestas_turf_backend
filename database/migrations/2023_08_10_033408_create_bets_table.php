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
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->enum('result',['pendiente','perdida','ganada'])->default('pendiente');
            $table->float('amount_total_bet');
            $table->float('quota');
            $table->float('amount_total_result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bets');
    }
};
