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
            $table->dropColumn(['intention', 'status', 'category', 'privacy_level',]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prayers', function (Blueprint $table) {
            $table->text('intention')->nullable();
            $table->enum('status', ['en_cours', 'exaucee', 'en_attente'])->default('en_cours');
            $table->string('category')->nullable();
            $table->enum('privacy_level', ['public', 'prive', 'communaute']);
        });
    }
};
