<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingsTable extends Migration
{
    public function up()
    {
        Schema::create('teachings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('audio_path')->nullable();
            $table->string('video_path')->nullable();
            $table->string('partner_link')->nullable();
            $table->string('category')->nullable();
            $table->integer('duration')->nullable(); // durée en minutes
            $table->enum('difficulty_level', ['debutant', 'intermediaire', 'avance'])->default('debutant');
            $table->string('language')->default('fr');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachings');
    }
}

// 2023_xx_xx_create_site_statistics_table.php
class CreateSiteStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('site_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('total_visitors')->default(0);
            $table->integer('daily_visitors')->default(0);
            $table->integer('page_views')->default(0);
            $table->float('average_session_duration')->nullable();
            $table->string('most_visited_page')->nullable();
            $table->json('peak_hours')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_statistics');
    }
}