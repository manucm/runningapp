<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaActividadesTipoYCamposEnCarreras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_tipo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->timestamps();
        });

        Schema::table('carreras', function (Blueprint $table) {
            $table->boolean('favorito')->default(0);
            $table->integer('calorias')->default(0);
            $table->integer('actividad_tipo_id')->nullable()->unsigned();
            $table->integer('ritmo_medio')->default(0)->unsigned();
            $table->integer('mejor_ritmo')->default(0)->unsigned();
            $table->integer('altura_perdida')->default(0)->unsigned();
            $table->integer('ganancia_altura')->default(0)->unsigned();

            $table->foreign('actividad_tipo_id')
                  ->on('actividades_tipo')
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
        Schema::table('carreras', function(Blueprint $table) {
            $table->dropForeign(['actividad_tipo_id']);
            $table->dropColumn([
                'favorito',
                'calorias',
                'actividad_tipo_id',
                'ritmo_medio',
                'mejor_ritmo',
                'altura_perdida',
                'ganancia_altura',
            ]);
        });

        Schema::dropIfExists('actividades_tipo');
    }
}
