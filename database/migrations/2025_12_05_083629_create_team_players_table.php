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
        Schema::create('team_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->unsignedBigInteger('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('order_by')->default(1);
            $table->timestamps();

            $table->unique(['player_id','team_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_players');
    }
};
