<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteViewsTable extends Migration
{
    public function up()
    {
        Schema::create('sites_views', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('url')->nullable(); // Optionnel si vous voulez enregistrer l'URL visitée
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sites_views');
    }
}
