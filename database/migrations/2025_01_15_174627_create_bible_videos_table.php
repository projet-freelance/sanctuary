<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibleVideosTable extends Migration
{
    public function up()
    {
        Schema::create('bible_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre de la vidéo
            $table->string('url');   // URL de la vidéo
            $table->text('description')->nullable(); // Description facultative
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bible_videos');
    }
}
