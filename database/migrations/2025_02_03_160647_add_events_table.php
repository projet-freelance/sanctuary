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
        Schema::table('events', function (Blueprint $table) {
            // Suppression des colonnes qui posent problème (existant avec conflit)
            if (Schema::hasColumn('events', 'ticket_price')) {
                $table->dropColumn('ticket_price');
            }

            if (Schema::hasColumn('events', 'available_seats')) {
                $table->dropColumn('available_seats');
            }

            // Ajout des nouvelles colonnes manquantes
            if (!Schema::hasColumn('events', 'ticket_price_new')) {
                $table->decimal('ticket_price_new', 10, 2)->after('location');
            }

            if (!Schema::hasColumn('events', 'available_seats_new')) {
                $table->integer('available_seats_new')->after('ticket_price_new');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Suppression des nouvelles colonnes en cas de rollback
            if (Schema::hasColumn('events', 'ticket_price_new')) {
                $table->dropColumn('ticket_price_new');
            }

            if (Schema::hasColumn('events', 'available_seats_new')) {
                $table->dropColumn('available_seats_new');
            }

            // Réajout des anciennes colonnes (si nécessaire)
            if (!Schema::hasColumn('events', 'ticket_price')) {
                $table->decimal('ticket_price', 8, 2)->after('location');
            }

            if (!Schema::hasColumn('events', 'available_seats')) {
                $table->integer('available_seats')->after('ticket_price');
            }
        });
    }
};
