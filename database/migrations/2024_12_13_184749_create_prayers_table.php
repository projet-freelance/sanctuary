<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrayersTable extends Migration
{
    public function up()
    {
        Schema::create('prayers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('intention');
            $table->string('audio_path')->nullable();
            $table->enum('status', ['en_cours', 'exaucee', 'en_attente'])->default('en_cours');
            $table->string('category')->nullable();
            $table->enum('privacy_level', ['public', 'prive', 'communaute'])->default('public');
            $table->integer('prayer_count')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prayers');
    }
}
