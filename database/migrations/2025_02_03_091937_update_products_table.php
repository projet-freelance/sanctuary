<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('image_path', 'image'); // Renommez image_path en image
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('image', 'image_path'); // Annulez le changement
        });
    }
}