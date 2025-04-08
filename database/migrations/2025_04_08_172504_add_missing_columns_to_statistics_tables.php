<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Vérifie et crée la table 'statistics' si elle n'existe pas
        if (!Schema::hasTable('statistics')) {
            Schema::create('statistics', function (Blueprint $table) {
                $table->id();
                $table->string('page')->index();
                $table->date('date')->index();
                $table->integer('visits')->unsigned()->default(0);
                $table->timestamps();
                $table->unique(['page', 'date']);
            });
        }

        // Vérifie et crée la table 'statistic_visitors' si elle n'existe pas
        if (!Schema::hasTable('statistic_visitors')) {
            Schema::create('statistic_visitors', function (Blueprint $table) {
                $table->id();
                $table->foreignId('statistic_id')->constrained('statistics')->onDelete('cascade');
                $table->string('visitor_hash');
                $table->integer('visit_count')->unsigned()->default(1);
                $table->timestamps();
                $table->unique(['statistic_id', 'visitor_hash']);
            });
        }

        // Vérifie et crée la table 'page_views' si elle n'existe pas
        if (!Schema::hasTable('page_views')) {
            Schema::create('page_views', function (Blueprint $table) {
                $table->id();
                $table->string('url');
                $table->string('visitor_ip')->nullable();
                $table->timestamp('viewed_at')->useCurrent();
            });
        }

        // ➕ Ajoute d’autres tables si besoin avec le même principe
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
        Schema::dropIfExists('statistic_visitors');
        Schema::dropIfExists('statistics');
    }
};
