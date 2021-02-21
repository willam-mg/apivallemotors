<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('vehiculo_id')->nullable()->comment('vehiculo');
            $table->date('fecha')->nullable()->comment('fecha de creacion de la orden');
            $table->string('solicitud', 500)->comment('solicitud de trabajo del cliente');
            $table->string('tanque', 50)->nullable()->comment('capacidad del tanque dle vehiculo');
            // detalle del estado del vehiculo
            $table->string('estado_vehiculo_otros', 500)->nullable()->comment('otros objetos que se quedan dentro del vehiculo');
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            // responsable
            $table->unsignedBigInteger('mecanico_id')->nullable()->comment('mecanico responsable');
            $table->integer('km_actual')->nullable()->comment('kilometraje actual del vehiculo');
            $table->date('proximo_cambio')->nullable()->comment('proximo cambio de aceite');
            $table->tinyInteger('pago')->default('1')->nullable()->comment('tipo de pago efectivo o cheque');
            $table->string('detalle_pago', 300)->nullable()->comment('datos del tipo de pago cheque');
            $table->tinyInteger('estado')->default('0')->comment('0 = pendiente, 1 = en reparacion y 2 = terminado');
            // cliente
            $table->string('propietario', 50);
            $table->string('telefono', 50)->nullable();
            $table->string('encargado', 50)->nullable()->comment('encargado de la empresa');
            $table->string('telefono_encargado', 50)->nullable()->comment('telefono del ecargado de la empresa');
            //vehiculo
            $table->string('vehiculo', 50);
            $table->string('placa', 50);
            $table->string('modelo', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('ano', 50)->nullable();
            $table->string('src_foto', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ordens', function (Blueprint $table) {
            $table->foreign('mecanico_id')->references('id')->on('mecanicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens');
    }
}