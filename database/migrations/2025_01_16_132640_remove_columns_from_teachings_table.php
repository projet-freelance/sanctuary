<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromTeachingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachings', function (Blueprint $table) {
            // Supprimer les colonnes
            $table->dropColumn(['audio_path', 'video_path','difficulty_level', 'language', 'content']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachings', function (Blueprint $table) {
            // Réajouter les colonnes supprimées
            $table->id();
            $table->string('title'); // Titre de l'enseignement
            $table->text('description')->nullable(); // Description
            $table->string('type'); // Type : audio, texte, vidéo, lien
            $table->string('url')->nullable(); // Lien vers la ressource (fichier ou URL)
            $table->boolean('is_live')->default(false); // Indique si c'est un live
            $table->timestamp('live_start_at')->nullable(); // Date/heure de début du live
            $table->timestamps();
        });
    }
}
