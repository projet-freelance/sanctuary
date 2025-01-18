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
    Schema::table('element_spirituels', function (Blueprint $table) {
        $table->string('category'); // Catégorie (sins, virtues, gifts, fruits)
        $table->string('name'); // Le nom de l'élément
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('element_spirituels', function (Blueprint $table) {
            //
        });
    }
};
