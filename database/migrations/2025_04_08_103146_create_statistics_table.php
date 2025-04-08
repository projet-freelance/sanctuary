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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('page')->index();
            $table->integer('visits')->unsigned()->default(0);
            $table->date('date')->index();
            $table->timestamps();
        });
        
        Schema::create('statistic_visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('statistic_id')->constrained()->cascadeOnDelete();
            $table->string('visitor_hash'); // hash de l'IP ou user_id
            $table->integer('visit_count')->unsigned()->default(1);
            $table->timestamps();
            
            $table->unique(['statistic_id', 'visitor_hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
