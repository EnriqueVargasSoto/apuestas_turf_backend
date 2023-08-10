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
        Schema::create('bet_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bet_id')->constrained();
            $table->foreignId('event_id')->constrained();
            $table->float('amount_bet');
            $table->float('amount_result');
            $table->string('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bet_event');
    }
};
