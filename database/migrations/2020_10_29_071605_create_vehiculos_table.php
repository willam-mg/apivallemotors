<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('vehiculo',50)->comment('tipo del vehiculo como vagoneta, trailer o miniban');
            $table->string('placa',50);
            $table->string('modelo',50)->nullable();
            $table->string('color',50)->nullable();
            $table->integer('ano')->nullable();
            $table->string('observacion',300)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('vehiculos', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
