<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AniadirCamposACarreras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicaciones_externas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 60);
        });

        Schema::table('carreras', function (Blueprint $table) {
            $table->bigInteger('codigoAlternativo')->nullable()->unsigned();
            $table->integer('aplicacion_id')->unsigned()->nullable();
            $table->foreign('aplicacion_id')
                  ->on('aplicaciones_externas')
                  ->references('id')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('carreras', function (Blueprint $table) {
            $table->dropForeign(['aplicacion_id']);
            $table->dropColumn(['aplicacion_id', 'codigoAlternativo']);
        });

        Schema::dropIfExists('aplicaciones_externas');
    }
}
