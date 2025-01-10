<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiblicalVersesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    

    public function up()
    {
        Schema::create('biblical_verses', function (Blueprint $table) {
            $table->id();
            $table->string('book');
            $table->integer('chapter');
            $table->integer('verse');
            $table->text('text');
            $table->string('translation')->default('LSG');
            $table->string('audio_path')->nullable();
            $table->string('language')->default('fr');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biblical_verses');
    }
}
