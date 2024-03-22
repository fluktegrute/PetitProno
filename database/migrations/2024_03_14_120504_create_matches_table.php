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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id');
            $table->dateTime('date');
            $table->string('stage')->nullable();
            $table->string('group')->nullable();
            $table->integer('home_team');
            $table->integer('away_team');
            $table->string('winner')->nullable();
            $table->integer('home_goals');
            $table->integer('away_goals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
