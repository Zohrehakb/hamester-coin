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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->integer('total_coin')->default(0);
            $table->integer('total_energy')->default(100);
            $table->integer('earn_per_tap')->default(2);
            $table->integer('coin_to_level_up')->default(200);
            $table->integer('current_level')->default(0);
            $table->integer('max_level')->default(10);
            $table->integer('charge_energy')->default(100);
            $table->integer('buy_tap')->default(15);
            $table->integer('buy_energy')->default(20);
            $table->integer('profit')->default(0);
            $table->integer('daily_reward')->default(1);
            $table->timestamp('last_reward_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');

    }
};
