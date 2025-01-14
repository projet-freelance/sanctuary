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
    Schema::table('prayers', function (Blueprint $table) {
        $table->string('prayer_type')->after('privacy_level'); // Ajoutez après la colonne 'privacy_level'
    });
}

public function down()
{
    Schema::table('prayers', function (Blueprint $table) {
        $table->dropColumn('prayer_type');
    });
}

};
