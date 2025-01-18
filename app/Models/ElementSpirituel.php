<?php
// app/Models/ElementSpirituel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementSpirituel extends Model
{
    protected $fillable = ['nom', 'type', 'description'];
    
    const TYPE_PECHE = 'peche';
    const TYPE_VERTU = 'vertu';
    const TYPE_DON = 'don';
    const TYPE_FRUIT = 'fruit';
}

// database/migrations/xxxx_xx_xx_create_elements_spirituels_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsSpirituelsTable extends Migration
{
    public function up()
    {
        Schema::create('elements_spirituels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type'); // peche, vertu, don, fruit
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('elements_spirituels');
    }
}