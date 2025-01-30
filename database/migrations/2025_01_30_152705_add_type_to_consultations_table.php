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
    Schema::table('consultations', function (Blueprint $table) {
        $table->string('type')->nullable(); // Ajoutez cette ligne pour la colonne 'type'
    });
}

public function down()
{
    Schema::table('consultations', function (Blueprint $table) {
        $table->dropColumn('type');
    });
}

};
