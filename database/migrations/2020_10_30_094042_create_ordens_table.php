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
            $table->string('propietario', 50);
            $table->string('telefono', 50)->nullable();
            $table->date('fecha')->nullable();
            $table->string('vehiculo', 50);
            $table->string('placa', 50);
            $table->string('modelo', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('ano', 50)->nullable();
            $table->string('tanque', 50)->nullable();
            $table->string('solicitud', 500);
            $table->tinyInteger('tapa_ruedas')->default('0');
            $table->tinyInteger('llanta_auxilio')->default('0');
            $table->tinyInteger('gata_hidraulica')->default('0');
            $table->tinyInteger('llave_cruz')->default('0');
            $table->tinyInteger('pisos')->default('0');
            $table->tinyInteger('limpia_parabrisas')->default('0');
            $table->tinyInteger('tapa_tanque')->default('0');
            $table->tinyInteger('herramientas')->default('0');
            $table->tinyInteger('mangueras')->default('0');
            $table->tinyInteger('espejos')->default('0');
            $table->tinyInteger('tapa_cubos')->default('0');
            $table->tinyInteger('antena')->default('0');
            $table->tinyInteger('radio')->default('0');
            $table->tinyInteger('focos')->default('0');
            $table->string('otros', 500)->nullable();
            $table->string('responsable', 50)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->integer('km_actual')->nullable();
            $table->date('proximo_cambio')->nullable();
            $table->tinyInteger('pago')->default('1')->nullable();
            $table->string('detalle_pago', 300)->nullable();
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
        Schema::dropIfExists('ordens');
    }
}
