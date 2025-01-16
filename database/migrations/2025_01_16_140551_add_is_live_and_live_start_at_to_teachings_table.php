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
        $table->boolean('is_live')->default(false);  // Ajout de la colonne is_live
        $table->timestamp('live_start_at')->nullable(); // Ajout de la colonne live_start_at
    });
}

public function down()
{
    Schema::table('teachings', function (Blueprint $table) {
        $table->dropColumn('is_live'); // Suppression de la colonne is_live
        $table->dropColumn('live_start_at'); // Suppression de la colonne live_start_at
    });
}

};
