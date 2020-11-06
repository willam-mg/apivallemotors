<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_trabajos', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_id');
            $table->integer('vehiculo_id');
            $table->string('tanque', 50);
            $table->string('otros', 500);
            $table->date('fecha');
            $table->date('fecha_ingreso');
            $table->time('hora_ingreso');
            $table->date('fecha_salida');
            $table->time('hora_salida');
            $table->integer('km_actual');
            $table->date('proximo_cambio');
            $table->tinyInteger('pago')->default('1');
            $table->string('detalle_pago', 300);
            $table->integer('mecanico_id')->nullable();//responsable
            $table->tinyInteger('estado')->default('0');
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
        Schema::dropIfExists('solicitud_trabajos');
    }
}
