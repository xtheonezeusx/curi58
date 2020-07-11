<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descripcion');
            $table->date('fecha_entrega');
            $table->string('archivo');
            $table->string('estado');
            $table->string('archivo_final')->nullable();
            $table->text('observacion')->nullable();

            $table->bigInteger('envio_id')->unsigned()->nullable();
            $table->foreign('envio_id')->references('id')->on('envios');

            $table->bigInteger('desarrollador_id')->unsigned()->nullable();
            $table->foreign('desarrollador_id')->references('id')->on('users');

            $table->bigInteger('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->bigInteger('sub_id')->unsigned();
            $table->foreign('sub_id')->references('id')->on('subs');

            $table->decimal('precio', 8, 2);
            $table->decimal('adelanto', 8, 2);

            $table->bigInteger('curso_id')->unsigned()->nullable();
            $table->foreign('curso_id')->references('id')->on('cursos');

            $table->bigInteger('docente_id')->unsigned()->nullable();
            $table->foreign('docente_id')->references('id')->on('docentes');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('trabajos');
    }
}
