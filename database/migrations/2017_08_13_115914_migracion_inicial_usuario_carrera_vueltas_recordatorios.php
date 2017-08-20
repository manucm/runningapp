<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modelos\Estadistica;
use App\Modelos\Usuario;

class MigracionInicialUsuarioCarreraVueltasRecordatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 40);
            $table->string('apellidos', 100);
            $table->string('usuario', 40);
            $table->string('email')->unique();
            $table->boolean('administrador')->default(0);
            $table->string('password');
            $table->string('slug');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('estadisticas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned()->unique();
            $table->integer('totalCarreras')->unsigned()->default(0);
            $table->decimal('distanciaRecorrida', 12, 2)->unsigned()->default(0.00);
            $table->decimal('tiempo', 12, 2)->unsigned()->default(0.00);
            $table->integer('totalRetos')->unsigned()->default(0);
            $table->integer('retosSuperados')->unsigned()->default(0);
            $table->json('records')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')
                  ->on('usuarios')
                  ->references('id')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });

        $createTrigger = <<<EOT
CREATE TRIGGER add_slug_to_usuarios_bi BEFORE INSERT ON `usuarios` FOR
EACH ROW
  BEGIN
    set new.slug = md5(CONCAT(new.nombre, new.usuario, new.email, new.password));
  END
EOT;

        DB::unprepared($createTrigger);

        $usuario = Usuario::create([
            'nombre' => 'Manuel',
            'apellidos' => 'Contreras Morillo',
            'usuario' => 'manuelprg',
            'email' => 'manuel.contreras.morillo@gmail.com',
            'administrador' => 1,
            'password' => 'desarrollo',
        ]);

        $usuario2 = Usuario::create([
            'nombre' => 'Prueba',
            'apellidos' => 'Contreras Morillo',
            'usuario' => 'noadmin',
            'email' => 'pruebao@gmail.com',
            'administrador' => 0,
            'password' => 'desarrollo',
        ]);

        $usuario->estadistica()->save(new Estadistica([]));
        $usuario2->estadistica()->save(new Estadistica([]));

        Schema::create('recorridos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 60)->nullable();
            $table->string('alias', 20);
            $table->string('descripcion', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('carreras', function(Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 40);
            $table->decimal('distancia', 7, 2)->nullable();
            $table->decimal('tiempo', 12, 2)->nullable();
            $table->dateTime('fecha');
            $table->decimal('temperatura', 5, 2)->nullable();
            $table->string('comentario')->nullable();
            $table->integer('recorrido_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->json('records')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('usuario_id')
                  ->on('usuarios')
                  ->references('id')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('recorrido_id')
                  ->on('recorridos')
                  ->references('id')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });

        Schema::create('vueltas', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('distancia', 7, 2);
            $table->integer('carrera_id')->unsigned()->nullable();
            $table->decimal('tiempo', 12, 2);
            $table->boolean('vuelta_rapida')->default(0);
            $table->smallInteger('orden');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('carrera_id')
                  ->on('carreras')
                  ->references('id')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadisticas');
        Schema::dropIfExists('vueltas');
        Schema::dropIfExists('carreras');
        Schema::dropIfExists('recorridos');
        Schema::dropIfExists('usuarios');
    }
}
