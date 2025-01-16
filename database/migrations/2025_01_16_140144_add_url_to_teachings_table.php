<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('teachings', function (Blueprint $table) {
        $table->string('url')->nullable(); // Ajout de la colonne url
    });
}

public function down()
{
    Schema::table('teachings', function (Blueprint $table) {
        $table->dropColumn('url');
    });
}

};
