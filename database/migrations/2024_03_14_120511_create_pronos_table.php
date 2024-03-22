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
        Schema::create('pronos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('match_id');
            $table->boolean('booster_used')->default(false);
            $table->integer('home_team_goals');
            $table->integer('away_team_goals');
            $table->boolean('is_won')->nullable();
            $table->boolean('is_exact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pronos');
    }
};
