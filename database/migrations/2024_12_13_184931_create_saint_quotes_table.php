<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaintQuotesTable extends Migration
{
    public function up()
    {
        Schema::create('saint_quotes', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->string('author');
            $table->text('context')->nullable();
            $table->string('language')->default('fr');
            $table->string('spiritual_theme')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('saint_quotes');
    }
}
