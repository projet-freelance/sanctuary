<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaintsTable extends Migration
{
    public function up()
    {
        Schema::create('saints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('feast_day')->nullable();
            $table->text('biography')->nullable();
            $table->string('patronage')->nullable();
            $table->text('prayer')->nullable();
            $table->string('audio_path')->nullable();
            $table->string('image_path')->nullable();
            $table->string('historical_period')->nullable();
            $table->timestamps();
        });

        Schema::create('user_saint_favourites', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('saint_id');
            $table->primary(['user_id', 'saint_id']);
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('saint_id')->references('id')->on('saints')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_saint_favourites');
        Schema::dropIfExists('saints');
    }
}