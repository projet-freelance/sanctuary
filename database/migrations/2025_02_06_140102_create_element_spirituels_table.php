<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementSpirituelsTable extends Migration
{
    public function up()
    {
        Schema::create('element_spirituels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->enum('type', ['peche', 'vertu', 'don', 'fruit']);
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('element_spirituels');
    }
}

