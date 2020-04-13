<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objetId');
            $table->string('name');
            $table->foreignId('produit_menager');
            $table->foreignId('outil_menager');
            $table->integer('quantite_produit_restant');
            $table->integer('quantite_outil_restant');
            $table->dateTime('dernier_lavage', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('robots');
    }
}
