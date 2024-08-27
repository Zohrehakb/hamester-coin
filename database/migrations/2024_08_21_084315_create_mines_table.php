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
        Schema::create('mines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ارتباط با جدول کاربران
            $table->integer('total_coin')->default(0);
            $table->integer('profit')->default(0);
            $table->integer('card1')->default(25);
            $table->integer('card2')->default(30);
            $table->integer('card3')->default(35);
            $table->integer('card4')->default(40);
            $table->integer('card5')->default(45);
            $table->integer('card6')->default(13);
            $table->integer('card7')->default(18);
            $table->integer('card8')->default(23);
            $table->integer('card9')->default(28);
            $table->integer('card10')->default(33);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mines');
    }
};
