<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiblicalGamesTable extends Migration
{
    public function up()
    {
        Schema::create('biblical_games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['quiz', 'competition', 'aventure'])->default('quiz');
            $table->integer('difficulty_level')->default(1);
            $table->integer('max_players')->nullable();
            $table->integer('reward_points')->default(0);
            $table->timestamps();
        });

        Schema::create('game_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('biblical_game_id');
            $table->integer('score')->default(0);
            $table->time('time_taken')->nullable();
            $table->integer('rank')->nullable();
            $table->json('badges_earned')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('biblical_game_id')->references('id')->on('biblical_games')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_scores');
        Schema::dropIfExists('biblical_games');
    }
}