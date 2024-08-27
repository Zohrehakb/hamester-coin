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
        Schema::create('boosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->integer('total_coin')->default(0);
            $table->integer('total_energy')->default(100);
            $table->integer('earn_per_tap')->default(2);
            $table->integer('charge_energy')->default(100);
            $table->integer('buy_tap')->default(15);
            $table->integer('buy_energy')->default(20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boosts');
    }
};
